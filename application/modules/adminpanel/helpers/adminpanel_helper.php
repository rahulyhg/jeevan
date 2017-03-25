<?php 
/**************************
 Project Name	: POS
Created on		: 19 Feb, 2016
Last Modified 	: 24  Feb, 2016
Description		:  this file contains adminpanel helper function.
***************************/
/* get admin session  label */
if (! function_exists ( 'get_admin_id' )) {
	function get_admin_id() {
		$CI = & get_instance ();
		return  $CI->session->userdata('nc_admin_id');
	}
}

/* this method used to get admin records per page value */
if (! function_exists ( 'admin_records_perpage' )) {
	function admin_records_perpage() {
		$CI = & get_instance ();
		return 5;
	}
}

/* this function used to show output status */
if (!function_exists('show_status')) {

	function show_status($sts = null, $id, $disabled = false) {

		$is_digit = ctype_digit((string) $sts);

		$status = '';
		if ($is_digit) {
			if ($disabled) {
				$status .='<a href="javascript:void(0);" class="btn btn-link" disabled>';
				$status .= ($sts == "1" ? '<i class="fa fa-unlock status" title=" ' . get_label('active') . '" id=' . encode_value($id) . ' ></i>' : ($sts == "0" ? '<i class="fa fa-lock status" title="' . get_label('inactive') . '"  id=' . encode_value($id) . ' ></i>' : '' ) );
				$status .= '</a>';
			} else {
				$status .='<a href="javascript:void(0);" class="btn btn-link" >';
				$status .= ($sts == "1" ? '<i class="fa fa-unlock status" title=" ' . get_label('active') . '" id=' . encode_value($id) . ' data="Deactivate"></i>' : ($sts == "0" ? '<i class="fa fa-lock status" title="' . get_label('inactive') . '"  id=' . encode_value($id) . ' data="Activate"></i>' : '' ) );
				$status .= '</a>';
			}
		} else {
			if ($disabled) {
				$status .='<a href="javascript:void(0);" class="btn btn-link" disabled>';
				$status .= ($sts == "1" ? '<i class="fa fa-unlock status" title=" ' . get_label('active') . '" id=' . encode_value($id) . ' ></i>' : ($sts == "0" ? '<i class="fa fa-lock status" title="' . get_label('inactive') . '"  id=' . encode_value($id) . ' ></i>' : '' ) );
				$status .= '</a>';
			} else {
				$status .='<a href="javascript:void(0);" class="btn btn-link" >';
				$status .= ($sts == "1" ? '<i class="fa fa-unlock status" title=" ' . get_label('active') . '" id=' . encode_value($id) . ' data="Deactivate"></i>' : ($sts == "0" ? '<i class="fa fa-lock status" title="' . get_label('inactive') . '"  id=' . encode_value($id) . ' data="Activate"></i>' : '' ) );
				$status .= '</a>';
			}
		}


		return $status;
	}

}
/* Get client category list    */
if(!function_exists('get_client_category'))
{
	function get_client_category($where='',$selected='',$extra='')
	{
		$CI=& get_instance();
		$where_array=($where=='')? array('cate_id !='=>'') :  $where ;
		$records=$CI->Mydb->get_all_records('cate_id,cate_name','client_categories',$where_array,'','',array('cate_name'=>"ASC"));
		$data=array(''=>get_label('select_category'));
		if(!empty($records))
		{
			foreach($records as $value)
			{
				$data[$value['cate_id']] = stripslashes($value['cate_name']);
			}
		}
		$extra=($extra!='')?  $extra : 'class="form-control" id="client_cate" ' ;
		 
		return  form_dropdown('client_cate',$data,$selected,$extra);
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
if (!function_exists('buildMenuTree')) {

	function buildMenuTree(Array $data, $parent = 0) {

		$tree = array();
		foreach ($data as $d) {
			if ($d['parent'] == $parent) {
				$children = buildMenuTree($data, $d['id']);
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
/* Get menu module with submenu */
if (!function_exists('getMenuwithSubmenu')) {

	function getMenuwithSubmenu($name, $where = '', $selected = '', $extra = '') {
		$CI = & get_instance();
		$edit_id = isset($where['id']) ? $where['id'] : "";
		$data = array('' => get_label('Select Menu'));
		$query = get_allmenus('all', $edit_id);
		$parents = array();
		foreach ($query as $row) {
			$parents[] = $row;
		}

		$tree = buildTree($parents);

		//echo "<pre>";print_r($tree);die;
		print("<select name='" . $name . "' " . $extra . ">\n");

		printf("\t<option value=''>%s%s</option>\n", "", 'Select Menu');

		printTree_multiselect($tree, '', '', $selected);
		print("</select>");
	}

}

if (!function_exists('get_allmenus')) {

	function get_allmenus($parent = 'all', $edit_id = "") {
		$CI = & get_instance();
		$CI->db->select('menus.id, menus.name, menus.parent_id as parent');
		$CI->db->from('menus');
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
if (!function_exists('printTree_menulist')) {

	function printTree_menulist($tree, $r = 0, $p = null) {

		$menu_array = array();
		$child_array = array();
		$menu_string = "";
		foreach ($tree as $i => $t) {
				
			$dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';
			$menu_name = $dash.$t['name'];
			$link_type = $t['link_type'];
			$created_on = get_date_formart(($t['created_on']));
			$menu_array[] = array('id'=> $t['id'], 'name' => $menu_name);
			$check_box = form_checkbox('id[]',$t['id'],"","class='multi_check'");
			printf('<tr><th scope="row">'.$check_box);
			printf("<td>$menu_name</td>");
			printf("<td>$link_type</td>");
			printf("<td>$created_on</td>");
			$show_status = show_status($t['is_active'],$t['id']);
			printf("<td>$show_status</a></td>");
			$id=$t['id'];
			$edit_url = admin_url()."menus/edit/".encode_value($id);
			printf('<td><a href="javascript:;" class="delete_record btn btn-danger" id="'.encode_value($id).'"
					data="Delete"><i class="fa fa-trash"
						title="Delete"></i></a>
				 <a  href="'.$edit_url.'" class="btn btn-success"><i class="fa fa-edit"
				title="Edit"></i></a>
				</td></tr>');
				
			if ($t['parent'] == $p) {
				$r = 0;
			}
			if (isset($t['_children'])) {

				printTree_menulist($t['_children'], ++$r, $t['parent']);

			}
		}



	}

}
if (!function_exists('printTree_menus')) {

	function printTree_menus($tree, $r = 0, $p = null, $selected = "") {
			
		foreach ($tree as $i => $t) {
			$dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';
			if($t['id'] == $selected){
				$option_select = "selected=selected";
			}else{
				$option_select = "";
			}
			// $option_select = (in_array($t['id'], $selected)) ? "selected=selected" : "";
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

if (!function_exists('printTree_multiselect')) {

	function printTree_multiselect($tree, $r = 0, $p = null, $selected = "") {
			
		foreach ($tree as $i => $t) {

			$dash = ($t['parent'] == 0) ? '' : str_repeat('-', $r) . ' ';
				
			if(is_array($selected)){
				$option_select = (in_array($t['id'],$selected)) ? "selected=selected" : "";

			}else{

				if($t['id'] == $selected){
					$option_select = "selected=selected";
				}else{
					$option_select = "";
				}
			}
				
			// $option_select = (in_array($t['id'], $selected)) ? "selected=selected" : "";
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
/* create log */
if (!function_exists('create_log')) {

	function create_log($action_type, $type, $msg) {
		$CI = & get_instance();
		$user_record = $CI->Mydb->get_record('*', 'sramcms_master_admin', array('admin_id' => get_admin_id()));
		
		$data = array();
		switch ($action_type) {
			case 'new':
				$data = array("created" => current_date(),
				"msg" => $msg . ' by ' . $user_record['admin_username'] . ' :' . $user_record['admin_email_address'],
				"action_type_id" => 1,
				'type' => $type,
				"login_id" => get_admin_id(),
				"ip_address" => get_ip());
				break;
			case 'edit':
				$data = array("created" => current_date(),
				"msg" => $msg . ' by ' . $user_record['admin_username'] . ' :' . $user_record['admin_email_address'],
				"action_type_id" => 2,
				'type' => $type,
				"login_id" => get_admin_id(),
				"ip_address" => get_ip());
				break;
			case 'delete':
				$data = array("created" => current_date(),
				"msg" => $msg . ' by ' . $user_record['admin_username'] . ' :' . $user_record['admin_email_address'],
				"action_type_id" => 3,
				'type' => $type,
				"login_id" => get_admin_id(),
				"ip_address" => get_ip());
				break;
			case 'status':
				$data = array("created" => current_date(),
				"msg" => $msg . ' by ' . $user_record['admin_username'] . ' :' . $user_record['admin_email_address'],
				"action_type_id" => 4,
				'type' => $type,
				"login_id" => get_admin_id(),
				"ip_address" => get_ip());
				break;
		}
		$CI->Mydb->insert('log', $data);
	}

}

