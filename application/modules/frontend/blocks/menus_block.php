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
		
		$db = $this->CI->Mydb->db;
		$db->select('name, link_type, page_id, url, menu_group_id, target, parent_id');
		$db->where('is_active', '1');
		$db->where('is_delete', '0');
		switch ($data["params"]->menus_views) {
			case self::TYPE_HEADER:
				$db->where('menu_group_id', $data["params"]->menu_group);
				break;
			case self::TYPE_FOOTER:
				$db->where('menu_group_id', $data["params"]->menu_group);
				break;
			case self::TYPE_LATESTMENU:
				$db->where('menu_group_id', $data["params"]->menu_group);
				break;
		}
		
		$query = $db->get("sramcms_menus");
		//echo $db->last_query();
		if($query->num_rows() > 0) {
			$data["menus_list"] = $query->result_array();
		}
		if(isset($data["params"]->menus_templates)) {
			$this->setView("blocks/" . $data["params"]->menus_templates);
		}
		
        //echo '<pre>';
		//print_r($data);
       
        return $data;
    }
	  
}
?>