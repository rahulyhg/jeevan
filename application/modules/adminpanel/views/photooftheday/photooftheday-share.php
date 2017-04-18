<div class="container-fluid">
	<div class="side-body">

		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					
                    

				
					</div>
                
                <div class="card">
                	<div class="card-header">
						<div class="card-title">
							<div class="title">Social Media Sharing</div>
						</div>
                        <div class="clearfix"></div>
                        <?php
						$fb_title=$meta_jeevan_title;
						$fb_url= $meta_jeevan_link;
						$fb_summary=$meta_jeevan_summary;
						$fb_image=$meta_jeevan_image;
						?>
                        <div class="card-body">
                        	
                            <a href="javascript: void(0)" class="sb-facebook" id="FB_share_button"><button class="btn btn-primary" style="background-color:#4E71A8; border-color:#4E71A8;"><i class="fa fa-facebook"></i> Share</button></a>
                            
                            <a href="<?php echo 'http://www.twitter.com/share?'.http_build_query(array(	'url' => $fb_url, 'text' => $fb_title, 'image' => $fb_image)); ?>" target="_blank" title="Tweet" class="sb-twitter"><button class="btn btn-primary" style="background-color:#1CB7EB; border-color:#1CB7EB;"><i class="fa fa-twitter"></i> Share</button></a>
                            
                            <a class="sb-googleplus"  href="javascript:void(0);" onclick="javascript:window.open('https://plus.google.com/share?url=' + encodeURIComponent('<?php echo 'http://jeevanacharya.com/'; ?>'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" ><button class="btn btn-primary" style="background-color:#E3411F; border-color:#E3411F;"><i class="fa fa-google-plus"></i> Share</button></a>
                             <script>
                            jQuery(document).ready(function(){
                                jQuery('#FB_share_button').click(function(e){
                                    
                                    e.preventDefault();
                                        FB.ui({
                                                method: 'feed',
                                                name: 'Jeevanacharya',
                                                link: '<?php echo $fb_url; ?>',
                                                picture: '<?php echo $fb_image; ?>',
                                                caption: '<?php echo $fb_title;?>',
                                                message: '<?php echo $fb_summary; ?>'
                                              });
                                           });
                                        });
                         
                         
								window.fbAsyncInit = function() {
								FB.init({
								  appId      : '261791000949918',
								  xfbml      : true,
								  version    : 'v2.8'
								});
								FB.AppEvents.logPageView();
								};
                        
							  (function(d, s, id){
								 var js, fjs = d.getElementsByTagName(s)[0];
								 if (d.getElementById(id)) {return;}
								 js = d.createElement(s); js.id = id;
								 js.src = "//connect.facebook.net/en_US/sdk.js";
								 fjs.parentNode.insertBefore(js, fjs);
							   }(document, 'script', 'facebook-jssdk'));
                            </script>
						</div>
                        
					</div>
                </div>
                
			</div>
		</div>
	</div>
</div>
<script>
/* Add Multi field   */
$(document).ready(function(){
	
	/* Remove Image Yes or No*/
    $(".delete_day_image").click(function() {
  	  
   	 if(confirm('Are you want delete this image?'))
   	  {
   		    $('.show_image_box').remove();
   			$('input[name="remove_day_image"]').val('Yes');
   	  }
    });
  
});


</script>