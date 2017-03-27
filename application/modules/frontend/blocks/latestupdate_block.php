<?php 
class Latestupdate_Block extends Core_Block {
	protected $view = 'blocks/latestupdate';	
	public function __construct() {
		parent::__construct();
	}
	public function drawData() {
		$data = $this->getBlockData();
		
		return $data;
	}
}
