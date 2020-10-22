<div class="container">
	<?php echo form_open('employee/logic_employee_registration_last');?>
	<div class="row">
		<div class="jumbotron">
			<div class="form-group">    

        <?php if($this->session->userdata('userroll') == 'RD'): ?>   
             <h3 class="registration_form_header">Employee Registration Form Two</h3>
        <?php endif; ?>
        <?php if($this->session->userdata('userroll') == 'RTDD'): ?>   
             <h3 class="registration_form_header">Information Center Admin Registration Form Two</h3>
        <?php endif; ?>
           </div>
		</div><!-- end of jumbotron -->

		<div class="col-md-4"></div> <!-- end of 1st col -->

		<div class="col-md-4">
		
		<div class="form-group ">
              <?php $emp_id = $this->session->userdata('hidden_emp_id'); ?>
              <input type="hidden" name="hidden_emp_id" value="<?php echo $emp_id; ?>">
              <select name="region_id" class="form-control input_form_one" id="r_id">
                <option value="Select_Region">Select Region</option>
                 <?php foreach($regions as $region):?>
                         <option value="<?php echo $region['region_id'];?>"><?php echo $region['region_name'];?></option>                                                                                            
                    <?php endforeach;?>
              </select>
            </div>

        <div class="form-group ">
                <select name="zone_id" class="form-control input_form_one" id="z_id">
                  <option value="Select_Zone">Select Zone</option>
              </select>
            </div>

            <div class="form-group ">
                <select name="woreda_id" class="form-control input_form_one" id="w_id">
                   <option value="Select_Woreda">Select Woreda</option>
                </select>
            </div>

             <div class="form-group ">
                <select name="kebele_id" class="form-control input_form_one" id="k_id">
                   <option value="Select_Kebele">Select Kebele</option>
                </select>
            </div> 
        
		</div> <!-- end of 2nd col -->


		<div class="col-md-4"></div> <!-- end of 4th col -->
	</div><!-- end of row -->

	<div class="row">
		<div class="col-md-4">

		</div>

		<div class="col-md-4">
		
			<button type="submit" name="action" value="Finish" 
          		class="btn btn-primary btn-lg"  id="btn_prve_btn"> 
          		<span class="glyphicon glyphicon-chevron-left"></span> BACK </button>
			
          	<button type="submit" name="action" value="Finish" 
          class="btn btn-primary btn-lg"  id="btn_next_form_one"> FINISH </button>
         
		</div>

		<div class="col-md-4">

		</div>
	</div>
	
</form>
</div>

<script>
    $(document).ready(function(){
    	$('#btn_next_form_one').click(function(event){
    		//event.preventDefault();
    		var r_id = $('#r_id').val();
    		var z_id = $('#z_id').val();
    		var w_id = $('#w_id').val();
    		var k_id = $('#k_id').val();

    		if(r_id == 'Select_Region'){
    			event.preventDefault();
    			$('#r_id').addClass('error_username');
    		}else{
    			$('#r_id').removeClass('error_username');
    		}


    		if(z_id == 'Select_Zone'){
    			event.preventDefault();
    			$('#z_id').addClass('error_username');
    		}else{
    			$('#z_id').removeClass('error_username');
    		}


    		if(w_id == 'Select_Woreda'){
    			event.preventDefault();
    			$('#w_id').addClass('error_username');
    		}else{
    			$('#w_id').removeClass('error_username');
    		}


    		if(k_id == 'Select_Kebele'){
    			event.preventDefault();
    			$('#k_id').addClass('error_username');
    		}else{
    			$('#k_id').removeClass('error_username');
    		}

    	}); //end of btn

    	
       $('#r_id').change(function(){
          var region_id = $('#r_id').val();
          if(region_id == 'Select_Region'){
    			$('#r_id').addClass('error_username');
    		}else{
    			$('#r_id').removeClass('error_username');
    		}


          if(region_id != ''){
            $.ajax({
              url: "<?php echo base_url();?>employee/dependent_load_zone",
              method: "POST",
              data: {region_id:region_id},
              success: function(data){
                $('#z_id').html(data);
              }
            })
          }//end of if
       });//end of change function


       $('#z_id').change(function(){
        var zone_id = $('#z_id').val();
        if(zone_id == 'Select_Zone'){
    			$('#z_id').addClass('error_username');
    		}else{
    			$('#z_id').removeClass('error_username');
    		}

        if (zone_id != '') {
          $.ajax({
              url: "<?php echo base_url();?>employee/dependent_load_woreda",
              method: "POST",
              data: {zone_id:zone_id},
              success: function(data){
                $('#w_id').html(data);
              }
            })
        }
       });//end of zone btn

       $('#w_id').change(function(){
        var woreda_id = $('#w_id').val();

        if(woreda_id == 'Select_Woreda'){
    			$('#w_id').addClass('error_username');
    		}else{
    			$('#w_id').removeClass('error_username');
    		}

        if (woreda_id != '') {
          $.ajax({
              url: "<?php echo base_url();?>employee/dependent_load_kebele",
              method: "POST",
              data: {woreda_id:woreda_id},
              success: function(data){
                $('#k_id').html(data);
              }
            })
        }
       });//end of zone btn

    });
   </script>