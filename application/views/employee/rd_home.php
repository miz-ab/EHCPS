<div style="padding:    0 15px;">
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header">Regional Directorate Home Page</h3>
           </div>
      </div><!-- end of jumbotron -->
      <div class="col-md-3 menu_wr">
         <h3></h3>
         
            
         <div class="list_of_menu">
            <ul>                              
               <li><a href="<?php echo base_url('employee/');?>"><span class="glyphicon glyphicon-plus">   </span>Create Account</a></li>
               <li><a href="<?php echo base_url('employee/list_of_employee');?>"><span class="glyphicon glyphicon-plus">   </span>Manage Account</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_needs_rr_approval');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_recommendation');?>">
                  <span class="glyphicon glyphicon-th"></span> View Recommendation</a></li>
               <li><a href="<?php echo base_url('employee/list_of_instruction');?>">
                  <span class="glyphicon glyphicon-th"></span> View Instruction</a></li> 
                  <?php $emp_id = $this->session->userdata('user_id'); ?> 
          <li><a href="<?php echo base_url('heritage/all_notification/'.$emp_id);?>">
          <span class="glyphicon glyphicon-th"></span> <?php echo lang('View All Notification');?> </a></li> 
                           
            </ul>
         </div>
         
      </div> <!-- menu div -->
      
   </div>
</div>