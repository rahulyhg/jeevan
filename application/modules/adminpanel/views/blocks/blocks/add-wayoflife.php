<?php ?>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Type'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[wayoflife_view]",$type_params['wayoflife_view'],set_value('page'), "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>