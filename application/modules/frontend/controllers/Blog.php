<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Blog extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "blogtemplate";
		$this->module_label = "Blogtemplate";
		$this->module_labels = "Blogtemplate";
		$this->folder = "blogtemplate/";
		$this->sramcms_blog_table = "sramcms_blog";
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
		$default = media_url().'blog/default-image.png';
		$blog_path = media_url().'blog/';
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$this->loadBlocks();
		$data = array_merge($data, $this->view_data);
		$data['blog'] = $this->Mydb->custom_query("SELECT id, blog_title, blog_description, author, created,
		CASE 
		WHEN (blog_image != '') THEN CONCAT('".$blog_path."', blog_image) 
		WHEN (blog_image = '') THEN '".$default."'
		ELSE '".$default."' END AS image_url 
		
		FROM $this->sramcms_blog_table
		WHERE is_active='1' AND is_delete='0' AND blog_slug = '".$method."'");	
		if(!empty($data['blog'])){
			$this->layout->display_frontend($this->folder . '/blogviews', $data);
		}else{
			show_404();	
		}
   }
  
}
?>