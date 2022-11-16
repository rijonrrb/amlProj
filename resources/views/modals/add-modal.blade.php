<div class="modal fade addCountry mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
               <form wire:submit.prevent="save">
                   <div class="tabU">
                       
                       <h3 align ="center">User Info</h3>
                       <div class="form-group">
                           <label for="">User Name</label>
                           <input type="text" class="form-control" placeholder="User Name"  wire:model="user_name">
                           <span class="text-danger"> @error('user_name') {{ $message }}@enderror</span>
                       </div>
                       <div class="form-group">
                        <label for="">Department</label>
                        <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model="dept"  style="display: block;" id="idept">
                            <select wire:model ="dept" class="form-control col-9 mr-3"  style="display: none;" id="sdept">
                                <option value="" disabled selected hidden>Select Department</option>
                                @foreach ($depts as $dept)
                                <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="cdept" style="display: block;">Options</button>
                        </div>
                        <span class="text-danger"> @error('dept') {{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                       <label for="">Desigation</label>
                       <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Desigation" wire:model="desigation" style="display: block;" id="ides">
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
                       <label for="">Work-Station</label>
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
                       <label for="">Product Type</label>
                       <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Product Type" wire:model="item" style="display: block;" id="iProd">
                            <select wire:model ="item" class="form-control col-9 mr-3"  style="display: none;" id="sProd">
                                <option value="" disabled selected hidden>Select Product</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Printer">Printer</option>
                                <option value="Scanner">Scanner</option>
                                <option value="Router">Router</option>
                                <option value="Switch">Switch</option>
                                <option value="Projector">Projector</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Keyboard">Keyboard</option>
                                <option value="RAM">RAM</option>
                                <option value="SSD">SSD</option> 
                                <option value="HDD">HDD</option> 
                            </select>
                            <button type="button" class="btn btn-primary btn-sm col-3" id="cProd" style="display: block;">Options</button>
                        </div>    
                   </div>
                   <div class="form-group">
                       <label for="">Product Model</label>
                       <input type="text" class="form-control" placeholder="Product Model" wire:model="laptop_name" >
                   </div>

                     <div class="form-group">
                       <label for="">Product Serial No</label>
                       <input type="text" class="form-control" placeholder="Serial No" wire:model="serial_no" >
                   </div>
                   <div class="form-group">
                       <label for="">Configuration</label>
                       <textarea  class="form-control" placeholder="Configuration" wire:model="configuration" ></textarea>
                   </div>
               </div>
               
               <div class="tabH" style="display: none;">
                <h3 align ="center">Handover Info</h3>
                <div class="form-group">
                   <label for="">Handover by</label>
                   <input type="text" class="form-control" placeholder="Handover by" wire:model.debounce.500000ms="H_user" >
               </div>
               <div class="form-group">
                   <label for="">Designation</label>
                   <div class="container row">
                            <input type="text" class="form-control col-8 mr-3" placeholder="Desigation" wire:model.debounce.500000ms="H_designation" style="display: block;" id="H_ides">
                            <select wire:model.debounce.500000ms="H_designation" class="form-control col-9 mr-3"  style="display: none;" id="H_sdes">
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
                            <button type="button" class="btn btn-primary btn-sm col-3" id="H_cdes" style="display: block;">Options</button>
                        </div>  
               </div>
               <div class="form-group">
                <label for="">Department</label>
                <div class="container row">
                    
                    <input type="text" class="form-control col-8 mr-3" placeholder="Department" wire:model.debounce.500000ms="H_dept"  style="display: block;" id="H_idept">
                    <select wire:model.debounce.500000ms ="H_dept" class="form-control col-9 mr-3"  style="display: none;" id="H_sdept">
                        <option value="" disabled selected>Select Department</option>
                        @foreach ($depts as $dept)
                        <option value="{{ $dept->dept_name }}">{{$dept->dept_name}}</option> 
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary btn-sm col-3" id="H_cdept" style="display: block;">Options</button>
                </div>
            </div>
            <div class="form-group">
                       <label for="">Work-Station</label>
                       <select wire:model.debounce.500000ms="H_wstation" class="form-control" >
                                <option value="" disabled selected hidden>Select Work-Station</option>
                                <option value="CHO">CHO</option>
                                <option value="Depo">Depo</option>
                                <option value="Factory">Factory</option>
                                <option value="Project">Project</option>
                        </select>
            </div>

       </div>
       <div class="form-group">
           <button type="button" id="close" data-dismiss="modal">Close</button>
           <button type="button" style="display: none;" id="prevBtn" onclick="prev()">Previous</button>
           <button type="button" id="nextBtn" onclick="next()">Next</button>
           <button type="submit" style="display: none;" id="sub">Save</button>
       </div>
       <div style="text-align:center;margin-top:10px;">
        <span class="actives"></span>
        <span class="step"></span>
    </div>
</form>

</div>
</div>
</div>
</div>