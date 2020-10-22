<div style="padding:0 15px;">
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
   <div class="row">
      <div class="jumbotron">
            <div class="form-group">
               <h3 class="registration_form_header"><?php echo lang('List of Maintenance Request');?></h3>
            </div>
         </div><!-- end of jumbotron -->
      <div class="col-md-3 menu_wr">
         <div class="list_of_menu">
               <ul>

               <?php if($this->session->userdata('userroll') == 'WR'):?>
                  <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_sent_by_wr');?>">
                     <span class="glyphicon glyphicon-cog"></span><?php echo lang('View Maintenance Request');?></a></li>
                  <li><a href="<?php echo base_url('report/approved_maintenance_request');?>">
                     <span class="glyphicon glyphicon-duplicate"></span> <?php echo lang('Generate Report');?></a></li>
               <?php endif;?>

               <?php if($this->session->userdata('userroll') == 'ZME'):?>
                  <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_zme');?>">
                     <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
                  <li><a href="<?php echo base_url('report/maintenance_request_approved_by_zme');?>">
                     <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
               <?php endif;?>

               <?php if($this->session->userdata('userroll') == 'RME'):?>
                  <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rme');?>">
                     <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
                  <li><a href="<?php echo base_url('report/maintenance_request_approved_by_rme');?>">
                     <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
               <?php endif;?>

               <?php if($this->session->userdata('userroll') == 'RD'):?>
                  <li><a href="<?php echo base_url('employee/');?>"><span class="glyphicon glyphicon-plus">   </span>Create Account</a></li>
                  <li><a href="<?php echo base_url('heritage/list_of_heritage_needs_rr_approval');?>">
                     <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
                  <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                     <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
                  <li><a href="<?php echo base_url('report/maintenance_request_approved_by_rd');?>">
                     <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
               <?php endif;?>
         
               </ul>
            </div>
      </div>
      <div class="col-md-9 list_of_heritage">
         <div class="row">
         
              <div class="col-md-3">
                  <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_need_approval' id="btn_sent"><?php echo lang('Sent Maintenance Request');?></button>
                  <?php elseif ($this->session->userdata('userroll') == 'ZME'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_need_approval' id="btn_need_zme_approval">Request Needs ZME Approval</button>
                  <?php elseif($this->session->userdata('userroll') == 'RME'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_need_approval' id="btn_need_rme_approval">Request Needs RME Approval</button>
                  <?php elseif($this->session->userdata('userroll') == 'RD'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_need_approval' id="btn_need_rd_approval">Request Needs RD Approval</button>
                  <?php endif ?>
              </div>
              <div class="col-md-3">
                  <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rd_approved' id="btn_approved_mr"><?php echo lang('Approved Maintenance Request');?></button>
                  <?php elseif ($this->session->userdata('userroll') == 'ZME'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rd_approved' id="btn_approved_by_zme">Request Approved By ZME</button>
                  <?php elseif($this->session->userdata('userroll') == 'RME'): ?>
                     <button class="btn btn-primary btn-block" class="btn btn-primary" data-toggle='collapse' data-target='#tbl_rd_approved' id="btn_approved_by_rme">Request Approved By RME</button>            
                  <?php elseif($this->session->userdata('userroll') == 'RD'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rd_approved' id="btn_approved_by_rd">Approved Maintenance Request</button>
                  <?php endif ?>
              </div>
              <div class="col-md-3">
                  <?php if($this->session->userdata('userroll') == 'RD' || $this->session->userdata('userroll') == 'WR'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rd_maintained' id="btn_maintained"><?php echo lang('Maintained Heritage');?></button>
                  <?php endif ?>
                  <?php if($this->session->userdata('userroll') == 'ZME'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_request' id="btn_rejected_by_zme">Request Rejected by ZME</button>
                  <?php endif ?>

                  <?php if($this->session->userdata('userroll') == 'RME'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_request' id="btn_rejected_by_rme">Request Rejected by RME</button>
                  <?php endif ?>

              </div>
              <div class="col-md-3">
                  <?php if($this->session->userdata('userroll') == 'RD'): ?>
                     <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_request' id="btn_rejected_by_rd">Request Rejected by RD</button>
                  <?php endif ?>
              </div>

           </div>

           <!--Maintenance request rejected by zme and rme -->

         <div class="row">
         <?php if($this->session->userdata('userroll') == 'ZME' || $this->session->userdata('userroll') == 'RME' || $this->session->userdata('userroll') == 'RD'): ?>        
            <div class="col-md-12 list_of_heritage">
            
            <div class="table-responsive" style="padding:0 15px;">
    
               <div id="tbl_rejected_request" class="collapse">

               <?php if ($this->session->userdata('userroll') == 'ZME'): ?>
                  <caption><h3>List of rejected maintenance request by zone maintenance expert</h3></caption>
               <?php elseif ($this->session->userdata('userroll') == 'RME'): ?>
                  <caption><h3>List of rejected maintenance request by regional maintenance expert</h3></caption>
               <?php elseif ($this->session->userdata('userroll') == 'RD'): ?>
                  <caption><h3>List of maintenance request rejected by regional directorate</h3></caption>            
               <?php endif ?>         

               <table id="tbl_list_of_rejected_maintenance_request" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Name</th>                     
                        <th>Category</th>
                        <th>Ownership</th>                     
                        <th>Severity</th>                     
                        <th>Detail</th>
                     </tr>
                  </thead>
                  <tbody id="tbl_list_of_rejected_maintenance_request" class="table table-striped table-bordered">
            
                     <?php foreach($list_of_rejected_maintenance_request as $rejected_request):?>
                        <tr>
                        <td><?php echo $rejected_request['heritage_id'];?></td>
                        <td><?php echo $rejected_request['Name'];?></td>                     
                        <td><?php echo $rejected_request['category'];?></td>
                        <td><?php echo $rejected_request['Ownership'];?></td>
                        <td><?php echo $rejected_request['severity'];?></td>                     
                        <td><a href="<?php echo base_url('heritage/maintenance_request_detail/' . $rejected_request['heritage_id'])?>">
                            <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>                     
                     <?php endforeach;?>
                     
                  </tbody>
                  </table>
                  </div>
               </div>
            </div>
         <?php endif ?>
         </div>

           <div class="row">
            <?php if($this->session->userdata('userroll') == 'RD' || $this->session->userdata('userroll') == 'WR'): ?>             
               <div class="col-md-12 list_of_heritage">
               
               <div class="table-responsive" style="padding:0 15px;">         
                  
                  <div class="collapse" id="tbl_rd_maintained">
                  
                  <?php if($this->session->userdata('userroll') == 'RD' || $this->session->userdata('userroll') == 'WR'): ?>
                     <caption><h3><?php echo lang('List of maintained heritage');?></h3></caption>
                  <?php endif ?>         

                  <table id="tbl_list_of_scheduled_maintenance_request" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th><?php echo lang('ID');?></th>
                           <th><?php echo lang('Name');?></th>                     
                           <th><?php echo lang('Category');?></th>
                           <th><?php echo lang('Ownership');?></th>
                           <th><?php echo lang('Severity');?></th>                     
                           <th><?php echo lang('Status');?></th>                                          
                        </tr>
                     </thead>
                     <tbody id="tbl_list_of_scheduled_maintenance_request" class="table table-striped table-bordered">
               
                        <?php foreach($list_of_maintained_heritage as $maintained_heritage):?>
                           <tr>
                           <td><?php echo $maintained_heritage['heritage_id'];?></td>
                           <td><?php echo $maintained_heritage['Name'];?></td>                     
                           <td><?php echo $maintained_heritage['category'];?></td>
                           <td><?php echo $maintained_heritage['Ownership'];?></td>
                           <td><?php echo $maintained_heritage['severity'];?></td>                     
                           <td><?php echo $maintained_heritage['status'];?></td>                            
                           </tr>
                        <?php endforeach;?>
                        
                     </tbody>
                  </table>
                  </div>
               </div>
               </div>
            <?php endif ?>
            </div><!--End of row-->

           <div class="row" >
              <div class="col-md-12 list_of_heritage">
               <div class="table-responsive" style="padding:0 15px;">
       
                  <div id="tbl_need_approval" class="collapse">

                  <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                     <caption><h3><?php echo lang('List of sent maintenance request');?></h3></caption>
                  <?php elseif ($this->session->userdata('userroll') == 'ZME'): ?>
                     <caption><h3>List of maintenance request needs zone maintenance expert approval</h3></caption>
                  <?php elseif($this->session->userdata('userroll') == 'RME'): ?>
                     <caption><h3>List of maintenance request needs regional maintenance expert approval</h3></caption>
                  <?php elseif($this->session->userdata('userroll') == 'RD'): ?>
                     <caption><h3>List of maintenance request needs regional directorate approval</h3></caption>
                  <?php endif ?>         

                  <table id="tbl_list_of_maintenance_request" class="table table-striped table-bordered">
                     <thead>
                        <tr>
                           <th><?php echo lang('ID');?></th>
                           <th><?php echo lang('Name');?></th>
                           <th><?php echo lang('Local Name');?></th>
                           <th><?php echo lang('Category');?></th>                     
                           <th><?php echo lang('Severity');?></th>
                           <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                           <th><?php echo lang('Approved by zme');?></th>
                           <th><?php echo lang('Approved by rme');?></th>
                           <th><?php echo lang('Approved by rd');?></th>
                           <?php endif; ?>
                           <th><?php echo lang('Detail');?></th>
                        </tr>
                     </thead>
                     <tbody id="tbl_list_of_maintenance_request" class="table table-striped table-bordered">
               
                        <?php foreach($list_of_maintenance_request as $maintenance_request):?>
                           <tr>
                           <td><?php echo $maintenance_request['heritage_id'];?></td>
                           <td><?php echo $maintenance_request['Name'];?></td>
                           <td><?php echo $maintenance_request['LocalName'];?></td>
                           <td><?php echo $maintenance_request['category'];?></td>
                           <td><?php echo $maintenance_request['severity'];?></td>
                           <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                              <?php if ($maintenance_request['zme_id'] == '0'): ?>
                                 <td>----</td>
                              <?php elseif ($maintenance_request['zme_id'] !== '0'): ?>
                                 <td><?php echo $maintenance_request['zme_approval_status'] ?></td>              
                              <?php endif; ?>

                              <?php if ($maintenance_request['rme_id'] == '0'): ?>
                                 <td>----</td>
                              <?php elseif ($maintenance_request['rme_id'] !== '0'): ?>
                                 <td><?php echo $maintenance_request['rme_approval_status'] ?></td>        
                              <?php endif; ?>

                              <?php if ($maintenance_request['rd_id'] == '0'): ?>
                                 <td>----</td>
                              <?php elseif ($maintenance_request['rd_id'] !== '0'): ?>
                                 <td><?php echo $maintenance_request['rd_approval_status'] ?></td>          
                              <?php endif; ?>
                           <?php endif; ?>
                           <td><a href="<?php echo base_url('heritage/maintenance_request_detail/' . $maintenance_request['heritage_id'])?>">
                               <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                           </tr>                     
                        <?php endforeach;?>
                        
                     </tbody>
                  </table>
                  </div>
               </div>
               </div>
            </div>

            <div class="row">         
               <div class="col-md-12 list_of_heritage">
            
               <div class="table-responsive" style="padding:0 15px;">         
               
               <div class="collapse" id="tbl_rd_approved">

               <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                  <caption><h3><?php echo lang('List of approved maintenance request');?></h3></caption>
               <?php elseif ($this->session->userdata('userroll') == 'ZME'): ?>
                  <caption><h3>List of maintenance request approved by zone maintenance expert</h3></caption>
               <?php elseif($this->session->userdata('userroll') == 'RME'): ?>
                  <caption><h3>List of maintenance request approved by regional maintenance expert</h3></caption>
               <?php elseif($this->session->userdata('userroll') == 'RD'): ?>
                  <caption><h3>List of maintenance request approved by regional directorate</h3></caption>
               <?php endif ?>         

               <table id="tbl_list_of_maintenance_request_approved" class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th><?php echo lang('ID');?></th>
                        <th><?php echo lang('NameH');?></th>                     
                        <th><?php echo lang('Category');?></th>
                        <th><?php echo lang('Ownership');?></th>
                        <th><?php echo lang('Severity');?></th>
                        <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                        <th><?php echo lang('Status');?></th>
                        <th><?php echo lang('Does Maintain');?></th>
                        <?php endif ?>
                        <?php if ($this->session->userdata('userroll') == 'ZME'): ?>
                        <th>Approved by rme</th>
                        <th>Approved by rd</th>
                        <?php endif ?>
                        <?php if ($this->session->userdata('userroll') == 'RME'): ?>                     
                        <th>Approved by rd</th>
                        <?php endif ?>
                        <?php if ($this->session->userdata('userroll') == 'ZME' || $this->session->userdata('userroll') == 'RME' || $this->session->userdata('userroll') == 'RD'): ?>
                        <th>Detail</th>
                        <?php endif ?>
                        <?php if ($this->session->userdata('userroll') == 'RD'): ?>
                        <th>Schedule</th>
                        <?php endif ?>
                     </tr>
                  </thead>
                  <tbody id="tbl_list_of_maintenance_request_approved" class="table table-striped table-bordered">
                     <?php $senderID = $this->session->userdata('user_id')?>

                     <?php $count=0; foreach($list_of_maintenance_request_approved_by_zone_model as $maintenance_request): $count++?>                  
                     

                        <tr>
                        <td><?php echo $maintenance_request['heritage_id'];?></td>
                        <td><?php echo $maintenance_request['Name'];?></td>                     
                        <td><?php echo $maintenance_request['category'];?></td>
                        <td><?php echo $maintenance_request['Ownership'];?></td>
                        <td><?php echo $maintenance_request['severity'];?></td>

                        <?php if ($this->session->userdata('userroll') == 'ZME'): ?>
                           <?php if ($maintenance_request['rme_id'] == '0'): ?>
                              <td>----</td>
                           <?php elseif ($maintenance_request['rme_id'] !== '0'): ?>
                              <td><?php echo $maintenance_request['rme_approval_status'] ?></td>        
                           <?php endif; ?>

                           <?php if ($maintenance_request['rd_id'] == '0'): ?>
                              <td>----</td>
                           <?php elseif ($maintenance_request['rd_id'] !== '0'): ?>
                              <td><?php echo $maintenance_request['rd_approval_status'] ?></td>          
                           <?php endif; ?>
                        <?php endif ?>
                        <?php if ($this->session->userdata('userroll') == 'RME'): ?>                     
                           <?php if ($maintenance_request['rd_id'] == '0'): ?>
                              <td>----</td>
                           <?php elseif ($maintenance_request['rd_id'] !== '0'): ?>
                              <td><?php echo $maintenance_request['rd_approval_status'] ?></td>          
                           <?php endif; ?>
                        <?php endif ?>

                        <?php if ($this->session->userdata('userroll') == 'WR'): ?>

                        <td><?php echo $maintenance_request['status'];?></td>                     
                        <td><a class="btn btn-primary btn-block" href="#" data-toggle = "modal" data-target = "#mr_confirm_modal_<?= $count?>">Yes</a>

                           <div class="modal fade" id="mr_confirm_modal_<?= $count?>" tabindex="-1" role="dialog" aria-labelledby="confirm_modal_label" aria-hidden = "true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h3 class="modal-title" id="confirm_modal_label" style="font-family: Gabrola;" align="center">Does the heritage maintained?</h3>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">                                                   
                              <?php echo form_open_multipart('heritage/confirm_maintenance/'.$maintenance_request['heritage_id'].'/'.$maintenance_request['rd_id'].'/'.$maintenance_request['Name'].'/'.$senderID);?>                                                                     
                                       <div class="form-group add_photo" style="width: 350px; margin-left: 110px; margin-bottom: 35px;" aria-describedby="help">                        
                                          <input type="file" class="input_form_one" name="userfile" id="attachement"> 
                                          <small id="help" class="text-muted" style="display: block; margin-top: 10px;">Attachement here</small>                                   
                                       </div>                                    
                                       
                                       <div class="form-group" style="margin-left: 110px;">                                       
                                          <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="maintenance_end_date" class="form-control input_form_one" id="maintenance_end_date" style=" width: 350px;" placeholder="Maintenance end date" aria-describedby="help">
                                          <small id="help" class="text-muted" style="display: block;">Maintenance end date here</small>                                          
                                       </div>
                                       
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" name="btn_schedule" id="btn_send_confirmation" class="btn btn-primary">Confirm</button>
                                    </div>                           
                                 </div>
                              </div>                           
                           </div>
                        </td>
                        </form>                     
                        <?php endif ?> 

                        <?php if ($this->session->userdata('userroll') == 'ZME' || $this->session->userdata('userroll') == 'RME' || $this->session->userdata('userroll') == 'RD'): ?>                   
                        <td><a href="<?php echo base_url('heritage/maintenance_request_detail/' . $maintenance_request['heritage_id'])?>">
                            <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a>
                        </td>
                        <?php endif ?>

                        <?php if ($this->session->userdata('userroll') == 'RD'): ?>

                        <td><a class="btn btn-primary btn-block" href="#" data-toggle = "modal" data-target = "#schedule_modal_<?= $count?>">Schedule</a>

                           <div class="modal fade" id="schedule_modal_<?= $count?>" tabindex="-1" role="dialog" aria-labelledby="schedule_modal_label" aria-hidden = "true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h3 class="modal-title" id="schedule_modal_label" style="font-family: Gabrola;" align="center">Schedule the maintenance</h3>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                              <?php echo form_open('heritage/schedule_maintenance/'.$maintenance_request['heritage_id']);?>
                                       <div class="form-group">
                                          <label for="start_date" class="col-form-label">Start Date:</label>
                                          <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="start_date" class="form-control input_form_one" id="start_date" style="display: block; width: 500px;" placeholder="Start Date">                 
                                       </div>

                                       <div class="form-group">
                                          <label for="end_date" class="col-form-label">End Date:</label>
                                          <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="end_date" class="form-control input_form_one" id="end_date" style="display: block; width: 500px;" placeholder="End Date">                 
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" name="btn_schedule" id="btn_schedule" class="btn btn-primary">Schedule Maintenance</button>
                                    </div>                           
                                 </div>
                              </div>                           
                           </div>
                        </td>
                        </form>
                        <?php endif ?>
                        </tr>
                     <?php endforeach;?>
                     
                  </tbody>
               </table>
               </div>
               </div>
            </div>
         </div> <!--End of row-->            

      </div><!--End of col-md-9-->
   </div>
   
</div>

<script>
      $(document).ready(function(){
      $('#tbl_list_of_maintenance_request').dataTable();
      $('#tbl_list_of_rejected_maintenance_request').dataTable();
      $('#tbl_list_of_maintenance_request_approved').dataTable();
      $('#tbl_list_of_scheduled_maintenance_request').dataTable();
});
</script>

<script>
    $(document).ready(function(){  


      //$('#btn_maintained').click(function(event){
      //   $('#tbl_rd_maintained').style.display == 'block';
      //});

      $('#btn_send_confirmation').click(function(event){
          
          var attachement                       = $('#attachement').val();
          var maintenance_end_date              = $('#maintenance_end_date').val();

          if(attachement == ''){
            $('#attachement').addClass('error_username');
            event.preventDefault();
          }else{
            $('#attachement').removeClass('error_username');
          }

          if(maintenance_end_date == ''){
            $('#maintenance_end_date').addClass('error_username');
            event.preventDefault();
          }else{
            $('#maintenance_end_date').removeClass('error_username');
          }              

      }); // end of btn click

       $('#btn_schedule').click(function(event){
          //get all values of the input and set it in the session
          var start_date            = $('#start_date').val();
          var end_date              = $('#end_date').val();                    
           
          if(start_date == ""){
            event.preventDefault();
            $('#start_date').addClass('error_username');
          }else{
            $('#start_date').removeClass('error_username');
          } 
           
          if(end_date == ""){
            event.preventDefault();
            $('#end_date').addClass('error_username');
          }else{
            $('#end_date').removeClass('error_username');
          }                

          
        });
   });
</script>

<script>
 
$('#attachement').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
 
});
 
</script>

