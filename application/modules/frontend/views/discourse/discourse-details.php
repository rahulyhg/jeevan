<div class="blog">
    <div class="container">
        <div class="row">
        	<div class="col-xs-12">
        	<!--<div class="post_social">
        	 <?php// $social_url= base_url() . 'discourse/' . $discourse[0]['slug'].'/'; ?>
			    	<a href="javascript:void(0)" class="icon-fb" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php// echo $social_url?>')" title="Facebook Share"><img src="images/fb.png"/></a>
			        <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php// echo $social_url?>')" class="icon-gplus" title="Google Plus Share"><img src="images/gp.png"/></a>
			        <a href="javascript:void(0)" class="icon-tw" onclick="javascript:genericSocialShare('http://twitter.com/share?text=Social popup on page scroll using jQuery and CSS&amp;url=http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/')" title="Twitter Share"><img src="images/tw.png"/></a>
			        <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F')" title="LinkedIn Share"><img src="images/in.png"/></a>
			        <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F&media={http%3A%2F%2Fwww.codexworld.com%2Fwp-content%2Fuploads%2F2014%2F11%2Fsocial-buttons-jquery-popup-dialog-codexworld.png}')" title="Pinterest Share"><img src="images/pin.png"/></a>
			        <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.stumbleupon.com/badge/?url=http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/')" title="StumbleUpon Share"><img src="images/su.png"/></a>
			        <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.reddit.com/submit?url=http%3A%2F%2Fwww.codexworld.com%2Fsocial-popup-page-scroll-using-jquery-css%2F')" title="Reddit Share"><img src="images/rt.png"/></a>
			        <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.codexworld.com/social-popup-page-scroll-using-jquery-css/.')" title="E-Mail Share"><img src="images/mail.png"/></a>
			    </div>-->
            	<h3 class="text-center"><?php echo $discourse[0]['title']; ?></h3>
            	<div class="discourse-img-section">
                	<center><img src="<?php echo $discourse[0]['image_url']; ?>" alt="<?php echo $discourse[0]['title']; ?>" title="<?php echo $discourse[0]['title']; ?>"></center>
                </div>
                <p><?php echo $discourse[0]['description']; ?></p>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript" async >
	function genericSocialShare(url){
		window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
		return true;
	}
	</script>
