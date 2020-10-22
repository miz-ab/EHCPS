<div class="container">
  <div class="row">
    <?php echo form_open_multipart('heritage/update_heritage/'.$load_heritage_to_update['NationalRNO']);?>
    <div class="jumbotron">
          <div class="form-group" >
             <h3 class="registration_form_header">Update Form</h3>
           </div>
      </div><!-- end of jumbotron -->    

    <div class="col-md-3">
            <div class="form-group">
            	<label>ID</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['NationalRNO'];?>" name="nid" placeholder=" National ID" id="nationalID" readonly/>
              <div id="id_div">
                <p id="err_id_exist">ID must be Unique<p>
              </div>
            </div>
            <div class="form-group ">
            <label>Category</label>
              <select name="heritage_category" id="heritage_category" class="form-control input_form_one">
                  <option value="Select_Category" selected><?php echo $load_heritage_to_update['Category'];?></option>
                  
                  <?php foreach ($category->result() as $row): ?>
                   <option value="<?= $row->category_name?>"><?= $row->category_name?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="form-group ">
            <label>Name</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['Name'];?>" name="name" placeholder="Name" id="heritage_name"/>
            </div>
            <div class="form-group">
            <label>Local Name</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['LocalName'];?>" name="localname" placeholder="Local Name" id="heritage_local_name"/>
            </div>
    </div><!-- end of first col-->

    <div class="col-md-3">
        <div class="form-group" id="aboundance_div_section">
        	<label>Aboundance</label>
            <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['Aboundance'];?>" name="aboumdance" placeholder="Aboundance" id="heritage_aboundance"/>
            <div id="aboundance_div">
              <p id="err_must_be_no">Aboundance must be Number<p>
            </div>
         </div>
            <div class="form-group ">
            <label>Date of Aqusition </label>
              <input type="date" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['DateOfAquistion'];?>" name="dateOfAqusition" placeholder="Date Of Acquistions" id="heritage_date"/>
            </div>
            <div class="form-group">
            <label>Catalog Number</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['CatalogNO'];?>" name="catalogNo" placeholder="Catelog Number" id="heritage_cno"/>
            </div>
            <div class="form-group">
            <label>Ownership</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['Ownership'];?>" name="ownerShip" placeholder="<?php echo 'Ownership';?>" id="heritage_ownership"/>
            </div>                                 
            
    </div>

    <div class="col-md-3">
    	<div class="form-group " id="site_name_div_section">
    		<label>Site Name</label>
            <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['SiteName'];?>" id="site_name" name="siteName" placeholder="Site Name">
        </div>
        <div class="form-group " id="site_code_div_section">
        	<label>Site Code</label>
            <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['SiteCode'];?>" id="site_code" name="siteCode" placeholder="Site Code">
        </div>
        <div class="form-group ">
        	<label>Latitude</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['LA'];?>" id="la" name="LA" placeholder="Latitude">
          </div>

          <div class="form-group ">
          	<label>Longitude</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['LO'];?>" id="lo" name="LO" placeholder="Longitude">
          </div>
    </div><!-- end of first col-->

    <div class="col-md-3">
    	<div class="form-group ">
    		<label>Region</label>
            <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['region_name'];?>" id="region" name="region" placeholder="Region" readonly>
        </div>
        <div class="form-group ">
        	<label>Zone</label>
            <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['zone_name'];?>" id="zone" name="zone" placeholder="Zone" readonly>
        </div>
        <div class="form-group ">
        	<label>Woreda</label>
              <input type="text" class="form-control input_form_one" value="<?php echo $load_heritage_to_update['woreda_name'];?>" id="woreda" name="woreda" placeholder="Woreda" readonly>
          </div>

          <div class="form-group ">
          		<label>Kebele</label>
                <select name="kebele_id" class="form-control input_form_one" id="k_id">
                    <option value="Select_Kebeles"><?php echo $load_heritage_to_update['kebele_name'];?></option>
                    <?php foreach($kebeles as $kebele):?>
                    <option value="<?php echo $kebele['kebele_id'];?>"><?php echo $kebele['kebele_name'];?></option>                                                                                            
                    <?php endforeach;?>
                </select>
          </div> 
    </div><!-- end of first col-->    
  </div>

  <div class="row">      

      <div class="col-md-12">
        <div class="form-group add_photo">
            <input type="file" class="form-control input_form_one" name="userfile" id="heritage_photo">
            </div>
      </div> <!-- col md 1st col -->     
    </div> <!-- end of row photo -->

    <div class="row">

  <div class="row">
	
	<div class="col-md-12">
		<div class="form-group ">
			<textarea  rows="4" class="form-control input_form_one" id="description" name="Description" placeholder="Description here..." ><?php echo $load_heritage_to_update['description'];?></textarea>
		</div>
	</div> <!-- col md 2st -->	      
		      
  </div> <!-- row description --> 	

  <div class="row">
	<div class="col-md-4"></div>
		<div class="col-md-4">
		<div class="form-group ">
			<button type="submit" name="action"
                class="btn btn-primary btn-lg btn-block" name="next" id="btn_update"> Update </button>	
		</div>
		<div class="col-md-4"></div>
	</div> <!-- col md 2st -->	      
		      
  </div> <!-- row description --> 
 </div>
 </form>
   <script>

   	$('#heritage_photo').filestyle({
	 iconName : 'glyphicon glyphicon-file',
	 buttonText : 'Select Photo',
	 buttonName : 'btn-warning'
	 
	});

    $(document).ready(function(){
      var aboundance_boolean = false;
      var heritage_id_boolean = false;
      var is_site_land = false;

      $('#aboundance_div').hide();
      $('#aboundance_div_section').show();
      $('#id_div').hide();
      //event function btn 
       $('#btn_next_form_one').click(function(event){
          //get all values of the input and set it in the session
          var NationalID      = $('#nationalID').val();
          var name            = $('#heritage_name').val();
          var localname       = $('#heritage_local_name').val();
          var catalogNo       = $('#heritage_cno').val();
          var aboumdance      = $('#heritage_aboundance').val();
          var dateOfAqusition = $('#heritage_date').val();
          var ownerShip       = $('#heritage_ownership').val();
          var category        = $('#heritage_category').val();

          if(!heritage_id_boolean){
            event.preventDefault();
            $('#nationalID').addClass('error_username');
            $('#err_id_exist').css("color","red");
          }else{
            $('#nationalID').removeClass('error_username');
          }

          if(!aboundance_boolean){
            event.preventDefault();
             $('#heritage_aboundance').addClass('error_username');
             $('#err_must_be_no').css("color","red"); 
          }else{
            $('#heritage_aboundance').removeClass('error_username');
          }

          if(category == "Select_Category"){
            event.preventDefault();
            $('#heritage_category').addClass('error_username');
          }else{
            $('#heritage_category').removeClass('error_username');
          }

          if (NationalID == "") {
            event.preventDefault();
            $('#nationalID').addClass('error_username');
          }


          if (name == "") {
            event.preventDefault();
            $('#heritage_name').addClass('error_username');
          }else{
            $('#heritage_name').removeClass('error_username');
          }


          if (localname == "") {
            event.preventDefault();
            $('#heritage_local_name').addClass('error_username');
          }else{
            $('#heritage_local_name').removeClass('error_username');
          }

          if (catalogNo == "") {
            event.preventDefault();
            $('#heritage_cno').addClass('error_username');
          }else{
            $('#heritage_cno').removeClass('error_username');
          }

          if ((!is_site_land) && (aboumdance == "")) {
            event.preventDefault();
            $('#heritage_aboundance').addClass('error_username');
          }else{
            aboundance_boolean = true;
          }

          /*

          var date = new Date($('#dateOfAqusition')).val();
          if(date == ""){
            event.preventDefault();
            $('#dateOfAqusition').addClass('error_username');
          }
          */

          if (ownerShip == "") {
            event.preventDefault();
            $('#heritage_ownership').addClass('error_username');
          }

          
        });

        var arr_aboundace=[];

    $('#heritage_aboundance').keyup(function(event){
      var aboumdance = $('#heritage_aboundance').val();

          if((aboumdance != '' && (!is_site_land))){
            console.log('siteland');
            if(!isNaN(aboumdance) && aboumdance > 0){
              $('#err_must_be_no').css("color","green"); 
              aboundance_boolean = true;   
            }else if (!isNaN(aboumdance) && aboumdance <= 0) {
                document.getElementById("err_must_be_no").innerHTML = "Aboundance Number must be > 0";
                $('#err_must_be_no').css("color","red"); 
                aboundance_boolean = false; 
            }
            else{
              $('#err_must_be_no').css("color","red");   
              aboundance_boolean = false; 
            }
          }else{
            aboundance_boolean = true;
          }

          
    });

    $('#nationalID').keyup(function(event){
       //event.preventDefault();
       var id = $('#nationalID').val();
            
            if(id != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/heritage/check_heritage_id_exists/' + id,true);
            xhr.onload = function(){
            if(this.status == 200){
            var result = JSON.parse(xhr.responseText);

            console.log(result);
            
            if(result == 'B'){
                $('#err_id_exist').css("color","red");
                heritage_id_boolean = false;
            }else {
                $('#err_id_exist').css("color","green");
                heritage_id_boolean = true;
            }
        }
    }
      xhr.send();
      }

        
    });

    $('#nationalID').focus(function(){
      $('#id_div').show();
    });

    $('#heritage_name').focus(function(){
      $('#id_div').hide();
    });

    $('#heritage_aboundance').focus(function(){
        $('#aboundance_div').show();
        $('#id_div').hide();
    });

    $('#heritage_cno').focus(function(){
        $('#aboundance_div').hide();
    });

    $('#nationalID').focus(function(){
        $('#aboundance_div').hide();
    });

     $('#heritage_date').focus(function(){
        $('#aboundance_div').hide();
    });

    $('#heritage_category').change(function(){
      var  val = $('#heritage_category').val();
      if(val == 'Site Land'){
        is_site_land = true;
        aboundance_boolean = true;
        $('#aboundance_div_section').hide();
        $('#site_name_div_section').show();
      	$('#site_code_div_section').show();        
      }

      if(val == 'Architectural Heritage'){
        is_site_land = true;
        aboundance_boolean = true;
        $('#aboundance_div_section').hide();
        $('#site_name_div_section').show();
      	$('#site_code_div_section').show();       
      }

      if(val == 'Artwork'){
        is_site_land = false; 
      	$('#site_name_div_section').hide();
      	$('#site_code_div_section').hide();
        $('#aboundance_div_section').show();
      }

      if(val == 'Arcaeological Finding'){
      	is_site_land = false; 
      	$('#site_name_div_section').hide();
      	$('#site_code_div_section').hide();
        $('#aboundance_div_section').show();
      }
    });

    });
   </script>