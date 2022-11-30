<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Ip;
use App\Models\Userslist;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ipaddress extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedIps'];
    public $checkedIp = [];
    public $byDept =null;
    public $byDes =null;
    public $byUnit =null;
    public $byWstat =null;
    public $perPage =20;
    public $orderBy = "id";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.ipaddress',[
            'Userlists'=>Userslist::orderBy('name','asc')->get(),
            'Ips'=>Ip::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })->when($this->byDes,function($query){
                $query->where('desigation',$this->byDes);
            })->when($this->byWstat,function($query){
                $query->where('wstation',$this->byWstat);
            })->when($this->byUnit,function($query){
                $query->where('unit',$this->byUnit);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }
    
    public function OpenAddIPModal(){
        $this->ip = '';
        $this->dispatchBrowserEvent('OpenAddIPModal');
    }
    public function save(){
            $ip = file_get_contents('https://api.ipify.org/?format=text');
            date_default_timezone_set('Asia/Dhaka');
            $time =  date('d F Y h:i:s A');
            $ipadd =  $this->ip; 
            $info = Ip::where('ip',$ipadd)->first();

            $this->validate([
            "ip"=>"required|regex:/(^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$)/",
            ],
            ['ip.required'=>"The IP Address field is required.",
            'ip.regex'=>"Invalid IP format"]
            );

                if(empty($info))
                {
                $save = Ip::insert([
                'ip'=>$this->ip,
                ]);
                if(Session::get('admin_type') == "Mod"){
                Log::insert([
                'name'=>Session::get('name'),
                'email'=>Session::get('email'),
                'activity'=>"Create",
                'afield'=>"IP List",
                'time'=>$time,
                'ip'=> $ip,
                ]);
                }
                if($save){
                $this->dispatchBrowserEvent('CloseAddIPModal');
                $this->checkedUser = [];
                } 
                }
                else 
                {
                    $this->dispatchBrowserEvent('ClosefailedIPModal');
                }
}
public function OpenAddIPsModal(){
    $this->ips = '';
    $this->dispatchBrowserEvent('OpenAddIPsModal');
}
public function saveips(){
        $ip = file_get_contents('https://api.ipify.org/?format=text');
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $ipadd =  $this->ips.'.'.'1'; 
        $info = Ip::where('ip',$ipadd)->first();

        $this->validate([
        "ips"=>"required|regex:/(^\d{1,3}.\d{1,3}.\d{1,3}$)/",
        ],
        ['ips.required'=>"The IP Address field is required.",
        'ips.regex'=>"Invalid IP format"]
        );

        if(empty($info))
        {
            for ($x = 1; $x <= 255; $x++) {
            $save = Ip::insert([
            'ip'=>$this->ips.'.'.$x,
            ]);
            }
            if(Session::get('admin_type') == "Mod"){
            Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Create",
            'afield'=>"IP List",
            'time'=>$time,
            'ip'=> $ip,
            ]);
            }

            if($save){
            $this->dispatchBrowserEvent('CloseAddIPsModal');
            $this->checkedUser = [];
            } 
        }
        else 
        {
            $this->dispatchBrowserEvent('ClosefailedIPsModal');
        }
}
public function OpenEditModal($id){
    $info = Ip::find($id);
    $this->U_ipid = $info->id;
    $this->U_ip = $info->ip;
    if(empty($info->userid))
    {
      $this->U_user = '';
    }
    else
    {
        $this->U_user = $info->userid;
    }
    $this->U_padd = $info->physical_address;
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
    $userinfo = Userslist::where('userid',$this->U_user)->first();
    $userip =  Userslist::where('ip',$this->U_ip)->first();
    if(empty($this->U_user))
    {
        Userslist::where('ip',$this->U_ip)->update([
            'ip_id'=>Null,
            'ip'=>Null
        ]);
        $update = Ip::find($cid)->update([
            'name'=>Null,
            'userid'=>Null,
            'desigation'=>Null,
            'dept'=>Null,
            'unit'=>Null,
            'wstation'=>Null,
            'physical_address'=>$this->U_padd,
            'issue_date'=>Null
        ]);
        if($update){
            $this->dispatchBrowserEvent('CloseEditModal');
            $this->checkedUser = [];
        }
    }
    else 
    {
        if($userip)
        {
            $upUser = Userslist::find($userip->id)->update([
                'ip_id'=>Null,
                'ip'=>Null
            ]);
            if($upUser)
            {
                Userslist::where('userid',$userinfo->userid)->update([
                    'ip_id'=> $this->U_ipid,
                    'ip'=>$this->U_ip,
            
                ]);
                $update = Ip::find($cid)->update([
                    'name'=>$userinfo->name,
                    'userid'=>$userinfo->userid,
                    'desigation'=>$userinfo->desigation,
                    'dept'=>$userinfo->dept,
                    'unit'=>$userinfo->unit,
                    'wstation'=>$userinfo->wstation,
                    'physical_address'=> $this->U_padd,
                    'issue_date'=>$time
                ]);
                if(Session::get('admin_type') == "Mod"){
                    Log::insert([
                        'name'=>Session::get('name'),
                        'email'=>Session::get('email'),
                        'activity'=>"Update",
                        'afield'=>"IP List",
                        'time'=>$time,
                        'ip'=> $ip,
                    ]);
                }
                if($update){
                    $this->dispatchBrowserEvent('CloseEditModal');
                    $this->checkedUser = [];
                }
            }
        }
        else 
        {
            Userslist::where('userid',$this->U_user)->update([
                'ip_id'=> $this->U_ipid,
                'ip'=>$this->U_ip,
        
            ]);
            $update = Ip::find($cid)->update([
                'name'=>$userinfo->name,
                'userid'=>$userinfo->userid,
                'desigation'=>$userinfo->desigation,
                'dept'=>$userinfo->dept,
                'unit'=>$userinfo->unit,
                'wstation'=>$userinfo->wstation,
                'physical_address'=> $this->U_padd,
                'issue_date'=>$time
            ]);
            if(Session::get('admin_type') == "Mod"){
                Log::insert([
                    'name'=>Session::get('name'),
                    'email'=>Session::get('email'),
                    'activity'=>"Update",
                    'afield'=>"IP List",
                    'time'=>$time,
                    'ip'=> $ip,
                ]);
            }
            if($update){
                $this->dispatchBrowserEvent('CloseEditModal');
                $this->checkedUser = [];
            }
        }
    }


}

public function deleteConfirm($id){
    $info = Ip::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
        'id'=>$id
    ]);
}
public function delete($id){
    $del =  Ip::find($id)->delete();
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
            'afield'=>"IP List",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedIp = [];
}
public function deleteIps(){
    $this->dispatchBrowserEvent('swal:deleteIps',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete this items',
        'checkedIDs'=>$this->checkedIp,
    ]);
}
public function deleteCheckedIps($ids){
    Ip::whereKey($ids)->delete();
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"IP List",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedIp = [];
}
public function isChecked($IpId){
    return in_array($IpId, $this->checkedIp) ? 'bg-info text-white' : '';
}

}
