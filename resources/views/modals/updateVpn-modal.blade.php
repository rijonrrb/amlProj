<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>

                <div class="form-group">
                <label for="">User</label>
                <select wire:model.debounce.0ms="U_userid" class="form-control" data-live-search="true" data-size="5" id="upVpn" data-live-search-placeholder="Search your user" data-style="btn btn-outline-secondary">
                <option value="" disabled selected hidden>Select User</option>
                <option value="">&nbsp No User</option>
                @foreach ($Userlists as $Userlist)
                <option value="{{ $Userlist->userid }}"  data-subtext="({{$Userlist->desigation}})">&nbsp {{$Userlist->name}} &nbsp#{{$Userlist->userid}}</option> 
                @endforeach
                </select>
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
