<?php
if(!empty($params)){
?>

<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 letter">

    <h3><?php echo $params->newsletter_title; ?></h3>
        <div class="row">
        <div class="col-lg-10 col-xs-9 letter_text">
            <p><?php echo $params->newsletter_subtitle; ?></p>
        </div>
        <?php if($params->newsletter_icon == 'show'){ ?>
        <div class="col-lg-2 col-xs-3">
            <img src="<?php echo skin_url(); ?>img/msg.png" alt="msg">
        </div>
        <?php } ?>
        </div>
        <form id="newsletter_form" class="form-horizontal" action="<?php echo frontend_url('newsletter'); ?>" name="newsletter_form" method="post">
        
      	<div class="form-group">
        	<input type="text" name="newsletter_name"  id="newsletter_name" class="form-control" placeholder="Name">
            <input type="hidden" name="action" value="Subcribe">
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" placeholder="E-mail" name="newsletter_email" id="newsletter_email">
            <input type="hidden" name="action" value="Subcribe">
        </div>
        <div class="input-group">
        	
            
            <div class="input-group-btn">
                <input class="btn btn-danger" id="news_submit" name="news_submit" value="<?php echo $params->newsletter_button; ?>" type="submit">
            </div>
        </div>
    </form>
    <div class="contact_emailid"></div>
</div>

<script type="text/javascript">
 $("#newsletter_form").validate({
ignore: ".ignore",
rules: {
	newsletter_name:{required: true,lettersonly: true},
	newsletter_email:{required: true,email: true},
},
messages: {
	newsletter_name:{required: "Enter your name",lettersonly: "Type only letter and white space"},
	newsletter_email:{required: "Enter your email id",email: "Invaild email id"},
},
/*submitHandler: function (form) {
	
	var request;
	$('#contact_submit').attr("disabled", true);
	var last = $('#contact_form').serialize();
	request =  $.ajax({
		type: 'POST',
		url: 'gurujee_form.php',
		data:last,
		success: function(res) {
			
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
}*/
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
}, "type only letter and white space");


</script>
<?php
}
?>
