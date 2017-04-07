<?php
if(!empty($params)){
?>
<div class="news_subscribtions">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-xs-6">
					<img src="<?php echo skin_url(); ?>img/subscribtionsimg.png" alt="news subscription">
				</div>
				<div class="col-xs-6 news_email round letter">
					<h3><em><?php echo $params->newsletter_title; ?></em></h3>
					<p><?php echo $params->newsletter_subtitle; ?></p>
                    <form id="newsletter_form"  name="newsletter_form" method="post">
						<div class="form-group col-xs-6 news_firstname">
							<label for="newsletter_firstname" class="sr-only"></label>
							<input id="newsletter_firstname" class="form-control input-group-lg" type="text" name="newsletter_firstname"
								   title="Enter first name"
								   placeholder="First name"/>
						</div>

						<div class="form-group col-xs-6 ">
							<label for="newsletter_lastname" class="sr-only"></label>
							<input id="newsletter_lastname" class="form-control input-group-lg" type="text" name="newsletter_lastname"
								   title="Enter last name"
								   placeholder="Last name"/>
						</div>
						<div class="clearfix"></div>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="E-mail" name="newsletter_email" id="newsletter_email">
							<div class="input-group-btn">
								<input class="btn btn-danger" id="newsletter_submit" name="newsletter_submit" value="SUBSCRIBE" type="submit">
							</div>
						</div>
        			</form>
                    <div class="clearfix"></div><div class="newsletter_status"></div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
 $("#newsletter_form").validate({
ignore: ".ignore",
rules: {
	newsletter_firstname:{required: true,lettersonly: true},
	newsletter_lastname:{lettersonly: true},
	newsletter_email:{required: true,email: true},
	
},
messages: {
	newsletter_firstname:{required: "Enter your first name",lettersonly: "Type only letter and white space"},
	newsletter_lastname:{lettersonly: "Type only letter and white space"},
	newsletter_email:{required: "Enter your email id",email: "Invaild email id"},
},
submitHandler: function (form) {
	
	var request;
	$('#newsletter_submit').attr("disabled", true);
	var last = $('#newsletter_form').serialize();
	request =  $.ajax({
		type: 'POST',
		url: '<?php echo frontend_url('newsletter'); ?>',
		dataType:"json",
		data:last,
		success: function(data) {
			
			if (data.status == 'success') {
				$('.newsletter_status').addClass('text-success');
				$('.newsletter_status').html(data.message).slideDown();
				$("#newsletter_name").val('');
				$("#newsletter_email").val('');
			}
			else {
				$('.newsletter_status').addClass('text-warning');
				$('.newsletter_status').html(data.message).slideDown();
				$("#newsletter_name").val('');
				$("#newsletter_email").val('');
				$('#newsletter_submit').attr("disabled", false);
			} 
		}
	});
}
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
}, "type only letter and white space");


</script>
<?php
}
?>
