<?php 
//pr($records);

?>

<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">
<script src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap-datetimepicker.js"></script>  
<style>

.modal-content .modal-header h3 {
    font-size: 18px;
    font-family: 'latolight';
    color: #fff;
    margin: 0px;
}
.modal-content .modal-body .btn-default {
    color: #FFF;
    background-color: #5c0104;
    border-color: #ccc;
}

</style>
<div class="event-details">

  <h2><?php echo $records['trip_name']; ?></h2>
  <p><?php echo $records['description']; ?></p>
  <p><?php echo stripslashes(str_replace('|*|',' >>> ',$records['destinations'])); ?></p>  
</div>
 
<?php if(isset($show_booking_form) && $show_booking_form == "yes"): ?>
<div class="event-booking-form">
 <p>Take the simple yet life-changing step by filling up and submitting the appointment form given below. May the grace of Jeevanacharya fall upon you and help you stay connected with his glory.</p>
                    <h5>Appointment Form</h5>
                    <div class="contact_gurujee"></div>
                    <form id="contact_form" class="form-horizontal" action="<?php echo frontend_url().$module.'/user_booking_appointment'; ?>" name="contact_form" method="post">
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
                        <input type="hidden" name="event_id" value="<?php echo $records['id']; ?>" /> 
                        <input type="hidden" name="booked_date" value="<?php echo $booking_date; ?>" /> 
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" class="btn btn-danger" id="contact_submit" name="contact_submit" value="submit">Submit</button>
                            </div>
                        </div>
                    </form>
               
                <script type="text/javascript">
                var site_url ="<?php echo frontend_url(); ?>";
                function scroll_error_content(varid){
                	$('html, body').animate({scrollTop: $(varid).offset().top-200},1000,function(){
                		
                		$(varid+',.error-message').fadeIn();
                	});
                }
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
            			
            			var last = $('#contact_form').serialize();
            			request =  $.ajax({
            				type: 'POST',
            				url: site_url +'/events/user_booking_appointment',
            				data:last,
            				dataType : "json",
            				success: function(data) {
            					alert(data.message);
            					if (data.status == 'success') {
            						$('.contact_gurujee').addClass('text-success');
            						$('.contact_gurujee').html("<div class='alert alert-success'>"+ data.message + "</div>");
            						scroll_error_content('.contact_gurujee');
            						$("#firstname").val('');
            						$("#email").val('');
            						$("#phonenumber").val('');
            						$("#purpose").val('');
            						$("#message").val('');
            					}
            					else {
            						$('.contact_gurujee').addClass('text-warning');
            						$('.contact_gurujee').html("<div class='alert alert-warning'>"+data.message+"</div>");
            						scroll_error_content('.contact_gurujee');
            						
            					    $("#firstname").val('');
            						$("#email").val('');
            						$("#phonenumber").val('');
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
</div>
<?php else: ?>
<div class="alert alert-danger">
  <strong>Booking not available on this date!</strong> 
</div>
<?php endif; ?>