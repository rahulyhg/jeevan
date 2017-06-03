<?php 
class Allmodal_Block extends Core_Block {
	//protected $view = 'blocks/allmodal';	
	
	const TYPE_LOGIN  = 'login_modal';
	const TYPE_REGISTER = 'register_modal';
	const TYPE_FORGOT = 'forgot_modal';
	const TYPE_RESETPASSWORD = 'resetpassword_modal';
	
	
	public function __construct() {
		parent::__construct();
	}
	public function drawData() {
		$data = $this->getBlockData();
		
		
		switch ($data["params"]->modal_view) {
			case self::TYPE_LOGIN:
				$this->setView("blocks/login");
				break;
			case self::TYPE_REGISTER:
				$this->setView("blocks/register");
				break;
			case self::TYPE_FORGOT:
				$this->setView("blocks/forgot");
				break;
			case self::TYPE_RESETPASSWORD:
				$this->setView("blocks/resetpassword");
				break;
		}
		
			
		return $data;
	}
}
