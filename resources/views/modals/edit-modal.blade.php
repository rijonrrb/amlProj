<div class="modal fade editCountry" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Row</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form wire:submit.prevent="update">
                     <input type="hidden" wire:model="cid">
                     <div class="form-group">
                         <label for="">User Name</label>
                         <input type="text" class="form-control" placeholder="User Name" wire:model="upd_user_name">
                         <span class="text-danger"> @error('upd_user_name') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Desigation</label>
                         <input type="text" class="form-control" placeholder="Desigation" wire:model="upd_desigation">
                         <span class="text-danger"> @error('upd_desigation') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Dept</label>
                         <input type="text" class="form-control" placeholder="Dept" wire:model="upd_dept">
                         <span class="text-danger"> @error('upd_dept') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model="upd_unit">
                         <span class="text-danger"> @error('upd_unit') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Item</label>
                         <input type="text" class="form-control" placeholder="Item" wire:model="upd_item">
                         <span class="text-danger"> @error('upd_item') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Laptop Name</label>
                         <input type="text" class="form-control" placeholder="Laptop Name" wire:model="upd_laptop_name">
                         <span class="text-danger"> @error('upd_laptop_name') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Asset No</label>
                         <input type="text" class="form-control" placeholder="Asset No" wire:model="upd_asset_no">
                         <span class="text-danger"> @error('upd_asset_no') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Serial No</label>
                         <input type="text" class="form-control" placeholder="Serial No" wire:model="upd_serial_no">
                         <span class="text-danger"> @error('upd_serial_no') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Previous User</label>
                         <input type="text" class="form-control" placeholder="Previous User" wire:model="upd_previous_user">
                         <span class="text-danger"> @error('upd_previous_user') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Issue Date</label>
                         <input type="text" class="form-control" placeholder="Issue Date" wire:model="upd_issue_date">
                         <span class="text-danger"> @error('upd_issue_date') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Configuration</label>
                         <input type="text" class="form-control" placeholder="Configuration" wire:model="upd_configuration">
                         <span class="text-danger"> @error('upd_configuration') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                     </div>
                 </form>
                
            </div>
        </div>
    </div>
</div>