<div style="padding:0 15px;">

    <div class="jumbotron">
      <div class="form-group">
        <?php if($this->session->userdata('userroll') == 'RHS'):?>
       <h3 class="registration_form_header">Report for Lost Heritage In Region</h3>
       <?php endif; ?>
       <?php if($this->session->userdata('userroll') == 'FHSA'):?>
       <h3 class="registration_form_header">Report for Lost Heritage In Country</h3>
       <?php endif; ?>
      </div>
    </div> <!-- end of jumbotron -->
    <div class="row">
    <?php if($this->session->userdata('userroll') == 'RHS'):?>    
    <?php echo form_open('report/report_lost_heritage');?>
    <?php endif; ?>
    <?php if($this->session->userdata('userroll') == 'FHSA'):?>    
    <?php echo form_open('report/report_lost_heritage_in_country');?>
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
            var val = $('#heritage_category').val();
            if(val == "Select_Category"){
                event.preventDefault();
                $('#heritage_category').addClass('error_username');
                
                
            }

        });
    });

</script>