<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Vpns;
use App\Models\Userslist;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Vpn extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedVpns'];
    public $checkedVpn = [];
    public $byUid = Null;
    public $perPage =20;
    public $orderBy = "id";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.vpn',[
            'Userlists'=>Userslist::orderBy('name','asc')->get(),
            'Vpns'=>Vpns::when($this->byUid,function($query){
                $query->where('userid',$this->byUid);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }
    
    public function OpenAddVpnModal(){
        $this->userid = '';
        $this->name = '';
        $this->password = '';
        $this->ip = '';
        $this->remark = '';
        $this->dispatchBrowserEvent('OpenAddVpnModal');
    }
    public function save(){
        
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $name =  $this->name; 
        $info = Vpns::where('name',$name)->first();
        $userinfo = Userslist::where('userid',$this->userid)->first();
        if (empty($userinfo->vpn))
        {
            $vpn = $this->name;
        }
        else
        {
            $vpn = $userinfo->vpn."  ||  ".$this->name;
        }
        $this->validate([
        "userid"=>"required",
        "name"=>"required",
        "password"=>"required",
        "ip"=>"required|regex:/(^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$)/",
        ],
        ['userid.required'=>"The User ID field is required.",
        'name.required'=>"The Username field is required.",
        'password.required'=>"The Password field is required.",
        'ip.required'=>"The IP Address field is required.",
        'ip.regex'=>"Invalid IP format"]
        );

        if(empty($info))
        {
        if($this->userid == "No")
        {

            $save = Vpns::insert([
                'userid'=>'',
                'name'=>$this->name,
                'password'=>$this->password,
                'ip'=>$this->ip,
                'remark'=>$this->remark,
                ]);
            if(Session::get('admin_type') == "Mod"){
                Log::insert([
                    'name'=>Session::get('name'),
                    'email'=>Session::get('email'),
                    'activity'=>"Create",
                    'afield'=>"VPN List",
                    'time'=>$time,                 
                ]);
            }
            if($save){
                $this->dispatchBrowserEvent('CloseAddVpnModal');
                $this->checkedVpn = [];
            }
        }
        else 
        {

            Userslist::where('userid',$userinfo->userid)->update([
                'vpn'=>$vpn,

            ]);
            $save = Vpns::insert([
                'userid'=>$this->userid,
                'name'=>$this->name,
                'password'=>$this->password,
                'ip'=>$this->ip,
                'remark'=>$this->remark,
                ]);
            if(Session::get('admin_type') == "Mod"){
                Log::insert([
                    'name'=>Session::get('name'),
                    'email'=>Session::get('email'),
                    'activity'=>"Create",
                    'afield'=>"VPN List",
                    'time'=>$time,
                    
                ]);
            }
            if($save){
                $this->dispatchBrowserEvent('CloseAddVpnModal');
                $this->checkedVpn = [];
            }     
        }
        }
        else 
        {
        $this->dispatchBrowserEvent('ClosefailedVpnModal');
        }

}

public function OpenEditModal($id){
    $info = Vpns::find($id);
    $this->U_userid = $info->userid;
    $this->U_name = $info->name;
    $this->U_password = $info->password;
    $this->U_ip = $info->ip;
    $this->U_remark = $info->remark;
    $this->cid = $info->id;
    $this->dispatchBrowserEvent('OpenEditModal',[
        'id'=>$id
    ]);
}

public function updateRow(){
    $cid = $this->cid;  
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    $uname =  $this->U_name; 
    $chkUser = Vpns::where('id',$cid)->first();
    $info = Vpns::where('name',$uname)->first();
    $userinfo = Userslist::where('userid',$this->U_userid)->first();
    if($chkUser->userid == $this->U_userid && $chkUser->name == $this->U_name)
    {
       $vpn = $userinfo->vpn;
    }
    else {
        if (empty($userinfo->vpn))
        {
            $vpn = $this->U_name;
        }
        else
        {
            $vpn = $userinfo->vpn."  ||  ".$this->U_name;
        }
    }

    // if (empty($info)) {
    if($this->U_userid == "No")
    {
        Userslist::where('userid',$chkUser->userid)->where('vpn',$this->U_name)->update([
            'vpn'=>Null,
        ]);
    $update = Vpns::find($cid)->update([
    'userid'=>'',
    'name'=>$this->U_name,
    'password'=>$this->U_password,
    'ip'=>$this->U_ip,
    'remark'=>$this->U_remark,
    ]);
    if(Session::get('admin_type') == "Mod"){
    Log::insert([
    'name'=>Session::get('name'),
    'email'=>Session::get('email'),
    'activity'=>"Update",
    'afield'=>"Vpn List",
    'time'=>$time,
    
    ]);
    }
    if($update){
    $this->dispatchBrowserEvent('CloseEditModal');
    $this->checkedVpn = [];
    } 
    }
    else{
        Userslist::where('userid',$this->U_userid)->update([
            'vpn'=>$vpn,

        ]);
        $update = Vpns::find($cid)->update([
            'userid'=>$this->U_userid,
            'name'=>$this->U_name,
            'password'=>$this->U_password,
            'ip'=>$this->U_ip,
            'remark'=>$this->U_remark,
            ]);
        if(Session::get('admin_type') == "Mod"){
            Log::insert([
                'name'=>Session::get('name'),
                'email'=>Session::get('email'),
                'activity'=>"Update",
                'afield'=>"VPN List",
                'time'=>$time,
                
            ]);
        }
        if($update){
            $this->dispatchBrowserEvent('CloseEditModal');
            $this->checkedVpn = [];
        }  
    }
    // }
    // else 
    // {
    //     $this->dispatchBrowserEvent('ClosefailedEditModal');
    // }

}

public function deleteConfirm($id){
    $info = Vpns::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this?',
        'id'=>$id
    ]);
}
public function delete($id){
    $chkUser = Vpns::where('id',$id)->first();
    Userslist::where('userid',$chkUser->userid)->update([
        'vpn'=>Null,
    ]);
    $del =  Vpns::find($id)->delete();
    
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
            'afield'=>"Vpn List",
            'time'=>$time,
            
        ]);
    }
    $this->checkedVpn = [];
}
public function deleteVpns(){
    $this->dispatchBrowserEvent('swal:deleteVpns',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this rows',
        'checkedIDs'=>$this->checkedVpn,
    ]);
}
public function deleteCheckedVpns($ids){
    Vpns::whereKey($ids)->delete();
    
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"Vpn List",
            'time'=>$time,
            
        ]);
    }
    $this->checkedVpn = [];
}
public function isChecked($VpnId){
    return in_array($VpnId, $this->checkedVpn) ? 'bg-info text-white' : '';
}

}
