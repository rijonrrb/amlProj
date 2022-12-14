<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Itcus;
use App\Models\Country;
use App\Models\Construction;
use App\Models\Food;
use App\Models\Beverage;
use App\Models\Branoil;
use App\Models\Dairy;
use App\Models\Dredging;
use App\Models\Suger;
use App\Models\Dept;
use App\Models\Userslist;
use App\Models\Log;
use Carbon\Carbon;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Invoice;
class Custudys extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedItcuss'];
    public $checkedItcus = [];
    public $byWarrenty =null;
    public $byPtype =null;
    public $byPcond =null;
    public $perPage =20;
    public $orderBy = "item";
    public $sortBy = "asc";
    public $search;



    public function render()
    {

        return view('livewire.custudys',[
            'Userlists'=>Userslist::orderBy('name','asc')->get(),
            'Warrenty' => $this->byWarrenty,
            'total_items'=> Itcus::select('item')->selectRaw('count(*) as count')->groupBy('item')->get(),
            'Itcuss'=>Itcus::when($this->byPtype,function($query){
                $query->where('item',$this->byPtype);
            })->when($this->byPcond,function($query){
                $query->where('condition',$this->byPcond);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }
    public function OpenAddItcusModal(){

        $this->item = '';
        $this->laptop_name = '';
        $this->serial_no = '';
        $this->configuration = '';
        $this->condition = '';
        $this->previous_user = '';
        $this->p_issue_date = '';
        $this->vendor = '';
        $this->warrenty_start = '';
        $this->warrenty_end = '';
        $this->dispatchBrowserEvent('OpenAddItcusModal');
    }
    public function save(){

        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        if($this->warrenty_end == 0 )
        {
            $days = $this->warrenty_end;
        }
        elseif($this->warrenty_end == '' )
        {
            $days = Null;
        }
        else
        {
            $days = $this->warrenty_end -1;
        }   
        $Date = $this->warrenty_start;
        if($this->warrenty_end == '' )
        {
            $expire = Null;
        }    
        else
        {
            $expire = date('d-M-Y', strtotime($Date. '+'.$days.'days'));
        }
        $asst = substr($this->item, 0,3)."-".rand(100,1000)."-".rand(10000,1000000);
        $next_id = uniqid('CUSTUDY', true);
       
        Session::put('id', $next_id);
        Session::put('b_area', 'CUSTUDY');
        $this->validate([
            "item"=>"required",
            "laptop_name"=>"required",
            "serial_no"=>"required",
            "condition"=>"required"
        ],
        ['item.required'=>"Product Type field is required.",
        'laptop_name.required'=>"Product Model field is required.",
        'serial_no.required'=>"Product S/N field is required.",
        'condition.required'=>"Product condition is required."]
       );
       if($this->warrenty_start == '' )
       {
           $Sdays = Null;
       }
       else
       {
           $Sdays = date('d-M-Y', strtotime($this->warrenty_start));
       } 
        $save = Itcus::insert([
            'item'=>$this->item,
            'laptop_name'=>$this->laptop_name,
            'asset_no'=>$asst,
            'serial_no'=>$this->serial_no,
            'previous_user'=>$this->previous_user,
            'entry_date'=>$time,
            'p_issue_date'=>$this->p_issue_date,
            'configuration'=>$this->configuration,
            'condition'=>$this->condition,
            'warrenty_start'=>$Sdays,
            'warrenty_end'=> $expire,
            'vendor'=>$this->vendor,
            'sid'=> $next_id,

        ]);
        if(Session::get('admin_type') == "Mod"){
          Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Create",
            'afield'=>"IT Store",
            'time'=>$time,
           
        ]);
      }
      if($save){
        $this->dispatchBrowserEvent('CloseAddItcusModal');
        $this->checkedItcus = [];
    }
}

    public function OpenEditModal($id){
        $info = Itcus::find($id);

        $this->UI_unit = $info->unit;
        $this->UI_item = $info->item;
        $this->UI_laptop_name = $info->laptop_name;
        $this->UI_serial_no = $info->serial_no;
        $this->UI_P_user = $info->previous_user;
        $this->UI_I_date = $info->issue_date;
        $this->UI_P_I_date = $info->p_issue_date;
        $this->UI_configuration = $info->configuration;
        if(empty($info->warrenty_start))
        {
            $this->UI_w_start = $info->warrenty_start;
        }
        else {
            $this->UI_w_start = date('d/m/Y', strtotime($info->warrenty_start));
        }
        if(empty($info->warrenty_end))
        {
            $this->UI_w_end = $info->warrenty_end;
        }
        else {
            $this->UI_w_end = date('d/m/Y', strtotime($info->warrenty_end));
        }
        $this->UI_vendor = $info->vendor;
        $this->UI_condition = $info->condition;
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenEditModal',[
            'id'=>$id
        ]);
    }

    public function updateItem(){
        $cid = $this->cid;
       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $update = Itcus::find($cid)->update([

            'unit'=>$this->UI_unit,
            'item'=>$this->UI_item,
            'laptop_name'=>$this->UI_laptop_name,
            'serial_no'=>$this->UI_serial_no,
            'previous_user'=>$this->UI_P_user,
            'issue_date'=>$this->UI_I_date,
            'p_issue_date'=>$this->UI_P_I_date,
            'configuration'=>$this->UI_configuration,
            'condition'=>$this->UI_condition,
            'warrenty_start'=>date('d-M-Y', strtotime($this->UI_w_start)),
            'warrenty_end'=>date('d-M-Y', strtotime($this->UI_w_end)),
            'vendor'=>$this->UI_vendor
        ]);
        if(Session::get('admin_type') == "Mod"){
            Log::insert([
                'name'=>Session::get('name'),
                'email'=>Session::get('email'),
                'activity'=>"Update",
                'afield'=>"IT Store",
                'time'=>$time,
               
            ]);
        }
        if($update){
            $this->dispatchBrowserEvent('CloseEditModal');
            $this->checkedItcus = [];
        }
    }

