<div class="galleryviews">
	<div class="container">
    	<div class="row">
        	
        <h3 class="text-center"><?php echo $gallery[0]['gallery_category']; ?></h3>
        
       <?php
	   if(!empty($gallery)){
		   foreach($gallery as $gallery_details){
	   ?>
        
        <div class="col-lg-3 col-sm-4 col-xs-6">
            <a title="<?php echo $gallery_details['title']; ?>" href="javascript:void(0);" data-title="<?php echo $gallery_details['media_type']; ?>">
               
               <?php
			   if($gallery_details['media_type'] == '3'){
			   ?>
               	<iframe id="video" src="<?php echo $gallery_details['file_name']; ?>?rel=0" frameborder="0" allowfullscreen style="width:100%; height:250px; display:none;"></iframe>
                <?php
			   }elseif($gallery_details['media_type'] == '2'){
				?>
                <iframe id="video" src="<?php echo media_url().$gallery_details['file_name']; ?>?rel=0" allowfullscreen style="display:none; width:100%; height:250px;"></iframe>
             
                <?php
			   }
				?> 
                <img class="gallery_image img-responsive" src="<?php echo $gallery_details['image_url']; ?>">
                
                <p style="display:none; color:#333 !important;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </a>
        </div>
        <?php
		   }
	   }
        ?>
        
        <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">×</button>
                        <h3 class="modal-title">Heading</h3>
                    </div>
                    <div class="modal-body">
            
                    </div>
                    <div class="modal-footer">
                        <button id="closemodal" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
$('.gallery_image').click(function(){
	$('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
	var media_tyle = $(this).parent('a').attr("data-title");
	
	
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
	
	if(media_tyle == '1'){
		$('.modal-body #video').hide();
		$('.modal-body .gallery_image').show();
		
		
	}else if(media_tyle == '2'){
		$('.modal-body .gallery_image').hide();
		$('.modal-body #video').show();
		
		var videoURL = $('.modal-body #video').prop('src');
		videoURL += "&autoplay=1";
		$('.modal-body #video').prop('src',videoURL);
		
	
	}else if(media_tyle == '3'){
		$('.modal-body .gallery_image').hide();
		$('.modal-body #video').show();
		
		var videoURL = $('.modal-body #video').prop('src');
		videoURL += "&autoplay=1";
		$('.modal-body #video').prop('src',videoURL);
	}
	
	
	
	
	
	
	$('.modal-body p').show();
  	$('#myModal').modal({show:true});
});
$('#closemodal').click(function() {
	
	var videoURL = $('.modal-body #video').prop('src');
	videoURL = videoURL.replace("&autoplay=1", "");
	$('.modal-body #video').prop('src','');
	$('.modal-body #video').prop('src',videoURL);
	
	$('.modal-body .gallery_image').hide();
	$('.modal-body #video').hide();
	$('.modal-body #iframurl').hide();
	
    $('#myModal').modal('hide');
});
});
</script>