<div class="galleryviews">
    <div class="container">
        <div class="row">
			
            <h3 class="text-center"><em><?php echo $gallery[0]['gallery_category']; ?></em></h3>
            <!--<button class="btn btn-small btn-warning" onclick="goBack()">Go Back</button>-->
			<div class="col-xs-12 text-center">
				
                <a href="javascript:void(0);" class="btn btn-small btn-warning filter_gallery" id="all">All</a>
                <a href="javascript:void(0);" class="btn btn-small btn-warning filter_gallery" id="media_image">Images</a>                    
                <a href="javascript:void(0);" class="btn btn-small btn-warning filter_gallery" id="media_video">Videos</a>
				<br><br>
            </div>
            
            <div id="ajaxgallery">
 <?php
 if(!empty($gallery)){
 ?>           
            <div class="tab-content">
            	<div class="tab-pane active" id="tab1" role="tabpanel">
                	<?php
                    $i = 0;
                    $j = 2;
					
                    foreach ($gallery as $gallery_details) {
                    ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 gallery_box" data-tag=<?php
                    if ($gallery_details['media_type'] != '1') {
                        echo 'media_video';
						
                    } else {
                        echo 'media_image';
                    }
                    ?>>
						
                        <div class=" grid view view-first" >
                            <img src="<?php echo $gallery_details['image_url']; ?>" alt="<?php echo $gallery_details['title']; ?>" title="<?php echo $gallery_details['title']; ?>" class="gallery_image img-responsive"/>
                           <div class="mask text-center">
                                <?php
                                if ($gallery_details['media_type'] == '3') {
                                	$file_url = $gallery_details['file_name'];
                                   
                                } elseif ($gallery_details['media_type'] == '2') {
                                	$file_url = media_url() . $gallery_details['file_name'];
                                  
                                }else{
                                	$file_url = $gallery_details['image_url'];
                                }
                                ?>
                                
                               <a data-fancybox="gallery" data-width="2048" data-height="1365" data-caption="<?php echo $gallery_details['description'] ? $gallery_details['description'] :$gallery_details['title']; ?>"  title="<?php echo $gallery_details['title']; ?>" href="<?php echo $file_url; ?>" data-title="<?php echo $gallery_details['media_type']; ?>"  class="info icon_details">
                                
                                
                                View</a>
                            </div> 
                        </div>
    					<div class="clearfix"></div>
                        <p><?php echo substr($gallery_details['description'], 0, 100); ?></p>
                    </div>
                    <?php
                        $i++;
                        if ($i % 8 == 0) {
                            echo '</div><div class="tab-pane" id="tab' . $j . '" role="tabpanel">';
                            $j++;
                        }
                    }
					
                    ?>
                </div>
            </div>
            
 <?php
}else{
			echo '<div class="clearfix"></div><h3 class="text-center">Media Not Found</h3>';
		}
?>
           
            
            <div class="col-xs-12">
            
            <?php
            if(count($gallery) > 8) :
            
            $list = $j - 1;
            $numbercount = $list + 1;
            ?>
                <ul class="pager" role="tablist">
                    <li class="previous" onclick="goTo(1);"><a href="javascript:void(0);"><span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i><i class="fa fa-chevron-left" aria-hidden="true"></i><?php echo ' &nbsp;&nbsp;'; ?></span>  Previous</a></li>
                    <?php
                    for ($k = 1; $k <= $list; $k++) {
                        ?>
                        <li>
                            <a aria-controls="tab<?php echo $k; ?>" data-toggle="tab" href="#tab<?php echo $k; ?>" role="tab"><?php echo $k; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="next" onclick="goTo(2);"><a href="javascript:void(0);">Next <span aria-hidden="true"><?php echo '&nbsp;&nbsp; '; ?><i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a></li>
                </ul>
                <?php endif; ?>
            </div>
            
            <script>

	var list = "<?php echo $list; ?>";
	var numbercount = "<?php echo $numbercount; ?>";

    $('.galleryviews ul.pager li:nth-of-type(2)').addClass('active');

    function goTo(number) {

        $('.galleryviews ul.pager li:eq(' + number + ') a').tab('show');
        upgradePreNext(number);
    }
    function upgradePreNext(number) {

        if (number > 1) {
            $('.galleryviews ul.pager li:eq(0)').attr("onclick", "goTo(" + (number - 1) + ")");
            $('.galleryviews ul.pager li:eq(0)').attr("class", "previous");
        } else {
            $('.galleryviews ul.pager li:eq(0)').attr("class", "disabled");
        }
        if (number < list) {
            $('.galleryviews ul.pager li:eq('+ numbercount +')').attr("onclick", "goTo(" + (number + 1) + ")");
            $('.galleryviews ul.pager li:eq('+ numbercount +')').attr("class", "next");
        } else {
            $('.galleryviews ul.pager li:eq('+ numbercount +')').attr("class", "disabled");
        }
    }
    $(document).ready(function () {
        $('.galleryviews li a').on('click', function (e) {
            goTo((e.target.innerHTML) - 0);
        });
    });
</script>

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

<script>
$('.filter_gallery:first-child').addClass('active');
$('.filter_gallery').click(function(e) {
	var slug = "<?php echo $gallery_slug; ?>";
	var type_name = $(this).attr('id');
	$('.filter_gallery').removeClass('active');
	$(this).addClass('active');
	$.ajax({
		type: "POST",
		dataType: "html",
		url: admin_url +"gallery/ajaxgallery/"+slug,
		data: {
		   type_name:type_name, url_slug:slug
	  	},
		success: function (data) {
			$('#ajaxgallery').html(data);
		}
  });
	
});

</script>


<!--<script src="<?php echo skin_url(); ?>js/bootstrap-portfilter.min.js"></script>-->

