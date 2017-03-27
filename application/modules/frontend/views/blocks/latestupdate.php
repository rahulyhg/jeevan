<div class="content">
	<div class="simple-marquee-container">
		<div class="marquee-sibling"><?php echo $title; ?></div>
		<div class="marquee">
			<ul class="marquee-content-items">
            <?php
			if(!empty($menus_list)){
				foreach($menus_list as $latest){
			?>
				<li><a href="<?php echo $latest['url']; ?>" target="<?php echo $latest['target']; ?>"><?php echo $latest['name']; ?></a></li>
			<?php
				}
			}
			?>		
			</ul>
		</div>
	</div>
</div>