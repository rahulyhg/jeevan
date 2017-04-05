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
		$this->routeplan_table = "routeplan";
		$this->feedback_table = "feedback";
		$this->photo_oftheday_table = "photo_oftheday";
		$this->cms_pages_table = "cms_pages";
		$this->newsletter_table = "sramcms_newsletter";
		$this->load->library('common');
	}
	
	/* this method used to show all dashboard all details... */
	public function index() {
	
	  $data = array();
	  
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	 
	 $data['appointments'] = $this->Mydb->custom_query("SELECT u.name, u.email, u.phone_no, u.appointment_date, u.appointment_start_time, e.trip_name FROM sramcms_event_users AS u LEFT JOIN sramcms_routeplan AS e ON e.id = u.event_id WHERE u.appointment_date = '".date('y-m-d')."' AND u.is_active = '1' AND u.is_delete = '0'");
	
	 
	 $data['event'] = $this->Mydb->get_all_records('count(id) AS event_count', $this->routeplan_table, array('is_active'=>'1', 'is_delete'=>'0'));
	 $data['feedback'] = $this->Mydb->get_all_records('count(id) AS feedback_count', $this->feedback_table, array('is_active'=>'1', 'is_delete'=>'0'));
	 $data['photo_oftheday'] = $this->Mydb->get_all_records('count(id) AS photo_oftheday_count', $this->photo_oftheday_table, array('is_active'=>'1', 'is_delete'=>'0'));
	 $data['cms_pages'] = $this->Mydb->get_all_records('count(id) AS cms_pages_count', $this->cms_pages_table, array('is_active'=>'1', 'is_delete'=>'0'));
	 
	 $newsletter = $this->Mydb->custom_query("SELECT id,status FROM $this->newsletter_table WHERE is_active='1' AND is_delete='0' " );
	 $i=0;
	 $j=0;
	 foreach($newsletter as $letter){
		 if($letter['status'] == '1'){
			 $i++;
		 }else{
			 $j++;
		 }
	 }
	 $value = array(array('value' => $i), array('value' => $j));
	 $title =array(array('title' => 'Subscribe'), array('title' => 'Unsubscribe'));
		
	foreach($value as $key => $head){
			$data['newsletter'][] = array_merge($title[$key], $value[$key]);
		}
		
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
