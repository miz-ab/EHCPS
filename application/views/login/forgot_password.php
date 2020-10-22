<div class="container">
    <div class="row">
        <div class="col-md-4"></div><!-- end of col -->
            <div class="col-md-4 login_body">
            <!-- flash message login failed -->
    <?php if($this->session->flashdata('login_failed')):?>
     <?php echo '<p class="alert alert-danger alert_login_faield">'.$this->session->flashdata('login_failed').'</p>'?>
    <?php endif;?>

    <?php if($this->session->flashdata('login_sucess')):?>
      <?php echo '<p class="alert alert-sucess">'.$this->session->flashdata('login_sucess').'</p>'?>
    <?php endif;?>

    <?php if($this->session->flashdata('logged_out')):?>
            <?php echo '<p class="alert alert-success alert_logout_sucess">'.$this->session->flashdata('logged_out').'</p>'?>
    <?php endif;?>
            <?php /*echo validation_errors();*/?>
    <?php echo form_open('login/forgotpassword'); ?>
        
        <div class="form-group">
            <input type="text" name="username" placeholder="Enter your email address" 
            id="id_email" class="form-control login_username">
            <div>
                <p id="valid_email_address">Enter Valid Email Address</p>
            </div>
        </div>

         
        <div class="row">
            <div class="form-group col-md-12">
                 <button class="btn btn-primary btn-lg btn-block" id="btn_submit" name="action" value="Login">Submit</button>   
            </div><!-- end of login btn -->
            <p id="new_password_info">The new password will be sent in your email address<p>
        </div> <!-- end of inner row -->  
            <div class="login_message">
               
            </div><!-- end of div login message -->
           
    </form>
            </div><!-- end of col -->
        <div class="col-md-4"></div><!-- end of col -->
    </div><!-- end of row -->
</div>

<script>
    $(document).ready(function(){
        var email_validation = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var valid_email = false;

        $('#valid_email_address').hide();

        $('#id_email').keyup(function(event){
            var email = $('#id_email').val();
            if(email_validation.test(email)){
                $('#id_email').removeClass('error_username');
                $('#valid_email_address').css('color','green');
                valid_email = true;
            }else{
                $('#id_email').addClass('error_username');
                $('#valid_email_address').css('color','red');
                event.preventDefault();
            }
        });

        $('#id_email').focus(function(event){
            $('#valid_email_address').show();
        })
        
        $('#btn_submit').click(function(event){
            
            var email = $('#id_email').val();

            /*
        
            if(email == ''){
                $('#id_email').addClass('error_username');
                event.preventDefault();
            }else{
                $('#id_email').removeClass('error_username');
            }

            */

            if(email != ''){
                if(valid_email){
                    $('#id_email').removeClass('error_username');
                }else{
                    $('#id_email').addClass('error_username');
                    event.preventDefault();
                }
            }else{
                 $('#id_email').addClass('error_username');
                 event.preventDefault();
            }
        });//end of btn
  
    });
</script>
