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
	
	}
	
	/* this method used to show all dashboard all details... */
	public function index() {
	 
	  $data = array();
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	  $this->loadBlocks();
	  $data = array_merge($data, $this->view_data);
	
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
	public function get_event_booking($event_id = null, $booking_date = null){
		echo $booking_date;
		if(!empty($event_id)){
			$result = $this->Mydb->get_record('*', $this->table, array('id' => $event_id));
			$data = array();
			$data['module_label'] = $this->module_label;
			$data['module_labels'] = $this->module_label;
			$data['module'] = $this->module;
			$data['records'] = $result;
			$this->load->view($this->folder.'/events-booking', $data);
			
		}
		
	}
	
	
}
