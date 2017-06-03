<div class="modal fade" id="register-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px; width:100%; position:relative; float:left;">
            <div class="modal-header">
                <h3 class="modal-title">REGISTER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 100px">
            	<div class="col-md-8 col-md-offset-2 col-xs-12">
            	<div class="alert reg_alert" role="alert" style="display:none;"></div>   
                <?php echo form_open_multipart(frontend_url('user/register'), ' class="register_form" id="register_form" '); ?>
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">User Name </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_username" name="admin_username" />
                        <span for="admin_username" class="text-danger"></span>
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">First Name </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_firstname" name="admin_firstname" />
                        <span for="admin_firstname" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Last Name </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_lastname" name="admin_lastname" />
                        <span for="admin_lastname" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Email Address </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_email_address" name="admin_email_address" />
                        <span for="admin_email_address" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Mobile Number </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_phone_number" name="admin_phone_number" />
                        <span for="admin_phone_number" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Country </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_country" name="admin_country" />
                        <span for="admin_country" class="text-danger"></span>
                    </div>
                    
                </div>
                <!--<div class="form-group">
                    <label class="col-xs-12 control-label">Country Location </label>
                    <div class="col-xs-12">
                    	<?php
						//$get_countries = get_countries();
						
						?>
                        <select class="form-control select2dropdown" id="admin_country" name="admin_country">
                        	<option value="">Select Country</option>
                            <?php
							//foreach($get_countries as $country){
							?>
                            <option value="<?php //echo $country['id'] ?>"><?php //echo $country['name']; ?></option>
                            <?php 
							//}
							?>
                        </select>
                        <span for="admin_country" class="text-danger"></span>
                    </div>
                    
                </div>-->
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">Password </label>
                    <div class="col-xs-12">
                        <input type="password" class="form-control" id="admin_password" name="admin_password" />
                        <span for="admin_password" class="text-danger"></span>
                    </div>
                    
                </div>
                
                
                <div class="col-xs-12 text-center">
                <br>
                <?php echo form_submit('submit', 'Create an Account', ' id="login_submit" class="btn btn-success" '); ?>
                
                <br><br>
                </div>
                <?php
				echo form_hidden ( 'action', 'Register' );
				echo form_close();
				?>
                
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
$("#register_form").validate({
	ignore: ".ignore",
	rules: {
		admin_username:{required: true},
		admin_firstname:{required: true},
		admin_lastname:{required: true},
		admin_email_address:{required: true, email: true},
		admin_phone_number:{required: true, number: true},
		admin_country:{required: true},
		admin_password:{required: true},
		
	},
	messages: {
		admin_username:{required: "Enter your user name"},
		admin_firstname:{required: "Enter your first name"},
		admin_lastname:{required: "Enter your last name"},
		admin_email_address:{required: "Enter your email address", email: "Invaild email"},
		admin_phone_number:{required: "Enter your mobile number", number: "Invaild number"},
		admin_country:{required: "Choose your country"},
		admin_password:{required: "Enter your password"},
	},
	submitHandler: function (form) {
		$.ajax({
			type: 'POST',
			url: admin_url +'user/register',
			cache: false,
			data: $('#register_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".reg_alert").removeClass("alert-danger");
                    $(".reg_alert").addClass("alert-success");
					$(".reg_alert").show().html(data.message);
				}else{
					$(".reg_alert").removeClass("alert-success");
                    $(".reg_alert").addClass("alert-danger");
					$(".reg_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>