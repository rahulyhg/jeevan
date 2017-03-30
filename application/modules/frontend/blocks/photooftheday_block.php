<?php 
class Photooftheday_Block extends Core_Block {
	protected $view = 'blocks/photooftheday';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		$category_path = media_url();
		
		$data['record_photo'] = $this->CI->Mydb->custom_query("SELECT id, title, description, date AS today, image FROM sramcms_photo_oftheday WHERE is_active='1' AND is_delete='0' ORDER BY id DESC LIMIT 1 ");
		
		return $data;
	}
}
