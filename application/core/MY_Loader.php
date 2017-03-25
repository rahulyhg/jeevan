<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	protected $_ci_blocks = array();

	/** Load a module model **/
	public function block($block, $object_name = NULL, $connect = FALSE) {

		($_alias = $object_name) OR $_alias = basename($block);

		if (in_array($_alias, $this->_ci_blocks, TRUE))
			return CI::$APP->$_alias;
				
			/* check module */
			list($path, $_block) = Modules::find(strtolower($block), $this->_module, 'blocks/');

			if ($path == FALSE) {
				show_error('Unable to locate the block you have specified: '.$block);
			}
				
			if ($connect !== FALSE AND ! class_exists('CI_DB', FALSE)) {
				if ($connect === TRUE) $connect = '';
				$this->database($connect, FALSE, TRUE);
			}

			Modules::load_file($_block, $path);

			$block = ucfirst($_block);
			CI::$APP->$_alias = new $block();

			$this->_ci_blocks[] = $_alias;

			return CI::$APP->$_alias;
	}
}