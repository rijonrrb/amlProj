<div class="modal fade addUser mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
             <form wire:submit.prevent="save">
                 <h3 align ="center">User Info</h3>
                 <div class="form-group">
                     <label for="">User Name</label>
                     <input type="text" class="form-control" placeholder="User Name" wire:model="name" >
                     <span class="text-danger"> @error('name') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">User Email</label>
                     <input type="email" class="form-control" placeholder="User Email" wire:model="email" >
                 </div>
                 <div class="form-group">
                     <label for="">User Phone</label>
                     <input type="text" class="form-control" placeholder="User Phone" wire:model="phone" >
                 </div>
                 <div class="form-group">
                     <label for="">User Desigation</label>
                     <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="User Desigation" wire:model="desigation" style="display: block;" id="ides">
                            <select wire:model ="desigation" class="form-control col-9 mr-3"  style="display: none;" id="sdes">
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
                            <button type="button" class="btn btn-primary btn-sm col-3" id="cdes" style="display: block;">Options</button>
                        </div>                          
                       <span class="text-danger"> @error('desigation') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">User Department</label>
                     <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="User Department" wire:model="dept"  style="display: block;" id="idept">
                            <select wire:model ="dept" class="form-control col-9 mr-3"  style="display: none;" id="sdept">
                                <option value="" disabled selected hidden>Select Department</option>
                                <option value="HR">HR</option>
                                <option value="IT">IT</option>
                                <option value="MIS">MIS</option>
                                <option value="Audit">Audit</option>
                                <option value="Sales">Sales</option>
                                <option value="Procument">Procument</option>
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="cdept" style="display: block;">Options</button>
                        </div>
                        <span class="text-danger"> @error('dept') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">User Work-Station</label>
                     <select wire:model="wstation" class="form-control" >
                                <option value="" disabled selected hidden>Select Work-Station</option>
                                <option value="CHO">CHO</option>
                                <option value="Depo">Depo</option>
                                <option value="Factory">Factory</option>
                                <option value="Project">Project</option>
                        </select>
                       <span class="text-danger"> @error('wstation') {{ $message }}@enderror</span>
                 </div>
                 <div class="form-group">
                     <label for="">User Unit</label>
                     <select wire:model ="unit" class="form-control">
                                <option value="" disabled selected hidden>Select Unit</option>
                                <option value="Igloo Ice Cream">Igloo Ice Cream</option>
                                <option value="Igloo Dairy">Igloo Dairy</option>
                                <option value="Igloo Foods">Igloo Foods</option>
                                <option value="AML Construction">AML Construction</option>
                                <option value="AML Dredging">AML Dredging</option>
                                <option value="AML Sugar Refinery">AML Sugar Refinery</option>
                                <option value="AML Beverage">AML Beverage</option>
                                <option value="AML Bran Oil">AML Bran Oil</option>
                            </select>
                     <span class="text-danger"> @error('unit') {{ $message }}@enderror</span>
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