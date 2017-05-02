<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Discourse extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "discourse";
		$this->module_label = "discourse";
		$this->module_labels = "discourse";
		$this->folder = "discourse/";
		$this->table = "sramcms_discourse";
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
		$blog_path = media_url().'discourse/';
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$this->loadBlocks();
		$data = array_merge($data, $this->view_data);
		$data['discourse'] = $this->Mydb->custom_query("SELECT id, title, slug,description, created,
		CASE 
		WHEN (image != '') THEN CONCAT('".$blog_path."', image) 
		WHEN (image = '') THEN '".$default."'
		ELSE '".$default."' END AS image_url 		
		FROM $this->table
		WHERE is_active='1' AND is_delete='0' AND slug = '".$method."'");	
		if(!empty($data['discourse'])){
			$this->layout->display_frontend($this->folder . '/discourse-details', $data);
		}else{
			show_404();	
		}
   }
  
}
?>