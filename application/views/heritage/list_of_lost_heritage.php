<div style="padding:0 15px;">
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header"><?php echo lang('List of Lost Heritage');?></h3>
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
         <h3></h3>
         
            
         <div class="list_of_menu">
               <ul>

                  <?php if ($this->session->userdata('userroll') == 'RHS'): ?>
                  <li><a href="<?php echo base_url('heritage/list_of_heritage_status');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage Status</a></li>
                  <li><a href="<?php echo base_url('heritage/list_of_lost_heritage');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Lost Heritage</a></li>
                  <li><a href="<?php echo base_url('report/lost_heritage_report');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
               <?php endif; ?>
      
               </ul>
         </div>
         
      </div> <!-- menu div -->

      <?php if($this->session->userdata('userroll') == 'RHS'):?>
      <div class="col-md-9 list_of_heritage">
         
         <div class="table-responsive" style="padding:0 15px;">
            <caption><h4>List of Lost Heritage</h4></caption>
            <table id="tbl_list_of_lost_heritage" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Local Name</th>
                     <th>Category</th>
                     <th>Lost Date</th>
                     <th>Detail</th>
                  </tr>
               </thead>
               <tbody id="tbl_list_of_lost_heritage" class="table table-striped table-bordered">
         
                  <?php foreach($list_of_lost_heritage as $lost_heritage):?>
                     <tr>
                     <td><?php echo $lost_heritage['heritage_id'];?></td>
                     <td><?php echo $lost_heritage['heritage_name'];?></td>
                     <td><?php echo $lost_heritage['LocalName'];?></td>
                     <td><?php echo $lost_heritage['Category'];?></td>
                     <td><?php echo $lost_heritage['lost_date'];?></td>
                     <td><a href="<?php echo base_url('heritage/lost_heritage_detail/' . $lost_heritage['heritage_id'])?>">
                         <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                     </tr>
                  <?php endforeach;?>
                  
               </tbody>
            </table>
         </div>
      </div> <!-- menu div -->
   <?php endif; ?>

   <?php if($this->session->userdata('userroll') == 'WR'):?>

      <div class="col-md-9 list_of_heritage">
         
         <div class="table-responsive" style="padding:0 15px;">
            <caption><h4><?php echo lang('List of Lost Heritage');?></h4></caption>
            <table id="tbl_list_of_lost_heritage" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th><?php echo lang('ID');?></th>
                     <th><?php echo lang('Name');?></th>
                     <th><?php echo lang('Local Name');?></th>
                     <th><?php echo lang('Category');?></th>
                     <th><?php echo lang('Lost Date');?></th>
                     <th><?php echo lang('Detail');?></th>
                  </tr>
               </thead>
               <tbody id="tbl_list_of_lost_heritage" class="table table-striped table-bordered">
         
                  <?php foreach($list_of_lost_heritage_for_wr as $lost_heritage_for_wr):?>
                     <tr>
                     <td><?php echo $lost_heritage_for_wr['heritage_id'];?></td>
                     <td><?php echo $lost_heritage_for_wr['heritage_name'];?></td>
                     <td><?php echo $lost_heritage_for_wr['LocalName'];?></td>
                     <td><?php echo $lost_heritage_for_wr['Category'];?></td>
                     <td><?php echo $lost_heritage_for_wr['lost_date'];?></td>
                     <td><a href="<?php echo base_url('heritage/lost_heritage_detail/' . $lost_heritage_for_wr['heritage_id'])?>">
                         <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                     </tr>
                  <?php endforeach;?>
                  
               </tbody>
            </table>
         </div>
      </div> <!-- menu div -->
   <?php endif; ?>
      
   </div>
</div>

<script>
      $(document).ready(function(){
      $('#tbl_list_of_lost_heritage').dataTable();
});
</script>