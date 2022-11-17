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

    
    public function deleteConfirm($id){
        $info = Admin::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
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
            'html'=>'You want to delete this items',
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
