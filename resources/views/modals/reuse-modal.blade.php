<div class="modal fade reuse" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                 <form wire:submit.prevent="reuseProd">
                     <input type="hidden" wire:model="rid">
                 <div class="r_tabU">
                     
                     <h3 align ="center">User Info</h3>
                     <div class="form-group">
                         <label for="">User Name</label>
                         <input type="text" class="form-control" placeholder="User Name"  wire:model="r_user_name">
                         <span class="text-danger"> @error('r_user_name') {{ $message }}@enderror</span>
                     </div>

                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                        <input type="text" class="form-control col-9 mr-3" placeholder="Department" wire:model="r_dept"  style="display: block;" id="r_idept">
                        <select wire:model ="r_dept" class="form-control col-9 mr-3"  style="display: none;" id="r_sdept">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-2" id="r_cdept" style="display: block;">Options</button>
                        </div>
                     </div>


                     <div class="form-group">
                         <label for="">Desigation</label>
                         <input type="text" class="form-control" placeholder="Desigation" wire:model="r_desigation" >
                         <span class="text-danger"> @error('r_desigation') {{ $message }}@enderror</span>
                     </div>

                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model="r_unit" >
                         <span class="text-danger"> @error('r_unit') {{ $message }}@enderror</span>
                     </div>

                     </div>
       
                    <div class="r_tabH" style="display: none;">
                    <h3 align ="center">Handover Info</h3>
                    <div class="form-group">
                         <label for="">Handover by</label>
                         <input type="text" class="form-control" placeholder="Handover by" wire:model.debounce.500000ms="r_H_user" >
                         <span class="text-danger"> @error('r_configuration') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Designation</label>
                         <input type="text" class="form-control" placeholder="Designation" wire:model.debounce.500000ms="r_H_designation" >
                         <span class="text-danger"> @error('r_configuration') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                            
                        <input type="text" class="form-control col-9 mr-3" placeholder="Department" wire:model.debounce.500000ms="r_H_dept"  style="display: block;" id="r_H_idept">
                        <select wire:model.debounce.500000ms ="r_H_dept" class="form-control col-9 mr-3"  style="display: none;" id="r_H_sdept">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-2" id="r_H_cdept" style="display: block;">Options</button>
                        </div>
                     </div>
                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model.debounce.500000ms="r_H_unit" >
                         <span class="text-danger"> @error('r_configuration') {{ $message }}@enderror</span>
                     </div>
                    </div>

                    <div class="form-group">
                         <button type="button" id="r_close" data-dismiss="modal">Close</button>
                         <button type="button" style="display: none;" id="r_prevBtn" onclick="r_prev()">Previous</button>
                         <button type="button" id="r_nextBtn" onclick="r_next()">Next</button>
                         <button type="submit" style="display: none;" id="r_sub">Save</button>
                     </div>

                        <div style="text-align:center;margin-top:10px;">
                        <span class="r_actives"></span>
                        <span class="r_step"></span>
                        </div>

                 </form>
                
            </div>
        </div>
    </div>
</div>