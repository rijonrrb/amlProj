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
            $ipadd =  $this->ip.'.'.'1'; 
            $info = Ip::where('ip',$ipadd)->first();

            $this->validate([
            "ip"=>"required|regex:/(^\d{1,3}.\d{1,3}.\d{1,3}$)/",
            ],
            ['ip.required'=>"The IP Address field is required.",
            'ip.regex'=>"Format for IP is xxx.xxx.xxx"]
            );

            if(empty($info))
            {
                for ($x = 1; $x <= 255; $x++) {
                $save = Ip::insert([
                'ip'=>$this->ip.'.'.$x,
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
                $this->dispatchBrowserEvent('CloseAddIPModal');
                $this->checkedUser = [];
                } 
            }
            else 
            {
                $this->dispatchBrowserEvent('ClosefailedIPModal');
            }


}

public function OpenEditModal($id){
    $info = Userslist::find($id);

    $this->U_user_name = $info->name;
    $this->U_user_email = $info->email;
    $this->U_user_phone = $info->phone;
    $this->U_desigation = $info->desigation;
    $this->U_dept = $info->dept;
    $this->U_unit = $info->unit;
    $this->U_wstation = $info->wstation;
    $this->U_ip = $info->ip;
    $this->U_vpn = $info->vpn;
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
        'name'=>$this->U_user_name,
        'email'=>$this->U_user_email,
        'phone'=>$this->U_user_phone,
        'desigation'=>$this->U_desigation,
        'dept'=>$this->U_dept,
        'unit'=>$this->U_unit,
        'wstation'=>$this->U_wstation,
        'ip'=>$this->U_ip,
        'vpn'=>$this->U_vpn
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
