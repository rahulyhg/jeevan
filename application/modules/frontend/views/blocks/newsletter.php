<?php
if(!empty($params)){
?>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 letter">

    <h3><?php echo $params->newsletter_title; ?></h3>
        <div class="row">
        <div class="col-lg-10 col-xs-9 letter_text">
            <p><?php echo $params->newsletter_subtitle; ?></p>
        </div>
        <?php if($params->newsletter_icon == 'show'){ ?>
        <div class="col-lg-2 col-xs-3">
            <img src="<?php echo skin_url(); ?>img/msg.png" alt="msg">
        </div>
        <?php } ?>
        </div>
      <form id="newsletter_form" name="newsletter_form" action="<?php echo frontend_url('newsletter'); ?>" method="post">
      	<div class="form-group">
        	<input type="text" name="newsletter_name"  id="newsletter_name" class="form-control" placeholder="Name">
            <input type="hidden" name="action" value="Subcribe">
        </div>
        <div class="input-group">
        	
            <input type="text" class="form-control" placeholder="E-mail" name="newsletter_email" id="newsletter_email">
            <div class="input-group-btn">
                <input class="btn btn-danger" id="news_submit" name="news_submit" value="<?php echo $params->newsletter_button; ?>" type="submit">
            </div>
        </div>
    </form>
    <div class="contact_emailid"></div>
</div>

<script src="<?php echo skin_url(); ?>js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    

		$("#newsletter_form").validate({
		//ignore: ".ignore",
		rules: {
			emailid:{required:true, email: true},
		},
		messages: {
			emailid:{required: "Enter your email id", email: "Invaild email id"},
		},
		
	});
});
</script>
<?php
}
?>
