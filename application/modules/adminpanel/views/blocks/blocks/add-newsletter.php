<?php ?>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Type'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[newsletter_view]",$type_params['newsletter_view'],set_value('page'), "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Title'.get_required();?></label>
    <div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
    	<input type="text" name="params[newsletter_title]" class="form-control required">
    </div></div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Sub Title';?></label>
    <div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
    	<input type="text" name="params[newsletter_subtitle]" class="form-control">
    </div></div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Email Address';?></label>
    <div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
    	<input type="text" name="params[newsletter_email]" class="form-control">
    </div></div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Icon'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[newsletter_icon]",$type_params['newsletter_icon'],set_value('page'), "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Button Name';?></label>
    <div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
    	<input type="text" name="params[newsletter_button]" class="form-control">
    </div></div>
</div>
