<?php
/**************************
Project Name	: POS
Created on		: 18 Feb, 2016
Last Modified 	: 18 Feb, 2016
Description		: Page contains admin panel login and forgot password functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Adminpanel extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->module = "adminpanel";
		$this->module_label = "adminpanel";
		$this->folder = "login/";
		$this->table = "master_admin";
		$this->login_history_table = "master_admin_login_history";
		$this->load->helper('emailtemplate');
	}
	
	/* this method used to check login */
	public function index() {
		$data = array ();
		
		if ($this->input->post ( 'submit' ) == 'Login') 		// if ajax submit
		{
			$response = array ();
			$alert = "";
			$this->form_validation->set_rules ( 'username', 'Username', 'required|trim' );
			$this->form_validation->set_rules ( 'password', 'Password', 'required|min_length[' . PASSWORD_LENGHT . ']|trim' );
			if ($this->form_validation->run ( $this ) == TRUE) {
				
				$this->mysqli = new mysqli ( $this->db->hostname, $this->db->username, $this->db->password, $this->db->database );
				$password = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'password' ) ) );
				$username = $this->mysqli->real_escape_string ( trim ( $this->input->post ( 'username' ) ) );

				$check_details = $this->Mydb->get_record ('admin_id,admin_username,admin_password,admin_status', $this->table, array ('admin_username' => $username) );
				
				if ($check_details)
				{
					if ($check_details['admin_status'] == 'A'){
							
						$password_verify = check_hash($password,$check_details['admin_password']);
							
						if($password_verify == "Yes")
						{
							$session_datas = array('nc_admin_id' => $check_details['admin_id'],'nc_admin_name' => 'Admin' );
		
							$this->session->set_userdata($session_datas);
							
							/* store last login details...*/
							$this->Mydb->insert($this->login_history_table,array('login_time'=>current_date(),'login_ip'=>get_ip(),'login_admin_id'=>$check_details['admin_id']));
				
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
		$this->load->view ( $this->folder . 'login' );
	}
	
	function forgotpassword() {
        if ($this->input->post('submit') == 'Forgot') {   // if ajax submit
            $error = array();
            $alert = '';
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|trim');

            if ($this->form_validation->run($this) == TRUE) {

                $email = trim($this->input->post('email'));
                $check_details = $this->Mydb->get_record('admin_id, admin_username, admin_email_address, admin_status', $this->table, array('admin_email_address' => $email));              
                
                if (!empty($check_details)){
					
                    if ($check_details['admin_status'] == 'A') {
						
						
						$admin_pass_key = md5(uniqid(rand()));
						 $forgot_array = array(
							'admin_pass_key' => $admin_pass_key,
						);
						$update = $this->Mydb->update($this->table, array('admin_id' => $check_details['admin_id']), $forgot_array);

                        $name = $check_details['admin_username'];
                        $to_email = $check_details ['admin_email_address'];
                        $id = $check_details ['admin_id'];
                        $link = admin_url('resetpassword/'.$admin_pass_key);


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
                        $alert = 'Your email address disable';
                    }
                } else {
                    $alert = 'Your email address is does not match. please correct email address';
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
        $this->load->view($this->folder.'forgotpassword');
    }

    function resetpassword() {
        if (empty(get_session_value('current_user_id'))) {
            

            if ($this->input->post('submit') == 'Reset') {   // if ajax submit
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
                            'admin_password' => $password,
                        );
                        $update = $this->Mydb->update($this->table, array('admin_pass_key' => $key), $password_array);

                        if ($update) {
                            $result ['status'] = 'success';
                            $result ['message'] = 'Your Reset password success Please login here';
                        } else {
                            $result ['status'] = 'error';
                            $result ['message'] = 'Your forgot password link has been expired.';
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
            $key = $this->uri->segment(3);
            $data ['key'] = $key;
             $this->load->view($this->folder . 'resetpassword', $data);
        } else {
            redirect(admin_url());
        }
    }
	
	public function send_forgot_email($name, $to_email, $link) {

        $chk_arr = array('[NAME]', '[LINK]');
        $rep_arr = array($name, $link);
        $response = send_email($to_email, $template_slug = "forgot-password", $chk_arr, $rep_arr, $attach_file = array(), $path = '', $subject = '', $cc = '', $html_template = 'email_template');
        return $response;
    }
	
	/* this function used to destroy all admin session values */
	public function admin_logout() {
		
		$this->session->sess_destroy();
		
		redirect(admin_url());
	
	}
}
