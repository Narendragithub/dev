 <form role="form" action="<?php echo url('project/submit_transfer'); ?>" method="post" id="service">
          <?php echo csrf_field(); ?>
      <input class="form-control input-sm" id="" type="hidden" value="<?php echo $project->id; ?>" name="pid">
      <input class="form-control input-sm" id="" type="hidden" value="<?php echo $transfer_project->id; ?>" name="rid">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title text-center">Transfer Project</h4>
            </div>
            <div class="modal-body model-min-height text-center">
                
                    <div class="row col-md-10 col-md-offset-1">
                    <div class="input-group">                              
                                        <div class="fg-line">
                                         Project Title -  <?php echo $project->title; ?>
                                        </div>                                    
                                    </div>
                    <div class="input-group">                                   
                                        <div class="fg-line">
                                         Sender Name -  <?php echo $user->firstname." ".$user->lastname; ?>
                                        </div>                                      
                                    </div>
                    </div>
                <div class="row col-md-12">&nbsp;</div>
                    <div class="row">
                
                <label class="radio radio-inline m-r-20">
                    <button type="submit" name="accept" class="btn btn-success">Accept</button>
                </label>
               <label class="radio radio-inline m-r-20">
                   <button type="submit" name="reject" class="btn btn-danger">Reject</button>
               </label>
                    </div>
               <div class="">
                  <span id="errorplace" class="text-center"></span>
               </div>
            
            <hr />
          
         </div>
      
   </div></form>

