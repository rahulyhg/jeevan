<?php

/* * ************************
  Project Name	        : POS
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
		$this->sramcms_feedback_table = "sramcms_feedback";
		$this->load->library ( 'common' );
		
	$config = Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->helper('emailtemplate');
		$this->load->library('MailChimp'); 
		$result = $this->mailchimp->get('lists');
		$this->list_id = "e1de81f5be";
		 
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
            $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where status=1 and CURDATE() between start_date and end_date");
            $plan_details = explode('-', $getplandetails[0]['plan_details']);
            $response['startvalue'] = $plan_details[0];
            $response['endvalue'] = $plan_details[1];
            $destinations = $getplandetails[0]['destinations'];
 /// 		$response['startvalue'] = "Karaikudi, Tamil Nadu, India";
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
								
					$result = $this->mailchimp->post("lists/$this->list_id/members", [ 'email_address' => $to_email, 'merge_fields' => ['FNAME'=>$name], 'status' => 'subscribed', ]); 
					
					
					$response_email = $this->send_newletter_email($name, $to_email, $activation_link);
					if($insert){
						$response_msg ['status'] = 'success';
                		$response_msg ['message'] = 'Your email is subscribe successfully';
					}else{
						$response_msg ['status'] = 'error';
                		$response_msg ['message'] = 'Your email is not subscribe';
					}
					
				}else{
					
					$update_array = array(
						'name' => $this->input->post('newsletter_name'),
						'email' => $this->input->post('newsletter_email'),
						'status' => '1',
						'is_active' => '1',
						'is_delete' => '0',
						'created' => current_date(),
						'activation_code' => md5(uniqid(rand()))
					);
					
					$updateuser = $this->Mydb->update($this->sramcms_newsletter_table, array('email' => $this->input->post('newsletter_email')), $update_array);
					
					if($updateuser){

$update_result = $this->mailchimp->post("lists/$this->list_id/members", [ 'email_address' => $this->input->post('newsletter_email'), 'merge_fields' => ['FNAME'=>$this->input->post('newsletter_name')], 'status' => 'subscribed', ]); 
						$response_msg ['status'] = 'success';
                		$response_msg ['message'] = 'Your Subscription updated successfully';
					}else{
						$response_msg ['status'] = 'error';
                		$response_msg ['message'] = 'your Subscription Not Updated';
					}
				}	
							
			}else{
				$response_msg ['status'] = 'error';
                $response_msg ['message'] = validation_errors();
			}
			echo json_encode($response_msg);
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
            $getsubscribe = $this->Mydb->custom_query("SELECT * FROM $this->sramcms_newsletter_table WHERE activation_code='$key' AND status='1'");
            if (!empty($getsubscribe)) {

                $id = $getsubscribe[0]['id'];
                $user_array = array(
                    'status' => 0,
					'created' => current_date(),
					'activation_code' => md5(uniqid(rand()))
                );

                $updateuser = $this->Mydb->update($this->sramcms_newsletter_table, array('id' => $id), $user_array);
				
				$details = $this->Mydb->get_record('name, email, activation_code', $this->sramcms_newsletter_table, array('id' => $insert));
				
				$name = $getsubscribe[0]['name'];
				$activation_link = frontend_url('newslettersubscribe/'.$getsubscribe[0]['activation_code']);
				$to_emil = $getsubscribe[0]['email'];
				$response_email = $this->send_newletter_un_email($name, $to_email, $activation_link);


$subscriber_hash = $this->mailchimp->subscriberHash($to_emil);

$this->mailchimp->delete("lists/$this->list_id/members/$subscriber_hash");

                $data['emailmsg'] = "Your Unsubscribe code is success";
				
            } else {
                $data['emailmsg'] = "Your Unsubscribe code is wrong . Please try again";
            }
        } else {
            $data['emailmsg'] = "Something Error. Please try again";
        }
		
		$this->layout->display_frontend($this->folder . 'unsubscribe', $data);
	}
	
	public function newslettersubscribe(){
		$data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);

        
		$key = $this->uri->segment(3);
		if (!empty($key)) {
            $getsubscribe = $this->Mydb->custom_query("SELECT * FROM $this->sramcms_newsletter_table WHERE activation_code='$key' AND status='0'");
            if (!empty($getsubscribe)) {

                $id = $getsubscribe[0]['id'];
                $user_array = array(
                    'status' => 0,
					'created' => current_date(),
					'activation_code' => md5(uniqid(rand()))
                );

                $updateuser = $this->Mydb->update($this->sramcms_newsletter_table, array('id' => $id), $user_array);
				
				$details = $this->Mydb->get_record('name, email, activation_code', $this->sramcms_newsletter_table, array('id' => $insert));
				
				$name = $getsubscribe[0]['name'];
				$activation_link = frontend_url('newsletterunsubscribe/'.$getsubscribe[0]['activation_code']);
				$to_email = $getsubscribe[0]['email'];
				$response_email = $this->send_newletter_email($name, $to_email, $activation_link);
				
                $data['emailmsg'] = "Your Subscribe code is success";
				
            } else {
                $data['emailmsg'] = "Your Subscribe code is wrong . Please try again";
            }
        } else {
            $data['emailmsg'] = "Something Error. Please try again";
        }
		
		$this->layout->display_frontend($this->folder . 'subscribe', $data);
	}
	
	
	public function feedback(){
		if($this->input->post('action') == 'feedback'){
			
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required');
			$this->form_validation->set_rules('message_text', 'Message', 'required');
			
			if ($this->form_validation->run($this) == TRUE) {
				
				$check = $this->Mydb->get_record('email', $this->sramcms_feedback_table, array('is_active' => '1', 'is_delete' => '0', 'email' => $this->input->post('email')));
				
				if(empty($check)){
					$insert_array = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'message_text' => $this->input->post('message_text'),
						'is_active' => '1',
						'is_delete' => '0',
						'created' => current_date(),
					);
					$insert = $this->Mydb->insert($this->sramcms_feedback_table, $insert_array);
					
					$details = $this->Mydb->get_record('firstname, lastname, email, message_text', $this->sramcms_feedback_table, array('id' => $insert));

					$name = 'Admin';
					$to_email = 'info@jeevanachraya.com';
					$firstname = $details['firstname'];
					$lastname = $details['lastname'];
					$email = $details['email'];
					$content = $details['content'];
					
					$response_email = $this->send_feedback_email($name, $to_email, $firstname, $lastname, $email, $content);
					if($insert){
						$response_msg ['status'] = 'success';
                		$response_msg ['message'] = 'Thank you for contacting us. We will be in touch with you very soon.';
					}else{
						$response_msg ['status'] = 'error';
                		$response_msg ['message'] = 'Contact form is not added';
					}
					
				}else{
					$response_msg ['status'] = 'error';
                	$response_msg ['message'] = 'Your email already exits. please change email';
				}	
							
			}else{
				$response_msg ['status'] = 'error';
                $response_msg ['message'] = validation_errors();
			}
			echo json_encode($response_msg);
			exit();
			
		}
	}
	
	
	public function send_newletter_email($name, $to_email, $activation_link) {

        $chk_arr = array('[NAME]', '[ACTIVATIONLINK]');
        $rep_arr = array($name, $activation_link);
        $response_email = send_email($to_email, $template_slug = "newsletter-subscribe", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response_email;
    }
	
	public function send_newletter_un_email($name, $to_email, $activation_link) {

        $chk_arr = array('[NAME]', '[ACTIVATIONLINK]');
        $rep_arr = array($name, $activation_link);
        $response_email = send_email($to_email, $template_slug = "newsletter-unsubscribe", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response_email;
    }
	
	public function send_feedback_email($name, $to_email, $firstname, $lastname, $email, $content) {

        $chk_arr = array('[NAME]', '[FIRSTNAME]', '[LASTNAME]', '[EMAIL]', '[CONTENT]');
        $rep_arr = array($name, $firstname, $lastname, $email, $content);
        $response_email = send_email($to_email, $template_slug = "feedback-admin", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response_email;
    }
	
    public function logout() {

        $this->session->sess_destroy();

        redirect(frontend_url());
    }

}
