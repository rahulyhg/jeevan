<?php
$data=array();

$menu_query = $this->db->query("SELECT * FROM sramcms_menu_groups WHERE is_active=1 AND is_delete!=1");
$menu_records = $menu_query->result_array();
if(!empty($menu_records))
{
	$menuid[] = "";
	$menuname[] = "Select Menu Group"; 
	foreach($menu_records as $value)
	{
		$menuid[]=$value['id'];
		$menuname[]=$value['title'];
	}
}
$type_params['menu_group'] = array_combine($menuid, $menuname);
?>

<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menu Group';?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[menu_group]", $type_params['menu_group'],set_value('menu_group'), "class=\"form-control\""); ?>						 
		</div>
	</div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menus Views'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[menus_views]",$type_params['menus_views'],set_value('page'), "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menus Template'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[menus_templates]",$type_params['menus_templates'],set_value('page'), "class=\"form-control required\""); ?>						 
		</div>
	</div>
</div>

