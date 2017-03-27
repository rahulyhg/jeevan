<div class="col-xs-12 contact_sectionform">
    <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal1">Book Appointment</button>
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
    <p>Take the simple yet life-changing step by filling up and submitting the appointment form given below. May the grace of Jeevanacharya fall upon you and help you stay connected with his glory.</p>
    <h4>Get in Touch</h4>
    <form id="contact1_form" class="contactus_form" action="contact1_mail.php" name="contact1_form" method="post" >
            <div class="form-group">
                <label for="First Name" class="form-control-label">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
            </div>

            <div class="form-group">
                <label for="Last Name" class="form-control-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
            </div>

            <div class="form-group">
                <label for="email" class="form-control-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label for="message-text" class="form-control-label">Message</label>
                <textarea class="form-control" name="message_text" id="message-text" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label">Captcha Code</label>
                <div class="g-recaptcha" id="g-recaptcha"></div>
                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" name="contact1_submit" id="contact1_submit" value="Submit">
            </div>
    </form>
    <div class="contact_status"></div>
</div>