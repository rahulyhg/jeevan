<?php
/**************************
Project Name	: Jeevanacharya
Created on		: 25 March, 2017
Last Modified 	: 25 March, 2017
Description		: Page contains common validation and upload libraie
***************************/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class Common {
		protected $ci;
		public function __construct() {
			$this->ci = & get_instance ();
		}
		/* this function used to validate image */
		function valid_image($files = null) {
			if (isset ( $files ) && ! empty ( $files )) {
				$allowedExts = array (
						"gif",
						"jpeg",
						"jpg",
						"png",
						"GIF",
						"JPEG",
						"JPG",
						"PNG"
				);
				$temp = explode ( ".", $files ['name'] );
				$extension = end ( $temp );
					
				if (! in_array ( $extension, $allowedExts )) {
					return 'No';
				}
			}
			return "Yes";
		}
		/* this function used to validate image */
		function valid_file($files = null) {
			if (isset ( $files ) && ! empty ( $files )) {
				$allowedExts = array (
						"csv",
						"xlsx"
				);
				$temp = explode ( ".", $files ['name'] );
				$extension = end ( $temp );
					
				if (! in_array ( $extension, $allowedExts )) {
					return 'No';
				}
			}
			return "Yes";
		}
		/* this function used to upload image */
		function upload_image($files=null, $file_name = null, $image_path=null) {

			if (isset ( $files ) && ! empty ( $files ) && $image_path != "") {
				$this->ci->load->helper('string');
					
				$config ['upload_path'] = FCPATH . 'media/' . $image_path;
				$config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
				if(!empty($file_name)){
					$config ['file_name'] = $file_name;
				}	else{
					$config ['file_name'] = random_string( 'alnum', 50 );
				}
					
				$this->ci->load->library ( 'upload', $config );
				$this->ci->upload->initialize ( $config );
				if (! $this->ci->upload->do_upload ( $files )) {
				 return "";
				} else {
					$data = $this->ci->upload->data ();
				 return  $data ['file_name'];
				}
					
			}
		}
		/* this function used to upload image */
		function upload_files($files=null, $file_name = null, $file_path=null) {

			if (isset ( $files ) && ! empty ( $files ) && $file_path != "") {
				$this->ci->load->helper('string');
					
				$config ['upload_path'] = FCPATH . 'media/' . $file_path;
				$config ['allowed_types'] = 'csv|pdf|xlsx|txt';
				if(!empty($file_name)){
					$config ['file_name'] = $file_name;
				}	else{
					$config ['file_name'] = random_string( 'alnum', 50 );
				}
					
				$this->ci->load->library ( 'upload', $config );
				$this->ci->upload->initialize ( $config );
				if (! $this->ci->upload->do_upload ( $files )) {
					return "";
				} else {
					$data = $this->ci->upload->data ();
					return  $data ['file_name'];
				}
					
			}
		}
		/* this function used to upload image */
		function upload_media_files($files=null, $file_name = null, $file_path=null) {

			if (isset ( $files ) && ! empty ( $files ) && $file_path != "") {
				$this->ci->load->helper('string');
					
				$config ['upload_path'] = FCPATH . 'media/' . $file_path;
				$config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf|csv|xlsx|mp3|aac|ogg|wma|m4a|flac|wac|mp4|avi|mpg|mov|wmv|mkv|m4v|webm|flv|3gp';
				if(!empty($file_name)){
					$config ['file_name'] = $file_name;
				}	else{
					$config ['file_name'] = random_string( 'alnum', 50 );
				}
					
				$this->ci->load->library ( 'upload', $config );
				$this->ci->upload->initialize ( $config );
				if (! $this->ci->upload->do_upload ( $files )) {
					return $error = array('error' => $this->ci->upload->display_errors());
				} else {
					$data = $this->ci->upload->data ();
					return  $data ['file_name'];
				}
					
			}
		}
		function upload_multiple_files($path, $files)
		{
			 
			$this->load->library('upload', $config);
		
			$images = array();
		
			foreach ($files['name'] as $key => $media_file) {
				$config['upload_path'] = FCPATH . 'media/' . $path;
				$config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf|csv|xlsx|mp3|aac|ogg|wma|m4a|flac|wac|mp4|avi|mpg|mov|wmv|mkv|m4v|webm|flv|3gp';
		
				$_FILES['mediafiles']['name']= $files['name'][$key];
				$_FILES['mediafiles']['type']= $files['type'][$key];
				$_FILES['mediafiles']['tmp_name']= $files['tmp_name'][$key];
				$_FILES['mediafiles']['error']= $files['error'][$key];
				$_FILES['mediafiles']['size']= $files['size'][$key];
				$file_info = pathinfo($_FILES['mediafiles']['name']);
				$extension = $file_info['extension'];
				$file_name_slug = url_title($file_info['filename'], '_');
				$file_name = $file_name_slug . "_" . time() . "." . $extension;
		
				$mediafiles[] = $file_name;
		
				$config['file_name'] = $file_name;
		
				$this->upload->initialize($config);
		
				if ($this->upload->do_upload('mediafiles')) {
					$this->upload->data();
				} else {
					return false;
				}
			}
		
			return $mediafiles;
		}
	}
	/* End of file Common_validation.php */
	/* Location: ./application/libraries/Common_validation.php */
