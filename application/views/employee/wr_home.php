<div style="padding:0 15px;">
  <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
	<div class="row main_row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header"><?php echo lang('woreda_registeral_home_page');?></h3>
           </div>
      </div><!-- end of jumbotron -->
		<div class="col-md-3 menu_wr">
			<h3></h3>
			
				
			<div class="list_of_menu">
				<ul>
					<li><a href="<?php echo base_url('heritage/woreda_registeral_registration_form_one');?>">
          <span class="glyphicon glyphicon-plus"></span> <?php echo lang('Register Heritage');?> </a></li>
          <li><a href="<?php echo base_url('heritage/list_of_heritage_registerd_by_wr');?>">
          <span class="glyphicon glyphicon-th"></span> <?php echo lang('View Heritage');?></a></li>          
          <li><a href="<?php echo base_url('heritage/send_maintenance_request_form');?>">
          <span class="glyphicon glyphicon-cog"></span>  <?php echo lang('Send Maintenance Request');?></a></li>
          <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_sent_by_wr');?>">
          <span class="glyphicon glyphicon-th"></span> <?php echo lang('View Maintenance Request');?> </a></li>
          <li><a href="<?php echo base_url('heritage/announce_lost_heritage_form');?>">
          <span class="glyphicon glyphicon-plus"></span> <?php echo lang('Announce Lost Heritage');?> </a></li>                  
					<li><a href="<?php echo base_url('heritage/list_of_lost_heritage');?>">
          <span class="glyphicon glyphicon-th"></span> <?php echo lang('View Lost Heritage');?> </a></li>
          <?php $emp_id = $this->session->userdata('user_id'); ?> 
          <li><a href="<?php echo base_url('heritage/all_notification/'.$emp_id);?>">
          <span class="glyphicon glyphicon-th"></span> <?php echo lang('View All Notification');?> </a></li>          
				</ul>
			</div>
			
		</div> <!-- menu div -->

		<div class="col-md-8 list_of_heritage">			     
			

         <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo base_url('assets/images/heritage_image/test1.jpg');?>" alt="Axum">
      <div class="carousel-caption">
        
      </div>
    </div>

    <div class="item">
      <img src="<?php echo base_url('assets/images/heritage_image/fasil0.jpg');?>" alt="Fasil">
      <div class="carousel-caption">
       
      </div>
    </div>

    <div class="item">
      <img src="<?php echo base_url('assets/images/heritage_image/lalibela0.jpg');?>" alt="Lalibela">
      <div class="carousel-caption">
        
      </div>
    </div>

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




   
		</div> <!-- menu div -->
	</div>
  
</div>

<script>

/*

      var Aboundance ; 
   var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/heritage/chart_woreda_name_with_aboundace',true);
            xhr.onload = function(){
            if(this.status == 200){
            var result = JSON.parse(xhr.responseText);

           console.log(result.woreda_id);


   var chart_one = document.getElementById("chart1").getContext('2d');

   let bar_cart = new Chart(chart_one,{
      type:'line',
   data:{
      labels:result.woreda_id,
      datasets:[{
         label:'No of Registered Heritage',
         data: result.aboundance,
         //backgroundColor:'green',
         backgroundColor:[
            'rgba(100,50,10,0.7)',
            'rgba(10,40,20,0.7)',
            'rgba(10,30,200,0.7)',
            'rgba(10,200,40,0.7)',
            ]
      }]
   },

   options:{}
   });






            
        }
    }
      xhr.send();

   
*/
</script>

<style>
  
</style>