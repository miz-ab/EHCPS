<div class="container">
	<div class="row">
    <?php echo form_open('heritage/logic_promote_heritage'); ?>
	<div class="jumbotron"> 
      <h3 class="registration_form_header">Promotion Form</h3>
  </div> <!-- end of jumbotron -->
		<div class="col-md-8 col-md-offset-2">

		  <div class="form-group ">
              <input type="text" class="form-control input_form_one" 
              id="heritage_id" name="heritage_id" placeholder="Heritage ID">
          </div>        

          <div class="preview">
            <div class="row">
              <div class="form-group ">
                  <input type="text" class="form-control input_form_one" id="heritage_name" disabled>
              </div>
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
              <textarea  rows="4" class="form-control input_form_one" id="text_des" name="description" placeholder="Description here..." ></textarea>
      </div>

      <div class="form-group" style="margin-top:50px;margin-bottom:50px;padding-bottom:50px;">
    
              <button type="submit" name="action" value="Finish" 
                class="btn btn-primary"  id="btn_next_form_one">Cancle </button>

                <button type="submit" name="action" value="<<" 
                class="btn btn-primary"  id="btn_prve_btn"> Done </button>
      </div>

		</div>
	</div><!-- end of row -->
</div>

<script type="text/javascript">
$('#heritage_image').filestyle({
 iconName : 'glyphicon glyphicon-file',
 buttonText : 'Select Photo',
 buttonName : 'btn-warning'
});

$(document).ready(function(){
    var preview_exist = false;

  $('#btn_prve_btn').click(function(event){

      var heritage_id     = $('#heritage_id').val();
      var heritage_name   = $('#heritage_name').val();
      var text_des        = $('#text_des').val();

    if(heritage_id == ''){
      event.preventDefault();
      $('#heritage_id').addClass('error_username');
    }else{
      $('#heritage_id').removeClass('error_username');
    }

    if(text_des == ''){
      event.preventDefault();
      $('#text_des').addClass('error_username');
    }else{
      $('#text_des').removeClass('error_username');
    }

    if(!preview_exist){
      event.preventDefault();
    }
  });
  
  $('.preview').hide();
    $('#heritage_id').keyup(function(event){
      
      var id_value      = $('#heritage_id').val();
      var heritage_name = $('#heritage_name').val();

      if(id_value != ''){
            var xhr = new XMLHttpRequest();
            xhr.open('GET','http://localhost:1235/EHCPS/heritage/get_heritage_id_value/' + id_value,true);
            xhr.onload = function(){
            if(this.status == 200){
            var result = JSON.parse(xhr.responseText);

            console.log(id_value);
            
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