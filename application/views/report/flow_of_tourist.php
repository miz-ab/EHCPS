<div style="padding:0 15px;">

    <div class="jumbotron">
      <div class="form-group">   
        <?php if($this->session->userdata('userroll') == 'RTDD'):?>    
       <h3 class="registration_form_header">Report for Flow of Tourist in Region</h3>
        <?php endif; ?> 
        <?php if($this->session->userdata('userroll') == 'AC_Admin'):?>    
       <h3 class="registration_form_header">Report for Flow of Tourist</h3>
        <?php endif; ?>       
      </div>
    </div> <!-- end of jumbotron -->

    <div class="row">
    
    <?php if($this->session->userdata('userroll') == 'RTDD'):?>  
    <?php echo form_open('report/list_of_tourist_in_region_with_in_date');?>
    <?php endif; ?>
    <?php if($this->session->userdata('userroll') == 'AC_Admin'):?>  
    <?php echo form_open('report/list_of_tourist_with_in_date');?>
    <?php endif; ?>
        <div class="col-md-4">
        
        
        </div><!-- end of drop down -->

        <div class="col-md-4">        
        
        <div class="form-group ">

            <label>Start Date:</label>    

            <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="start_date" id="start_date" class="form-control input_form_one" aria-describedby="help" placeholder="Start Date">

             <small id="help" class="text-muted">Type start date here</small>

        </div><!-- end of drop down -->

        <div class="form-group ">

            <label>End Date:</label>

            <input type="text" name="end_date" onfocus="(this.type='date')" onblur="(this.type='text')" id="end_date" class="form-control input_form_one" aria-describedby="help" placeholder="End Date">        

             <small id="help" class="text-muted">Type end date here</small>

        </div><!-- end of drop down -->       

            <button type="submit" id="create" class="btn btn-success btn-lg btn-block">Create</button>

        </div><!-- end of drop down -->    

        <div class="col-md-4">
        
        </div><!-- end of drop down -->    

        </form>

    </div><!-- end of row -->
</div>

<script>
    $(document).ready(function(){

        $('#create').click(function(event){            
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();        

            if(start_date == ""){
                event.preventDefault();
                $('#start_date').addClass('error_username');    
            }else{
                $('#start_date').removeClass('error_username');
            }

            if(end_date == ""){
                event.preventDefault();
                $('#end_date').addClass('error_username');    
            }else{
                $('#end_date').removeClass('error_username');
            }

        });
    });

</script>