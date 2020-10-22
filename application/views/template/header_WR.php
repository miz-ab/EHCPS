<!DOCTYPE html>

<html>
    <head>
    <!--<script src="<?php echo base_url('assets/js/ckeditor.js');?>"></script> -->
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/social-buttons.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_heritage_registration_form_one.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/material-design-iconic-font.min.css')?>">  
    <script src="<?php echo base_url('assets/js/ckeditor.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-filestyle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jsfile.js');?>"></script>
    <script src="<?php echo base_url('assets/js/lodash.js');?>"></script>
    <script src="<?php echo base_url('assets/js/Chart.min.js');?>"></script>
    
    <scriptrel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css')?>"></script>
    
    
    </head>

    <body>
<!--link  -->

 


   <!-- language setting and language model -->
   <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
  
<nav class="navbar navbar-inverse nev_main">
  <div class="container-fluid content_nav_bar">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url('employee/index')?>">
        <img style="height: 95px; width:200px; border-radius:10px; margin-top : -45px; background: white;" 
          src="<?php echo base_url('assets/logo/'.'logo.png')?>"></a>
    </div>
    <ul class="nav navbar-nav nav_header_menus">
       
    </ul>
    <ul class="nav navbar-nav navbar-right" style="background:transparent;">
      <?php if(!$this->session->userdata('logged_in')):?>
         <li><a href="<?php echo base_url('login/index');?>"><?php echo lang('Login');?></a></li> 
      <?php endif;?>
       <?php if($this->session->userdata('logged_in')):?>
        <li class="dropdown">
          <a href="#"  data-toggle="dropdown" class="data-toggle">Notification <span class="badge badge-light"><?php echo $count; ?></span></a>
          <ul class="dropdown-menu" style="width: 400px;">
            <div class="notifi__title" style="padding: 22px; border-bottom: 1px solid #f2f2f2;">
                <p>You have <?php echo $count; ?> Notifications</p>
            </div>
            <?php foreach ($feedback_for_wr as $feedback): ?>

              <div class="notifi__item" style="padding: 19px 22px; padding-bottom: 14px;   border-bottom: 1px solid #f2f2f2; cursor: pointer;">

            
                <a href="<?php echo base_url('heritage/detail_notification/'.$feedback->heritage_id.'/'.$feedback->status.'/'.$feedback->roll.'/'.$feedback->receiver_id.'/'.$feedback->sender_id)?>" style="color: darkgray; text-decoration: none;"><li style="color: #555; line-height: 1.5; padding-top: 3px; font-size: 15px;"><?php echo $feedback->description; ?><br><span><em>@Date:<?php echo $feedback->date; ?></em></span></li></a>
              </div> 
            <?php endforeach; ?>
          </ul>
        </li>
        <li><img class="user_img_h" style="width:40px;border-radius:20px;" 
          src="<?php echo base_url('assets/users/employee/' . $this->session->userdata('user_photo').".".$this->session->userdata('user_photo_exc'))?>"></li>
        <li class="dropdown nav_drop_down">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?php echo $this->session->userdata('username');?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu">          

            <?php $empID = $this->session->userdata('user_id'); ?>

            <li><a href="<?php echo base_url('employee/user_profile/'.$empID)?>">Profile</a></li>          
             <li><a href="<?php echo base_url('login/logout');?>">Logout</a></li>
             <li><a id="lang" href="<?php echo base_url('login/load_language_val_setting')?>">Language</a></li>
        </ul>
      </li>

    <?php endif;?> 
      
    </ul>
  </div>
</nav>

<div class="container">

  <?php if($this->session->flashdata('email_sent')):?>
     <?php echo '<p class="alert alert-danger alert_login_faield">'.$this->session->flashdata('email_sent').'</p>'?>
    <?php endif;?>

    <!--session for register -->

  <?php if($this->session->flashdata('danger_message')):?>
      <p class="alert alert-danger"><?php echo $this->session->flashdata('danger_message');?></p>
  <?php endif;?>

  <?php if($this->session->flashdata('registered_successfully')):?>
      <p class="alert alert-success"><?php echo $this->session->flashdata('registered_successfully');?></p>
  <?php endif;?>

  <?php if($this->session->flashdata('promoted_successfully')):?>
      <p class="alert alert-success"><?php echo $this->session->flashdata('promoted_successfully');?></p>
  <?php endif;?>

</div>


