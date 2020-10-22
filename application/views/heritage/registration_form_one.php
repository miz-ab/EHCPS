<div class="container">
  <div class="row">
  <!-- language setting and language model -->
  <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
    <?php echo form_open('heritage/logic_register_heritage_one');?>
    <div class="jumbotron">
          <div class="form-group" >
             <h3 class="registration_form_header"><?php echo lang('Heritage Registration Form');?></h3>
           </div>
      </div><!-- end of jumbotron -->
    <div class="col-md-1"></div><!-- end of first col-->

    <div class="col-md-5">
           
            <div class="form-group">
              <input type="text" class="form-control input_form_one" name="nid" placeholder="<?php echo lang('National ID');?> " id="nationalID"/>
              <div id="id_div">
                <p id="err_id_exist"><?php echo lang('ID must be Unique');?><p>
              </div>
            </div>
            <div class="form-group ">
              <select name="heritage_category" id="heritage_category" class="form-control input_form_one">
                   <option value="Select_Category"><?php echo lang('Select Category');?></option>
                    <?php foreach ($category->result() as $row): ?>
                      <option value="<?= $row->category_name?>"><?= $row->category_name?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="form-group ">
              <input type="text" class="form-control input_form_one" name="name" placeholder="<?php echo lang('Name');?> " id="heritage_name"/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input_form_one" name="localname" placeholder="<?php echo lang('Local Name');?> " id="heritage_local_name"/>
            </div>
    </div><!-- end of first col-->

    <div class="col-md-5">
        <div class="form-group" id="aboundance_div_section"> 
              <input type="text" class="form-control input_form_one" name="aboumdance" placeholder="<?php echo lang('Aboundance');?>" id="heritage_aboundance"/>
              <div id="aboundance_div">
                <p id="err_must_be_no"><?php echo lang('Aboundance must be Number');?> <p>
              </div>
            </div>
            <div class="form-group ">
              <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control input_form_one" name="dateOfAqusition" placeholder="<?php echo lang('Date Of Acquistions');?>" id="dateOfAqusition"/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input_form_one" name="catalogNo" placeholder="<?php echo lang('Catalog Number');?>" id="heritage_cno"/>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input_form_one" name="ownerShip" placeholder="<?php echo lang('Ownership');?>" id="heritage_ownership"/>
            </div>
           
              <button type="submit" name="action" value=">>" 
                class="btn btn-primary btn-lg btn-block" name="next" id="btn_next_form_one"> <?php echo lang('NEXT');?> </button>
            
    </div>

    <div class="col-md-1"></div><!-- end of first col-->
    </form>
  </div>
