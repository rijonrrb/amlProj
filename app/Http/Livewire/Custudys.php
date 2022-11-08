<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Itcus;
use App\Models\Country;
use App\Models\Construction;
use App\Models\Food;
use App\Models\Beverage;
use App\Models\Suger;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
class Custudys extends Component
{
    use WithPagination;
    protected $listeners = ['delete','deleteCheckedItcuss'];
    public $checkedItcus = [];
    public $byDept =null;
    public $perPage =20;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.custudys',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Itcuss'=>Itcus::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
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
        $this->previous_user = '';
        $this->p_issue_date = '';
        $this->dispatchBrowserEvent('OpenAddItcusModal');
    }
    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $asst = substr($this->item, 0,3)."-".rand(100,1000)."-".rand(10000,1000000);
        $next_id = uniqid('CUSTUDY', true);
        Session::put('id', $next_id);
        Session::put('b_area', 'CUSTUDY');
        $this->validate([
            "item"=>"required",
            "laptop_name"=>"required",
            'serial_no'=>"required",
            "configuration"=>"required"
        ],
        ['item.required'=>"Product Type field is required.",
        'laptop_name.required'=>"Product Model field is required.",
        'serial_no.required'=>"Product S/N field is required.",
        'configuration.required'=>"Configuration / Accessories field is required."]
    );
        $save = Itcus::insert([
            'user_name'=>Null,
            'desigation'=>Null,
            'dept'=>Null,
            'unit'=>Null,
            'item'=>$this->item,
            'laptop_name'=>$this->laptop_name,
            'asset_no'=>$asst,
            'serial_no'=>$this->serial_no,
            'previous_user'=>$this->previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$this->p_issue_date,
            'configuration'=>$this->configuration,
            'sid'=> $next_id,

      ]);

        if($save){
            $this->dispatchBrowserEvent('CloseAddItcusModal');
            $this->checkedItcus = [];
        }
    }
    public function OpenReturnCountryModal($id){
        $info = Itcus::find($id);
        $this->upd_H_user = '';
        $this->upd_H_designation = '';
        $this->upd_H_dept = '';
        $this->upd_H_unit = '';
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenReturnCountryModal',[
            'id'=>$id
        ]);
    }
    public function update(){
       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $cid = $this->cid;
        $info = Itcus::find($cid);
        if (empty($info->previous_user))
        {
            $previous_user = $info->user_name;
        }
        elseif (empty($info->user_name))
        {
            $previous_user = $info->previous_user;
        }
        else
        {
            $previous_user = $info->previous_user."  ||  ".$info->user_name;
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
        Session::put('b_area', 'CUSTUDY');
        $this->validate([
            "upd_H_user"=>"required",
            "upd_H_designation"=>"required",
            'upd_H_dept'=>"required",
            "upd_H_unit"=>"required"
        ],
        ['upd_H_user.required'=>"The User Name field is required.",
        'upd_H_designation.required'=>"The Designation field is required.",
        'upd_H_dept.required'=>"The Department field is required.",
        'upd_H_unit.required'=>"The Unit field is required."]
    );
        $update = Itcus::find($cid)->update([
            'user_name'=>Null,
            'desigation'=>Null,
            'dept'=>Null,
            'unit'=>Null,
            'item'=>$info->item,
            'laptop_name'=> $info->laptop_name,
            'asset_no'=> $info->asset_no,
            'serial_no'=>$info->serial_no,
            'previous_user'=>$previous_user,
            'issue_date'=>$time,
            'p_issue_date'=>$p_i_date,
            'configuration'=>$info->configuration
        ]);
        $savex = Invoice::where('sid',$info->sid)->update([
            'handedBy'=>$info->user_name,
            'h_desigation'=>$info->desigation,
            'h_dept'=> $info->dept,
            'h_unit'=>$info->unit,
            'takenBy'=>$this->upd_H_user,
            't_desigation'=>$this->upd_H_designation,
            't_dept'=>$this->upd_H_dept,
            't_unit'=>$this->upd_H_unit,
            'remarks'=>'Return Product',
            'qty'=>'1',
            'laptop_name'=>$info->laptop_name,
            'configuration'=>$info->configuration,
            'asset_no'=>$info->asset_no,
            'serial_no'=>$info->serial_no,
            'business_area'=>'CUSTUDY',
        ]);
        if($savex){
            $this->dispatchBrowserEvent('CloseReturnCountryModal');
            $this->checkedItcus = [];
        }
    }
    public function OpenReuseModal($id){
        $info = Itcus::find($id);
        $this->r_user_name = '';
        $this->r_desigation = '';
        $this->r_dept = '';
        $this->r_unit = '';
        $this->r_H_user = '';
        $this->r_H_designation = '';
        $this->r_H_dept = '';
        $this->r_H_unit = '';
        $this->rid = $info->id;
        $this->dispatchBrowserEvent('OpenReuseModal',[
            'id'=>$id
        ]);
    }
    public function reuseProd(){
       
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $rid = $this->rid;
        $info = Itcus::find($rid);
        if (empty($info->previous_user) && empty($info->user_name))
        {
            $previous_user = '';
        }
        elseif (empty($info->previous_user) && !empty($info->user_name))
        {
            $previous_user = $info->user_name;
        }
        elseif (empty($info->user_name))
        {
            $previous_user = $info->previous_user;
        }
        else
        {
            $previous_user = $info->previous_user."  ||  ".$info->user_name;
        }

        if (empty($info->p_issue_date) && empty($info->user_name))
        {
            $p_i_date = '';
        }
        elseif (empty($info->p_issue_date) && !empty($info->user_name))
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
        Session::put('b_area', 'CUSTUDY');
        $this->validate([
            "r_H_user"=>"required",
            "r_H_designation"=>"required",
            'r_H_dept'=>"required",
            "r_H_unit"=>"required",
            "r_user_name"=>"required",
            "r_desigation"=>"required",
            'r_dept'=>"required",
            "r_unit"=>"required"
        ],
        ['r_H_user.required'=>"The User Name field is required.",
        'r_H_designation.required'=>"The Designation field is required.",
        'r_H_dept.required'=>"The Department field is required.",
        'r_H_unit.required'=>"The Unit field is required.",
        'r_user_name.required'=>"The User Name field is required.",
        'r_desigation.required'=>"The Designation field is required.",
        'r_dept.required'=>"The Department field is required.",
        'r_unit.required'=>"The Unit field is required."]
    );
        if($this->r_unit == "Igloo Ice Cream Unit")
        {
            $update = Country::insert([
                'user_name'=>$this->r_user_name,
                'desigation'=>$this->r_desigation,
                'dept'=>$this->r_dept,
                'unit'=>$this->r_unit,
                'item'=>$info->item,
                'laptop_name'=>$info->laptop_name,
                'asset_no'=>$info->asset_no,
                'serial_no'=>$info->serial_no,
                'previous_user'=>$previous_user,
                'issue_date'=>$time,
                'p_issue_date'=>$p_i_date,
                'configuration'=>$info->configuration,
                'sid'=> $info->sid,
            ]);
        }
        elseif($this->r_unit == "AML Beverage Unit")
        {
            $update = Beverage::insert([
                'user_name'=>$this->r_user_name,
                'desigation'=>$this->r_desigation,
                'dept'=>$this->r_dept,
                'unit'=>$this->r_unit,
                'item'=>$info->item,
                'laptop_name'=>$info->laptop_name,
                'asset_no'=>$info->asset_no,
                'serial_no'=>$info->serial_no,
                'previous_user'=>$previous_user,
                'issue_date'=>$time,
                'p_issue_date'=>$p_i_date,
                'configuration'=>$info->configuration,
                'sid'=> $info->sid,
            ]);
        }
        elseif($this->r_unit == "AML Sugar Refinery Unit")
        {
            $update = Suger::insert([
                'user_name'=>$this->r_user_name,
                'desigation'=>$this->r_desigation,
                'dept'=>$this->r_dept,
                'unit'=>$this->r_unit,
                'item'=>$info->item,
                'laptop_name'=>$info->laptop_name,
                'asset_no'=>$info->asset_no,
                'serial_no'=>$info->serial_no,
                'previous_user'=>$previous_user,
                'issue_date'=>$time,
                'p_issue_date'=>$p_i_date,
                'configuration'=>$info->configuration,
                'sid'=> $info->sid,
            ]);
        }
        elseif($this->r_unit == "AML Construction Unit")
        {
            $update = Construction::insert([
                'user_name'=>$this->r_user_name,
                'desigation'=>$this->r_desigation,
                'dept'=>$this->r_dept,
                'unit'=>$this->r_unit,
                'item'=>$info->item,
                'laptop_name'=>$info->laptop_name,
                'asset_no'=>$info->asset_no,
                'serial_no'=>$info->serial_no,
                'previous_user'=>$previous_user,
                'issue_date'=>$time,
                'p_issue_date'=>$p_i_date,
                'configuration'=>$info->configuration,
                'sid'=> $info->sid,
            ]);
        }
        elseif($this->r_unit == "Igloo Foods Unit")
        {
            $update = Food::insert([
                'user_name'=>$this->r_user_name,
                'desigation'=>$this->r_desigation,
                'dept'=>$this->r_dept,
                'unit'=>$this->r_unit,
                'item'=>$info->item,
                'laptop_name'=>$info->laptop_name,
                'asset_no'=>$info->asset_no,
                'serial_no'=>$info->serial_no,
                'previous_user'=>$previous_user,
                'issue_date'=>$time,
                'p_issue_date'=>$p_i_date,
                'configuration'=>$info->configuration,
                'sid'=> $info->sid,
            ]);
        }
        if(empty($info->previous_user) && empty($info->user_name))
        {
            $savex = Invoice::insert([
                'handedBy'=>$this->r_H_user,
                'h_desigation'=>$this->r_H_designation,
                'h_dept'=>$this->r_H_dept,
                'h_unit'=>"IT Unit",
                'takenBy'=>$this->r_user_name,
                't_desigation'=>$this->r_desigation,
                't_dept'=>$this->r_dept,
                't_unit'=>$this->r_unit,
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
                'h_unit'=>"IT Unit",
                'takenBy'=>$this->r_user_name,
                't_desigation'=>$this->r_desigation,
                't_dept'=>$this->r_dept,
                't_unit'=>$this->r_unit,
                'remarks'=>'For Official use',
                'qty'=>'1',
                'business_area'=>'CUSTUDY',
            ]);
        }

        if(!empty($this->r_dept))
        {
            $deptT = Dept::where('dept_name',$this->r_dept)->first();
            if(!$deptT)
            {  
                $saave= Dept::insert([
                    'dept_name'=>$this->r_dept
                ]);
            }
        }
        if(!empty($this->r_H_dept))
        {
            $deptH = Dept::where('dept_name',$this->r_H_dept)->first();
            if(!$deptH)
            {  
                $saave= Dept::insert([
                    'dept_name'=>$this->r_H_dept
                ]);
            }
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
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }
    public function delete($id){
        $del =  Itcus::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedItcus = [];
    }
    public function deleteItcuss(){
        $this->dispatchBrowserEvent('swal:deleteItcuss',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedItcus,
        ]);
    }
    public function deleteCheckedItcuss($ids){
        Itcus::whereKey($ids)->delete();
        $this->checkedItcus = [];
    }
    public function isChecked($ItcusId){
        return in_array($ItcusId, $this->checkedItcus) ? 'bg-info text-white' : '';
    }
}
