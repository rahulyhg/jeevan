<?php 
class Blog_Block extends Core_Block {
	protected $view = 'blocks/blog';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		$default = media_url().'blog/default-image.png';
		
		$category_path = media_url().'blog/';
		
		$data['blog'] = $this->CI->Mydb->get_all_records('id, blog_title, blog_slug, blog_shortdesc, 
		CASE 
        WHEN (blog_image IS NOT NULL) THEN CONCAT("'.$category_path.'", blog_image)
        WHEN (blog_image IS NULL) THEN "'.$default.'"
	    END AS blog_image', 'sramcms_blog', array('is_active' => '1', 'is_delete' => '0'));
		
		return $data;
	}
}
