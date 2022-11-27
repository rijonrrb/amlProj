<div class="card">
	<h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Igloo Ice Cream Unit</b></h4>
	<div class="row mb-3 p-2 d-flex justify-content-between">
		<div>
			@if ($checkedCountry)
			<button class="btn btn-danger btn-md ml-4" wire:click="deleteCountries()"> Delete rows ({{ count($checkedCountry) }})</button>
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
			<label for="" style="color:#c94c4c"><b>Department</b></label>
			<select wire:model ="byDept" class="form-control">
				<option value="">Select Department</option>
				<option value="HR">HR</option>
				<option value="IT">IT</option>
				<option value="MIS">MIS</option>
				<option value="Audit">Audit</option>
				<option value="Sales">Sales</option>
				<option value="Procument">Procument</option>
			</select>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
			<label for="" style="color:#c94c4c"><b>Desigation</b></label>
			<select class="form-control" wire:model="byDes">
				<option value="">Select Desigation</option>
				<option value="Chief executive officer">Chief executive officer</option>
				<option value="Chief Technology Officer">Chief Technology Officer</option>
				<option value="Chief Financial Officer">Chief Financial Officer</option>
				<option value="Chief Operating Officer">Chief Operating Officer</option>
				<option value="Project Director">Project Director</option>
				<option value="Executive Director">Executive Director</option>
				<option value="General Manager">General Manager</option>
				<option value="Deputy General Manager">Deputy General Manager</option>
				<option value="Asst. General Manager">Asst. General Manager</option> 
				<option value="Manager">Manager</option> 
				<option value="Deputy Manager">Deputy Manager</option> 
				<option value="Asst. Manager">Asst. Manager</option> 
				<option value="Senior Officer">Senior Officer</option> 
				<option value="Senior Executive">Senior Executive</option> 
				<option value="Officer">Officer</option> 
				<option value="Executive">Executive</option> 
				<option value="Junior Officer">Junior Officer</option> 
				<option value="Junior Executive">Junior Executive</option> 
				<option value="Intern">Intern</option> 
			</select>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
			<label for="" style="color:#c94c4c"><b>Work-Station</b></label>
			<select class="form-control" wire:model="byWstat">
				<option value="">Select Work-Station</option>
				<option value="CHO">CHO</option>
				<option value="Depo">Depo</option>
				<option value="Factory">Factory</option>
				<option value="Project">Project</option>
			</select>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
			<label for="" style="color:#c94c4c"><b>Order By</b></label>
			<select class="form-control" wire:model="orderBy">
				<option value="user_name">User name</option>
				<option value="desigation">Desigation</option>
				<option value="dept">Department</option>
				<option value="wstation">Work-Station</option>
				<option value="unit">Unit</option>
				<option value="item">Product</option>
				<option value="laptop_name">Product Model</option>
				<option value="asset_no">Asset No</option>
				<option value="serial_no">Serial No</option>
				<option value="previous_user">Previous User</option>
				<option value="issue_date">Previous User</option>
				<option value="p_issue_date">Previous Issue Date</option>
				<option value="configuration">Configuration</option>
			</select>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-1 mt-1 mb-4">
			<label for="" style="color:#c94c4c"><b>Sort By</b></label>
			<select class="form-control" wire:model="sortBy">
				<option value="asc">ASC</option><option value="desc">DESC</option>
			</select>
		</div>
	</div>
	<div style="overflow-x:auto;" class="card-body">
		<table class="table table-hover table-bordered" id="Igloo">
			<thead class="thead-inverse">
				<tr>
					@if(Session::get('admin_type') == "SAdmin")
					<th></th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
					<th></th>
					@endif
					<th>SL No.</th>
					<th>User name</th>
					<th>Desigation</th>
					<th>Department</th>
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
					<th>Warrenty Active Date</th>
					<th>Warrenty Expire Date</th>
					@if(Session::get('admin_type') == "SAdmin")
					<th>Return</th>
					<th>Delete</th>
					<th>Update</th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('delete') == null && Session::get('update') == null)
					<th>Return</th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('return') == null && Session::get('update') == null)
					<th>Delete</th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('update') == "True" && Session::get('return') == null && Session::get('delete') == null)
					<th>Update</th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('delete') == "True" && Session::get('update') == null)
					<th>Return</th>
					<th>Delete</th>
					@elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('update') == "True" && Session::get('delete') == null)
					<th>Return</th>
					<th>Update</th>	
					@elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True" && Session::get('return') == null)
					<th>Delete</th>
					<th>Update</th>	
					@elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True" && Session::get('return') == "True")
					<th>Return</th>
					<th>Delete</th>
					<th>Update</th>				
					@endif
					<!-- <th>Reuse</th> -->
				</tr>
			</thead>
			<tbody>
				@php        
				$i = 1;
				$date = date('d-M-Y');
				@endphp
				@forelse ($countries as $country)
				<tr class="{{ $this->isChecked($country->id) }}">
					@if(Session::get('admin_type') == "SAdmin")
                    <td><input type="checkbox" value="{{ $country->id }}" wire:model="checkedCountry"></td>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
                    <td><input type="checkbox" value="{{ $country->id }}" wire:model="checkedCountry"></td>
                    @endif
					<td>{{ $i++ }}</td>
					<td  data-id="{{ $country->id }}" data-column="user_name" style="white-space: nowrap;">{{ $country->user_name }}</td>
					<td  data-id="{{ $country->id }}" data-column="desigation" style="white-space: nowrap;">{{ $country->desigation }}</td>
					<td  data-id="{{ $country->id }}" data-column="dept" style="white-space: nowrap;">{{ $country->dept }}</td>
					<td  data-id="{{ $country->id }}" data-column="wstation" style="white-space: nowrap;">{{ $country->wstation }}</td>
					<td  data-id="{{ $country->id }}" data-column="unit" style="white-space: nowrap;">{{ $country->unit }}</td>
					<td  data-id="{{ $country->id }}" data-column="item" style="white-space: nowrap;">{{ $country->item }}</td>
					<td  data-id="{{ $country->id }}" data-column="laptop_name" style="white-space: nowrap;">{{ $country->laptop_name }}</td>
					<td  data-id="{{ $country->id }}" data-column="asset_no" style="white-space: nowrap;">{{ $country->asset_no }}</td>
					<td  data-id="{{ $country->id }}" data-column="serial_no" style="white-space: nowrap;">{{ $country->serial_no }}</td>
					<td  data-id="{{ $country->id }}" data-column="previous_user" >{{ $country->previous_user }}</td>
					<td  data-id="{{ $country->id }}" data-column="issue_date" style="white-space: nowrap;">{{ $country->issue_date }}</td>
					<td  data-id="{{ $country->id }}" data-column="p_issue_date" >{{ $country->p_issue_date }}</td>
					<td  data-id="{{ $country->id }}" data-column="configuration" >{{ $country->configuration }}</td>
					<td  data-id="{{ $country->id }}" data-column="warrenty_start" style="white-space: nowrap;">{{ $country->warrenty_start }}</td>
					@if( strtotime($country->warrenty_end) <= strtotime($date) && $country->warrenty_end != Null)
					<td  data-id="{{ $country->id }}" class="text-white bg-danger" data-column="warrenty_end" style="white-space: nowrap;">{{ $country->warrenty_end }}</td>
					@else
					<td  data-id="{{ $country->id }}" data-column="warrenty_end" style="white-space: nowrap;">{{ $country->warrenty_end }}</td>
					@endif
                    @if(Session::get('admin_type') == "SAdmin")
                    <td>
                        <div class="btn-group container">
                            <a href="#" wire:click="OpenReturnCountryModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Product"></img></a>
                        </div>
                    </td>                   
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                        </div>
                    </td>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('return') == null && Session::get('update') == null)
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('update') == "True" && Session::get('delete') == null && Session::get('return') == null)
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                        </div>
                    </td>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('update') == null && Session::get('delete') == null)
                    <td>
                        <div class="btn-group container">
                            <a href="#" wire:click="OpenReturnCountryModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Product"></img></a>
                        </div>
                    </td>   
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('delete') == "True" && Session::get('update') == null)
                    <td>
                        <div class="btn-group container">
                            <a href="#" wire:click="OpenReturnCountryModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Product"></img></a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>   
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('return') == "True" && Session::get('update') == "True" && Session::get('delete') == null)
                    <td>
                        <div class="btn-group container">
                            <a href="#" wire:click="OpenReturnCountryModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Product"></img></a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                        </div>
                    </td>   
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True" && Session::get('return') == null)
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>   
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                        </div>
                    </td>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True" && Session::get('return') == "True")
                    <td>
                        <div class="btn-group container">
                            <a href="#" wire:click="OpenReturnCountryModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/1585/1585147.png" style="width: 30px;" title="Return Product"></img></a>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$country->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                        </div>
                    </td>   
                    <td>
                        <div class="btn-group container">
                            &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$country->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
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
	@if (count($countries))
	{{ $countries->links('livewire-pagination-links') }}
	@endif
	<button type="button" id="export" class="btn btn-primary h-25 px-2 mt-2 mr-2">Download Excel</button>
</div>
<div class="mt-4 mb-3">
    @foreach($total_items as $total_item)
    <h6 class="ml-5 text-danger">◍ Total {{ $total_item->item }} : {{ $total_item->count }}</h6>
    @endforeach
</div>
@include('modals.edit-modal')
@include('modals.update-modal')
</div>
