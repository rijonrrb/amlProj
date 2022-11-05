<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mis;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class Miss extends Component
{

    use WithPagination;
    protected $listeners = ['delete','deleteCheckedMisss'];
    public $checkedMiss = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.miss',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Misss'=>Mis::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }


    public function OpenAddMissModal(){

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
        $this->dispatchBrowserEvent('OpenAddMissModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $next_id = uniqid('MIS', true);
        Session::put('id', $next_id);
        Session::put('b_area', 'MIS');

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

        $save = Mis::insert([

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
            'business_area'=>'MIS',
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
            $this->dispatchBrowserEvent('CloseAddMissModal');
            $this->checkedMiss = [];
        }
    }



    public function deleteConfirmM($id){
        $info = Mis::find($id);
        $this->dispatchBrowserEvent('SwalConfirmM',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id,$miss){
        if ( $miss == "miss")
        {
            $del =  Mis::find($id)->delete();
            if($del){
                $this->dispatchBrowserEvent('deletedM');
            }
            $this->checkedMiss = [];
        }

    }

    public function deleteMisss(){
        $this->dispatchBrowserEvent('swal:deleteMisss',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedMiss,
        ]);
    }
    public function deleteCheckedMisss($ids){
        Mis::whereKey($ids)->delete();
        $this->checkedMiss = [];
    }

    public function isChecked($MissId){
        return in_array($MissId, $this->checkedMiss) ? 'bg-info text-white' : '';
    }
}
