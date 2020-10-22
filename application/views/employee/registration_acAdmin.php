<div class="container">
  <div class="row">
    <?php echo form_open('employee/logic_ac_admin_registration_one');?>

    <div class="jumbotron"> 
      <h3 class="registration_form_header">Information Center Admin Registration Form One</h3>
    </div> <!-- end of jumbotron -->

    <div class="col-md-2"></div>

    <div class="col-md-4">

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="emp_id" id="emp_id" placeholder="Employee ID">
      </div>

      <div class="form-group ">
        <input type="text" class="form-control input_form_one"
        name="emp_fname" id="emp_fname" placeholder="First Name">
      </div>

        <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="emp_lname" id="emp_lname"
              placeholder="Last Name">
          </div>      

        <div class="form-group ">
              <input type="text" class="form-control input_form_one"  id="emp_username"
              name="emp_username" placeholder="Username">
              <div id="username_div">
                <p id="err_username_exist">UserName must be Unique<p>
              </div>
          </div>

    </div><!-- div first col -->

    <div class="col-md-4">
      <div class="form-group ">
        <input type="text" class="form-control input_form_one" name="emp_mname" id="emp_mname"
        placeholder="Middle Name">
      </div>

      <div class="form-group ">
              <select name="emp_sex" class="form-control input_form_one" id="emp_sex">
                <option value="Select_Sex">Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                    
              </select>
        </div>

        <div class="form-group ">
              <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control input_form_one" name="dateOB"
               placeholder="Birth Date" id="dateOB" >               
        </div>

        <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="emp_email" id="emp_email"
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
      $('#DB_div').hide();
      var username_boolean = true;
      var email_validation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      //email validation
      $('#emp_email').keyup(function(event){
      var email = $('#emp_email').val();
         
        if(email_validation.test(email)){
          $('#emp_email').removeClass('error_username');
        }else{
          $('#emp_email').addClass('error_username');
          event.preventDefault();
        }
    });

      $('#btn_next_form_one').click(function(event){
        
          var emp_id     = $('#emp_id').val();
          var fname     = $('#emp_fname').val();
          var mname     = $('#emp_mname').val();
          var lname     = $('#emp_lname').val();
          var dateOB     = $('#dateOB').val();
          var sex       = $('#emp_sex').val();
          var email     = $('#emp_email').val();
          var username  = $('#emp_username').val();


          if(emp_id == ''){
            $('#emp_id').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_id').removeClass('error_username');
          }

          if(username == ''){
            $('#emp_username').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_username').removeClass('error_username');
          }

          if(sex == 'Select_Sex'){
            $('#emp_sex').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_sex').removeClass('error_username');
          }

          if(dateOB == ''){
            $('#dateOB').addClass('error_username');
            event.preventDefault();
          }else{
            $('#dateOB').removeClass('error_username');
          }

          if(fname == ''){
            $('#emp_fname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_fname').removeClass('error_username');
          }

          if(mname == ''){
            $('#emp_mname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_mname').removeClass('error_username');
          }

          if(lname == ''){
            $('#emp_lname').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_lname').removeClass('error_username');
          }

          if(email == ''){
            $('#emp_email').addClass('error_username');
            event.preventDefault();
          }else{
            $('#emp_email').removeClass('error_username');
          }

          if(email_validation.test(email)){
          $('#emp_email').removeClass('error_username');
            //event.preventDefault();
        }else{
          $('#emp_email').addClass('error_username');
          event.preventDefault();
        }

        if(!username_boolean){
          event.preventDefault();
        }

      }); // end of btn click 

      $('#emp_username').keyup(function(event){
        var username  = $('#emp_username').val();
        if(username != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/employee/check_user_username_exists/' + username,true);
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

      $('#emp_username').focus(function(event){
          $('#username_div').show();
          $('#DB_div').hide();
      });

      $('#dateOB').focus(function(event){
         $('#username_div').hide();
         $('#DB_div').show();
      });

      $('#emp_mname').focus(function(event){
        $('#username_div').hide();
      });

      

    });
    </script>