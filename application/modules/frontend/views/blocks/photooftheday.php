
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
	<h2><?php echo $title; ?></h2> 
    <?php
	$imagefiles =  json_decode($record_photo[0]['image']);
	if(!empty($imagefiles->files[0])){
	?>
    <center><img src="<?php echo media_url().$imagefiles->files[0]; ?>"  height="200"></center>
    <?php } ?>
    <br>
    <p><?php echo $record_photo[0]['description']; ?><br> <?php echo $record_photo[0]['today']; ?></p>
    
</div>