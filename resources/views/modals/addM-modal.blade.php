<div class="modal fade addM" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Row</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form wire:submit.prevent="save">
                     <div class="form-group">
                         <label for="">User Name</label>
                         <input type="text" class="form-control" placeholder="User Name" wire:model="user_name">
                         <span class="text-danger"> @error('user_name') {{ $message }}@enderror</span>
                     </div>

                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                        <input type="text" class="form-control col-9 mr-3" placeholder="Department" wire:model="dept"  style="display: block;" id="ideptM">
                        <select wire:model ="dept" class="form-control col-9 mr-3"  style="display: none;" id="sdeptM">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-2" id="cdeptM" style="display: block;">Options</button>
                        </div>
                     </div>


                     <div class="form-group">
                         <label for="">Desigation</label>
                         <input type="text" class="form-control" placeholder="Desigation" wire:model="desigation">
                         <span class="text-danger"> @error('desigation') {{ $message }}@enderror</span>
                     </div>
                     <!-- style="max-width: 120px;" -->

                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model="unit">
                         <span class="text-danger"> @error('unit') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Item</label>
                         <input type="text" class="form-control" placeholder="Item" wire:model="item">
                         <span class="text-danger"> @error('item') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Laptop Name</label>
                         <input type="text" class="form-control" placeholder="Laptop Name" wire:model="laptop_name">
                         <span class="text-danger"> @error('laptop_name') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Asset No</label>
                         <input type="text" class="form-control" placeholder="Asset No" wire:model="asset_no">
                         <span class="text-danger"> @error('asset_no') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Serial No</label>
                         <input type="text" class="form-control" placeholder="Serial No" wire:model="serial_no">
                         <span class="text-danger"> @error('serial_no') {{ $message }}@enderror</span>
                     </div>
                     <!-- <div class="form-group">
                         <label for="">Previous User</label>
                         <input type="text" class="form-control" placeholder="Previous User" wire:model="previous_user">
                         <span class="text-danger"> @error('previous_user') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Issue Date</label>
                         <input type="text" class="form-control" placeholder="Issue Date" wire:model="issue_date">
                         <span class="text-danger"> @error('issue_date') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Previous Issue Date</label>
                         <input type="text" class="form-control" placeholder="Previous Issue Date" wire:model="p_issue_date">
                         <span class="text-danger"> @error('p_issue_date') {{ $message }}@enderror</span>
                     </div> -->
                     <div class="form-group">
                         <label for="">Configuration</label>
                         <input type="text" class="form-control" placeholder="Configuration" wire:model="configuration">
                         <span class="text-danger"> @error('configuration') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary btn-sm">Save</button>
                     </div>
                 </form>
                
            </div>
        </div>
    </div>
</div>