<?php 
class Wayoflife_Block extends Core_Block {
	protected $view = 'blocks/wayoflife';	
	public function __construct() {
		parent::__construct();
	}
	public function drawData() {
		$data = $this->getBlockData();
		
		return $data;
	}
}
