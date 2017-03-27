<title><?php  echo get_label('site_title'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
 
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/style.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/animate.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato regular/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lemon tuesdayfont/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>OCRAStd/styles.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/w3.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato_fonts/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/jquery.bxslider.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/pgwslideshow.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">  

<?php /* common javascript varibles ...*/ ?>
<script>
 var admin_url ="<?php echo frontend_url(); ?>";
 var lod_lib = "<?php echo load_lib(); ?>";
 var module ="<?php echo $module; ?>";
 var module_label = "<?php echo $module_label; ?>";
 var module_labels = "<?php echo $module_labels; ?>";
 var module_action  = "<?php echo (isset($module_action)? $module_action : '' );?>"; 
 var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
</script>