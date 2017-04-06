<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Eventusers extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "eventusers";
		$this->module_label = "Appointment Users";
		$this->module_labels = "Appointment Users";
		$this->folder = "eventusers/";
		$this->table = "sramcms_event_users";
		$this->event_table = "sramcms_routeplan";
		$this->primary_key = 'id';
		$this->load->helper('emailtemplate');
		$this->load->library('common');
		
			
	}
	function _remap($method, $args) {
		
		if (method_exists($this, $method)) {
			
				if($method == "ajax_pagination"){
					$page = isset($args[0]) ? $args[0] :'';
					$this->$method($page);
				}else{
					$this->$method($args);
				}	
			
		} else {			
				$this->index($method, $args);
			
		}
	}
	/* this method used to show all dashboard all details... */
	public function index($method, $args = array()) {
		
	  $data = array();
	  
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	  if (!empty($method) && empty($args[0])) {
	  	$event_id = decode_value($method);
	  	$this->session->set_userdata ( $this->module . "_event_id", $event_id );
	  }
	
	  $this->layout->display_admin($this->folder.$this->module."-list" ,$data);
	}
	
	public function add() {
			
		$data = $this->load_module_info();
		if ($this->input->post( 'action' ) == "Add") {
			check_ajax_request ();	
			$this->form_validation->set_rules ( 'name', 'lang:name', 'trim|required' );
			$this->form_validation->set_rules ( 'email', 'lang:email', 'trim|required' );
			$this->form_validation->set_rules ( 'phone_no', 'lang:phone_no', 'trim|required' ); 
			$this->form_validation->set_rules ( 'purpose_of_appointment[]', 'lang:purpose_of_appointment', 'trim|required' );
			$this->form_validation->set_rules ( 'booked_date', 'lang:booked_date', 'trim|required' );
			if(($this->input->post('appointment_date') != "" && $this->input->post('appointment_date') != "0000-00-00") && (!empty($this->input->post('appointment_start_time')) && $this->input->post('appointment_start_time') != "00:00" ) && (!empty($this->input->post('appointment_end_time')) &&  $this->input->post('appointment_end_time') != "00:00" )){
				
				$this->form_validation->set_rules ( 'appointment_end_time', 'lang:appointment_end_time', 'trim|callback_check_available_time' );
			}
			
			if ($this->form_validation->run () == TRUE) {				
				
				$event_id = get_session_value ( $this->module . '_event_id' );		
				
				$check_exist = $this->Mydb->get_record('*', $this->table, array('event_id' => $event_id, 'email' => $this->input->post('email'),'booked_date' => $this->input->post('booked_date')));
				
				if(empty($check_exist)){
					$purpose_of_appoint = json_encode($this->input->post('purpose_of_appointment'));				
					$appointment_start_time =  date('H:i', strtotime($this->input->post('appointment_start_time')));
					$appointment_end_time =  date('H:i', strtotime($this->input->post('appointment_end_time')));
					$insert_data = array(
							"name" => $this->input->post('name'),
							"email" => $this->input->post('email'),
							"phone_no" => $this->input->post('phone_no'),
							"event_id" => $event_id,
							"booked_date" => $this->input->post('booked_date'),
							"purpose_of_appointment" => $purpose_of_appoint ? $purpose_of_appoint :'',
							"appointment_start_time" => $appointment_start_time? $appointment_start_time :'',
							"appointment_end_time" => $appointment_end_time? $appointment_end_time :'',
							"message" => $this->input->post('message'),
							"created_on" => current_date(),
							"created_ip" => get_ip(),
							"created_by" => get_admin_id(),
							"is_active" => '1',
					);
					$this->Mydb->insert($this->table ,$insert_data);		
					
					if($this->input->post('appointment_date') != "" && $this->input->post('appointment_start_time') !="" && $this->input->post('appointment_end_time') !=""){
						$appointment_date = $this->input->post('appointment_date').' '.date('h:i a', strtotime($this->input->post('appointment_time')));
						$event_page_link = frontend_url().'events';
						
						$this->send_appointment_confirmation_email($this->input->post('email'), $this->input->post('name'), $appointment_date, $event_page_link);
					}
					$msg = "A New ".$this->module_label.'has been added';
					create_log('new',$this->module_label,$msg);
					$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
					$result ['status'] = 'success';
					
				}else{
					
					$result ['status'] = 'error';
					$result ['message'] = "The Appointment Already Booked using same email";
				}
			}
			else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}	
			echo json_encode ( $result );
			exit ();
		}			
		
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add' ;
		$data ['event_data'] = $this->Mydb->get_record ( '*', $this->event_table, array (
				$this->primary_key => get_session_value ( $this->module . '_event_id' )
		) );
		$this->layout->display_admin ( $this->folder . $this->module . "-add", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$where = " WHERE is_delete != '1' ";
		$like = "";
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status",post_value ( 'status' ));
		}
		if (get_session_value ( $this->module . "_event_id" ) != "") {
			$where .= 'AND event_id = "'.get_session_value ( $this->module . '_event_id' ).'"';
		}
		
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where .= 'AND is_active = "'.get_session_value ( $this->module . '_search_status' ).'"';	
		}
		
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like .= ' AND '.get_session_value ( $this->module . "_search_field" ).' LIKE "%'.get_session_value ( $this->module . '_search_value' ) .'%"';
		}
		$filter = $where.$like;
		$get_rows = $this->Mydb->custom_query("SELECT * FROM $this->table $where $like ORDER BY id" );
		
		/**
		 * * pagination part start **
		 */
		 
		$total_rows = count($get_rows);
		$admin_records = 100;
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $total_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $total_rows;
		/**
		 * * pagination part end **
		 */
		
		$data ['records'] = $this->Mydb->custom_query("SELECT * FROM $this->table $where $like ORDER BY id LIMIT $offset, $limit" );
		
			
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'sd' => post_value ( 'status' ),
				'offset' => $offset,
				'active_page' => $active_page,
				'html' => $html 
		) );
		exit ();
	}
	
	/* this method used to update record info.. */	
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id[0] ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
	
		(empty ( $record )) ? redirect ( admin_url() . $this->module ) : '';
	
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request ();
			
			$this->form_validation->set_rules ( 'name', 'lang:name', 'trim|required' );
			$this->form_validation->set_rules ( 'email', 'lang:email', 'trim|required' );
			$this->form_validation->set_rules ( 'phone_no', 'lang:phone_no', 'trim|required' );
			$this->form_validation->set_rules ( 'purpose_of_appointment[]', 'lang:purpose_of_appointment', 'trim|required' );
			$this->form_validation->set_rules ( 'booked_date', 'lang:booked_date', 'trim|required' );
			if(($this->input->post('appointment_date') != "" && $this->input->post('appointment_date') != "0000-00-00") && (!empty($this->input->post('appointment_start_time')) && $this->input->post('appointment_start_time') != "00:00" ) && (!empty($this->input->post('appointment_end_time')) &&  $this->input->post('appointment_end_time') != "00:00" )){
				
				$this->form_validation->set_rules ( 'appointment_end_time', 'lang:appointment_end_time', 'trim|callback_check_available_time' );
			}
			
			if ($this->form_validation->run () == TRUE) {
				
				$event_id = get_session_value ( $this->module . '_event_id' );
				
				$check_exist = $this->Mydb->get_record('*', $this->table, array('id !=' => $id,'event_id' => $event_id, 'email' => $this->input->post('email'),'booked_date' => $this->input->post('booked_date')));
				
				if(empty($check_exist)){
					$purpose_of_appoint = json_encode($this->input->post('purpose_of_appointment'));
					$appointment_start_time =  date('H:i', strtotime($this->input->post('appointment_start_time')));
					$appointment_end_time =  date('H:i', strtotime($this->input->post('appointment_end_time')));
					$update_data = array(
							"name" => $this->input->post('name'),
							"email" => $this->input->post('email'),
							"phone_no" => $this->input->post('phone_no'),
							"event_id" => $event_id,
							"booked_date" => $this->input->post('booked_date'),
							"appointment_date" => $this->input->post('appointment_date')? $this->input->post('appointment_date') :'',
							"appointment_start_time" => $appointment_start_time? $appointment_start_time :'',
							"appointment_end_time" => $appointment_end_time? $appointment_end_time :'',
							"purpose_of_appointment" => $purpose_of_appoint ? $purpose_of_appoint :'',
							"message" => $this->input->post('message'),
							"updated_on" => current_date(),
							"updated_ip" => get_ip(),
							"updated_by" => get_admin_id(),
							"is_active" => $this->input->post('is_active'),
					);
					$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['id'] ), $update_data );
					if($this->input->post('appointment_date') != "" && $this->input->post('appointment_start_time') !="" && $this->input->post('appointment_end_time') !=""){
						$appointment_date = $this->input->post('appointment_date').' '.date('h:i a', strtotime($this->input->post('appointment_time')));
						$event_page_link = frontend_url().'events';
						
						$this->send_appointment_confirmation_email($this->input->post('email'), $this->input->post('name'), $appointment_date, $event_page_link);
					}
					$msg = "A ".$this->module_label.' '.post_value('name').' has been edited';
					create_log('edit',$this->module_label,$msg);
					$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
					$response ['status'] = 'success';
					
				}else{
					
					$response['status'] = 'error';
					$response['message'] = "The Appointment Already Booked using same email";
				}				
				
				
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
				
			echo json_encode ( $response );
			exit ();
		}
		$data ['records'] = $record;
		/* Common labels */		
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data['edit_id'] = $edit_id;
		$data ['event_data'] = $this->Mydb->get_record ( '*', $this->event_table, array (
				$this->primary_key => get_session_value ( $this->module . '_event_id' )
		) );
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
	
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		
		if(is_array($ids)) {
			$implode_ids = '('.implode(",",$ids).')';
			$concat_name = $this->db->query("select GROUP_CONCAT(name) as name from $this->table where id in $implode_ids")->row_array();
			$action_name = $concat_name['name'];
		}
		else {
			$records = $this->Mydb->get_record('name',$this->table,array('id'=>$ids));
			$action_name = $records['name'];
		}
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			
			// $this->Mydb->delete_where_in($this->table,'client_id',$ids,'');
			$update_values = array (
					"is_delete" => '1',
					"updated_on" => current_date (),
					'updated_by' => get_admin_id ()
			);
			
			if (is_array ( $ids )) {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
					
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				
				// $this->Mydb->delete($this->table,'client_id',$ids,'');
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been deleted ';
			create_log('delete',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '1',
					"updated_on" => current_date (),
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been Activated ';
			create_log('status',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '0',
					"updated_on" => current_date (),
					'updated_by' => get_admin_id ()
			);
			
			if (is_array ( $ids )) {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been Deactivated ';
			create_log('status',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_category" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		redirect ( admin_url () . $this->module );
	}
	
	public function get_appointment_time(){
		$appointment_date= $this->input->post('appointment_date');
		if($appointment_date){
			
			$records = $this->Mydb->custom_query("SELECT t1.name AS user_name, t1.email, t2.trip_name, TIME_FORMAT(t1.appointment_start_time , '%H:%i') AS start_time , TIME_FORMAT(t1.appointment_end_time , '%H:%i') AS end_time
												  FROM $this->table AS t1 LEFT JOIN $this->event_table AS t2 	ON t2.id = t1.event_id
		   								        WHERE t1.appointment_date = '".$appointment_date."' AND t1.appointment_start_time != t1.appointment_end_time  AND t1.is_delete != '1'");
			
			$array_disableHours = array();
			$html_data = "";
			if(!empty($records)){
				$html_data .= "<table class=''><tr>";
				foreach ($records as $splitTimes){
					$startTimeData =  strtotime($splitTimes['start_time']);
					$endTimeData =  strtotime($splitTimes['end_time']);
					$startTimeHours = date('H',$startTimeData);
					$startTimeMinutes =  date('i',$startTimeData);
					$endTimeHours = date('H',$endTimeData);
					$endTimeMinutes =  date('i',$endTimeData);
					$startTimeArray['start'] = array("hour" => $startTimeHours, "minutes" => $startTimeMinutes );
					$startTimeArray['end'] = array("hour" => $endTimeHours, "minutes" => $endTimeMinutes);
					//$endTimeArray =   "[moment({ hour:$endTimeHours, minute:$endTimeMinutes })]";
					//$arrayMomentSet = $startTimeArray .','.$endTimeArray;
					$array_disableHours['status'] = "success";
					$html_data .= '<td><a class="get_booking_time btn btn-primary" title="'.$splitTimes['user_name'].'" href="">'.date('h:i a',$startTimeData).' - '.date('h:i a',$endTimeData).'</a></td>'; 
					$array_disableHours['disabled_time_intervals'][] = $startTimeArray;
				}
				$html_data .= "</tr></table>";
				$array_disableHours['userdata'] = $html_data;
			}			
			
			echo json_encode($array_disableHours);
			
		}
		
	}
	public function check_available_time(){
		$edit_id = $this->input->post('edit_id');
		$appointment_date = $this->input->post('appointment_date');
		$start_time = $this->input->post('appointment_start_time');
		$end_time = $this->input->post('appointment_end_time');
		
		if(!empty($appointment_date) && !empty($start_time) && !empty($end_time)){
			
			if($edit_id != ""){
				$where_edit_id = " AND t1.id != '$edit_id'";
			}
			$records = $this->Mydb->custom_query(" SELECT * FROM $this->table AS t1 WHERE "
												 . " ( '$start_time' BETWEEN t1.appointment_start_time AND t1.appointment_end_time"
												 . " OR '$end_time' BETWEEN t1.appointment_start_time AND t1.appointment_end_time"
												 . " OR t1.appointment_start_time BETWEEN '$start_time' AND '$end_time' ) "
                                                 . " AND t1.appointment_date = '$appointment_date' AND t1.is_delete != '1' $where_edit_id" );
			
			
			if(!empty($records)){				
				if($this->input->post('ajax_request') == 'yes'){					
					echo "1";	
				}else{					
					$this->form_validation->set_message('check_available_time', "The appointment time hase been already booked on this date.");
					return FALSE;
				}
			
			}else{	
				
				if($this->input->post('ajax_request') == 'yes'){					
					echo "0";									
				}else{				
					return true;
				}
			}
			
		}	
	}	
	public function send_appointment_confirmation_email($to_email, $name, $appointment_date, $event_page_link){
		$chk_arr = array('[NAME]', '[APPOINTMENT_DATE]', '[EVENT_PAGE_LINK]');
		$rep_arr = array($name, $appointment_date, $event_page_link);
		$response_email = send_email($to_email, $template_slug = "appointment-confirmation", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
		return $response_email;
	}
}