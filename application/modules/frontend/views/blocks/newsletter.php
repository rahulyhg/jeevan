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
      <form id="newsletter_form" name="newsletter_form" action="newscontactform.php" method="post">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="E-mail" name="emailid" id="emailid">
            <div class="input-group-btn">
                <input class="btn btn-danger" id="news_submit" name="news_submit" value="<?php echo $params->newsletter_button; ?>" type="submit">
            </div>
        </div>
    </form>
    <div class="contact_emailid"></div>
</div>
<?php
}
?>