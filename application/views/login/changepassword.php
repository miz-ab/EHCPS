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
    <?php echo form_open('login/login_as_emp'); ?>
        
        <div class="form-group">
            <input type="text" name="username" placeholder="UserName" 
            id="id_username" class="form-control login_username">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" 
            id="id_password" class="form-control login_password">
        </div> 
        <div class="row">
            <div class="form-group col-md-12">
                 <button class="btn btn-primary btn-lg btn-block" id="btn_login" name="action" value="Login">Login</button>   
            </div><!-- end of login btn -->
            <h5 id="forgot_password"><a href="<?php echo base_url('login/forgotpassword');?>">forgot Your password ?</a></h5>
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
        //$('#error_username_or_password').hide();

        $('#id_username').focus(function(event){
            //$('#error_username_or_password').hide();
        });

        $('#id_password').focus(function(event){
            //$('#error_username_or_password').hide();
        });
        $('#id_username').keyup(function(event){
            if(event.keyCode == 32){

            }
        });
        $('#btn_login').click(function(event){
            
            var username = $('#id_username').val();
            var password = $('#id_password').val();

            if(username == ''){
                $('#id_username').addClass('error_username');
                event.preventDefault();
            }else{
                $('#id_username').removeClass('error_username');
            }

            if(password == ''){
                $('#id_password').addClass('error_username');
                event.preventDefault();
            }else{
                $('#id_password').removeClass('error_username');
            }

          
      
     // event.preventDefault();
        });//end of btn
    $('.alert_login_faield').fadeOut(5000);
    $('.alert_logout_sucess').fadeOut(5000);
    });
</script>
