<div class="modal fade updateItem mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateItem">
                 <h3 align ="center">User Info Update</h3>
                <div class="form-group">
                    <label for="">Product Type</label>
                    <input type="text" class="form-control" placeholder="Product Type" wire:model="UI_item">   
                </div>
                <div class="form-group">
                    <label for="">Product Model</label>
                    <input type="text" class="form-control" placeholder="Product Model" wire:model="UI_laptop_name" >
                </div>
                <div class="form-group">
                    <label for="">Product Serial No</label>
                    <input type="text" class="form-control" placeholder="Serial No" wire:model="UI_serial_no" >
                </div>
                <div class="form-group">
                    <label for="">Previous User</label>
                    <textarea class="form-control" placeholder="Previous User" wire:model="UI_P_user" ></textarea>
                </div>
                <div class="form-group">
                    <label for="">Issue Date</label>
                    <textarea class="form-control" placeholder="Issue Date" wire:model="UI_I_date" ></textarea>
                </div>
                <div class="form-group">
                    <label for="">Previous Issue Date</label>
                    <textarea class="form-control" placeholder="Previous Issue Date" wire:model="UI_P_I_date" ></textarea>
                </div>
                <div class="form-group">
                    <label for="">Configuration</label>
                    <textarea  class="form-control" placeholder="Configuration" wire:model="UI_configuration" ></textarea>
                </div>
                <div class="form-group">
                     <label for="">Warrenty Activate Date</label> 
                     <input placeholder="Select date" type="text" id="example" class="form-control" wire:model="UI_w_start">
                </div>
                <div class="form-group">
                     <label for="">Warrenty Expiry Date</label>
                     <input placeholder="Select date" type="text" id="example" class="form-control" wire:model="UI_w_end">
                </div>
                <div class="form-group">
                    <label for="">Vendor</label>
                    <input type="text" class="form-control" placeholder="Vendor Name" wire:model="UI_vendor" >
                </div>
                <div class="form-group">
                    <label for="">Product Condition</label>
                    <select wire:model ="UI_condition" class="form-control">
                                <option value="Good">Good</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Out of order">Out of order</option>
                            </select>
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
