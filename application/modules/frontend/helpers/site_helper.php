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
		return  $CI->session->userdata('current_user_id');
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
	function show_status($sts=null,$id) {

		return ($sts == "A" ? '<i class="fa fa-unlock status" title=" '.get_label('active').'" id='.encode_value($id).' data="Deactivate"></i>' : ($sts == "I" ? '<i class="fa fa-lock status" title="'.get_label('inactive').'"  id='.encode_value($id).' data="Activate"></i>' : '' )  );
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
/* Get Child menu */
if (!function_exists('get_menu_childs')) {
	function get_menu_childs($parent_id)
	{
		$CI = & get_instance();
		$CI->db->select('id, name, page_id, url, parent_id, link_type, is_parent,created_on, is_active, position, target');
		$CI->db->from('menus');
		$CI->db->where('is_delete !=', 1);
		if(!empty($parent_id)){
			$CI->db->where('parent_id = ', $parent_id);
		}
		$has_subcats = FALSE;
		
		$html_out  = '';
		$class_parent = "dropdown";
		$html_out .= "\t\t\t\t\t".'<ul class="submenu">'."\n";
		if ($query = $CI->db->get()) {
			foreach ($query->result() as $row)
			{
				$id = $row->id;
				$title = $row->name;
				$link_type = $row->link_type;
				$page_id = $row->page_id;
				$url = $row->url;
				$position = $row->position;
				$target = $row->target;
				$parent_id = $row->parent_id;
				$is_parent = $row->is_parent;
				
				$has_subcats = TRUE;
				if($link_type == 'categories'){
					$url = frontend_url('newslist/'.get_news_category_slug($page_id));
				}elseif($link_type == 'page'){
					$url = frontend_url('pages/'.get_cms_page_slug($page_id));
				}else{
					$url = $menu_item['url'] ? $menu_item['url'] :'#';
				}
				if ($is_parent == TRUE)
				{
					
					$html_out .= "\t\t\t\t\t\t".'<li class="dropdown">'.anchor($url, $title, 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
					
				}
				else
				{
					$html_out .= "\t\t\t\t\t\t".'<li class="">'.anchor($url, $title, 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
				}
				
				// Recurse call to get more child submenus.
				$html_out .= get_menu_childs($id);
			}
			$html_out .= '</li>' . "\n";
			$html_out .= "\t\t\t\t\t".'</ul>' . "\n";
			
			
			return ($has_subcats) ? $html_out : FALSE;
		}
		
		
	}
}


