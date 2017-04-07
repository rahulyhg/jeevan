<div class="ashram_header">
	<div class="container">
		<div class="row">
        	<?php
			if($blog!=''){
				foreach($blog as $blog_list){
			?>
            <a href="<?php echo base_url() . 'blog/' . $blog_list['blog_slug'].'/'; ?>">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ashram_div">
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<img src="<?php echo $blog_list['blog_image']; ?>" alt="<?php echo $blog_list['blog_title']; ?>" title="<?php echo $blog_list['blog_title']; ?>">
				</div>
				<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ashram_section1">
					<h3><?php echo $blog_list['blog_title']; ?></h3>
					<p><?php echo $blog_list['blog_shortdesc']; ?></p>
                    <button class="btn btn-danger pull-right">Read More</button>
				</div>
			</div>
            </a>
          <?php
				}	
			}
		  ?>  
		</div>
	</div>
</div>