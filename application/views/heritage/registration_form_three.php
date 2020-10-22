<div class="container">

  <!-- language setting and language model -->
  <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
  <div class="row">
    <div class="jumbotron">
      <div class="form-group">
       <h3 class="registration_form_header"><?php echo lang('Heritage Registration three');?></h3>
      </div>
    </div> <!-- end of jumbotron -->
      <div class="col-md-3"></div><!-- end of col -->
      <div class="col-md-6">

        
          <?php echo form_open_multipart('heritage/logic_register_heritage_three');?>
          
           
            <div class="form-group ">
                <select name="kebele_id" class="form-control input_form_one" id="k_id">
                         <option value="Select_Kebeles"><?php echo lang('Select Kebele');?></option>
                <?php foreach($kebeles as $kebele):?>
                         <option value="<?php echo $kebele['kebele_id'];?>"><?php echo $kebele['kebele_name'];?></option>                                                                                            
                    <?php endforeach;?>
                </select>
            </div> 
            <div class="form-group">
    
              <button type="submit" name="action" value="Finish" 
                class="btn btn-primary btn-lg"  id="btn_next_form_one"><?php echo lang('FINISH');?> <span class="glyphicon glyphicon-ok-sign"></span>  </button>

                <button type="submit" name="action" value="<<" 
                class="btn btn-primary btn-lg"  id="btn_prve_btn"> <span class="glyphicon glyphicon-chevron-left"><?php echo lang('BACK');?></span> </button>

        
           </form>
      </div> 


      </div><!-- end of col -->
      <div class="col-md-3"></div><!-- end of col -->
  </div><!-- end of row -->
     
   </div><!-- end of container -->

   <script>
    $(document).ready(function(){

      $('#btn_next_form_one').click(function(event){
       
        var kebele_value = $('#k_id').val();
        if(kebele_value == 'Select_Kebeles'){
          event.preventDefault();
          $('#k_id').addClass('error_username');
          
        }
      });

      /*
       $('#r_id').change(function(){
          var region_id = $('#r_id').val();
          if(region_id != ''){
            $.ajax({
              url: "<?php echo base_url();?>heritage/dependent_load_zone",
              method: "POST",
              data: {region_id:region_id},
              success: function(data){
                $('#z_id').html(data);
              }
            })
          }//end of if
       });//end of change function


       $('#z_id').change(function(){
        var zone_id = $('#z_id').val();
        if (zone_id != '') {
          $.ajax({
              url: "<?php echo base_url();?>heritage/dependent_load_woreda",
              method: "POST",
              data: {zone_id:zone_id},
              success: function(data){
                $('#w_id').html(data);
              }
            })
        }
       });//end of zone btn

       $('#w_id').change(function(){
        var woreda_id = $('#w_id').val();
        if (woreda_id != '') {
          $.ajax({
              url: "<?php echo base_url();?>heritage/dependent_load_kebele",
              method: "POST",
              data: {woreda_id:woreda_id},
              success: function(data){
                $('#k_id').html(data);
              }
            })
        }
       });//end of zone btn
       */
    });
   </script>