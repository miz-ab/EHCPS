<div class="container">
  <div class="row">
    <?php echo form_open('tourist/tourist_registration_one');?>

    <div class="jumbotron"> 
      <h3 class="registration_form_header">Tourist Registration Form One</h3>
    </div> <!-- end of jumbotron -->

    <div class="col-md-2"></div>

    <div class="col-md-4">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="fname" id="tourist_fname" placeholder="First Name">
      </div>

      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="mname" id="tourist_mname"
        placeholder="Middle Name">
      </div>

      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="lname" id="tourist_lname"
        placeholder="Last Name">
      </div>

      <div class="form-group ">
        <select name="sex" class="form-control input_form_one" id="tourist_sex">
          <option value="Select_Sex">Sex</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
              
        </select>
      </div>            

    </div><!-- div first col -->

    <div class="col-md-4">
      
      <div class="form-group ">
              <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control input_form_one" name="dob" id="tourist_dob"
              placeholder="Date of Birth">
      </div>

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"  id="tourist_username"
        name="username" placeholder="Username">
        <div id="username_div">
          <p id="err_username_exist">Username must be Unique<p>
        </div>
      </div>

      <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="email" id="tourist_email"
               placeholder="example@gmail.com">
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
      $('#tourist_email').keyup(function(event){
      var email = $('#tourist_email').val();
         
        if(email_validation.test(email)){
          $('#tourist_email').removeClass('error_username');
        }else{
          $('#tourist_email').addClass('error_username');
          event.preventDefault();
        }
    });

      $('#btn_next_form_one').click(function(event){
                    
          var fname           = $('#tourist_fname').val();
          var mname           = $('#tourist_mname').val();          
          var lname           = $('#tourist_lname').val();
          var sex             = $('#tourist_sex').val();
          var email           = $('#tourist_email').val();
          var username        = $('#tourist_username').val();
          var dob             = $('#tourist_dob').val();                  


          if(username == ''){
            $('#tourist_username').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_username').removeClass('error_username');
          }
          
          if(sex == 'Select_Sex'){
            $('#tourist_sex').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_sex').removeClass('error_username');
          }

          if(dob == ''){
            $('#tourist_dob').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_dob').removeClass('error_username');
          }

          if(fname == ''){
            $('#tourist_fname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_fname').removeClass('error_username');
          }

          if(mname == ''){
            $('#tourist_mname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_mname').removeClass('error_username');
          }

          if(lname == ''){
            $('#tourist_lname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_lname').removeClass('error_username');
          }        

          if(email == ''){
            $('#tourist_email').addClass('error_username');
            event.preventDefault();
          }else{
            $('#tourist_email').removeClass('error_username');
          }        

          if(email_validation.test(email)){
          $('#tourist_email').removeClass('error_username');
            //event.preventDefault();
        }else{
          $('#tourist_email').addClass('error_username');
          event.preventDefault();
        }

        if(!username_boolean){
          event.preventDefault();
        }

      }); // end of btn click 

      $('#tourist_username').keyup(function(event){
        var username  = $('#tourist_username').val();
        if(username != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/tourist/check_tourist_username_exists/' + username,true);
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

      $('#tourist_username').focus(function(event){
          $('#username_div').show();
      });

      $('#tourist_fname').focus(function(event){
         $('#username_div').hide();
      });

      $('#tourist_lname').focus(function(event){
         $('#username_div').hide();
      });

      $('#tourist_mname').focus(function(event){
         $('#username_div').hide();
      });

      $('#tourist_sex').focus(function(event){
         $('#username_div').hide();
      });

      $('#tourist_dob').focus(function(event){
         $('#username_div').hide();
      });     

      $('#tourist_email').focus(function(event){
         $('#username_div').hide();
      });

    });
    </script>