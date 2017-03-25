<?php
	if(isset($params->css_id) && $params->css_id == "") $params->css_id = "block_" . $block_position . "_" . $block_id;
	if(!isset($params->css_class)) $params->css_class = '';
?>
<div class="block block-<?php echo $block_type; ?> <?php echo $params->css_class; ?>" 
	<?php if(isset($params->css_id)) { ?>id="<?php echo $params->css_id; ?>"<?php } ?>>
		<?php echo $content; ?>
</div>