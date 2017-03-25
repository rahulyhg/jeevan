<!DOCTYPE html>
<html>
<head>
    <title><?php  echo get_label('site_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='<?php echo  load_font('google_lato.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  load_font('google_roboto_condensed.css')?>' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>font-awesome/font-awesome.min.css">
      <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/flat-blue.css">
    
     <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/custom.css">
    <script>
      var BASE_URL =  "<?php echo frontend_url();?>";
    </script>
</head>

<body class="flat-blue login-page">
  
    <div class="jumbotron app-header">
        <div class="container">
		
            <h2 class="text-center"><div class="color-white"> <a class="landing_logo logo" title="pos"><img src="<?php echo load_lib()?>theme/images/site-logo.png" /></a></div></h2>
            <p class="text-center color-white app-description">Refer a Friend And Earn 50 Points</p>
            <p class="text-center"><a role="button" href="<?php echo frontend_url('user/register');?>" class="btn btn-primary btn-lg app-btn">Join Us</a> <a role="button" href="<?php echo frontend_url('user/login');?>" class="btn btn-primary btn-lg app-btn">Sign In</a></p>
        </div>
        <?php echo $blocks['content_left']; ?>
    </div>
  
</body>

</html>
