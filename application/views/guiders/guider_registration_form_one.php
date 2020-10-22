<div class="container">
  <div class="row">
    <?php echo form_open('guiders/guider_registration_one');?>

    <div class="jumbotron"> 
      <h3 class="registration_form_header">Guider Registration Form One</h3>
    </div> <!-- end of jumbotron -->

    <div class="col-md-2"></div>

    <div class="col-md-4">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="fname" id="guider_fname" placeholder="First Name">
      </div>

      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="lname" id="guider_lname"
        placeholder="Last Name">
      </div>

      <div class="form-group ">
              <select name="sex" class="form-control input_form_one" id="guider_sex">
                <option value="Select_Sex">Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                    
              </select>
        </div>

        <div class="form-group ">
              <input type="text" class="form-control input_form_one"  id="guider_username"
              name="username" placeholder="Username">
              <div id="username_div">
                <p id="err_username_exist">Username must be Unique<p>
              </div>
          </div>          

    </div><!-- div first col -->

    <div class="col-md-4">
      
      <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="phone_no" id="guider_phone_no"
              placeholder="Phone NO">
      </div>

      <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="email" id="guider_email"
               placeholder="Email Address">
      </div>

      <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="fb"
               placeholder="FB Account" id="guider_fb"/>
      </div>            
      
      <button type="submit" name="action" value="Finish" 
          class="btn btn-primary btn-lg btn-block"  id="btn_next_form_one"> NEXT
                 <span class="glyphicon glyphicon-chevron-right"></span>  </button>
    </div><!-- div second col --> 

    <div class="col-md-2"></div>   
      
  </div><!-- end of row 1st-->

</form>
     
   </div><!-- end of container -->

   
   <script>
   //input validation
    $(document).ready(function(){
      $('#username_div').hide();
      var username_boolean = true;
      var email_validation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      //email validation
      $('#guider_email').keyup(function(event){
      var email = $('#guider_email').val();
         
        if(email_validation.test(email)){
          $('#guider_email').removeClass('error_username');
        }else{
          $('#guider_email').addClass('error_username');
          event.preventDefault();
        }
    });

      $('#btn_next_form_one').click(function(event){
                    
          var fname           = $('#guider_fname').val();          
          var lname           = $('#guider_lname').val();
          var sex             = $('#guider_sex').val();
          var email           = $('#guider_email').val();
          var username        = $('#guider_username').val();
          var phone_no        = $('#guider_phone_no').val();
          var fb_account      = $('#guider_fb').val();          


          if(username == ''){
            $('#guider_username').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_username').removeClass('error_username');
          }
          
          if(sex == 'Select_Sex'){
            $('#guider_sex').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_sex').removeClass('error_username');
          }

          if(fname == ''){
            $('#guider_fname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_fname').removeClass('error_username');
          }

          if(lname == ''){
            $('#guider_lname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_lname').removeClass('error_username');
          }

          if(phone_no == ''){
            $('#guider_phone_no').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_phone_no').removeClass('error_username');
          }

          if(email == ''){
            $('#guider_email').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_email').removeClass('error_username');
          }

          if(fb_account == ''){
            $('#guider_fb').addClass('error_username');
            event.preventDefault();
          }else{
            $('#guider_fb').removeClass('error_username');
          }

          if(email_validation.test(email)){
          $('#guider_email').removeClass('error_username');
            //event.preventDefault();
        }else{
          $('#guider_email').addClass('error_username');
          event.preventDefault();
        }

        if(!username_boolean){
          event.preventDefault();
        }

      }); // end of btn click 

      $('#guider_username').keyup(function(event){
        var username  = $('#guider_username').val();
        if(username != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/guiders/check_guider_username_exists/' + username,true);
            xhr.onload = function(){
            if(this.status == 200){
            var result = JSON.parse(xhr.responseText);

            //console.log(result);
            
            if(result == 'B'){
                $('#err_username_exist').css("color","red");
                username_boolean = false;
            }else {
                $('#err_username_exist').css("color","green");
                username_boolean = true;
            }
        }
    }
      xhr.send();
      }

      //console.log('userstatus ' + username_boolean);

      });// end of key up function 

      $('#guider_username').focus(function(event){
          $('#username_div').show();
      });

      $('#guider_fname').focus(function(event){
         $('#username_div').hide();
      });

      $('#guider_lname').focus(function(event){
         $('#username_div').hide();
      });

      $('#guider_sex').focus(function(event){
         $('#username_div').hide();
      });

      $('#guider_phone_no').focus(function(event){
         $('#username_div').hide();
      });

      $('#guider_email').focus(function(event){
         $('#username_div').hide();
      });

      $('#guider_fb').focus(function(event){
         $('#username_div').hide();
      });

      

    });
    </script>