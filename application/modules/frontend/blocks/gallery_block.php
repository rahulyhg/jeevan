<?php 
class Gallery_Block extends Core_Block {
	protected $view = 'blocks/gallery';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		$category_path = media_url();
		
		$data['gallery'] = $this->CI->Mydb->get_all_records('id, name, description, slug, CONCAT("'.$category_path.'", category_image) AS category_image', 'sramcms_gallary_categories', array('is_active' => '1', 'is_delete' => '0'));
		
		return $data;
	}
}
