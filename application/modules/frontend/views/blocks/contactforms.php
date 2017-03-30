<div class="col-xs-12 contact_sectionform">
    
    <h4>Get in Touch</h4>
    <form id="contact_form" class="contactus_form" name="contact_form" method="post" >
    		<input type="hidden" name="action" value="feedback">
            <div class="form-group">
                <label for="First Name" class="form-control-label">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
            </div>

            <div class="form-group">
                <label for="Last Name" class="form-control-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="email" class="form-control-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label for="message-text" class="form-control-label">Message</label>
                <textarea class="form-control" name="message_text" id="message-text" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Captcha Code</label>
                <div class="g-recaptcha" id="g-recaptcha"></div>
                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" name="contact_submit" id="contact_submit" value="Submit">
            </div>
    </form>
    <div class="contact_status"></div>
</div>

<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=en"></script>
<script type="text/javascript">
  var CaptchaCallback = function(){        
      $('.g-recaptcha').each(function(){
        grecaptcha.render(this,{'sitekey' : '6Lc_ihcUAAAAAP3T8QWUefbcMAXfS1FWunXgOJgr'});
      })
  };
</script>

<script type="text/javascript">
 $("#contact_form").validate({
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
			var request;
			$('#contact_submit').attr("disabled", true);
			var last = $('#contact_form').serialize();
			request =  $.ajax({
				type: 'POST',
				url: '<?php echo frontend_url('feedback'); ?>',
				dataType:"json",
				data:last,
				success: function(data) {
					if (data.status == 'success') {
						$('.contact_status').addClass('text-success');
						$('.contact_status').html('Thank you for contacting us. We will be in touch with you very soon.!').slideDown();
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