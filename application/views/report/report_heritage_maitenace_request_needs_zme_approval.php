<div style="padding:0 15px;">
    <div class="row">
        
    <?php echo form_open('report/report_lost_heritage');?>
        <div class="col-md-3">
        
        
        </div><!-- end of drop down -->

        <div class="col-md-3">
        <div class="form-group ">
        <select name="heritage_category" id="heritage_category" class="form-control input_form_one">
             <option value="Select_Category">Select Category</option>
             <option value="all">All</option>
             <option value="AW">Artwork</option>
             <option value="AF">Arcaeological Finding</option>
             <option value="AH">Architectural Heritage</option>
             <option value="SL">Site Land</option>
             <?php foreach($list_of_heritage_category as $category):?>
               <option value="<?php echo $category['category_abbr'];?>"><?php echo $category['category_name'];?></option>                                                                                            
            <?php endforeach;?>             
         </select>
            </div><!-- end of drop down -->
        </div><!-- end of drop down -->    

        <div class="col-md-3">
        <button type="submit" id="create" class="btn btn-success btn-lg btn-block">Create</button>
        </div><!-- end of drop down -->

        <div class="col-md-3"></div>

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