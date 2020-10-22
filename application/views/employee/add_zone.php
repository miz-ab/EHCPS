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
         <?php echo form_open('employee/register_zone');?>
         <div class="row">
         <div class="col-md-2"></div>            
            <div class="col-md-6">
               <fieldset>
                  <legend>Add Zone</legend>
                  <div class="form-group">
                     <label>Zone ID:</label>
                     <input class="form-control input_form_one" type="text" name="zone_id" id="zone_id" placeholder="Enter Zone ID" >
                  </div>
                  <div class="form-group">
                     <label>Zone Name:</label>
                     <input class="form-control input_form_one" type="text" name="zone_name" id="zone_name" placeholder="Enter Zone Name" >
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
                     <button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_add_zone" id="btn_add_zone">
                        Add
                     </button>
                  </div>

               </fieldset>               
            </div> 
            <div class="col-md-4"></div>            
         </div>
         </form>         
      </div>
      
   </div>
</div>
<script>
    $(document).ready(function(){
      $('#btn_add_zone').click(function(event){
         //event.preventDefault();
         var zone_id = $('#zone_id').val();
         var zone_name = $('#zone_name').val();
         var region_option = $('#region_option').val();         

         if(zone_id == ''){
            event.preventDefault();
            $('#zone_id').addClass('error_username');
         }else{
            $('#zone_id').removeClass('error_username');
         }


         if(zone_name == ''){
            event.preventDefault();
            $('#zone_name').addClass('error_username');
         }else{
            $('#zone_name').removeClass('error_username');
         }


         if(region_option == ''){
            event.preventDefault();
            $('#region_option').addClass('error_username');
         }else{
            $('#region_option').removeClass('error_username');
         }

    });
   });
   </script>