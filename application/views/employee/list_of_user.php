<div style="padding:0 15px;">
	<div class="row">
		<div class="col-md-3 menu_wr">
			<h3></h3>
			
				
			<div class="list_of_menu">
				<ul>
            <?php if($this->session->userdata('userroll') == 'ZR'):?>
               <li><a href="<?php echo base_url('employee/index');?>">
              <span class="glyphicon glyphicon-home"></span> Home</a></li>
               <li><a href="<?php echo base_url('heritage/');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>


            <?php if($this->session->userdata('userroll') == 'WR'):?>
               <li><a href="<?php echo base_url('heritage/woreda_registeral_registration_form_one');?>">
                    <span class="glyphicon glyphicon-plus"></span> Register Heritage</a></li>
               <li><a href="<?php echo base_url('heritage/report_heritage_setting_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>

            <?php if($this->session->userdata('userroll') == 'RR'):?>
               <li><a href="<?php echo base_url('employee/index');?>">
                  <span class="glyphicon glyphicon-home"></span> Home</a></li>
               <li><a href="<?php echo base_url('heritage/');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>

            <?php if($this->session->userdata('userroll') == 'RD'):?>
               <li><a href="<?php echo base_url('employee/');?>"><span class="glyphicon glyphicon-plus">   </span>Create Account</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_all');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>
					
		
				</ul>
			</div>
			
		</div> <!-- menu div -->

		<div class="col-md-9 list_of_heritage">
			
         <div class="table-responsive" style="padding:0 15px;">
			<table id="tbl_list_of_user" class="table table-striped table-bordered">
            <caption><h4>List of Users</h4></caption>
            <thead>
               <tr>
                  <th>First Name</th>
                  <th>Father Name</th>
                  <th>Roll</th>                  
                  <th>Username</th>
                  <th>Status</th>
                  <?php if($this->session->userdata('userroll') == 'RD'):?>  
                  <th>Update Roll</th>
                  <?php endif;?>
                  <th>Update Status</th>               
               </tr>
            </thead>
            <tbody id="tbl_list_of_user" class="table table-striped table-bordered">
            	
               <?php $count=0;  foreach($list_of_user as $user): $count++?>
                  <tr>
                     <td><?php echo $user['first_name'];?></td>
                     <td><?php echo $user['middle_name'];?></td>
                     <td><?php echo $user['roll'];?></td>
                     <td><?php echo $user['username'];?></td>
                     <td><?php echo $user['status'];?></td>

                     <?php if($this->session->userdata('userroll') == 'RD'):?>                        <td>
                        <button type="button" class="btn btn-success btn-block" data-toggle = "modal" data-target = "#roll_modal_<?= $count?>">Change Roll</button>

                        <div class="modal fade" id="roll_modal_<?= $count?>" tabindex="-1" role="dialog" aria-labelledby="roll_modal_label" aria-hidden = "true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h3 class="modal-title" id="roll_modal_label" style="font-family: Gabrola;">Change the selected employee roll</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 </div>
                                 <div class="modal-body">
                           <?php echo form_open('employee/roll_management/'.$user['username']);?>
                                    <div class="form-group">
                                       <label for="roll_name" class="col-form-label">Roll:</label>   
                                       <select style="display: block; width: 500px;" name="new_roll" class="form-control input_form_one" id="roll_name">
                                           <option value="Select_Roll">Select Roll</option>
                                           <option value="WR">Woreda Registrar</option>
                                           <option value="ZR">Zone Registrar</option>
                                           <option value="ZME">Zone Maintenance Expert</option>     
                                           <option value="RR">Regional Rigstrar</option>
                                           <option value="RME">Regional Maintenance Expert</option>
                                           <option value="RHS">Regional Heritage Supervisor</option>
                                           <option value="RTDD">Regional Tourism Development Directorate</option>                          
                                       </select>                                    
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="btn_save_changes" id="btn_save_changes" class="btn btn-primary">Save Changes</button>
                                 </div>                           
                              </div>
                           </div>                           
                        </div>

                     </td> 
                     </form>
                     <?php endif;?>                    
                     <?php echo form_open('employee/status_management/'.$user['username']);?>
                     <td>                        
                                                      
                        <button type="submit" name="btn-activate" class="btn btn-success">Activate</button>

                        <button type="submit" name="btn-deactivate" class="btn btn-danger">Deactivate</button>                                                                           
                     </td>  
                     </form>                
                  </tr>
            <?php endforeach;?>
               
            </tbody>
         </table>
      </div>
		</div> <!-- menu div -->
	</div>
</div>

<script>
      $(document).ready(function(){
      $('#tbl_list_of_user').dataTable();
});
</script>

<script>
   //input validation
    $(document).ready(function(){

      $('#btn_save_changes').click(function(event){
          
          var roll          = $('#roll_name').val();
          //var roll_modal    =$('#roll_modal').val();

          //console.log(roll);
          //console.log(roll_modal);              


          if(roll == 'Select_Roll'){
            $('#roll_name').addClass('error_username');
            event.preventDefault();
          }else{
            $('#roll_name').removeClass('error_username');
          }      

      }); // end of btn click               

    });
</script>