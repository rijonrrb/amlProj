<div class="card">
    <h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Procurement</b></h4>
    <div class="row mb-3 p-2 d-flex justify-content-between">
        <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddProcurementModal()">Add New Dataset</button>
        <div>
         @if ($checkedProcurement)
         <button class="btn btn-danger btn-md mr-4" wire:click="deleteProcurements()"> Delete items ({{ count($checkedProcurement) }})</button>
         @endif
     </div>
 </div>
 <div class="row mb-3 p-2 card-header">
    <div class="col-md-4">
        <label for="">Search</label>
        <input type="text" class="form-control" wire:model.debounce.350ms="search">
    </div>
    <div class="col-md-1">
        <label for="">Data Limit</label>
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
            <option value="laptop_name">Item Name</option>
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
    <table class="table table-hover table-bordered" id="Procurements">
        <thead class="thead-inverse">
            <tr>
                <th></th>
                <th>SL No.</th>
                <th>User name</th>
                <th>Desigation</th>
                <th>Dept</th>
                <th>Unit</th>
                <th>Item</th>
                <th>Item Name</th>
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
            @forelse ($Procurements as $Procurement)
            <tr class="{{ $this->isChecked($Procurement->id) }}">
                <td><input type="checkbox" value="{{ $Procurement->id }}" wire:model="checkedProcurement"></td>
                <td>{{$i++}}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="user_name" title="Click to edit">{{ $Procurement->user_name }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="desigation" title="Click to edit">{{ $Procurement->desigation }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="dept" title="Click to edit">{{ $Procurement->dept }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="unit" title="Click to edit">{{ $Procurement->unit }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="item" title="Click to edit">{{ $Procurement->item }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="laptop_name" title="Click to edit">{{ $Procurement->laptop_name }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="asset_no" title="Click to edit">{{ $Procurement->asset_no }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="serial_no" title="Click to edit">{{ $Procurement->serial_no }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="previous_user" title="Click to edit">{{ $Procurement->previous_user }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="issue_date" title="Click to edit">{{ $Procurement->issue_date }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="p_issue_date" title="Click to edit">{{ $Procurement->p_issue_date }}</td>
                <td contenteditable="true" class="updateProc" data-id="{{ $Procurement->id }}" data-column="configuration" title="Click to edit">{{ $Procurement->configuration }}</td>
                <td>
                    <div class="btn-group container">
                        &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirmP({{$Procurement->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                    </div>
                </td>
                <td>
                    <div class="btn-group container">
                        &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenReturnCountryModal({{$Procurement->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Item"></img></a>
                    </div>
                </td>
                <td>
                    <div class="btn-group container">
                        &nbsp;<a href="#" wire:click="OpenReuseModal({{$Procurement->id}})"><img src="https://img.icons8.com/pastel-glyph/344/hand-box.png" style="width: 30px;" title="Reuse Item"></img></a>
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
    @if (count($Procurements))
    {{ $Procurements->links('livewire-pagination-links') }}
    @endif
    <button type="button" id="exportP" class="btn btn-primary h-25 px-2 mt-2 mr-2">Download Excel</button>
</div>
@include('modals.addP-modal')
@include('modals.edit-modal')
@include('modals.reuse-modal')
</div>
