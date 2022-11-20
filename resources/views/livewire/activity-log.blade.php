<div class="card">
	<h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Activity Log</b></h4>
	<div class="row mb-3 p-2 d-flex justify-content-between">
		<div>
			@if ($checkedLog)
			<button class="btn btn-danger btn-md ml-4" wire:click="deleteLogs()"> Delete rows ({{ count($checkedLog) }})</button>
			@endif
		</div>
	</div>

	<div style="overflow-x:auto;" class="card-body">
		<table class="table table-hover table-bordered" id="Logs">
			<thead class="thead-inverse">
				<tr>
					<th></th>
					<th>SL No.</th>
					<th>User Name</th>
					<th>User Email</th>
					<th>Activity</th>
					<th>Activity Field</th>
					<th>Time</th>
					<!-- <th>User IP</th> -->
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@php        
				$i = 1;
				@endphp
				@forelse ($Logs as $Log)
				<tr class="{{ $this->isChecked($Log->id) }}">
					<td><input type="checkbox" value="{{ $Log->id }}" wire:model="checkedLog"></td>
					<td>{{$i++}}</td>
					<td  data-id="{{ $Log->id }}" data-column="name" >{{ $Log->name }}</td>
					<td  data-id="{{ $Log->id }}" data-column="email" >{{ $Log->email }}</td>
					<td  data-id="{{ $Log->id }}" data-column="activity" >{{ $Log->activity }}</td>
					<td  data-id="{{ $Log->id }}" data-column="afield" >{{ $Log->afield }}</td>
					<td  data-id="{{ $Log->id }}" data-column="time" >{{ $Log->time }}</td>
					<!-- <td  data-id="{{ $Log->id }}" data-column="ip" >{{ $Log->ip }}</td> -->
					<td>
						<div class="btn-group container">
							&nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Log->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
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
