<div class="container">
<?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
  <?php echo form_open_multipart('heritage/announce_lost_heritage');?>
  <div class="row">
    <div class="jumbotron">
      <div class="form-group">
       <h3 class="registration_form_header"><?php echo lang('Lost Heritage Form');?></h3>
      </div>
    </div> <!-- end of jumbotron -->
    </div><!-- end of row -->    

    <div class="row">      
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group ">
                  <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo lang('Lost Date');?>" class="form-control input_form_one" name="dateOflost" placeholder="Lost Date" id="lost_date"/>
            </div>
    
            <div class="form-group">
              <input type="text" class="form-control input_form_one" name="heritage_id" placeholder="<?php echo lang('Heritage ID');?>" id="heritage_id">
            </div>
            
            <div class="preview">
                <div class="form-group ">
                  <input type="text" class="form-control input_form_one" name="heritage_name" id="heritage_name" readonly>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                       <img src="" id="himage" style="width:400px; height:200px;"> 
                     </div>
                  </div> <!-- col one -->

                  <div class="col-md-6">
                      <p style="margin-left:50px;width:300px;" id="heritage_content"></p>
                  </div>
                </div>
            </div><!-- end of preview -->
            <div class="form-group ">
              <textarea  rows="4" class="form-control input_form_one" name="description" placeholder="<?php echo lang('Description here...');?>" id="desc"></textarea>
            </div>
      </div><!-- end of col 8-->      
    </div> <!-- end of middle row -->    

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 action_section">
          <div class="form-group">
              <button type="submit" name="action" value="announce" 
                class="btn btn-primary btn-lg btn-block"  id="btn_announce_lost"><?php echo lang('Announce');?>
              </button>
          </div>
          <div class="col-md-4"></div> 
        </div>

    </div> <!-- row action -->
     </form>
   </div><!-- end of container -->
  
<script>
    $(document).ready(function(){
        var preview_exist = false;
      //event function btn 
       $('#btn_announce_lost').click(function(event){
          //get all values of the input and set it in the session
          var heritage_id     = $('#heritage_id').val();
          var date              = $('#lost_date').val();
          var desc              = $('#desc').val();

          if (heritage_id == "") {
            event.preventDefault();
            $('#heritage_id').addClass('error_username');
          }else{
            $('#heritage_id').removeClass('error_username');
            }
          if (date == "Lost Date") {
            event.preventDefault();
            $('#lost_date').addClass('error_username');
          }else{
            $('#lost_date').removeClass('error_username');
            }
          if (desc == "") {
            event.preventDefault();
            $('#desc').addClass('error_username');
          }else{
            $('#desc').removeClass('error_username');
            }
          if(!preview_exist){
            event.preventDefault();
          }
        });
            $('.preview').hide();
            $('#heritage_id').keyup(function(event){
              var heritage_id      = $('#heritage_id').val();
              var heritage_name    = $('#heritage_name').val();

              console.log(heritage_id);

              if(heritage_id != ''){
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET','http://localhost:1235/EHCPS/heritage/get_lost_heritage_name_value/' + heritage_id,true);
                    xhr.onload = function(){
                    if(this.status == 200){
                    var result = JSON.parse(xhr.responseText);

                    console.log(result);

                    if(result == 'not_found'){
                        $('.preview').hide();
                    }else {

                      preview_exist = true;

                      var val_to_be_splited = result.split('`');

                      var name           = val_to_be_splited[0];
                      var Photo          = val_to_be_splited[1];
                      var text_to_show   = val_to_be_splited[2];

                      //console.log(name);
                      //console.log(Photo);
                      //console.log(text_to_show);

                      var word_limiter = text_to_show.split(" ");


                      $('.preview').show();
                       document.getElementById("heritage_name").value    = name;
                       $('#heritage_content').width(350);

                       var x = word_limiter.join('; ');

                       var y = x.replace(/;/g , '');

                       document.getElementById("heritage_content").innerHTML = y.slice(0,300) + ". . .";
                       document.getElementById("himage").src = "http://localhost:1235/EHCPS/assets/heritage/" + Photo;

                    }
                }
            }
            xhr.send();
            }

           });
        });
   </script>
