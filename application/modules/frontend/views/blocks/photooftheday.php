<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 message_of_day">
 <h2><em><?php echo $title; ?></em></h2>
<div id="owl-demo" class="owl_demo">
   
   <?php
	$imagefiles =  json_decode($record_photo[0]['image']);
		if(!empty($imagefiles->files[0])){
		foreach($imagefiles->files as $images):
	?>
		<div class="item ">
                	<div class="col-xs-12 businesstable-content">
                    	<div class="panel panel-pricing hvr-float-shadow">
                        	<div class="panel-heading">
    <a href="javascript:void(0);"> <img src="<?php echo media_url().$images; ?>" class="img-thumbnail"  alt="jeevanacharya photo"> </a>
	</div>
                   	</div>
                   	</div>
                </div>
    <?php
	endforeach;
	}
	?>
		</div>
	</div>
