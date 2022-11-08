<div class="modal fade addProd mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
             <form wire:submit.prevent="save">
                 <h3 align ="center">Product Info</h3>
                  <div class="form-group">
                       <label for="">Product Type</label>
                       <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Product type" wire:model="item" style="display: block;" id="iProd">
                            <select wire:model ="item" class="form-control col-9 mr-3"  style="display: none;" id="sProd">
                                <option value="" disabled selected hidden>Select Product</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Printer">Printer</option>
                                <option value="Scanner">Scanner</option>
                                <option value="Projector">Projector</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Keyboard">Keyboard</option>
                                <option value="RAM">RAM</option>
                                <option value="SSD">SSD</option> 
                                <option value="HDD">HDD</option> 
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="cProd" style="display: block;">Options</button>
                        </div>    
                   </div>
                 <div class="form-group">
                     <label for="">Product Model</label>
                     <input type="text" class="form-control" placeholder="Product Model" wire:model="laptop_name" >
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