<div class="container">
    <div class="row">
        <div class="col-md-4"></div><!-- end of col -->
            <div class="col-md-4 login_body">
            <!-- flash message login failed -->
    
            <?php /*echo validation_errors();*/?>
    <?php echo form_open('login/set_lang_setting'); ?>
        <div class="form-group">
        <div class="lang_setting">
        <h3>Set Language</h3>
        <div class="radio">
            <h4><input type="radio" <?php if($lang_setting['lang'] == '1'){echo "checked";} ?> name="lang" value='1' >Amharic 
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
             <input type="radio" name="lang" <?php if($lang_setting['lang'] == '0'){echo "checked";} ?> value='0'>English </h4>
        </div>
        </div> <!-- end of lang setting -->
        </div>
           <div class="row">
             <div class="col-md-12">
                <button class="btn btn-success btn-lg btn-block" id="btn_login" name="action" value="Login">Save</button>
             </div>
           </div>
    </form>
            </div><!-- end of col -->
        <div class="col-md-4"></div><!-- end of col -->
    </div><!-- end of row -->
</div>

<style>
    .lang_setting {
        padding-left:100px;
        margin-top:10px;
    }
</style>


