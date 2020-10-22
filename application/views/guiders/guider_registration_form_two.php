<div class="container">
  <div class="row">
    <?php echo form_open('guiders/guider_registration_two');?>

    <div class="jumbotron"> 
      <h3 class="registration_form_header">Guider Registration Form Two</h3>
    </div> <!-- end of jumbotron -->

    <div class="col-md-2"></div>

    <div class="col-md-4">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="la" id="guider_la" placeholder="Latitude">
      </div>                        

    </div><!-- div first col -->

    <div class="col-md-4">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="lo" id="guider_lo"
        placeholder="Longtuide">
      </div>                   
    </div><!-- div second col --> 

    <div class="col-md-2"></div>    
      
  </div><!-- end of row 1st-->

  <div class="row">

    <div class="col-md-2"></div>      
    
    <div class="col-md-8">
      <div class="form-group ">
      <input type="text" class="form-control input_form_one" name="address" id="guider_address"
      placeholder="Address">
      </div>

    </div>

    <div class="col-md-2"></div>

  </div>

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
      <button type="submit" name="action" value="<<" 
        class="btn btn-primary btn-lg"  id="btn_prve_btn">
        <span class="glyphicon glyphicon-chevron-left"></span>PREV
      </button>
    </div>
    <div class="col-md-4">
      <button type="submit" name="action" value="Finish" 
        class="btn btn-primary btn-lg"  id="btn_next_form_one"> Register        
      </button>
    </div>
    <div class="col-md-2"></div>
  </div>

</form>
     
   </div><!-- end of container -->

   
   <script>
   //input validation
    $(document).ready(function(){

      $('#btn_next_form_one').click(function(event){
          
          var la          = $('#guider_la').val();
          var lo          = $('#guider_lo').val();
          var address     = $('#guider_address').val();
          var bio         = $('#guider_bio').val();          


          if(la == ''){
            $('#guider_la').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_la').removeClass('error_username');
          }

          if(lo == ''){
            $('#guider_lo').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_lo').removeClass('error_username');
          }
          
          if(address == ''){
            $('#guider_address').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_address').removeClass('error_username');
          }

          if(bio == ''){
            $('#guider_bio').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_bio').removeClass('error_username');
          }        

      }); // end of btn click               

    });
    </script>