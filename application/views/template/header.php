<!DOCTYPE html>

<html>
    <head>
    <!--<script src="<?php echo base_url('assets/js/ckeditor.js');?>"></script> -->
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/social-buttons.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_css.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/material-design-iconic-font.min.css')?>">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <script src="<?php echo base_url('assets/js/ckeditor.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/validation.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jsfile.js');?>"></script>
    <script src="<?php echo base_url('assets/js/lodash.js');?>"></script>
    
    </head>

    <body>
<!--link  -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid" style="background-color:black; font-size: large;">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">EHCPS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Language<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">English</a></li>
          <li><a href="#">Amharic</a></li>
          <li><a href="#">Oromigna</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>





<div class="container">
<!-- image sliders -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?php echo base_url('assets/images/heritage_image/axum3.jpg');?>" alt="Axum">
      <div class="carousel-caption">
        <h3>Axum-Stelae,</h3>
        <p>Best Place in Ethiopia</p>
      </div>
    </div>

    <div class="item">
      <img src="<?php echo base_url('assets/images/heritage_image/lalibela0.jpg');?>" alt="Lalibela">
      <div class="carousel-caption">
        <h3>Lalibela</h3>
        <p>North Wollo</p>
      </div>
    </div>

    <div class="item">
      <img src="<?php echo base_url('assets/images/heritage_image/fasil0.jpg');?>" alt="Fasil">
      <div class="carousel-caption">
        <h3>Fasil Gnib</h3>
        <p>We love it</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>


<script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

    