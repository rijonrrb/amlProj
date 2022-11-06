<div class="modal fade addP mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
            <div class="modal-body">
                 <form wire:submit.prevent="save">
                 <div class="PtabU">
                     
                     <h3 align ="center">User Info</h3>
                     <div class="form-group">
                         <label for="">User Name</label>
                         <input type="text" class="form-control" placeholder="User Name"  wire:model="user_name">
                         <span class="text-danger"> @error('user_name') {{ $message }}@enderror</span>
                     </div>

                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                        <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model="dept"  style="display: block;" id="ideptP">
                        <select wire:model ="dept" class="form-control col-9 mr-3"  style="display: none;" id="sdeptP">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-3" id="cdeptP" style="display: block;">Options</button>
                        </div>
                        <span class="text-danger"> @error('dept') {{ $message }}@enderror</span>
                     </div>


                     <div class="form-group">
                         <label for="">Desigation</label>
                         <input type="text" class="form-control" placeholder="Desigation" wire:model="desigation" >
                         <span class="text-danger"> @error('desigation') {{ $message }}@enderror</span>
                     </div>

                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model="unit" >
                         <span class="text-danger"> @error('unit') {{ $message }}@enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="">Item</label>
                         <input type="text" class="form-control" placeholder="Item" wire:model="item" >
                     </div>
                     <div class="form-group">
                         <label for="">Item Name</label>
                         <input type="text" class="form-control" placeholder="Item Name" wire:model="laptop_name" >
                     </div>
                     <div class="form-group">
                         <label for="">Asset No</label>
                         <input type="text" class="form-control" placeholder="Asset No" wire:model="asset_no" >
                     </div>
                     <div class="form-group">
                         <label for="">Serial No</label>
                         <input type="text" class="form-control" placeholder="Serial No" wire:model="serial_no" >
                     </div>

                     <div class="form-group">
                         <label for="">Configuration</label>
                         <textarea  class="form-control" placeholder="Configuration" wire:model="configuration" ></textarea>

                     </div>
                     </div>
       
                    <div class="PtabH" style="display: none;">
                    <h3 align ="center">Handover Info</h3>
                    <div class="form-group">
                         <label for="">Handover by</label>
                         <input type="text" class="form-control" placeholder="Handover by" wire:model.debounce.500000ms="H_user" >
                     </div>
                     <div class="form-group">
                         <label for="">Designation</label>
                         <input type="text" class="form-control" placeholder="Designation" wire:model.debounce.500000ms="H_designation" >

                     </div>
                     <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                            
                        <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model.debounce.500000ms="H_dept"  style="display: block;" id="H_ideptP">
                        <select wire:model.debounce.500000ms ="H_dept" class="form-control col-9 mr-3"  style="display: none;" id="H_sdeptP">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-3" id="H_cdeptP" style="display: block;">Options</button>
                        </div>
                     </div>
                     <div class="form-group">
                         <label for="">Unit</label>
                         <input type="text" class="form-control" placeholder="Unit" wire:model.debounce.500000ms="H_unit" >
                     </div>
                    </div>

                    <div class="form-group">
                         <button type="button" id="close" data-dismiss="modal">Close</button>
                         <button type="button" style="display: none;" id="PprevBtn" onclick="Pprev()">Previous</button>
                         <button type="button" id="PnextBtn" onclick="Pnext()">Next</button>
                         <button type="submit" style="display: none;" id="Psub">Save</button>
                     </div>

                        <div style="text-align:center;margin-top:10px;">
                        <span class="Pactives"></span>
                        <span class="Pstep"></span>
                        </div>

                 </form>
                
            </div>
        </div>
    </div>
</div>