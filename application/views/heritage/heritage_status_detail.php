<div class="container">

	<div class="row">
    <div class="jumbotron">
      <div class="form-group">
       <h3 class="registration_form_header">Heritage Detail</h3>
      </div>
    </div> <!-- end of jumbotron -->
    </div><!-- end of row --> 

	<div class="row">		
			
		<div class="col-md-4">

			
				<img style="height:300px; width: 360px;" src="<?php echo base_url('assets/heritage/' .$heritage_status_detail['photo']);?>" />
		</div>

		<div class="col-md-8">

			<table class="table">  
		   
			    <tr>
			    <th>Name</th> <td><?php echo $heritage_status_detail['Name'];?></td>
				<th>Local Name</th> <td><?php echo $heritage_status_detail['LocalName'];?></td>
				</tr> 

				<tr>
			    <th>Date of Aquistion</th> <td><?php echo $heritage_status_detail['DateOfAquistion'];?></td>
				<th>Catelog No</th> <td><?php echo $heritage_status_detail['CatalogNO'];?></td>
				</tr> 

				<tr>
			    <th>Aboundance</th> <td><?php echo $heritage_status_detail['Aboundance'];?></td>
				<th>Ownership</th> <td><?php echo $heritage_status_detail['Ownership'];?></td>
				</tr> 

				<tr>
			    <th>Longitude</th> <td><?php echo $heritage_status_detail['LO'];?></td>
				<th>Latitude</th> <td><?php echo $heritage_status_detail['LA'];?></td>
				</tr>


		  </table>

		  <table class="table">
		  	<tr>			    
				<th>Region</th> <td><?php echo $address['region'];?></td>
				<th>Zone</th> <td><?php echo $address['zone'];?></td>
				<th>Woreda</th> <td><?php echo $address['woreda'];?></td>
			</tr>
			<tr>
			    <th></th><td></td>
			    <th></th><td></td>
			    <th></th><td></td>
			</tr> 
		   </table>
		  </div>

		  <div class="row" style="margin:50px 20px; margin-top: 20px;">
		  	<div class="col-md-12">
		  	<?php echo $heritage_status_detail['description'];?>	
		  	</div>
		  </div>			  
		 </div>


		  
		
	</div><!--end of first row-->
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h2>All Recorded Heritage Status</h2>
		</div>
	</div>
	<?php foreach ($current_heritage_status_detail as $detail) : ?>

		   	<div class="container" style="margin-top: 50px;">
		   		
		   		<div class="row">
		   			<div class="col-md-4">
		   				<img style="height:300px; width: 360px;" src="<?php echo base_url('assets/heritage_status/' .$detail['photo']);?>" />
		   			</div>
		   			<div class="col-md-8">
		   			  <p><?php echo $detail['description']; ?></p>
		   			  <hr>
		   			  <span>Submission Date:&nbsp;&nbsp;&nbsp;&nbsp;<i><?php echo $detail['date']; ?></i></span>
		   			</div>
		   		</div>

		   	</div>

	<?php endforeach; ?>	

	<div class="row">
	  
		<div class="col-md-4">
            <?php if(
            ($this->session->userdata('userroll') == 'WR') && 
			($address['region_id'] == $this->session->userdata('user_region_id')) && 
			($address['zone_id'] == $this->session->userdata('user_zone_id')) &&
			($address['woreda_id'] == $this->session->userdata('user_woreda_id'))
			):?>
            <?php echo form_open('heritage/update_heritage_info');?>
                    <button class="btn btn-primary btn-lg btn-block">
                        <a href="<?php echo base_url('heritage/update_zone_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>">
                        </a>Update Heritage</button> 
                </form>
            <?php endif;?>
		</div> <!-- action one -->

		<div class="col-md-4">
			<?php if(
                ($this->session->userdata('userroll') == 'WR') && 
                ($address['region_id'] == $this->session->userdata('user_region_id')) && 
                ($address['zone_id'] == $this->session->userdata('user_zone_id')) &&
                ($address['woreda_id'] == $this->session->userdata('user_woreda_id')) &&
                ($address['approved_by_region'] == '1')
                ):?>
                <?php echo form_open('heritage/lost_heritage_form');?>
                <button class="btn btn-primary btn-lg btn-block">
                    Announce Lost Heritage</button> 
                </form>
		    <?php endif;?>

			<?php if(($this->session->userdata('userroll') == 'ZR')  && $address['approved_by_zone'] == '0'):?>
                <?php echo form_open('heritage/update_zone_approval');?>
                <button class="btn btn-primary btn-lg btn-block">
                    <a href="<?php echo base_url('heritage/update_zone_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>">
                    </a>Approve</button> 
                </form>
		    <?php endif;?>


		</div> <!-- action one -->

		<div class="col-md-4">
			<?php if(($this->session->userdata('userroll') == 'RR') && $address['approved_by_region'] == '0'):?>
                <?php echo form_open('heritage/update_region_approval');?>
                <button class="btn btn-primary btn-lg btn-block">Approve</button> 
                </form>
		   <?php endif;?>
		</div> <!-- action one -->
	  
	</div> <!-- end of action -->
</div>


<style>
	.description {
		padding-top: 50px;
	}

	.table_val {
		padding-top: 50px;
	}
</style>