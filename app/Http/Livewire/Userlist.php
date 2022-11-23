<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Userslist;
use App\Models\Itcus;
use App\Models\Dept;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use Illuminate\Http\Request;

class Userlist extends Component
{

    use WithPagination;
    protected $listeners = ['delete','deleteCheckedUsers'];
    public $checkedUser = [];
    public $byDept =null;
    public $byDes =null;
    public $byWstat =null;
    
    public $byUid =null;
    public $byPid =null;
    public $byIp =null;
    public $byVpn =null;

    public $perPage =20;
    public $orderBy = "userid";
    public $sortBy = "asc";
    public $search;

    // public $userid;
 
    // protected $rules = [
    //     'userid' => 'required|regex:/^emp-[0-9][0-9][0-9]-[0-9][0-9][0-9]$/',
    // ];
    // protected $messages = [
    //     'userid.regex' => 'Format : xxx-123-123 (3 Letter-3 Number-3 Number)',
    //     'userid.required'=>"The Userslist ID field is required.",
    // ];
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }
 

    public function render()
    {
        return view('livewire.userlist',[
            'Users'=>Userslist::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })->when($this->byDes,function($query){
                $query->where('desigation',$this->byDes);
            })->when($this->byWstat,function($query){
                $query->where('wstation',$this->byWstat);
            })->when($this->byUid,function($query){
                $query->where('userid',$this->byUid);
            })->when($this->byPid,function($query){
                $query->where('asset_id',$this->byPid);
            })->when($this->byIp,function($query){
                $query->where('ip_id',$this->byIp);
            })->when($this->byVpn,function($query){
                $query->where('vpn_id',$this->byVpn);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddUserModal(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->desigation = '';
        $this->dept = '';
        $this->wstation = '';
        $this->unit = '';

        $this->dispatchBrowserEvent('OpenAddUserModal');
    }
    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $chk = Userslist::all();
        if($chk->isEmpty()){
            $userid = "emp-000001";
         }
         else
         {
            $uid = Userslist::orderBy('userid', 'desc')->first();
            $increment_uid = $uid->userid;
            $userid = ++$increment_uid;
         }

        $time =  date('d F Y h:i:s A');
        $ip = file_get_contents('https://api.ipify.org/?format=text');     
        $this->validate([
            "name"=>"required",
            "desigation"=>"required",
            'dept'=>"required",
            'wstation'=>"required",
            'unit'=>"required"
        ],
        ['name.required'=>"The Userslist Name field is required.",
        'desigation.required'=>"The Designation field is required.",
        'dept.required'=>"The Department field is required.",
        'wstation.required'=>"The Work Station field is required.",
        'unit.required'=>"The Working Unit field is required."]
    );

        $save = Userslist::insert([
            'userid'=>$userid,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'desigation'=>$this->desigation,
            'dept'=>$this->dept,
            'wstation'=>$this->wstation,
            'unit'=> $this->unit,
        ]);
          if(Session::get('admin_type') == "Mod"){
            Log::insert([
              'name'=>Session::get('name'),
              'email'=>Session::get('email'),
              'activity'=>"Create",
              'afield'=>"User List",
              'time'=>$time,
              'ip'=> $ip,
          ]);
        }
  
      if($save){
          $this->dispatchBrowserEvent('CloseAddUserModal');
          $this->checkedUser = [];
      } 
    

}

public function OpenEditModal($id){
    $info = Userslist::find($id);

    $this->U_user_name = $info->user_name;
    $this->U_desigation = $info->desigation;
    $this->U_dept = $info->dept;
    $this->U_wstation = $info->wstation;
    $this->U_item = $info->item;
    $this->U_laptop_name = $info->laptop_name;
    $this->U_serial_no = $info->serial_no;
    $this->U_P_user = $info->previous_user;
    $this->U_I_date = $info->issue_date;
    $this->U_P_I_date = $info->p_issue_date;
    $this->U_configuration = $info->configuration;
    $this->cid = $info->id;
    $this->dispatchBrowserEvent('OpenEditModal',[
        'id'=>$id
    ]);
}

public function updateRow(){
    $cid = $this->cid;
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    $update = Userslist::find($cid)->update([
        'user_name'=>$this->U_user_name,
        'desigation'=>$this->U_desigation,
        'dept'=>$this->U_dept,
        'wstation'=>$this->U_wstation,
        'item'=>$this->U_item,
        'laptop_name'=>$this->U_laptop_name,
        'serial_no'=>$this->U_serial_no,
        'previous_user'=>$this->U_P_user,
        'issue_date'=>$this->U_I_date,
        'p_issue_date'=>$this->U_P_I_date,
        'configuration'=>$this->U_configuration
    ]);
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Update",
            'afield'=>"User List",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    if($update){
        $this->dispatchBrowserEvent('CloseEditModal');
        $this->checkedUser = [];
    }
}
public function deleteConfirm($id){
    $info = Userslist::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
        'id'=>$id
    ]);
}
public function delete($id){
    $del =  Userslist::find($id)->delete();
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if($del){
        $this->dispatchBrowserEvent('deleted');
    }
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"User List",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedUser = [];
}
public function deleteUsers(){
    $this->dispatchBrowserEvent('swal:deleteUsers',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete this items',
        'checkedIDs'=>$this->checkedUser,
    ]);
}
public function deleteCheckedUsers($ids){
    Userslist::whereKey($ids)->delete();
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"User List",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedUser = [];
}
public function isChecked($UserId){
    return in_array($UserId, $this->checkedUser) ? 'bg-info text-white' : '';
}
}
