<div class="modal fade returnCountry" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                 <form wire:submit.prevent="update">
                     <input type="hidden" wire:model="cid">
                     <h3 align ="center">Takeover Info</h3>
                    <div class="form-group">
                         <label for="">Takeover by</label>
                         <input type="text" class="form-control" placeholder="Takeover by" wire:model="upd_H_user" >
                         <span class="text-danger"> @error('upd_H_user') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Designation</label>
                         <input type="text" class="form-control" placeholder="Designation" wire:model="upd_H_designation" >
                         <span class="text-danger"> @error('upd_H_designation') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                            
                        <input type="text" class="form-control col-9 mr-3" placeholder="Department" wire:model="upd_H_dept"  style="display: block;" id="UH_idept">
                        <select wire:model="upd_H_dept" class="form-control col-9 mr-3"  style="display: none;" id="UH_sdept">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-2" id="UH_cdept" style="display: block;">Options</button>
                        </div>
                        <span class="text-danger"> @error('upd_H_dept') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model="upd_H_unit" >
                         <span class="text-danger"> @error('upd_H_unit') {{ $message }}@enderror</span>
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