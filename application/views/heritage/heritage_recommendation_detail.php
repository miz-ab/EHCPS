<div class="container">
	<div class="row">
		<div class="col-md-3">
	<img style="width:400px; height:300px;" src="<?php echo base_url('assets/recommended_heritage/' .$heritage_recommendation_detail['photo']);?>" />
		</div>

		<div class="col-md-7 col-md-offset-2 table_val">

	<table class="table">  
   
	    <tr>
	    <th>Name</th> <td><?php echo $heritage_recommendation_detail['Name'];?></td>
		<th>Local Name</th> <td><?php echo $heritage_recommendation_detail['LocalName'];?></td>
		</tr> 

		<tr>
	    <th>Date of Aquistion</th> <td><?php echo $heritage_recommendation_detail['DateOfAquistion'];?></td>
		<th>Recommendation Date</th> <td><?php echo $heritage_recommendation_detail['date'];?></td>
		</tr> 
		<tr>
	    <th>Longitude</th> <td><?php echo $heritage_recommendation_detail['lo'];?></td>
		<th>Latitude</th> <td><?php echo $heritage_recommendation_detail['la'];?></td>
		</tr>


  </table>

  <table class="table">
  	<tr>
	    <th>Ownership</th> <td><?php echo $heritage_recommendation_detail['Ownership'];?></td>
		<th>Region</th> <td><?php echo $address['region'];?></td>
		<th>Zone</th> <td><?php echo $address['zone'];?></td>
		<th>Woreda</th> <td><?php echo $address['woreda'];?></td>
	</tr>
  </table>
			

		</div> <!-- table body section -->
	</div>
	<div class="row description">
		<div class="col-md-12">
			<p><?php echo $heritage_recommendation_detail['recommendation'];?></p>
		</div>
	</div>  <!-- end of description -->
</div>


<style>
	.description {
		padding-top: 50px;
	}

	.table_val {
		padding-top: 50px;
	}
</style>