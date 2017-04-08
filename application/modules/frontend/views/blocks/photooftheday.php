<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 message_of_day">
    <h2><em><?php echo $title; ?></em></h2>
    <?php
	$imagefiles =  json_decode($record_photo[0]['image']);
	if(!empty($imagefiles->files[0])){
	?>
    <a data-fancybox="gallery" href="<?php echo media_url().$imagefiles->files[0]; ?>"> <img src="<?php echo media_url().$imagefiles->files[0]; ?>" class="img-thumbnail" style="width:100%; height:250px;" alt="jeevanacharya photo"> </a>
    <?php
	}
	?>
</div>