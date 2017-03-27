<?php 
class Contactforms_Block extends Core_Block {
	protected $view = 'blocks/contactforms';	
	public function __construct() {
		parent::__construct();
		
	}
	public function drawData() {
		$data = $this->getBlockData();
				
		return $data;
	}
}
