<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/calendar.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/app.js"></script>
<script>
	$(function (){
		$('.simple-marquee-container').SimpleMarquee();
	});
	
	$("#menu-close").click(function(e) {
    	e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
  	$("#menu-toggle").click(function(e) {
    	e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
  });
</script>

<script>
$('html, body').animate({
     scrollTop: $(".scroll_top").offset().top - 20
}, 800);

</script>


<script>
$(function() {
  $(".expand").on( "click", function() {
    $(this).next().slideToggle(200);
    $expand = $(this).find(">:first-child");
    
    if($expand.text() == "+") {
      $expand.text("-");
    } else {
      $expand.text("+");
    }
  });
});
</script>
<!--<script>
$(document).ready(function () {
	location.hash && $(location.hash + '.collapse').collapse('show');
	/*var accordid = $('#according').val();
  	$('#'+accordid + '.collapse').collapse('show');*/
});	
</script>-->
<script>
   $(document).ready(function(){
	   $(window).bind('scroll', function() {
	   var navHeight = $( window ).height() - 100;
			 if ($(window).scrollTop() > navHeight) {
				 $('nav').addClass('fixed');
			 }
			 else {
				 $('nav').removeClass('fixed');
			 }
		});
$('.footer_section3').on('DOMSubtreeModified propertychange',"#twitter-widget-0", function() {
  $(".twitter-timeline").contents().find(".timeline-Tweet-media, .timeline-Header, .timeline-Footer, .timeline-LoadMore").css("display", "none");
  $(".twitter-timeline").contents().find(".timeline-Widget").css({"background": "#120000","left":"-10px", "position":"relative"});
  $(".twitter-timeline").contents().find(".TweetAuthor-name").css({"color": "#ffffff"});
  $(".twitter-timeline").contents().find(".timeline-Tweet-text").css({"color": "#a0a0a0"});
  $(".twitter-timeline").contents().find(".timeline-TweetList-tweet").css({"border-bottom": "1px solid #737373"});
  $(".twitter-timeline").contents().find(".timeline-TweetList-tweet:last-child").css({"border-bottom":"0px"});
  
  
  
  
  $(".twitter-timeline").contents().find(".timeline-Viewport").css({"overflow-x" : "hidden", "overflow-y" : "hidden"});
 
  
  
  $(".footer_section3").css("height", "100%");
});
	
	});
</script>

      