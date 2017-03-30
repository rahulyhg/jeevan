<?php
if(!empty($params)){
?>

<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 letter news_letter">


<div class="col-lg-9 col-xs-12 letter_text">
    <h3><?php echo $params->newsletter_title; ?></h3>
    <p><?php echo $params->newsletter_subtitle; ?></p>
</div>

<?php if($params->newsletter_icon == 'show'){ ?>
<div class="col-lg-3 col-xs-3">
	<img src="<?php echo skin_url(); ?>img/msg.png" alt="msg">
</div>
<?php } ?>


    <div class="col-lg-12">
        <form id="newsletter_form" class="form-horizontal" name="newsletter_form" method="post">
            <div class="col-lg-5 col-xs-12 form-group">
                <input type="text" name="newsletter_name"  id="newsletter_name" class="form-control" placeholder="Name">
                <input type="hidden" name="action" value="Subcribe">
            </div>
            <div class="col-lg-5 col-xs-12 form-group">
                <input type="text" class="form-control" placeholder="E-mail" name="newsletter_email" id="newsletter_email">
            </div>
            <div class="col-lg-2 col-xs-12 input-group">
                <div class="btn-group">
                    <input class="btn" id="newsletter_submit" name="newsletter_submit" value="<?php echo $params->newsletter_button; ?>" type="submit">
                </div>
            </div>
        </form>
        <div class="clearfix"></div><div class="newsletter_status"></div>
    </div>


  
</div>

<script type="text/javascript">
 $("#newsletter_form").validate({
ignore: ".ignore",
rules: {
	newsletter_name:{required: true,lettersonly: true},
	newsletter_email:{required: true,email: true},
},
messages: {
	newsletter_name:{required: "Enter your name",lettersonly: "Type only letter and white space"},
	newsletter_email:{required: "Enter your email id",email: "Invaild email id"},
},
submitHandler: function (form) {
	
	var request;
	$('#newsletter_submit').attr("disabled", true);
	var last = $('#newsletter_form').serialize();
	request =  $.ajax({
		type: 'POST',
		url: '<?php echo frontend_url('newsletter'); ?>',
		dataType:"json",
		data:last,
		success: function(data) {
			
			if (data.status == 'success') {
				$('.newsletter_status').addClass('text-success');
				$('.newsletter_status').html(data.message).slideDown();
				$("#newsletter_name").val('');
				$("#newsletter_email").val('');
			}
			else {
				$('.newsletter_status').addClass('text-warning');
				$('.newsletter_status').html(data.message).slideDown();
				$("#newsletter_name").val('');
				$("#newsletter_email").val('');
				$('#newsletter_submit').attr("disabled", false);
			} 
		}
	});
}
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
}, "type only letter and white space");


</script>
<?php
}
?>
