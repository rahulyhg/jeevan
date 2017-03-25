<?php

/* * ************************
  Project Name	: Elect TV
  Created on		: 08 Nov, 2016
  Last Modified 	:
  Description		:  this file contains adminpanel helper function.
 * ************************* */

/* get content type */
if (!function_exists('get_content_type')) {

    function get_content_type() {
        header('Content-Type: application/json');
    }

}
/* this method used to get news first created date value */
if (!function_exists('mindate')) {

    function mindate() {
        $CI = & get_instance();
        $mindate = '01/01/2016';
        return $mindate;
    }

}
/* get admin session  label */
if (!function_exists('get_current_user_id')) {

    function get_current_user_id() {
        $CI = & get_instance();
        return $CI->session->userdata('current_user_id');
    }

}

/* get admin session  label */
if (!function_exists('poll')) {

    function poll() {
        $CI = & get_instance();
        $option_record = $CI->Mydb->custom_query("SELECT t1.*,t2.poll_id,t2.options,t3.name as category_name FROM poll AS t1
												join poll_option as t2 on t2.poll_id = t1.id
												join poll_category as t3 on t1.category_id = t3.id
												order by t1.id desc LIMIT 1");
        $data['option_record'] = $option_record;
        return $CI->load->view("poll", $data);
    }

}

/* this method used to get admin records per page value */
if (!function_exists('admin_records_perpage')) {

    function admin_records_perpage() {
        $CI = & get_instance();
        return 5;
    }

}

/* this function used to show output status */
if (!function_exists('show_status')) {

    function show_status($sts = null, $id) {

        return ($sts == "A" ? '<i class="fa fa-unlock status" title=" ' . get_label('active') . '" id=' . encode_value($id) . ' data="Deactivate"></i>' : ($sts == "I" ? '<i class="fa fa-lock status" title="' . get_label('inactive') . '"  id=' . encode_value($id) . ' data="Activate"></i>' : '' ) );
    }

}

/* Get client category list    */
if (!function_exists('get_client_category')) {

    function get_client_category($where = '', $selected = '', $extra = '') {
        $CI = & get_instance();
        $where_array = ($where == '') ? array('cate_id !=' => '') : $where;
        $records = $CI->Mydb->get_all_records('cate_id,cate_name', 'client_categories', $where_array, '', '', array('cate_name' => "ASC"));
        $data = array('' => get_label('select_category'));
        if (!empty($records)) {
            foreach ($records as $value) {
                $data[$value['cate_id']] = stripslashes($value['cate_name']);
            }
        }
        $extra = ($extra != '') ? $extra : 'class="form-control" id="client_cate" ';

        return form_dropdown('client_cate', $data, $selected, $extra);
    }

}



/* Get News Type */
if (!function_exists('get_news_type')) {

    function get_news_type($where = '', $selected = '', $extra = '') {
        $CI = & get_instance();
        $data = array('' => get_label('select'));
        $records = "";
        $select = "id,name";
        $records = $CI->Mydb->get_all_records($select, 'media_types');
        if (!empty($records)) {
            foreach ($records as $value) {
                $data[$value['id']] = stripslashes($value['name']);
            }
        }
        $extra = ($extra != '') ? $extra : 'class="form-control" id="client_cate" ';

        return form_dropdown('news_type', $data, $selected, $extra);
    }

}

if (!function_exists('getCatwithSubCategory_multiple')) {

    function getCatwithSubCategory_multiple($name, $where = '', $selected = '', $extra = '') {
        $CI = & get_instance();
        $edit_id = isset($where['id']) ? $where['id'] : "";
        $data = array('0' => get_label('select_category_type'));
        $query = get_categories('all', $edit_id);
        $parents = array();
        foreach ($query as $row) {
            $parents[] = $row;
        }

        $tree = buildTree($parents);

        //echo "<pre>";print_r($tree);die;
        print("<select name='" . $name . "' " . $extra . ">\n");

        printf("\t<option value='%d'>%s%s</option>\n", 0, "", 'Select Category Type');

        printTree_multiselect($tree, '', '', $selected);
        print("</select>");
    }

}

if (!function_exists('get_categories')) {

    function get_categories($parent = 'all', $edit_id = "") {
        $CI = & get_instance();
        $CI->db->select('categories.id, categories.name, categories.parent_id as parent');
        $CI->db->from('categories');
        $CI->db->where('is_delete !=', 1);
        if ($edit_id != "") {
            $CI->db->where('id != ' . $edit_id . ' and parent_id != ' . $edit_id);
        }
        if ($query = $CI->db->get()) {
            return $query->result_array();
        }

        return FALSE;
    }

}

if (!function_exists('buildTree')) {

    function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d['parent'] == $parent) {
                $children = buildTree($data, $d['id']);
                // set a trivial key
                if (!empty($children)) {
                    $d['_children'] = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

}

if (!function_exists('printTree')) {

    function printTree($tree, $r = 0, $p = null, $selected = "") {
        foreach ($tree as $i => $t) {
            $dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';

            $option_select = ($selected == $t['id']) ? "selected=selected" : "";
            printf("\t<option value='%d' $option_select>%s%s</option>\n", $t['id'], $dash, $t['name']);
            if ($t['parent'] == $p) {
                $r = 0;
            }
            if (isset($t['_children'])) {

                printTree($t['_children'], ++$r, $t['parent']);
            }
        }
    }

}

if (!function_exists('printTree_multiselect')) {

    function printTree_multiselect($tree, $r = 0, $p = null, $selected = "") {
        foreach ($tree as $i => $t) {
            $dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';

            $option_select = (in_array($t['id'], $selected)) ? "selected=selected" : "";

            printf("\t<option value='%d' $option_select>%s%s</option>\n", $t['id'], $dash, $t['name']);
            if ($t['parent'] == $p) {
                $r = 0;
            }
            if (isset($t['_children'])) {

                printTree_multiselect($t['_children'], ++$r, $t['parent'], $selected);
            }
        }
    }

}

if (!function_exists('pr')) {

    function pr($data) {
        $CI = & get_instance();

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}


if (!function_exists('get_countries')) {

    function get_countries() {
        $CI = & get_instance();

        $where_array = " is_active=1";

        $records = $CI->Mydb->get_all_records('id ,name, phonecode, iso', 'countries', $where_array, '', '', array('name' => "ASC"));


        return $records;
    }

}

if (!function_exists('get_states')) {

    function get_states() {
        $CI = & get_instance();

        $where_array = " is_active=1 AND country_id =109";

        $records = $CI->Mydb->get_all_records('id ,name', 'states', $where_array, '', '', array('name' => "ASC"));


        return $records;
    }

}


if (!function_exists('get_districts')) {

    function get_districts($state_id) {
        $CI = & get_instance();

        $where_array = " is_active=1 AND country_id =109  ";

        $records = $CI->Mydb->get_all_records('id ,name', 'districts', $where_array, '', '', array('name' => "ASC"));


        return $records;
    }

}

if (!function_exists('get_constituencies')) {

    function get_constituencies($district_id) {
        $CI = & get_instance();

        $where_array = " is_active=1 AND country_id =109 AND district_id='$district_id'   ";

        $records = $CI->Mydb->get_all_records('id ,name', 'constituencies', $where_array, '', '', array('name' => "ASC"));


        return $records;
    }

}

if (!function_exists('get_all_categories')) {

    function get_all_categories($parent, $indent = 2) {
        $output = '';
        $CI = & get_instance();
        $sqlResult = $CI->Mydb->custom_query("SELECT * from categories WHERE parent_id=" . $parent . " ORDER BY name ASC");
        $num_rows = count($sqlResult);

        if ($num_rows > 0) {
            $i = 1;
            foreach ($sqlResult as $row) {
                $output [$i]['parent_name'][$row['id']] = $row['name'] . '<br>';
                if (has_sub($row['id'])) {
                    $output [$i]['sub_name'][$row['id']] = get_all_categories($row['id'], $indent++);
                }
                $i++;
            }
        }
//		print_r($output);die;
        return $output;
    }

}

/* Get All States list    */
if (!function_exists('get_states_by_country')) {

    function get_states_by_country($name, $where = '', $selected = '', $extra = '', $multiselect = null) {
        $CI = & get_instance();
        $data = array('' => get_label('Select State'));
        $records = "";
        $select = "id,name";
        $records = $CI->Mydb->get_all_records($select, 'states', $where);
        if (!empty($records)) {
            foreach ($records as $value) {
                $data[$value['id']] = stripslashes($value['name']);
            }
        }
        $extra = ($extra != '') ? $extra : 'class="form-control states_by_country" id="states_by_country" ';

        if ($multiselect)
            return form_multiselect($name, $data, $selected, $extra);
        else
            return form_dropdown($name, $data, $selected, $extra);
    }

}

/* Get All  districts list    */
if (!function_exists('get_districts_by_state')) {

    function get_districts_by_state($name, $where = '', $selected = '', $extra = '', $multiselect = null) {
        $CI = & get_instance();
        $data = array('' => get_label('Select Districts'));
        $records = "";
        $select = "id,name";
        $records = $CI->Mydb->get_all_records($select, 'districts', $where);
        if (!empty($records)) {
            foreach ($records as $value) {
                $data[$value['id']] = stripslashes($value['name']);
            }
        }
        $extra = ($extra != '') ? $extra : 'class="form-control districts_by_state" id="districts_by_state" ';

        if ($multiselect)
            return form_multiselect($name, $data, $selected, $extra);
        else
            return form_dropdown($name, $data, $selected, $extra);
    }

}



/* Get All constituencies list    */
if (!function_exists('s3_bucket_url')) {

    function s3_bucket_url($bucket, $name) {
        return "http://" . $bucket . ".s3-accelerate.amazonaws.com/" . $name;
    }

}

/* Get All constituencies list    */
if (!function_exists('get_constituencies_by_district')) {

    function get_constituencies_by_district($name, $where = '', $selected = '', $extra = '', $multiselect = null) {
        $CI = & get_instance();
        $data = array('' => get_label('Select Constituency'));
        $records = "";
        $select = "id,name";
        $records = $CI->Mydb->get_all_records($select, 'constituencies', $where);
        if (!empty($records)) {
            foreach ($records as $value) {
                $data[$value['id']] = stripslashes($value['name']);
            }
        }
        $extra = ($extra != '') ? $extra : 'class="form-control constituencies_by_districts" id="constituencies_by_districts" ';

        if ($multiselect)
            return form_multiselect($name, $data, $selected, $extra);
        else
            return form_dropdown($name, $data, $selected, $extra);
    }

}

if (!function_exists('stripslashes_array')) {

    function stripslashes_array(&$arr) {
        foreach ($arr as $k => &$v) {
            $nk = stripslashes($k);
            if ($nk != $k) {
                $arr[$nk] = &$v;
                unset($arr[$k]);
            }
            if (is_array($v)) {
                stripslashes_array($v);
            } else {
                $arr[$nk] = htmlspecialchars_decode(stripslashes(stripslashes(strip_tags($v))), ENT_QUOTES);
            }
        }
        return $arr;
    }

}


if (!function_exists('get_media_icon')) {

    function get_media_icon($media_type) {
        switch ($media_type) {
            case '1':
                $result = "text-block";
                break;
            case '2':
                $result = "photo-block";
                break;
            case '3':
                $result = "audio-block";
                break;
            case '4':
                $result = "video-block";
                break;
        }
        return $result;
    }

}
/* Color Code */
if (!function_exists('random_color_part')) {

    function random_color_part() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

}
if (!function_exists('random_color')) {

    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }

}


if (!function_exists('get_ad_chat_conversation')) {

    function get_ad_chat_conversation() {
        $CI = & get_instance();
        $session_id = $CI->session->userdata('session_id');
        if ($session_id == '') {
            return array();
        }
        $result = $CI->Mydb->custom_query("select * from chat where session_id='" . $session_id . "'");
        //  echo $this->db->last_query();
        return $result;
        foreach ($result as $key => $value) {
            if ($value["message"] != '') {
                $class_name = ($value["sent_by"] == 0 ? 'user-message' : 'admin-message');
                $data[] = '<p class="' . $class_name . '">' . htmlentities($value["message"]) . '<span>' . date("M h:m:a", strtotime($value['time'])) . '</span></p>';
            }
        }
    }

}

/* create notification */
if (!function_exists('create_notification')) {

    function create_notification($to_user_id, $type, $msg, $from_user_id, $id = null) {
        $CI = & get_instance();
        $user_record = $CI->Mydb->get_record('*', 'users', array('id' => $from_user_id));
        $data = array();
        if ($type == 'news') {
            $data = array("created" => current_date(),
                "msg" => $msg . ' by ' . $user_record['first_name'] . ' ' . $user_record['last_name'],
                "login_id" => $from_user_id,
                'type' => $type,
                "to_user_id" => $to_user_id,
                'news_id' => $id,
                "is_read" => 0,
                "ip_address" => get_ip());
        } else if ($type == 'user') {
            $data = array("created" => current_date(),
                "msg" => $msg . ' by ' . $user_record['first_name'] . ' ' . $user_record['last_name'],
                "login_id" => $from_user_id,
                'type' => $type,
                "to_user_id" => $to_user_id,
                'user_id' => $id,
                "is_read" => 0,
                "ip_address" => get_ip());
        } else {
            $data = array("created" => current_date(),
                "msg" => $msg . ' by ' . $user_record['first_name'] . ' ' . $user_record['last_name'],
                "login_id" => get_admin_id(),
                'type' => $type,
                "to_user_id" => $to_user_id,
                "is_read" => 0,
                "ip_address" => get_ip());
        }
        $CI->Mydb->insert('notification', $data);
    }

}



