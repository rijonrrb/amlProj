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
                       <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Desigation" wire:model="upd_H_designation" style="display: block;" id="UH_ides">
                            <select wire:model ="upd_H_designation" class="form-control col-9 mr-3"  style="display: none;" id="UH_sdes">
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
                            <button type="button" class="btn btn-primary btn-sm col-3" id="UH_cdes" style="display: block;">Options</button>
                        </div>  
                       <span class="text-danger"> @error('upd_H_designation') {{ $message }}@enderror</span>
                   </div>
                   <div class="form-group">
                    <label for="">Department</label>
                    <div class="container row">                  
                        <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model="upd_H_dept"  style="display: block;" id="UH_idept">
                        <select wire:model="upd_H_dept" class="form-control col-9 mr-3"  style="display: none;" id="UH_sdept">
                            <option value="" disabled selected>Select Department</option>
                            @foreach ($depts as $dept)
                            <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary btn-sm col-3" id="UH_cdept" style="display: block;">Options</button>
                    </div>
                    <span class="text-danger"> @error('upd_H_dept') {{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                       <label for="">Work-Station</label>
                       <select wire:model="upd_H_wstation" class="form-control" >
                                <option value="" disabled selected hidden>Select Work-Station</option>
                                <option value="CHO">CHO</option>
                                <option value="Depo">Depo</option>
                                <option value="Factory">Factory</option>
                                <option value="Project">Project</option>
                        </select>
                       <span class="text-danger"> @error('upd_H_wstation') {{ $message }}@enderror</span>
                   </div>
                <!-- <div class="form-group">
                   <label for="">Unit</label>
                   <select wire:model="upd_H_unit" class="form-control" >
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
                   <span class="text-danger"> @error('upd_H_unit') {{ $message }}@enderror</span>
               </div> -->
               <div class="form-group">
                   <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
               </div>
           </form>
           
       </div>
   </div>
</div>
</div>