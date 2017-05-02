<div class="col-xs-12" style="background:#f5f5f5;">
<div class="col-lg-10 col-lg-offset-1 contact_sectionform">
    
    <h4><em>Get in Touch</em></h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
    <form id="contact_form" class="contactus_form row" name="contact_form" method="post" >
    		<input type="hidden" name="action" value="feedback">
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="firstname" class="form-control-label">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname">
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="lastname" class="form-control-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname">
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="email" class="form-control-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            
            <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="phone" class="form-control-label">Phone No</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>

            <div class="form-group col-xs-12">
                <label for="message-text" class="form-control-label">Message</label>
                <textarea class="form-control" name="message_text" id="message-text" rows="5"></textarea>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label">Captcha Code</label>
                <div class="g-recaptcha" id="g-recaptcha"></div>
                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
            <div class="form-group col-xs-12">
                <input type="submit" class="btn btn-default" name="contact_submit" id="contact_submit" value="Submit">
            </div>
    </form>
    <div class="contact_status"></div>
</div>

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
			phone:{required: true,number: true,minlength: 10},
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
			firstname:{required: "Enter your firstname",lettersonly: "Type only letter and white space"},
			lastname:{required: "Enter your lastname",lettersonly: "Type only letter and white space"},
			phone:{required: "Enter your Phone",number: "Invaild phone number",minlength: "Minimum 10 charaters."},
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