<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>
                 
             <div class="form-group">
                 <label for="">User Name</label>
                 <input type="text" class="form-control" placeholder="User Name"  wire:model="U_user_name">
             </div>
             <div class="form-group">
                 <label for="">Desigation</label>
                 <input type="text" class="form-control" placeholder="Desigation" wire:model="U_desigation">
             </div>
             <div class="form-group">
                 <label for="">Department</label>
                 <input type="text" class="form-control" placeholder="Department" wire:model="U_dept">
             </div>
             <div class="form-group">
                 <label for="">Work-Station</label>
                 <input type="text" class="form-control" placeholder="Work-Station" wire:model="U_wstation">
             </div>
             <div class="form-group">
                 <label for="">Product Type</label>
                 <input type="text" class="form-control" placeholder="Product Type" wire:model="U_item">   
             </div>
             <div class="form-group">
                 <label for="">Product Model</label>
                 <input type="text" class="form-control" placeholder="Product Model" wire:model="U_laptop_name" >
             </div>
             <div class="form-group">
                 <label for="">Product Serial No</label>
                 <input type="text" class="form-control" placeholder="Serial No" wire:model="U_serial_no" >
             </div>
             <div class="form-group">
                 <label for="">Previous User</label>
                 <textarea class="form-control" placeholder="Previous User" wire:model="U_P_user" ></textarea>
             </div>
             <div class="form-group">
                 <label for="">Issue Date</label>
                 <textarea class="form-control" placeholder="Issue Date" wire:model="U_I_date" ></textarea>
             </div>
             <div class="form-group">
                 <label for="">Previous Issue Date</label>
                 <textarea class="form-control" placeholder="Previous Issue Date" wire:model="U_P_I_date" ></textarea>
             </div>
             <div class="form-group">
                 <label for="">Configuration</label>
                 <textarea  class="form-control" placeholder="Configuration" wire:model="U_configuration" ></textarea>
             </div> 
             <div class="form-group">
                 <label for="">Vendor</label>
                 <input type="text" class="form-control" placeholder="Vendor Name" wire:model="U_vendor" >
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
