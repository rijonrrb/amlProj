<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Country;
use App\Models\Itcus;
use App\Models\Dept;
use App\Models\Log;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use Illuminate\Http\Request;
class Countries extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedCountries'];
    public $checkedCountry = [];
    public $byDept =null;
    public $byDes =null;
    public $byWstat =null;
    public $perPage =20;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.countries',[
            'total_items'=> Country::select('item')->selectRaw('count(*) as count')->groupBy('item')->get(),
            'countries'=>Country::when($this->byDept,function($query){
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
//     public function OpenAddCountryModal(){
//         $this->user_name = '';
//         $this->desigation = '';
//         $this->dept = '';
//         $this->wstation = '';
//         $this->unit = '';
//         $this->item = '';
//         $this->laptop_name = '';
//         $this->asset_no = '';
//         $this->serial_no = '';
//         $this->previous_user = '';
//         $this->issue_date = '';
//         $this->p_issue_date = '';
//         $this->configuration = '';
//         $this->abc = '';
//         $this->H_user = '';
//         $this->H_designation = '';
//         $this->H_dept = '';
//         $this->H_wstation = '';
//         $this->H_unit = '';
//         $this->dispatchBrowserEvent('OpenAddCountryModal');
//     }
//     public function save(){
//         date_default_timezone_set('Asia/Dhaka');
//         $time =  date('d F Y h:i:s A');
//         $asst = substr($this->item, 0,3)."-".rand(100,1000)."-".rand(10000,1000000);
//         $next_id = uniqid('Igloo', true);
//        
//         Session::put('id', $next_id);
//         Session::put('b_area', 'Igloo');
        
//         $this->validate([
//             "user_name"=>"required",
//             "desigation"=>"required",
//             "dept"=>"required",
//             "wstation"=>"required"
//         ],
//         ['user_name.required'=>"The User Name field is required.",
//         'desigation.required'=>"The Designation field is required.",
//         'dept.required'=>"The Department field is required.",
//         'wstation.required'=>"The Work Station field is required."]
//     );
//         $save = Country::insert([
//           'user_name'=>$this->user_name,
//           'desigation'=>$this->desigation,
//           'dept'=>$this->dept,
//           'wstation'=>$this->wstation,
//           'unit'=>"Igloo Ice Cream Unit",
//           'item'=>$this->item,
//           'laptop_name'=>$this->laptop_name,
//           'asset_no'=> $asst,
//           'serial_no'=>$this->serial_no,
//           'previous_user'=>$this->previous_user,
//           'issue_date'=>$time,
//           'p_issue_date'=>$this->p_issue_date,
//           'configuration'=>$this->configuration,
//           'sid'=> $next_id,
//       ]);
//         if(Session::get('admin_type') == "Mod"){
//           Log::insert([
//             'name'=>Session::get('name'),
//             'email'=>Session::get('email'),
//             'activity'=>"Create",
//             'afield'=>"Igloo Ice Cream",
//             'time'=>$time,
//            
//         ]);
//       }
//       Invoice::insert([
//         'handedBy'=>$this->H_user,
//         'h_desigation'=>$this->H_designation,
//         'h_dept'=>$this->H_dept,
//         'h_wstation'=>$this->H_wstation,
//         'h_unit'=>"IT Unit",
//         'sid'=> $next_id,
//         'takenBy'=>$this->user_name,
//         't_desigation'=>$this->desigation,
//         't_dept'=>$this->dept,
//         't_wstation'=>$this->wstation,
//         't_unit'=>"Igloo Ice Cream Unit",
//         'remarks'=>'For Official use',
//         'qty'=>'1',
//         'laptop_name'=>$this->laptop_name,
//         'configuration'=>$this->configuration,
//         'asset_no'=>$this->asset_no,
//         'serial_no'=>$this->serial_no,
//         'business_area'=>'Igloo',
//     ]);
      
//       if(!empty($this->dept))
//       {
//         $dept = Dept::where('dept_name',$this->dept)->first();
        
//         if(!$dept)
//         {  
//             $saave = Dept::insert([
//                 'dept_name'=>$this->dept
//             ]);
//         }
//     }
//     if($save){
//         $this->dispatchBrowserEvent('CloseAddCountryModal');
//         $this->checkedCountry = [];
//     }
// }

// public function OpenReuseModal($id){
//     $info = Country::find($id);
//     $this->r_user_name = '';
//     $this->r_desigation = '';
//     $this->r_dept = '';
//     $this->r_unit = '';
//     $this->r_H_user = '';
//     $this->r_H_designation = '';
//     $this->r_H_dept = '';
//     $this->r_H_unit = '';
//     $this->rid = $info->id;
//     $this->dispatchBrowserEvent('OpenReuseModal',[
//         'id'=>$id
//     ]);
// }
// public function reuseProd(){

//     date_default_timezone_set('Asia/Dhaka');
//     $time =  date('d F Y h:i:s A');
//     $rid = $this->rid;
//     $info = Country::find($rid);
//     if (empty($info->previous_user))
//     {
//         $previous_user = $info->user_name;
//     }
//     elseif (empty($info->user_name))
//     {
//         $previous_user = $info->previous_user;
//     }
//     else
//     {
//         $previous_user = $info->previous_user."  ||  ".$info->user_name;
//     }
//     if (empty($info->p_issue_date))
//     {
//         $p_i_date = $info->issue_date;
//     }
//     elseif (empty($info->user_name))
//     {
//         $p_i_date = $info->p_issue_date;
//     }
//     else
//     {
//         $p_i_date = $info->p_issue_date."  ||  ".$info->issue_date;
//     }
//     Session::put('id', $info->sid);
//     Session::put('b_area', 'Igloo');
//     $this->validate([
//         "r_H_user"=>"required",
//         "r_H_designation"=>"required",
//         'r_H_dept'=>"required",
//         "r_H_unit"=>"required",
//         "r_user_name"=>"required",
//         "r_desigation"=>"required",
//         'r_dept'=>"required",
//         "r_unit"=>"required"
//     ],
//     ['r_H_user.required'=>"The User Name field is required.",
//     'r_H_designation.required'=>"The Designation field is required.",
//     'r_H_dept.required'=>"The Department field is required.",
//     'r_H_unit.required'=>"The Unit field is required.",
//     'r_user_name.required'=>"The User Name field is required.",
//     'r_desigation.required'=>"The Designation field is required.",
//     'r_dept.required'=>"The Department field is required.",
//     'r_unit.required'=>"The Unit field is required."]
// );
//     $update = Country::find($rid)->update([
//         'user_name'=>$this->r_user_name,
//         'desigation'=>$this->r_desigation,
//         'dept'=>$this->r_dept,
//         'unit'=>$this->r_unit,
//         'previous_user'=>$previous_user,
//         'issue_date'=>$time,
//         'p_issue_date'=>$p_i_date,
//     ]);
//     $savex = Invoice::where('sid',$info->sid)->update([
//       'handedBy'=>$this->r_H_user,
//       'h_desigation'=>$this->r_H_designation,
//       'h_dept'=>$this->r_H_dept,
//       'h_unit'=>"IT Unit",
//       'takenBy'=>$this->r_user_name,
//       't_desigation'=>$this->r_desigation,
//       't_dept'=>$this->r_dept,
//       't_unit'=>$this->r_unit,
//       'remarks'=>'For Official use',
//       'qty'=>'1',
//       'business_area'=>'Igloo',
//   ]);
//     if(!empty($this->r_dept))
//     {
//         $deptT = Dept::where('dept_name',$this->r_dept)->first();
//         if(!$deptT)
//         {  
//             $saave= Dept::insert([
//                 'dept_name'=>$this->r_dept
//             ]);
//         }
//     }
//     if(!empty($this->r_H_dept))
//     {
//         $deptH = Dept::where('dept_name',$this->r_H_dept)->first();
//         if(!$deptH)
//         {  
//             $saave= Dept::insert([
//                 'dept_name'=>$this->r_H_dept
//             ]);
//         }
//     }
//     if($savex){
//         $this->dispatchBrowserEvent('CloseReuseModal');
//         $this->checkedCountry = [];
//     }
// }

public function OpenReturnCountryModal($id){
    $info = Country::find($id);
    $this->upd_H_user = '';
    $this->upd_H_designation = '';
    $this->upd_H_dept = 'IT';
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
    $info = Country::find($cid);
   
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
    Session::put('b_area', 'Igloo');
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
            'afield'=>"Igloo Ice Cream",
            'time'=>$timeLog,
           
        ]);
    }
    $savex = Invoice::where('sid',$info->sid)->update([
        'handedBy'=>$info->user_name,
        'h_desigation'=>$info->desigation,
        'h_dept'=> $info->dept,
        'h_wstation'=> $info->wstation,
        'h_unit'=>"Igloo Ice Cream Unit",
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
        'business_area'=>'Igloo',
    ]);
    if($savex){
        $del =  Country::find($cid)->delete();
        $this->dispatchBrowserEvent('CloseReturnCountryModal');
        $this->checkedCountry = [];
    }
}
public function OpenEditModal($id){
    $info = Country::find($id);
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
   
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    $update = Country::find($cid)->update([
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
        'afield'=>"Igloo Ice Cream",
        'time'=>$time,
       
    ]);
  }
  if($update){
    $this->dispatchBrowserEvent('CloseEditModal');
    $this->checkedCountry = [];
}
}

