<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "dashboard";
		$this->module_label = "Dashboard";
		$this->module_labels = "Dashboard";
		$this->folder = "dashboard/";
		$this->table = "users";
		$this->settings_table = "site_setting";
		
			
	}
	
	/* this method used to show all dashboard all details... */
	public function index() {
	
	  $data = array();
	  
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	 
	  $this->layout->display_admin($this->folder.$this->module ,$data);
	}
	
	public function settings() {
		$data = array();
		
		if ($this->input->post ( 'action' ) == 'settings') 		// if ajax submit
		{
			$this->db->truncate($this->settings_table);
			$settings_data = $this->input->post();
			
			if($settings_data)
			{
				foreach ($settings_data as $key => $value)
				{
					
					$insert_array = array (
							'setting_id' => 0,
							'setting_key' => $key,
							'setting_value' => $value,
							'setting_modify_date' => current_date ()
						);
					
					$insert_id = $this->Mydb->insert ( $this->settings_table, $insert_array );
					
				}
				$url = admin_url().$this->module."/settings";
				header ('Location:'.$url);
			}
			$this->session->set_flashdata ( 'admin_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
			$result ['status'] = 'success';
			
		}	
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$data['module_action'] = 'settings';
		$this->layout->display_admin($this->folder .'/settings' ,$data);
	}
}
