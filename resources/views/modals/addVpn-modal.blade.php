<div class="modal fade addVpn mt-5" wire:ignore.self role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
             <form wire:submit.prevent="save">
                 <h3 align ="center">Vpn Info</h3>
                <div class="form-group">
                    <!-- <label for="">User</label>
                    <select wire:model.debounce.0ms.debounce.500000ms="userid" class="selectpicker" data-live-search="true" data-container="body">
                    <option value="" disabled selected hidden>Select User</option>
                    <option data-tokens="No" value="No">No User</option>
                    @foreach ($Userlists as $Userlist)
                    <option data-tokens="{{ $Userlist->userid }}" value="{{ $Userlist->userid }}" data-subtext="{{$Userlist->desigation}}">{{$Userlist->name}}#{{$Userlist->userid}}</option> 
                    @endforeach
                    </select>
                    <span class="text-danger"> @error('userid') {{ $message }}@enderror</span> -->

                    <label for="">User</label><br>
                    <select wire:model.debounce.0ms="userid" class="form-control" data-live-search="true" data-size="5" id="select_page" data-live-search-placeholder="Search your user"  data-style="btn btn-outline-secondary">
                    <option value="" disabled selected hidden>Select User</option>
                    <option value="No">&nbsp No User</option>
                    @foreach ($Userlists as $Userlist)
                    <option value="{{ $Userlist->userid }}" data-subtext="({{$Userlist->desigation}})">&nbsp {{$Userlist->name}}#{{$Userlist->userid}}</option> 
                    @endforeach
                    </select><br>
                    <span class="text-danger"> @error('userid') {{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" class="form-control" placeholder="Username" wire:model.debounce.0ms="name">
                     <span class="text-danger"> @error('name') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">Password</label>
                     <input type="text" class="form-control" placeholder="Password" wire:model.debounce.0ms="password">
                     <span class="text-danger"> @error('password') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">Ip Address</label>
                     <input type="text" class="form-control" placeholder="Example: 192.168.1.1" wire:model.debounce.0ms="ip">
                     <span class="text-danger"> @error('ip') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                    <label for="">Remark</label>
                    <textarea  class="form-control" placeholder="Remark" wire:model.debounce.0ms="remark" ></textarea>
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