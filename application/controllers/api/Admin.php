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
						$user_data = $this->Mydb->get_record ('oauth_token,admin_id, admin_username,admin_email_address,admin_phone_number',$this->table,array ('admin_id'  => $admin_id));
						$result = array( 'success'=> 1 , 'message'=> 'Sucessfully Logged In', 'data'=> $user_data );
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
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['gallarycategories'] = $this->Mydb->get_all_records('id,name', $this->gallary_categories,$where=null, $limit = '', $offset = '', array('id' => 'DESC'),$like='', $groupby = '', $join='');
				
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
	/*Admin gallery category detail method*/
	public function gallerycategorydetail_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$default_image = media_url('default-image.png');
		$image_path = media_url();
		$id = post_value ( 'id' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['discourse'] = $this->Mydb->custom_query("SELECT id, name, meta_title, meta_keyword, slug, description, meta_description, CASE WHEN category_image !='' THEN CONCAT('".$image_path."', category_image) ELSE '$default_image' END AS category_image FROM sramcms_gallary_categories WHERE id = '".$id."' ");
				
				$result = array( 'success'=> 1 , 'message'=> 'Discourse details', 'data' => $data);
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
	/*Admin gallery category add method*/
	public function gallerycategoryadd_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$this->form_validation->set_rules ( 'name', 'lang:name', 'trim|required' );
				$this->form_validation->set_rules ( 'meta_title', 'lang:meta_title', 'required' );
				$this->form_validation->set_rules ( 'meta_keyword', 'lang:meta_keyword', 'required' );
				$this->form_validation->set_rules ( 'meta_description', 'lang:meta_description', 'required' );
				$slug = create_pageuri(post_value ( 'name' ), $this->gallary_categories, 'slug',array('is_delete !=' => 1));
				
				if ($this->form_validation->run () == TRUE) {
					
					$categoryname_exists 	  =  $this->categoryname_exists($this->gallary_categories,array('name' => $this->input->post('name')));
					
					if(!empty($_FILES['category_image']['name'])){
						$create_folder = 'gallery/categories/'. date("Y/m", strtotime("now")) . "/";
						create_folder($create_folder);
						
						$config['upload_path'] = 'media/gallery/categories/'. date("Y/m", strtotime("now")) . "/";
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['file_name'] = 'app-gallerycategory-'.time().str_replace(' ', '-', $_FILES['category_image']['name']);
						
						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						
						if($this->upload->do_upload('category_image')){
							$uploadData = $this->upload->data();
							$category_image = 'gallery/categories/'. date("Y/m", strtotime("now")) . "/".$uploadData['file_name'];
						}else{
							$category_image = '';
						}
					}else{
						$category_image = '';
					}
					
					$insert_data = array( 
						"created_on" => current_date(),
						"created_by" => $data['admin']['admin_id'],
						"created_ip" => get_ip(),
						"name" => str_replace("+", " ", $this->input->post('name')),
						"meta_title" => str_replace("+", " ", $this->input->post('meta_title')),
						"meta_keyword" => str_replace("+", " ", $this->input->post('meta_keyword')),
						"meta_description" => str_replace("+", " ", $this->input->post('meta_description')),
						"is_order" =>	post_value('is_order') ? post_value('is_order') :'',
						"slug" => $slug,	
						"description" => str_replace("+", " ", post_value('description')) ? post_value('description') :'',	
						"category_image" => $category_image, 
						"is_active" => '1'
					);
				
				
					
					$gallarycategories = $this->Mydb->insert($this->gallary_categories,$insert_data);	
					
					if($gallarycategories !=''){
						$result = array( 'success'=> 1 , 'message' => 'Gallery category added succesfully');
					}else{
						$result = array( 'success'=> 0 , 'message' => 'Gallery category is not added');
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
	/*Admin gallery category edit method*/
	public function gallerycategoryedit_post(){
		$oauth_token = post_value ( 'oauth_token' );
		$id = post_value('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_id,admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				
				$this->form_validation->set_rules ( 'name', 'lang:name', 'trim|required' );
				$this->form_validation->set_rules ( 'meta_title', 'lang:meta_title', 'required' );
				$this->form_validation->set_rules ( 'meta_keyword', 'lang:meta_keyword', 'required' );
				$this->form_validation->set_rules ( 'meta_description', 'lang:meta_description', 'required' );
				$slug = create_pageuri(post_value ( 'name' ), $this->gallary_categories, 'slug',array('is_delete !=' => 1, 'id' => $id));
				
				if ($this->form_validation->run () == TRUE) {
					
					$categoryname_exists 	  =  $this->categoryname_exists($this->gallary_categories,array('name' => $this->input->post('name')));
					
					
					$insert_data = array( 
						"created_on" => current_date(),
						"created_by" => $data['admin']['admin_id'],
						"created_ip" => get_ip(),
						"name" => str_replace("+", " ", $this->input->post('name')),
						"meta_title" => str_replace("+", " ", $this->input->post('meta_title')),
						"meta_keyword" => str_replace("+", " ", $this->input->post('meta_keyword')),
						"meta_description" => str_replace("+", " ", $this->input->post('meta_description')),
						"is_order" =>	post_value('is_order') ? post_value('is_order') :'',
						"slug" => $slug,	
						"description" => str_replace("+", " ", post_value('description')) ? post_value('description') :'',	
						"is_active" => '1'
					);
					
					if(!empty($_FILES['category_image']['name'])){
						$create_folder = 'gallery/categories/'. date("Y/m", strtotime("now")) . "/";
						create_folder($create_folder);
						
						$config['upload_path'] = 'media/gallery/categories/'. date("Y/m", strtotime("now")) . "/";
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['file_name'] = 'app-gallerycategory-'.time().str_replace(' ', '-', $_FILES['category_image']['name']);
						
						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						
						if($this->upload->do_upload('category_image')){
							$uploadData = $this->upload->data();
							$category_image = 'gallery/categories/'. date("Y/m", strtotime("now")) . "/".$uploadData['file_name'];
						}else{
							$category_image = '';
						}
						$image_arr = array( "category_image" => $category_image);
						$update_array = array_merge ( $insert_data, $image_arr );
					}else{
						$category_image = '';
						$update_array = $insert_data;
					}
					
					
				
					$gallarycategories = $this->Mydb->update($this->gallary_categories, array('id' => $id), $update_array);					
					$result = array( 'success'=> 1 , 'message' => 'Gallery category edited succesfully');
					
					
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
	/*Admin event past program method*/
	public function eventpastprogram_post(){
		$oauth_token = post_value ( 'oauth_token' );
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventpastprogram'] = $this->Mydb->custom_query("SELECT trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE end_date < NOW()");				
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
				$data['eventpastprogram'] = $this->Mydb->custom_query("SELECT trip_name, start_date, end_date, destinations, created_on FROM sramcms_routeplan WHERE end_date > NOW()");				
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
		$id = post_value ('id');
		if($oauth_token != ''){
			$data['admin'] = $this->Mydb->get_record ('admin_username,admin_email_address,admin_phone_number',$this->table,array ('oauth_token'  => $oauth_token));
			if(!empty($data['admin'])){
				$data['eventdetail'] = $this->Mydb->custom_query("SELECT r.start_date, r.map_id, r.end_date, r.trip_name, r.description, r.destinations, r.plan_details, r.created_on, count(eu.event_id) AS appointment FROM sramcms_routeplan AS r
				LEFT JOIN sramcms_event_users AS eu ON  eu.event_id = r.id
				WHERE r.id = '".$id."' ");		
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
				$data['feedback'] = $this->Mydb->get_record('id,firstname, lastname, email, phone, message_text, DATE_FORMAT(created, "%d-%M-%Y") AS submited_date, DATE_FORMAT(created, "%H:%i") AS submited_time', $this->feedback, array('id' => $id));
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
	

}
