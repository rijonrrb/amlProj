<div>
 
    <button class="btn btn-primary btn-sm mb-3" wire:click="OpenAddCountryModal()">Add New Dataset</button>
    <div>
       @if ($checkedCountry)
            <button class="btn btn-danger" wire:click="deleteCountries()">Selected DataSet ({{ count($checkedCountry) }})</button>
       @endif
    </div>
    <table class="table table-hover">
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
                <th></th>
            </tr>
            </thead>
            <tbody>

                @forelse ($countries as $country)
                    <tr class="{{ $this->isChecked($country->id) }}">
                    <td><input type="checkbox" value="{{ $country->id }}" wire:model="checkedCountry"></td>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->user_name }}</td>
                    <td>{{ $country->desigation }}</td>
                    <td>{{ $country->dept }}</td>
                    <td>{{ $country->unit }}</td>
                    <td>{{ $country->item }}</td>
                    <td>{{ $country->laptop_name }}</td>
                    <td>{{ $country->asset_no }}</td>
                    <td>{{ $country->serial_no }}</td>
                    <td>{{ $country->previous_user }}</td>
                    <td>{{ $country->issue_date }}</td>
                    <td>{{ $country->configuration }}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm" wire:click="deleteConfirm({{$country->id}})">Delete</button>
                            <button class="btn btn-success btn-sm" wire:click="OpenEditCountryModal({{$country->id}})">Edit</button>
                        </div>
                    </td>
                </tr>
                @empty
                    <code>No country found!</code>
                @endforelse
                
            </tbody>
    </table>
    @if (count($countries))
        {{ $countries->links('livewire-pagination-links') }}
    @endif
    @include('modals.add-modal')
    @include('modals.edit-modal')
</div>
