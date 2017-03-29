
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.min.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/calendar.js"></script>
<script type="text/javascript" src="<?php echo skin_url('event');?>/js/app.js"></script>
<script type="text/javascript">
    $("#datetimepicker").datetimepicker({
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left"
    });
</script>   
<script>
	<script>
	new WOW() .init();
</script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});
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

<script type="text/javascript">
$(function () {

    $('.datetimePicker').datetimepicker({
        /*format: 'YYYY-MM-DD',
        maxDate: moment().endOf('day')*/
    });

});
           
</script>

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

<script> /* only to stop # links page jump on demo */
	var noclick = document.getElementById('pie-menu').getElementsByTagName('a');
	for (var i = 0; i < noclick.length; ++i){
	noclick[i].onclick = function(){ return false }
	}
</script>

<script>
  $(document).ready(function(){
    var divCount = document.getElementsByTagName('.pie').length;
    for(var i = 0; i <= divCount; i++) {
        $('.pie').eq(i).addClass('blackPos');
        $('.pie').eq(i).animate({webkitTransform: 'rotate(45deg)', left: '+=5%'});
    };
);
</script>






<script>
	$('.multi-item-carousel').carousel({
  interval: false
});

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-item-carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  } else {
  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
</script>

<script>
	$(document).ready(function() {
      $("#owl-demo").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 3,
 	itemsDesktop : [1199,2],
    itemsDesktopSmall : [980,2],
    itemsTablet: [768,2],
    itemsTabletSmall: false,
    itemsMobile : [479,1],
      });
			carousel.owlCarousel({
    navigation:true,
    navigationText: [
      "<i class='icon-chevron-left icon-white'><</i>",
      "<i class='icon-chevron-right icon-white'>></i>"
      ],
  });
    });
</script>

<script type="text/javascript">
		$("#contact1_form").validate({
		ignore: ".ignore",
		rules: {
			firstname:{required: true,lettersonly: true},
			lastname:{required: true,lettersonly: true},
			email:{required: true,email: true},
			message_text:{required: true,},
			"hiddenRecaptcha": {
				 required: function() {
					 if(grecaptcha.getResponse() == '') {
						 return true;
					 } else {
						 return false;
					 }
				 }
			}
		},
		messages: {
			firstname:{required: "Enter your name",lettersonly: "Type only letter and white space"},
			lastname:{required: "Enter your lastname",lettersonly: "Type only letter and white space"},
			email:{required: "Enter your email id",email: "Invaild email id"},
			message_text:{required: "Enter your Message",},
			"hiddenRecaptcha" : {required: "Please click on the reCAPTCHA box",}
		},
		submitHandler: function (form) {
			//alert('a');
			var request;
			$('#contact1_submit').attr("disabled", true);
			var last = $('#contact1_form').serialize();
			request =  $.ajax({
				type: 'POST',
				url: 'contact1_mail.php',
				data:last,
				success: function(res) {
					//alert(res);
					//alert('b');
					if (res == 'successful') {
						$('.contact_status').addClass('text-success');
						$('.contact_status').html('Your message has been sent!').slideDown();
						$("#firstname").val('');
						$("#lastname").val('');
						$("#email").val('');
						$("#message_text").val('');
					}
					else {
						$('.contact_status').addClass('text-warning');
						$('.contact_status').html('Mail not sent, try again!').slideDown();
						$("#firstname").val('');
						$("#lastname").val('');
						$("#email").val('');
						$("#message_text").val('');
						$('#contact_submit').attr("disabled", false);
					} 
				}
			});
		}
	});
	
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=en"></script>
<script type="text/javascript">
  var CaptchaCallback = function(){        
      $('.g-recaptcha').each(function(){
        grecaptcha.render(this,{'sitekey' : '6Lc_ihcUAAAAAP3T8QWUefbcMAXfS1FWunXgOJgr'});
      })
  };
</script>


<script>
		jQuery(document).ready(function($) {
			
 $("#map_iframe").html('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30676638.056241818!2d64.43991442110328!3d20.18793007578521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1487134429231" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>');
        
});
	</script>
	
	<!--#####################   STRAT-->
	
	<script>
	$(document).ready(function() {
  $('#play-video').on('click', function(ev) {
 
    $("#video")[0].src += "&autoplay=1";
    ev.preventDefault();
 
  });
});
</script>
	<script>
