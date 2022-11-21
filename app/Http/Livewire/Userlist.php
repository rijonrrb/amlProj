<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Userslist;
use App\Models\Suger;
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
    protected $listeners = ['delete','deleteCheckedSugers'];
    public $checkedSuger = [];
    public $byDept =null;
    public $byDes =null;
    public $byWstat =null;
    
    public $byUid =null;
    public $byPid =null;
    public $byIp =null;
    public $byVpn =null;

    public $perPage =20;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
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
    public function OpenAddSugerModal(){
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
        $this->dispatchBrowserEvent('OpenAddSugerModal');
    }
    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $ip = file_get_contents('https://api.ipify.org/?format=text');
        $next_id = uniqid('Sugar', true);
        Session::put('id', $next_id);
        Session::put('b_area', 'Sugar');
        
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
        $save = Suger::insert([
          'user_name'=>$this->user_name,
          'desigation'=>$this->desigation,
          'dept'=>$this->dept,
          'wstation'=>$this->wstation,
          'unit'=>"AML Sugar Refinery Unit",
          'item'=>$this->item,
          'laptop_name'=>$this->laptop_name,
          'asset_no'=>$this->asset_no,
          'serial_no'=>$this->serial_no,
          'previous_user'=>$this->previous_user,
          'issue_date'=>$time,
          'p_issue_date'=>$this->p_issue_date,
          'configuration'=>$this->configuration,
          'sid'=> $next_id,
      ]);
        if(Session::get('admin_type') == "Mod"){
          Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Create",
            'afield'=>"AML Sugar Refinery",
            'time'=>$time,
            'ip'=> $ip,
        ]);
      }
      Invoice::insert([
        'handedBy'=>$this->H_user,
        'h_desigation'=>$this->H_designation,
        'h_dept'=>$this->H_dept,
        'h_wstation'=>$this->H_wstation,
        'h_unit'=>"IT Unit",
        'sid'=> $next_id,
        'takenBy'=>$this->user_name,
        't_desigation'=>$this->desigation,
        't_dept'=>$this->dept,
        't_wstation'=>$this->wstation,
        't_unit'=>"AML Sugar Refinery Unit",
        'remarks'=>'For Official use',
        'qty'=>'1',
        'laptop_name'=>$this->laptop_name,
        'configuration'=>$this->configuration,
        'asset_no'=>$this->asset_no,
        'serial_no'=>$this->serial_no,
        'business_area'=>'Sugar',
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

public function OpenEditModal($id){
    $info = Suger::find($id);

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
    $update = Suger::find($cid)->update([
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
            'afield'=>"AML Sugar Refinery",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    if($update){
        $this->dispatchBrowserEvent('CloseEditModal');
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
            'afield'=>"AML Sugar Refinery",
            'time'=>$time,
            'ip'=> $ip,
        ]);
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
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"AML Sugar Refinery",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedSuger = [];
}
public function isChecked($SugerId){
    return in_array($SugerId, $this->checkedSuger) ? 'bg-info text-white' : '';
}
}
