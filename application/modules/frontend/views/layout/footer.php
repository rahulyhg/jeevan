<div class="footer">
	<div class="container">
		<div class="row">
            <?php echo $blocks['site_footer']; ?>
		</div>
	</div>
</div>
<div class="footer_sub">
	<div class="container">
		<div class="row">
        	<?php echo $blocks['site_copyright']; ?>
			
		</div>
	</div>
</div>
 <div class="scroll-top-wrapper">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo skin_url(); ?>css/jquery.floating-social-share.css" />
<script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery.floating-social-share.js"></script>
<script>
	$(function(){
 
	$(document).on( 'scroll', function(){
 
		if ($(window).scrollTop() > 110) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
		$('.scroll-top-wrapper').on('click', scrollToTop);
});
	function scrollToTop() {
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $('body');
	offset = element.offset();
	offsetTop = offset.top;
	$('html, body').animate({scrollTop: offsetTop}, 1000, 'linear');
}
</script>
<script>
  $("body").floatingSocialShare({
    buttons: [
      "facebook", "google-plus", "twitter"
    ],
    twitter_counter: true,
    text: "share with: ",
    url: "<?php echo  get_the_current_url(); ?>"
  });
</script>


