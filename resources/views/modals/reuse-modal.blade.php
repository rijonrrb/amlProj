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
                            <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model="r_dept"  style="display: block;" id="r_idept">
                            <select wire:model ="r_dept" class="form-control col-9 mr-3"  style="display: none;" id="r_sdept">
                                <option value="" disabled selected>Select Department</option>
                                @foreach ($depts as $dept)
                                <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="r_cdept" style="display: block;">Options</button>
                        </div>
                        <span class="text-danger"> @error('r_dept') {{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                       <label for="">Desigation</label>
                       <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Desigation" wire:model="r_desigation" style="display: block;" id="r_ides">
                            <select wire:model ="r_desigation" class="form-control col-9 mr-3"  style="display: none;" id="r_sdes">
                                <option value="" disabled selected hidden>Select Desigation</option>
                                <option value="Chief executive officer">Chief executive officer</option>
                                <option value="Chief Technology Officer">Chief Technology Officer</option>
                                <option value="Chief Financial Officer">Chief Financial Officer</option>
                                <option value="Chief Operating Officer">Chief Operating Officer</option>
                                <option value="Project Director">Project Director</option>
                                <option value="Executive Director">Executive Director</option>
                                <option value="General Manager">General Manager</option>
                                <option value="Deputy General Manager">Deputy General Manager</option>
                                <option value="Asst. General Manager">Asst. General Manager</option> 
                                <option value="Manager">Manager</option> 
                                <option value="Deputy Manager">Deputy Manager</option> 
                                <option value="Asst. Manager">Asst. Manager</option> 
                                <option value="Senior Officer">Senior Officer</option> 
                                <option value="Senior Executive">Senior Executive</option> 
                                <option value="Officer">Officer</option> 
                                <option value="Executive">Executive</option> 
                                <option value="Junior Officer">Junior Officer</option> 
                                <option value="Junior Executive">Junior Executive</option> 
                                <option value="Intern">Intern</option> 
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="r_cdes" style="display: block;">Options</button>
                        </div>   
                       <span class="text-danger"> @error('r_desigation') {{ $message }}@enderror</span>
                   </div>
                   <div class="form-group">
                       <label for="">Unit</label>
                       <select wire:model="r_unit" class="form-control" >
                                <option value="" disabled selected hidden>Select Unit</option>
                                <option value="Igloo Ice Cream Unit">Igloo Ice Cream Unit</option>
                                <option value="Igloo Dairy Unit">Igloo Dairy Unit</option>
                                <option value="Igloo Foods Unit">Igloo Foods Unit</option>
                                <option value="AML Construction Unit">AML Construction Unit</option>
                                <option value="AML Dredging Unit">AML Dredging Unit</option>
                                <option value="AML Sugar Refinery Unit">AML Sugar Refinery Unit</option>
                                <option value="AML Beverage Unit">AML Beverage Unit</option>
                                <option value="AML Bran Oil Unit">AML Bran Oil Unit</option>
                        </select>
                       <span class="text-danger"> @error('r_unit') {{ $message }}@enderror</span>
                   </div>
               </div>
               
               <div class="r_tabH" style="display: none;">
                <h3 align ="center">Handover Info</h3>
                <div class="form-group">
                   <label for="">Handover by</label>
                   <input type="text" class="form-control" placeholder="Handover by" wire:model.debounce.500000ms="r_H_user" >
                   <span class="text-danger"> @error('r_H_user') {{ $message }}@enderror</span>
               </div>
               <div class="form-group">
                   <label for="">Designation</label>
                   <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Desigation" wire:model.debounce.500000ms="r_H_designation" style="display: block;" id="r_H_ides">
                            <select wire:model.debounce.500000ms="r_H_designation" class="form-control col-9 mr-3"  style="display: none;" id="r_H_sdes">
                                <option value="" disabled selected hidden>Select Desigation</option>
                                <option value="Chief executive officer">Chief executive officer</option>
                                <option value="Chief Technology Officer">Chief Technology Officer</option>
                                <option value="Chief Financial Officer">Chief Financial Officer</option>
                                <option value="Chief Operating Officer">Chief Operating Officer</option>
                                <option value="Project Director">Project Director</option>
                                <option value="Executive Director">Executive Director</option>
                                <option value="General Manager">General Manager</option>
                                <option value="Deputy General Manager">Deputy General Manager</option>
                                <option value="Asst. General Manager">Asst. General Manager</option> 
                                <option value="Manager">Manager</option> 
                                <option value="Deputy Manager">Deputy Manager</option> 
                                <option value="Asst. Manager">Asst. Manager</option> 
                                <option value="Senior Officer">Senior Officer</option> 
                                <option value="Senior Executive">Senior Executive</option> 
                                <option value="Officer">Officer</option> 
                                <option value="Executive">Executive</option> 
                                <option value="Junior Officer">Junior Officer</option> 
                                <option value="Junior Executive">Junior Executive</option> 
                                <option value="Intern">Intern</option> 
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="r_H_cdes" style="display: block;">Options</button>
                        </div>   
                   <span class="text-danger"> @error('r_H_designation') {{ $message }}@enderror</span>
               </div>
               <div class="form-group">
                <label for="">Department</label>
                <div class="container row">
                    
                    <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model.debounce.500000ms="r_H_dept"  style="display: block;" id="r_H_idept">
                    <select wire:model.debounce.500000ms ="r_H_dept" class="form-control col-9 mr-3"  style="display: none;" id="r_H_sdept">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary btn-sm col-3" id="r_H_cdept" style="display: block;">Options</button>
                </div>
                <span class="text-danger"> @error('r_H_dept') {{ $message }}@enderror</span>
            </div>
            <!-- <div class="form-group">
               <label for="">Unit</label>
               <select  wire:model.debounce.500000ms="r_H_unit" class="form-control" >
                                <option value="" disabled selected hidden>Select Unit</option>
                                <option value="Igloo Ice Cream Unit">Igloo Ice Cream Unit</option>
                                <option value="Igloo Dairy Unit">Igloo Dairy Unit</option>
                                <option value="Igloo Foods Unit">Igloo Foods Unit</option>
                                <option value="AML Construction Unit">AML Construction Unit</option>
                                <option value="AML Dredging Unit">AML Dredging Unit</option>
                                <option value="AML Sugar Refinery Unit">AML Sugar Refinery Unit</option>
                                <option value="AML Beverage Unit">AML Beverage Unit</option>
                                <option value="AML Bran Oil Unit">AML Bran Oil Unit</option>
                        </select>
               <span class="text-danger"> @error('r_H_unit') {{ $message }}@enderror</span>
           </div> -->
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