document.getElementById("myFrame").addEventListener("load", myFunction);

function myFunction() {
    document.getElementById("tvr").innerHTML = "Iframe is loaded.";
}
</script>





<!--#####################   END-->


<script>
	$(document).ready(function(ev){
    $('#custom_carousel').on('slide.bs.carousel', function (evt) {
      $('#custom_carousel .controls li.active').removeClass('active');
      $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    })
});
	</script>


<script>
	$(document).ready(function() {
    $('.pgwSlideshow').pgwSlideshow({
      autoSlide: true,
		transitionEffect:'fading',
		adaptiveDuration:200,
		transitionDuration:500
		
    });
})
</script>
	<script type="text/javascript">
		$("#contact_form").validate({
		ignore: ".ignore",
		rules: {
			firstname:{required: true,lettersonly: true},
			email:{required: true,email: true},
			phonenumber:{required: true,number: true,minlength: 10},
			dob:{required:true},
			purpose1:{required:true},
			message:{required: true,},
			
		},
		messages: {
			firstname:{required: "Enter your name",lettersonly: "Type only letter and white space"},
			email:{required: "Enter your email id",email: "Invaild email id"},
			phonenumber:{required: "Enter your phone number",number: "Invaild phone number",minlength: "Please enter at least {10} characters."},
			dob:{required:"Enter the Appointment Date"},
			purpose:{required:"purpose of Appointment"},
			message:{required: "Enter your Message"},
		},
		submitHandler: function (form) {
			//alert('a');
			var request;
			$('#contact_submit').attr("disabled", true);
			var last = $('#contact_form').serialize();
			request =  $.ajax({
				type: 'POST',
				url: 'gurujee_form.php',
				data:last,
				success: function(res) {
					//alert(res);
					//alert('b');
					if (res == 'success') {
						$('.contact_gurujee').addClass('text-success');
						$('.contact_gurujee').html('Your message has been sent!').slideDown();
						$("#firstname").val('');
						$("#email").val('');
						$("#phonenumber").val('');
						$("#dob").val('');
						$("#purpose").val('');
						$("#message").val('');
					}
					else {
						$('.contact_gurujee').addClass('text-warning');
						$('.contact_gurujee').html('Mail not sent, try again!').slideDown();
						$("#firstname").val('');
						$("#email").val('');
						$("#phonenumber").val('');
						$("#dob").val('');
						$("#purpose").val('');
						$("#message").val('');
						$('#contact_submit').attr("disabled", false);
					} 
				}
			});
		}
	});
	jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
	}, "type only letter and white space");
	
	$("#phonenumber").keypress(function (e){
	var charCode = (e.which) ? e.which : e.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
		}
	});
</script>
<script type="text/javascript">
		$("#newsletter_form").validate({
		ignore: ".ignore",
		rules: {
			emailid:{required:true, email: true},
		},
		messages: {
			emailid:{required: "Enter your email id", email: "Invaild email id"},
		},
		submitHandler: function (form) {
			//alert('a');
			var request;
			$('#news_submit').attr("disabled", true);
			var last = $('#newsletter_form').serialize();
			request =  $.ajax({
				type: 'POST',
				url: 'newscontactform.php',
				data:last,
				success: function(res) {
					//alert(res);
					//alert('b');
					if (res == 'success') {
						$('.contact_emailid').addClass('text-success');
						$('.contact_emailid').html('Your message has been sent!').slideDown();
						$("#emailid").val('');
					}
					else {
						$('.contact_emailid').addClass('text-warning');
						$('.contact_emailid').html('Mail not sent, try again!').slideDown();
						$("#emailid").val('');
					} 
				}
			});
		}
	});
</script>

<script>
function Scrolldown() {
     window.scroll(0,400); 
}
window.onload = Scrolldown;
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
<script>
$(document).ready(function () {
	var accordid = $('#according').val();
  $('#'+accordid + '.collapse').collapse('show');
});	
</script>

      