<?php 
class Donate_Block extends Core_Block {
	protected $view = 'blocks/donate';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
		return $data;
	}
}
