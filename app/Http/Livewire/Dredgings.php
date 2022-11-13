<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dredging;
use App\Models\Itcus;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class Dredgings extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedDredgings'];
    public $checkedDredging = [];
    public $byDept =null;
    public $perPage =20;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.dredgings',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Dredgings'=>Dredging::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }
    public function OpenAddDredgingModal(){
        $this->user_name = '';
        $this->desigation = '';
        $this->dept = '';
        $this->wstation = '';
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
        $this->H_wstation = '';
        $this->H_unit = '';
        $this->dispatchBrowserEvent('OpenAddDredgingModal');
    }
    public function save(){
        $this->validate([
            "user_name"=>"required",
            "desigation"=>"required",
            'dept'=>"required",
            'wstation'=>"required"
        ],
        ['user_name.required'=>"The User Name field is required.",
        'desigation.required'=>"The Designation field is required.",
        'dept.required'=>"The Department field is required.",
        'wstation.required'=>"The Work Station field is required."]
    );
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $next_id = uniqid('Dredging', true);
        $asst = substr($this->item, 0,3)."-".rand(100,1000)."-".rand(10000,1000000);
        Session::put('id', $next_id);
        Session::put('b_area', 'Dredging');
        $save = Dredging::insert([
          'user_name'=>$this->user_name,
          'desigation'=>$this->desigation,
          'dept'=>$this->dept,
          'wstation'=>$this->wstation,
          'unit'=>"AML Dredging Unit",
          'item'=>$this->item,
          'laptop_name'=>$this->laptop_name,
          'asset_no'=>$asst,
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
            'h_wstation'=>$this->H_wstation,
            'h_unit'=>"IT Unit",
            'takenBy'=>$this->user_name,
            't_desigation'=>$this->desigation,
            't_dept'=>$this->dept,
            't_wstation'=>$this->wstation,
            't_unit'=>"AML Dredging Unit",
            'remarks'=>'For Official use',
            'qty'=>'1',
            'laptop_name'=>$this->laptop_name,
            'configuration'=>$this->configuration,
            'asset_no'=>$asst,
            'serial_no'=>$this->serial_no,
            'business_area'=>'Dredging',
            'sid'=>$next_id,
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
            $this->dispatchBrowserEvent('CloseAddDredgingModal');
            $this->checkedDredging = [];
        }
    }
    public function OpenReturnCountryModal($id){
        $info = Dredging::find($id);
        $this->upd_H_user = '';
        $this->upd_H_designation = '';
        $this->upd_H_dept = '';
        $this->upd_H_wstation = '';
        $this->upd_H_condition = '';
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenReturnCountryModal',[
            'id'=>$id
        ]);
    }
    public function update(){
       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $cid = $this->cid;
        $info = Dredging::find($cid);
        
        if (empty($info->previous_user))
        {
            $previous_user = $info->user_name;
        }
        elseif (empty($info->user_name))
        {
            $previous_user = $info->previous_user;
        }
        else
        {
            $previous_user = $info->previous_user."  ||  ".$info->user_name;
        }
        if (empty($info->p_issue_date))
        {
            $p_i_date = $info->issue_date;
        }
        elseif (empty($info->user_name))
        {
            $p_i_date = $info->p_issue_date;
        }
        else
        {
            $p_i_date = $info->p_issue_date."  ||  ".$info->issue_date;
        }
        Session::put('id', $info->sid);
        Session::put('b_area', 'Dredging');
        $this->validate([
            "upd_H_user"=>"required",
            "upd_H_designation"=>"required",
            "upd_H_dept"=>"required",
            "upd_H_wstation"=>"required",
            "upd_H_condition"=>"required"
        ],
        ['upd_H_user.required'=>"The User Name field is required.",
        'upd_H_designation.required'=>"The Designation field is required.",
        'upd_H_dept.required'=>"The Department field is required.",
        'upd_H_wstation.required'=>"The Work Station field is required.",
        'upd_H_condition.required'=>"The Condition field is required."]
    );
        $update = Itcus::insert([
            'user_name'=>Null,
            'desigation'=>Null,
            'dept'=>Null,
            'dept'=>Null,
            'unit'=>"AML Dredging Unit",
            'item'=>$info->item,
            'laptop_name'=> $info->laptop_name,
            'asset_no'=> $info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'condition'=>$this->upd_H_condition,
            'sid'=>$info->sid
        ]);
        $savex = Invoice::where('sid',$info->sid)->update([
            'handedBy'=>$info->user_name,
            'h_desigation'=>$info->desigation,
            'h_dept'=> $info->dept,
            'h_wstation'=> $info->wstation,
            'h_unit'=>"AML Dredging Unit",
            'takenBy'=>$this->upd_H_user,
            't_desigation'=>$this->upd_H_designation,
            't_dept'=>$this->upd_H_dept,
            't_wstation'=>$this->upd_H_wstation,
            't_unit'=>"IT Unit",
            'remarks'=>'Return Product',
            'qty'=>'1',
            'laptop_name'=>$info->laptop_name,
            'configuration'=>$info->configuration,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'business_area'=>'Dredging',
        ]);
        if($savex){
            $del =  Dredging::find($cid)->delete();
            $this->dispatchBrowserEvent('CloseReturnCountryModal');
            $this->checkedDredging = [];
        }
    }
    
    public function OpenReuseModal($id){
        $info = Dredging::find($id);
        $this->r_user_name = '';
        $this->r_desigation = '';
        $this->r_dept = '';
        $this->r_unit = '';
        $this->r_H_user = '';
        $this->r_H_designation = '';
        $this->r_H_dept = '';
        $this->r_H_unit = '';
        $this->rid = $info->id;
        $this->dispatchBrowserEvent('OpenReuseModal',[
            'id'=>$id
        ]);
    }
    public function reuseProd(){
       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $rid = $this->rid;
        $info = Dredging::find($rid);
        if (empty($info->previous_user))
        {
            $previous_user = $info->user_name;
        }
        elseif (empty($info->user_name))
        {
            $previous_user = $info->previous_user;
        }
        else
        {
            $previous_user = $info->previous_user."  ||  ".$info->user_name;
        }
        if (empty($info->p_issue_date))
        {
            $p_i_date = $info->issue_date;
        }
        elseif (empty($info->user_name))
        {
            $p_i_date = $info->p_issue_date;
        }
        else
        {
            $p_i_date = $info->p_issue_date."  ||  ".$info->issue_date;
        }
        Session::put('id', $info->sid);
        Session::put('b_area', 'Dredging');
        $this->validate([
            "r_H_user"=>"required",
            "r_H_designation"=>"required",
            'r_H_dept'=>"required",
            "r_H_unit"=>"required",
            "r_user_name"=>"required",
            "r_desigation"=>"required",
            'r_dept'=>"required",
            "r_unit"=>"required"
        ],
        ['r_H_user.required'=>"The User Name field is required.",
        'r_H_designation.required'=>"The Designation field is required.",
        'r_H_dept.required'=>"The Department field is required.",
        'r_H_unit.required'=>"The Unit field is required.",
        'r_user_name.required'=>"The User Name field is required.",
        'r_desigation.required'=>"The Designation field is required.",
        'r_dept.required'=>"The Department field is required.",
        'r_unit.required'=>"The Unit field is required."]
    );
        $update = Dredging::find($rid)->update([
            'user_name'=>$this->r_user_name,
            'desigation'=>$this->r_desigation,
            'dept'=>$this->r_dept,
            'unit'=>$this->r_unit,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$p_i_date,
        ]);
        $savex = Invoice::where('sid',$info->sid)->update([
          'handedBy'=>$this->r_H_user,
          'h_desigation'=>$this->r_H_designation,
          'h_dept'=>$this->r_H_dept,
          'h_unit'=>"IT Unit",
          'takenBy'=>$this->r_user_name,
          't_desigation'=>$this->r_desigation,
          't_dept'=>$this->r_dept,
          't_unit'=>$this->r_unit,
          'remarks'=>'For Official use',
          'qty'=>'1',
          'business_area'=>'Dredging',
      ]);
        if(!empty($this->r_dept))
        {
            $deptT = Dept::where('dept_name',$this->r_dept)->first();
            if(!$deptT)
            {  
                $saave= Dept::insert([
                    'dept_name'=>$this->r_dept
                ]);
            }
        }
        if(!empty($this->r_H_dept))
        {
            $deptH = Dept::where('dept_name',$this->r_H_dept)->first();
            if(!$deptH)
            {  
                $saave= Dept::insert([
                    'dept_name'=>$this->r_H_dept
                ]);
            }
        }
        if($savex){
            $this->dispatchBrowserEvent('CloseReuseModal');
            $this->checkedDredging = [];
        }
    }
    public function deleteConfirm($id){
        $info = Dredging::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }
    public function delete($id){
        $del =  Dredging::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedDredging = [];
    }
    public function deleteDredgings(){
        $this->dispatchBrowserEvent('swal:deleteDredgings',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedDredging,
        ]);
    }
    public function deleteCheckedDredgings($ids){
        Dredging::whereKey($ids)->delete();
        $this->checkedDredging = [];
    }
    public function isChecked($DredgingId){
        return in_array($DredgingId, $this->checkedDredging) ? 'bg-info text-white' : '';
    }
}
