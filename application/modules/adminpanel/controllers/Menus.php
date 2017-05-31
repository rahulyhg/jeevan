<?php
/**************************
Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 19 Feb, 2016
Description		: Page contains dashboard related functions.

***************************/
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Menus extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->authentication->admin_authentication();
		$this->module = "menus";
		$this->module_label = "Menus";
		$this->module_labels = "Menus";
		$this->folder = "menus/";
		$this->table = "sramcms_menus";
		$this->users_table = "sramcms_users";
		$this->cms_pages_table = "sramcms_cms_pages";
		$this->news_category_table = "categories";
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
	  	$menu_group_id = decode_value($method);
	  	$this->session->set_userdata ( $this->module . "_menu_group_id", $menu_group_id );
	  }
	
	  $this->layout->display_admin($this->folder.$this->module."-list" ,$data);
	}
	
	public function getCategoryTreeForParentId($parent_id = 0) {
		  $categories = array();
		  $this->db->from('categories');
		  $this->db->where('parent_id', $parent_id);
		  $result = $this->db->get()->result();
		  foreach ($result as $mainCategory) {
		    $category = array();
		    $category['id'] = $mainCategory->id;
		    $category['name'] = $mainCategory->name;
		    $category['parent_id'] = $mainCategory->parent_id;
		    $category['sub_categories'] = $this->getCategoryTreeForParentId($category['id']);
		    $categories[$mainCategory->id] = $category;
		  }
		  return $categories;
	}

	public function add() {
			
		$data = $this->load_module_info();
		if ($this->input->post( 'action' ) == "Add") {
			check_ajax_request ();	
			$menu_type = $this->input->post('menu_type');
			$this->form_validation->set_rules ( 'menu_type', 'lang:menu_type', 'trim|required' ); 
			
			if(!empty($menu_type) && $menu_type == "page"){
				$this->form_validation->set_rules ( 'cms_page', 'lang:cms_page', 'trim|required' );
			}
			
			if(!empty($menu_type) && $menu_type == "custom_link"){
				$this->form_validation->set_rules ( 'url', 'lang:url', 'trim|required' );
			}
			
			if ($this->form_validation->run () == TRUE) {
				
				//get page id depending on menu type		
				$page_id = "";
				if(!empty($menu_type) && $menu_type == "categories"){
					$page_id = post_value('category_name') ? post_value('category_name') :'';
					$menu_name = $this->get_category_name($page_id);
					
				}
				if(!empty($menu_type) && $menu_type == "page"){
					$page_id = post_value('cms_page') ? post_value('cms_page') :'';
					$menu_name = $this->get_cmspage_name($page_id);
				}
			
				if(!empty($menu_type) && $menu_type == "custom_link"){
					$page_id = 0;
					$menu_name = post_value('name') ? post_value('name') : '';
				}
				
				$group_id = get_session_value ( $this->module . '_menu_group_id' );		
				$insert_data = array("name" => post_value('name') ? post_value('name') : $menu_name,
									 "link_type" => post_value('menu_type') ? post_value('menu_type') :'',	
									 "url" => post_value('url') ? post_value('url') :'',
									 "page_id" => $page_id,
									 "created_on" => current_date(),
									 "created_by" => get_admin_id(),
									 "menu_group_id" =>	$group_id ? $group_id : 0,
									 "position" =>	post_value('position') ? post_value('position') :'',
								     "extra_attributes" =>	post_value('extra_attributes') ? post_value('extra_attributes') :'',
									 "menu_class" =>	post_value('menu_class') ? post_value('menu_class') :'',						
									 "target" =>	post_value('target') ? post_value('target') :'',
									 "is_active" => '1',
									 "parent_id" => $this->input->post('parent_menu') ? $this->input->post('parent_menu') :'0', );
				$this->Mydb->insert($this->table,$insert_data);		
				if(!$this->input->post('parent_menu')){
					$update_isparent_data = array("is_parent" => '1');					
					$this->Mydb->update ( $this->table, array ($this->primary_key => $this->input->post('parent_menu') ), $update_isparent_data );
				}
				
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
		$data['cms_pages'] = $this->get_all_pages();
		
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
		if (get_session_value ( $this->module . "_menu_group_id" ) != "") {
			$where .= 'AND 	menu_group_id = "'.get_session_value ( $this->module . '_menu_group_id' ).'"';
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
		
		$data ['records'] = $this->Mydb->custom_query("SELECT id, name, parent_id AS parent, link_type, created_on, is_active FROM $this->table $where $like ORDER BY id LIMIT $offset, $limit" );
		
		$data['tree'] = buildMenuTree($data ['records']);	
		
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
			
			$menu_type = $this->input->post('menu_type');
			$this->form_validation->set_rules ( 'menu_type', 'lang:menu_type', 'trim|required' );
			if(!empty($menu_type) && $menu_type == "categories"){
				$this->form_validation->set_rules ( 'category_name', 'lang:category_name', 'trim|required' );
			}
			if(!empty($menu_type) && $menu_type == "page"){
				$this->form_validation->set_rules ( 'cms_page', 'lang:cms_page', 'trim|required' );
			}
				
			if(!empty($menu_type) && $menu_type == "custom_link"){
				$this->form_validation->set_rules ( 'url', 'lang:url', 'trim|required' );
			}
				
			if ($this->form_validation->run () == TRUE) {
			
				//get page id depending on menu type
				$page_id = "";
				if(!empty($menu_type) && $menu_type == "categories"){
					$page_id = post_value('category_name') ? post_value('category_name') :$record['page_id'];
					$menu_name = $this->get_category_name($page_id);
						
				}
				if(!empty($menu_type) && $menu_type == "page"){
					$page_id = post_value('cms_page') ? post_value('cms_page') :$record['page_id'];
					$menu_name = $this->get_cmspage_name($page_id);
				}
					
				if(!empty($menu_type) && $menu_type == "custom_link"){
					$page_id = 0;
					$menu_name = post_value('name') ? post_value('name') : $record['name'];
				}
			
				$group_id = get_session_value ( $this->module . '_menu_group_id' );
				$update_data = array("name" => post_value('name') ? post_value('name') : $menu_name,
						"link_type" => post_value('menu_type') ? post_value('menu_type') : $record ['link_type'],
						"url" => post_value('url') ? post_value('url') :$record['url'],
						"page_id" => $page_id,
						"updated_on" => current_date(),
						"updated_by" => get_admin_id(),
						"menu_group_id" =>	$group_id ? $group_id : 0,
						"target" =>	post_value('target') ? post_value('target') :'',
						"position" =>	post_value('position') ? post_value('position') :$record['position'],
						"extra_attributes" =>	post_value('extra_attributes') ? post_value('extra_attributes') :$record['extra_attributes'],
						"menu_class" =>	post_value('menu_class') ? post_value('menu_class') : $record['extra_attributes'],
						"is_active" => post_value('is_active') ?  post_value('is_active') : $record['is_active'],
						"parent_id" => $this->input->post('parent_menu') ? $this->input->post('parent_menu') :$record['parent_id'], );					
				
				$this->Mydb->update ( $this->table, array ($this->primary_key => $record ['id'] ), $update_data );
				if(!$this->input->post('parent_menu')){
					$update_isparent_data = array("is_parent" => '1');
					$this->Mydb->update ( $this->table, array ($this->primary_key => $this->input->post('parent_menu') ), $update_isparent_data );
				}
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
		$data['cms_pages'] = $this->get_all_pages();
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
			$concat_name = $this->db->query("select GROUP_CONCAT(name) as name from $this->table where id in $implode_ids")->row_array();
			$action_name = $concat_name['name'];
		}
		else {
			$records = $this->Mydb->get_record('name',$this->table,array('id'=>$ids));
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
				foreach($ids as $id){
					$record = $this->Mydb->get_record ( '*', $this->table, array (
														$this->primary_key => $id
														) );
					$update_sub_cat = array("parent_id"=> $record['parent_id']);
					$this->Mydb->update_where_in($this->table,'parent_id',$id,$update_sub_cat);									
				}
				
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_activate' ), $this->module_labels );
			} else {
				$record = $this->Mydb->get_record ( '*', $this->table, array (
														$this->primary_key => $ids
														) );
					$update_sub_cat = array("parent_id"=>$record['parent_id']);
					$this->Mydb->update_where_in($this->table,'parent_id',$ids,$update_sub_cat);	
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
				foreach($ids as $id){
					$record = $this->Mydb->get_record ( '*', $this->table, array (
														$this->primary_key => $id
														) );
					$update_sub_cat = array("parent_id"=>$record['parent_id']);
					$this->Mydb->update_where_in($this->table,'parent_id',$id,$update_sub_cat);									
				}
				$this->Mydb->update_where_in ( $this->table, $this->primary_key, $ids, $update_values );
				$response ['msg'] = sprintf ( $this->lang->line ( 'success_message_deactivate' ), $this->module_labels );
			} else {
				$record = $this->Mydb->get_record ( '*', $this->table, array (
														$this->primary_key => $ids
														) );
					$update_sub_cat = array("parent_id"=>$record['parent_id']);
					$this->Mydb->update_where_in($this->table,'parent_id',$ids,$update_sub_cat);
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
	public function get_all_pages(){
		$records = $this->Mydb->custom_query("SELECT id, page_title FROM $this->cms_pages_table WHERE is_delete != 1 AND is_active=1");
		
		if(!empty($records)){
			return $records;
			
		}else{
			return false;
		}
	} 
	public function get_category_name($cat_id){
		$record = $this->Mydb->get_record("name",$this->news_category_table, "is_delete != 1 AND is_active=1 AND id=$cat_id");
		
		if(!empty($record)){
			return $record['name'];
				
		}else{
			return '';
		}
		
	}
	public function get_cmspage_name($page_id){
		$record = $this->Mydb->get_record("page_title",$this->cms_pages_table, "is_delete != 1 AND is_active=1 AND id=$page_id");
	
		if(!empty($record)){
			return $record['page_title'];
	
		}else{
			return '';
		}
	
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