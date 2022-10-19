<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CusBeve;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class CusBev extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedCusBeves'];
    public $checkedCusBeve = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.cus-bev',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'CusBeves'=>CusBeve::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddCusBeveModal(){

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
        $this->dispatchBrowserEvent('OpenAddCusBeveModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $id=DB::select("SHOW TABLE STATUS LIKE 'cus_beves'");
        $next_id=$id[0]->Auto_increment;
        Session::put('id', $next_id);
        Session::put('b_area', 'CustudyBev');

        $save = CusBeve::insert([

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
            'business_area'=>'CustudyBev',
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
            $this->dispatchBrowserEvent('CloseAddCusBeveModal');
            $this->checkedCusBeve = [];
        }
    }
    public function OpenReturnCountryModal($id){
        $info = CusBeve::find($id);
        $this->upd_H_user = '';
        $this->upd_H_designation = '';
        $this->upd_H_dept = '';
        $this->upd_H_unit = '';
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenReturnCountryModal',[
            'id'=>$id
        ]);
    }

    public function update(){

       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $cid = $this->cid;
        $info = CusBeve::find($cid);

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
        Session::put('id', $cid);
        Session::put('b_area', 'CustudyBev');

        $update = CusBeve::find($cid)->update([

            'user_name'=>Null,
            'desigation'=>Null,
            'dept'=>Null,
            'unit'=>Null,
            'item'=>$info->item,
            'laptop_name'=> $info->laptop_name,
            'asset_no'=> $info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$info->issue_date,
            'configuration'=>$info->configuration
        ]);


        $savex = Invoice::where('t_id',$cid)->update([

            'handedBy'=>$info->user_name,
            'h_desigation'=>$info->desigation,
            'h_dept'=> $info->dept,
            'h_unit'=>$info->unit,
            't_id'=> $cid,
            'takenBy'=>$this->upd_H_user,
            't_desigation'=>$this->upd_H_designation,
            't_dept'=>$this->upd_H_dept,
            't_unit'=>$this->upd_H_unit,
            'remarks'=>'Return Product',
            'qty'=>'1',
            'laptop_name'=>$info->laptop_name,
            'configuration'=>$info->configuration,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'business_area'=>'CustudyBev',
        ]);

        if($savex){
            $this->dispatchBrowserEvent('CloseReturnCountryModal');
            $this->checkedCusBeve = [];
        }
    }
    public function OpenReuseModal($id){
        $info = CusBeve::find($id);
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
        $info = CusBeve::find($rid);

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


        Session::put('id', $rid);
        Session::put('b_area', 'CustudyBev');

        $update = CusBeve::find($rid)->update([

            'user_name'=>$this->r_user_name,
            'desigation'=>$this->r_desigation,
            'dept'=>$this->r_dept,
            'unit'=>$this->r_unit,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$p_i_date,
        ]);

        $savex = Invoice::where('t_id',$rid)->update([
          'handedBy'=>$this->r_H_user,
          'h_desigation'=>$this->r_H_designation,
          'h_dept'=>$this->r_H_dept,
          'h_unit'=>$this->r_H_unit,
          'takenBy'=>$this->r_user_name,
          't_desigation'=>$this->r_desigation,
          't_dept'=>$this->r_dept,
          't_unit'=>$this->r_unit,
          'remarks'=>'For Official use',
          'qty'=>'1',
          'business_area'=>'CustudyBev',
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
            $this->checkedCusBeve = [];
        }
    }
    

    public function deleteConfirm($id){
        $info = CusBeve::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id){
        $del =  CusBeve::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedCusBeve = [];
    }

    public function deleteCusBeves(){
        $this->dispatchBrowserEvent('swal:deleteCusBeves',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedCusBeve,
        ]);
    }
    public function deleteCheckedCusBeves($ids){
        CusBeve::whereKey($ids)->delete();
        $this->checkedCusBeve = [];
    }

    public function isChecked($CusBeveId){
        return in_array($CusBeveId, $this->checkedCusBeve) ? 'bg-info text-white' : '';
    }
}