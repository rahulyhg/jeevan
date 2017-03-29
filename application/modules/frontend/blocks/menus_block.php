<?php
class Menus_Block extends Core_Block {
	protected $view = 'blocks/menus';
	
	const TYPE_HEADER  = 'header';
	const TYPE_FOOTER = 'footer';
	const TYPE_LATESTMENU = 'latestupdate';
	
	public function __construct() {
        parent::__construct();
        
    }
	public function drawData() {
        $data = $this->getBlockData();
		
		$data['menuurlslug'] = $this->CI->uri->segment(1);
		
		$db = $this->CI->Mydb->db;
		$db->select('mg.name, mg.link_type, mg.page_id, CASE WHEN (mg.page_id != "0") THEN CONCAT("'.frontend_url('pages/').'",cms.page_slug) ELSE mg.url END AS url, mg.menu_group_id, mg.target, mg.parent_id, cms.page_title, cms.page_slug');
		$db->join('sramcms_cms_pages cms', 'cms.id = page_id','left');
		$db->where('mg.is_active', '1');
		$db->where('mg.is_delete', '0');
		switch ($data["params"]->menus_views) {
			case self::TYPE_HEADER:
				$db->where('mg.menu_group_id', $data["params"]->menu_group);
				break;
			case self::TYPE_FOOTER:
				$db->where('mg.menu_group_id', $data["params"]->menu_group);
				break;
			case self::TYPE_LATESTMENU:
				$db->where('mg.menu_group_id', $data["params"]->menu_group);
				break;
		}
		
		$query = $db->get("sramcms_menus mg");
		//echo $db->last_query();
		if($query->num_rows() > 0) {
			$data["menus_list"] = $query->result_array();
		}
		if(isset($data["params"]->menus_templates)) {
			$this->setView("blocks/" . $data["params"]->menus_templates);
		}
        return $data;
    }
	  
}
?>