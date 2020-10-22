<div style="padding:0 15px;">
    <div class="container">
    <div class="jumbotron"> 
      <h3 class="registration_form_header">Notification</h3>
    </div> <!-- end of jumbotron -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">        

            <div class="row" style="padding-left: 20px; padding-right: 20px;">                
                <div class="col-md-1"></div>
                <?php if($detail_notification['status'] == 'HR_approval'):?>
                <div class="col-md-10" style="text-align: center;"><h3>Heritage Approval</h3></div>                
                <?php elseif($detail_notification['status'] == 'HR_rejection'):?>
                <div class="col-md-10" style="text-align: center;"><h3>Heritage Rejection</h3></div>                
                <?php elseif($detail_notification['status'] == 'MR_approval'):?>
                <div class="col-md-10" style="text-align: center;"><h3>Maintenance Request Approval</h3></div>                
                <?php elseif($detail_notification['status'] == 'MR_rejection'):?>
                <div class="col-md-10" style="text-align: center;"><h3>Maintenance Request Rejection</h3></div>                
                <?php elseif($detail_notification['status'] == 'MR_maintained'):?>
                <div class="col-md-10" style="text-align: center;"><h3>Maintained Heritage</h3></div>
                <?php endif; ?>
                <div class="col-md-1"></div>
            </div><!-- end of row -->

            <div class="row" style="padding-left: 20px; padding-right: 20px; margin-top: 10px; margin-bottom: 30px;">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <p><?php echo $detail_notification['description'] ?></p>
                    <hr>
                    <span><i><?php echo $detail_notification['date'] ?></i></span>
                </div>
                <div class="col-md-2"></div>
            </div><!-- end of row -->

            <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="form-group">
                        <?php if($detail_notification['roll'] !== 'System'):?>
                            <button type="button" class="btn btn-primary btn-block" data-toggle = "modal" data-target = "#preview_modal">Preview Attachement</button>
                        <?php endif; ?>

                        <div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="preview_modal_label" aria-hidden = "true">
                           <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h3 class="modal-title" id="preview_modal_label" style="font-family: Gabrola; text-align: center;">Attachement</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 </div>
                                 <div class="modal-body">                    
                                    <div>

                <?php if($detail_notification['status'] == 'HR_approval'):?>
                    <?php if($detail_notification['roll'] == 'ZR'):?>

                        <object data="<?php echo base_url('assets/heritage/zone_approval_attachement/' .$attachement['zone_approval_attachement']);?>" height = "600px" width="880px">                            
                        </object>
                        
                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RR'):?>

                        <object data="<?php echo base_url('assets/heritage/regional_approval_attachement/' .$attachement['regional_approval_attachement']);?>" height = "600px" width="880px"></object>
                    
                    <?php endif; ?>            
                <?php elseif($detail_notification['status'] == 'HR_rejection'):?>
                    <?php if($detail_notification['roll'] == 'ZR'):?>

                        <object data="<?php echo base_url('assets/heritage/zone_rejection_attachement/' .$attachement['zone_rejection_attachement']);?>" height = "600px" width="880px">                            
                        </object>
                        
                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RR'):?>

                        <object data="<?php echo base_url('assets/heritage/regional_rejection_attachement/' .$attachement['regional_rejection_attachement']);?>" height = "600px" width="880px">     
                        </object>

                    <?php endif; ?>                
                <?php elseif($detail_notification['status'] == 'MR_approval'):?>
                    <?php if($detail_notification['roll'] == 'ZME'):?>

                        <object data="<?php echo base_url('assets/heritage/zme_approval_attachement/' .$attachement['zme_approval_reason_file']);?>" height = "600px" width="880px">     
                        </object>
                        
                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RME'):?>

                        <object data="<?php echo base_url('assets/heritage/rme_approval_attachement/' .$attachement['rme_approval_reason_file']);?>" height = "600px" width="880px">     
                        </object>

                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RD'):?>

                        <object data="<?php echo base_url('assets/heritage/rd_approval_attachement/' .$attachement['rd_approval_reason_file']);?>" height = "600px" width="880px">     
                        </object>
                        
                    <?php endif; ?>               
                <?php elseif($detail_notification['status'] == 'MR_rejection'):?>
                    <?php if($detail_notification['roll'] == 'ZME'):?>

                        <object data="<?php echo base_url('assets/heritage/zme_rejection_attachement/' .$attachement['zme_rejection_file']);?>" height = "600px" width="880px">     
                        </object>
                        
                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RME'):?>

                        <object data="<?php echo base_url('assets/heritage/rme_rejection_attachement/' .$attachement['rme_rejection_file']);?>" height = "600px" width="880px">     
                        </object>

                    <?php endif; ?>
                    <?php if($detail_notification['roll'] == 'RD'):?>

                        <object data="<?php echo base_url('assets/heritage/rd_rejection_attachement/' .$attachement['rd_rejection_file']);?>" height = "600px" width="880px">     
                        </object>
                        
                    <?php endif; ?>                
                <?php elseif($detail_notification['status'] == 'MR_maintained'):?>
                    <?php if($detail_notification['roll'] == 'WR'):?>

                        <object data="<?php echo base_url('assets/maintained_heritage/' .$attachement['maintenance_confirmation_file']);?>" height = "600px" width="880px">     
                        </object>
                    
                    <?php endif; ?> 
                <?php endif; ?>

                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                    
                                 </div>                           
                              </div>
                           </div>                           
                        </div>                   
                        </div>
                    </div>                    
                    <div class="col-md-2"></div>                
            </div><!-- end of row -->                            
        </div><!-- end of col 6 offset -->
    </div><!-- end of row -->
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#create').click(function(event){
            var val = $('#heritage_category').val();
            if(val == "Select_Category"){
                event.preventDefault();
                $('#heritage_category').addClass('error_username');                        
            }

        });
    });

</script>