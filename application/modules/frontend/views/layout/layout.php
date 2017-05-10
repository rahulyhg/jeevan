<!doctype html>
<html lang="en">
<head>
<?php 
	load_meta_tags(array('metatitle'=>(isset($meta_title)? $meta_title: ''),'metacontent'=>(isset($meta_content)? $meta_content : ''),'metakeyword'=>(isset($meta_keyword)? $meta_keyword : '')));
?>

   <?php echo $this->load->view('layout/header-includes');?>
</head>
<body class="page-<?php if(uri_string() != ''){ echo str_replace("/", ' ', uri_string()); }else{ echo 'common'; } ?>">
	<?php echo $this->load->view('layout/header');?>
	<?php echo $site_body; ?>	
    <?php echo $this->load->view('layout/footer');?>  
    <?php echo $this->load->view('layout/footer-includes');?>      
</body>
</html>
