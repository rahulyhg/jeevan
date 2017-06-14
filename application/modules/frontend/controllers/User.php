<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 25 Feb, 2016
Description		: Page contains company add edit and delete functions..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "user";
		$this->module_label = get_label ( 'user_module_label' );
		$this->module_labels = get_label ( 'user_module_label' );
		$this->folder = "user/";
		$this->table = "master_admin";
		$this->countries_table = "countries";
		$this->login_history = "master_admin_login_history";
		$this->load->library ( 'common' );
		$this->load->library('email');
		$this->primary_key = 'id';
		$config = Array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->helper('smstemplate');
		$this->load->helper('emailtemplate');
	}
	
	public function index() {

        $data = $this->load_module_info();
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);

        $user_id = get_session_value('current_user_id');

        if ($user_id != '') {

            $get_user_data = $this->Mydb->get_record('*', $this->table, array($this->primary_key => $user_id));
			
			$profile_total = $this->Mydb->custom_query("SELECT  sum((u.email IS NOT NULL and u.email <> '') + (u.password IS NOT NULL and u.password <> '') +  (u.first_name IS NOT NULL and u.first_name <> '') + (u.last_name IS NOT NULL and u.last_name <> '') + (u.phone IS NOT NULL and u.phone <> '') + (u.address IS NOT NULL and u.address <> '') + (u.aadhaar_no IS NOT NULL and u.aadhaar_no <> '') + (u.aadhar_image IS NOT NULL and u.aadhar_image <> '') + (u.photo IS NOT NULL and u.photo <> '') ) as total from $this->table AS u WHERE u.id = '".$user_id."' ");
			 $data['profile_complete'] =  round($profile_total[0]['total'] * 100 / 9);			
			
            $data['profile'] = $this->Mydb->get_record('*', $this->user_profile_table, array('user_id' => $user_id));
            $data['relation'] = $this->Mydb->get_record('*', $this->user_role_relations_table, array('user_id' => $user_id));
            $data['country'] = $this->Mydb->get_record('name,phonecode', $this->countries_table, array('id' => $data['relation']['country_id']));
            $data['state'] = $this->Mydb->get_record('name', $this->state_table, array('id' => $data['relation']['state_id']));
            $data['district'] = $this->Mydb->get_record('name', $this->district_table, array('id' => $data['relation']['district_id']));
            $data['constituencies'] = $this->Mydb->get_record('name', $this->constituencies_table, array('id' => $data['relation']['constituency_id']));

            $newscount_list_emp = $this->Mydb->get_all_records('media_type_id, created_by', $this->news, array('created_by' => $user_id, 'is_active' => '1', 'is_delete' => '0'));

            foreach ($newscount_list_emp as $newscount_emp) {
                if ($newscount_emp['media_type_id'] == '1') {
                    $text_upload_emp[] = $newscount_emp['media_type_id'];
                }if ($newscount_emp['media_type_id'] == '2') {
                    $image_upload_emp[] = $newscount_emp['media_type_id'];
                }if ($newscount_emp['media_type_id'] == '3') {
                    $audio_upload_emp[] = $newscount_emp['media_type_id'];
                }if ($newscount_emp['media_type_id'] == '4') {
                    $video_upload_emp[] = $newscount_emp['media_type_id'];
                }
            }

            $data['text_count_emp'] = (count($text_upload_emp) / 100) * 100;
            $data['image_count_emp'] = (count($image_upload_emp) / 100) * 100;
            $data['audio_count_emp'] = (count($audio_upload_emp) / 100) * 100;
            $data['video_count_emp'] = (count($video_upload_emp) / 100) * 100;
            $data['news'] = $this->Mydb->custom_query("SELECT n.id, n.slug, n.status, n.media_type_id, n.short_description, n.title, n.thumbnail_name, m.name as media_name, m.news_media_type, m.thumbnail AS media_thumb FROM news AS n
		LEFT JOIN news_media AS m ON m.news_id = n.id
		WHERE n.created_by = '" . $user_id . "' AND n.is_active = '1' AND n.is_delete = '0' GROUP BY n.id ORDER BY n.id  DESC ");

            if ($get_user_data != '' && !empty($get_user_data)) {

                $data['user'] = $get_user_data;
                $session_datas = array('id' => $get_user_data['id'],
                    'first_name' => $get_user_data['first_name'],
                    'last_name' => $get_user_data['last_name'],
                    'username' => $get_user_data['username'],
                    'phone' => $get_user_data['phone'],
                    'email' => $get_user_data['email'],
                    'photo' => $get_user_data['photo'],
                    'is_active' => $get_user_data['is_active'],
                    'is_mobile_verified' => $get_user_data['is_mobile_verified'],
                    'is_email_verified' => $get_user_data['is_email_verified'],
                    'aadhar_image' => $get_user_data['aadhar_image'],
                    'is_public' => $get_user_data['is_public'],
                );

                $this->session->set_userdata($session_datas);
                $data['module_action'] = 'profile';

                $this->layout->display_frontend($this->folder . $this->module . "-public", $data);
            } else {
                redirect(frontend_url());
            }
        } else {
            $this->layout->display_frontend($this->folder . '/homepage', $data);
        }
    }
	
	
    /* Login */
    public function login() {
		
		
           

            if ($this->input->post('submit') == 'Login') {
                $response = array();
                $alert = "";
                $this->form_validation->set_rules('admin_email_address', 'Email Address', 'required|trim');
                $this->form_validation->set_rules('admin_password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
                if ($this->form_validation->run($this) == TRUE) {
                    $this->mysqli = new mysqli($this->db->hostname, $this->db->username, $this->db->password, $this->db->database);
                    $admin_email_address = $this->mysqli->real_escape_string(trim($this->input->post('admin_email_address')));
                    $admin_password = $this->mysqli->real_escape_string(trim($this->input->post('admin_password')));

                    $check_details = $this->db->query("SELECT * FROM sramcms_master_admin WHERE admin_email_address='" . $admin_email_address . "'  AND 
					admin_status='A'");
                    
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
									$session_datas = array('current_user_id' => $admin_id, 'admin_phone_number' => $row->admin_phone_number, 'admin_email_address' => $row->admin_email_address, 'admin_username' => $row->admin_username, 'admin_firstname' => $row->admin_firstname, 'admin_lastname' => $row->admin_lastname, 'admin_country' => $row->admin_country);
                                	$this->session->set_userdata($session_datas);
									
									
									$response ['status'] = 'success';
                    				$response ['message'] = 'Sucessfully Logged In';
									
								}else{
									$response ['status'] = 'error';
                    				$response ['message'] = 'Password Mismatch';
									
								}
							}else{
								$response ['status'] = 'error';
                    			$response ['message'] = 'Your Account is Admin Control. So Does not login here.';
								
							}
						}else{
							$response ['status'] = 'error';
                    		$response ['message'] = 'Your Account is Disabled.';
						}
					} else {
						$response ['status'] = 'error';
                    	$response ['message'] = 'Account Not Found';
					}
					
					
                } else {
                    $response ['status'] = 'error';
                    $response ['message'] = validation_errors();
                }
                echo json_encode($response);
                exit;
			}
            
    }
	
	
	
	function forgotpassword() {
        if ($this->input->post('submit') == 'Forgot') {   // if ajax submit
            $error = array();
            $alert = '';
            $this->form_validation->set_rules('admin_email_address', 'Email Address', 'required|valid_email|trim');

            if ($this->form_validation->run($this) == TRUE) {

                $email = trim($this->input->post('admin_email_address'));
                $check_details = $this->Mydb->get_record('*', $this->table, array('admin_email_address' => $email));
                $admin_forgot_email = md5(uniqid(rand()));
                $user_forgot_array = array(
                    'admin_forgot_email' => $admin_forgot_email,		
					'admin_forgot' => 'D'
                );
                $update = $this->Mydb->update($this->table, array('admin_id' => $check_details['admin_id']), $user_forgot_array);
                if ($check_details) {
                    if ($check_details ['admin_status'] == 'A') {

                        $name = $check_details ['admin_firstname'] . ' ' . $check_details ['admin_lastname'];
                        $to_email = $check_details ['admin_email_address'];
                        $id = $check_details ['admin_id'];
                        $link = frontend_url('resetpassword/' . $admin_forgot_email);


                        $response = $this->send_forgot_email($name, $to_email, $link);
                        if ($response) {
                            $result ['status'] = 'success';
                            $result ['message'] = 'Reset password email code. please check it mail';
                        } else {
                            $result ['status'] = 'error';
                            $result ['message'] = 'Reset password email code submitted successs. mail is not sent';
                        }
                        echo json_encode($result);
                        exit();
                    } else {
                        $alert = 'account_disabled';
                    }
                } else {
                    $alert = 'acount_not_found';
                }
                $error ['status'] = 'error';
                $error ['message'] = $alert;
            } else {

                $error ['status'] = 'error';
                $error ['message'] = validation_errors();
            }
            echo json_encode($error);
            exit();
        }
       // $this->layout->display_frontend($this->folder . $this->module . '-forgot', $data);
    }
	
	public function send_forgot_email($name, $to_email, $link){
		
			$chk_arr = array('[NAME]','[LINK]');
			$rep_arr = array($name, $link);
			$response = send_email($to_email,$template_slug ="forgot-password",$chk_arr,$rep_arr,$attach_file=array(),$path='', $subject='',$cc='', $html_template = 'email_template');	
			return $response;
	}

   
	
	 public function register() {
        $data = $this->load_module_info();
        if ($this->input->post('action') == "Register") {
			
			//$this->form_validation->set_rules('admin_username', 'lang:username', 'required');
            $this->form_validation->set_rules('admin_firstname', 'lang:firstname', 'required');
            $this->form_validation->set_rules('admin_lastname', 'lang:lastname', 'required');
            $this->form_validation->set_rules('admin_country', 'lang:country', 'required');
            $this->form_validation->set_rules('admin_email_address', 'lang:email', 'required|valid_email|callback_email_exists');
            $this->form_validation->set_rules('admin_phone_number', 'lang:phone', 'required|callback_phone_exists');
			$this->form_validation->set_rules('admin_password', 'lang:password', 'required');

           

            if ($this->form_validation->run() == TRUE) {

                $password = do_bcrypt(post_value('password'));
				$devices_type = 'W';
                $insert_array = array(
                	'admin_username' => post_value('admin_email_address'),
                    'admin_firstname' => post_value('admin_firstname'),
                    'admin_lastname' => post_value('admin_lastname'),
                    'admin_email_address' => post_value('admin_email_address'),
					'admin_devices_type' => $devices_type,
                    'admin_password' => $password,
                    'admin_updated_on' => current_date(),
                    'admin_status'  => 'I',
					'admin_user_type' => '0',
                    'admin_phone_number' => post_value('phone'),
					'admin_country' => post_value('admin_country'),
                    'admin_phone_code' => random_string('numeric',6),
					'admin_email_code' => md5(uniqid(rand()))
                );

                $insert_id = $this->Mydb->insert($this->table, $insert_array);

               
				if(!empty($insert_id)){
					
					$details = $this->Mydb->get_record ('*', $this->table, array ('admin_id' => $insert_id));
					
					$name = $details['admin_firstname'].' '.$details['admin_lastname'];
					$activation_link = frontend_url('accountactivation/'.$details['admin_email_code']);
					$to_email = $details['admin_email_address'];
					
					$response_email = $this->send_activation_email($name, $to_email, $activation_link);
					
					$result ['status'] = 'success';
					$result ['message'] = 'Registration done successfully, Verification Email Sent please check your inbox and activate';
				}else{
					$result ['status'] = 'error';
               		$result ['message'] = 'Registration is not submitted';
				}
            } else {
                $result ['status'] = 'error';
                $result ['message'] = validation_errors();
            }

            echo json_encode($result);
            exit();
        }
    }
	
	public function edit(){
		 $id = get_session_value('current_user_id');	
		  if ($this->input->post('action') == "Edit") {
			
            $this->form_validation->set_rules('admin_firstname', 'lang:firstname', 'required');
            $this->form_validation->set_rules('admin_lastname', 'lang:lastname', 'required');
            $this->form_validation->set_rules('admin_country', 'lang:country', 'required');
            $this->form_validation->set_rules('admin_email_address', 'lang:email', 'required|callback_email_exists');
            $this->form_validation->set_rules('admin_phone_number', 'lang:phone', 'required|callback_phone_exists');


            if ($this->form_validation->run() == TRUE) {
						
                $user_array = array(
                    'admin_firstname' => post_value('admin_firstname'),
                    'admin_lastname' => post_value('admin_lastname'),
                    'admin_email_address' => post_value('admin_email_address'),
                    'admin_updated_on' => current_date(),
                    'admin_phone_number' => post_value('admin_phone_number'),
					'admin_country' => post_value('admin_country'),
                );
				
				if ($_FILES['admin_profile']['name'] != '') {
					
					
                    $config['upload_path'] = 'media/profile/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] =  'profile-' .random_string('numeric',15).'-'. $_FILES['admin_profile']['name'];

                    //Load upload library and initialize configuration
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('admin_profile')) {
                        $uploadData = $this->upload->data();
                        $admin_profile = $uploadData['file_name'];
                    } else {
                        $admin_profile = '';
                    }
                    $image_arr = array(
                        'admin_profile' => $admin_profile
                    );
                    $user_array = array_merge($user_array, $image_arr);
                } else {
					
                    if (post_value('remove_image') == "Yes") {
                        $image_arr = array(
                            'admin_profile' => ''
                        );
                        $user_array = array_merge($user_array, $image_arr);
                    }
                }


                $update = $this->Mydb->update($this->table, array('admin_id' => $id), $user_array);

               redirect(frontend_url().'dashboard/myaccount');
			   
            } else {
                $result ['status'] = 'error';
                $result ['message'] = validation_errors();
            }

            echo json_encode($result);
            exit();
        }
	}
	
	public function send_activation_email($name, $to_email, $activation_link){
		
			$chk_arr = array('[NAME]','[ACTIVATIONLINK]');
			$rep_arr = array($name, $activation_link);
			$response = send_email($to_email,$template_slug ="user-account-activation",$chk_arr,$rep_arr,$attach_file=array(),$path='', $subject='',$cc='', $html_template = 'email_template');
			return $response;
			
	}
	
	
	public function changepassword(){
		$id = get_session_value('current_user_id');
        if ($this->input->post('action') == "Changepassword") {
			
			
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|trim|callback_oldpasswordcheck');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[new_password]');


            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_message('min_length', '%s should be min 6 digits length');

            if ($this->form_validation->run($this) == TRUE) {
				
				
                $selectpass = $this->Mydb->custom_query("select * from sramcms_master_admin where admin_id=$id");
				
                $new_password = do_bcrypt($this->input->post('new_password'));
                $password_verify = check_hash($this->input->post('new_password'), $selectpass[0]['admin_password']);
				
                if ($password_verify == "Yes") {
					
                    $response = array('status' => 'error', 'message' => 'New and current password also a same');
                } else {

                    $this->Mydb->update($this->table, array('admin_id' => $id), array('admin_password' => $new_password));
                    $response = array('status' => 'success', 'message' => 'Your password has been changed. please login again');
                    session_destroy();
				    echo json_encode($response);
           			 exit;
					
                }
//                
//                redirect(frontend_url('login'));
            } else {
				$response = array('status' => 'error', 'message' => validation_errors());
                
            }

            echo json_encode($response);
            exit;
        }
	}

	public function oldpasswordcheck() {
        $old_password = $this->input->post('old_password');
        //$old_password = do_bcrypt($old_password);
        $id = get_session_value('current_user_id');
        $check_details = $this->Mydb->get_record('admin_password', $this->table, array('admin_id' => $id));
        if (!empty($check_details)) {
            $password_verify = check_hash($old_password, $check_details['admin_password']);
            //$this->bcrypt->check_password($old_password, $check_details['org_password']);
            if ($password_verify == "Yes") {
                return true;
            } else {
                $this->form_validation->set_message('oldpasswordcheck', 'Old Password Miss Match');
                return false;
            }
        }
    }

    public function email_exists() {
        $email = $this->input->post('admin_email_address');
		 $id = get_session_value('current_user_id');	
         
		if(!empty($id)){
			 $where = array(
			 	'admin_email_address' => trim($email),
			 	'admin_id !=' => $id
			 );
		}else{
			$where = array(
            'admin_email_address' => trim($email),
                //'is_active' => '1' 
        	);	
		}
        $result = $this->Mydb->get_record('*', $this->table, $where);

        if (!empty($result)) {
            $this->form_validation->set_message('email_exists', 'Email Already exit.');
            return false;
        } else {
            return true;
        }
    }

    public function phone_exists() {
        $phone = $this->input->post('admin_phone_number');
        $id = get_session_value('current_user_id');

       
        if(!empty($id)){
			 $where = array(
			 	'admin_phone_number' => trim($phone),
			 	'admin_id !=' => $id
			 );
		}else{
			 $where = array(
            'admin_phone_number' => trim($phone),
                //'is_active' => '1' 
       		);
		}
        $result = $this->Mydb->get_record('*', $this->table, $where);
        if (!empty($result)) {
            $this->form_validation->set_message('phone_exists', 'Phone number already exit');
            return false;
        } else {
            return true;
        }
    }
	
	public function validate_photo() {
        if (isset($_FILES ['admin_profile'] ['name']) && $_FILES ['admin_profile'] ['name'] != "") {
            if ($this->common->valid_image($_FILES ['admin_profile']) == "No") {
                $this->form_validation->set_message('validate_photo', get_label('upload_valid_image'));
                return false;
            }
        }

        return true;
    }
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
}
