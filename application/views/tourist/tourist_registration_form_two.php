<div class="container">
  <div class="row">
    <?php echo form_open('tourist/tourist_registration_two');?>

    <div class="jumbotron"> 
      <h3 class="registration_form_header">Tourist Registration Form Two</h3>
    </div> <!-- end of jumbotron -->

    <div class="col-md-3"></div>

    <div class="col-md-6">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="passport" id="tourist_passport" placeholder="Passport Number">
      </div> 

      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="country" id="tourist_country"
        placeholder="Country">
      </div> 

      <div class="form-group ">
        <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control input_form_one"
        name="doe" id="tourist_doe" placeholder="Date of Entry">
      </div>      

      <div class="form-group ">
        <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control input_form_one"
        name="dor" id="tourist_dor" placeholder="Date of Return">
      </div>                          

    </div><!-- div first col -->
    

    <div class="col-md-3"></div>    
      
  </div><!-- end of row 1st-->

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
      <button type="submit" name="action" value="<<" 
        class="btn btn-primary btn-lg"  id="btn_prve_btn">
        <span class="glyphicon glyphicon-chevron-left"></span>PREV
      </button>
    </div>
    <div class="col-md-3">
      <button type="submit" name="action" value="Finish" 
        class="btn btn-primary btn-lg"  id="btn_next_form_one"> Register        
      </button>
    </div>
    <div class="col-md-3"></div>
  </div>

</form>
     
   </div><!-- end of container -->

   
   <script>
   //input validation
    $(document).ready(function(){

      $('#btn_next_form_one').click(function(event){
          
          var passport          = $('#tourist_passport').val();
          var country           = $('#tourist_country').val();
          var doe               = $('#tourist_doe').val();
          var dor               = $('#tourist_dor').val();          


          if(passport == ''){
            $('#tourist_passport').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_passport').removeClass('error_username');
          }

          if(country == ''){
            $('#tourist_country').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_country').removeClass('error_username');
          }
          
          if(doe == ''){
            $('#tourist_doe').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_doe').removeClass('error_username');
          }

          if(dor == ''){
            $('#tourist_dor').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_dor').removeClass('error_username');
          }        

      }); // end of btn click               

    });
    </script>