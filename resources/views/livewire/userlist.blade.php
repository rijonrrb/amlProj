<div class="card">
        <h4 style="color:blue;text-align:center; margin-bottom: 45px;"><b>AML Sugar Refinery Unit</b></h4>
        <div class="row mb-3 p-2 d-flex justify-content-between">
            @if(Session::get('admin_type') == "SAdmin")
            <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddSugerModal()">Add New Dataset</button>
            @elseif(Session::get('admin_type') == "Mod" && Session::get('create') == "True")
            <button class="btn btn-primary btn-md ml-4" id="add" wire:click="OpenAddSugerModal()">Add New Dataset</button>
            @endif
            <div>
                @if ($checkedSuger)
                <button class="btn btn-danger btn-md mr-4" wire:click="deleteSugers()"> Delete rows ({{ count($checkedSuger) }})</button>
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
                    @foreach ($depts as $dept)
                    <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                    @endforeach
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
            <table class="table table-hover table-bordered" id="Sugar">
                <thead class="thead-inverse">
                    <tr>
                    @if(Session::get('admin_type') == "SAdmin")
                    <th></th>
                    @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
                    <th></th>
                    @endif
                    <th>SL No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone no.</th>
                    <th>Desigation</th>
                    <th>Department</th>
                    <th>Work-Station</th>
                    <th>Unit</th>
                    <th>Product Asset No</th>
                    <th>IP Address</th>
                    <th>VPN</th>
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
                    <!-- <th>Reuse</th> -->
                    </tr>
                </thead>
                <tbody>
                    @php        
                    $i = 1;
                    @endphp
                    @forelse ($Sugers as $Suger)
                    <tr class="{{ $this->isChecked($Suger->id) }}">
                        @if(Session::get('admin_type') == "SAdmin")
                        <td><input type="checkbox" value="{{ $Suger->id }}" wire:model="checkedSuger"></td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True")
                        <td><input type="checkbox" value="{{ $Suger->id }}" wire:model="checkedSuger"></td>
                        @endif                     
                        <td>{{$i++}}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="name" >{{ $Suger->name }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="email" >{{ $Suger->email }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="phone" >{{ $Suger->phone }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="desigation" >{{ $Suger->desigation }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="dept" >{{ $Suger->dept }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="wstation" >{{ $Suger->wstation }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="unit" >{{ $Suger->unit }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="asset_no" >{{ $Suger->asset_no }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="ip" >{{ $Suger->serial_no }}</td>
                        <td  data-id="{{ $Suger->id }}" data-column="vpn" >{{ $Suger->previous_user }}</td>
                        @if(Session::get('admin_type') == "SAdmin")                
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Suger->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Suger->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                            </div>
                        </td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == null)
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Suger->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('update') == "True" && Session::get('delete') == null)
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Suger->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
                            </div>
                        </td> 
                        @elseif(Session::get('admin_type') == "Mod" && Session::get('delete') == "True" && Session::get('update') == "True")
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="deleteConfirm({{$Suger->id}})"><i class="material-icons" style="color:red" title="Delete">&#xE872;</i></a>
                            </div>
                        </td>   
                        <td>
                            <div class="btn-group container">
                                &nbsp;&nbsp;&nbsp;<a href="#" wire:click="OpenEditModal({{$Suger->id}})"><img src="https://cdn-icons-png.flaticon.com/512/5278/5278663.png" style="width: 30px;" title="Update Row"></img></a>
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
        @if (count($Sugers))
        {{ $Sugers->links('livewire-pagination-links') }}
        @endif
        <button type="button" id="export" class="btn btn-primary h-25 px-2 mt-2 mr-2">Download Excel</button>
    </div>
    @include('modals.add-modal')
    @include('modals.update-modal')
</div>