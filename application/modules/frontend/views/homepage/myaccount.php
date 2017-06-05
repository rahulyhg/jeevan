<div class="aboutus_section">
	<div class="container">
		<div class="row">
        	
			<div class="col-xs-12 guru_aboutus">
            
				<div class="col-lg-3">
                	<img src="<?php echo $user[0]['profile']; ?>" alt="" width="280" height="280" class="">
                </div>
                <div class="col-lg-9">
                	<div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_username']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_firstname'].' '.$user[0]['admin_lastname']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_email_address']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_phone_number']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_country']; ?></div>
                </div>
                <a href="#myaccountedit-modal" data-toggle="modal" class="btn btn-success">Edit</a><a href="#changepassword-modal" data-toggle="modal" class="btn btn-warning">Change Password</a>
			</div>
			
		</div>
	</div>
</div>

<div class="modal fade" id="changepassword-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px; width:100%; position:relative; float:left;">
            <div class="modal-header">
                <h3 class="modal-title">CHANGE PASSWORD</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 100px">
            	<div class="col-md-8 col-md-offset-2 col-xs-12">
            	<div class="alert changepassword_alert" role="alert" style="display:none;"></div>   
                <?php echo form_open(frontend_url('user/changepassowrd'), 'class="changepassword_form" id="changepassword_form"  '); ?>
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">Old Password </label>
                    <div class="col-xs-12">
                        <input type="password" class="form-control" minlength="6" name="old_password" id="old_password"/>
                        <span for="old_password" class="text-danger"></span>
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-xs-12 control-label">New Password </label>
                    <div class="col-xs-12">
                        <input type="password" class="form-control" minlength="6" name="new_password" id="new_password" />
                        <span for="new_password" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Confirm Password </label>
                    <div class="col-xs-12">
                        <input type="password" class="form-control" minlength="6" name="confirm_password" id="confirm_password"/>
                        <span for="confirm_password" class="text-danger"></span>
                    </div>
                    
                </div>
                
                
                
                <div class="col-xs-12 text-center">
                <br>
                <?php echo form_submit('submit', 'Update', ' id="changepassword_submit" class="btn btn-success" '); ?>
                
                <br><br>
                </div>
                <?php
				echo form_hidden ( 'action', 'Changepassword' );
				echo form_close();
				?>
                
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
$("#changepassword_form").validate({
	ignore: ".ignore",
	rules: {
		old_password:{required: true},
		new_password:{required: true},
		confirm_password:{required: true},
		
	},
	messages: {
		old_password:{required: "Enter your old password"},
		new_password:{required: "Enter your new password"},
		confirm_password:{required: "Enter your confirm password"},
	},
	submitHandler: function (form) {
		$.ajax({
			type: 'POST',
			url: admin_url +'user/changepassword',
			cache: false,
			data: $('#changepassword_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".changepassword_alert").removeClass("alert-danger");
                    $(".changepassword_alert").addClass("alert-success");
					$(".changepassword_alert").show().html(data.message);
					setTimeout(function(){
						window.location.href = base_url;
					} , 1000);
				}else{
					$(".changepassword_alert").removeClass("alert-success");
                    $(".changepassword_alert").addClass("alert-danger");
					$(".changepassword_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>
<div class="modal fade" id="myaccountedit-modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="max-width:700px; width:100%; position:relative; float:left;">
            <div class="modal-header">
                <h3 class="modal-title">MY ACCOUNT EDIT</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 100px">
            	<div class="col-md-8 col-md-offset-2 col-xs-12">
            	<div class="alert myaccount_alert" role="alert" style="display:none;"></div>   
                <?php echo form_open_multipart(frontend_url('user/edit'), ' class="myaccount_form" id="myaccount_form" '); ?>
                               
                <div class="form-group">
                    <label class="col-xs-12 control-label">First Name </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_firstname" name="admin_firstname" value="<?php echo $user[0]['admin_firstname']; ?>"/>
                        <span for="admin_firstname" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Last Name </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_lastname" name="admin_lastname"  value="<?php echo $user[0]['admin_lastname']; ?>"/>
                        <span for="admin_lastname" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Email Address </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_email_address" name="admin_email_address" value="<?php echo $user[0]['admin_email_address']; ?>" />
                        <span for="admin_email_address" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Mobile Number </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_phone_number" name="admin_phone_number" value="<?php echo $user[0]['admin_phone_number']; ?>" />
                        <span for="admin_phone_number" class="text-danger"></span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-xs-12 control-label">Country </label>
                    <div class="col-xs-12">
                        <input type="text" class="form-control" id="admin_country" name="admin_country" value="<?php echo $user[0]['admin_country']; ?>" />
                        <span for="admin_country" class="text-danger"></span>
                    </div>
                    
                </div>
                
              
                <div class="form-group">
                    <label class="col-xs-12 control-label">Profile Image</label>
                    <div class="col-xs-12">
                        
                        <div class="custom_browsefile col-xs-12">
                            <input type="file" name="photo" value="" class="form-control">
                            <span class="result_browsefile"><span class="brows"></span>+ Upload Profile Image</span>
                        </div>
                    </div>
                </div>
                                    
                
                <div class="col-xs-12 text-center">
                <br>
                <?php echo form_submit('submit', 'Update', ' id="login_submit" class="btn btn-success" '); ?>
                
                <br><br>
                </div>
                <?php
				echo form_hidden ( 'action', 'Edit' );
				echo form_close();
				?>
                
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
$("#myaccount_form").validate({
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
			url: admin_url +'user/edit',
			cache: false,
			data: $('#myaccount_form').serialize(),
			dataType : "json",
			success: function(data) {
				if (data.status == "success") {
					$(".myaccount_alert").removeClass("alert-danger");
                    $(".myaccount_alert").addClass("alert-success");
					$(".myaccount_alert").show().html(data.message);
				}else{
					$(".myaccount_alert").removeClass("alert-success");
                    $(".myaccount_alert").addClass("alert-danger");
					$(".myaccount_alert").show().html(data.message);
				}
			}
		});
	}
});
</script>