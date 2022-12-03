<div class="card">
        <h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>Vpn List</b></h4>
        <div class="row mb-3 p-2 d-flex justify-content-between">
            @if(Session::get('admin_type') == "SAdmin")
            <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddVpnModal()">Add New Dataset</button>
            @elseif(Session::get('admin_type') == "Mod" && Session::get('create') == "True")
            <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddVpnModal()">Add New Dataset</button>
            @endif
            <div>
                @if ($checkedVpn)
                <button class="btn btn-danger btn-md mr-4" wire:click="deleteVpns()"> Delete rows ({{ count($checkedVpn) }})</button>
                @endif
            </div>
        </div>
        <div class="row mb-3 p-2 card-header" style= "margin-right: 0px; margin-left: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 mt-1 mb-4">
                <label for="" style="color:#c94c4c"><b>Search</b></label>
                <input type="text" class="form-control" wire:model.debounce.350ms="search">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
                <label for="" style="color:#c94c4c"><b>Data Limit</b></label>
                <select class="form-control" wire:model="perPage">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 mt-1 mb-4">
                <label for="" style="color:#c94c4c"><b>User ID</b></label>
                <input type="text" class="form-control" wire:model.debounce.350ms="byUid">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
                <label for="" style="color:#c94c4c"><b>Order By</b></label>
                <select class="form-control" wire:model="orderBy">
                    <option value="userid">User ID</option>
                    <option value="name">Username</option>
                    <option value="password">User Password</option>
                    <option value="ip">Ip Address</option>
                    <option value="remark">Remark</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2 mt-1 mb-4">
                <label for="" style="color:#c94c4c"><b>Sort By</b></label>
                <select class="form-control" wire:model="sortBy">
                    <option value="asc">ASC</option><option value="desc">DESC</option>
                </select>
            </div>
        </div>
        <div style="overflow-x:auto;" class="card-body">
            <table class="table table-hover table-bordered" id="Vpn">
                <thead class="thead-inverse">
                    <tr>
                    @if(Session::get('admin_type') == "SAdmin")
                    <th></th>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
                    <th></th>
                    @endif
                    <th>SL No.</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>IP Address</th>
                    <th>Remark</th>
                    @if(Session::get('admin_type') == "SAdmin")
                    <th>Delete</th>
                    <th>Update</th>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == null)
                    <th>Delete</th>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('update') == "True" && Session::get('delete') == null)
                    <th>Update</th>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True")
                    <th>Delete</th>
                    <th>Update</th>         
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @php        
                    $i = 1;
                    @endphp
                    @forelse ($Vpns as $Vpn)
                    <tr class="{{ $this->isChecked($Vpn->id) }}">
                        @if(Session::get('admin_type') == "SAdmin")
                        <td><input type="checkbox" value="{{ $Vpn->id }}" wire:model="checkedVpn"></td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
                        <td><input type="checkbox" value="{{ $Vpn->id }}" wire:model="checkedVpn"></td>
                        @endif                     
                        <td>{{$i++}}</td>
                        <td  data-id="{{ $Vpn->id }}" data-column="userid" style="white-space: nowrap;">{{ $Vpn->userid }}</td>
                        <td  data-id="{{ $Vpn->id }}" data-column="name" style="white-space: nowrap;">{{ $Vpn->name }}</td>
                        <td  data-id="{{ $Vpn->id }}" data-column="password" style="white-space: nowrap;">{{ $Vpn->password }}</td>
                        <td  data-id="{{ $Vpn->id }}" data-column="ip" style="white-space: nowrap;">{{ $Vpn->ip }}</td>
                        <td  data-id="{{ $Vpn->id }}" data-column="remark" style="white-space: nowrap;">{{ $Vpn->remark }}</td>
                        @if(Session::get('admin_type') == "SAdmin")                
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Vpn->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Vpn->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                            </div>
                        </td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == null)
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Vpn->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('update') == "True" && Session::get('delete') == null)
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Vpn->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                            </div>
                        </td> 
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True")
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Vpn->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>   
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Vpn->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
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
        @if (count($Vpns))
        {{ $Vpns->links('livewire-pagination-links') }}
        @endif
        <button type="button" id="export" class="btn btn-primary h-25 px-2 mt-2 mr-2">Download Excel</button>
    </div>
    @include('modals.addVpn-modal')
    @include('modals.updateVpn-modal')
</div>
