<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Hr;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class Hrs extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedHrs'];
    public $checkedHr = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.hrs',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Hrs'=>Hr::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddHrModal(){

        $this->user_name = '';
        $this->desigation = '';
        $this->dept = '';
        $this->unit = '';
        $this->item = '';
        $this->laptop_name = '';
        $this->asset_no = '';
        $this->serial_no = '';
        $this->previous_user = '';
        $this->issue_date = '';
        $this->p_issue_date = '';
        $this->configuration = '';
        $this->abc = '';

        $this->H_user = '';
        $this->H_designation = '';
        $this->H_dept = '';
        $this->H_unit = '';
        $this->dispatchBrowserEvent('OpenAddHrModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $next_id = uniqid('HR', true);
        Session::put('id', $next_id);
        Session::put('b_area', 'HR');

        $this->validate([
            "user_name"=>"required",
            "desigation"=>"required",
            'dept'=>"required",
            "unit"=>"required"
        ],
        ['user_name.required'=>"The User Name field is required.",
        'desigation.required'=>"The Designation field is required.",
        'dept.required'=>"The Department field is required.",
        'unit.required'=>"The Unit field is required."]
    );

        $save = Hr::insert([

          'user_name'=>$this->user_name,
          'desigation'=>$this->desigation,
          'dept'=>$this->dept,
          'unit'=>$this->unit,
          'item'=>$this->item,
          'laptop_name'=>$this->laptop_name,
          'asset_no'=>$this->asset_no,
          'serial_no'=>$this->serial_no,
          'previous_user'=>$this->previous_user,
          'issue_date'=>$time,
          'p_issue_date'=>$this->p_issue_date,
          'configuration'=>$this->configuration,
          'sid'=> $next_id,
      ]);

      Invoice::insert([

            'handedBy'=>$this->H_user,
            'h_desigation'=>$this->H_designation,
            'h_dept'=>$this->H_dept,
            'h_unit'=>$this->H_unit,
            'sid'=> $next_id,
            'takenBy'=>$this->user_name,
            't_desigation'=>$this->desigation,
            't_dept'=>$this->dept,
            't_unit'=>$this->unit,
            'remarks'=>'For Official use',
            'qty'=>'1',
            'laptop_name'=>$this->laptop_name,
            'configuration'=>$this->configuration,
            'asset_no'=>$this->asset_no,
            'serial_no'=>$this->serial_no,
            'business_area'=>'HR',
        ]);
        
        if(!empty($this->dept))

        {
            $dept = Dept::where('dept_name',$this->dept)->first();
            
            if(!$dept)
            {  
                $saave = Dept::insert([

                    'dept_name'=>$this->dept
                ]);

            }
        }

        if($save){
            $this->dispatchBrowserEvent('CloseAddHrModal');
            $this->checkedHr = [];
        }
    }


    public function deleteConfirmH($id){
        $info = Hr::find($id);
        $this->dispatchBrowserEvent('SwalConfirmH',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id,$hr){
        if ( $hr == "hr")
        {
            $del =  Hr::find($id)->delete();
            if($del){
                $this->dispatchBrowserEvent('deletedH');
            }
            $this->checkedHr = [];
        }

    }

    public function deleteHrs(){
        $this->dispatchBrowserEvent('swal:deleteHrs',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedHr,
        ]);
    }
    public function deleteCheckedHrs($ids){
        Hr::whereKey($ids)->delete();
        $this->checkedHr = [];
    }

    public function isChecked($HrId){
        return in_array($HrId, $this->checkedHr) ? 'bg-info text-white' : '';
    }
}
