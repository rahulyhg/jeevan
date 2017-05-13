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
		
		$data['gallery'] = $this->Mydb->custom_query("SELECT gc.name AS gallery_category,  g.title, g.description, g.gallery_category_id, g.media_type,
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
		WHERE gc.is_active='1' AND gc.is_delete='0' AND gc.slug = '".$method."'");	
		
		
		
		$data['gallery_meta'] = $this->Mydb->custom_query("SELECT gc.meta_title, gc.meta_keyword, gc.meta_description
		FROM $this->sramcms_gallary_categories_table AS gc 
		LEFT JOIN $this->sramcms_galleries_table AS g ON g.gallery_category_id = gc.id
		WHERE gc.is_active='1' AND gc.is_delete='0' AND gc.slug = '".$method."' GROUP BY gc.id");	
		
		$data['gallery_slug'] = $method;
		
		$data['meta_title']   =  get_meta_text($data['gallery_meta'][0]['meta_title']);
		$data['meta_keyword'] = get_meta_text($data['gallery_meta'][0]['meta_keyword']);
		$data['meta_content'] = get_meta_text($data['gallery_meta'][0]['meta_description']);
		
		if(!empty($data['gallery'])){
			$this->layout->display_frontend($this->folder . '/galleryviews', $data);
		}else{
			show_404();	
		}
		
   }
   
  public  function  ajaxgallery($method, $args=array()){
	  
		$gallery_path = media_url();
		$gallery_default = skin_url().'img/mediab2.png';
	   if($this->input->post('type_name') !=''){
			
			if($this->input->post('type_name') == 'media_image'){
				$media_type = ' AND g.media_type IN (1)';
			}elseif($this->input->post('type_name') == 'media_video'){
				$media_type = ' AND g.media_type IN (2,3)';
			}else{
				$media_type = ' AND g.media_type IN (1,2,3)';
			}
			
		}
		
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
		WHERE gc.is_active='1' ".$media_type." AND g.is_delete='0' AND gc.is_delete='0' AND gc.slug = '".$this->input->post('url_slug')."'");	
	   
	
	   
	   $this->load->view($this->folder . '/ajaxgallery', $data);
   }
  
}
?>