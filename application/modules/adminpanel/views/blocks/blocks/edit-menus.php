<?php
$data = array();
$query = $this->db->query("SELECT * FROM categories WHERE is_active=1 AND is_delete!=1 AND parent_id=0");
$records1 = $query->result_array();
if (!empty($records1)) {
    foreach ($records1 as $value) {
        $id[] = $value['id'];
        $name[] = $value['name'];
    }
}
$type_params['category_views'] = array_combine($id, $name);
$menu_query = $this->db->query("SELECT * FROM menu_groups WHERE is_active=1 AND is_delete!=1");
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
    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Category'; ?></label>
    <div class="col-sm-<?php echo get_form_size(); ?>"> <div class="input_box">
            <?php echo form_dropdown("params[category_views][]", $type_params['category_views'], $records["type_params"]["category_views"], "class=\"form-control\" multiple"); ?>						 
        </div>
    </div>
</div>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menu Group';?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
	 <?php echo form_dropdown("params[menu_group]", $type_params['menu_group'],$records["type_params"]["menu_group"], "class=\"form-control\""); ?>						 
		</div>
	</div>
</div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menus Views' . get_required(); ?></label>
    <div class="col-sm-<?php echo get_form_size(); ?>"> <div class="input_box">
            <?php echo form_dropdown("params[menus_views]", $type_params['menus_views'], $records["type_params"]["menus_views"], "class=\"form-control required\""); ?>						 
        </div>
    </div>
</div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Menus Template' . get_required(); ?></label>
    <div class="col-sm-<?php echo get_form_size(); ?>"> <div class="input_box">
            <?php echo form_dropdown("params[menus_templates]", $type_params['menus_templates'], $records["type_params"]["menus_templates"], "class=\"form-control required\""); ?>
        </div>
    </div>
</div>
