<?php 
class Breadcrumbs_Block extends Core_Block {
	protected $view = 'blocks/breadcrumbs';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		
		$data['breadcrumbs_urlslug'] = $this->CI->uri->segment(3);
		
		$this->setView("blocks/breadcrumbs");
		
		return $data;
	}
}
