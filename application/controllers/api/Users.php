<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Users extends REST_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->table = "master_admin";
		$this->device_detail = "device_detail";
		$this->login_history = "master_admin_login_history";
		$this->feedback = "feedback";
		$this->photooftheday = "photo_oftheday";
		$this->blog = "blog";
		$this->discourse = "discourse";
		$this->newsletter = "newsletter";
		$this->routeplan_table = 'sramcms_routeplan';
        $this->booking_table = "sramcms_event_users";
		$this->gallary_categories = "gallary_categories";
		$this->routeplan = "routeplan";
		$this->load->library('form_validation');
		$this->load->library ( 'common' );
		$this->load->library('firebase');
		$this->load->library('push');
		$config = Array(
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE
				);
		$this->load->helper('emailtemplate');
		$this->load->helper('smstemplate');
		$this->primary_key = 'id';
	}
	        
    public function index_get()
    {		
			$users =array();
			if ($users)
            {
                // Set the response and exit
                $this->set_response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
				 
            }
    }
	
	public function login_post(){
		
		$response = array ();		
		$this->form_validation->set_rules ( 'admin_email_address', 'Email Address', 'required|trim' );
		$this->form_validation->set_rules ( 'admin_password', 'Password', 'required|trim' );
		
		if ($this->form_validation->run ( $this ) == TRUE) {
			
			$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
			$admin_email_address = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'admin_email_address' ) ) );
			$admin_password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'admin_password' ) ) );
			
			$check_details = $this->db->query("SELECT * FROM sramcms_master_admin WHERE admin_email_address='".$admin_email_address."' AND admin_status='A' ");
			
			if ($check_details->num_rows() > 0)
			{
				$row = $check_details->row();
				$admin_id = $row->admin_id;
				if ($row->admin_status == 'A'){
					if($row->admin_user_type != '1'){
						$password_verify = check_hash($admin_password,$row->admin_password);
						
						if($password_verify == "Yes")
						{
							
							$this->Mydb->insert($this->login_history,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_admin_id'=>$admin_id));
							
							
							$token = get_random_key(32,'sramcms_master_admin','oauth_token',$type='alnum');
							
							$token_array = array ('oauth_token' => $token);
							
							$check_oauth = $this->Mydb->get_record ('oauth_token',$this->table,array ('admin_id'  => $admin_id));
							if($check_oauth['oauth_token'] == ''){
								$this->Mydb->update ( $this->table, array ('admin_id' => $admin_id ), $token_array );
							}
							
							$default_image = media_url('default-image.png');
							$image_path = media_url('profile/');
							$userdata = $this->Mydb->custom_query("SELECT ma.oauth_token, ma.admin_id, ma.admin_username, ma.admin_firstname, ma.admin_lastname, ma.admin_email_address, ma.admin_phone_number, ma.admin_status, admin_country, CASE WHEN ma.admin_profile !='' THEN CONCAT('".$image_path."', ma.admin_profile) ELSE '$default_image' END AS profile FROM sramcms_master_admin AS ma 
			LEFT JOIN sramcms_countries AS c ON c.id = ma.admin_country
			WHERE ma.admin_id = '".$admin_id."' AND ma.admin_status = 'A'");
							
							
							$data['user_data'] = $userdata;
							
							
							$result = array( 'success'=> 1 , 'message'=> 'Sucessfully Logged In', 'data'=> $data );
						}else{
							$result = array( 'success'=> 0 , 'message'=> 'Password Mismatch');
						}
					}else{
						$result = array( 'success'=> 0 , 'message'=> 'Your Account is Admin Control. So Does not login here.');
					}
				}else{
					$result = array( 'success'=> 0 , 'message'=> 'Your Account is Disabled.');
				}
			} else {
				$result = array( 'success'=> 0 , 'message'=> 'Account Not Found');	
			}
		} else {
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All Details');
		}
		echo $response = json_encode($result);
		return TRUE;
	}

	public function register_post(){
		
		$this->form_validation->set_rules ( 'admin_username', 'admin_username', 'required' );
		//$this->form_validation->set_rules ( 'admin_firstname', 'admin_firstname', 'required' );
		//$this->form_validation->set_rules ( 'admin_lastname', 'admin_lastname', 'required' );
		$this->form_validation->set_rules ( 'admin_password', 'password', 'required' );
		$this->form_validation->set_rules ( 'admin_email_address', 'admin_email_address', 'required' );
		//$this->form_validation->set_rules ( 'admin_phone_number', 'admin_phone_number', 'required');
		//$this->form_validation->set_rules ( 'admin_country', 'admin_country', 'required' );
		
		if ($this->form_validation->run()){
			
			
			$email_exists = $this->email_exists($this->input->post('admin_email_address'));
			
			if($email_exists == TRUE){
				$result = array( 'success'=> 0 , 'message'=> 'Email Address Already Exist');
			}else{
			
				$admin_password = do_bcrypt(post_value('admin_password'));
				$insert_array = array (
					'admin_username' => post_value ( 'admin_username' ),
					'admin_email_address' => post_value ( 'admin_email_address'),
					'admin_password' => $admin_password,
					'admin_updated_on' => current_date (),
					'admin_status'  => 'I',
					'admin_user_type' => '0',
					'admin_devices_type' => post_value ('admin_devices_type'),
					'admin_phone_code' => random_string('numeric',6),
					'admin_email_code' => md5(uniqid(rand()))
				);
				
				
				$insert_id = $this->Mydb->insert( $this->table, $insert_array );
				
				
				$details = $this->Mydb->get_record ('*', $this->table, array ('admin_id' => $insert_id));
				
				$name = $details['admin_firstname'].' '.$details['admin_lastname'];
				$activation_link = frontend_url('accountactivation/'.$details['admin_email_code']);
				$to_email = $details['admin_email_address'];
				
				$response_email = $this->send_activation_email($name, $to_email, $activation_link);
	
				/*$country_list = $this->Mydb->get_record('phonecode', $this->countries_table, array('id' => $this->input->post('admin_country')));
					
				if(post_value( 'admin_devices_type' ) !='I'){
					$sms_phone = $country_list['phonecode'] . $details['admin_phone_number'];
					$sms_country_code = $this->input->post('admin_country');
					$sms_phone_otp = $details['admin_phone_code'];
					
					$response_sms = $this->sms_user_active($sms_phone_otp, $sms_phone,  $sms_country_code);
					
				}*/
					
				$result = array( 'success'=> 1 , 'message'=> 'Registration done successfully, Verification Email Sent please check your inbox and activate' ); 
			}
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function send_activation_email($name, $to_email, $activation_link){
		
			$chk_arr = array('[NAME]','[ACTIVATIONLINK]');
			$rep_arr = array($name, $activation_link);
			$response = send_email($to_email,$template_slug ="user-account-activation",$chk_arr,$rep_arr,$attach_file=array(),$path='', $subject='',$cc='', $html_template = 'email_template');
			return $response;
			
	}
	
	public function forgotpassword_post() {
		$this->form_validation->set_rules ( 'admin_email_address', 'admin_email_address', 'required' );
		if ($this->form_validation->run()){
			$admin_email_address =  $this->input->post ( 'admin_email_address' );
			$admin_forgot_email = md5(uniqid(rand()));			
			$admin_forgot = 'D';
			$check_details = $this->Mydb->get_record('*', $this->table, array('admin_email_address' => $admin_email_address, 'admin_status' => 'A'));
			if(!empty($check_details)){
				$forgot = $this->Mydb->update($this->table, array('admin_email_address' => $admin_email_address), array('admin_forgot_email' => $admin_forgot_email, 'admin_forgot' => $admin_forgot));
				
				$name = $check_details ['admin_firstname'].' '.$check_details ['admin_lastname'];
				$to_email = $check_details ['admin_email_address'];
				$link = frontend_url('resetpassword/'.$admin_forgot_email);
				
				$response_email = $this->send_forgot_email($name, $to_email, $link);
				
				$result = array( 'success'=> 1 , 'message'=> 'Reset password email code. please check it mail');
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Your email is not exit. please try again');
			}
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
			
	}
	
	public function send_forgot_email($name, $to_email, $link){
		
			$chk_arr = array('[NAME]','[LINK]');
			$rep_arr = array($name, $link);
			$response = send_email($to_email,$template_slug ="forgot-password",$chk_arr,$rep_arr,$attach_file=array(),$path='', $subject='',$cc='', $html_template = 'email_template');	
			return $response;
	}
	
	public function myaccount_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$default_image = media_url('default-image.png');
			$image_path = media_url('profile/');
			
			$data['admin'] = $this->Mydb->custom_query("SELECT ma.admin_id, ma.admin_username, ma.admin_firstname, ma.admin_lastname, ma.admin_email_address, ma.admin_phone_number, ma.admin_status, admin_country, CASE WHEN ma.admin_profile !='' THEN CONCAT('".$image_path."', ma.admin_profile) ELSE '$default_image' END AS profile FROM sramcms_master_admin AS ma 
			LEFT JOIN sramcms_countries AS c ON c.id = ma.admin_country
			WHERE ma.oauth_token = '".$oauth_token."' AND ma.admin_status = 'A'");
			
			
			$result = array( 'success'=> 1 , 'message'=> 'Account List',  'data' => $data);
					
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function edit_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$admin_id = post_value('admin_id');
		
				
			if(!empty($_FILES['admin_profile']['name'])){
				
				$config['upload_path'] = 'media/profile/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['file_name'] = random_string('numeric',15).'-profile-'.$_FILES['admin_profile']['name'];
				
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
			
				if($this->upload->do_upload('admin_profile')){
					$uploadData = $this->upload->data();
					$admin_profile = $uploadData['file_name'];
				}
			}
			if(!empty($_FILES['admin_profile']['name'])){
			
				$user_array = array (
					'admin_firstname' => post_value ( 'admin_firstname' ),
					'admin_country' => post_value ( 'admin_country' ),
					'admin_lastname' => post_value ( 'admin_lastname' ),
					'admin_email_address' => post_value ( 'admin_email_address' ),
					'admin_phone_number' => post_value ( 'admin_phone_number' ),
					'admin_password'=> post_value ( 'admin_password' ),
					'admin_profile'=> $admin_profile,
				);
			
			}else{
				$user_array = array (
				
					'admin_firstname' => post_value ( 'admin_firstname' ),
					'admin_country' => post_value ( 'admin_country' ),
					'admin_lastname' => post_value ( 'admin_lastname' ),
					'admin_email_address' => post_value ( 'admin_email_address' ),
					'admin_phone_number' => post_value ( 'admin_phone_number' ),
					'admin_password'=> post_value ( 'admin_password' ),
					
				);
			}
			
			$update_id = $this->Mydb->update ( $this->table, array ('admin_id' => $admin_id), $user_array );
			if($update_id){
				$result = array( 'success'=> 1 , 'message'=> 'Myaccount update success');
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Myaccount update not success');
			}
			echo $response = json_encode($result);
			return TRUE;
	}
		
	function email_exists($key)
	{
		$this->db->where('admin_email_address',$key);
		$query = $this->db->get('sramcms_master_admin');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	function phone_exists($key)
	{
		$this->db->where('admin_phone_number',$key);
		$query = $this->db->get('sramcms_master_admin');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function refreshtoken_post(){
			
			$this->form_validation->set_rules('oauth_token',  'Oauth Token');
			$this->form_validation->set_rules('device_token', 'Device Token', 'required');
			$this->form_validation->set_rules('device_imei', 'Device Imei', 'required');
			
		if($this->form_validation->run()){
	
			$oauth_token = $this->input->post('oauth_token'); 
			$device_imei = $this->input->post('device_imei');
			$device_token = $this->input->post('device_token');
				
			$device_array = array (
				'device_token' => post_value ( 'device_token' ),
				'created' => date('Y-m-d H:i:s'),
			);
			
			if($oauth_token != '')
			{
				$details = $this->Mydb->get_record ('admin_id', $this->table, array ('oauth_token' => $this->input->post('oauth_token')));
				$user_arr = array (
						'user_id' => $details['admin_id']
				);
				$device_detail = array_merge ( $device_array, $user_arr );
				$this->Mydb->update ($this->device_detail, array ('device_imei' => $device_imei ), $device_detail );	
			}
			$this->Mydb->update ( $this->device_detail, array ('device_imei' => $device_imei ),array ('device_token' => $device_token ));
			$result = array('success'=> 1 , 'message'=> 'Device Detail Updated');
			
		}else{
			
			$result = array('success'=> 0 , 'message'=> 'Please Enter All Fields');
		}
		echo $response = json_encode($result);
		return TRUE;
		
	}

	public function devicetoken_post(){
	
		$this->form_validation->set_rules('device_token', 'Device Token', 'required');
		$this->form_validation->set_rules('device_imei', 'Device Imei', 'required');
		$this->form_validation->set_rules('device_type', 'Device Type', 'required');
		
		if($this->form_validation->run()){
			
			$device_token = $this->input->post('device_token'); 
			$device_imei = $this->input->post('device_imei'); 
			$device_type = $this->input->post('device_type'); 
			
			$insert_array = array (
					'admin_id' => 0,
					'created' => date('Y-m-d H:i:s'),
					'device_type' => post_value ( 'device_type' ),
					'device_imei' => post_value ( 'device_imei' ),
					'device_token' => post_value ( 'device_token' )
			);
			
			$details = $this->Mydb->get_record ('device_imei', $this->device_detail, array ('device_imei' => $this->input->post('device_imei')));
			if($details['device_imei'] == ''){
				$insert_id = $this->Mydb->insert( $this->device_detail, $insert_array );
			}
				
			$this->Mydb->update ( $this->device_detail, $device_imei ,array ('device_imei' => $device_imei ));
			
			$title = 'Hi';
			$message = 'Welcome jeevanacharya new admin member';
			
			$result = $this->push->setPush($title,$message);
			
			if($result == true){
				
				$json = '';
				$response = '';
				$json = $this->push->getPush();
				$regId = $device_token;
				$response = $this->firebase->send($regId, $json);
				
			}else{
				$result = array('success'=> 1 , 'message'=> 'Please Check Your Data');
			}
	
			$result = array('success'=> 1 , 'message'=> 'Successfully received'); 
	
		}else{
			$result = array('success'=> 0 , 'message'=> 'Please Enter All Fields');
		}
	
	echo $response = json_encode($result);
	return TRUE;
	}

	public function photoalbum_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$media_type = post_value ( 'media_type' );
		if($media_type == 1){
			$where = "AND gc.media_type = 1";
		}else{
			$where = "AND gc.media_type != 1";
		}
		$default_image = media_url('default-image.png');
		$image_path = media_url();
		
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$data['photoalbum'] = $this->Mydb->custom_query("SELECT al.id, al.name, 
				 CASE WHEN gc.is_active !='0' THEN count(gc.gallery_category_id) ELSE '0' END AS gallery_count, 
				CASE WHEN category_image !='' THEN CONCAT('".$image_path."', category_image) ELSE '$default_image' END AS category_image, gc.media_type FROM sramcms_gallary_categories AS al LEFT JOIN sramcms_galleries AS gc ON gc.gallery_category_id = al.id  WHERE al.is_active = '1' ".$where."  GROUP BY al.id");
				
				$result = array( 'success'=> 1 , 'message'=> 'Photo Album', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}

	public function photoalbumlist_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value ('id');
		$media_type = post_value('media_type');
		if($media_type == '1'){
			$where = "AND media_type = '1' ";
		}elseif($media_type == '2'){
			$where = " AND media_type = '2' ";
		}elseif($media_type == '3'){
			$where = "AND media_type = '3' ";
		}
		
		$default_image = media_url('default-image.png');
		$image_path = media_url();
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				
				$data['photoalbumlist'] = $this->Mydb->custom_query("SELECT id, 
				CASE 	
				WHEN file_name !='' AND media_type = '1'  THEN CONCAT('".$image_path."', file_name) 		
				WHEN file_name !='' AND media_type = '2'  THEN CONCAT('".$image_path."', file_name) 
				WHEN file_name !='' AND media_type = '3'  THEN REPLACE(file_name, 'https://www.youtube.com/embed/', '')
				ELSE '$default_image' END 	AS file_name, CASE WHEN video_thumb !='' THEN CONCAT('".$image_path."', video_thumb) ELSE '$default_image' END AS video_thumb, media_type FROM sramcms_galleries WHERE gallery_category_id = '".$id."' ".$where." AND is_active = '1' ");
			
				
				
				$result = array( 'success'=> 1 , 'message'=> 'Photo Album Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function contact_post(){
		
		$oauth_token = post_value ( 'oauth_token' );
		$firstname = post_value ( 'firstname' );
		$lastname = post_value ( 'lastname' );
		$email = post_value ( 'email' );
		$phone = post_value ( 'phone' );
		$country_id = post_value ( 'country_id' );
		$message_text = post_value ( 'message_text' );
		
		if($oauth_token != ''){
			
			
				$insert = $this->Mydb->insert($this->feedback, array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'country_id' => $country_id, 'message_text' => $message_text, 'is_active' => '1', 'is_delete' => '0', 'created' => current_date ()));
				
				if(!empty($insert)){				
					$result = array( 'success'=> 1 , 'message'=> 'Thank you for contacting. we can contact within 24hours');
				}else{
					$result = array( 'success'=> 0 , 'message'=> 'Your queries is not submitted. please try again');
				}				
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function tourprogram_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventupcomingprogram'] = $this->Mydb->custom_query("SELECT id, trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE end_date > NOW() AND is_reschedule = '0'");				
				$result = array( 'success'=> 1 , 'message'=> 'Tour Program Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function tourprogramdetail_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$route = media_url('route.jpg');
		$id = post_value ('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$eventprogramdetail = $this->Mydb->custom_query("SELECT r.id, r.start_date, r.map_id, r.end_date, r.trip_name, r.description, r.destinations, r.plan_details, r.created_on, count(eu.event_id) AS appointment FROM sramcms_routeplan AS r
				LEFT JOIN sramcms_event_users AS eu ON  eu.event_id = r.id
				WHERE r.id = '".$id."' ");	
				$thumbnail_list[] = array( 'thumbnail' => $route);	
				
				foreach($eventprogramdetail as $key => $value){
					$data['eventprogramdetail_list'][] = array_merge($eventprogramdetail[$key], $thumbnail_list[$key]);
				}
				
				$result = array( 'success'=> 1 , 'message'=> 'Tour Program Detail', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function appointmentlist_post(){
		$oauth_token = post_value ( 'oauth_token' );
		
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentlist'] = $this->Mydb->custom_query("SELECT id, name, email, phone_no, location, DATE_FORMAT(booked_date, '%d-%M-%Y') AS appointment_date, DATE_FORMAT(appointment_start_time, '%H:%i') AS appointment_time FROM sramcms_event_users WHERE admin_id = '".$data['admin']['admin_id']."' ");				
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	public function appointmentbooking_post(){
		$oauth_token = post_value ( 'oauth_token' );
		
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$purpose_of_appoint = json_encode($this->input->post('purpose'));
				 $event_id = $this->input->post('event_id');
				  $check_exist = $this->Mydb->get_record('*', $this->booking_table, array('event_id' => $event_id, 'email' => $this->input->post('email'), 'booked_date' => $this->input->post('booked_date')));
				  if (empty($check_exist)) {
					  $insert_data = array("name" => $this->input->post('firstname'),
						"email" => $this->input->post('email'),
						"phone_no" => $this->input->post('phonenumber'),
						"event_id" => $event_id,
						"admin_id" => $data['admin']['admin_id'],
						"admin_country" => $this->input->post('admin_country'),
						"booked_date" => $this->input->post('booked_date'),
						"location_date" => $this->input->post('location_date'),
						"location" => $this->input->post('location'),
						"purpose_of_appointment" => $purpose_of_appoint ? $purpose_of_appoint : '',
						"message" => $this->input->post('message'),
						"created_on" => current_date(),
						"created_ip" => get_ip(),
						"created_by" => $data['admin']['admin_id'],
						"is_active" => '1',
					);
					$insert = $this->Mydb->insert($this->booking_table, $insert_data);
					 $this->send_notification_email_to_admin($insert_data);
                     $this->send_acknowledgement_email_to_user($insert_data);
					if(!empty($insert)){
						$result = array( 'success'=> 1 , 'message'=> 'Appointment has been booked successfully !');
					}else{
						$result = array( 'success'=> 0 , 'message'=> 'Appointment has not been booked successfully !');
					}
				  }else{
					  $result = array( 'success'=> 0 , 'message'=> 'Appointment has been already booked!');
				  }
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	 public function send_acknowledgement_email_to_user($user_data) {
        $get_event_data = $this->Mydb->get_record("trip_name, destinations", $this->routeplan_table, array("id" => $user_data['event_id']));
        $chk_arr = array('[NAME]', '[EVENT_NAME]', '[EVENT_INFO]');
        $rep_arr = array($user_data['name'], $get_event_data['trip_name'], stripslashes(str_replace('|*|', ' >>> ', $get_event_data['destinations'])));
        $response_email = send_email($user_data['email'], $template_slug = "appointment-user-acknowledgement", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response_email;
    }

    public function send_notification_email_to_admin($user_data) {
        $get_event_data = $this->Mydb->get_record("trip_name, destinations", $this->routeplan_table, array("id" => $user_data['event_id']));
        $chk_arr = array('[NAME]', '[EMAIL]', '[PHONE_NO]', '[PURPOSE_OF_APPOINTMENT]', '[MESSAGE]', '[EVENT_NAME]', '[EVENT_INFO]');
        $rep_arr = array($user_data['name'], $user_data['email'], $user_data['phone_no'], $user_data['purpose_of_appointment'], $user_data['message'], $get_event_data['trip_name'], stripslashes(str_replace('|*|', ' >>> ', $get_event_data['destinations'])));
        $response_email = send_email($this->config->item('to_email', 'siteSettings'), $template_slug = "appointment-notification-to-admin", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response_email;
    }
	
	public function appointmentdetails_post(){
		$oauth_token = post_value ( 'oauth_token' );
		
		$id = post_value('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$data['appointmentdetails'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.purpose_of_appointment, ap.message AS short_message, ap.message AS long_message, ap.location, ap.location_date, DATE_FORMAT(ap.booked_date, '%d-%M-%Y') AS appointment_date, DATE_FORMAT(ap.appointment_start_time, '%H:%i') AS appointment_time, r.trip_name AS event_name, r.destinations AS event_location, DATE_FORMAT(r.start_date, '%d-%M-%Y') AS event_date FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id WHERE ap.id = '".$id."' AND ap.admin_id = '".$data['admin']['admin_id']."' ");
				
								
				$data['appointmentdetails'][0]['purpose'] = str_replace('[', '',str_replace(']', '',str_replace('"', '', $data['appointmentdetails'][0]['purpose_of_appointment'])));
				
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Details', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	function tourlist_post()
	{
		$records = "";
		$data=array();
		$select = "id,trip_name";
		$where =" is_active=1  ";
		$records = $this->Mydb->get_all_records($select,'sramcms_routeplan',$where);
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[] = array( 'id' => $value['id'], 'name' => stripslashes($value['trip_name']));
			}
			$result = array( 'success'=> 1 , 'message'=> 'Success', 'data'=>$data);
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Tour List','data'=>$data);
		}
		
		echo $response = json_encode($result);
		return TRUE;
		
	}	
	
	function refreshDashboardCount_post(){
		$result = array();
		$oauth_token = post_value ('oauth_token'); 
		$data = array();
		if($oauth_token != ''){
			
			$feedback = $this->Mydb->get_all_records('id', $this->feedback);
			$data['feedback'] = count($feedback);
			$booking = $this->Mydb->get_all_records('id', 'sramcms_event_users', array('is_active' => '1', 'is_delete' => '0', 'is_cancel' => '0'));
			$data['booking'] = count($booking);
			
		    $result = array( 'success'=> 1 , 'message'=> 'Success', 'data' => $data);
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	function generateUniqueId($n) 
	{
        $availableCharacters = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $id = "";
        for ($i = 0; $i < $n; $i++) {
            $id .= substr($availableCharacters, rand(0, strlen($availableCharacters) - 1), 1);
        }
        return $id;
    }
	
	function country_post()
	{
		$records = "";
		$data=array();
		$select = "id,name,title,phonecode";
		$where =" is_active=1  ";
		$records = $this->Mydb->get_all_records($select,'sramcms_countries',$where);
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[] = array( 'id' => $value['id'], 'name' => stripslashes($value['title']));
			}
			$result = array( 'success'=> 1 , 'message'=> 'Success', 'data'=>$data);
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Country List','data'=>$data);
		}
		
		echo $response = json_encode($result);
		return TRUE;
		
	}
	
}
