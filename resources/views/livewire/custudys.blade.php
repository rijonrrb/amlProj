<div class="card">
    <h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>IT STORE</b></h4>
    <div class="row mb-3 p-2 d-flex justify-content-between">
        <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddItcusModal()">Add New Dataset</button>
        <div>
           @if ($checkedItcus)
           <button class="btn btn-danger btn-md mr-4" wire:click="deleteItcuss()"> Delete rows ({{ count($checkedItcus) }})</button>
           @endif
       </div>
   </div>
   <div class="row mb-3 p-2 card-header" style= "margin-right: 0px; margin-left: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Search</b></label>
        <input type="text" class="form-control" wire:model.debounce.350ms="search">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-1 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Data Limit</b></label>
        <select class="form-control" wire:model="perPage">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Unit</b></label>
        <select wire:model ="byUnit" class="form-control">
            <option value="">Select Option</option>
            <option value="Igloo Ice Cream Unit">Igloo Ice Cream Unit</option>
            <option value="Igloo Dairy Unit">Igloo Dairy Unit</option>
            <option value="Igloo Foods Unit">Igloo Foods Unit</option>
            <option value="AML Construction Unit">AML Construction Unit</option>
            <option value="AML Dredging Unit">AML Dredging Unit</option>
            <option value="AML Sugar Refinery Unit">AML Sugar Refinery Unit</option>
            <option value="AML Beverage Unit">AML Beverage Unit</option>
            <option value="AML Bran Oil Unit">AML Bran Oil Unit</option>

        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Product Type</b></label>
        <select class="form-control" wire:model="byPtype">
            <option value="">Select Product Type</option>
            <option value="Laptop">Laptop</option>
            <option value="Desktop">Desktop</option>
            <option value="Printer">Printer</option>
            <option value="Scanner">Scanner</option>
            <option value="Router">Router</option>
            <option value="Switch">Switch</option>
            <option value="Projector">Projector</option>
            <option value="Mouse">Mouse</option>
            <option value="Keyboard">Keyboard</option>
            <option value="RAM">RAM</option>
            <option value="SSD">SSD</option> 
            <option value="HDD">HDD</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Product Condition</b></label>
        <select class="form-control" wire:model="byPcond">
            <option value="">Select Condition</option>
            <option value="Good">Good</option>
            <option value="Damaged">Damaged</option>
            <option value="Out of order">Out of order</option>
        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Order By</b></label>
        <select class="form-control" wire:model="orderBy">
            <option value="unit">Unit</option>
            <option value="item">Product</option>
            <option value="laptop_name">Product Model</option>
            <option value="asset_no">Asset No</option>
            <option value="serial_no">Serial No</option>
            <option value="previous_user">Previous User</option>
            <option value="issue_date">Issue date</option>
            <option value="p_issue_date">Previous Issue Date</option>
            <option value="configuration">Configuration</option>
            <option value="condition">Condition</option>
            
        </select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-1 mt-1 mb-4">
        <label for="" style="color:#c94c4c"><b>Sort By</b></label>
        <select class="form-control" wire:model="sortBy">
            <option value="asc">ASC</option>
            <option value="desc">DESC</option>
        </select>
    </div>
</div>
<div style="overflow-x:auto;" class="card-body">
    <table class="table table-hover table-bordered" id="Itcus">
        <thead class="thead-inverse">
            <tr>
                @if(Session::get('admin_type') == "SAdmin")
                <th></th>
                @endif
                <th>SL No.</th>
                <th>User name</th>
                <th>Desigation</th>
                <th>Dept</th>
                <th>Work-Station</th>
                <th>Unit</th>
                <th>Product Type</th>
                <th>Product Model</th>
                <th>Asset No</th>
                <th>Product Serial No</th>
                <th>Previous User</th>
                <th>Issue Date</th>
                <th>Previous Issue Date</th>
                <th>Configuration</th>
                <th>Condition</th>                
                <th>Issue /<br> Re-Issue</th>
                @if(Session::get('admin_type') == "SAdmin")
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php        
            $i = 1;
            @endphp
            @forelse ($Itcuss as $Itcus)
            <tr class="{{ $this->isChecked($Itcus->id) }}">
                @if(Session::get('admin_type') == "SAdmin")
                <td><input type="checkbox" value="{{ $Itcus->id }}" wire:model="checkedItcus"></td>
                @endif
                <td>{{$i++}}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="user_name" >{{ $Itcus->user_name }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="desigation" >{{ $Itcus->desigation }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="dept" >{{ $Itcus->dept }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="wstation" >{{ $Itcus->wstation }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="unit" >{{ $Itcus->unit }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="item" >{{ $Itcus->item }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="laptop_name" >{{ $Itcus->laptop_name }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="asset_no" >{{ $Itcus->asset_no }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="serial_no" >{{ $Itcus->serial_no }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="previous_user" >{{ $Itcus->previous_user }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="issue_date" >{{ $Itcus->issue_date }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="p_issue_date" >{{ $Itcus->p_issue_date }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="configuration" >{{ $Itcus->configuration }}</td>
                <td  data-id="{{ $Itcus->id }}" data-column="condition" >{{ $Itcus->condition }}</td>
                <td>
                    <div class="btn-group container">
                        &nbsp;<a href="#" wire:click="OpenReuseModal({{$Itcus->id}})"><img src="https://img.icons8.com/pastel-glyph/344/hand-box.png" style="width: 30px;" title="Issue / Re-Issue"></img></a>
                    </div>
                </td>
                @if(Session::get('admin_type') == "SAdmin")
                <td>
                    <div class="btn-group container">
                        &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Itcus->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <code>No DataSet found!</code>
            @endforelse
            
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-between bg-dark card-footer">
    @if (count($Itcuss))
    {{ $Itcuss->links('livewire-pagination-links') }}
    @endif
    <button type="button" id="export" class="btn btn-primary h-25 px-2 mt-2 mr-2">Download Excel</button>
</div>
@include('modals.addProd-modal')
@include('modals.edit-modal')
@include('modals.reuse-modal')
</div>
