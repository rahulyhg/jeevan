<?php ?>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Slider News'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[slidernews_views]",$type_params['slidernews_views'],$records["type_params"]["slidernews_views"], "class=\"form-control\""); ?>						 
		</div>
	</div>
</div>