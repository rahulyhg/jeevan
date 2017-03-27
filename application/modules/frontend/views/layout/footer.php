<div class="footer">
	<div class="container">
		<div class="row">
            <?php echo $blocks['site_footer']; ?>
		</div>
	</div>
</div>
<div class="footer_sub">
	<div class="container">
		<div class="row">
        	<?php echo $blocks['site_copyright']; ?>
			
		</div>
	</div>
</div>
<div class="modal fade col-xs-12" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">GET SWAMIJI APPOINTMENT</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
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
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>