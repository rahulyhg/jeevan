<?php 
class Chakra_Block extends Core_Block {
	protected $view = 'blocks/chakra';	
	public function __construct() {
		parent::__construct();
	}
	public function drawData() {
		$data = $this->getBlockData();
		$data['accord_slug'] = $this->CI->uri->segment(3);
		return $data;
	}
}
