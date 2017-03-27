<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Pages extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "pages";
		$this->module_label = "Pages";
		$this->module_labels = "Pages";
		$this->folder = "pages/";
		$this->cms_pages = "sramcms_cms_pages";
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
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$this->loadBlocks();
		$data = array_merge($data, $this->view_data);
		$data['cms'] = $this->Mydb->get_record('*', $this->cms_pages, array('page_slug' => $method, 'is_active' => '1', 'is_delete' => '0'));
		
		
		if(!empty($data['cms']['page_template'])){
			$page_template = $data['cms']['page_template'];
		}else{
			$page_template = 'pages';
		}
		
		$this->layout->display_frontend($this->folder . '/'.$page_template, $data);
   }
  
}
?>