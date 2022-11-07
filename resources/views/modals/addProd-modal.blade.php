<div class="modal fade addProd mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
             <form wire:submit.prevent="save">
                 <h3 align ="center">Product Info</h3>
                 <div class="form-group">
                     <label for="">Product Type</label>
                     <input type="text" class="form-control" placeholder="Item" wire:model="item" >
                     <span class="text-danger"> @error('item') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">Product Model</label>
                     <input type="text" class="form-control" placeholder="Item Name" wire:model="laptop_name" >
                     <span class="text-danger"> @error('laptop_name') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">Product Serial No</label>
                     <input type="text" class="form-control" placeholder="Serial No" wire:model="serial_no" >
                     <span class="text-danger"> @error('serial_no') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">Configuration / Accessories</label>
                     <textarea  class="form-control" placeholder="Configuration" wire:model="configuration" ></textarea>
                     <span class="text-danger"> @error('configuration') {{ $message }}@enderror</span>
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