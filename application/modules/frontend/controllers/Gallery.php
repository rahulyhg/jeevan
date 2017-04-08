<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Gallery extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "gallerytemplate";
		$this->module_label = "Gallerytemplate";
		$this->module_labels = "Gallerytemplate";
		$this->folder = "gallerytemplate/";
		$this->sramcms_gallary_categories_table = "sramcms_gallary_categories";
		$this->sramcms_galleries_table = "sramcms_galleries";
	}
	
	function _remap($method,$args)
    {
          if (method_exists($this, $method))
          {
              $this->$method($args);
          }
          else
          {
			$this->index($method,$args);
          }
    }
 
  	public  function index($method, $args=array())
   {
	   	$data = array();  	
		$gallery_path = media_url();
		$gallery_default = skin_url().'img/mediab2.png';
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$this->loadBlocks();
		$data = array_merge($data, $this->view_data);
		$data['gallery'] = $this->Mydb->custom_query("SELECT gc.name AS gallery_category, g.title, g.description, g.gallery_category_id, g.media_type,
		g.file_name, 
		CASE 
		WHEN (g.media_type = '1' AND g.video_thumb = '') THEN CONCAT('".$gallery_path."', g.file_name) 
		WHEN (g.media_type = '1' AND g.video_thumb != '') THEN CONCAT('".$gallery_path."', g.file_name) 
		
		WHEN (g.media_type = '2' AND g.video_thumb = '') THEN '".$gallery_default."' 
		WHEN (g.media_type = '2' AND g.video_thumb != '') THEN CONCAT('".$gallery_path."', g.video_thumb) 
		
		WHEN (g.media_type = '3' AND g.video_thumb = '') THEN '".$gallery_default."'
		WHEN (g.media_type = '3' AND g.video_thumb != '') THEN CONCAT('".$gallery_path."', g.video_thumb) 
		
		ELSE '".$gallery_default."' END AS image_url 
		
		FROM $this->sramcms_gallary_categories_table AS gc 
		LEFT JOIN $this->sramcms_galleries_table AS g ON g.gallery_category_id = gc.id
		WHERE g.is_active='1' AND g.is_delete='0' AND gc.slug = '".$method."'");	
		
		
			
		
		$this->layout->display_frontend($this->folder . '/galleryviews', $data);
   }
  
}
?>