</div>

   <script>
    $(document).ready(function(){
      var aboundance_boolean = false;
      var heritage_id_boolean = false;
      var is_site_land = false;

      $('#aboundance_div').hide();
      $('#aboundance_div_section').show();
      $('#id_div').hide();
      //event function btn 
       $('#btn_next_form_one').click(function(event){



          //get all values of the input and set it in the session
          var NationalID      = $('#nationalID').val();
          var name            = $('#heritage_name').val();
          var localname       = $('#heritage_local_name').val();
          var catalogNo       = $('#heritage_cno').val();
          var aboumdance      = $('#heritage_aboundance').val();
          var dateOfAqusition = $('#dateOfAqusition').val();
          var ownerShip       = $('#heritage_ownership').val();
          var category        = $('#heritage_category').val();

          document.cookie = category;

         // console.log("all " + document.cookie);

          if(!heritage_id_boolean){
            event.preventDefault();
            $('#nationalID').addClass('error_username');
            $('#err_id_exist').css("color","red");
          }else{
            $('#nationalID').removeClass('error_username');
          }

          if(!aboundance_boolean){
            event.preventDefault();
             $('#heritage_aboundance').addClass('error_username');
             $('#err_must_be_no').css("color","red"); 
          }else{
            $('#heritage_aboundance').removeClass('error_username');
          }
           
          if(dateOfAqusition == ""){
            event.preventDefault();
            $('#dateOfAqusition').addClass('error_username');
          }else{
            $('#dateOfAqusition').removeClass('error_username');
          } 
           
          if(category == "Select_Category"){
            event.preventDefault();
            $('#heritage_category').addClass('error_username');
          }else{
            $('#heritage_category').removeClass('error_username');
          }        

          if (name == "") {
            event.preventDefault();
            $('#heritage_name').addClass('error_username');
          }else{
            $('#heritage_name').removeClass('error_username');
          } 

          if (localname == "") {
            event.preventDefault();
            $('#heritage_local_name').addClass('error_username');
          }else{
            $('#heritage_local_name').removeClass('error_username');
          } 

          if (catalogNo == "") {
            event.preventDefault();
            $('#heritage_cno').addClass('error_username');
          }else{
            $('#heritage_cno').removeClass('error_username');
          } 

          if ((!is_site_land) && (aboumdance == "")) {
            event.preventDefault();
            $('#heritage_aboundance').addClass('error_username');
          }else{
            aboundance_boolean = true;
          }          

          if (ownerShip == "") {
            event.preventDefault();
            $('#heritage_ownership').addClass('error_username');
          }else{
            $('#heritage_ownership').removeClass('error_username');
          } 

          
        });

        var arr_aboundace=[];

    $('#heritage_aboundance').keyup(function(event){
      var aboumdance = $('#heritage_aboundance').val();

          if((aboumdance != '' && (!is_site_land))){
            console.log('siteland');
            if(!isNaN(aboumdance) && aboumdance > 0){
              $('#err_must_be_no').css("color","green"); 
              aboundance_boolean = true;   
            }else if (!isNaN(aboumdance) && aboumdance <= 0) {
                document.getElementById("err_must_be_no").innerHTML = "Aboundance Number must be > 0";
                $('#err_must_be_no').css("color","red"); 
                aboundance_boolean = false; 
            }
            else{
              $('#err_must_be_no').css("color","red");   
              aboundance_boolean = false; 
            }
          }else{
            aboundance_boolean = true;
          }
          
    });

    $('#nationalID').keyup(function(event){
       //event.preventDefault();
       var id = $('#nationalID').val();
            
            if(id != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/heritage/check_heritage_id_exists/' + id,true);
            xhr.onload = function(){
            if(this.status == 200){
            var result = JSON.parse(xhr.responseText);

            console.log(result);
            
            if(result == 'B'){
                $('#err_id_exist').css("color","red");
                heritage_id_boolean = false;
            }else {
                $('#err_id_exist').css("color","green");
                heritage_id_boolean = true;
            }
        }
    }
      xhr.send();
      }

        
    });

    $('#nationalID').focus(function(){
      $('#id_div').show();
      $('#aboundance_div').hide();
    });

    $('#heritage_name').focus(function(){
      $('#id_div').hide();
      $('#aboundance_div').hide();
    });
    
    $('#heritage_local_name').focus(function(){
      $('#id_div').hide();
      $('#aboundance_div').hide();
    });
        
    $('#heritage_ownership').focus(function(){
      $('#id_div').hide();
      $('#aboundance_div').hide();
    });
    
    $('#heritage_category').focus(function(){
      $('#id_div').hide();
      $('#aboundance_div').hide();
    });

    $('#heritage_aboundance').focus(function(){
        $('#aboundance_div').show();
        $('#id_div').hide();
    });

    $('#heritage_cno').focus(function(){
        $('#id_div').hide();
        $('#aboundance_div').hide();
    });    

     $('#dateOfAqusition').focus(function(){
        $('#id_div').hide();
        $('#aboundance_div').hide();
    });

    $('#heritage_category').change(function(){
      var  val = $('#heritage_category').val();
      if(val == 'Site Land'){
        is_site_land = true;
        aboundance_boolean = true;
        $('#aboundance_div_section').hide();        
      }
        
      if(val == 'Architectural Heritage'){
        is_site_land = true;
        aboundance_boolean = true;
        $('#aboundance_div_section').hide();        
      }      

      if(val == 'Arcaeological Finding'){  
        is_site_land = false;
        $('#aboundance_div_section').show();
      }
      if(val == 'Artwork'){  
        is_site_land = false;
        $('#aboundance_div_section').show();
      }
    });

    });
   </script>