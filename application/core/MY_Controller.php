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
		$page = implode("/", array($module, $class, $method));
		
		$this->db->select("id, title, type, position, params");
		$this->db->where("(display = '0'", null, false);
		
		$this->db->or_where("(display = '1'", null, false);
		$this->db->where("page like '%".$page."%')", null, false);
		
		$this->db->or_where("(display = '2'", null, false);
		$this->db->where("page not like '%".$page."%'))", null, false);
		
		$this->db->where("is_active", 1);
		$this->db->where("is_delete", 0);
		$this->db->order_by("position", "ASC")->order_by("order", "ASC");
		$this->db->group_by("id");
		$query = $this->db->get("blocks");
		//echo $this->db->last_query();die;
		
		$blocks = array();
		foreach($query->result() as $result) {						
			if(!isset($blocks[$result->position])) $blocks[$result->position] = array();
			$blocks[$result->position][] = $result;			
		}
		
	 $obj = array();
	/*$param_array = json_encode(array('popup'=>'','css_class'=>''));
	$param_array_login = json_encode(array('popup'=>'','css_class'=>''));
	$param_array_windowlogin = json_encode(array('popup'=>'windowlogin_popup','css_class'=>''));
	
	$footer[] = (object) array('id' => 'static','title'=>'footer popup','type'=> 'newspopup','position'=> 'news_popup', 'params'=> $param_array);
	$login_block[] = (object) array('id' => 'static_login','title'=>'Login popup','type'=> 'loginpopup','position'=> 'login_popup', 'params'=> $param_array_login);
	
	$windowloginpopup[] = (object) array('id' => 'windowstatic_login','title'=>'Window Login popup','type'=> 'windowloginpopup','position'=> 'windowlogin_popup', 'params'=> $param_array_windowlogin);
	
	$blocks['newsadd_popup'] = $footer;
	$blocks['login_popup'] = $login_block;
	$blocks['windowlogin_popup'] = $windowloginpopup;*/
		
		
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
			//
			
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