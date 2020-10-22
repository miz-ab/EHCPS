<div class="container">
<!-- language setting and language model -->
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>

   <div class="row main_row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header"><?php echo lang('heritage_detail_info');?></h3>
           </div>
      </div><!-- end of jumbotron -->
	<div class="row">
		<div class="col-md-3">
			<img style="width:400px; height:300px;" src="<?php echo base_url('assets/heritage/' .$load_registerd_heritage_detail['photo']);?>" />
		</div>

		<div class="col-md-7 col-md-offset-2 table_val">

	<table class="table">  
   
	    <tr>
	    <th><?php echo lang('Name');?></th> <td><?php echo $load_registerd_heritage_detail['Name'];?></td>
		<th><?php echo lang('Local Name');?></th> <td><?php echo $load_registerd_heritage_detail['LocalName'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Date of Aquistion');?></th> <td><?php echo $load_registerd_heritage_detail['DateOfAquistion'];?></td>
		<th> <?php echo lang('Site Name');?></th> <td><?php echo $load_registerd_heritage_detail['SiteName'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Aboundance');?></th> <td><?php echo $load_registerd_heritage_detail['Aboundance'];?></td>
		<th><?php echo lang('Site Code');?></th> <td><?php echo $load_registerd_heritage_detail['SiteCode'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Longitude');?></th> <td><?php echo $load_registerd_heritage_detail['LO'];?></td>
		<th><?php echo lang('Latitude');?></th> <td><?php echo $load_registerd_heritage_detail['LA'];?></td>
		</tr>


  </table>

  <table class="table">
  	<tr>
	    <th><?php echo lang('Ownership');?></th> <td><?php echo $load_registerd_heritage_detail['Ownership'];?></td>
		<th><?php echo lang('Region');?></th> <td><?php echo $address['region'];?></td>
		<th><?php echo lang('Zone');?></th> <td><?php echo $address['zone'];?></td>
		<th><?php echo lang('Woreda');?></th> <td><?php echo $address['woreda'];?></td>
		</tr>
  </table>
			

		</div> <!-- table body section -->
	</div>
	<div class="row description">
		<div class="col-md-12">
			<p><?php echo $load_registerd_heritage_detail['Description'];?></p>
		</div>
	</div>  <!-- end of description -->

	<div class="row">
	  
		<div class="col-md-2">
		
		 
		</div> <!-- end of col one -->

		<div class="col-md-8">			

		<?php if(($this->session->userdata('userroll') == 'WR' ) && 
			($address['region_id'] == $this->session->userdata('user_region_id')) && 
			($address['zone_id'] == $this->session->userdata('user_zone_id')) &&
			($address['woreda_id'] == $this->session->userdata('user_woreda_id'))):?>

		<?php if ($load_registerd_heritage_detail['approved_by_zone'] == '0'):?>
		<?php echo form_open('heritage/update_heritage_info');?>
		  	
		  		<a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('heritage/update_heritage_info/').$load_registerd_heritage_detail['NationalRNO']?>">
		  			<?php echo lang('Update Heritage');?>
		  		</a>
		  	</form>
		<?php endif;?>
		<?php endif;?>

		<?php 
			$roll = $this->session->userdata('userroll');
			$sender_empID = $this->session->userdata('user_id');			
		?>
		<!-- part three -->
		<?php if(($this->session->userdata('userroll') == 'ZR')  && $address['approved_by_zone'] == '0'):?>
			<?php echo form_open_multipart('heritage/update_zone_approval/'.$load_registerd_heritage_detail['empID'].'/'.$load_registerd_heritage_detail['Name'].'/'.$roll.'/'.$sender_empID);?>			

			<div class="row">
				<div class="col-md-3">
					
				</div><!-- end of col -->
				<div class="col-md-6">

					<div class="form-group add_photo">
	                 <input type="file" class="form-control hide_file" name="userfile" id="heritage_photo">                
	            	</div>

	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
							<button type="submit" name="btn_approve" class="btn btn-primary btn-lg btn-block" id="btn_approve"><a href="<?php echo base_url('heritage/update_zone_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>"></a>Approve</button>
							</div>
	            		</div>

	            		<div class="col-md-6">
	            			<div class="form-group">
							<button type="submit" name="btn_reject" class="btn btn-primary btn-lg btn-block" id="btn_reject"><a href="<?php echo base_url('heritage/update_zone_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>"></a>Reject</button>
							</div>
	            		</div>
	            	</div>	            		
				</div>

				<div class="col-md-3"></div>

			</div><!-- end of row -->

		  	</form>
		  <?php endif;?>
			
		   <!-- approve button rr-->
			<?php if(($this->session->userdata('userroll') == 'RR') && $address['approved_by_region'] == '0'):?>
			
			  <?php echo form_open_multipart('heritage/update_region_approval/'.$load_registerd_heritage_detail['empID'].'/'.$load_registerd_heritage_detail['approved_by_zone'].'/'.$load_registerd_heritage_detail['Name'].'/'.$roll.'/'.$sender_empID);?>				

				<div class="row">
					<div class="col-md-3">
						
					</div><!-- end of col -->
					<div class="col-md-6">

						<div class="form-group add_photo">
		                 <input type="file" class="form-control hide_file" name="userfile" id="heritage_photo">                
		            	</div>

		            	<div class="row">
		            		<div class="col-md-6">
		            			<div class="form-group">
								<button type="submit" name="btn_approve" class="btn btn-primary btn-lg btn-block" id="btn_approve"><a href="<?php echo base_url('heritage/update_region_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>"></a>Approve</button>
								</div>
		            		</div>

		            		<div class="col-md-6">
		            			<div class="form-group">
								<button type="submit" name="btn_reject" class="btn btn-primary btn-lg btn-block" id="btn_reject"><a href="<?php echo base_url('heritage/update_region_approval/'.$load_registerd_heritage_detail['NationalRNO'])?>"></a>Reject</button>
								</div>
		            		</div>
		            	</div>	            		
					</div>

					<div class="col-md-3"></div>

				</div><!-- end of row -->

				</form>
				<?php endif;?>

		</div> <!-- end of col two -->

		<div class="col-md-2">
		
		  
		</div> <!-- end of col three -->
	  
	</div> <!-- end of row -->
</div>


<style>
	.description {
		padding-top: 50px;
	}

	.table_val {
		padding-top: 50px;
	}
</style>

<script>
	$('#heritage_photo').filestyle({
 		iconName : 'glyphicon glyphicon-file',
 		buttonText : 'Select Photo',
 		buttonName : 'btn-warning'
});
</script>
<script>
    $(document).ready(function(){
      //event function btn 
       $('#btn_approve').click(function(event){                    
          var heritage_photo    = $('#heritage_photo').val();            
          
          if (heritage_photo == "") {
            event.preventDefault();
            $('#photo_div').addClass('error_username');
          }else{
            $('#photo_div').removeClass('error_username');
            }

       });

       $('#btn_reject').click(function(event){                    
          var heritage_photo    = $('#heritage_photo').val();            
          
          if (heritage_photo == "") {
            event.preventDefault();
            $('#photo_div').addClass('error_username');
          }else{
            $('#photo_div').removeClass('error_username');
            }

       });
    });
 </script>