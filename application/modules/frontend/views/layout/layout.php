<!doctype html>
<html lang="en">
<head>

<?php 

if(base_url(uri_string()) == BASE_URL() || base_url(uri_string()) == BASE_URL('program')){
	if(base_url(uri_string()) == BASE_URL()){
		?>
		<title>Jeevanacharya - Shri Kumaran Swami Gurujee</title><meta name="robots" content="index,follow" /> <meta name="description" content="Shri Kumaran Swami Gurujee, is a Noble Soul and a Precious Gem whom the Mother Earth has given birth to serve the world for the great cause of World Peace." /> <meta name="keywords" content="Shri Kumaran Swami Gurujee, Jeevanacharya" /> 
        <?php	
	}elseif(base_url(uri_string()) == BASE_URL('program')){
		?>
        <title>Jeevanacharya Tour Plan - Travel Program</title><meta name="robots" content="index,follow" /> <meta name="description" content="Tentative Tour Programme of Jeevanacharya, watch and get connected with his way of  life." /> <meta name="keywords" content="Jeevanacharya Tour Plan, Jeevanacharya Travel Program" /> 
        <?php
	}
}else{	

	load_meta_tags(array('metatitle'=>(isset($meta_title)? $meta_title: ''),'metacontent'=>(isset($meta_content)? $meta_content : ''),'metakeyword'=>(isset($meta_keyword)? $meta_keyword : '')));
	
}
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
