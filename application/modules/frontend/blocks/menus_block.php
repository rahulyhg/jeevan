<?php

class Menus_Block extends Core_Block {

    protected $view = 'blocks/menus';
    private $current_user_id;

      const TYPE_HEADER  = 'top_header';
      const TYPE_FOOTER = 'bottom_header';
      const TYPE_LEFTMENU = 'bottom_header';
      
      

    public function __construct() {
        parent::__construct();
        $this->current_user_id = get_session_value('current_user_id');
        $this->menus_table = "menus" ;
    }

    public function drawData() {
        $data = $this->getBlockData();
        if(isset($data['params']->category_views) && !empty($data['params']->category_views)){
        	foreach (($data['params']->category_views) as $category_id) {
        		$record[] = $this->CI->Mydb->get_record('id,name,slug', 'categories', array('id' => $category_id, 'is_active' => '1', 'is_delete' => '0'));
        		$sub[] = $this->CI->Mydb->get_all_records('id,name,parent_id,slug', 'categories', array('parent_id' => $category_id, 'is_active' => '1', 'is_delete' => '0'));
        	}
        	
        	/*$cat = implode(',', $data['params']->category_views);
        	if(!empty($cat)){
        		$query = $this->CI->Mydb->custom_query("SELECT substring_index(group_concat(t1.tags SEPARATOR '**'), ',', 50) as news_tags,t3.name as cat_name,t3.slug as cat_slug,t2.category_id FROM `news` as t1
        				LEFT JOIN news_categories as t2 ON t2.news_id=t1.id
        				LEFT JOIN categories as t3 ON t3.id=t2.category_id
        				WHERE t1.is_active=1 and t1.tags<>'' and t3.parent_id=0 and t2.category_id in($cat) group by t2.category_id ORDER BY t3.id,t1.id ASC");
        			
        		$data['newstags'] = $query;
        	}*/
        	
        	$data['category_name'] = $record;
        	
        	$data['sub_name'] = $sub;
        	 
        }
		
        if (isset($data["params"]->menus_templates)) {

            $this->setView("blocks/" . $data["params"]->menus_templates);
        }
		if (isset($data["params"]->menu_group)  && ($data["params"]->menus_views =="header")) {
			$group_menus = $this->CI->Mydb->custom_query("SELECT id, name, parent_id AS parent, link_type, is_parent,created_on, is_active, url, page_id, menu_class FROM $this->menus_table WHERE is_active=1 AND is_delete !=1 AND menu_group_id =".$data["params"]->menu_group);
			$data['header_menu'] = $group_menus;
			
        }
        
        if (isset($data["params"]->menu_group) && ($data["params"]->menus_views =="header-additional-menus")) {
        	$group_menus = $this->CI->Mydb->custom_query("SELECT id, name, parent_id AS parent, link_type, is_parent,created_on, is_active, url, page_id, menu_class FROM $this->menus_table WHERE is_active=1 AND is_delete !=1 AND menu_group_id =".$data["params"]->menu_group);
        	$data['header_additional_menus'] = $group_menus;
        }
        if (isset($data["params"]->menu_group) && ($data["params"]->menus_views =="footer-right-menus")) {
        	$group_menus = $this->CI->Mydb->custom_query("SELECT id, name, parent_id AS parent, link_type, is_parent,created_on, is_active, url, page_id, menu_class FROM $this->menus_table WHERE is_active=1 AND is_delete !=1 AND menu_group_id =".$data["params"]->menu_group);
        	$data['footer_right_menus'] = $group_menus;
        }
       
        return $data;
    }

}
