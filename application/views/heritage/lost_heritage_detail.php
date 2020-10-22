<div class="container">

<div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header"><?php echo lang('lost_heritage_detail_info');?></h3>
           </div>
      </div><!-- end of jumbotron -->

	<?php if($this->session->userdata('userroll') == 'RHS'):?>

		<div class="row">
		<div class="col-md-3">
			<img style="width:400px; height:300px;" src="<?php echo base_url('assets/heritage/' .$lost_heritage_detail['photo']);?>" />
		</div>

		<div class="col-md-7 col-md-offset-2 table_val">

	<table class="table">  
   
	    <tr>
	    <th>Name</th> <td><?php echo $lost_heritage_detail['heritage_name'];?></td>
		<th>Local Name</th> <td><?php echo $lost_heritage_detail['LocalName'];?></td>
		</tr> 

		<tr>
	    <th>Date of Aquistion</th> <td><?php echo $lost_heritage_detail['DateOfAquistion'];?></td>
		<th>Category</th> <td><?php echo $lost_heritage_detail['Category'];?></td>
		</tr> 

		<tr>
	    <th>Date of Lost</th> <td><?php echo $lost_heritage_detail['lost_date'];?></td>
		<th>Announce Date</th> <td><?php echo $lost_heritage_detail['announce_date'];?></td>
		</tr> 

		<tr>
	    <th>Longitude</th> <td><?php echo $lost_heritage_detail['LO'];?></td>
		<th>Latitude</th> <td><?php echo $lost_heritage_detail['LA'];?></td>
		</tr>


  </table>

  <table class="table">
  	<tr>
	    <th>Ownership</th> <td><?php echo $lost_heritage_detail['Ownership'];?></td>
		<th>Region</th> <td><?php echo $address['region'];?></td>
		<th>Zone</th> <td><?php echo $address['zone'];?></td>
		<th>Woreda</th> <td><?php echo $address['woreda'];?></td>
	</tr>	
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th><i>Announced by</i></th>
		<th><i><?php echo $lost_heritage_detail['username'];?></i></th>
		<th><i>@Date:</i></th>
		<th><i><?php echo $lost_heritage_detail['announce_date'];?></i></th>
	</tr>
	
  </table>
			

		</div> <!-- table body section -->
	</div>
	<div class="row description">
		<div class="col-md-12">
			<p><?php echo $lost_heritage_detail['description'];?></p>
		</div>
	</div>  <!-- end of description -->

	<?php endif; ?>

	<?php if($this->session->userdata('userroll') == 'WR'):?>

		<div class="row">
		<div class="col-md-3">
			<img style="width:400px; height:300px;" src="<?php echo base_url('assets/heritage/' .$lost_heritage_detail['photo']);?>" />
		</div>

		<div class="col-md-7 col-md-offset-2 table_val">

	<table class="table">  
   
	    <tr>
	    <th><?php echo lang('Name');?></th> <td><?php echo $lost_heritage_detail['heritage_name'];?></td>
		<th><?php echo lang('Local Name');?></th> <td><?php echo $lost_heritage_detail['LocalName'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Date of Aquistion');?></th> <td><?php echo $lost_heritage_detail['DateOfAquistion'];?></td>
		<th><?php echo lang('Category');?></th> <td><?php echo $lost_heritage_detail['Category'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Date of Lost');?></th> <td><?php echo $lost_heritage_detail['lost_date'];?></td>
		<th><?php echo lang('Announce Date');?></th> <td><?php echo $lost_heritage_detail['announce_date'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Longitude');?></th> <td><?php echo $lost_heritage_detail['LO'];?></td>
		<th><?php echo lang('Latitude');?></th> <td><?php echo $lost_heritage_detail['LA'];?></td>
		</tr>


  </table>

  <table class="table">
  	<tr>
	    <th><?php echo lang('H');?>Ownership</th> <td><?php echo $lost_heritage_detail['Ownership'];?></td>
		<th><?php echo lang('H');?>Region</th> <td><?php echo $address['region'];?></td>
		<th><?php echo lang('H');?>Zone</th> <td><?php echo $address['zone'];?></td>
		<th><?php echo lang('H');?>Woreda</th> <td><?php echo $address['woreda'];?></td>
	</tr>		
	
  </table>
			

		</div> <!-- table body section -->
	</div>
	<div class="row description">
		<div class="col-md-12">
			<p><?php echo $lost_heritage_detail['description'];?></p>
		</div>
	</div>  <!-- end of description -->

	<?php endif; ?>

</div>


<style>
	.description {
		padding-top: 50px;
	}

	.table_val {
		padding-top: 50px;
	}
</style>