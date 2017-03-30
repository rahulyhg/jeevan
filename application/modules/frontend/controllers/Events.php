<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Events extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->module = "events";
		$this->module_label = "events";
		$this->module_labels = "events";
		$this->folder = "events/";
		$this->table = "sramcms_routeplan";
		$this->booking_table = "sramcms_event_users";
	
	}
	
	/* this method used to show all dashboard all details... */
	public function index() {
	 
	  $data = array();
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	  $this->loadBlocks();
	  $data = array_merge($data, $this->view_data);
	  $getplandetails = $this->Mydb->custom_query("SELECT * FROM $this->table WHERE is_active=1 AND is_visible = 1 ");
	  $data['records'] = $getplandetails;
	  $this->layout->display_frontend($this->folder . '/events', $data);
	}
	/* Get event data */
	public function get_event_data(){
		$response = array();
		$event_url= frontend_url().$this->module.'/get_event_booking/';
		$result = $this->Mydb->get_all_records("id, trip_name AS title, CONCAT('" . $event_url. "',id) AS url,(UNIX_TIMESTAMP(start_date) * 1000) AS start, (UNIX_TIMESTAMP(end_date) * 1000) AS end", $this->table, array('is_active' => '1', 'is_delete' => '0'));
		
		if(!empty($result)){
			$response['success'] = 1;
			$response['result'] = $result;
 		}
 		
 		echo json_encode($response);
	}	
	/* Event booking popup modal window */
	public function get_event_booking($event_id = null, $booking_date = null){
		
		if(!empty($event_id)){
			
			$result = $this->Mydb->get_record('*', $this->table, array('id' => $event_id));
			$data = array();
			$data['module_label'] = $this->module_label;
			$data['module_labels'] = $this->module_label;
			$data['module'] = $this->module;
			$now = get_date_formart(current_date(), 'Y-m-d');
			if(($result['available_date'] < $booking_date || $result['available_date'] == $booking_date) && ($now < $booking_date)){
				$data['show_booking_form'] = "yes";
				
			}
			$data['booking_date'] = $booking_date;
			$data['records'] = $result;
			$this->load->view($this->folder.'/events-booking', $data);
			
		}
		
	}
	/* Event booking form Register */
	public function user_booking_appointment(){
		form_check_ajax_request();
		if(!empty($_POST)){
			$response = array();
			$event_id = $this->input->post('event_id');
			$check_exist = $this->Mydb->get_record('*', $this->booking_table, array('event_id' => $event_id, 'email' => $this->input->post('email'),'booked_date' => $this->input->post('booked_date')));
			
			if(empty($check_exist)){
			
				$purpose_of_appoint = json_encode($this->input->post('purpose'));
				$insert_data = array("name" => $this->input->post('firstname'),
						"email" => $this->input->post('email'),
						"phone_no" => $this->input->post('phonenumber'),
						"event_id" => $event_id,
						"booked_date" => $this->input->post('booked_date'),
						"purpose_of_appointment" => $purpose_of_appoint ? $purpose_of_appoint :'',
						"message" => $this->input->post('message'),
						"created_on" => current_date(),
						"created_ip" => get_ip(),
						"created_by" => get_admin_id(),
						"is_active" => '1',
				);
				
				$result = $this->Mydb->insert($this->booking_table,$insert_data);	
				if(!empty($result)){
					
					$response['status'] = "success";
					$response['message'] = "Appointment has been booked successfully !";
				}else{
					$response['status'] = "failure";
					$response['message'] = "Appointment has not been booked successfully !";
				}
				
				
			}else{
				$response['status'] = "failure";
				$response['message'] = "Appointment has been already booked!";
			}
		}
		echo json_encode($response);
		exit;
			
	}
	/*Get group route table */
	public function getroute_by_map_id() {
		$map_id = $this->input->post('map_id');
		if ($map_id != '') {
			$getplandetails = $this->Mydb->custom_query("select * from $this->table where id=$map_id");
			$plan_details = explode('-', $getplandetails[0]['plan_details']);
			$response['startvalue'] = $plan_details[0];
			$response['endvalue'] = $plan_details[1];
			$destinations = $getplandetails[0]['destinations'];
			$explodedestinations = explode('|*|', $destinations);
			$response['destinations'] = array();
			$rows = array();
			foreach ($explodedestinations as $destination):
			$rows['location'] = $destination;
			array_push($response['destinations'], $rows);
			endforeach;
		} else {
           $getplandetails = $this->Mydb->custom_query("SELECT * FROM $this->table WHERE is_active =1 AND CURDATE() between start_date and end_date");
           if(empty($getplandetails)){
           	$getplandetails = $this->Mydb->custom_query("SELECT * from $this->table WHERE is_active=1 ORDER BY id ASC");
           }
           $plan_details = explode('-', $getplandetails[0]['plan_details']);
           $response['startvalue'] = $plan_details[0];
           $response['endvalue'] = $plan_details[1];
           $destinations = $getplandetails[0]['destinations'];
		   $explodedestinations = explode('|*|', $destinations);
		   $response['destinations'] = array();
		   $rows = array();
		   foreach ($explodedestinations as $destination):
		     $rows['location'] = $destination;
			 array_push($response['destinations'], $rows);
		  endforeach;
		}
		
		echo json_encode($response);
	}
	
	
	
}
