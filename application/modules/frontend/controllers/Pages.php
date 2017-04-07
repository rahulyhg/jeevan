<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->module = "pages";
        $this->module_label = "Pages";
        $this->module_labels = "Pages";
        $this->folder = "pages/";
        $this->cms_pages = "sramcms_cms_pages";
        $this->routeplan = "sramcms_routeplan";
    }

    function _remap($method, $args) {
        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            $this->index($method, $args);
        }
    }

    public function index($method, $args = array()) {
        $data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->loadBlocks();
        $data = array_merge($data, $this->view_data);

        $data['cms'] = $this->Mydb->get_record('*', $this->cms_pages, array('page_slug' => $method, 'is_active' => '1', 'is_delete' => '0'));
		
        if (!empty($data['cms']['page_template'])) {
            $page_template = $data['cms']['page_template'];
        } else {
            $page_template = 'pages';
        }
        if ($method == 'contact-us') {

            $getavailable_locations = $this->Mydb->custom_query("select available_location from $this->routeplan where available_date=CURDATE()");
            if (!empty($getavailable_locations)) {
                $data['available_location'] = $getavailable_locations[0]['available_location'];
            } else {
                $data['available_location'] = '';
            }
        }
        $data['meta_title']   =  get_meta_text($data['cms']['page_meta_title']);
        $data['meta_keyword'] = get_meta_text($data['cms']['page_meta_keyword']);
        $data['meta_content'] = get_meta_text($data['cms']['page_meta_description']);
        $this->layout->display_frontend($this->folder . '/' . $page_template, $data);
    }

}

?>