<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Galleryitems extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "galleryitems";
		$this->module_label = "Gallery item";
		$this->module_labels = "Gallery items";
		$this->folder = "galleryitems/";
		$this->table = "sramcms_galleries";
		$this->primary_key = 'id';
		$this->load->library('common');
		
			
	}
	function _remap($method, $args) {
		
		if (method_exists($this, $method)) {
			
				if($method == "ajax_pagination"){
					$page = isset($args[0]) ? $args[0] :'';
					$this->$method($page);
				}else{
					$this->$method($args);
				}	
			
		} else {			
				$this->index($method, $args);
			
		}
	}
	/* this method used to show all dashboard all details... */
	public function index($method, $args = array()) {
		
	  $data = array();
	  
	  $data['module_label'] = $this->module_label;
	  $data['module_labels'] = $this->module_label;
	  $data['module'] = $this->module;
	  if (!empty($method) && empty($args[0])) {
	  	$gallery_category_id = decode_value($method);
	  	$this->session->set_userdata ( $this->module . "_gallery_category_id", $gallery_category_id );
	  }
	
	  $this->layout->display_admin($this->folder.$this->module."-list" ,$data);
	}
	function upload_thumbnail() {
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
			$file_name_slug = url_title($file_info['filename'], '_');
			$file_name = $file_name_slug . "_" . time() . "." . $extension;
			//change filename
			$new_file_name = 'gallery/medias/thumbnail/'. date("Y/m", strtotime("now")) . "/" . $file_name;
			/* Upload thumbnail in local server */
			$media_folder = 'gallery/medias/thumbnail/';
			$create_folder = $media_folder . date("Y/m", strtotime("now")) . "/";
			create_folder($create_folder);
	
			$result_upload = $this->common->upload_media_files('file', $file_name, $create_folder);
	
	
			if ($result_upload) {
				$json['success'] = 1;
				$json['message'] = '';
				$json['file'] = $new_file_name;
			}
		}
	
		echo json_encode($json);
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
	
		    $media_type_id = post_value('media_type');
			$type_array = array('image', 'video','audio');
			$type = $type_array[$media_type_id-1];
			
			$media_folder = 'gallery/medias/' . $type . 's/';
			$create_folder = $media_folder. date("Y/m", strtotime("now")) . "/";
			create_folder($create_folder);
			
			$new_file_name ='gallery/medias/' . $type . 's/'. date("Y/m", strtotime("now")) . "/" . $file_name;
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
			$this->form_validation->set_rules ( 'media_type', 'lang:media_type', 'trim|required' ); 
			if(post_value('media_type') != 3){
				$this->form_validation->set_rules ( 'mediaFiles', 'lang:mediaFiles', 'trim|required' ); 
			}else{
				$this->form_validation->set_rules ( 'video_url', 'lang:video_url', 'trim|required' ); 
			}
			
			if ($this->form_validation->run () == TRUE) {				
				$file_name = (post_value('media_type') != 3) ? post_value('mediaFiles') : post_value('video_url');
				$category_id = get_session_value ( $this->module . '_gallery_category_id' );		
				$insert_data = array("title" => post_value('title'),
									 "description" => post_value('description') ? post_value('description') :'',	
									 "created_on" => current_date(),
									 "created_by" => get_admin_id(),
									 "created_ip" => get_ip(),
									 "gallery_category_id" =>	$category_id ? $category_id : 0,
									 "media_type" =>	post_value('media_type'),
								     "file_name" =>	$file_name ? $file_name :'',						
									 "is_active" => '1' );
				$this->Mydb->insert($this->table,$insert_data);		
				
				$msg = "A New ".$this->module_label.'has been added';
				create_log('new',$this->module_label,$msg);
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_category' ), $this->module_label ) );
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
		$where = " WHERE is_delete != '1' ";
		$like = "";
		if (post_value ( 'paging' ) == "") {
			$this->session->set_userdata ( $this->module . "_search_field", post_value ( 'search_field' ) );
			$this->session->set_userdata ( $this->module . "_search_value", post_value ( 'search_value' ) );
			$this->session->set_userdata ( $this->module . "_search_status", $_POST['is_active'] );
		}
		if (get_session_value ( $this->module . "_gallery_category_id" ) != "") {
			$where .= 'AND 	gallery_category_id = "'.get_session_value ( $this->module . '_gallery_category_id' ).'"';
		}
		
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where .= 'AND is_active = "'.get_session_value ( $this->module . '_search_status' ).'"';	
		}
		
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like .= ' AND '.get_session_value ( $this->module . "_search_field" ).' LIKE "%'.get_session_value ( $this->module . '_search_value' ) .'%"';
		}
		$filter = $where.$like;
		$get_rows = $this->Mydb->custom_query("SELECT * FROM $this->table $where $like ORDER BY id" );
		
		/**
		 * * pagination part start **
		 */
		 
		$total_rows = count($get_rows);
		$admin_records = 100;
		$limit = (( int ) $admin_records == 0) ? 25 : $admin_records;
		$offset = (( int ) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
		$uri_segment = $this->uri->total_segments ();
		$uri_string = admin_url () . $this->module . "/ajax_pagination";
		$config = pagination_config ( $uri_string, $total_rows, $limit, $uri_segment );
		$this->pagination->initialize ( $config );
		$data ['paging'] = $this->pagination->create_links ();
		
		$data ['per_page'] = $data ['limit'] = $limit;
		$data ['start'] = $offset;
		$data ['total_rows'] = $total_rows;
		/**
		 * * pagination part end **
		 */
		
		$data ['records'] = $this->Mydb->custom_query("SELECT * FROM $this->table $where $like ORDER BY id LIMIT $offset, $limit" );
		
			
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		
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
		$id = addslashes ( decode_value ( $edit_id[0] ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		(empty ( $record )) ? redirect ( admin_url() . $this->module ) : '';
	
		if ($this->input->post ( 'action' ) == "edit") {
			check_ajax_request ();
			
			$this->form_validation->set_rules ( 'title', 'lang:title', 'trim|required' );
			$this->form_validation->set_rules ( 'description', 'lang:description', 'trim|required' );
			$this->form_validation->set_rules ( 'media_type', 'lang:media_type', 'trim|required' );
			if(post_value('media_type') != 3){
				$this->form_validation->set_rules ( 'mediaFiles', 'lang:mediaFiles', 'trim|required' );
			}else{
				$this->form_validation->set_rules ( 'video_url', 'lang:video_url', 'trim|required' );
			}
			
				
			if ($this->form_validation->run () == TRUE) {
			
				$file_name = (post_value('media_type') != 3) ? post_value('mediaFiles') : post_value('video_url');
				$category_id = get_session_value ( $this->module . '_gallery_category_id' );		
				
				$update_data = array(
						"title" => post_value('title'),
						"description" => post_value('description') ? post_value('description') :'',
						"updated_on" => current_date(),
						"updated_by" => get_admin_id(),
						"updated_ip" => get_ip(),
						"gallery_category_id" =>	$category_id ? $category_id : 0,
						"media_type" =>	post_value('media_type'),
						"file_name" =>	$file_name ? $file_name :'',	
						"is_active" => post_value('is_active') ?  post_value('is_active') : $record['is_active'],
						);					
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['id'] ), $update_data );
				
				$msg = "A ".$this->module_label.' '.post_value('name').' has been edited';
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
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data['edit_id'] = $edit_id;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
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