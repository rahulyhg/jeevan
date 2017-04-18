<?php
/**************************
Project Name	: Elect TV
Created on		: 08 Nov, 2016
Last Modified 	: 
Description		:  this file contains common setting for admin and client panel..

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Discourse extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->authentication->admin_authentication ();
		$this->module = "discourse";
		$this->parent_module = "site-settings";
		$this->module_label = "Discourse Page";
		$this->module_labels = "Discourse Page (s)";
		$this->folder = "discourse/";
		$this->table = "discourse";	
		$this->load->library ( 'common' );
		
		$this->primary_key = 'id';
		
	}
	
	/* this method used to list all company . */
	public function index($id=null) { 
		$data = $this->load_module_info ();
		$this->layout->display_admin ( $this->folder . $this->module . "-list", $data );
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
			$this->session->set_userdata ( $this->module . "_search_status", $this->input->post ( 'is_active' ) );
		}
		
		if (get_session_value ( $this->module . "_search_field" ) != "" && get_session_value ( $this->module . "_search_value" ) != "") {
			$like = array (
					get_session_value ( $this->module . "_search_field" ) => get_session_value ( $this->module . "_search_value" )
			);
		}
		
			
		if (get_session_value ( $this->module . "_search_status" ) != "") {
			$where = array_merge ( $where, array (
					'is_active' => get_session_value ( $this->module . "_search_status" )
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
		
		$select_array = array (
				'id',
				'title',
				'slug',
				'is_active',
				'created'
		
		);
		$data ['records'] = $this->Mydb->get_all_records ( $select_array, $this->table, $where, $limit, $offset, $order_by, $like );
		$active_page = $offset = (( int ) $this->input->post ( 'page' ) == 0) ? 1 : $this->input->post ( 'page' );
		// echo $qry = $this->db->last_query(); exit;
		$html = get_template ( $this->folder . '/' . $this->module . '-ajax-list', $data );
		echo json_encode ( array (
				'status' => 'ok',
				'sd' => $this->input->post ( 'is_active' ),
				'offset' => $offset,
				'active_page' => $active_page,
				'html' => $html
		) );
		exit ();
	}
	/* this method used to insert the admin users */
	function add(){
		$data = $this->load_module_info ();
		
		/* form submit */
		if ($this->input->post ( 'action' ) == "Add") {
			//form_check_ajax_request (); /* skip direct access */
				
			$this->form_validation->set_rules ( 'title', 'lang:page_title', 'required' );
			$this->form_validation->set_rules ( 'shortdesc', 'lang:shortdesc', 'required' );
			$this->form_validation->set_rules ( 'discourse_image', 'lang:discourse_image', 'callback_validate_page_image' );
			
		
			if ($this->form_validation->run () == TRUE) {	
				
				
				//Check whether user upload picture
				if(!empty($_FILES['discourse_image']['name']))
				{					
					$create_discourse_image = md5(uniqid(rand())).'-discourse-'.$_FILES['discourse_image']['name'];
					$discourse_image = $this->common->upload_image ( 'discourse_image', $create_discourse_image,'discourse/' );
					
						
				} else {
					$discourse_image = '';
				}
				$slug = create_pageuri(post_value ( 'title' ), $this->table, 'slug',array('is_delete !=' => 1));
				$insert_array = array (
						'title' => post_value ( 'title' ),
						'shortdesc' => post_value ( 'shortdesc' ),
						'slug' => $slug,
						'description' => $this->input->post('description', false),
						'image' => $discourse_image,
						'is_active' => '1',
						'created' => current_date (),
						'is_delete' => '0'
				);
				
				
				$insert_id = $this->Mydb->insert($this->table,$insert_array);
				//echo $this->Mydb->print_query();	exit;
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_add' ), $this->module_label ) );
				
				redirect ( admin_url () . $this->module );
				//$result ['status'] = 'success';
		
			} 
		}
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'add' ) . ' ' . $this->module_label;
		$data ['module_action'] = 'add' ;
		$this->layout->display_admin ( $this->folder . $this->module . "-add", $data );
		
	}
	/* this method used to update record info.. */
	public function edit($edit_id = NULL) {
		
		
		$data = $this->load_module_info ();
		$id = addslashes ( decode_value ( $edit_id ) );
		$response = array ();
		$record = $this->Mydb->get_record ( '*', $this->table, array (
				$this->primary_key => $id
		) );
		
		//(empty ( $record )) ? redirect ( admin_url() . $this->module ) : '';
		
		if ($this->input->post ( 'action' ) == "edit") {
			//form_check_ajax_request (); /* skip direct access */
				
			$this->form_validation->set_rules ( 'title', 'lang:title', 'required' );
			$this->form_validation->set_rules ( 'shortdesc', 'lang:shortdesc', 'required' );
			
			$this->form_validation->set_rules ( 'discourse_image', 'lang:discourse_image', 'callback_validate_page_image' );
			
			if ($this->form_validation->run () == TRUE) {
				
				$slug = create_pageuri(post_value ( 'title' ), $this->table, 'slug',array('is_delete !=' => 1, 'id !=' => $id));
				
				$update_array = array (
						'title' => post_value ( 'title' ),
						'shortdesc' => post_value ( 'shortdesc' ),
						'slug' => $slug,
						'description' => $this->input->post('description', false),	
                        'modified' => current_date(),
						'is_active' => ( post_value('is_active') == "" )  ?  '0': post_value('is_active')		
				);
				
				//Check whether user upload picture
				if(!empty($_FILES['discourse_image']['name']))
				{
					$create_blog_image = md5(uniqid(rand())).'-discourse-'.$_FILES['discourse_image']['name'];
					$discourse_image = $this->common->upload_image ( 'discourse_image', $create_page_image,'discourse/' );
					$image_arr = array (
							'image' => $discourse_image
					);
					$update_array = array_merge ( $update_array, $image_arr );
				
				} else {
					if(post_value ( 'remove_discourse_image' ) == "Yes"){
						$image_arr = array (
								'image' => ''
						);
						$update_array = array_merge ( $update_array, $image_arr );
					}
				}
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['id'] ), $update_array );
				
				$this->session->set_flashdata ( 'action_success', sprintf ( $this->lang->line ( 'success_message_edit' ), $this->module_label ) );
				redirect ( admin_url () . $this->module );
				//$response ['status'] = 'success';
			} 
		}
		$data ['record'] = $record;
		/* Common labels */
		$data ['breadcrumb'] = $data ['form_heading'] = get_label ( 'edit' ) . ' ' . $this->module_label;
		$data['edit_id'] = $edit_id;
		$data ['module_action'] = 'edit/' . encode_value ( $record [$this->primary_key] );
		$this->layout->display_admin ( $this->folder . $this->module . '-edit', $data );
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
		
		/* Delete */
		if ($postaction == 'Delete' && ! empty ( $ids )) {
			// $this->Mydb->delete_where_in($this->table, $this->primary_key,$ids,'');
			
			$update_values = array (
					"is_delete" => '1',
					"created" => current_date ()
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
				
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Activation */
		if ($postaction == 'Activate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '1',
					"created" => current_date ()
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
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		/* Deactivation */
		if ($postaction == 'Deactivate' && ! empty ( $ids )) {
			$update_values = array (
					"is_active" => '0',
					"created" => current_date ()
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
			
			$response ['status'] = 'success';
			$response ['action'] = $postaction;
		}
		
		echo json_encode ( $response );
		exit ();
	}
	
	/* this method used to to check validate image file */
	public function validate_page_image() {
		if (isset ( $_FILES ['discourse_image'] ['name'] ) && $_FILES ['discourse_image'] ['name'] != "") {
			if ($this->common->valid_image ( $_FILES ['discourse_image'] ) == "No") {
				$this->form_validation->set_message ( 'validate_page_image', get_label ( 'upload_valid_image' ) );
				return false;
			}
		}
	
		return true;
	}
	
	/* this method used to clear all session values and reset search values */
	function refresh() {
		$this->session->unset_userdata ( $this->module . "_search_field" );
		$this->session->unset_userdata ( $this->module . "_search_value" );
		$this->session->unset_userdata ( $this->module . "_search_category" );
		$this->session->unset_userdata ( $this->module . "_search_status" );
		redirect ( admin_url () . $this->module );
	}
	
	/* this method used to common module labels */
	private function load_module_info() {
		$data = array ();
		$data ['module_label'] = $this->module_label;
		$data ['module_labels'] = $this->module_labels;
		$data ['module'] = $this->module;
		return $data;
	}
		
	/* Editor  */
	public function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder
		$this->ckeditor->basePath = load_lib('ck/ckeditor/');
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path);
	}
	
}
