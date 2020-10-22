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
         <?php echo form_open('employee/register_region');?>
         <div class="row">
         <div class="col-md-2"></div>            
            <div class="col-md-6">
               <fieldset>
                  <legend>Add Region</legend>
                  <div class="form-group">
                     <label>Region ID:</label>
                     <input class="form-control input_form_one" type="text" name="region_id" id="region_id" placeholder="Enter Region ID" >
                  </div>
                  <div class="form-group">
                     <label>Region Name:</label>
                     <input class="form-control input_form_one" type="text" name="region_name" id="region_name" placeholder="Enter Region Name" >
                  </div>
                  <div class="form-group">                     
                     <button type="submit" class="btn btn-primary btn-lg btn-block" name="btn_add_region" id="btn_add_region">
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
      $('#btn_add_region').click(function(event){
         
         var region_id = $('#region_id').val();
         var region_name = $('#region_name').val();         

         if(region_id == ''){
            event.preventDefault();
            $('#region_id').addClass('error_username');
         }else{
            $('#region_id').removeClass('error_username');
         }

         if(region_name == ''){
            event.preventDefault();
            $('#region_name').addClass('error_username');
         }else{
            $('#region_name').removeClass('error_username');
         }   

      }); //end of btn         
    });
</script>