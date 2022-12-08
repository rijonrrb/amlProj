<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">User Info Update</h3>
                 
             <div class="form-group">
                 <label for="">User Name</label>
                 <input type="text" class="form-control" placeholder="User Name"  wire:model="U_user_name">
             </div>
             <div class="form-group">
                 <label for="">User Email</label>
                 <input type="email" class="form-control" placeholder="User Email"  wire:model="U_user_email">
             </div>
             <div class="form-group">
                 <label for="">User Phone No.</label>
                 <input type="text" class="form-control" placeholder="User Phone No."  wire:model="U_user_phone">
             </div>
             <div class="form-group">
                 <label for="">Desigation</label>
                 <input type="text" class="form-control" placeholder="Desigation" wire:model="U_desigation">
             </div>
             <div class="form-group">
                 <label for="">Department</label>
                 <input type="text" class="form-control" placeholder="Department" wire:model="U_dept">
             </div>
             <div class="form-group">
                 <label for="">Work-Station</label>
                 <select wire:model ="U_wstation" class="form-control">
                    <option value="CHO">CHO</option>
                    <option value="Project">Project</option>
                    <option value="Factory">Factory</option>
                    <option value="Depo">Depo</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="">Working Unit</label>
                 <select wire:model ="U_unit" class="form-control">
                    <option value="Igloo Ice Cream Unit">Igloo Ice Cream</option>
                    <option value="Igloo Dairy Unit">Igloo Dairy</option>
                    <option value="Igloo Foods Unit">Igloo Foods</option>
                    <option value="AML Construction Unit">AML Construction</option>
                    <option value="AML Dredging Unit">AML Dredging</option>
                    <option value="AML Sugar Refinery Unit">AML Sugar Refinery</option>
                    <option value="AML Beverage Unit">AML Beverage</option>
                    <option value="AML Bran Oil Unit">AML Bran Oil</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="">IP Address</label>
                 <input type="text" class="form-control" placeholder="User IP" wire:model="U_ip">   
             </div>
             <div class="form-group">
                 <label for="">VPN</label>
                 <input type="text" class="form-control" placeholder="User VPN" wire:model="U_vpn" >
             </div>
             <div class="form-group">
                 <label for="">User Category</label>
                 <select wire:model ="U_categories" class="form-control">
                    <option value="Active">Active User</option>
                    <option value="Deactivated">Deactivated User</option>
                 </select>
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
