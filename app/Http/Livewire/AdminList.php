<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;

class AdminList extends Component
{

     use WithPagination;
    protected $listeners = ['delete','deleteCheckedAdmins'];
    public $checkedAdmin = [];

    public function render()
    {

        return view('livewire.admin-list',[ 
            'Admins'=>Admin::whereNotIn('admin_type',["SAdmin"])->get()
        ]);
    }
    public function OpenEditModal($id){
        $info = Admin::find($id);
    
        $this->U_Admin_name = $info->name;
        $this->U_Admin_email = $info->email;
        $this->U_Create = $info->create;
        $this->U_Update = $info->update;
        $this->U_Delete = $info->delete;
        $this->U_Issue = $info->issue;
        $this->U_Return = $info->return;
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenEditModal',[
            'id'=>$id
        ]);
    }
    
    public function updateRow(){
        $cid = $this->cid;
        if(empty($this->U_Create))
        {
            $this->U_Create = Null;
        }
        if(empty($this->U_Update))
        {
            $this->U_Update = Null;
        }
        if(empty($this->U_Delete))
        {
            $this->U_Delete = Null;
        }
        if(empty($this->U_Issue))
        {
            $this->U_Issue = Null;
        }
        if(empty($this->U_Return))
        {
            $this->U_Return = Null;
        }
        $update = Admin::find($cid)->update([
            'name'=>$this->U_Admin_name,
            'email'=>$this->U_Admin_email,
            'create'=>$this->U_Create,
            'update'=>$this->U_Update,
            'delete'=>$this->U_Delete,
            'issue'=>$this->U_Issue,
            'return'=>$this->U_Return
        ]);

        if($update){
            $this->dispatchBrowserEvent('CloseEditModal');
            $this->checkedUser = [];
        }
    }
    
    public function deleteConfirm($id){
        $info = Admin::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to <strong>delete</strong> this?',
            'id'=>$id
        ]);
    }
    public function delete($id){
        $del =  Admin::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedAdmin = [];
    }
    public function deleteAdmins(){
        $this->dispatchBrowserEvent('swal:deleteAdmins',[
            'title'=>'Are you sure?',
            'html'=>'You want to <strong>delete</strong> this rows',
            'checkedIDs'=>$this->checkedAdmin,
        ]);
    }
    public function deleteCheckedAdmins($ids){
        Admin::whereKey($ids)->delete();
        $this->checkedAdmin = [];
    }
    public function isChecked($AdminId){
        return in_array($AdminId, $this->checkedAdmin) ? 'bg-info text-white' : '';
    }
}
