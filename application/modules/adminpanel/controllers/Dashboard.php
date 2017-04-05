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
		$this->master_admin_table = "master_admin";
		
			
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
	
	public function changepassword(){
		$data = array();
	
		if ($this->input->post ( 'action' ) == 'changepassword') 		// if ajax submit
		{
			
			$this->form_validation->set_rules('old_password','Old Password','required|trim|callback_oldpasswordcheck');
			
			$this->form_validation->set_rules('new_password','New Password','required|trim|min_length[3]');
			$this->form_validation->set_rules('confirm_password','Password Mismatch', 'trim|required|matches[new_password]');
			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_message('min_length', '%s should be min 3 digits length');

			if ($this->form_validation->run () == TRUE) {
		
				
				$new_password =  do_bcrypt($this->input->post('new_password'));				
				$this->Mydb->update($this->master_admin_table,array('admin_id'=>get_admin_id()),array('admin_password'=>$new_password));
				 $this->session->sess_destroy();
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$result ['status'] = 'success';
				
			}else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}
				
			echo json_encode ( $result );
			exit ();
			
		}	
		$data['module_label'] = $this->module_label;
		$data['module_labels'] = $this->module_label;
		$data['module'] = $this->module;
		$data['module_action'] = 'changepassword';
		$this->layout->display_admin($this->folder .'/changepassword' ,$data);
	}
	/* Old password check ...*/
	public function oldpasswordcheck(){
		$old_password=$this->input->post('old_password');
		$admin_id = get_admin_id();
		$check_details  = $this->Mydb->get_record('admin_password',$this->master_admin_table,array('admin_id'=>$admin_id));
		if(!empty($check_details))
		{
			$password_verify = check_hash($old_password,$check_details['admin_password']);
			
			if($password_verify == "Yes"){
				return true;
			}else{
				$this->form_validation->set_message('oldpasswordcheck','Old Password Miss Match');
				return false;
			}
		}

	}
	
}
