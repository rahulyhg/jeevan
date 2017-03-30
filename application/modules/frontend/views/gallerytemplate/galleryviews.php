<div class="galleryviews">
	<div class="container">
    	<div class="row">
        	
        <h3 class="text-center"><?php echo $gallery[0]['gallery_category']; ?></h3>
        
      
            <div class="col-xs-12 text-center">
    			<button class="btn btn-small btn-warning" data-toggle="portfilter" data-target="all">
					All
				</button>
				<button class="btn btn-small btn-warning" data-toggle="portfilter" data-target="media_image">
					Images
				</button>
				<button class="btn btn-small btn-warning" data-toggle="portfilter" data-target="media_video">
					Videos
				</button>
				
			</div>
         <div class="clearfix"></div>
         <br>
        
        <?php
	   if(!empty($gallery)){
		   foreach($gallery as $gallery_details){
	   ?>
       <div class="col-lg-3 col-sm-6 col-xs-12" data-tag=<?php if($gallery_details['media_type'] != '1'){ echo 'media_video';  }else{ echo 'media_image'; } ?>>
        <div class="panel panel-default">
        
            <div class="panel-body">
                <a  title="<?php echo $gallery_details['title']; ?>" href="javascript:void(0);" data-title="<?php echo $gallery_details['media_type']; ?>" class="zoom" >
                    <img class="gallery_image img-responsive" src="<?php echo $gallery_details['image_url']; ?>" />
                    <span class="overlay gallery_box"><i class="glyphicon <?php if($gallery_details['media_type'] != '1'){ ?> glyphicon-facetime-video <?php }else{ ?> glyphicon-picture <?php } ?>"></i></span>
                    <?php
				   if($gallery_details['media_type'] == '3'){
				   ?>
					<iframe class="video_1" src="<?php echo $gallery_details['file_name']; ?>?rel=0" frameborder="0" allowfullscreen style="width:100%; height:250px; display:none;"></iframe>
					<?php
				   }elseif($gallery_details['media_type'] == '2'){
					?>
					
				 
					 <video controls  preload="metadata" class="video_2"  style="display:none; width:100%; height:250px;">
						<source src="<?php echo media_url().$gallery_details['file_name']; ?>" type="video/webm"></source>
						<source src="<?php echo media_url().$gallery_details['file_name']; ?>" type="video/mp4"></source>
					</video>
					<?php
				   }
					?>
                    <p style="display:none; color:#333 !important;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                </a>
            </div>
            
        </div>
        </div>
        <?php
		   }
	   }
        ?>
        
        
        
        <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close closemodal" type="button" data-dismiss="modal">×</button>
                        <h3 class="modal-title">Heading</h3>
                    </div>
                    <div class="modal-body">
            
                    </div>
                    <div class="modal-footer">
                        <button class="closemodal btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    
        </div>
    </div>
</div>

<script src="<?php echo skin_url(); ?>js/bootstrap-portfilter.min.js"></script>
<script>
$(document).ready(function() {
$('.gallery_box').click(function(){

	$('.modal-body').empty();
  	var title = $(this).parent('a').attr("title");
	var media_tyle = $(this).parent('a').attr("data-title");
	
	
  	$('.modal-title').html(title);
  	$($(this).parents('div').html()).appendTo('.modal-body');
	
	if(media_tyle == '1'){
		
		$('.modal-body .video_2').hide();
		$('.modal-body .video_1').hide();
		$('.modal-body .gallery_image').show();
		
		
	}else if(media_tyle == '2'){
		$('.modal-body .gallery_image').hide();
		$('.modal-body .video_1').hide();
		$('.modal-body .video_2').show();
		
		$('.modal-body .video_2').prop("autoplay", true);
		
		
	
	}else if(media_tyle == '3'){
		$('.modal-body .gallery_image').hide();
		$('.modal-body .video_2').hide();
		$('.modal-body .video_1').show();
		
		var videoURL = $('.modal-body .video_1').prop('src');
		videoURL += "&autoplay=1";
		$('.modal-body .video_1').prop('src',videoURL);
	}
	
	
	
	
	
	$('.modal-body .overlay').hide();
	$('.modal-body p').show();
  	$('#myModal').modal({show:true});
});
$('.closemodal').click(function() {
	
	$( ".modal-body video" ).remove();
	$( ".modal-body iframe" ).remove();
	$('.modal-body .gallery_image').hide();
	$('.modal-body .video_1').hide();
	$('.modal-body .video_2').hide();
	
    $('#myModal').modal('hide');
});
});
</script>