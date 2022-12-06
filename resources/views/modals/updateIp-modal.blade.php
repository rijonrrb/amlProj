<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>           
                <div class="form-group">
                <label for="">User</label>
                <select wire:model.debounce.0ms ="U_user" class="form-control" data-live-search="true" data-size="5" id="select_page" data-live-search-placeholder="Search your user"  data-style="btn btn-outline-secondary">
                <option value="" disabled selected hidden>Select User</option>
                <option value="">&nbsp No User</option>
                @foreach ($Userlists as $Userlist)
                <option value="{{ $Userlist->userid }}" data-subtext="({{$Userlist->desigation}})">&nbsp {{$Userlist->name}} &nbsp#{{$Userlist->userid}}</option> 
                @endforeach
                </select>
                </div>
                <div class="form-group">
                <label for="">Physical Address</label>
                <input type="text" class="form-control" placeholder="Physical IP Address" wire:model.debounce.0ms="U_padd">   
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
