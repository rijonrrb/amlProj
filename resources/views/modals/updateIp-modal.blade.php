<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>           
                <div class="form-group">
                <label for="">User</label>
                <select id="select-state" wire:model ="U_user" class="form-control" >
                <option value="" disabled selected hidden>Select User</option>
                @foreach ($Userlists as $Userlist)
                <option value="{{ $Userlist->userid }}">{{$Userlist->name}}#{{$Userlist->userid}} ({{$Userlist->desigation}})</option> 
                @endforeach
                </select>
                <span class="text-danger"> @error('r_user') {{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                <label for="">Physical Address</label>
                <input type="text" class="form-control" placeholder="Physical IP Address" wire:model="U_ip">   
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
