<div class="modal fade updateRow mt-5" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form wire:submit.prevent="updateRow">
                 <h3 align ="center">Admin Info Update</h3>             
                <div class="form-group">
                    <label for="">Admin Name</label>
                    <input type="text" class="form-control" placeholder="Admin Name"  wire:model="U_Admin_name">
                </div>
                <div class="form-group">
                    <label for="">Admin Email</label>
                    <input type="email" class="form-control" placeholder="Admin Email"  wire:model="U_Admin_email">
                </div>
                <h6 class="ml-2 mt-5">Admin Privileges</h6>
              <div class="row ml-3">
                <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="create" wire:model="U_Create" value="True">
                  <label class="custom-control-label" for="customCheck1">Create</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck2" name="update" wire:model="U_Update" value="True">
                  <label class="custom-control-label" for="customCheck2">update</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck5" name="issue" wire:model="U_Delete" value="True">
                  <label class="custom-control-label" for="customCheck5">Issue/Re-Issue</label >
              </div>
              </div>
              <div class="row ml-3">
                <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck3" name="delete" wire:model="U_Issue" value="True">
                  <label class="custom-control-label" for="customCheck3">Delete</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
                  <input type="checkbox" class="custom-control-input" id="customCheck6" name="return" wire:model="U_Return" value="True">
                  <label class="custom-control-label" for="customCheck6">Return</label >
              </div>
              <div class="custom-control custom-checkbox mt-3 col">     
              </div>   
              </div> 
             <div class="form-group mt-5">
                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
             </div>

         </form>
     </div>
 </div>
</div>
</div>
