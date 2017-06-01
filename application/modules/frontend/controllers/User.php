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
		$this->login_history_table = "master_admin_login_history";
		$this->load->library ( 'common' );
		$this->load->library('email');
		$this->primary_key = 'id';
		$this->load->helper('emailtemplate');
	}
	
	/* this method used to list all company . */
	public function index() {
		
		$data = $this->load_module_info ();
		$user_id = get_session_value('current_user_id');
		$get_user_data = $this->Mydb->get_record (
							'user_id,user_name,user_username,user_password,user_email_address,user_profile_image,	   user_folder_name,user_credit_points,user_status,user_referral_id', 
							$this->table,
							array ($this->primary_key  => $user_id)
						);
		if($get_user_data !='' && !empty($get_user_data)){
			$data['user'] = $get_user_data;
			$session_datas = array( 'user_id'    		  => $get_user_data['user_id'],
									'user_name'    		  => $get_user_data['user_name'],
									'user_username'		  => $get_user_data['user_username'],
									'user_referral_code'  => $get_user_data['user_referral_id'],
									'user_credit_points'  => $get_user_data['user_credit_points'],
									'user_email_address'  => $get_user_data['user_email_address'],
									'user_profile_image'  => $get_user_data['user_profile_image'],
									'user_folder_name'    => $get_user_data['user_folder_name']
								  );
			$this->session->set_userdata($session_datas);
			$data['module_action'] = 'sendreferral'; 
			$this->layout->display_frontend ( $this->folder . $this->module . "-landing", $data );
			
		}else{
			redirect(frontend_url());
			
		}				
		
	}
	/* This method used to user login */

	public function login(){

		if ($this->input->post ( 'action' ) == 'Login') 		// if ajax submit

		{

			$response = array ();

			$alert = "";

			$this->form_validation->set_rules ( 'email_address', 'email_address', 'required|trim' );

			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim' );

			if ($this->form_validation->run ( $this ) == TRUE) {

				

				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );

				$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );

				$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'email_address' ) ) );



				$check_details = $this->Mydb->get_record ('*', 

								$this->user_table,

								array ('email_address'  => $username)

								);

							

				

				if ($check_details)

				{

					if ($check_details['status'] == 'A'){

							

						$password_verify = check_hash($password,$check_details['password']);

							

						if($password_verify == "Yes")

						{

							$user_id = $check_details['id'];							

							$session_datas = array( 'current_user_id'     => $user_id, 'phone_number' => $check_details['phone_number'], 'email' => $check_details['email_address'], 'first_name' => $check_details['first_name'], 'last_name' => $check_details['last_name']);

							$this->session->set_userdata($session_datas);

												

							/* store last login details...*/

							$this->Mydb->insert($this->login_history_table,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_user_id'=>$user_id));

				

							echo json_encode ( array('status'=>'success') ); exit;

				

						}	else{

							$alert = 'acount_login_missmatch';

						}

					}

					else{

						$alert = 'account_disabled';

					}

				}

				else

				{

					$alert = 'acount_not_found';

						

				}

				

				$response ['status'] = 'error';

				$response ['message'] = get_label ( $alert );

				

				

				

			} else {

				$response ['status'] = 'error';

				$response ['message'] = validation_errors ();

			}

			echo json_encode ( $response ); exit;

		}

		

		

	} 
	
	function forgotpassword() {
        if ($this->input->post('submit') == 'Forgot') {   // if ajax submit
            $error = array();
            $alert = '';
            $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|trim');

            if ($this->form_validation->run($this) == TRUE) {

                $email_address = trim($this->input->post('email_address'));
                $check_details = $this->Mydb->get_record('id, first_name, last_name, email_address, status, is_email_verified', 'sramcms_users', array('email_address' => $email_address));
                $forgot = md5(uniqid(rand()));
                $user_forgot_array = array(
                    'forgot' => $forgot,
                );
                $update = $this->Mydb->update('sramcms_users', array('id' => $check_details['id']), $user_forgot_array);
                if ($check_details && $update) {
                    if ($check_details ['status'] == 'A') {

                        $name = $check_details ['first_name'] . ' ' . $check_details ['last_name'];
                        $to_email = $check_details ['email_address'];
                        $id = $check_details ['id'];
                        $link = frontend_url('forums/resetpassword/' . $forgot);


                        $response = $this->send_forgot_email($name, $to_email, $link);
                        if ($response) {
                            $result ['status'] = 'success';
                            $result ['message'] = 'Email Sent';
                        } else {
                            $result ['status'] = 'error';
                            $result ['message'] = 'Email Not Sent';
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
	
	
	 /* User Forgot Email */

    public function send_forgot_email($name, $to_email, $link) {

        $chk_arr = array('[NAME]', '[LINK]');
        $rep_arr = array($name, $link);
        $response = send_email($to_email, $template_slug = "forgot-password", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response;
    }
	
	
    public function resetpassword($key = NULL) {
		
		
        if (empty(get_session_value('current_user_id'))) {
           
            

            if ($this->input->post('action') == 'Reset') {   // if ajax submit
                $error = array();
                $alert = '';
                $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[new_password]');

                if ($this->form_validation->run($this) == TRUE) {
                    $key = $this->input->post('key');
					
					
                    if ($key != "") {
                        $mailpassword = $this->input->post('new_password');
                        $password = do_bcrypt(post_value('new_password'));
						
						
                        $password_array = array(
                            'password' => $password,
                        );
						
						
						
                        $update = $this->Mydb->update('sramcms_users', array('forgot' => $key), $password_array);
						
                        if ($update) {
                            $result ['status'] = 'success';
                            $result ['message'] = 'Your Reset password success Please login here';
                        } else {
                            $result ['status'] = 'error';
                            $result ['message'] = 'Reser Password Not Successfully';
                        }
                        echo json_encode($result);
                        exit();
                    } else {
                        $alert = 'Key is empty';
                        $error ['status'] = 'error';
                        $error ['message'] = $alert;
                    }
                } else {

                    $error ['status'] = 'error';
                    $error ['message'] = validation_errors();
                }

                echo json_encode($error);
                exit();
            }
            $key = $this->uri->segment(4);
            $data ['key'] = $key;
            $this->load->view('forums/resetpassword', $data);
        } else {
            redirect(site_url());
        }
    }

    /* This method used to new User Registration . */

	public function register() {

		

		

		$data = $this->load_module_info ();

	    /* form submit */

		if ($this->input->post ( 'action' ) == "Register") {

			form_check_ajax_request (); /* skip direct access */

			

			$this->form_validation->set_rules ( 'first_name', 'lang:firt_name', 'required' );

			$this->form_validation->set_rules ( 'last_name', 'lang:last_name', 'required' );

			$this->form_validation->set_rules ( 'password', 'lang:password', 'required' );

			$this->form_validation->set_rules ( 'email_address', 'lang:user_email', 'required|valid_email|valid_email|callback_email_exists' );

			

			if ($this->form_validation->run () == TRUE) {

				

				$password = do_bcrypt(post_value('password'));

				

				

				$insert_array = array (

						'first_name' => post_value ( 'first_name' ),

						'last_name' => post_value ( 'last_name' ),

						'email_address' => post_value ( 'email_address' ),

						'password' => $password,

						'status' => 'I',

						'email_active_code' => md5(uniqid(rand())),

						'created_on' => current_date (),

						'created_ip' => get_ip () 

				);

				

				$insert_id = $this->Mydb->insert ( $this->user_table, $insert_array );

				

				$session_datas = array('current_user_id' => $insert_id);

		

				$this->session->set_userdata($session_datas);

				$user_details = $this->Mydb->get_record('*', $this->user_table, array('id' => $insert_id));



                $name = $user_details['first_name'] . ' ' . $user_details['last_name'];

                $activation_link = frontend_url($this->module.'/email/' . $user_details['email_active_code']);

                $to_email = $user_details['email_address'];



                $response = $this->send_activation_email($name, $to_email, $activation_link);

                if ($response) {

                    $result ['mail'] = 'success';

                } else {

                    $result ['mail'] = 'error';

                }



                $result ['message'] = 'Congratulations! You have been registered successfully on Baleka Mbete Forums. Please check your mail for verification of email id.';

				$result ['status'] = 'success';

				

			} else {

				$result ['status'] = 'error';

				$result ['message'] = validation_errors ();

			}

			

			echo json_encode ( $result );

			exit ();

		}

		

		

	}

	/* this method used check email address or alredy exists or not */

	public function email_exists() {

		$email = $this->input->post ( 'email_address' );

		$edit_id = $this->input->post ( 'edit_id' );

		

		$where = array (

				'email_address' => trim ( $email ) 

		);

		if ($edit_id != "") {

			$where = array_merge ( $where, array (

					"id !=" => $edit_id 

			) );

		}

		

		$result = $this->Mydb->get_record ( '*', $this->user_table, $where );

		if (! empty ( $result )) {

			$this->form_validation->set_message ( 'email_exists', get_label ( 'user_email_exist' ) );

			return false;

		} else {

			return true;

		}

	}

	

	/* this method used check user name or alredy exists or not */

	public function username_exists() {

		$email = $this->input->post ( 'user_username' );

		$edit_id = $this->input->post ( 'edit_id' );

		

		$where = array (

				'user_username' => trim ( $email ) 

		);

		if ($edit_id != "") {

			$where = array_merge ( $where, array (

					"user_id !=" => $edit_id 

			) );

		}

		

		$result = $this->Mydb->get_record ( '*', $this->table, $where );

		if (! empty ( $result )) {

			$this->form_validation->set_message ( 'username_exists', get_label ( 'client_username_exist' ) );

			return false;

		} else {

			return true;

		}

	}

	/* User  Activation Email */

    public function send_activation_email($name, $to_email, $activation_link) {



        $chk_arr = array('[NAME]', '[ACTIVATIONLINK]');

        $rep_arr = array($name, $activation_link);

        $response = send_email($to_email, $template_slug = "user-account-activation", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');

        return $response;

    }	

	/* this method used to email verified */



    public function email() {

        $data = $this->load_module_info();

        $key = $this->uri->segment(4);

       

        if (!empty($key)) {

            $getuserid = $this->Mydb->custom_query("SELECT id FROM $this->user_table WHERE email_active_code='$key'");

            if (!empty($getuserid)) {



                $user_id = $getuserid[0]['id'];

                $user_array = array(

					'status' => 'A',

                    'is_email_verified' => 1

                );



                $updateuser = $this->Mydb->update($this->user_table, array('id' => $user_id), $user_array);

               

                $data['emailmsg'] = "Congratulations your email has been activated successfully. Please go to " . "<a href='#openModal'>login</a>";

                $this->session->set_flashdata ( 'action_success', $data['emailmsg']);

            } else {

                $data['emailmsg'] = "Activation code is wrong . Please try again";

                $this->session->set_flashdata ( 'action_success', $data['emailmsg']);

            }

        } else {

            $data['emailmsg'] = "Something Error. Please try again";

            $this->session->set_flashdata ( 'action_success', $data['emailmsg']);

        }

             

        

		redirect(base_url('forums'));

       

    }

	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		redirect ( frontend_url() . $this->module.'/referralhistory' );
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
