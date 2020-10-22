<div class="container">
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
  <?php echo form_open_multipart('heritage/send_maintenance_request');?>
  <div class="row">
    <div class="jumbotron">
      <div class="form-group">
       <h3 class="registration_form_header"><?php echo lang('Maintenence Request Form');?></h3>
      </div>
    </div> <!-- end of jumbotron -->
    </div><!-- end of row -->    

    <div class="row">

      <div class="col-md-1"></div><!-- end of col -->
      <div class="col-md-5"> 
            <div class="form-group ">
              <select name="heritage_id" class="form-control input_form_one" id="heritage_id">
                <option value="null"><?php echo lang('Select Heritage Name');?></option>
                <?php foreach ($heritage->result() as $row): ?>
                   <option value="<?= $row->NationalRNO?>"><?= $row->Name?></option>         
                <?php endforeach ?>
                                                 
              </select>
            </div>
          <div class="form-group ">
              <select name="severity" class="form-control input_form_one" id="severity">
                <option value="null"><?php echo lang('Select Severity');?></option>
                <option value="Low"><?php echo lang('Low');?></option> 
                <option value="Medium"><?php echo lang('Medium');?></option> 
                <option value="High"><?php echo lang('High');?></option> 
              </select>
          </div>
            
      </div><!-- end of col 5-->

      <div class="col-md-5">                      
            <div class="form-group ">
              <select name="heritage_category" class="form-control input_form_one" id="category" disabled>
                <option value="null" selected><?php echo lang('Heritage Category');?></option>                
              </select>
            </div>
            <div class="form-group add_photo" id="photo_div">      
                  <input type="file" class="form-control hide_file" name="userfile" id="heritage_photo">                
            </div>

          
      </div><!-- end of col 5-->
      <div class="col-md-1"></div><!-- end of col 1-->

    </div> <!-- end of middle row -->

    <div class="row">
      <div class="col-md-1"></div> <!-- col md 1st -->
      <div class="col-md-10">
        <div class="form-group ">
              <textarea  rows="4" class="form-control input_form_one" name="description" placeholder="<?php echo lang('Description here...');?>" id="desc" ></textarea>
      </div>
      </div> <!-- col md 2st -->
      <div class="col-md-1"></div> <!-- col md 3st -->
      
    </div> <!-- row description -->

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 action_section">
          <div class="form-group">
              <button type="submit" name="action" value="Finish" 
                class="btn btn-primary btn-lg btn-block" id="btn_send_request"><?php echo lang('Send');?> 
              </button>
          </div>
          <div class="col-md-4"></div> 
        </div>

    </div> <!-- row action -->
     </form>
   </div><!-- end of container -->



    <script>
    $(document).ready(function(){
      //event function btn 
       $('#btn_send_request').click(function(event){
          //get all values of the input and set it in the session
          var heritage_id     = $('#heritage_id').val();
          var category          = $('#category').val();
          var severity          = $('#severity').val();
          var heritage_photo    = $('#heritage_photo').val();
          var desc              = $('#desc').val();   

          if (heritage_id == "null") {
            event.preventDefault();
            $('#heritage_id').addClass('error_username');
          }else{
            $('#heritage_id').removeClass('error_username');
            }
          if (category == "null") {
            event.preventDefault();
            $('#category').addClass('error_username');
          }else{
            $('#category').removeClass('error_username');
            }
          if (severity == "null") {
            event.preventDefault();
            $('#severity').addClass('error_username');
          }else{
            $('#severity').removeClass('error_username');
            }
          if (heritage_photo == "") {
            event.preventDefault();
            $('#photo_div').addClass('error_username');
          }else{
            $('#photo_div').removeClass('error_username');
            }
          if (desc == "") {
            event.preventDefault();
            $('#desc').addClass('error_username');
          }else{
            $('#desc').removeClass('error_username');
            }
       });
    });
   </script>
<script>
 
$('#heritage_photo').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
 
});
 
</script>

<script>
    $(document).ready(function(){
       $('#heritage_id').change(function(){
          var heritage_id = $('#heritage_id').val();
          if(heritage_id != ''){
            $.ajax({
              url: "<?php echo base_url();?>heritage/dependent_heritage_category",
              method: "POST",
              data: {heritage_id:heritage_id},
              success: function(data){
                $('#category').html(data);
               // document.getElementById('#category').value = data;
              }
            })
          }//end of if
       });//end of change function
       });
</script>
<!--<script>
 $('select option:not(:selected)').each(function(){ $(this).attr('disabled', 'disabled'); }); 
</script>-->