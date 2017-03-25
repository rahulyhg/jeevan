<?php ?>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page_description').get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
	 	 <?php echo get_editor(array('field_name' => 'params[text_content]', 'field_value' => $records["type_params"]["text_content"])); ?>
	</div></div>
			
</div>	