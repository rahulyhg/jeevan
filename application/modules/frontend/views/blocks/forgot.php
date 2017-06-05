<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px; width:100%; position:relative; float:left;">
            <div class="modal-header">
                <h3 class="modal-title">FORGOT PASSWORD</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 300px">
            
            	<div class="col-md-8 col-md-offset-2 col-xs-12">
            	<p class="text-center"></p>
            	<div class="alert forgot_alert" role="alert" style="display:none;"></div>   
                 <?php echo form_open(frontend_url('forgotpassword'), 'class="forgot_form"  id="forgot_form" autocomplete= "' . form_autocomplte() . '" '); ?>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Email Address </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_email_address" name="admin_email_address" />
                        <span for="admin_email_address" class="text-danger"></span>
                    </div>
                    
                </div>
                
                <div class="col-xs-12 text-center">
                <br>
                <?php echo form_submit('submit', 'Forgot', ' id="forgot_submit" class="btn btn-success" '); ?>
                
                
                </div>
                <?php echo form_close(); ?>
                <div class="col-xs-12 text-center"><hr></div>
                
                <a href="javascript:void(0);" data-type="login-modal" data-toggle="modal" class="pull-right allmodal">Go Back Login</a>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<script>
$("#forgot_form").validate({
	ignore: ".ignore",
	rules: {
		admin_email_address:{required: true, email: true},
		
	},
	messages: {
		admin_email_address:{required: "Enter your email address", email: "Invaild email"},
	},
	submitHandler: function (form) {
		
		$.ajax({
			type: 'POST',
			url: admin_url +'user/forgotpassword',
			cache: false,
			data: $('#forgot_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".forgot_alert").removeClass("alert-danger");
                    $(".forgot_alert").addClass("alert-success");
					$(".forgot_alert").show().html(data.message);
					
				}else{
					$(".forgot_alert").removeClass("alert-success");
                    $(".forgot_alert").addClass("alert-danger");
					$(".forgot_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>