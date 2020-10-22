<div style="padding:0 15px;">

    <div class="jumbotron">
      <div class="form-group">        
       <h3 class="registration_form_header"><?php echo lang('Report for Approved Maintenance Request');?></h3>       
      </div>
  </div> <!-- end of jumbotron -->
    <div class="row">
        
    <?php echo form_open('report/load_all_heritage_that_maintenace_request_approved');?>
        <div class="col-md-4">
        
        
        </div><!-- end of drop down -->

        <div class="col-md-4">
        <div class="form-group ">

            <label><?php echo lang('Category');?></label>

            <select name="heritage_category" id="heritage_category" class="form-control input_form_one" aria-describedby="help">
                 <option value="Select_Category"><?php echo lang('Select Category');?></option>
                 <option value="all">All</option>
                 
                 <?php foreach ($category->result() as $row): ?>
                    <option value="<?= $row->category_name?>"><?= $row->category_name?></option>
                <?php endforeach ?>
                                            
             </select>

             <small id="help" class="text-muted"><?php echo lang('Select the category here');?></small>

        </div><!-- end of drop down -->

            <button type="submit" id="create" class="btn btn-success btn-lg btn-block"><?php echo lang('Create');?></button>

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