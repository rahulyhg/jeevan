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
class Admin extends REST_Controller {
	
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
	
	/*Admin login method*/
	public function login_post(){
		
		$response = array ();		
		$this->form_validation->set_rules ( 'admin_username', 'Username', 'required|trim' );
		$this->form_validation->set_rules ( 'admin_password', 'Password', 'required|trim' );
		
		if ($this->form_validation->run ( $this ) == TRUE) {
			
			$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
			$admin_username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'admin_username' ) ) );
			$admin_password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'admin_password' ) ) );
			
			$check_details = $this->db->query("SELECT * FROM sramcms_master_admin WHERE admin_username='".$admin_username."' AND admin_status='A' ");
			
			if ($check_details->num_rows() > 0)
			{
				$row = $check_details->row();
				$admin_id = $row->admin_id;
				if ($row->admin_status == 'A'){
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
						$userdata = array();
						$userdata[] = $this->Mydb->get_record ('oauth_token,admin_id, admin_username,admin_email_address,admin_phone_number',$this->table,array ('admin_id'  => $admin_id));
						$data['user_data'] = $userdata;
						$feedback = $this->Mydb->get_all_records('id', $this->feedback);
						$data['feedback'] = count($feedback);
						$booking = $this->Mydb->get_all_records('id', 'sramcms_event_users', array('is_active' => '1', 'is_delete' => '0', 'is_cancel' => '0'));
						$data['booking'] = count($booking);
						
						$result = array( 'success'=> 1 , 'message'=> 'Sucessfully Logged In', 'data'=> $data );
					}else{
						$result = array( 'success'=> 0 , 'message'=> 'Password Mismatch');
					}
				}else{
					$result = array( 'success'=> 2 , 'message'=> 'Your Account is Disabled.');
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
	/*Admin register method*/
	public function register_post(){
		
		$this->form_validation->set_rules ( 'admin_username', 'admin_username', 'required' );
		$this->form_validation->set_rules ( 'admin_password', 'password', 'required' );
		$this->form_validation->set_rules ( 'admin_email_address', 'admin_email_address', 'required' );
		$this->form_validation->set_rules ( 'admin_phone_number', 'admin_phone_number', 'required');
				
		if ($this->form_validation->run()){
		
		
			$email_exist 	  =  $this->email_exists($this->table,array('admin_email_address' => $this->input->post('admin_email_address'),'admin_status' => 'A'));
			$username_exists  =  $this->username_exists($this->table,array('admin_username' => $this->input->post('admin_username'),'admin_status' => 'A'));
			$phone_exists 	  =  $this->phone_exists($this->table, array('admin_phone_number' => $this->input->post('admin_phone_number'),'admin_status' => 'A'));
			$admin_password = do_bcrypt(post_value('admin_password'));
			
			$insert_array = array (
				'admin_username' => post_value ( 'admin_username'),
				'admin_email_address' => post_value ( 'admin_email_address'),
				'admin_phone_number' => post_value ( 'admin_phone_number' ),
				'admin_password' => $admin_password,
				'admin_updated_on' => current_date (),
				'admin_status'  => 'A'
			);
			
			$insert_id = $this->Mydb->insert( $this->table, $insert_array );
			
			$result = array( 'success'=> 1 , 'message'=> 'Registration done successfully' ); 
		
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin forgotpassword method*/
	public function forgotpassword_post() {
		$this->form_validation->set_rules ( 'admin_phone_number', 'admin_phone_number', 'required' );
		if ($this->form_validation->run()){
			$admin_phone_number =  $this->input->post ( 'admin_phone_number' );
			$sms_country_code = '109';
			$admin_otp = random_string('numeric', 6);
			$admin_forgot = 'D';
			$forgot = $this->Mydb->update($this->table, array('admin_phone_number' => $admin_phone_number), array('admin_otp' => $admin_otp, 'admin_forgot' => $admin_forgot));
			$response_sms = $this->sms_forgot($admin_otp, $admin_phone_number, $sms_country_code);
			$result = array( 'success'=> 1 , 'message'=> 'Reset password otp sent. please check it mobile');
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
			
	}
	/*Forgot otp sms*/
	public function sms_forgot($sms_otp, $sms_phone, $sms_country_code) {

        $sms_chk_arr = array('[MOBILE_OTP]');
        $sms_rep_arr = array($sms_otp);
        $response_sms = send_sms($sms_template_slug = "reset-password-sms", $sms_chk_arr, $sms_rep_arr, $sms_phone, $sms_country_code);
        return $response_sms;
    }
	/*Admin otp method*/
	public function otp_post() {
		$this->form_validation->set_rules ( 'admin_otp', 'admin_otp', 'required' );
		if ($this->form_validation->run()){
			$admin_otp =  $this->input->post ( 'admin_otp' );
			$admin_forgot = 'A';
			
			$checkotp = $this->Mydb->get_record('admin_id, admin_otp, admin_forgot', $this->table, array('admin_otp' => $admin_otp, 'admin_forgot' => 'D'));
			if($checkotp !='' ){
				$otp = $this->Mydb->update($this->table, array('admin_otp' => $admin_otp), array('admin_forgot' => $admin_forgot));
				$result = array( 'success'=> 1 , 'message'=> 'OTP verifiy ');
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Your OTP is not exists');
			}
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
			
	}
	/*Admin resendotp method*/
	public function resendotp_post() {
		$this->form_validation->set_rules ( 'admin_phone_number', 'admin_phone_number', 'required' );
		if ($this->form_validation->run()){
			$admin_phone_number =  $this->input->post ( 'admin_phone_number' );
			$sms_country_code = '109';
			$admin_otp = random_string('numeric', 6);
			$admin_forgot = 'D';
			$resendotp = $this->Mydb->update($this->table, array('admin_phone_number' => $admin_phone_number), array('admin_otp' => $admin_otp, 'admin_forgot' => $admin_forgot));
			$response_sms = $this->sms_resend($admin_otp, $admin_phone_number, $sms_country_code);
			$result = array( 'success'=> 1 , 'message'=> 'Resend otp sent. please check it mobile');
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
			
	}
	/*Resend otp sms*/
	public function sms_resend($sms_otp, $sms_phone, $sms_country_code) {

        $sms_chk_arr = array('[MOBILE_OTP]');
        $sms_rep_arr = array($sms_otp);
        $response_sms = send_sms($sms_template_slug = "resend-otp-sms", $sms_chk_arr, $sms_rep_arr, $sms_phone, $sms_country_code);
        return $response_sms;
    }
	/*Admin otp method*/
	public function resetpassword_post() {
		$this->form_validation->set_rules ( 'new_password', 'new_password', 'required' );
		$this->form_validation->set_rules ( 'confirm_password', 'confirm_password', 'required' );
		$this->form_validation->set_rules ( 'admin_otp', 'admin_otp', 'required' );
		if ($this->form_validation->run()){
			$admin_otp =  $this->input->post ( 'admin_otp' );
			$new_password =  $this->input->post ( 'new_password' );
			$confirm_password =  $this->input->post ( 'confirm_password' );
			
			$checkreset = $this->Mydb->get_record('admin_id, admin_otp, admin_forgot', $this->table, array('admin_otp' => $admin_otp, 'admin_forgot' => 'A'));
			if($checkreset !='' ){
				$admin_password = do_bcrypt($new_password);
				$reset = $this->Mydb->update($this->table, array('admin_otp' => $admin_otp), array('admin_password' => $admin_password));
				$result = array( 'success'=> 1 , 'message'=> 'reset password success ');
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'reset password is not success');
			}
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Please Enter All fields');
		}
		echo $response = json_encode($result);
		return TRUE;
			
	}
	/*Admin email exists method*/
	public function email_exists() {
		
		$admin_email_address = $this->input->post ( 'admin_email_address' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'admin_email_address' => trim ( $admin_email_address ),
				'admin_status' => 'A'
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"id !=" => $edit_id 
			) );
		}
		$get_result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $get_result )) {
			
			$this->form_validation->set_message('email_exists', 'Email Already Exist');
			return false;
			
		} else {
			return true;
		}
	}
	/*Admin username exists method*/
	public function username_exists() {
		$admin_username = $this->input->post ( 'admin_username' );
		$edit_id =  addslashes ( decode_value ( $this->input->post ( 'edit_id' )) );
	
		$where = array (
				'admin_username' => trim ( $admin_username ),
				'admin_status' => 'A'
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"id !=" => $edit_id
			) );
		}
	
		$result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $result )) {
			
			$this->form_validation->set_message('username_exists', 'Username Already Exist');
			return false;
			
		} else {
			return true;
		}
	}
	/*Admin phone number exists method*/
	public function phone_exists() {
		$admin_phone_number = $this->input->post ( 'admin_phone_number' );
		$edit_id =  addslashes ( decode_value ( $this->input->post ( 'edit_id' )) );
	
		$where = array (
				'admin_phone_number' => trim ( $admin_phone_number ),
				'admin_status' => 'A'
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"id !=" => $edit_id
			) );
		}
	
		$result = $this->Mydb->get_record ( '*', $this->table, $where );
		if (! empty ( $result )) {
			$this->form_validation->set_message('phone_exists', 'phone Number Already Exist');
			return false;
		} else {
			return true;
		}
	}
	/*Admin refresh token method*/
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
						'admin_id' => $details['admin_id']
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
	/*Admin device token method*/
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
	/*Admin gallery category list method*/
	public function gallerycategory_post(){
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
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$data['gallarycategories'] = $this->Mydb->custom_query("SELECT al.id, al.name, 
				 CASE WHEN gc.is_active !='0' THEN count(gc.gallery_category_id) ELSE '0' END AS gallery_count, 
				CASE WHEN category_image !='' THEN CONCAT('".$image_path."', category_image) ELSE '$default_image' END AS category_image, gc.media_type FROM sramcms_gallary_categories AS al LEFT JOIN sramcms_galleries AS gc ON gc.gallery_category_id = al.id  WHERE al.is_active = '1' ".$where." GROUP BY al.id");
				
				$result = array( 'success'=> 1 , 'message'=> 'Gallary Categories Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin gallery list method*/
	public function gallerylist_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value ('id');
		$media_type = post_value('media_type');
		if($media_type == '1'){
			$where = "AND media_type = '1' ";
		}else{
			$where = " AND media_type != '1' ";
		}
		$default_image = media_url('default-image.png');
		$image_path = media_url();
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				
				$data['gallerylist'] = $this->Mydb->custom_query("SELECT id, 
				CASE 	
				WHEN file_name !='' AND media_type = '1'  THEN CONCAT('".$image_path."', file_name) 		
				WHEN file_name !='' AND media_type = '2'  THEN CONCAT('".$image_path."', file_name) 
				WHEN file_name !='' AND media_type = '3'  THEN REPLACE(file_name, 'https://www.youtube.com/embed/', '')
				ELSE '$default_image' END 	AS file_name, CASE WHEN video_thumb !='' THEN CONCAT('".$image_path."', video_thumb) ELSE '$default_image' END AS video_thumb, media_type FROM sramcms_galleries WHERE gallery_category_id = '".$id."' ".$where." AND is_active = '1' ");
			
				
				$result = array( 'success'=> 1 , 'message'=> 'Gallary Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin gallery category detail method*/
	public function gallerycategorydetail_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$default_image = media_url('default-image.png');
		$image_path = media_url();
		$id = post_value ( 'id' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['gallerycategorydetail'] = $this->Mydb->custom_query("SELECT id, name, meta_title, meta_keyword, slug, description, meta_description, CASE WHEN category_image !='' THEN CONCAT('".$image_path."', category_image) ELSE '$default_image' END AS category_image FROM sramcms_gallary_categories WHERE id = '".$id."' ");
				
				$result = array( 'success'=> 1 , 'message'=> 'Gallertcategory details', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin gallery category name exists method*/
	public function categoryname_exists() {
		
		$name = $this->input->post ( 'name' );
		$edit_id = $this->input->post ( 'edit_id' );
		
		$where = array (
				'name' => trim ( $name ),
		);
		if ($edit_id != "") {
			$where = array_merge ( $where, array (
					"id !=" => $edit_id 
			) );
		}
		$get_result = $this->Mydb->get_record ( '*', $this->gallary_categories, $where );
		if (! empty ( $get_result )) {
			
			$this->form_validation->set_message('categoryname_exists', 'Category Name Already Exist');
			return false;
			
		} else {
			return true;
		}
	}
	
	/*Admin event past program method*/
	public function eventpastprogram_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventpastprogram'] = $this->Mydb->custom_query("SELECT id, trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE end_date < NOW() AND is_reschedule = '0'");				
				$result = array( 'success'=> 1 , 'message'=> 'Past Event Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin event upcoming program method*/
	public function eventupcomingprogram_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventupcomingprogram'] = $this->Mydb->custom_query("SELECT id, trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE end_date > NOW() AND is_reschedule = '0'");				
				$result = array( 'success'=> 1 , 'message'=> 'Upcoming Event Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin event reschdule program method*/
	public function eventreschduleprogram_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventreschduleprogram'] = $this->Mydb->custom_query("SELECT id, trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE  is_reschedule = '1'");				
				$result = array( 'success'=> 1 , 'message'=> 'Upcoming Event Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin event program detail method*/
	public function eventprogramdetail_post(){
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
				
				$result = array( 'success'=> 1 , 'message'=> 'Event Detail', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin event reschdule form method*/
	public function eventreschduleform_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value ('id');
		$start_date = post_value ('start_date');
		$end_date = post_value ('end_date');
		
		$routplan = $this->Mydb->get_record('start_date, end_date, is_reschedule', 'sramcms_routeplan', array('id' => $id));
		$routlist = $this->Mydb->custom_query("SELECT id, start_date, end_date FROM sramcms_routeplan WHERE is_active = '1' AND id!='".$id."'");
		
		foreach($routlist as $plan){
						
			if($plan['start_date'] <= $start_date && $start_date <= $plan['end_date'] || $plan['start_date'] <= $end_date && $end_date <= $plan['end_date']) {
				$status = '0';
			}else{
				$status = '1';
			}
		}
		if($status == '1'){
			$eventreschdule = $this->Mydb->update('sramcms_routeplan', array('id' => $id), array('is_reschedule' => '1', 'start_date' => $start_date, 'end_date' => $end_date));
			$result = array( 'success'=> 1 , 'message'=> 'Program reschdule is success');
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Your program date already exit. please try again');
		}
		
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin appointment list method*/
	public function appointmentlist_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentlist'] = $this->Mydb->custom_query("SELECT id, name, email, phone_no, location, DATE_FORMAT(booked_date, '%d-%M-%Y') AS appointment_date, DATE_FORMAT(appointment_start_time, '%H:%i') AS appointment_time FROM sramcms_event_users WHERE event_id = '".$event_id."' ");				
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
	/*Admin appointment details method*/
	public function appointmentdetails_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$data['appointmentdetails'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.purpose_of_appointment, ap.message AS short_message, ap.message AS long_message, ap.location, ap.location_date, DATE_FORMAT(ap.booked_date, '%d-%M-%Y') AS appointment_date, DATE_FORMAT(ap.appointment_start_time, '%H:%i') AS appointment_time, r.trip_name AS event_name, r.destinations AS event_location, DATE_FORMAT(r.start_date, '%d-%M-%Y') AS event_date FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id WHERE ap.id = '".$id."' ");
				
								
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
	
	/*Admin appointment reschdule method*/
	public function appointmentreschdule_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		$id = post_value('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){			
				$data['appointmentdetails'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.purpose_of_appointment, ap.message AS short_message, ap.message AS long_message, ap.location, ap.location_date, DATE_FORMAT(ap.booked_date, '%d-%M-%Y') AS appointment_date, DATE_FORMAT(ap.appointment_start_time, '%H:%i') AS appointment_time, r.trip_name AS event_name, r.destinations AS event_location, DATE_FORMAT(r.start_date, '%d-%M-%Y') AS event_date FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id WHERE ap.event_id = '".$event_id."' AND ap.id = '".$id."' ");
					
				$appointment = $this->Mydb->custom_query("SELECT ap.appointment_date, r.end_date FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id WHERE ap.event_id = '".$event_id."'  AND ap.id ='".$id."' ");
				
				$appointment_list = $this->Mydb->custom_query("SELECT ap.appointment_date, r.end_date FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id WHERE ap.event_id = '".$event_id."'  AND ap.id !='".$id."' AND ap.appointment_date !='0000-00-00'");
				$appointment_date = new DateTime($appointment[0]['appointment_date']);
				$end_date = new DateTime($appointment[0]['end_date'].' +1 day');
				$daterange = new DatePeriod($appointment_date, new DateInterval('P1D'), $end_date);
				
				
				foreach($daterange as $date){
					$total_date[] = $date->format("Y-m-d");
					$total_check = $date->format("Y-m-d");
					foreach($appointment_list as $list){
						$i=1;
						if($total_check == $list['appointment_date']){
							$available[$list['appointment_date']][] = $i; 
						}
						$i++;
					}
					$final[$total_check] = count($available[$total_check]);
					
				}
				$data['date_list'] = $final;
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
	/*Admin appointment reschdule method*/
	public function appointmentreschduleform_post(){
		$oauth_token = post_value ( 'oauth_token' );
	
		$id = post_value('id');
		$appointment_date = post_value('appointment_date');
		
		$eventreschdule = $this->Mydb->update('sramcms_event_users', array('id' => $id), array('is_reschedule' => '1', 'is_cancel' => '0', 'appointment_date' => $appointment_date));
		$result = array( 'success'=> 1 , 'message'=> 'Appointment reschdule is success');
		
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin appointment tripname list method*/
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
	/*Admin appointment manage method*/
	public function appointmentmanage_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if(!empty($event_id)){
			$event = "WHERE ap.event_id = '".$event_id."'";
		}else{
			$event = " ";
		}
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$data['appoinrmentmanage'] = $this->Mydb->custom_query("SELECT ap.id, SUM(CASE WHEN (ap.appointment_date ='0000-00-00' AND ap.is_cancel !='1') THEN 1 ELSE 0 END) as prnding, SUM(CASE WHEN (ap.appointment_date !='0000-00-00' AND ap.is_cancel !='1') THEN 1 ELSE 0 END) as confirm, SUM(CASE WHEN ap.is_cancel ='1' THEN 1 ELSE 0 END) as cancel, SUM(CASE WHEN (ap.id !='') THEN 1 ELSE 0 END) as archived,  r.trip_name AS event_name, r.destinations AS event_location FROM sramcms_event_users AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id  ".$event." ");
								
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
	/*Admin appointment pending method*/
	public function appointmentpending_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if(!empty($event_id)){
			$event = " AND ap.event_id = '".$event_id."'";
		}else{
			$event = " ";
		}
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentpending'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.location,  r.trip_name AS event_name, r.destinations AS event_location FROM sramcms_event_users  AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id 
				WHERE ap.appointment_date ='0000-00-00' AND ap.is_cancel = '0' ".$event." ");	
				$data['pending'] = count($data['appointmentlist']);
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Pending Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin appointment cancel method*/
	public function appointmentcancel_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if(!empty($event_id)){
			$event = " AND ap.event_id = '".$event_id."'";
		}else{
			$event = " ";
		}
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentcancel'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.location,  r.trip_name AS event_name, r.destinations AS event_location FROM sramcms_event_users  AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id 
				WHERE  ap.is_cancel = '1' ".$event." ");	
				$data['cancel'] = count($data['appointmentlist']);
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Cancel Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	/*Admin appointment confirm form method*/
	public function appointmentconfirmform_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value('id');
		
		$appointment_date = date("Y-m-d", strtotime(post_value('appointment_date')));
		
		$eventreschdule = $this->Mydb->update('sramcms_event_users', array('id' => $id), array('appointment_date' => $appointment_date, 'is_cancel' => '0'));
		$result = array( 'success'=> 1 , 'message'=> 'Appointment confirm is success');
		
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin appointment cancel form method*/
	public function appointmentcancelform_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value('id');
		
		
		$eventreschdule = $this->Mydb->update('sramcms_event_users',array('id' => $id), array('is_cancel' => '1'));
		$result = array( 'success'=> 1 , 'message'=> 'Appointment cancel is success');
		
		echo $response = json_encode($result);
		return TRUE;
	}
	
	/*Admin appointment confirm method*/
	public function appointmentconfirm_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if(!empty($event_id)){
			$event = " AND ap.event_id = '".$event_id."'";
		}else{
			$event = " ";
		}
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentconfirm'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.location,  r.trip_name AS event_name, r.destinations AS event_location FROM sramcms_event_users  AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id 
				WHERE  ap.appointment_date !='0000-00-00' AND ap.is_cancel = '0' ".$event."  ");	
				$data['confirm'] = count($data['appointmentlist']);
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Confirm Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin appointment archived method*/
	public function appointmentarchived_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$event_id = post_value ('event_id');
		if(!empty($event_id)){
			$event = " AND ap.event_id = '".$event_id."'";
		}else{
			$event = " ";
		}
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['appointmentarchived'] = $this->Mydb->custom_query("SELECT ap.id, ap.name, ap.email, ap.phone_no, ap.location,  r.trip_name AS event_name, r.destinations AS event_location FROM sramcms_event_users  AS ap
				LEFT JOIN sramcms_routeplan AS r ON r.id = ap.event_id 
				WHERE r.end_date < NOW() ".$event."  ");	
				$data['confirm'] = count($data['appointmentlist']);
				$result = array( 'success'=> 1 , 'message'=> 'Appointment Confirm Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	/*Admin feedback list method*/
	public function feedback_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['feedback'] = $this->Mydb->custom_query("SELECT id, CONCAT(firstname, ' ', lastname) AS name, email, phone,  DATE_FORMAT(created, '%d-%M-%Y') AS submited_date, DATE_FORMAT(created, '%H:%i') AS submited_time, HOUR(TIMEDIFF(created,NOW())) AS totalHour FROM sramcms_feedback  ORDER BY id DESC ");
				
				$result = array( 'success'=> 1 , 'message'=> 'Feedback Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin feedback detail method*/
	public function feedbackdetail_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value ( 'id' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['feedbackdetail'][] = $this->Mydb->get_record('id,firstname, lastname, email, phone, message_text, DATE_FORMAT(created, "%d-%M-%Y") AS submited_date, DATE_FORMAT(created, "%H:%i") AS submited_time', $this->feedback, array('id' => $id));
				$result = array( 'success'=> 1 , 'message'=> 'Feedback details', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin feedback reply method*/
	public function feedbackreply_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value ( 'id' );
		$reply_message = post_value ( 'reply_message' );
		if($oauth_token != ''){
			
			$feedback_data = $this->Mydb->get_record('id,firstname, lastname, email, phone, message_text', $this->feedback,array('id' => $id));
			$name = $feedback_data['firstname'].' '.$feedback_data['lastname'];
			$to_email = $feedback_data['email'];
			$content = $feedback_data['message_text'];
			$reply_content = $reply_message;
			$response = $this->send_feedback_reply($name, $to_email, $content, $reply_content);
			if($response){
				$this->Mydb->update($this->feedback, array('reply_message' => $reply_message, array('id' => $feedback_data['id'])));
				$result = array( 'success'=> 1 , 'message'=> 'feedback reply mail is sent');
			}else{
				$result = array( 'success'=> 0, 'message'=> 'feedback reply mail is not sent');
			}
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*feedback email function*/
	public function send_feedback_reply($name, $to_email, $content, $reply_content) {

        $chk_arr = array('[NAME]', '[CONTENT]', '[REPLYCONTENT]');
        $rep_arr = array($name, $content, $reply_content);
        $response = send_email($to_email, $template_slug = "feedback-reply", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response;
    }
	/*Admin photo of the day list method*/
	public function photooftheday_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$image_path = media_url();
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$photooftheday = $this->Mydb->custom_query("SELECT id, date, image FROM sramcms_photo_oftheday WHERE is_active = '1' ORDER BY id DESC ");
				foreach($photooftheday as $photooftheday_row){
					
					$image_array = json_decode($photooftheday_row['image']);
					$photooftheday_image[] = array( 'photooftheday_image' => $image_path.$image_array->files[0]);
					
				}
				foreach($photooftheday as $key => $value){
					$data['photolist'][] = array_merge($photooftheday_image[$key], $photooftheday[$key]);
				}
				
				$result = array( 'success'=> 1 , 'message'=> 'Photo of the day Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}

	/*Admin photo of the day add method*/
	public function photooftheadd_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$this->form_validation->set_rules ( 'title', 'lang:title', 'trim|required' );
				
				
				if ($this->form_validation->run () == TRUE) {
					
					if(!empty($_FILES['mediaFiles']['name'])){
						$create_folder = 'photooftheday/media/' . date("Y/m", strtotime("now")) . "/";
						create_folder($create_folder);
						
						$config['upload_path'] = 'media/photooftheday/media/'.date("Y/m", strtotime("now"))."/";
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['file_name'] = 'app-photooftheday-'.time().str_replace(' ', '-', $_FILES['mediaFiles']['name']);
						
						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						
						if($this->upload->do_upload('mediaFiles')){
							$uploadData = $this->upload->data();
							$mediaFiles = 'photooftheday/media/'.date('Y/m', strtotime('now')).'/'.$uploadData['file_name'];
						}else{
							$mediaFiles = '';
						}
					}else{
						$mediaFiles = '';
					}
					
					$insert_data = array(
						"title" => str_replace("+", " ", $this->input->post('title')),
						 "date" => get_date_formart($this->input->post('date'), 'Y-m-d'),
						"image" => json_encode(array('files' => array($mediaFiles))),
						 "created_on" => current_date(),
						 "created_ip" => get_ip(),
						 "created_by" => $data['admin']['admin_id'],									
						 "is_active" => '1',
						);
						
					
					$photooftheday = $this->Mydb->insert($this->photooftheday,$insert_data);	
					
					if($photooftheday !=''){
						$result = array( 'success'=> 1 , 'message' => 'Photo of the day added succesfully');
					}else{
						$result = array( 'success'=> 0 , 'message' => 'Photo of the day is not added');
					}
					
				}else{
					$result = array( 'success'=> 0 , 'message' => 'Please Enter All fields');
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
	
	/*Admin newsletter list method*/
	public function newsletter_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['newsletter'] = $this->Mydb->get_all_records('id,first_name', $this->newsletter,$where=null, $limit = '', $offset = '', array('id' => 'DESC'),$like='', $groupby = '', $join='');
				
				$result = array( 'success'=> 1 , 'message'=> 'Newsletter Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	/*Admin newsletter detail method*/
	public function newsletterdetail_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$Subscribe = 'Subscribe';
		$Unsubscribe ='Unsubscribe';
		$id = post_value ( 'id' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['newsletterdetail'] = $this->Mydb->custom_query("SELECT id, first_name, last_name, email, CASE WHEN status !='0' THEN '$Subscribe' ELSE '$Unsubscribe' END AS status FROM sramcms_newsletter WHERE id = '".$id."' ");
				
				$result = array( 'success'=> 1 , 'message'=> 'Newsletter details', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	/*Admin enquiry list method*/
	public function enquirylist_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$feedback = $this->Mydb->get_all_records('id', $this->feedback);
				$data['feedback'] = count($feedback);
				$booking = $this->Mydb->get_all_records('id', 'sramcms_event_users', array('is_active' => '1', 'is_delete' => '0', 'is_cancel' => '0'));
				$data['booking'] = count($booking);
				
				$result = array( 'success'=> 1 , 'message'=> 'Newsletter Lisiting', 'data' => $data);
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
			}
			
			
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	
	/*Admin album and gallery add image, video method*/
	public function galleryadd_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				if (isset($_FILES)) {
					
					$gallery_category_id = post_value('id');
					$name = str_replace("+", " ", post_value('name'));
					$slug= url_title($name, '-',TRUE);		
					$media_type = post_value('media_type');
					
					if($gallery_category_id != 'A'){
						
						if($media_type == '1'){
							$create_folder = 'gallery/medias/images/'. date("Y/m", strtotime("now")) . "/";
							create_folder($create_folder);	
						}elseif($media_type == '2'){
							$create_folder = 'gallery/medias/videos/'. date("Y/m", strtotime("now")) . "/";
							create_folder($create_folder);	
						}
						
						$files['gallery'] = $this->upload_multiple_files($create_folder, $_FILES['file']);
						
						foreach($files['gallery'] as $gallery_list){
							$gallery = $this->Mydb->insert('sramcms_galleries', array('media_type' => $media_type, 'gallery_category_id' => $gallery_category_id, 'is_active' => '1', 'created_on' => current_date (), 'file_name' => $create_folder.$gallery_list));
						}
						
						$result = array( 'success'=> 1 , 'message'=> 'Gallery Album Added Success', 'data' => $data);
						
					}else{
						
						if($media_type == '1'){
							$create_folder = 'gallery/medias/images/'. date("Y/m", strtotime("now")) . "/";
							create_folder($create_folder);	
						}elseif($media_type == '2'){
							$create_folder = 'gallery/medias/videos/'. date("Y/m", strtotime("now")) . "/";
							create_folder($create_folder);	
						}	
						
						$create_folder_1 = 'gallery/categories/'. date("Y/m", strtotime("now")) . "/";
						create_folder($create_folder_1);
						
						$files['gallery'] = $this->upload_multiple_files($create_folder, $_FILES['file']);
						$files['category'] = $this->upload_single_files($create_folder_1, $_FILES['file']);
						
						
						if($media_type == '1'){
							$category = $create_folder_1.$files['category'][0];
						}elseif($media_type == '2'){
							$category = '';
						}
						$gallery_insert = $this->Mydb->insert('sramcms_gallary_categories', array('name' => $name, 'slug' => $slug, 'is_active' => '1', 'created_on' => current_date (), 'category_image' => $category));
						
						
						foreach($files['gallery'] as $gallery_list){
							$gallery = $this->Mydb->insert('sramcms_galleries', array('media_type' => $media_type, 'gallery_category_id' => $gallery_insert, 'is_active' => '1', 'created_on' => current_date (), 'file_name' => $create_folder.$gallery_list));
							
						}
						
						$result = array( 'success'=> 1 , 'message'=> 'Gallery Album Added Success', 'data' => $data);
						
					}
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
	
	public function upload_multiple_files($path, $files)
    {
    	$this->load->library('upload', $config);
    	$images = array();
		
    	foreach ($files['name'] as $key => $media_file) {
    		$config['upload_path'] = FCPATH . 'media/' . $path;
    		$config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf|csv|xlsx|mp3|aac|ogg|wma|m4a|flac|wac|mp4|avi|mpg|mov|wmv|mkv|m4v|webm|flv|3gp';
    		$_FILES['mediafiles']['name']= $files['name'][$key];
    		$_FILES['mediafiles']['type']= $files['type'][$key];
    		$_FILES['mediafiles']['tmp_name']= $files['tmp_name'][$key];
    		$_FILES['mediafiles']['error']= $files['error'][$key];
    		$_FILES['mediafiles']['size']= $files['size'][$key];
    		$file_info = pathinfo($_FILES['mediafiles']['name']);
    		$extension = $file_info['extension'];
    		$file_name_slug = url_title($file_info['filename'], '_');
    		$file_name = $file_name_slug . "_" . time() . "." . $extension;
    		$mediafiles[] = $file_name;
    		$config['file_name'] = $file_name;
    		$this->upload->initialize($config);
    		if ($this->upload->do_upload('mediafiles')) {
    			$this->upload->data();
				
    		} else {
    			return false;
    		}
    	}
    	
    	return $mediafiles;
    }
	public function upload_single_files($path_single, $files_single)
    {
    	
    	$this->load->library('upload', $config_single);
    	$images_single = array();
		$config_single['upload_path'] = FCPATH . 'media/' . $path_single;
		$config_single ['allowed_types'] = 'gif|jpg|jpeg|png|pdf|csv|xlsx|mp3|aac|ogg|wma|m4a|flac|wac|mp4|avi|mpg|mov|wmv|mkv|m4v|webm|flv|3gp';
		$_FILES['mediafiles_single']['name']= $files_single['name'][1];
		$_FILES['mediafiles_single']['type']= $files_single['type'][1];
		$_FILES['mediafiles_single']['tmp_name']= $files_single['tmp_name'][1];
		$_FILES['mediafiles_single']['error']= $files_single['error'][1];
		$_FILES['mediafiles_single']['size']= $files_single['size'][1];
		$file_info_single = pathinfo($_FILES['mediafiles_single']['name']);
		$extension_single = $file_info_single['extension'];
		$file_single_name_slug = url_title($file_info_single['filename'], '_');
		$file_single_name = $file_single_name_slug . "_" . time(). "." . $extension_single;
		$mediafiles_single[] = $file_single_name;
		$config_single['file_single_name'] = $file_single_name;
		$category = $this->upload->initialize($config_single);

		if ($this->upload->do_upload('mediafiles_single')) {
			$this->upload->data();
		} else {
			return false;
		}
    	return $mediafiles_single;
    }
	/*Admin Gallery album name list method*/
	function albumname_post()
	{
		
	
		$records = "";
		$data=array();
		$select = "id,name";
		$where =" is_active=1  ";
		$records = $this->Mydb->get_all_records($select,'sramcms_gallary_categories',$where);
		if(!empty($records))
		{
			$data['albumname'][] = array( 'id' => 'A', 'name' => stripslashes('new album'));
			foreach($records as $value)
			{
				$data['albumname'][] = array( 'id' => $value['id'], 'name' => stripslashes($value['name']));
			}
			$result = array( 'success'=> 1 , 'message'=> 'Success', 'data'=>$data);
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Tour List','data'=>$data);
		}
		echo $response = json_encode($result);
		return TRUE;
		
	}
	/* Dashboard  Count For User Refresh*/
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
	
	function generateUniqueId($n) {
        $availableCharacters = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $id = "";
        for ($i = 0; $i < $n; $i++) {
            $id .= substr($availableCharacters, rand(0, strlen($availableCharacters) - 1), 1);
        }
        return $id;
    }
	/*Admin enquiry list method*/
	public function routeadd_post(){
		
		$oauth_token = post_value ( 'oauth_token' );
		$this->form_validation->set_rules ( 'trip_name', 'trip_name', 'required|trim' );
		$this->form_validation->set_rules ( 'description', 'description', 'required|trim' );
		$this->form_validation->set_rules ( 'start_date', 'start_date', 'required|trim' );
		$this->form_validation->set_rules ( 'end_date', 'end_date', 'required|trim' );
		$this->form_validation->set_rules ( 'destinations[]', 'destinations', 'required|trim' );
		if ($this->form_validation->run ( $this ) == TRUE) {
		
			if($oauth_token != ''){
				$data['admin'] = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
				
				if(!empty($data['admin'])){
					$id = $this->generateUniqueId(20);
					$check_exist = $this->Mydb->get_record ('map_id',$this->routeplan_table,array ('map_id'  => $id));
					if($check_exist['map_id']){
						$id = $this->generateUniqueId(20);
					}
					
					$get_destinations = $this->input->post('destinations');
					$trip_name   = post_value('trip_name');
					$description = post_value('description');
					$start_date  = post_value('start_date');
					$end_date    = post_value('end_date');
					
					$plan_details= implode('-', $get_destinations);
					$destinations= implode('|*|', $get_destinations);
					$insert_array = array(
						'start_date' => date('Y-m-d', strtotime($start_date)),
						'end_date' => date('Y-m-d', strtotime($end_date)),
						'map_id' => $id,
						'trip_name' => $trip_name,
						'plan_details' => $plan_details,
						'description' => $description,
						'destinations' => $destinations,
						'type' => 'directions',
						'created_on' => current_date(),
						'created_ip' => get_ip(),
						'created_by' => $data['admin']['admin_id'],
						'is_visible' => '1',
						'is_active' => 1);
					
					$list = array(
						 "name" => "Jeevanacharya Route Plan",
						 "description" => "Jeevanacharya Route Plan",					 
						 "layers" => array(
									array("name" => $trip_name, "isVisible" => true, "isVisible" => true, "isExpanded" => true,  "shapes" => array(array("name" => $plan_details,
									"description" => $description,
									"type" => "directions",
									"startdate" => date('Y-m-d', strtotime($start_date)),
									"enddate" => date('Y-m-d', strtotime($end_date)),
									"destinations" => $get_destinations,
									"avoidHighways" => false,
									"avoidTolls" => false
									)), 						
								 )),
								 "selectedLayerId" => 0,
								 "mapPosition" => "5.49549987804796,102.96690710937501,8,roadmap",
						);
				
					$jsonData = json_encode($list);
					
					$insert_id = $this->Mydb->insert($this->routeplan_table, $insert_array);
					
					$f = fopen(FCPATH . "/media/maps/" .$id. ".json", "w");
					fwrite($f, $jsonData);
					fclose($f);
					
					$result = array( 'success'=> 1 , 'message'=> 'Route Plan Added Successfully');
				}else{
					$result = array( 'success'=> 0 , 'message'=> 'Oauth Token is not found');
				}
				
				
			}else{
				$result = array( 'success'=> 0 , 'message'=> 'Enter Oauth token');
			}
		}else{
			$result = array( 'success'=> 0 , 'message'=> 'Enter All Fields');
		}
		echo $response = json_encode($result);
		return TRUE;
	}
	

}
