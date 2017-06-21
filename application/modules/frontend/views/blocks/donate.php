<div class="donate_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8">
				<h3><em>Jeevancharya - 1008 Shiva Lingam Fund</em></h3>
				<div class="alert donate_alert" role="alert" style="display:none;"></div> 
				<?php echo form_open_multipart(frontend_url('donation'), ' class="donation_form" id="donation_form" '); ?>	
					<div class="donation_amount">
						<div class="form-group col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<label for="donation_amount" class="form-control-label">Donation Amount </label>
						</div>
						<div class="form-group col-lg-7 col-md-7 col-sm-6 col-xs-12">
							<input type="text" class="form-control" name="donation_amount" id="donation_amount">
						</div>
					</div>
					<div class="donetion_detail">
						<p>Jeevanacharya is registered as a Charitable Trust in India. Donations to Jeevanachrya are exempt from Income Tax under Section 80G of the Income Tax Act.</p>
					</div>
					
					<div class="form_heading">
						<h4>Personal Details</h4>
					</div>
					<input type="hidden" name="action" value="feedback">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="firstname" class="form-control-label">First Name</label>
						<input type="text" class="form-control" name="firstname" id="firstname">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="lastname" class="form-control-label">Last Name</label>
						<input type="text" class="form-control" name="lastname" id="lastname">
					</div>
					
					<div class="form_heading">
						<h4>Contact Details</h4>
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="address" class="form-control-label">Address</label>
						<input type="address" class="form-control" name="address" id="address">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="home_phone" class="form-control-label">Home Phone</label>
						<input type="text" class="form-control" name="home_phone" id="home_phone">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="city" class="form-control-label">City</label>
						<input type="text" class="form-control" name="city" id="city">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="work_phone" class="form-control-label">Work Phone</label>
						<input type="text" class="form-control" name="work_phone" id="work_phone">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="postal_code" class="form-control-label">Postal Code</label>
						<input type="text" class="form-control" name="postal_code" id="postal_code">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="mobile" class="form-control-label">Mobile</label>
						<input type="text" class="form-control" name="mobile" id="mobile">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="state_country" class="form-control-label">State/ Province/ County</label>
						<input type="text" class="form-control" name="state_province_county" id="state_country">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="phone" class="form-control-label">Email</label>
						<input type="email" class="form-control" name="email" id="email">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="country" class="form-control-label">Country</label>
						<input type="text" class="form-control" name="country" id="country">
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="pan" class="form-control-label">PAN Number</label>
						<input type="text" class="form-control" name="pan_number" id="pan_number">
					</div>
					
					<div class="form_heading">
						<h4>Contact Details</h4>
					</div>	

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="work_deatil" class="form-control-label">Work Detail</label>
						<input type="address" class="form-control" name="work_deatil" id="work_deatil">
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<label for="designation" class="form-control-label">Designation</label>
						<input type="text" class="form-control" name="designation" id="designation">
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label for="location" class="form-control-label">Location</label>
						<input type="text" class="form-control" name="location" id="location">
					</div>

					<!--<div class="form-group col-xs-12">
						<label for="message-text" class="form-control-label">Message</label>
						<textarea class="form-control" name="message_text" id="message-text" rows="5"></textarea>
					</div>-->
					
					<div class="checkbox">
						<label>
							<input type="checkbox" value="<?php echo $fund_type; ?>" name="fund_type" checked>
							<span class="cr"><i class="cr-icon fa fa-check"></i></span>
							 I'm contributing this amount towards the Jeevancharya - <?php echo $fund_type; ?>
						</label>
            		</div>
					
					<div class="form-group col-xs-12">
						<input type="submit" class="btn btn-default" name="contact_submit" id="contact_submit" value="Continue to Payment Gateway">
					</div>
    			<?php
				echo form_hidden ( 'action', 'donate' );
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
<script>
$("#donation_form").validate({
	ignore: ".ignore",
	rules: {
		donation_amount:{required: true, number: true},
		firstname:{required: true},
		address:{required: true},
		lastname:{required: true},
		email:{required: true, email: true},
		mobile:{required: true, number: true},
		pan:{required: true},
				
	},
	messages: {
		donation_amount:{required: "Enter your user donation amount"},
		firstname:{required: "Enter your first name"},
		lastname:{required: "Enter your last name"},
		email:{required: "Enter your email address", email: "Invaild email"},
		mobile:{required: "Enter your mobile number", number: "Invaild number"},
		pan:{required: "Enter your PAN number"},
		address:{required: "Enter your Address"},
		
	},
	submitHandler: function (form) {
		$.ajax({
			type: 'POST',
			url: admin_url +'/donation',
			cache: false,
			data: $('#donation_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".donate_alert").removeClass("alert-danger");
                    $(".donate_alert").addClass("alert-success");
					$(".donate_alert").show().html(data.message);
					$('#donation_form').find("input[type=text],input[type=email], input[type=password], textarea").val("");
					 $('.donate_alert').scrollView();
					 
				}else{
					$(".donate_alert").removeClass("alert-success");
                    $(".donate_alert").addClass("alert-danger");
					$(".donate_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>