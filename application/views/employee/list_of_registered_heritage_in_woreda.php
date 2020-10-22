<div style="padding:0 15px;">
	<div class="row">
		<div class="col-md-3 menu_wr">
			<h3></h3>
			
				
			<div class="list_of_menu">
				<ul>
					<li><a href="<?php echo base_url('heritage/woreda_registeral_registration_form_one');?>">
                  <span class="glyphicon glyphicon-plus"></span> Register Heritage</a></li>
					<li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_wr');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
                  <li><a href="<?php echo base_url('heritage/load_heritage_registerd_in_woreda');?>">
                  <span class="glyphicon glyphicon-th-large"></span>Heritage Registered in Woreda</a></li>
          <li><a href="<?php echo base_url('report/report_heritage_only_registered_by_wr');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
				</ul>
			</div>
			
		</div> <!-- menu div -->

		<div class="col-md-9 list_of_heritage">			
   <div class="table-responsive" style="padding:0 15px;">

      <div style="margin-top: 50px;">
         <caption><h3>List of Heritage </h3></caption> 
      	<table id="list_of_heritage_id" class="table table-striped table-bordered">
               <thead>
                 <tr>
                     <td>ID</td>
                     <td>Name</td>
                     <td>Local Name</td>
                     <td>Category</td>
                     <td>Ownership</td>
                     <td>Detail</td>
                 </tr>
               </thead>
               <?php foreach($load_heritage_registerd_in_woreda as $heritage):?>
         		<tr>
               <td><?php echo $heritage['NationalRNO'];?></td>
               <td><?php echo $heritage['Name'];?></td>
               <td><?php echo $heritage['LocalName'];?></td>
               <td><?php echo $heritage['Category'];?></td>
               <td><?php echo $heritage['Ownership'];?></td>
               <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage['NationalRNO'])?>">
                 <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
            </tr>
            <?php endforeach;?>
            </table>
      </div>
   </div> <!-- end of table resp -->

<div class="row">
   <div class="col-md-6">
      <div>
      <canvas id="chart1" width="200" height="100">

      </canvas>
   </div>

   </div> <!-- end of inner col -->
   <div class="col-md-6"></div> <!-- end of inner col -->
</div> <!-- end of inner row -->


<div class="row">
   <div class="col-md-6"></div> <!-- end of inner col -->
   <div class="col-md-6"></div> <!-- end of inner col -->
</div> <!-- end of inner row -->




   
		</div> <!-- menu div -->
	</div>
</div>

<script>

$(document).ready(function(){
      $('#list_of_heritage_id').dataTable();
});

</script>

