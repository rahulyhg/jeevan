<?php ?>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Latest Update'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[latestupdate_view]",$type_params['latestupdate_view'],set_value('latestupdate_view'), "class=\"form-control\""); ?>						 
		</div>
	</div>
</div>