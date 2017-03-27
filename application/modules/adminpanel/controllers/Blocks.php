<?php

/* * ************************
  Project Name	: Elect TV
  Created on		: 08 Nov, 2016
  Last Modified 	:
  Description		:  this file contains common setting for admin and client panel..

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Blocks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->authentication->admin_authentication();
        $this->module = "blocks";
        $this->module_label = get_label('blocks_module_label');
        $this->module_labels = get_label('blocks_module_label');
        $this->folder = "blocks/";
        $this->table = "sramcms_blocks";
        $this->admin_create_access = "admin_create_access";
        $this->login_history_table = "admin_login_history";
        $this->load->library('common');

        $this->primary_key = 'id';
    }

    /* this method used to list all company . */

    public function index() {
        $data = $this->load_module_info();

        $this->layout->display_admin($this->folder . $this->module . "-list", $data);
    }

    /* this method used list ajax listing... */

    function ajax_pagination($page = 0) {
        check_ajax_request(); /* skip direct access */
        $data = $this->load_module_info();
        $like = "";

        $where = "WHERE t1.id >0 AND t1.is_delete = 0 ";

        $order_by = array(
            $this->primary_key => 'DESC'
        );

        /* Search part start */
        if (post_value('paging') == "") {
            $this->session->set_userdata($this->module . "_search_field", post_value('search_field'));
            $this->session->set_userdata($this->module . "_search_value", post_value('search_value'));
            $this->session->set_userdata($this->module . "_search_block_type", post_value('search_block_type'));
            $this->session->set_userdata($this->module . "_search_page", post_value('search_page'));
            $this->session->set_userdata($this->module . "_search_position", post_value('search_position'));
            $this->session->set_userdata($this->module . "_search_status", $_POST['is_active']);
        }

        if (get_session_value($this->module . "_search_field") != "" && get_session_value($this->module . "_search_value") != "") {
            $search_field = get_session_value($this->module . "_search_field");
            $search_value = get_session_value($this->module . "_search_value");
            $like .= " AND t1.$search_field LIKE '%$search_value%'";
        }

        if (get_session_value($this->module . "_search_block_type") != "") {
            $search_block_type = get_session_value($this->module . '_search_block_type');
            $where .= " AND t1.type = '$search_block_type'";
        }

        if (get_session_value($this->module . "_search_page") != "") {
            $search_page = get_session_value($this->module . '_search_page');
            $where .= " AND t1.page = '$search_page'";
        }

        if (get_session_value($this->module . "_search_position") != "") {
            $search_position = get_session_value($this->module . '_search_position');
            $where .= " AND t1.position = '$search_position'";
        }

        if (get_session_value($this->module . "_search_status") != "") {
            $search_status = get_session_value($this->module . '_search_status');
            $where .= " AND t1.is_active = $search_status";
        }


        $get_rows = $this->Mydb->custom_query(" SELECT t1.*  FROM $this->table AS t1 
												  $where");

        /**
         * * pagination part start **
         */
        $total_rows = count($get_rows);
        $admin_records = admin_records_perpage();
        $limit = ((int) $admin_records == 0) ? 25 : $admin_records;
        $offset = ((int) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
        $uri_segment = $this->uri->total_segments();
        $uri_string = admin_url() . $this->module . "/ajax_pagination";
        $config = pagination_config($uri_string, $total_rows, $limit, $uri_segment);
        $this->pagination->initialize($config);
        $data ['paging'] = $this->pagination->create_links();
        $data ['per_page'] = $data ['limit'] = $limit;
        $data ['start'] = $offset;
        $data ['total_rows'] = $total_rows;
        /**
         * * pagination part end **
         */
        $data ['records'] = $this->Mydb->custom_query(" SELECT t1.* FROM $this->table AS t1
												   $where $like LIMIT $offset, $limit");
        //echo $qry = $this->db->last_query(); exit;
        $active_page = $offset = ((int) $this->input->post('page') == 0) ? 1 : $this->input->post('page');

        $html = get_template($this->folder . '/' . $this->module . '-ajax-list', $data);
        echo json_encode(array(
            'status' => 'ok',
            'sd' => post_value('status'),
            'offset' => $offset,
            'active_page' => $active_page,
            'html' => $html
        ));
        exit();
    }

    /* this method used to insert the admin users */

    function add($type = "") {

        $type = post_value('type') ? post_value('type') : $type;
        $data = $this->load_module_info($type);
        $data["block_type"] = $type;

        /* form submit */
        if ($this->input->post('action') == "Add") {
            form_check_ajax_request(); /* skip direct access */

            $this->form_validation->set_rules('title', 'lang:title', 'required');
            $this->form_validation->set_rules('order', 'lang:order', 'required|numeric');
            $this->form_validation->set_rules('page', 'lang:page', 'required');
            $this->form_validation->set_rules('position', 'lang:position', 'required');

            if ($type != "" && file_exists($file_path = APPPATH . 'config/blocks/' . $type . '.php')) {
                include($file_path);
                if (isset($type_validation_rules) && !empty($type_validation_rules)) {
                    $this->form_validation->set_rules($type_validation_rules);
                }
            }

            if ($this->form_validation->run() == TRUE) {
                $page = post_value('page');
                $display = 1;
                if ($page == "all") {
                    $display = 0;
                }
                $params = json_encode($_POST["params"]);
                $insert_array = array(
                    'title' => post_value('title'),
                    'order' => post_value('order'),
                    'page' => $page,
                    'display' => $display,
                    'type' => $type,
                    'position' => post_value('position'),
                    'params' => $params,
                    'created' => current_date(),
                    'modified' => current_date()
                );

                $insert_id = $this->Mydb->insert($this->table, $insert_array);

                $this->session->set_flashdata('action_success', sprintf($this->lang->line('success_message_regsiter'), $this->module_label));
                $result ['status'] = 'success';
            } else {
                $result ['status'] = 'error';
                $result ['message'] = validation_errors();
            }

            echo json_encode($result);
            exit();
        }
        /* Common labels */
        $data ['breadcrumb'] = $data ['form_heading'] = get_label('add') . ' ' . $this->module_label;
        $data ['module_action'] = 'add';
        if ($type == "" || !array_key_exists($type, $data["block_types"])) {
            $this->layout->display_admin($this->folder . $this->module . "-types", $data);
        } else {
            $file_paths = array(
                $this->folder . $this->module . "-add",
                $this->folder . $this->module . "/add-" . $type,
                $this->folder . $this->module . "-add-submit"
            );
            $this->layout->display_admin($file_paths, $data);
        }
    }

    /* this method used to update record info.. */

    public function edit($edit_id = NULL) {
     
        $id = addslashes(decode_value($edit_id));
        $response = array();
        $record = $this->Mydb->get_record('*', $this->table, array(
            $this->primary_key => $id
        ));
        (empty($record)) ? redirect(admin_url() . $this->module) : '';

        $type = $record ['type'];

        $data = $this->load_module_info($type);

        if ($this->input->post('action') == "edit") {
            $this->form_validation->set_rules('title', 'lang:title', 'required');
            $this->form_validation->set_rules('order', 'lang:order', 'required|numeric');
            $this->form_validation->set_rules('page', 'lang:page', 'required');
            $this->form_validation->set_rules('position', 'lang:position', 'required');

            if ($type != "" && file_exists($file_path = APPPATH . 'config/blocks/' . $type . '.php')) {
                include_once($file_path);
                if (isset($type_validation_rules) && !empty($type_validation_rules)) {
                    $this->form_validation->set_rules($type_validation_rules);
                }
            }


            if ($this->form_validation->run() == TRUE) {
                $page = post_value('page');
                $display = 1;
                if ($page == "all") {
                    $display = 0;
                }
                $params = json_encode($_POST["params"]);
                $update_array = array(
                    'title' => post_value('title'),
                    'order' => post_value('order'),
                    'page' => $page,
                    'display' => $display,
                    'position' => post_value('position'),
                    'params' => $params,
                    'modified' => current_date()
                );


                $this->Mydb->update($this->table, array($this->primary_key => $record ['id']), $update_array);

                $this->session->set_flashdata('action_success', sprintf($this->lang->line('success_message_edit'), $this->module_label));
                $response ['status'] = 'success';
            } else {
                $response ['status'] = 'error';
                $response ['message'] = validation_errors();
            }

            echo json_encode($response);
            exit();
        }
        $data ['records'] = $record;
        /* Common labels */
        $this->module_label = "User Info";
        $data ['breadcrumb'] = $data ['form_heading'] = get_label('edit') . ' ' . $this->module_label;
        $data['edit_id'] = $edit_id;
        $data ['module_action'] = 'edit/' . encode_value($record [$this->primary_key]);

        $data["block_type"] = $type;

        $data["records"]["type_params"] = json_decode($record["params"], true);

        if ($type == "" || !array_key_exists($type, $data["block_types"])) {
            $this->layout->display_admin($this->folder . $this->module . "-types", $data);
        } else {
            $file_paths = array(
                $this->folder . $this->module . "-edit",
                $this->folder . $this->module . "/edit-" . $type,
                $this->folder . $this->module . "-edit-submit"
            );
           
            $this->layout->display_admin($file_paths, $data);
        }
    }

    /* this method used update multible actions */

    function action() {
        $ids = ($this->input->post('multiaction') == 'Yes' ? $this->input->post('id') : decode_value($this->input->post('changeId')));

        $ids = ($this->input->post('changeId') != '') ? decode_value($this->input->post('changeId')) : $this->input->post('id');
        $postaction = $this->input->post('postaction');

        $response = array(
            'status' => 'error',
            'msg' => get_label('something_wrong'),
            'action' => '',
            'multiaction' => $this->input->post('multiaction')
        );

        /* Delete */
        if ($postaction == 'Delete' && !empty($ids)) {
            $update_values = array(
                "is_delete" => 1,
                "modified" => current_date()
            );
            if (is_array($ids)) {
                $this->Mydb->update_where_in($this->table, $this->primary_key, $ids, $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_delete'), $this->module_labels);
            } else {
                $this->Mydb->update($this->table, array(
                    $this->primary_key => $ids
                        ), $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_delete'), $this->module_label);
            }
            $response ['status'] = 'success';
            $response ['action'] = $postaction;
        }

        /* Activation */
        if ($postaction == 'Activate' && !empty($ids)) {
            $update_values = array(
                "is_active" => 1,
                "modified" => current_date()
            );

            if (is_array($ids)) {
                $this->Mydb->update_where_in($this->table, $this->primary_key, $ids, $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_activate'), $this->module_labels);
            } else {

                $this->Mydb->update($this->table, array(
                    $this->primary_key => $ids
                        ), $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_activate'), $this->module_label);
            }

            $response ['status'] = 'success';
            $response ['action'] = $postaction;
        }

        /* Deactivation */
        if ($postaction == 'Deactivate' && !empty($ids)) {
            $update_values = array(
                "is_active" => 0,
                "modified" => current_date()
            );

            if (is_array($ids)) {
                $this->Mydb->update_where_in($this->table, $this->primary_key, $ids, $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_deactivate'), $this->module_labels);
            } else {

                $this->Mydb->update($this->table, array(
                    $this->primary_key => $ids
                        ), $update_values);
                $response ['msg'] = sprintf($this->lang->line('success_message_deactivate'), $this->module_label);
            }

            $response ['status'] = 'success';
            $response ['action'] = $postaction;
        }

        echo json_encode($response);
        exit();
    }

    /* this method used to clear all session values and reset search values */

    function refresh() {
        $this->session->unset_userdata($this->module . "_search_field");
        $this->session->unset_userdata($this->module . "_search_value");
        $this->session->unset_userdata($this->module . "_search_block_type");
        $this->session->unset_userdata($this->module . "_search_page");
        $this->session->unset_userdata($this->module . "_search_position");
        $this->session->unset_userdata($this->module . "_search_status");
        redirect(admin_url() . $this->module);
    }

    /* this method used to common module labels */

    private function load_module_info($type = "") {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;

        $pages = array();
        $block_postions = array();
        if (file_exists($file_path = APPPATH . 'config/blocks.php')) {
            include_once($file_path);
        }

        //$block_pages = array('' => 'Select Page');
		
		$cms_query = $this->Mydb->custom_query("SELECT * FROM sramcms_cms_pages WHERE is_active=1 AND is_delete!=1");
		if(!empty($cms_query))
		{
			
			foreach($cms_query as $value)
			{
				$pageid[]='frontend/frontend/pages/'.$value['page_slug'];
				$pagetitle[]=$value['page_title'];
				$pagelug[]['title'] = $value['page_title'];
				
				$pageposition[]['positions'] = 'inner_top, inner_bottom, inner_left, inner_right';
			}
		}
		$block_pages = array_combine($pageid, $pagetitle);
		
		
		foreach ($pagelug as $key => $value) {
            $page_total[] = array_merge($pagelug[$key], $pageposition[$key]);
        }
		$pagerecord = array_combine($pageid, $page_total);
		$pages = array_merge($pagerecord, $pages);
        $page_postions = array();
        if (!empty($pages)) {
            foreach ($pages as $k => $page) {
               $block_pages[$k] = $page["title"];
                $page_postions[$k] = array();
                foreach (explode(",", $page["positions"]) as $position) {
                    $position = trim($position);
                    if ($position != "") {
                        $page_postions[$k][$position] = $block_postions[$position];
                    }
                }
            }
        }
		
        $data["block_pages"] = $block_pages;
        $data["page_postions"] = $page_postions;
        $data["block_types"] = array_merge(array("" => "Select Type"), $block_types);

        $data["type_params"] = array();
        if ($type != "" && file_exists($file_path = APPPATH . 'config/blocks/' . $type . '.php')) {
            include($file_path);
            $data["type_params"] = $type_params;
        }

        return $data;
    }

}
