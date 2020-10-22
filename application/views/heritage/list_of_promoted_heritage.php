<div style="padding:0 15px;">
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header">List of Promoted Heritage</h3>
           </div>
      </div><!-- end of jumbotron -->
      
      <div class="col-md-3 menu_wr">
         
         <div class="list_of_menu">
               <ul>
                  <li><a href="<?php echo base_url('heritage/promot_heritage');?>">
                  <span class="glyphicon glyphicon-th"></span>Promote Heritage</a></li>
                  <li><a href="<?php echo base_url('heritage/list_of_promoted_heritage');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Promote Heritage</a></li>
                  <li><a href="<?php echo base_url('report/promoted_heritage');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
      
               </ul>
         </div>
         
      </div> <!-- menu div -->
      <div class="col-md-9 list_of_heritage">
         
         <div class="table-responsive" style="padding:0 15px;">
            <caption><h4>List of Promoted Heritage</h4></caption>
            <table id="tbl_list_of_promoted_heritage" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Local Name</th>
                     <th>Ownership</th>
                     <th>Category</th>
                     <th>Promoted Date</th>                     
                  </tr>
               </thead>
               <tbody id="tbl_list_of_promoted_heritage" class="table table-striped table-bordered">
         
                  <?php foreach($list_of_promoted_heritage as $promoted_heritage):?>
                     <tr>
                     <td><?php echo $promoted_heritage['heritage_id'];?></td>
                     <td><?php echo $promoted_heritage['Name'];?></td>
                     <td><?php echo $promoted_heritage['LocalName'];?></td>
                     <td><?php echo $promoted_heritage['Ownership'];?></td>
                     <td><?php echo $promoted_heritage['Category'];?></td>
                     <td><?php echo $promoted_heritage['date'];?></td>                     
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
      $('#tbl_list_of_promoted_heritage').dataTable();
});
</script>