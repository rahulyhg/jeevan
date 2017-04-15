<?php 
class Gallery_Block extends Core_Block {
	protected $view = 'blocks/gallery';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		$category_path = media_url();
		$default_image = media_url().'default-image.png';
		$data['gallery'] = $this->CI->Mydb->custom_query("SELECT sgc.id, sgc.name, sgc.description, sgc.slug, 
		(CASE 
		WHEN (sgc.category_image = '' AND sg.media_type='1') THEN CONCAT('".$category_path."', sg.file_name)
		WHEN (sgc.category_image ='' AND sg.media_type='') THEN '".$default_image."'
		WHEN (sgc.category_image ='' AND sg.media_type!='1') THEN '".$default_image."'
		WHEN (sgc.category_image !='') THEN CONCAT('".$category_path."', sgc.category_image)
		ELSE 1   END) AS category_image, sgc.is_order		
		FROM  sramcms_gallary_categories AS sgc
		LEFT JOIN sramcms_galleries AS sg ON sg.gallery_category_id = sgc.id
		WHERE sgc.is_active = '1' AND sgc.is_delete = '0' GROUP BY sgc.id ORDER BY sgc.is_order ASC ");
		
		return $data;
	}
}
