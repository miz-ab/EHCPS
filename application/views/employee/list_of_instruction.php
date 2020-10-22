<div style="padding:0 15px;">
	<div class="row">
      <div class="jumbotron">
         <div class="form-group">
         <h3 class="registration_form_header">Instruction From Federal</h3>
           </div>
      </div><!-- end of jumbotron -->
		<div class="col-md-3 menu_wr">
			<h3></h3>										
			
		</div> <!-- menu div -->

		<div class="col-md-6">
        
		<?php foreach($list_of_instruction as $instruction):?>
            <div class="well well-md">
                <h3><?php echo $instruction['title'];?></h3>
                <p><?php echo $instruction['body'];?></p>
                <?php //echo $instruction['attachment'];?>
                <div class="row">
                    <div class="col-md-8"><div class="form-group">
                        <button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#preview_modal">Preview Attachement</button>
                        <div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="preview_modal_label" aria-hidden = "true">
                           <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h3 class="modal-title" id="preview_modal_label" style="font-family: Gabrola; text-align: center;">Attachement</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 </div>
                                 <div class="modal-body">                    
                                    <div>                                

                        <object data="<?php echo base_url('assets/fedral_assets/' .$instruction['attachment']);?>" height = "600px" width="880px">                            
                        </object>
                                                                                            

                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                    
                                 </div>                           
                              </div>
                           </div>                           
                        </div>                   
                        </div></div>
                    <div class="col-md-4"><i>Announced by : <?php echo $instruction['roll'];?></i><br><i>@Date : <?php echo $instruction['date'];?></i></div>
                </div>
            </div>
        <?php endforeach;?>

		</div> <!-- menu div -->
        <div class="col-md-3">
		
		</div> <!-- menu div -->
	</div>
</div>
