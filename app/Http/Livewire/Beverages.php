<?php


namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Beverage;
use App\Models\Dept;
use Livewire\WithPagination;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class Beverages extends Component
{

    use WithPagination;
    protected $listeners = ['delete','deleteCheckedBeverages'];
    public $checkedBeverage = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.beverages',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'Beverages'=>Beverage::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddBeverageModal(){

        $this->user_name = '';
        $this->desigation = '';
        $this->dept = '';
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
        $this->H_unit = '';
        $this->dispatchBrowserEvent('OpenAddBeverageModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');
        $id=DB::select("SHOW TABLE STATUS LIKE 'beverages'");
        $next_id=$id[0]->Auto_increment;
        Session::put('id', $next_id);

        $save = Beverage::insert([

              'user_name'=>$this->user_name,
              'desigation'=>$this->desigation,
              'dept'=>$this->dept,
              'unit'=>$this->unit,
              'item'=>$this->item,
              'laptop_name'=>$this->laptop_name,
              'asset_no'=>$this->asset_no,
              'serial_no'=>$this->serial_no,
              'previous_user'=>$this->previous_user,
              'issue_date'=>$time,
              'p_issue_date'=>$this->p_issue_date,
              'configuration'=>$this->configuration,
        ]);

        Invoice::insert([

            'handedBy'=>$this->H_user,
            'h_desigation'=>$this->H_designation,
            'h_dept'=>$this->H_dept,
            'h_unit'=>$this->H_unit,
            't_id'=> $next_id,
            'takenBy'=>$this->user_name,
            't_desigation'=>$this->desigation,
            't_dept'=>$this->dept,
            't_unit'=>$this->unit,
            'remarks'=>'For Official use',
            'qty'=>'1',
            'laptop_name'=>$this->laptop_name,
            'configuration'=>$this->configuration,
            'asset_no'=>$this->asset_no,
            'serial_no'=>$this->serial_no,
            'business_area'=>'Igloo CHO',
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
            $this->dispatchBrowserEvent('CloseAddBeverageModal');
            $this->checkedBeverage = [];
        }
    }

    public function OpenEditBeverageModal($id){
        $info = Beverage::find($id);

        $this->upd_user_name = $info->user_name;
        $this->upd_desigation = $abc;
        $this->upd_dept = $info->dept;
        $this->upd_unit = $info->unit;
        $this->upd_item = $info->item;
        $this->upd_laptop_name = $info->laptop_name;
        $this->upd_asset_no = $info->asset_no;
        $this->upd_serial_no = $info->serial_no;
        $this->upd_previous_user = $info->previous_user;
        $this->upd_issue_date = $info->issue_date;
        $this->upd_configuration = $info->configuration;
        $this->cid = $info->id;
        $this->dispatchBrowserEvent('OpenEditBeverageModal',[
            'id'=>$id
        ]);
    }

    public function update(){
        $cid = $this->cid;

        $update = Beverage::find($cid)->update([
            'user_name'=>$this->upd_user_name,
            'desigation'=>$this->upd_desigation,
            'dept'=>$this->upd_dept,
            'unit'=>$this->upd_unit,
            'item'=>$this->upd_item,
            'laptop_name'=>$this->upd_laptop_name,
            'asset_no'=>$this->upd_asset_no,
            'serial_no'=>$this->upd_serial_no,
            'previous_user'=>$this->upd_previous_user,
            'issue_date'=>$this->upd_issue_date,
            'configuration'=>$this->upd_configuration
        ]);

        if($update){
            $this->dispatchBrowserEvent('CloseEditBeverageModal');
            $this->checkedBeverage = [];
        }
    }
    

    public function deleteConfirm($id){
        $info = Beverage::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id){
        $del =  Beverage::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedBeverage = [];
    }

    public function deleteBeverages(){
        $this->dispatchBrowserEvent('swal:deleteBeverages',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedBeverage,
        ]);
    }
    public function deleteCheckedBeverages($ids){
        Beverage::whereKey($ids)->delete();
        $this->checkedBeverage = [];
    }

    public function isChecked($BeverageId){
        return in_array($BeverageId, $this->checkedBeverage) ? 'bg-info text-white' : '';
    }
}
