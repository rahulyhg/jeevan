<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "homepage/";
        $this->routeplan_table = "sramcms_routeplan";
    }

    /* this method used to show all dashboard all details... */

    public function index() {

        $data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);

        $this->layout->display_frontend($this->folder . '/homepage', $data);
    }

    public function routeplan() {
        $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where status=1");
        $data['records'] = $getplandetails;
        $this->load->view($this->folder . '/routeplan', $data);
    }

    public function getroute_by_map_id() {
        $map_id = $this->input->post('map_id');
        if ($map_id != '') {
            $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where id=$map_id");
            $plan_details = explode('-', $getplandetails[0]['plan_details']);
            $response['startvalue'] = $plan_details[0];
            $response['endvalue'] = $plan_details[1];
            $destinations = $getplandetails[0]['destinations'];
            $explodedestinations = explode('|*|', $destinations);
            $response['destinations'] = array();
            $rows = array();
            foreach ($explodedestinations as $destination):
                $rows['location'] = $destination;
                array_push($response['destinations'], $rows);
            endforeach;
        } else {
//            $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where status=1 and CURDATE() between start_date and end_date");
//            $plan_details = explode('-', $getplandetails[0]['plan_details']);
//            $response['startvalue'] = $plan_details[0];
//            $response['endvalue'] = $plan_details[1];
//            $destinations = $getplandetails[0]['destinations'];
 //           $response['startvalue'] = "Karaikudi, Tamil Nadu, India";
//			$response['endvalue'] = "Chennai, Tamil Nadu, India";
 //           $destinations = "Karaikudi, Tamil Nadu, India|*|Keeranur,Tamil Nadu, India|*|Tiruchirappalli, Tamil Nadu, India|*|Chennai, Tamil Nadu, India";
            $explodedestinations = explode('|*|', $destinations);
            $response['destinations'] = array();
            $rows = array();
            foreach ($explodedestinations as $destination):
                $rows['location'] = $destination;
                array_push($response['destinations'], $rows);
            endforeach;
        }

        echo json_encode($response);
    }

    public function logout() {

        $this->session->sess_destroy();

        redirect(frontend_url());
    }

}
