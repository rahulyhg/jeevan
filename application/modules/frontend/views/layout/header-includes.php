<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo skin_url(); ?>css/style.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/animate.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato-regular/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lemon-tuesdayfont/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>OCRAStd/styles.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato_fonts/stylesheet.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">  
<link rel="stylesheet" href="<?php echo skin_url(); ?>event/css/calendar.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>theme/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>theme/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib(); ?>theme/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo load_lib();?>theme/css/select2.min.css">


<link rel="alternate" href="https://www.jeevanacharya.com" hreflang="en-us" />
<link rel="alternate" href="https://www.jeevanacharya.com" hreflang="en-gb" /> 
<link rel="alternate" href="https://www.jeevanacharya.com" hreflang="km-kh" />
<link rel="alternate" href="https://www.jeevanacharya.com" hreflang="hi-in" />
<link rel="alternate" href="https://www.jeevanacharya.com" hreflang="en-in" /> 

<meta name="yandex-verification" content="da9c3677fe610813" />
<meta name="msvalidate.01" content="29B3BD53EF4F87F322C71BE1FF8CC9F8" />
<link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/dropzone.css">
<script type="text/javascript" src="<?php echo load_lib();?>theme/js/dropzone.js"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K9BQDGW');</script>
<!-- End Google Tag Manager -->





<!--<link rel="stylesheet" href="<?php echo skin_url(); ?>css/jquery.mCustomScrollbar.css">-->
<!-- <script src="<?php //echo skin_url();      ?>js/jquery-3.1.1.min.js"></script> -->
<script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery.min.1.10.1.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/select2.full.min.js"></script>
<script src="<?php echo skin_url(); ?>js/marquee.js"></script>
<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/user_script.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo load_lib(); ?>theme/js/owl.carousel.min.js"></script>
<!--<script src="<?php echo skin_url(); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<?php /* common javascript varibles ... */ ?>
<script>
    var admin_url = "<?php echo frontend_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var skin_url = "<?php echo skin_url(); ?>";
    var lod_lib = "<?php echo load_lib(); ?>";
    var module = "<?php echo $module; ?>";
    var module_label = "<?php echo $module_label; ?>";
    var module_labels = "<?php echo $module_labels; ?>";
    var module_action = "<?php echo (isset($module_action) ? $module_action : '' ); ?>";
    var secure_key = "<?php echo $this->security->get_csrf_hash(); ?>";
	
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-97099844-1', 'auto');
    ga('send', 'pageview');

</script>