
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Modal View'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[modal_view]",$type_params['modal_view'],$records["type_params"]["modal_view"], "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>
