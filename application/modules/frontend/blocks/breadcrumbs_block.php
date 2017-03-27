<?php 
class Breadcrumbs_Block extends Core_Block {
	protected $view = 'blocks/breadcrumbs';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		
		$urlslug = $this->CI->uri->segment(3);
		$slug = $this->CI->Mydb->custom_query("SELECT  id, page_title, page_slug FROM sramcms_cms_pages WHERE id  IN (".implode(',' , $data["params"]->cms_type).")");
		foreach($slug as $pagebreadcrums){
			if($pagebreadcrums['page_slug']==$urlslug){
				$data['page_breadcrums'] = $pagebreadcrums['page_title'];
			}
		}
		
	
		$this->setView("blocks/breadcrumbs");
		
		return $data;
	}
}
