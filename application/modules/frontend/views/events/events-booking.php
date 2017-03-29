<?php 
//pr($records);

?>
<style>

#myModal1 h3 {
    font-size: 18px;
    font-family: 'latolight';
    color: #fff;
    margin: 0px;
}

</style>
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">
<script src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap-datetimepicker.js"></script>  
<div class="event-details">

<h1><?php echo $records['title']; ?></h1>
<p> <?php echo $records['description']; ?></p>
</div>
 <p>Take the simple yet life-changing step by filling up and submitting the appointment form given below. May the grace of Jeevanacharya fall upon you and help you stay connected with his glory.</p>
                    <h5>Appointment Form</h5>
                    <form id="contact_form" class="form-horizontal" action="gurujee_form.php" name="contact_form" method="post">
                        <div class="form-group">
                            <label class="col-xs-4 control-label">First name </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-4 control-label">Email </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Phone number</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phonenumber" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Appointment date</label>
                            <div class="col-xs-6 dateContainer">
                                <div class="input-group date" id="datetimepicker">
                                    <input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY h:m A" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 control-label">Purpose of Appointment</label>
                            <div class="col-xs-6">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="purpose[]" id="purpose" value="Astrology" />Astrology</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="purpose[]" id="purpose" value="Business Problem" /> Business Problem</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="purpose[]" id="purpose" value="Marriage Problem" />Marriage Problem</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="purpose[]" id="purpose" value="Family Problem" /> Family Problem</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="purpose[]" id="purpose" value="Other Problem" /> Other Problem</label>
                                </div>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-xs-4 control-label">Message</label>
                            <div class="col-xs-6">
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" class="btn btn-default" id="contact_submit" name="contact_submit" value="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                <div class="contact_gurujee"></div>
                <script type="text/javascript">
                $("#datetimepicker").datetimepicker({
                    autoclose: true,
                    todayBtn: true,
                    pickerPosition: "bottom-left"
                });
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