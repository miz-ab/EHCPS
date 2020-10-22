<div style="padding:    0 15px;">
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
             <h3 class="registration_form_header">Registrar Home Page</h3>
           </div>
      </div><!-- end of jumbotron -->
      <div class="col-md-3 menu_wr">
         <h3></h3>   
         <div class="list_of_menu">
            <ul>                              
               <li><a href="<?php echo base_url('employee/add_region');?>"><span class="glyphicon glyphicon-plus">   </span>Add Region</a></li>
               <li><a href="<?php echo base_url('employee/add_zone');?>"><span class="glyphicon glyphicon-plus">   </span>Add Zone</a></li>
               <li><a href="<?php echo base_url('employee/add_woreda');?>"><span class="glyphicon glyphicon-plus">   </span>Add Woreda</a></li>
               <li><a href="<?php echo base_url('employee/add_kebele');?>"><span class="glyphicon glyphicon-plus">   </span>Add Kebele</a></li>                
            </ul>
         </div>
         
      </div> <!-- menu div -->
      <div class="col-md-9">
        <?php echo form_open('employee/register_kebele');?>
         <div class="row">
         <div class="col-md-2"></div>            
            <div class="col-md-6">
               <fieldset>
                  <legend>Add Kebele</legend>
                  <div class="form-group">
                     <label>Kebele ID:</label>
                     <input class="form-control input_form_one" type="text" name="kebele_id" id="kebele_id" placeholder="Enter Kebele ID" >
                  </div>
                  <div class="form-group">
                     <label>Kebele Name:</label>
                     <input class="form-control input_form_one" type="text" name="kebele_name" id="kebele_name" placeholder="Enter Kebele Name" >
                  </div>
                  <div class="form-group">
                     <label>Region:</label>
                     <select class="form-control input_form_one" type="text" name="region_option" id="region_option" placeholder="Enter Region" >
                        <option value="">Select Region</option>
                        <?php foreach($regions as $region):?>
                         <option value="<?php echo $region['region_id'];?>"><?php echo $region['region_name'];?></option>                                                  
                        <?php endforeach;?>
                     </select>                     
                  </div>
                  <div class="form-group">
                     <label>Zone:</label>
                     <select class="form-control input_form_one" type="text" name="zone_option" id="zone_option">
                        <option value="">Select Zone</option>                        
                     </select>                     
                  </div> 
                  <div class="form-group">
                     <label>Woreda:</label>
                     <select class="form-control input_form_one" type="text" name="woreda_option" id="woreda_option">
                        <option value="">Select Woreda</option>                        
                     </select>                     
                  </div>                                 
                  <div class="form-group">                     
                     <button class="btn btn-primary btn-lg btn-block" name="btn_add_kebele" id="btn_add_kebele">
                        Add
                     </button>
                  </div>

               </fieldset>               
            </div> 
            <div class="col-md-4"></div>            
         </div><!--End of row-->  
         </form>       
      </div>
      
   </div>
</div>

<script>
    $(document).ready(function(){
      $('#btn_add_kebele').click(function(event){
         //event.preventDefault();
         var kebele_id = $('#kebele_id').val();
         var kebele_name = $('#kebele_name').val();
         var woreda_id = $('#woreda_option').val();
         var zone_id = $('#zone_option').val();
         var region_id = $('#region_option').val();

         if(kebele_id == ''){
            event.preventDefault();
            $('#kebele_id').addClass('error_username');
         }else{
            $('#kebele_id').removeClass('error_username');
         }


         if(kebele_name == ''){
            event.preventDefault();
            $('#kebele_name').addClass('error_username');
         }else{
            $('#kebele_name').removeClass('error_username');
         }


         if(woreda_id == ''){
            event.preventDefault();
            $('#woreda_option').addClass('error_username');
         }else{
            $('#woreda_option').removeClass('error_username');
         }


         if(zone_id == ''){
            event.preventDefault();
            $('#zone_option').addClass('error_username');
         }else{
            $('#zone_option').removeClass('error_username');
         }

         if(region_id == ''){
            event.preventDefault();
            $('#region_option').addClass('error_username');
         }else{
            $('#region_option').removeClass('error_username');
         }

      }); //end of btn

      
       $('#region_option').change(function(){
          var region_id = $('#region_option').val();
          if(region_id == ''){
            $('#region_option').addClass('error_username');
         }else{
            $('#region_option').removeClass('error_username');
         }


          if(region_id != ''){
            $.ajax({
              url: "<?php echo base_url();?>employee/dependent_load_zone",
              method: "POST",
              data: {region_id:region_id},
              success: function(data){
                $('#zone_option').html(data);
              }
            })
          }//end of if
       });//end of change function


       $('#zone_option').change(function(){
        var zone_id = $('#zone_option').val();
        if(zone_id == ''){
            $('#zone_option').addClass('error_username');
         }else{
            $('#zone_option').removeClass('error_username');
         }

        if (zone_id != '') {
          $.ajax({
              url: "<?php echo base_url();?>employee/dependent_load_woreda",
              method: "POST",
              data: {zone_id:zone_id},
              success: function(data){
                $('#woreda_option').html(data);
              }
            })
        }
       });//end of zone btn      

    });
   </script>