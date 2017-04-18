<?php 
class Discourse_Block extends Core_Block {
	protected $view = 'blocks/discourse';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		$default = media_url().'blog/default-image.png';
		
		$category_path = media_url().'discourse/';
		
		$data['discourse'] = $this->CI->Mydb->get_all_records('id, title, slug, shortdesc, 
		CASE 
        WHEN (image IS NOT NULL) THEN CONCAT("'.$category_path.'", image)
        WHEN (image IS NULL) THEN "'.$default.'"
	    END AS image', 'sramcms_discourse', array('is_active' => '1', 'is_delete' => '0'));
		
		return $data;
	}
}
