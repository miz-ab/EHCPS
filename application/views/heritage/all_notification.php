<div style="padding:0 15px;">
  <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
   <div class="row">
      <div class="jumbotron">
         <div class="form-group">
         <h3 class="registration_form_header"><?php echo lang('All Notification');?> </h3>
           </div>
      </div><!-- end of jumbotron -->
      <div class="col-md-3 menu_wr">
         <h3></h3>                              
         
      </div> <!-- menu div -->

      <div class="col-md-6">
      <?php if ($all_notification == null):?>
         <div class="well well-md text-center">
            <h3> <?php echo lang('no_notification');?> </h3>
         </div>         
      <?php endif; ?>
      <?php if ($all_notification != null):?>
      <?php foreach($all_notification as $all_notif):?>
            <div class="well well-md">
                <div class="row">
                   <div class="col-md-5"><?php echo $all_notif['description']; ?></div>
                   <div class="col-md-3"></div>
                   <div class="col-md-4">@Date: <?php echo $all_notif['date']; ?></div>
                   
                </div>
            </div>
        <?php endforeach;?>
     <?php endif; ?>

      </div> <!-- menu div -->
        <div class="col-md-3">
      
      </div> <!-- menu div -->
   </div>
</div>
