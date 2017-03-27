<?php
class Core_Block
{
	protected $CI = null;
	protected $view = null;
	protected $block_data = null;
	
	public function __construct() {
		if($this->CI === null) $this->CI = &get_instance();
		$this->CI->load->helper('adminsite');
		$this->CI->load->helper('url');
	}
	public function setView($view = "") {
		$this->view = $view;
		return $this;
	}
	public function setBlockData($data = null) {
		$this->block_data = $data;
		return $this;
	}
	public function getBlockData() {
		return $this->block_data;
	}
	public function drawData() {
		return array();
	}
	public function render() {
		$data = $this->drawData();
		return $this->CI->load->view($this->view, $data, true);
	}
	
}