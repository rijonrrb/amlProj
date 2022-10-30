<div class="card">
<h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>IT CUSTUDY</b></h4>
<div class="row mb-3 p-2 d-flex justify-content-between">
<button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddItcusModal()">Add New Dataset</button>
    <div>
       @if ($checkedItcus)
            <button class="btn btn-danger btn-md mr-4" wire:click="deleteItcuss()"> Delete Selected DataSet ({{ count($checkedItcus) }})</button>
       @endif
    </div>
</div>

    <div class="row mb-3 p-2 card-header" style= "margin-right: 0px; margin-left: 0px;">
    <div class="col-md-4">
        <label for="">Search</label>
        <input type="text" class="form-control" wire:model.debounce.350ms="search">
    </div>
    <div class="col-md-1">
    <label for="">DataSet Limit</label>
    <select class="form-control" wire:model="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
    </select>
    </div>
    <div class="col-md-3">
    <label for="">Order By</label>
    <select class="form-control" wire:model="orderBy">
    <option value="user_name">User name</option>
    <option value="desigation">Desigation</option>
    <option value="dept">Dept</option>
    <option value="unit">Unit</option>
    <option value="item">Item</option>
    <option value="laptop_name">Laptop Name</option>
    <option value="asset_no">Asset No</option>
    <option value="serial_no">Serial No</option>
    <option value="previous_user">Previous User</option>
    <option value="issue_date">Previous User</option>
    <option value="p_issue_date">Previous Issue Date</option>
    <option value="configuration">Configuration</option>
    </select>
    </div>

    <div class="col-md-3">
        <label for="">Department</label>
        <select wire:model ="byDept" class="form-control">
        <option value="">Select Option</option>
        @foreach ($depts as $dept)
        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
        @endforeach
        </select>
        </div>

    <div class="col-md-1">
    <label for="">Sort By</label>
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
                <th></th>
                <th>SL No.</th>
                <th>User name</th>
                <th>Desigation</th>
                <th>Dept</th>
                <th>Unit</th>
                <th>Item</th>
                <th>Laptop Name</th>
                <th>Asset No</th>
                <th>Serial No</th>
                <th>Previous User</th>
                <th>Issue Date</th>
                <th>Previous Issue Date</th>
                <th>Configuration</th>
                <th>Actions</th>
                <th>Return</th>
                <th>Reuse</th>
            </tr>
            </thead>
            <tbody>
                        @php        
                        $i = 1;
                        @endphp

                @forelse ($Itcuss as $Itcus)
                    <tr class="{{ $this->isChecked($Itcus->id) }}">
                    <td><input type="checkbox" value="{{ $Itcus->id }}" wire:model="checkedItcus"></td>
                    <td>{{$i++}}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="user_name" title="Click to edit">{{ $Itcus->user_name }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="desigation" title="Click to edit">{{ $Itcus->desigation }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="dept" title="Click to edit">{{ $Itcus->dept }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="unit" title="Click to edit">{{ $Itcus->unit }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="item" title="Click to edit">{{ $Itcus->item }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="laptop_name" title="Click to edit">{{ $Itcus->laptop_name }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="asset_no" title="Click to edit">{{ $Itcus->asset_no }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="serial_no" title="Click to edit">{{ $Itcus->serial_no }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="previous_user" title="Click to edit">{{ $Itcus->previous_user }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="issue_date" title="Click to edit">{{ $Itcus->issue_date }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="p_issue_date" title="Click to edit">{{ $Itcus->p_issue_date }}</td>
                    <td contenteditable="true" class="update" data-id="{{ $Itcus->id }}" data-column="configuration" title="Click to edit">{{ $Itcus->configuration }}</td>
                    <td>
                    <div class="btn-group container">
                    &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Itcus->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                    </div>
                    </td>
                    <td>
                    <div class="btn-group container">
                    &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenReturnCountryModal({{$Itcus->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Item"></img></a>
                    </div>
                    </td>
                    <td>
                    <div class="btn-group container">
                    &nbsp;<a href="#" wire:click="OpenReuseModal({{$Itcus->id}})"><img src="https://img.icons8.com/pastel-glyph/344/hand-box.png" style="width: 30px;" title="Reuse Item"></img></a>
                    </div>
                    </td>
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
    @include('modals.add-modal')
@include('modals.edit-modal')
@include('modals.reuse-modal')
</div>
