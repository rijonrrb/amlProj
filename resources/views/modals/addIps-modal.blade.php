<div class="modal fade addIPs mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
             <form wire:submit.prevent="saveips">
                 <h3 align ="center">IP Info</h3>
                 <!-- <div class="form-group">
                     <label for="">User ID</label>
                     <input type="text" class="form-control" placeholder="User ID" wire:model="userid">
                     <span class="text-danger"> @error('userid') {{ "$message" }}@enderror</span>
                 </div> -->
                 <div class="form-group">
                     <label for="">Ip Address</label>
                     <input type="text" class="form-control" placeholder="Example: 192.168.1" wire:model="ips">
                     <span class="text-danger"> @error('ips') {{ $message }}@enderror</span>
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