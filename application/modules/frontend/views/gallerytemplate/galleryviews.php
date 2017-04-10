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
            if (!empty($gallery)) {
                foreach ($gallery as $gallery_details) {
                    ?>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" data-tag=<?php
                    if ($gallery_details['media_type'] != '1') {
                        echo 'media_video';
						
                    } else {
                        echo 'media_image';
                    }
                    ?>>
						
                        <div class=" grid view view-sixth" >
                            <img src="<?php echo $gallery_details['image_url']; ?>" style="width:100%;height:200px" class="gallery_image img-responsive"/>
                           <div class="mask">
                                <?php
                                if ($gallery_details['media_type'] == '3') {
                                	$file_url = $gallery_details['file_name'];
                                   
                                } elseif ($gallery_details['media_type'] == '2') {
                                	$file_url = media_url() . $gallery_details['file_name'];
                                  
                                }else{
                                	$file_url = $gallery_details['image_url'];
                                }
                                ?>
                                <h2>Jeevanacharya</h2>
                                <p><?php echo $gallery_details['title']; ?></p>
                                <center><a data-fancybox="gallery" data-width="2048" data-height="1365" data-caption="<?php echo $gallery_details['description'] ? $gallery_details['description'] :$gallery_details['title']; ?>"  title="<?php echo $gallery_details['title']; ?>" href="<?php echo $file_url; ?>" data-title="<?php echo $gallery_details['media_type']; ?>"  class="info gallery_box">View</a></center>
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

<div class="line_content">
<hr /></div>
<?php 
if(!empty($blocks['inner_bottom'])){
	echo $blocks['inner_bottom']; 
}
?>
<div class="clearfix"></div>
<?php 
if(!empty($blocks['content_newsletter'])){
echo $blocks['content_newsletter']; 
}
?>
<script src="<?php echo skin_url(); ?>js/bootstrap-portfilter.min.js"></script>
<script>
    $(document).ready(function () {
       /* $('.gallery_box').click(function () {

            $('.modal-body').empty();
            var title = $(this).attr("title");
            var media_tyle = $(this).attr("data-title");
            $('.modal-title').html(title);
            $($(this).parent().parent('div').html()).appendTo('.modal-body');
            if (media_tyle == '1') {
                $('.modal-body .video_2').hide();
                $('.modal-body .video_1').hide();
                $('.modal-body .gallery_image').show();


            } else if (media_tyle == '2') {
                $('.modal-body .gallery_image').hide();
                $('.modal-body .video_1').hide();
                $('.modal-body .video_2').show();

                $('.modal-body .video_2').prop("autoplay", true);



            } else if (media_tyle == '3') {
                $('.modal-body .gallery_image').hide();
                $('.modal-body .video_2').hide();
                $('.modal-body .video_1').show();

                var videoURL = $('.modal-body .video_1').prop('src');
                videoURL += "&autoplay=1";
                $('.modal-body .video_1').prop('src', videoURL);
            }





            $('.modal-body .overlay').hide();
            $('.modal-body p').show();
            $('#myModal').modal({show: true});
            $('.gallery_box').hide();
        });
        $('.closemodal').click(function () {
            $('.gallery_box').show();
            $(".modal-body video").remove();
            $(".modal-body iframe").remove();
            $('.modal-body .gallery_image').hide();
            $('.modal-body .video_1').hide();
            $('.modal-body .video_2').hide();

            $('#myModal').modal('hide');
        });*/
    });
</script>