<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Photooftheday extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "photooftheday";
		$this->module_label = "Photo of the day";
		$this->module_labels = "Photo of the day";
		$this->folder = "photooftheday/";
		$this->table = "sramcms_photo_oftheday";
		$this->primary_key = 'id';
		$this->load->library('common');
		
			
	}
	
	/* this method used to show all dashboard all details... */
	public function index() {
	
		  $data = array();
		  
		  $data['module_label'] = $this->module_label;
		  $data['module_labels'] = $this->module_label;
		  $data['module'] = $this->module; 
			
		  $this->layout->display_admin($this->folder.$this->module."-list" ,$data);
 	}
 	function upload_media() {
 	
 		$file_name = $_FILES['file']['name'];
 		$tmp_filename = $_FILES['file']['tmp_name'];
 		$file_info = pathinfo($file_name);
 	
 		$filetype = $_FILES['file']['type'];
 		$fileerror = $_FILES['file']['error'];
 		$json = array('success' => 0, 'message' => 'Issue in uploading file');
 		if ($fileerror == 0) {
 			//get file extenstion to verify the format
 			$extension = $file_info['extension'];
 			$header = array('Content-Type' => $filetype);
 			$file_name_slug = url_title($file_info['filename'], "_");
 			$file_name = $file_name_slug . "_" . time() . "." . $extension;
 	
 			$create_folder = 'photooftheday/media/' . date("Y/m", strtotime("now")) . "/";
 			create_folder($create_folder);
 			$new_file_name ='photooftheday/media/'. date("Y/m", strtotime("now")) . "/" . $file_name;
 			$result_upload = $this->common->upload_media_files('file', $file_name, $create_folder);
 	
 			if ($result_upload) {
 				$json['success'] = 1;
 				$json['message'] = '';
 				$json['file'] = $new_file_name;
 			} else {
 				$json = array('success' => 0, 'message' => 'Uploading timeout');
 			}
 		}
 		echo json_encode($json);
 	}
	public function add() {
			
		$data = $this->load_module_info();
		if ($this->input->post( 'action' ) == "Add") {
			check_ajax_request ();	
			$this->form_validation->set_rules ( 'title', 'lang:title', 'trim|required' );
			$this->form_validation->set_rules ( 'description', 'lang:description', 'trim|required' );
			$this->form_validation->set_rules ( 'date', 'lang:date', 'trim|required' );
			$this->form_validation->set_rules ( 'mediaFiles[]', 'lang:mediaFiles', 'trim|required' );
			
			if ($this->form_validation->run () == TRUE) {
				
				//Create Category slug				
				$slug= url_title($this->input->post('title'), '-',TRUE);						
			 
				
				$insert_data = array("title" => $this->input->post('title'),
									 "description" => $this->input->post('description'),	
									 "date" => get_date_formart($this->input->post('date'), 'Y-m-d'),
								     "image" => json_encode(array('files' => $_REQUEST['mediaFiles'])),
									 "created_on" => current_date(),
									 "created_ip" => get_ip(),
									 "created_by" => get_admin_id(),									
									 "is_active" => '1',
									);
				
				$this->Mydb->insert($this->table,$insert_data);		
				
				$msg = "A New ".$this->module_label.' '.post_value('title').' has been added';
				create_log('new',$this->module_label,$msg);
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				$result ['status'] = 'success';
			}
			else {
				$result ['status'] = 'error';
				$result ['message'] = validation_errors ();
			}	
			echo json_encode ( $result );
			exit ();
		}			
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add' ;
		$this->layout->display_admin ( $this->folder . $this->module . "-add", $data );
	}
	
	/* this method used list ajax listing... */
	function ajax_pagination($page = 0) {
		check_ajax_request (); /* skip direct access */
		$data = $this->load_module_info ();
		$like = array ();
		$where = array (
				'is_delete !=' => '1'
		); // array (" $this->primary_key !=" => '' );
		$order_by = array (
				$this->primary_key => 'DESC'
		);
		
		/* Search part start */
		
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", post_value ( 'status' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" )
			);
		}
		
			
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'user_status' => get_session_value ( $this->module . "_search_status" )
			) );
		}
		
		// print_r($like); exit;
		
		$totla_rows = $this->Mydb->get_num_rows ( $this->primary_key, $this->table, $where, null, null, null, $like );
		
		/**
		 * * pagination part start **
		 */
		$admin_records = admin_records_perpage ();
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $totla_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $totla_rows;
		/**
		 * * pagination part end **
		 */
		$data ['records'] = $this->Mydb->get_all_records ( '*', $this->table, $where, $limit, $offset, $order_by, $like );
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		// echo $qry = $this->db->last_query(); exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'sd' => post_value ( 'status' ),
				'offset' => $offset,
				'active_page' => $active_page,
				'html' => $html
		) );
		exit ();
	}
	
	/* this method used to update record info.. */
	
	
	public function edit($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( admin_url() . $this->module ) : '';
	
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request ();
			//Create Category slug
			$this->form_validation->set_rules ( 'title', 'lang:title', 'trim|required' );
			$this->form_validation->set_rules ( 'description', 'lang:description', 'trim|required' );
			$this->form_validation->set_rules ( 'date', 'lang:date', 'trim|required' );
			$this->form_validation->set_rules ( 'mediaFiles[]', 'lang:mediaFiles', 'trim|required' );
			if ($this->form_validation->run () == TRUE) {
				$slug= url_title($this->input->post('title'), '-',TRUE);
				$update_data = array("title" => $this->input->post('title'),
						"description" => $this->input->post('description'),
						"date" => get_date_formart($this->input->post('date'), 'Y-m-d'),
						"image" => json_encode(array('files' => $_REQUEST['mediaFiles'])),
						"updated_on" => current_date(),
						"updated_ip" => get_ip(),
						"updated_by" => get_admin_id(),
						"is_active" => $this->input->post('is_active'),
				);
				
				
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['id'] ), $update_data );
				
				$msg = "A ".$this->module_label.' '.post_value('title').' has been edited';
					create_log('edit',$this->module_label,$msg);
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'error';
				$response ['message'] = validation_errors ();
			}
				
			echo json_encode ( $response );
			exit ();
		}
		$data ['records'] = $record;
		/* Common labels */
		$this->module_label ="User Info";
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data['edit_id'] = $edit_id;
		
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
	}
	
	public function share($edit_id = NULL) {
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( admin_url() . $this->module ) : '';
	

		$data ['records'] = $record;
		/* Common labels */
		$this->module_label ="User Info";
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'share' ) . ' ' . $this->module_label;
		$data['edit_id'] = $edit_id;
		$data['meta_jeevan_url'] = $edit_id;
		$data['meta_jeevan_link'] = 'http://jeevanacharya.com/';
		$data['meta_jeevan_title'] = $record['title'];
		$data['meta_jeevan_summary'] = $record['description'];
		$media_files = json_decode($record['image']);
		$data['meta_jeevan_image'] =  media_url($media_files->files[0]);
		
		
		$data ['module_action'] = 'share/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-share', $data );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
	
	/* this method used update multible actions */
	function action() {
		$ids = ($this->input->post ( 'multiaction' ) == 'Yes' ? $this->input->post ( 'id' ) : decode_value ( $this->input->post ( 'changeId' ) ));
		
		$ids = ($this->input->post ( 'changeId' ) != '') ? decode_value ( $this->input->post ( 'changeId' ) ) : $this->input->post ( 'id' );
		$postaction = $this->input->post ( 'postaction' );
		
		$response = array (
				'status' => 'error',
				'msg' => get_label ( 'something_wrong' ),
				'action' => '',
				'multiaction' => $this->input->post ( 'multiaction' ) 
		);
		if(is_array($ids)) {
			$implode_ids = '('.implode(",",$ids).')';
			$concat_name = $this->db->query("select GROUP_CONCAT(title) as name from $this->table where id in $implode_ids")->row_array();
			$action_name = $concat_name['name'];
		}
		else {
			$records = $this->Mydb->get_record('title as name',$this->table,array('id'=>$ids));
			$action_name = $records['name'];
		}
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			// $this->Mydb->delete_where_in($this->table,'client_id',$ids,'');
			$update_values = array (
					"is_delete" => '1',
					"updated_on" => current_date (),
					'updated_by' => get_admin_id ()
			);
			
			if (is_array ( $ids )) {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values);
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_delete' ), $this->module_label );
				
				// $this->Mydb->delete($this->table,'client_id',$ids,'');
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been deleted ';
			create_log('delete',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '1',
					"updated_on" => current_date (),
			);
			
			if (is_array ( $ids )) {
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_label );
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been Activated ';
			create_log('status',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '0',
					"updated_on" => current_date (),
					'updated_by' => get_admin_id ()
			);
			
			if (is_array ( $ids )) {
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				
				$this->Mydb->update ( $this->table, array (
						$this->primary_key => $ids 
				), $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_label );
			}
			$msg = "A ".$this->module_label.' '.$action_name.' has been Deactivated ';
			create_log('status',$this->module_label,$msg);
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_category" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		redirect ( admin_url () . $this->module );
	}
	
	public function category_check(){
		$category_name = $this->input->post('category_name');
		$categories_type = $this->input->post('category_type');
		$record = $this->Mydb->custom_query("select * from categories where name = '".$category_name."'
				   and parent_id = ".$categories_type." and is_delete != '1'");
		if ($record)
        {
            $this->form_validation->set_message('category_name', "The %s field has an unique name.");
            return FALSE;
        }
        else
        {
            return TRUE;
        }
		
	}
	
}