<?php 
//pr($records);

?>

<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap-datetimepicker.css">
<script src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap-datetimepicker.js"></script> 
 <link rel="stylesheet" href="<?php echo skin_url(); ?>lato_fonts/stylesheet.css"> 
<link rel="stylesheet" href="<?php echo skin_url(); ?>lato regular/stylesheet.css"> 

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

.event-details h3 
{
	color: #ff3300;
	font-size: 25px;
	padding: 0px 0px 20px 0px;
}
.event-details h5, .event-booking-form h5
	{
		font-family: 'latobold';
		font-size: 18px;
		padding: 0px 0px 10px 0px;
		color: #1b1b1b;
	}
.event-details h6
	{
		font-family: 'latobold';
		font-size: 18px;
		padding: 0px 0px 0px 0px;
		color: #1b1b1b;
	}
	.event-details p, .event-booking-form p, .checkbox
	{
		color: #7d7777;
		font-size: 14px;
		line-height: 30px;
		font-family: 'latoregular';
		font-weight:100;
		text-align: justify;
	}
em {
	font-size: 30px;
	display: block;
	font-style:normal;
	font-family: 'latobold';
	padding-top: 1.6px;
}
em::before {

	padding: 0 10px 0 0;
	content:url(http://jeevanacharya.com/skin/frontend/img/samyleft.png);
}
em::after
{

	padding: 0 0px 0 10px;
	content:url(http://jeevanacharya.com/skin/frontend/img/samy-right.png);
}
	
.media
{
	width: 100%;
	height: auto;
	border: 2px solid #ff3300;
    margin: 30px 0px 0px 0px !important;
}
.media h4 {
     font-size: 26px;
    color: #ff3300;
    font-family: 'latoheavy';
    line-height: 38px;
    padding: 30px 30px 0px 0px;
}
.media img
{
	margin: 20px 15px 20px 20px;
}

.event-booking-form .form-control{
	   display: block;
    width: 100%;
    height: 40px !important;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 40px !important;
    color: #555;
	box-shadow:none !important;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ababad !important;
    border-radius: 0px !important;
  }
 .event-booking-form  label{
	  font-size: 15px;
    font-weight: 500;
  }
  .event-booking-form  .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 0px !important;
}
.event-booking-form .form-horizontal .radio, .form-horizontal .checkbox {
    min-height: 27px;
    padding: 0px 0px 0px 30px;
}

.event-booking-form input[type=checkbox]{    margin: 7px 0px 0px -30px !important;}
  .event-booking-form input[type=checkbox]:before { content:""; margin-right:15px; display:inline-block !important; width:18px !important; height:18px !important; background:red !important; }
  .event-booking-form input[type=checkbox]:checked:before { background:green ; }


/* images */
  .event-booking-form input[type=checkbox]:before { background: url(<?php echo skin_url(); ?>/img/un_check.png) #fff !important;}
  .event-booking-form input[type=checkbox]:checked:before { background: url(<?php echo skin_url(); ?>/img/check.png) #fff !important; }


.event-booking-form span {
    color: #ff3300 !important;
    background: url(<?php echo skin_url(); ?>/img/al.png) no-repeat #fff !important;	
    padding-left: 25px;
    line-height: 40px;
}
.event-booking-form span:empty {
   background: #fff !important;	
}
.success_heading h3
	{
		color: #ff3300;
		font-size: 25px;
		font-family: 'latoheavy';
	}
	
</style>


<div class="event-details col-xs-12">
  <h3><em><?php echo $records['trip_name']; ?></em></h3>
  <h5>Date:13 MAR 2017</h5>
  <h6><?php echo $records['description']; ?></h6>
  <p><?php echo stripslashes(str_replace('|*|',' >>> ',$records['destinations'])); ?></p>
  
</div>
 
<?php if(isset($show_booking_form) && $show_booking_form == "yes"): ?>
<div class="event-booking-form col-xs-12">
 <p>Take the simple yet life-changing step by filling up and submitting the appointment form given below. May the grace of Jeevanacharya fall upon you and help you stay connected with his glory.</p>
                    <h5>Appointment Form</h5>
                    
                    <div class="contact_gurujee" style="text-align:center;">
                        
                    </div>
                    
                    <form id="contact_form" class="form-horizontal contact_form" action="" name="contact_form" method="post">
                    	
                       
                        <div class="form-group">
                            <label class="col-xs-12 control-label">First name </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="firstname" name="firstname" />
                            </div>
                            <span for="firstname" class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-12 control-label">Email </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="email" name="email" />
                            </div>
                            <span for="email" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 control-label">Phone number</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" />
                            </div>
                            <span for="phonenumber" class="text-danger"></span>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-xs-12 control-label">Purpose of Appointment</label>
                            <div class="col-xs-6">
                                <div class="checkbox">
                                    <input type="checkbox" name="purpose[]" id="purpose" value="Astrology" />Astrology
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="purpose[]" id="purpose" value="Business Problem" /> Business Problem
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="purpose[]" id="purpose" value="Marriage Problem" />Marriage Problem
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="purpose[]" id="purpose" value="Family Problem" /> Family Problem
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="purpose[]" id="purpose" value="Other Problem" /> Other Problem
                                </div>
                                
                            </div>
                            <span for="purpose[]" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                         <label class="col-xs-12 control-label">Place Of Birth </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control placepicker" id="location"  name="location" />
                            </div>
                            <span for="location" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                         <label class="col-xs-12 control-label">Date and Time of Birth   </label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="location_date"  name="location_date" />
                            </div>
                            <span for="location_date" class="text-danger"></span>
                        </div>
                       
                        
                         <div class="form-group">
                            <label class="col-xs-12 control-label">Message</label>
                            <div class="col-xs-6">
                                <textarea class="form-control" id="message" name="message" rows="3" style="min-height:100px; resize:none;" ></textarea>
                            </div>
                            <span for="message" class="text-danger"></span>
                        </div>
                        <input type="hidden" name="event_id" value="<?php echo $records['id']; ?>" /> 
                        <input type="hidden" name="booked_date" value="<?php echo $booking_date; ?>" /> 
                        <div class="form-group">
                            <div class="col-xs-12">
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
						location: {required: true },
            			location_date:{required:true},
            			purpose1:{required:true},
            			message:{required: true,},
						'purpose[]': {required: true	}
            			
            		},
            		messages: {
            			firstname:{required: "Enter your name",lettersonly: "Type only letter and white space"},
            			email:{required: "Enter your email id",email: "Invaild email id"},
            			phonenumber:{required: "Enter your phone number",number: "Invaild phone number",minlength: "Please enter at least {10} characters."},
						location: {required: "Enter your location"},
            			location_date:{required:"Enter the Place of  Date"},
            			purpose:{required:"purpose of Appointment"},
            			message:{required: "Enter your Message"},
						'purpose[]': {required: "Enter your purpose"	}
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
								
								if (data.status == 'success') {
            						$('#contact_form, .event-details, .event-booking-form p, .event-booking-form h5').hide();
									$('.contact_gurujee img').show();
            						$('.contact_gurujee').html("<img src='<?php echo skin_url(); ?>/img/success_popup.png' alt='success message' title='success message'><div class='success_heading'><h3>"+ data.message + "<h3></div>");
            						scroll_error_content('.contact_gurujee');
            						
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6CByIc-IB3nAmQpqh2uu3F4xQKk1Mtm8&sensor=true&libraries=places"> </script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery.placepicker.js"></script>
<script>
$(document).ready(function() {
$(".placepicker").placepicker(); 
});  
</script>
<script type="text/javascript">
	$(function () {
		$('#location_date').datetimepicker();
	});
</script>
</div>
<?php else: ?>

<div class="col-xs-10 col-xs-offset-1">
<div class="media">
    <div class="media-left">
      <img src="<?php echo skin_url(); ?>/img/no_booking_img.png" alt="no booking" title="no booking" class="media-object" style="width:100px">
    </div>
    <div class="media-body">
      <h4 class="media-heading">BOOKING NOT AVAILABLE ON THIS DATE</h4>
    </div>
  </div>
</div>

<?php endif; ?>