public function deleteConfirm($id){
    $info = Country::find($id);
    $this->dispatchBrowserEvent('SwalConfirm',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this?',
        'id'=>$id
    ]);
}
public function delete($id){
    $del =  Country::find($id)->delete();
   
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
            'afield'=>"Igloo Ice Cream",
            'time'=>$time,
           
        ]);
    }
    $this->checkedCountry = [];
}
public function deleteCountries(){
    $this->dispatchBrowserEvent('swal:deleteCountries',[
        'title'=>'Are you sure?',
        'html'=>'You want to <strong>delete</strong> this rows',
        'checkedIDs'=>$this->checkedCountry,
    ]);
}
public function deleteCheckedCountries($ids){
    Country::whereKey($ids)->delete();
   
    date_default_timezone_set('Asia/Dhaka');
    $time =  date('d F Y h:i:s A');
    if(Session::get('admin_type') == "Mod"){
        Log::insert([
            'name'=>Session::get('name'),
            'email'=>Session::get('email'),
            'activity'=>"Delete",
            'afield'=>"Igloo Ice Cream",
            'time'=>$time,
           
        ]);
    } 
    $this->checkedCountry = [];
}
public function isChecked($countryId){
    return in_array($countryId, $this->checkedCountry) ? 'bg-info text-white' : '';
}
}