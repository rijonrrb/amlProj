<div>
  
    <div class="row mb-3 p-2">
    <div class="col-md-4">
        <label for="">Search</label>
        <input type="text" class="form-control" wire:model.debounce.350ms="search">
    </div>
    <div class="col-md-2">
    <label for="">DataSet Limit</label>
    <select class="form-control" wire:model="perPage">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
    </select>
    </div>
    <div class="col-md-4">
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
    <option value="issue_date">Issue Date</option>
    <option value="configuration">Configuration</option>
    </select>
    </div>

    <div class="col-md-2">
    <label for="">Sort By</label>
    <select class="form-control" wire:model="sortBy">
    <option value="asc">ASC</option>
    <option value="desc">DESC</option>
    </select>
    </div>

    </div>
    <button class="btn btn-primary btn-sm mb-3" wire:click="OpenAddCountryModal()">Add New Dataset</button>
    <div>
       @if ($checkedCountry)
            <button class="btn btn-danger btn-sm mb-3" wire:click="deleteCountries()"> Delete Selected DataSet ({{ count($checkedCountry) }})</button>
       @endif
    </div>
    <div style="overflow-x:auto;">
    <table class="table table-hover table-bordered">
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
                <th>Configuration</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

                @forelse ($countries as $country)
                    <tr class="{{ $this->isChecked($country->id) }}">
                    <td><input type="checkbox" value="{{ $country->id }}" wire:model="checkedCountry"></td>
                    <td>{{ $country->id }}</td>
                    <td contenteditable="true">{{ $country->user_name }}</td>
                    <td contenteditable="true">{{ $country->desigation }}</td>
                    <td contenteditable="true">{{ $country->dept }}</td>
                    <td contenteditable="true">{{ $country->unit }}</td>
                    <td contenteditable="true">{{ $country->item }}</td>
                    <td contenteditable="true">{{ $country->laptop_name }}</td>
                    <td contenteditable="true">{{ $country->asset_no }}</td>
                    <td contenteditable="true">{{ $country->serial_no }}</td>
                    <td contenteditable="true">{{ $country->previous_user }}</td>
                    <td contenteditable="true">{{ $country->issue_date }}</td>
                    <td contenteditable="true">{{ $country->configuration }}</td>
                    <td>
                        <div class="btn-group">

                        <a href="#" wire:click="OpenEditCountryModal({{$country->id}})"><i class="material-icons" style="color:gray" title="Edit">&#xE254;</i></a> &nbsp;&nbsp;&nbsp;
						<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>
                </tr>
                @empty
                    <code>No country found!</code>
                @endforelse
                
            </tbody>
    </table>
</div>
    @if (count($countries))
        {{ $countries->links('livewire-pagination-links') }}
    @endif
    @include('modals.add-modal')
    @include('modals.edit-modal')
</div>
