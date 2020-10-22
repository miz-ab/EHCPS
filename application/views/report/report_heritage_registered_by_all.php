<div style="padding:0 15px;">
  <div class="jumbotron">
      <div class="form-group">
        <?php if($this->session->userdata('userroll') == 'ZR'): ?>
       <h3 class="registration_form_header">Report for Heritage Found In Zone</h3>
       <?php endif; ?>
       <?php if($this->session->userdata('userroll') == 'RR'): ?>
       <h3 class="registration_form_header">Report for Heritage Found In Region</h3>
       <?php endif; ?>
       <?php if($this->session->userdata('userroll') == 'FHRA'): ?>
       <h3 class="registration_form_header">Report for Heritage Found In Country</h3>
       <?php endif; ?>
      </div>
  </div> <!-- end of jumbotron -->
    <div class="row">
    <?php if($this->session->userdata('userroll') == 'ZR'): ?>
    <?php echo form_open('report/report_all_heritage_found_in_zone');?>
    <?php endif; ?>
    <?php if($this->session->userdata('userroll') == 'RR'): ?>
    <?php echo form_open('report/report_heritage_found_in_region');?>
    <?php endif; ?>
    <?php if($this->session->userdata('userroll') == 'FHRA'): ?>
    <?php echo form_open('report/report_heritage_all');?>
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

        <div class="form-group">
            <label>Top:</label>
            <select name="limit" id="heritage_category" class="form-control input_form_one" aria-describedby="help">
             <option value="all">All</option>
             <option value="3">3</option>
             <option value="5">5</option>
             <option value="10">10</option>
            </select>
            <small id="help" class="text-muted">Specify the limit of the report here</small>
        </div>
        
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
            }else{
              $('#heritage_category').removeClass('error_username'); 
            }

        });
    });

</script>