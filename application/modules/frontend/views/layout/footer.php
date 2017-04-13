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


