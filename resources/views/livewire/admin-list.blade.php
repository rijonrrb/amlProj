<div class="card">
	<h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Admin List</b></h4>
	<div class="row mb-3 p-2 d-flex justify-content-between">
		<div>
			@if ($checkedAdmin)
			<button class="btn btn-danger btn-md ml-4" wire:click="deleteAdmins()"> Delete rows ({{ count($checkedAdmin) }})</button>
			@endif
		</div>
	</div>

	<div style="overflow-x:auto;" class="card-body">
		<table class="table table-hover table-bordered" id="Admins">
			<thead class="thead-inverse">
				<tr>
					<th></th>
					<th>SL No.</th>
					<th>Admin Name</th>
					<th>Admin Email</th>
					<th>Create Privilege</th>
					<th>Update Privilege</th>
					<th>Delete Privilege</th>
					<th>Issue/Re-Issue Privilege</th>
					<th>Return Privilege</th>
					<th>Delete</th>
					<th>Update</th>	
				</tr>
			</thead>
			<tbody>
				@php        
				$i = 1;
				@endphp
				@forelse ($Admins as $Admin)
				<tr class="{{ $this->isChecked($Admin->id) }}">
					<td><input type="checkbox" value="{{ $Admin->id }}" wire:model="checkedAdmin"></td>
					<td>{{$i++}}</td>
					<td  data-id="{{ $Admin->id }}" data-column="name" >{{ $Admin->name }}</td>
					<td  data-id="{{ $Admin->id }}" data-column="email" >{{ $Admin->email }}</td>
					@if ($Admin->create == "True")
					<td  data-id="{{ $Admin->id }}" data-column="create" ><img src="https://www.svgrepo.com/show/311890/check-mark.svg" style="width: 30px; margin-left: 50px;"></img></td>
					@else
					<td  data-id="{{ $Admin->id }}" data-column="create" >{{ $Admin->create }}</td>
					@endif
					@if ($Admin->update == "True")
					<td  data-id="{{ $Admin->id }}" data-column="update" ><img src="https://www.svgrepo.com/show/311890/check-mark.svg" style="width: 30px; margin-left: 50px;"></img></td>
					@else
					<td  data-id="{{ $Admin->id }}" data-column="update" >{{ $Admin->update }}</td>
					@endif
					@if ($Admin->delete == "True")
					<td  data-id="{{ $Admin->id }}" data-column="delete" ><img src="https://www.svgrepo.com/show/311890/check-mark.svg" style="width: 30px; margin-left: 50px;"></img></td>
					@else
					<td  data-id="{{ $Admin->id }}" data-column="delete" >{{ $Admin->delete }}</td>
					@endif
					@if ($Admin->issue == "True")
					<td  data-id="{{ $Admin->id }}" data-column="issue" ><img src="https://www.svgrepo.com/show/311890/check-mark.svg" style="width: 30px; margin-left: 50px;"></img></td>
					@else
					<td  data-id="{{ $Admin->id }}" data-column="issue" >{{ $Admin->issue }}</td>
					@endif
					@if ($Admin->return == "True")
					<td  data-id="{{ $Admin->id }}" data-column="return" ><img src="https://www.svgrepo.com/show/311890/check-mark.svg" style="width: 30px; margin-left: 50px;"></img></td>
					@else
					<td  data-id="{{ $Admin->id }}" data-column="return" >{{ $Admin->return }}</td>
					@endif
					<td>
						<div class="btn-group container">
							&nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Admin->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
						</div>
					</td>
					<td>
						<div class="btn-group container">
							&nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Admin->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
						</div>
					</td>
				</tr>
			@empty
			<code>No DataSet found!</code>
			@endforelse
		</tbody>
	</table>
</div>
@include('modals.updateAdmin-modal')
</div>
