<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Suger;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class Sugers extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedSugers'];
    public $checkedSuger = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.sugers',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Sugers'=>Suger::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddSugerModal(){
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
        $this->dispatchBrowserEvent('OpenAddSugerModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $id=DB::select("SHOW TABLE STATUS LIKE 'sugers'");
        $next_id=$id[0]->Auto_increment;
        Session::put('id', $next_id);

        $save = Suger::insert([

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
            't_id'=> $next_id,
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
            'business_area'=>'Igloo CHO',
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
            $this->dispatchBrowserEvent('CloseAddSugerModal');
            $this->checkedSuger = [];
        }
    }

    public function OpenEditSugerModal($id){
        $info = Suger::find($id);

        $this->upd_user_name = $info->user_name;
        $this->upd_desigation = $abc;
        $this->upd_dept = $info->dept;
        $this->upd_unit = $info->unit;
        $this->upd_item = $info->item;
        $this->upd_laptop_name = $info->laptop_name;
        $this->upd_asset_no = $info->asset_no;
        $this->upd_serial_no = $info->serial_no;
        $this->upd_previous_user = $info->previous_user;
        $this->upd_issue_date = $info->issue_date;
        $this->upd_configuration = $info->configuration;
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenEditSugerModal',[
            'id'=>$id
        ]);
    }

    public function update(){
        $cid = $this->cid;

        $update = Suger::find($cid)->update([
            'user_name'=>$this->upd_user_name,
            'desigation'=>$this->upd_desigation,
            'dept'=>$this->upd_dept,
            'unit'=>$this->upd_unit,
            'item'=>$this->upd_item,
            'laptop_name'=>$this->upd_laptop_name,
            'asset_no'=>$this->upd_asset_no,
            'serial_no'=>$this->upd_serial_no,
            'previous_user'=>$this->upd_previous_user,
            'issue_date'=>$this->upd_issue_date,
            'configuration'=>$this->upd_configuration
        ]);

        if($update){
            $this->dispatchBrowserEvent('CloseEditSugerModal');
            $this->checkedSuger = [];
        }
    }
    

    public function deleteConfirm($id){
        $info = Suger::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id){
        $del =  Suger::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedSuger = [];
    }

    public function deleteSugers(){
        $this->dispatchBrowserEvent('swal:deleteSugers',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedSuger,
        ]);
    }
    public function deleteCheckedSugers($ids){
        Suger::whereKey($ids)->delete();
        $this->checkedSuger = [];
    }

    public function isChecked($SugerId){
        return in_array($SugerId, $this->checkedSuger) ? 'bg-info text-white' : '';
    }
}
