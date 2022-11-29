<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Suger;
use App\Models\Itcus;
use App\Models\Userslist;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ipaddress extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedFoods'];
    public $checkedFood = [];
    public $byDept =null;
    public $byDes =null;
    public $byWstat =null;
    public $perPage =20;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.ipaddress',[
            'total_items'=> Food::select('item')->selectRaw('count(*) as count')->groupBy('item')->get(),
            'Foods'=>Food::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })->when($this->byDes,function($query){
                $query->where('desigation',$this->byDes);
            })->when($this->byWstat,function($query){
                $query->where('wstation',$this->byWstat);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }
    
public function OpenReturnCountryModal($id){
    $info = Food::find($id);
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
    $time =  date('d F Y');
    $timeLog =date('d F Y h:i:s A');
    $cid = $this->cid;
    $info = Food::find($cid);
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    if (empty($info->previous_user))
    {
        $previous_user = $info->user_name."#".$info->userid;
    }
    elseif (empty($info->user_name))
    {
        $previous_user = $info->previous_user;
    }
    else
    {
        $previous_user = $info->previous_user."  ||  ".$info->user_name."#".$info->userid;;
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
    Session::put('b_area', 'Food');
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
        'item'=>$info->item,
        'laptop_name'=> $info->laptop_name,
        'asset_no'=> $info->asset_no,
        'serial_no'=>$info->serial_no,
        'previous_user'=>$previous_user,
        'entry_date'=>$info->entry_date,
        'p_issue_date'=>$p_i_date,
        'configuration'=>$info->configuration,
        'condition'=>$this->upd_H_condition,
        'warrenty_start'=>$info->warrenty_start,
        'warrenty_end'=>$info->warrenty_end,
        'sid'=>$info->sid
    ]);
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Return Product",
            'afield'=>"Igloo Foods",
            'time'=>$timeLog,
            'ip'=> $ip,
        ]);
    }
    $savex = Invoice::where('sid',$info->sid)->update([
        'handedBy'=>$info->user_name,
        'h_desigation'=>$info->desigation,
        'h_dept'=> $info->dept,
        'h_wstation'=> $info->wstation,
        'h_unit'=>"Igloo Foods Unit",
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
        'business_area'=>'Food',
    ]);
    if($savex){
        $del =  Food::find($cid)->delete();
        $this->dispatchBrowserEvent('CloseReturnCountryModal');
        $this->checkedFood = [];
    }
}

public function OpenEditModal($id){
    $info = Food::find($id);
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
    $this->U_vendor = $info->vendor;
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
    $update = Food::find($cid)->update([
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
        'configuration'=>$this->U_configuration,
        'vendor'=>$this->U_vendor
    ]);
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Update",
            'afield'=>"Igloo Foods",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    if($update){
        $this->dispatchBrowserEvent('CloseEditModal');
        $this->checkedFood = [];
    }
}
public function deleteConfirm($id){
    $info = Food::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
        'id'=>$id
    ]);
}
public function delete($id){
    $del =  Food::find($id)->delete();
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
            'afield'=>"Igloo Foods",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedFood = [];
}
public function deleteFoods(){
    $this->dispatchBrowserEvent('swal:deleteFoods',[
        'title'=>'Are you sure?',
        'html'=>'You want to delete this items',
        'checkedIDs'=>$this->checkedFood,
    ]);
}
public function deleteCheckedFoods($ids){
    Food::whereKey($ids)->delete();
    $ip = file_get_contents('https://api.ipify.org/?format=text');
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"Igloo Foods",
            'time'=>$time,
            'ip'=> $ip,
        ]);
    }
    $this->checkedFood = [];
}
public function isChecked($FoodId){
    return in_array($FoodId, $this->checkedFood) ? 'bg-info text-white' : '';
}

}
