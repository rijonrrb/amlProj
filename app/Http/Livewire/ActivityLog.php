<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;

class ActivityLog extends Component
{

    use WithPagination;
    protected $listeners = ['delete','deleteCheckedLogs'];
    public $checkedLog = [];

    public function render()
    {

        return view('livewire.activity-log',[ 
            'Logs'=>Log::all()
        ]);
    }

    
    public function deleteConfirm($id){
        $info = Log::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to <strong>delete</strong> this?',
            'id'=>$id
        ]);
    }
    public function delete($id){
        $del =  Log::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedLog = [];
    }
    public function deleteLogs(){
        $this->dispatchBrowserEvent('swal:deleteLogs',[
            'title'=>'Are you sure?',
            'html'=>'You want to <strong>delete</strong> this rows',
            'checkedIDs'=>$this->checkedLog,
        ]);
    }
    public function deleteCheckedLogs($ids){
        Log::whereKey($ids)->delete();
        $this->checkedLog = [];
    }
    public function isChecked($LogId){
        return in_array($LogId, $this->checkedLog) ? 'bg-info text-white' : '';
    }
}
