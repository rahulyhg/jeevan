<?php
class MY_Controller extends CI_Controller {
	protected $view_data = array();
	protected $blocks = array();
	protected $block_wrapper_view = "blocks";
	
	public function __construct($auth = false)
	{
		parent::__construct();
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));		
		Modules::$registry[strtolower($class)] = $this;	
		$this->load->block("core_block");	
	}
	
	function loadBlocks() {
		$module = $this->router->fetch_module();
		$class = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		$page_url= uri_string(3);		
		if($page_url !=''){
			$this->db->select();
			$this->db->where("page_slug = '$page_url'");
			$cmsquery = $this->db->get("cms_pages");
			foreach($cmsquery->result() as $cmsresult) {						
				$page = $cmsresult->id;
			}
			
		}else{
			$page = 'index';
		}
				
		$this->db->select("id, title, type, position, params");
		$this->db->where("(display = '0'", null, false);
		
		if($page == 'index' || $page == 'all'){
		$this->db->or_where("(display = '1'", null, false);
		$this->db->where("page like '%".$page."%')", null, false);
		
		$this->db->or_where("(display = '2'", null, false);
		$this->db->where("page not like '%".$page."%'))", null, false);
		}else{
		$this->db->or_where("(display = '1'", null, false);
		$this->db->where("page = '".$page."')", null, false);
		
		$this->db->or_where("(display = '2'", null, false);
		$this->db->where("page = '".$page."'))", null, false);
		}
		$this->db->where("is_active", 1);
		$this->db->where("is_delete", 0);
		$this->db->order_by("position", "ASC")->order_by("order", "ASC");
		$this->db->group_by("id");
		$query = $this->db->get("blocks");
		
		$blocks = array();
		foreach($query->result() as $result) {						
			if(!isset($blocks[$result->position])) $blocks[$result->position] = array();
			$blocks[$result->position][] = $result;			
		}
		
		$obj = array();
		if(!isset($this->view_data["blocks"])) $this->view_data["blocks"] = array();
		foreach($blocks as $position => $values) {
			$html = "";
			foreach($values as $result) {
				$data = array();
				$data["params"] = json_decode($result->params);
				$data["block_type"] = $result->type;
				$data["block_id"] = $result->id;
				$data["block_position"] = $position;
				$data["content"] = $this->renderBlock($result->type, $result->title, $data["params"]);				
				if(trim($data["content"]) != "") $html .= $this->load->view($this->block_wrapper_view, $data, true);
			}			
			$this->view_data["blocks"][$position] = $html;
		}
	}
	
	function renderBlock($type, $title = "", $params = array()) {
		$this->load->block($type . "_block");
		$block = $this->{$type . "_block"};	
		$params =(object)$params;
		$data = array("title" => $title, "params" => $params);				
		return $block->setBlockData($data)->render();
	}
}