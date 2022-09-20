<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Dept;
use Livewire\WithPagination;
class Countries extends Component
{
    use WithPagination;
    public $continent,$country_name,$capital_city;
    public $upd_continent,$upd_country_name,$upd_capital_city,$cid;
    protected $listeners = ['delete','deleteCheckedCountries'];
    public $checkedCountry = [];

    public $byDept =null;
    public $perPage =5;
    public $orderBy = "user_name";
    public $sortBy = "asc";
    public $search;
    public function render()
    {
        return view('livewire.countries',[
            'depts'=>Dept::orderBy('dept_name','asc')->get(),
            'countries'=>Country::when($this->byDept,function($query){
                $query->where('dept',$this->byDept);
            })
            ->search(trim($this->search))
            ->orderBy($this->orderBy,$this->sortBy)
            ->paginate($this->perPage)
        ]);
    }

    public function OpenAddCountryModal(){
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
        $this->dispatchBrowserEvent('OpenAddCountryModal');
    }

    public function save(){
        date_default_timezone_set('Asia/Dhaka');
        $time =  date('d F Y h:i:s A');

        $save = Country::insert([
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



        if(!empty($this->dept))

        {
        $dept = Dept::where('dept_name',$this->dept)->first();
 
                if(!$dept)
                {  
                    $res = Dept::insert([

                        'dept_name'=>$this->dept,
                    ]);
                }
                else{}
        }else{}

        if($save){
            $this->dispatchBrowserEvent('CloseAddCountryModal');
            $this->checkedCountry = [];
        }
    }

    public function OpenEditCountryModal($id){
        $info = Country::find($id);
        $this->upd_user_name = $info->user_name;
        $this->upd_desigation = $info->desigation;
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
        $this->dispatchBrowserEvent('OpenEditCountryModal',[
            'id'=>$id
        ]);
    }

    public function update(){
        $cid = $this->cid;

        $update = Country::find($cid)->update([
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
            $this->dispatchBrowserEvent('CloseEditCountryModal');
            $this->checkedCountry = [];
        }
    }

    public function deleteConfirm($id){
        $info = Country::find($id);
        $this->dispatchBrowserEvent('SwalConfirm',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete SL No.<strong>'.$info->id.'</strong>',
            'id'=>$id
        ]);
    }


    public function delete($id){
        $del =  Country::find($id)->delete();
        if($del){
            $this->dispatchBrowserEvent('deleted');
        }
        $this->checkedCountry = [];
    }

    public function deleteCountries(){
        $this->dispatchBrowserEvent('swal:deleteCountries',[
            'title'=>'Are you sure?',
            'html'=>'You want to delete this items',
            'checkedIDs'=>$this->checkedCountry,
        ]);
    }
    public function deleteCheckedCountries($ids){
        Country::whereKey($ids)->delete();
        $this->checkedCountry = [];
    }

    public function isChecked($countryId){
        return in_array($countryId, $this->checkedCountry) ? 'bg-info text-white' : '';
    }
}
