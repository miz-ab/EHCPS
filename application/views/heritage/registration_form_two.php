<div class="container">

  <!-- language setting and language model -->
  <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
  <?php echo form_open_multipart('heritage/logic_register_heritage_two');?>
  <div class="row">
    <div class="jumbotron">
      <div class="form-group">
       <h3 class="registration_form_header"><?php echo lang('Heritage Registration two');?></h3>
      </div>
    </div> <!-- end of jumbotron -->
    </div><!-- end of row -->

    <div class="row">
      <div class="col-md-1"></div> <!-- col md 1st col -->

      <div class="col-md-10">
        <div class="form-group add_photo">
              <input type="file" class="form-control input_form_one" name="userfile" id="heritage_photo">
            </div>
      </div> <!-- col md 1st col -->

      <div class="col-md-1"></div> <!-- col md 1st col -->
    </div> <!-- end of row photo -->

    <div class="row">

      <div class="col-md-1"></div><!-- end of col -->
      <div class="col-md-5">

          <?php $category = $this->session->userdata('selected_category'); ?>

          <input type="hidden" name="hidden_category" id="hidden_category" value="<?php echo $category; ?>">

            <div class="form-group " id="site_name_div_section">
              
              <input type="text" class="form-control input_form_one" id="site_name" name="siteName" placeholder="<?php echo lang('Site Name');?> ">
            </div>

            <div class="form-group ">
              <input type="text" class="form-control input_form_one" id="la" name="LA" placeholder="<?php echo lang('Latitude');?> ">
            </div>
            
            
      </div><!-- end of col 5-->

      <div class="col-md-5">          

          <div class="form-group " id="site_code_div_section">
              <input type="text" class="form-control input_form_one" id="site_code" name="siteCode" placeholder="<?php echo lang('Site Code');?>">
          </div>

          <div class="form-group ">
              <input type="text" class="form-control input_form_one" id="lo" name="LO" placeholder="<?php echo lang('Longitude');?>">
          </div>
      </div><!-- end of col 5-->
      <div class="col-md-1"></div><!-- end of col 1-->

    </div> <!-- end of middle row -->

    <div class="row">
      <div class="col-md-1"></div> <!-- col md 1st -->
      <div class="col-md-10">
        <div class="form-group ">
              <textarea  rows="4" class="form-control input_form_one" id="description" name="Description" placeholder="<?php echo lang('Description here...');?>" ></textarea>
      </div>
      </div> <!-- col md 2st -->
      <div class="col-md-1"></div> <!-- col md 3st -->
      
    </div> <!-- row description -->

    <div class="row">

      <div class="col-md-6 col-md-offset-3 action_section">
          <div class="form-group">
              <button type="submit" name="action" value=">>" 
                class="btn btn-primary btn-lg"  id="btn_next_form_one"><?php echo lang('NEXT');?>  <span class="glyphicon glyphicon-chevron-right"></span></button>

                <button type="submit" name="action" value="<<" 
                class="btn btn-primary btn-lg"  id="btn_prve_btn"> 
                 <span class="glyphicon glyphicon-chevron-left"></span><?php echo lang('PREVIOUS');?>  </button>
            </div>
      </div>

    </div> <!-- row action -->
     </form>
   </div><!-- end of container -->


  
<script>
 
$('#heritage_photo').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
 
});

$(document).ready(function(){

  var passed_category = document.cookie;

  if(passed_category == 'Arcaeological Finding'){          

        $('#site_name_div_section').hide();
        $('#site_code_div_section').hide();
      }
  if(passed_category == 'Artwork'){      

    $('#site_name_div_section').hide();
    $('#site_code_div_section').hide();
  }

  //console.log(passed_category);

  //delete the cookie

  var is_site_land = false;

  $('#hidden_category').change(function(){

    var selected_category = $('#hidden_category').var();

    if(selected_category == 'Site Land'){
        is_site_land = true;
        
        $('#site_name_div_section').show();
        $('#site_code_div_section').show();        
      }
        
      if(selected_category == 'Architectural Heritage'){
        is_site_land = true;
        
        $('#site_name_div_section').show();
        $('#site_code_div_section').show();        
      }      

      if(selected_category == 'Arcaeological Finding'){  
        is_site_land = false;

        $('#site_name_div_section').hide();
        $('#site_code_div_section').hide();
      }
      if(selected_category == 'Artwork'){  
        is_site_land = false;

        $('#site_name_div_section').hide();
        $('#site_code_div_section').hide();
      }

  });

  $('#btn_next_form_one').click(function(event){
    var site_name         = $('#site_name').val();
    var site_code         = $('#site_code').val();
    var la                = $('#la').val();
    var lo                = $('#lo').val();
    var description       = $('#description').val();
    var heritage_photo    = $('#heritage_photo').val();  


    if(site_name == "" && (passed_category == 'Architectural Heritage' || passed_category == 'Site Land')){
      $('#site_name').addClass('error_username');
      event.preventDefault();
    }else{
      $('#site_name').removeClass('error_username');
    }

    if(heritage_photo == ""){
      $('#heritage_photo').addClass('error_username');
      event.preventDefault();
    }else{
      $('#heritage_photo').removeClass('error_username');
    }
    
    if(site_code == "" && (passed_category == 'Architectural Heritage' || passed_category == 'Site Land')){
      $('#site_code').addClass('error_username');
      event.preventDefault();
    }else{
      $('#site_code').removeClass('error_username');
    }

    if(la == ""){
      $('#la').addClass('error_username');
      event.preventDefault();
    }else{
      $('#la').removeClass('error_username');
    }

    if(lo == ""){
      $('#lo').addClass('error_username');
      event.preventDefault();
    }else{
      $('#lo').removeClass('error_username');
    }

    if(description == ""){
      $('#description').addClass('error_username');
      event.preventDefault();
    }else{
      $('#description').removeClass('error_username');
    }
    
  });

  var d = new Date();
      d.setTime(d.getTime() - (1000*60*60*24));
      var expires = "expires=" + d.toGMTString();
      window.document.cookie = passed_category+"="+"; "+expires;
  
});
 
</script>