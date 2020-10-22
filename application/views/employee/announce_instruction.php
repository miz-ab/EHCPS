<div style="padding:0 15px;">
	<div class="row">
      <div class="jumbotron">
         <div class="form-group">
         <h3 class="registration_form_header">Instruction Announcement</h3>
           </div>
      </div><!-- end of jumbotron -->
		<div class="col-md-3 menu_wr">
			<h3></h3>
			
				
			<div class="list_of_menu">
      			<ul>
				<li><a href="<?php echo base_url('employee/announce_instruction');?>">
                <span class="glyphicon glyphicon-th"></span>Announce Instruction</a></li>
                <?php if($this->session->userdata('userroll') == 'FHRA'): ?>                
                <?php endif; ?>                   
				</ul>
			</div>
			
		</div> <!-- menu div -->

		<div class="col-md-9">
			<div class="row">
			<?php echo form_open_multipart('employee/announce_fedral_instruction');?>
				<div class="col-md-1"></div>
				<div class="col-md-8">
					<div class="form-group">
						<label>Select Region:</label>
						<select name="region_id" class="form-control input_form_one" id="r_id">
                <option value="Select_Region">Select Region</option>
                 <?php foreach($regions as $region):?>
                         <option value="<?php echo $region['region_id'];?>"><?php echo $region['region_name'];?></option>                                                                                            
                    <?php endforeach;?>
              </select>
					</div>
					<div class="form-group">
						<label>Title:</label>
						<input type="text" class="form-control input_form_one" name="title" id="title" placeholder="Title">
					</div>
					<label>Attachement:</label>
					<div class="form-group add_photo">						
						<input type="file" class="form-control input_form_one" name="userfile" id="attachement">
					</div>
					<div class="form-group ">
				        <textarea  rows="4" class="form-control input_form_one" id="description" name="description" placeholder="Description here..." ></textarea>
				    </div>
				    <button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_announce" id="btn_announce">Announce</button>
				</div><!-- col-md-8 -->
				<div class="col-md-3"></div>
				</form>
			</div><!-- end of row -->	
		</div> <!-- col-md-9 -->
	</div>
</div>


<script>
 
$('#attachement').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
 
});
</script>

<script>
$(document).ready(function(){
 
  $('#btn_announce').click(function(){

    var title 				= $('#title').val();
  	var attachement 		= $('#attachement').val();
  	var description 		= $('#description').val();

    if(title == ""){
      $('#title').addClass('error_username');
      event.preventDefault();
    }else{
      $('#title').removeClass('error_username');
    }

    if(attachement == ""){
      $('#attachement').addClass('error_username');
      event.preventDefault();
    }else{
      $('#attachement').removeClass('error_username');
    }

    if(description == ""){
      $('#description').addClass('error_username');
      event.preventDefault();
    }else{
      $('#description').removeClass('error_username');
    }

   });
});      
</script>