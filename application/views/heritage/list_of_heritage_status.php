<div style="padding:0 15px;">
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header">List of Heritage Status</h3>
           </div>
      </div><!-- end of jumbotron -->
      <!--<div class="col-md-8 col-md-offset-2">
         
         <?php //echo form_open('heritage/list_of_lost_heritage_by_category');?>
            <div class="row">
               <div class="col-md-8 custom-control-inline">
                  <input class="form-control input_form_one" type="text" name="txt_search" placeholder="Search by category..." />
               </div>
               <div class="col-md-4 custom-control-inline">
                  <button class="btn btn-info input_form_one" name="btn_search" style="margin-left: -17%">
                     <i class="glyphicon glyphicon-search"></i>
                  </button>
               </div>
            </div>
                                
                                
         </form>
      </div>-->
      <div class="col-md-3 menu_wr">
         
         <div class="list_of_menu">
               <ul>
                  <li><a href="<?php echo base_url('heritage/list_of_heritage_status');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage Status</a></li>
                  <li><a href="<?php echo base_url('heritage/list_of_lost_heritage');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Lost Heritage</a></li>                  
      
               </ul>
         </div>
         
      </div> <!-- menu div -->
      <div class="col-md-9 list_of_heritage">
         
         <div class="table-responsive" style="padding:0 15px;">
            <caption><h4>List of Heritage Status</h4></caption>
            <table id="tbl_list_of_heritage_status" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Local Name</th>                     
                     <th>Submission Date</th>
                     <th>Detail</th>
                  </tr>
               </thead>
               <tbody id="tbl_list_of_heritage_status" class="table table-striped table-bordered">
         
                  <?php foreach($list_of_heritage_status as $heritage_status):?>
                     <tr>
                     <td><?php echo $heritage_status['heritage_id'];?></td>
                     <td><?php echo $heritage_status['Name'];?></td>
                     <td><?php echo $heritage_status['LocalName'];?></td>                     
                     <td><?php echo $heritage_status['date'];?></td>
                     <td><a href="<?php echo base_url('heritage/heritage_status_detail/' . $heritage_status['heritage_id'])?>">
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
      $('#tbl_list_of_heritage_status').dataTable();
});
</script>