public function OpenReuseModal($id){
    $info = Itcus::find($id);
    $this->r_user = '';
    $this->r_H_user = '';
    $this->r_H_designation = '';
    $this->r_H_dept = 'IT';
    $this->r_H_wstation = '';
    $this->rid = $info->id;
    $this->dispatchBrowserEvent('OpenReuseModal',[
        'id'=>$id
    ]);
}
public function reuseProd(){
    $this->validate([
        "r_user"=>"required",
        "r_H_user"=>"required",
        "r_H_designation"=>"required",
        "r_H_dept"=>"required",
        "r_H_wstation"=>"required"
    ],
    ['r_user.required'=>"The User field is required.",
    'r_H_user.required'=>"The User Name field is required.",
    'r_H_designation.required'=>"The Designation field is required.",
    'r_H_dept.required'=>"The Department field is required.",
    'r_H_wstation.required'=>"The Work Station field is required."]
);       
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y');
    $user = $this->r_user;
    $timeLog =date('d F Y h:i:s A');
   
    $rid = $this->rid;
    $info = Itcus::find($rid);
    $userinfo = Userslist::where('userid',$this->r_user)->first();
    if (empty($info->previous_user))
    {
        $previous_user = '';
    }
    else
    {
        $previous_user = $info->previous_user;
    }
    if (empty($info->p_issue_date))
    {
        $p_i_date = '';
    }
    else
    {
        $p_i_date = $info->p_issue_date;
    }
    if (empty($userinfo->asset_no))
    {
        $assetno = $info->asset_no;
    }
    else
    {
        $assetno = $userinfo->asset_no."  ||  ".$info->asset_no;
    }
    if (empty($userinfo->asset_id))
    {
        $assetid = $info->id;
    }
    else
    {
        $assetid = $userinfo->asset_id."  ||  ".$info->id;
    }
    Session::put('id', $info->sid);
    Session::put('b_area', 'CUSTUDY');
    //Data Inserted Igloo Ice Cream Unit
    if($userinfo->unit == "Igloo Ice Cream Unit")
    {
        $update = Country::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted AML Beverage Unit
    elseif($userinfo->unit == "AML Beverage Unit")
    {
        $update = Beverage::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted AML Sugar Refinery Unit
    elseif($userinfo->unit == "AML Sugar Refinery Unit")
    {
        $update = Suger::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted AML Construction Unit
    elseif($userinfo->unit == "AML Construction Unit")
    {
        $update = Construction::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted Igloo Foods Unit
    elseif($userinfo->unit == "Igloo Foods Unit")
    {
        $update = Food::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted Igloo Dairy Unit
    elseif($userinfo->unit == "Igloo Dairy Unit")
    {
        $update = Dairy::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted AML Dredging Unit
    elseif($userinfo->unit == "AML Dredging Unit")
    {
        $update = Dredging::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }
    //Data Inserted AML Bran Oil Unit
    elseif($userinfo->unit == "AML Bran Oil Unit")
    {
        $update = Branoil::insert([
            'user_name'=>$userinfo->name,
            'userid'=>$userinfo->userid,
            'desigation'=>$userinfo->desigation,
            'dept'=>$userinfo->dept,
            'wstation'=>$userinfo->wstation,
            'unit'=>$userinfo->unit,
            'item'=>$info->item,
            'laptop_name'=>$info->laptop_name,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'entry_date'=>$info->entry_date,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration,
            'warrenty_start'=>$info->warrenty_start,
            'warrenty_end'=>$info->warrenty_end,
            'vendor'=>$info->vendor,
            'sid'=> $info->sid,
        ]);
    }


    if(empty($info->previous_user))
    {
        $savex = Invoice::insert([
            'handedBy'=>$this->r_H_user,
            'h_desigation'=>$this->r_H_designation,
            'h_dept'=>$this->r_H_dept,
            'h_wstation'=>$this->r_H_wstation,
            'h_unit'=>"IT Unit",
            'takenBy'=>$userinfo->name,
            't_desigation'=>$userinfo->desigation,
            't_dept'=>$userinfo->dept,
            't_wstation'=>$userinfo->wstation,
            't_unit'=>$userinfo->unit,
            'remarks'=>'For Official use',
            'qty'=>'1',
            'laptop_name'=>$info->laptop_name,
            'configuration'=>$info->configuration,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'business_area'=>'CUSTUDY',
            'sid'=>$info->sid,
        ]);
    }
    else
    {
        $savex = Invoice::where('sid',$info->sid)->update([
            'handedBy'=>$this->r_H_user,
            'h_desigation'=>$this->r_H_designation,
            'h_dept'=>$this->r_H_dept,
            'h_wstation'=>$this->r_H_wstation,
            'h_unit'=>"IT Unit",
            'takenBy'=>$userinfo->name,
            't_desigation'=>$userinfo->desigation,
            't_dept'=>$userinfo->dept,
            't_wstation'=>$userinfo->wstation,
            't_unit'=>$userinfo->unit,
            'remarks'=>'For Official use',
            'qty'=>'1',
            'business_area'=>'CUSTUDY',
        ]);
    }

    Userslist::where('userid',$userinfo->userid)->update([
        'asset_id'=>$assetid,
        'asset_no'=>$assetno,

    ]);
    
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Issue",
            'afield'=>"IT Store",
            'time'=>$timeLog,
           
        ]);
    }

    if($savex){
        $del =  Itcus::find($rid)->delete();
        $this->dispatchBrowserEvent('CloseReuseModal');
        $this->checkedItcus = [];
    }
}
public function deleteConfirm($id){
    $info = Itcus::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this?',
        'id'=>$id
    ]);
}
public function delete($id){
    $del =  Itcus::find($id)->delete();
   
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
            'afield'=>"IT Store",
            'time'=>$time,
           
        ]);
    }
    $this->checkedItcus = [];
}
public function deleteItcuss(){
    $this->dispatchBrowserEvent('swal:deleteItcuss',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this rows',
        'checkedIDs'=>$this->checkedItcus,
    ]);
}
public function deleteCheckedItcuss($ids){
    Itcus::whereKey($ids)->delete();
   
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"IT Store",
            'time'=>$time,
           
        ]);
    }
    $this->checkedItcus = [];
}
public function isChecked($ItcusId){
    return in_array($ItcusId, $this->checkedItcus) ? 'bg-info text-white' : '';
}
}
