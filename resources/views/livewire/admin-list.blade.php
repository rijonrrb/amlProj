<div class="card">
	<h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Admin List</b></h4>
	<div class="row mb-3 p-2 d-flex justify-content-between">
		<div>
			@if ($checkedAdmin)
			<button class="btn btn-danger btn-md mr-4" wire:click="deleteAdmins()"> Delete rows ({{ count($checkedAdmin) }})</button>
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
					<td  data-id="{{ $Admin->id }}" data-column="create" >{{ $Admin->create }}</td>
					<td  data-id="{{ $Admin->id }}" data-column="update" >{{ $Admin->update }}</td>
					<td  data-id="{{ $Admin->id }}" data-column="delete" >{{ $Admin->delete }}</td>
					<td  data-id="{{ $Admin->id }}" data-column="issue" >{{ $Admin->issue }}</td>
					<td  data-id="{{ $Admin->id }}" data-column="return" >{{ $Admin->return }}</td>

					<td>
						<div class="btn-group container">
							&nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Admin->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
						</div>
					</td>
			</tr>
			@empty
			<code>No DataSet found!</code>
			@endforelse
		</tbody>
	</table>
</div>
</div>
