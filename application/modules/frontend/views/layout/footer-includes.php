<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.min.js"></script>

<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/calendar.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/app.js"></script>
<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/user_script.js"></script>

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
function goBack() {
    window.history.back();
}
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

			
<script>
   $(document).ready(function(){
	   if ($(window).width() > 992) {
		   $(window).bind('scroll', function() {
				if(document.URL == base_url){
					var offet = 100;
				}else{
					var offet = 500;
				}
					var navHeight = $( window ).height() - offet;
				
				if ($(window).scrollTop() > navHeight) {
					$('nav').addClass('fixed');
				}
				else {
					$('nav').removeClass('fixed');
				}
			});
		  }
		
	});
</script>

<link rel="stylesheet" type="text/css" href="<?php echo skin_url(); ?>css//jquery.mCustomScrollbar.min.css">
    <!-- jQuery lib -->

    <!-- custom scrollbar plugin script -->
    <script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
 (function($){
	$(window).load(function(){
		$(".order").mCustomScrollbar({
                setHeight: 430,
                theme: "dark-3"
            });
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
$(".allmodal").click(function(e) {
    $('.modal').modal('hide');
	var id = $(this).attr('data-type');
	$('#'+ id).modal('show');
});
</script>



      