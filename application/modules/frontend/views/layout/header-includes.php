<meta name="viewport" content="width=device-width, initial-scale=1">
 
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/style.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/animate.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato regular/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lemon tuesdayfont/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>OCRAStd/styles.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato_fonts/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">  
<link rel="stylesheet" href="<?php echo skin_url(); ?>event/css/calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/jquery.fancybox.css">

<script src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo skin_url(); ?>js/marquee.js"></script>
<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap-datetimepicker.js"></script>
<?php /* common javascript varibles ...*/ ?>
<script>
 var admin_url ="<?php echo frontend_url(); ?>";
 var skin_url ="<?php echo skin_url(); ?>";
 var lod_lib = "<?php echo load_lib(); ?>";
 var module ="<?php echo $module; ?>";
 var module_label = "<?php echo $module_label; ?>";
 var module_labels = "<?php echo $module_labels; ?>";
 var module_action  = "<?php echo (isset($module_action)? $module_action : '' );?>"; 
 var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97099844-1', 'auto');
  ga('send', 'pageview');

</script>