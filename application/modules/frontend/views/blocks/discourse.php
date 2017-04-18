<div class="ashram_header">
	<div class="container">
		<div class="row">
        	<?php
        	if($discourse !=''){
				foreach($discourse as $discourse_list){
			?>
            <a href="<?php echo base_url() . 'discourse/' . $discourse_list['slug'].'/'; ?>">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ashram_div">
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 discourse_img_box">
					<img src="<?php echo $discourse_list['image']; ?>" alt="<?php echo $discourse_list['title']; ?>" title="<?php echo $discourse_list['title']; ?>">
				</div>
				<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ashram_section1">
					<h3><?php echo $discourse_list['title']; ?></h3>
					<p><?php echo $discourse_list['shortdesc']; ?></p>
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