<div style="padding:0 15px;">
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header">List of Heritage Recommendation</h3>
           </div>
      </div><!-- end of jumbotron -->      
      <div class="col-md-3 menu_wr">
         <h3></h3>
         
            
         <div class="list_of_menu">
               <ul>
               <li><a href="<?php echo base_url('employee/');?>"><span class="glyphicon glyphicon-plus">   </span>Create Account</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_all');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_recommendation');?>">
                  <span class="glyphicon glyphicon-th"></span> View Recommendation</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                  <span class="glyphicon glyphicon-th"></span> View Instruction</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
      
               </ul>
         </div>
         
      </div> <!-- menu div -->
      <div class="col-md-9 list_of_heritage">
         
         <div class="table-responsive" style="padding:0 15px;">
            <caption><h4>List of Heritage Status</h4></caption>
            <table id="tbl_list_of_heritage_recommendation" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Local Name</th>                     
                     <th>Submission Date</th>
                     <th>Detail</th>
                  </tr>
               </thead>
               <tbody id="tbl_list_of_heritage_recommendation" class="table table-striped table-bordered">
         
                  <?php foreach($list_of_heritage_recommendation as $heritage_recommendation):?>
                     <tr>
                     <td><?php echo $heritage_recommendation['heritage_id'];?></td>
                     <td><?php echo $heritage_recommendation['Name'];?></td>
                     <td><?php echo $heritage_recommendation['LocalName'];?></td>                     
                     <td><?php echo $heritage_recommendation['date'];?></td>
                     <td><a href="<?php echo base_url('heritage/heritage_recommendation_detail/' . $heritage_recommendation['heritage_id'])?>">
                         <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
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
      $('#tbl_list_of_heritage_recommendation').dataTable();
});
</script>