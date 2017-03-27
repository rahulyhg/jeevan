<?php
$data=array();

$cms_query = $this->db->query("SELECT * FROM sramcms_cms_pages WHERE is_active=1 AND is_delete!=1");
$cms_records = $cms_query->result_array();
if(!empty($cms_records))
{
	
	foreach($cms_records as $value)
	{
		$pageid[]=$value['id'];
		$pagetitle[]=$value['page_title'];
	}
}
$type_params['cms_type'] = array_combine($pageid, $pagetitle);
?>
<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label"><?php echo 'Type'.get_required();?></label>
	<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
    	<?php echo form_dropdown("params[cms_type][]", $type_params['cms_type'],set_value('cms_type'), "class=\"form-control\" multiple"); ?>	
    </div></div>
</div>