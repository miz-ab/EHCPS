<div class="container">
  <div class="row">    
      
    <div class="col-md-2"></div>
    <div class="col-md-8" >
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 text-center" style="margin-bottom: 50px;">
          <img class="user_img_h" style="width:200px;border-radius:100px;" alt='User Picture Here' 
            src="<?php echo base_url('assets/users/employee/' .$user_profile['user_photo'])?>">
            <h3><?php echo $user_profile['first_name']; ?>&nbsp;&nbsp;<?php echo $user_profile['middle_name']; ?></h3>
            <a href="#" class="btn" data-toggle = "modal" data-target = "#image_modal">Change Profile Picture</a>

            <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="image_modal_label" aria-hidden = "true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h3 class="modal-title" id="image_modal_label" style="font-family: Gabrola; text-align: center;">Change profile picture here</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     </div>
                     <div class="modal-body">
                      <?php $empID = $this->session->userdata('user_id');?>
               <?php echo form_open_multipart('employee/change_profile_picture/'.$empID);?>
                        <div class="form-group add_photo">                            
                           <input type="file" class="form-control input_form_one" name="userfile" id="image">                                    
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="btn_save_image_changes" id="btn_save_image_changes" class="btn btn-primary">Save Changes</button>
                     </div>                           
                  </div>
               </div>                           
            </div>

          </form>

        </div>
        <div class="col-md-4"></div>        
      </div>
      <div class="row">        
        <div class="col-md-2">           
                          
        </div>      

        <div class="col-md-8">        

          <div class="form-group">

            
            <label>Username</label>

            <div class="form-group">
              <label class="form-control input_form_one"><?php echo $user_profile['username']; ?></label>
            </div>

            
            <label>Roll</label>
            
            <div class="form-group">
              <label class="form-control input_form_one"><?php echo $user_profile['roll']; ?></label>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>E-mail</label>
            
                <div class="form-group" style="display: flex;">
                  <label class="form-control input_form_one"><?php echo $user_profile['email']; ?></label>
                  <button class="btn btn-primary input_form_one" data-toggle = "modal" data-target = "#email_modal">Change</button>

                  <div class="modal fade" id="email_modal" tabindex="-1" role="dialog" aria-labelledby="email_modal_label" aria-hidden = "true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h3 class="modal-title" id="email_modal_label" style="font-family: Gabrola; text-align: center;">Type your e-mail here</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 </div>
                                 <div class="modal-body">
                                  <?php $empID = $this->session->userdata('user_id');?>
                           <?php echo form_open('employee/change_email/'.$empID);?>
                                    <div class="form-group">
                                       <label for="email" class="col-form-label">E-mail:</label>   
                                       <input type="email" class="form-control input_form_one" name="new_email" id="email" placeholder="example@gmail.com">                                    
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="btn_save_email_changes" id="btn_save_email_changes" class="btn btn-primary">Save Changes</button>
                                 </div>                           
                              </div>
                           </div>                           
                        </div>

                      </form>

                </div>

                <div class="form-group">                  
                  <button class="btn btn-primary btn-block btn-lg" data-toggle = "modal" data-target = "#password_modal">Change Password</button>

                  <div class="modal fade" id="password_modal" tabindex="-1" role="dialog" aria-labelledby="password_modal_label" aria-hidden = "true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h3 class="modal-title" id="password_modal_label" style="font-family: Gabrola; text-align: center;">Change your password here</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 </div>
                                 <div class="modal-body">
                           <?php echo form_open('employee/change_password/'.$empID);?>
                                    <div class="form-group">
                                       <label for="oldpass" class="col-form-label">Old Password:</label>   
                                       <input type="password" class="form-control input_form_one" name="old_pass" id="oldpass" placeholder="Enter old password">                                    
                                    </div>

                                    <div class="form-group">
                                       <label for="newpass" class="col-form-label">New Password:</label>   
                                       <input type="password" class="form-control input_form_one" name="new_pass" id="newpass" placeholder="Enter new password">                                    
                                    </div>

                                    <div class="form-group">
                                       <label for="confpass" class="col-form-label">Confrim Password:</label>   
                                       <input type="password" class="form-control input_form_one" name="conf_pass" id="confpass" placeholder="Confrim Password">                                    
                                    </div>

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="btn_save_password_changes" id="btn_save_password_changes" class="btn btn-primary">Save Changes</button>
                                 </div>                           
                              </div>
                           </div>                           
                        </div>

                      </form>

                </div>
              </div>
              
            </div>
            
                    
          </div>
                    
        </div>        

        <div class="col-md-2">                
          
        </div>
    </div>
    <div class="col-md-2"></div>

    </div>
  </div><!-- end of row 1st-->
     
</div><!-- end of container -->  

<script>
   //input validation
    $(document).ready(function(){

      $('#btn_save_email_changes').click(function(event){
          
          var email            = $('#email').val();                        


          if(email == ''){
            $('#email').addClass('error_username');
            event.preventDefault();
          }else{
            $('#email').removeClass('error_username');
          }             

      }); // end of btn click

      $('#btn_save_image_changes').click(function(event){
          
          var profile_picture   = $('#image').val();                        


          if(profile_picture == ''){
            $('#image').addClass('error_username');
            event.preventDefault();
          }else{
            $('#image').removeClass('error_username');
          }             

      }); // end of btn click

      $('#btn_save_password_changes').click(function(event){

        var oldpass           = $('#oldpass').val();
        var newpass           = $('#newpass').val();
        var confpass          = $('#confpass').val();        

        if(oldpass == ''){
            $('#oldpass').addClass('error_username');
            event.preventDefault();
          }else{
            $('#oldpass').removeClass('error_username');
          } 

          if(newpass == ''){
            $('#newpass').addClass('error_username');
            event.preventDefault();
          }else{
            $('#newpass').removeClass('error_username');
          } 

          if(confpass == ''){
            $('#confpass').addClass('error_username');
            event.preventDefault();
          }else{
            $('#confpass').removeClass('error_username');
          }

      });             

    });
</script>

<script>
 
$('#image').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
 
});
 
</script>