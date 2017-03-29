<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "homepage/";
        $this->routeplan_table = "sramcms_routeplan";
		$this->sramcms_newsletter_table = "sramcms_newsletter";
		$this->load->library ( 'common' );
		$config = Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->helper('emailtemplate');
    }

    /* this method used to show all dashboard all details... */

    public function index() {

        $data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);

        $this->layout->display_frontend($this->folder . '/homepage', $data);
    }

    public function routeplan() {
        $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where is_active=1 and is_visible = 1 ");
        $data['records'] = $getplandetails;
        $this->load->view($this->folder . '/routeplan', $data);
    }

    public function getroute_by_map_id() {
        $map_id = $this->input->post('map_id');
        if ($map_id != '') {
            $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where id=$map_id");
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
//            $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where status=1 and CURDATE() between start_date and end_date");
//            $plan_details = explode('-', $getplandetails[0]['plan_details']);
//            $response['startvalue'] = $plan_details[0];
//            $response['endvalue'] = $plan_details[1];
//            $destinations = $getplandetails[0]['destinations'];
 //           $response['startvalue'] = "Karaikudi, Tamil Nadu, India";
//			$response['endvalue'] = "Chennai, Tamil Nadu, India";
 //           $destinations = "Karaikudi, Tamil Nadu, India|*|Keeranur,Tamil Nadu, India|*|Tiruchirappalli, Tamil Nadu, India|*|Chennai, Tamil Nadu, India";
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
	
	
	public function newsletter(){
		if($this->input->post('action') == 'Subcribe'){
			
			$this->form_validation->set_rules('newsletter_name', 'Name', 'required');
			$this->form_validation->set_rules('newsletter_email', 'Email Address', 'required');
			if ($this->form_validation->run($this) == TRUE) {
				
				$check = $this->Mydb->get_record('email', $this->sramcms_newsletter_table, array('is_active' => '1', 'is_delete' => '0', 'email' => $this->input->post('newsletter_email')));
				
				if(empty($check)){
					$insert_array = array(
						'name' => $this->input->post('newsletter_name'),
						'email' => $this->input->post('newsletter_email'),
						'status' => '1',
						'is_active' => '1',
						'is_delete' => '0',
						'created' => current_date(),
						'activation_code' => md5(uniqid(rand()))
					);
					$insert = $this->Mydb->insert($this->sramcms_newsletter_table, $insert_array);
					
					$details = $this->Mydb->get_record('name, email, activation_code', $this->sramcms_newsletter_table, array('id' => $insert));


					$name = $details['name'];
					$activation_link = frontend_url('newsletterunsubscribe/'.$details['activation_code']);
					$to_email = $details['email'];
					$response = $this->send_newletter_email($name, $to_email, $activation_link);
				
					if($insert){
						$response ['status'] = 'status';
                		$response ['message'] = 'Your email is subscribe successfully';
					}else{
						$response ['status'] = 'error';
                		$response ['message'] = 'Your email is not subscribe';
					}
					
				}else{
					$response ['status'] = 'error';
                	$response ['message'] = 'Your email already exits. please change email';
				}	
							
			}else{
				$response ['status'] = 'error';
                $response ['message'] = validation_errors();
			}
			echo json_encode($response);
			exit();
			
		}
	}
	
	public function newsletterunsubscribe(){
		
		$data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);
		
		$key = $this->uri->segment(3);
		if (!empty($key)) {
            $getsubscribe = $this->Mydb->custom_query("SELECT id FROM $this->sramcms_newsletter_table WHERE activation_code='$key'");
            if (!empty($getuserid)) {

                $id = $getsubscribe[0]['id'];
                $user_array = array(
                    'status' => 0,
					'created' => date()
                );

                $updateuser = $this->Mydb->update(activation_code, array('id' => $id), $user_array);
                $data['emailmsg'] = "Your Unsubscribe code is success";
            } else {
                $data['emailmsg'] = "Your Unsubscribe code is wrong . Please try again";
            }
        } else {
            $data['emailmsg'] = "Something Error. Please try again";
        }
		
        $this->layout->display_frontend($this->folder . '/homepage', $data);
	}
	
	public function send_newletter_email($name, $to_email, $activation_link) {

        $chk_arr = array('[NAME]', '[ACTIVATIONLINK]');
        $rep_arr = array($name, $activation_link);
        $response = send_email($to_email, $template_slug = "newsletter-subscribe", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response;
    }
	
    public function logout() {

        $this->session->sess_destroy();

        redirect(frontend_url());
    }

}
