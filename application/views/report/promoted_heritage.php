<div style="padding:0 15px;">

    <div class="jumbotron">
      <div class="form-group">
        <?php if($this->session->userdata('userroll') == 'RTDD'):?>
       <h3 class="registration_form_header">Report for Promoted Heritage In Region</h3>
       <?php endif; ?>
       <?php if($this->session->userdata('userroll') == 'FTDD'):?>
       <h3 class="registration_form_header">Report for Promoted Heritage In Country</h3>
       <?php endif; ?>
      </div>
    </div> <!-- end of jumbotron -->

    <div class="row">
    
    <?php if($this->session->userdata('userroll') == 'RTDD'):?>
    <?php echo form_open('report/load_all_promoted_heritage');?>
    <?php endif; ?>
    <?php if($this->session->userdata('userroll') == 'FTDD'):?>
    <?php echo form_open('report/load_all_promoted_heritage_in_country');?>
    <?php endif; ?>
        <div class="col-md-4">
        
        
        </div><!-- end of drop down -->

        <div class="col-md-4">
        <div class="form-group ">

            <label>Category:</label>

            <select name="heritage_category" id="heritage_category" class="form-control input_form_one" aria-describedby="help">
                 <option value="Select_Category">Select Category</option>
                 <option value="all">All</option>
                 
                 <?php foreach ($category->result() as $row): ?>
                    <option value="<?= $row->category_name?>"><?= $row->category_name?></option>
                <?php endforeach ?>
                                            
             </select>

             <small id="help" class="text-muted">Select the category here</small>

        </div><!-- end of drop down -->
        
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
            var heritage_category = $('#heritage_category').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            if(heritage_category == "Select_Category"){
                event.preventDefault();
                $('#heritage_category').addClass('error_username');    
            }else{
                $('#heritage_category').removeClass('error_username');
            }

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