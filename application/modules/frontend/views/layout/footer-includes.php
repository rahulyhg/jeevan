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
<script>
$(document).ready(function () {
	var accordid = $('#according').val();
  $('#'+accordid + '.collapse').collapse('show');
});	
</script>
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
	});
</script>

      