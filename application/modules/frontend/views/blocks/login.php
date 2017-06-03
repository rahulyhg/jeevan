<div class="modal fade" id="login-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px; width:100%; position:relative; float:left;">
            <div class="modal-header">
                <h3 class="modal-title">WELCOME TO JEEVANACHARYA</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 300px">
            
            	<div class="col-md-8 col-md-offset-2 col-xs-12">
            	<p class="text-center">You already have an account please login here</p>
            	<div class="alert log_alert" role="alert" style="display:none;"></div>   
                <?php echo form_open(frontend_url('login'), 'class="login_form"  id="login_form" autocomplete= "' . form_autocomplte() . '" '); ?>
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">Email Address </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_email_address" name="admin_email_address" />
                    </div>
                    <span for="admin_email_address" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Password </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_password" name="admin_password" />
                    </div>
                    <span for="admin_password" class="text-danger"></span>
                </div>
                <div class="col-xs-12 text-center">
                <br>
                <?php echo form_submit('submit', 'Login', ' id="login_submit" class="btn btn-success" '); ?>
                
                 <a href="javascript:void(0);" data-type="forgot-modal" data-toggle="modal" class="pull-right allmodal">Forgot Password</a>
                </div>
                <?php echo form_close(); ?>
               
                
                
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<script>
$("#login_form").validate({
	ignore: ".ignore",
	rules: {
		admin_email_address:{required: true, email: true},
		admin_password:{required: true},
		
	},
	messages: {
		admin_email_address:{required: "Enter your email address", email: "Invaild email"},
		admin_password:{required: "Enter your password"},
	},
	submitHandler: function (form) {
		
		$.ajax({
			type: 'POST',
			url: admin_url +'user/login',
			cache: false,
			data: $('#login_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".log_alert").removeClass("alert-danger");
                    $(".log_alert").addClass("alert-success");
					$(".log_alert").show().html(data.message);
					setTimeout(function(){
						window.location.href = base_url+'user/myaccount';
					} , 1000);
				}else{
					$(".log_alert").removeClass("alert-success");
                    $(".log_alert").addClass("alert-danger");
					$(".log_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>