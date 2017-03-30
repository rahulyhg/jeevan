<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 25 Feb, 2016
  Description		: Page contains company add edit and delete functions..

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->authentication->admin_authentication();
        $this->module = "newsletter";
        $this->module_label = get_label('user_module_label');
        $this->module_labels = get_label('user_module_label');
        $this->folder = "newsletter/";
        $this->table = "newsletter";
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
        $like = array();
        $where = array(
            'is_active' => '1',
			'is_delete' => '0'
        ); // array (" $this->primary_key !=" => '' );
        $order_by = array(
            $this->primary_key => 'DESC'
        );

        /* Search part start */
		
		
        if (post_value('paging') == "") {
            $this->session->set_userdata($this->module . "_search_field", post_value('search_field'));
            $this->session->set_userdata($this->module . "_search_value", post_value('search_value'));
            $this->session->set_userdata($this->module . "_search_status", post_value('status'));
        }

        if (get_session_value($this->module . "_search_field") != "" && get_session_value($this->module . "_search_value") != "") {
            $like = array(
                get_session_value($this->module . "_search_field") => get_session_value($this->module . "_search_value")
            );
        }

		
		
        if (get_session_value($this->module . "_search_status") != "") {
            $where = array_merge($where, array(
                'status' => get_session_value($this->module . "_search_status")
            ));
        }

	
        //print_r($where); exit;

        $totla_rows = $this->Mydb->get_num_rows($this->primary_key, $this->table, $where, null, null, null, $like);

        /**
         * * pagination part start **
         */
        $admin_records = admin_records_perpage();
        $limit = ((int) $admin_records == 0) ? 25 : $admin_records;
        $offset = ((int) $page == 0) ? 0 : $page; // ((int)$this->input->post('page') == 0 )? 0 : ($this->input->post('page') -1) * $limit;(int)$this->uri->segment(4);
        $uri_segment = $this->uri->total_segments();
        $uri_string = admin_url() . $this->module . "/ajax_pagination";
        $config = pagination_config($uri_string, $totla_rows, $limit, $uri_segment);
        $this->pagination->initialize($config);
        $data ['paging'] = $this->pagination->create_links();
        $data ['per_page'] = $data ['limit'] = $limit;
        $data ['start'] = $offset;
        $data ['total_rows'] = $totla_rows;
        /**
         * * pagination part end **
         */
        $select_array = array(
            'name',
            'email',
            'status',
            'created',
        );
        $data ['records'] = $this->Mydb->get_all_records($select_array, $this->table, $where, $limit, $offset, $order_by, $like);
        $active_page = $offset = ((int) $this->input->post('page') == 0) ? 1 : $this->input->post('page');
        // echo $qry = $this->db->last_query(); exit;
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
            // $this->Mydb->delete_where_in($this->table,'client_id',$ids,'');
			
			
                $this->Mydb->update($this->table, array(
                    $this->primary_key => $ids
                        ), array(
					"is_active" => '0',
					"is_delete" => '1'
                ));
                $response ['msg'] = sprintf($this->lang->line('success_message_delete'), $this->module_label);

                // $this->Mydb->delete($this->table,'client_id',$ids,'');
           
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
        $this->session->unset_userdata($this->module . "_search_category");
        $this->session->unset_userdata($this->module . "_search_status");
        redirect(admin_url() . $this->module);
    }

    /* this method used to common module labels */

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
