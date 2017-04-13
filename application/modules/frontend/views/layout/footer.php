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
<link rel="stylesheet" type="text/css" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jQuery lib -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- custom scrollbar plugin script -->
    <script type="text/javascript" src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
 (function($){
	$(window).load(function(){
	 /* initialize scrollbar */
	$("#twitter-widget-holder").mCustomScrollbar({
		theme:"dark-3",
		scrollButtons:{enable:true}
		  });
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

$('.footer_section3').on('DOMSubtreeModified propertychange',"#twitter-widget-0", function() {
  $("#twitter-widget-0").contents().find(".timeline-Tweet-media, .timeline-Header, .timeline-Footer, .timeline-LoadMore").css("display", "none");
  $("#twitter-widget-0").contents().find(".timeline-Widget").css({"background": "#120000","left":"-10px", "position":"relative"});
  $("#twitter-widget-0").contents().find(".TweetAuthor-name").css({"color": "#ffffff"});
  $("#twitter-widget-0").contents().find(".timeline-Tweet-text").css({"color": "#a0a0a0"});
  $("#twitter-widget-0").contents().find(".timeline-TweetList-tweet").css({"border-bottom": "1px solid #737373"});
  $("#twitter-widget-0").contents().find(".timeline-TweetList-tweet:last-child").css({"border-bottom":"0px"});
  $("#twitter-widget-0").contents().find(".timeline-Viewport").css({"overflow-x" : "hidden", "overflow-y" : "hidden"});
  $(".footer_section3").css("height", "100%");
});

});


})(jQuery);
</script>
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


