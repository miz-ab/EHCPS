<div class="container">
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
<div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header"><?php echo lang('maintened_heritage_info');?></h3>
           </div>
      </div><!-- end of jumbotron -->
	<div class="row">
		<div class="col-md-3">
			<img style="width:400px; height:300px;" src="<?php echo base_url('assets/maintenance_requested_heritage/' .$maintenance_request_detail['photo']);?>" />
		</div>

		<div class="col-md-7 col-md-offset-2 table_val">		

	<table class="table">  
   
	    <tr>
	    <th><?php echo lang('Name');?></th> <td><?php echo $maintenance_request_detail['Name'];?></td>
		<th><?php echo lang('Local Name');?></th> <td><?php echo $maintenance_request_detail['LocalName'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Date of Aquistion');?></th> <td><?php echo $maintenance_request_detail['DateOfAquistion'];?></td>
		<th><?php echo lang('Category');?></th> <td><?php echo $maintenance_request_detail['category'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Severity');?></th> <td><?php echo $maintenance_request_detail['severity'];?></td>
		<th><?php echo lang('Request Date');?></th> <td><?php echo $maintenance_request_detail['date'];?></td>
		</tr> 

		<tr>
	    <th><?php echo lang('Longitude');?></th> <td><?php echo $maintenance_request_detail['LO'];?></td>
		<th><?php echo lang('Latitude');?></th> <td><?php echo $maintenance_request_detail['LA'];?></td>
		</tr>


  </table>

  <table class="table">
  	<tr>
	    <th><?php echo lang('Ownership');?></th> <td><?php echo $maintenance_request_detail['Ownership'];?></td>
		<th><?php echo lang('Region');?></th> <td><?php echo $address['region'];?></td>
		<th><?php echo lang('Zone');?></th> <td><?php echo $address['zone'];?></td>
		<th><?php echo lang('Woreda');?></th> <td><?php echo $address['woreda'];?></td>
	</tr>
  </table>
			

		</div> <!-- table body section -->
	</div>
	<div class="row description">
		<div class="col-md-12">
			<p><?php echo $maintenance_request_detail['description'];?></p>
		</div>
	</div>  <!-- end of description -->

	<div class="row">

	<div class="col-md-12">	

		<?php 
			$roll = $this->session->userdata('userroll');
			$sender_empID = $this->session->userdata('user_id');				            	
		?>

		<?php if(($this->session->userdata('userroll') == 'ZME')  && $address['approved_by_zme'] == '0'):?>
			<?php echo form_open_multipart('heritage/update_zme_approval/'.$maintenance_request_detail['empID'].'/'.$maintenance_request_detail['Name'].'/'.$roll.'/'.$sender_empID);?>
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
							<button type="submit" name="btn_approve" class="btn btn-primary btn-lg btn-block" id="btn_approve"><a href="<?php echo base_url('heritage/update_zme_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Approve</button>
							</div>
	            		</div>

	            		<div class="col-md-6">
	            			<div class="form-group">
							<button type="submit" name="btn_reject" class="btn btn-primary btn-lg btn-block" id="btn_reject"><a href="<?php echo base_url('heritage/update_zme_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Reject</button>
							</div>
	            		</div>
	            	</div>	            		
				</div>

				<div class="col-md-3"></div>

			</div><!-- end of row -->

		  	</form>
		  <?php endif;?>
			
		   <!-- approve button rme-->
			<?php if(($this->session->userdata('userroll') == 'RME')  && $address['approved_by_rme'] == '0'):?>
			<?php echo form_open_multipart('heritage/update_rme_approval/'.$maintenance_request_detail['empID'].'/'.$maintenance_request_detail['zme_id'].'/'.$maintenance_request_detail['Name'].'/'.$roll.'/'.$sender_empID);?>
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
							<button type="submit" name="btn_approve" class="btn btn-primary btn-lg btn-block" id="btn_approve"><a href="<?php echo base_url('heritage/update_rme_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Approve</button>
							</div>
	            		</div>

	            		<div class="col-md-6">
	            			<div class="form-group">
							<button type="submit" name="btn_reject" class="btn btn-primary btn-lg btn-block" id="btn_reject"><a href="<?php echo base_url('heritage/update_rme_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Reject</button>
							</div>
	            		</div>
	            	</div>	            		
				</div>

				<div class="col-md-3"></div>

			</div><!-- end of row -->

		  	</form>
		  <?php endif;?><!-- end of row -->

		  <!-- approve button rd-->
			<?php if(($this->session->userdata('userroll') == 'RD')  && $address['approved_by_rd'] == '0'):?>
			<?php echo form_open_multipart('heritage/update_rd_approval/'.$maintenance_request_detail['empID'].'/'.$maintenance_request_detail['zme_id'].'/'.$maintenance_request_detail['rme_id'].'/'.$maintenance_request_detail['Name'].'/'.$roll.'/'.$sender_empID);?>
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
							<button type="submit" name="btn_approve" class="btn btn-primary btn-lg btn-block" id="btn_approve"><a href="<?php echo base_url('heritage/update_rd_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Approve</button>
							</div>
	            		</div>

	            		<div class="col-md-6">
	            			<div class="form-group">
							<button type="submit" name="btn_reject" class="btn btn-primary btn-lg btn-block" id="btn_reject"><a href="<?php echo base_url('heritage/update_rd_approval/'.$maintenance_request_detail['heritage_id'])?>"></a>Reject</button>
							</div>
	            		</div>
	            	</div>	            		
				</div>

				<div class="col-md-3"></div>

			</div><!-- end of row -->

		  	</form>
		  <?php endif;?><!-- end of row -->
			
			
		</div> <!-- end of col two -->

		
		
		  
	</div> <!-- end of col three -->
	

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