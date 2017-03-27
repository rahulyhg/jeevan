<!doctype html>
<html>
<head>
<meta charset="utf-8">
   <?php echo $this->load->view('layout/header-includes');?>
</head>
<body>
	<?php echo $this->load->view('layout/header');?>
	<?php echo $site_body; ?>	
    <?php echo $this->load->view('layout/footer');?>  
    <?php echo $this->load->view('layout/footer-includes');?>      
</body>
</html>
