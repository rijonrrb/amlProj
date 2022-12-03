<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>

                <div class="form-group">
                <label for="">User</label>
                <select id="select-state" wire:model ="U_userid" class="form-control" >
                <option value="" disabled selected hidden>Select User</option>
                <option value="">No User</option>
                @foreach ($Userlists as $Userlist)
                <option value="{{ $Userlist->userid }}">{{$Userlist->name}}#{{$Userlist->userid}} ({{$Userlist->desigation}})</option> 
                @endforeach
                </select>
                </div>
                <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" class="form-control" placeholder="Username" wire:model="U_name">
                 </div>
                 <div class="form-group">
                     <label for="">Password</label>
                     <input type="text" class="form-control" placeholder="Password" wire:model="U_password">
                 </div>
                 <div class="form-group">
                     <label for="">Ip Address</label>
                     <input type="text" class="form-control" placeholder="Example: 192.168.1.1" wire:model="U_ip">
                 </div>
                 <div class="form-group">
                    <label for="">Remark</label>
                    <textarea  class="form-control" placeholder="Remark" wire:model="U_remark" ></textarea>
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
