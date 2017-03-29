<?php 
if(!empty($blocks['inner_top'])){
	echo $blocks['inner_top']; 
}
?>
<div class="clearfix"></div>
<div class="right-width">
	<div class="container">
		<div class="row">
        	<div class="col-lg-4">
            	<?php 
				if(!empty($blocks['inner_left'])){
					echo $blocks['inner_left']; 
				}
				?>
            </div>
        	<div class="col-lg-8">
            	<?php
				if(!empty($cms['page_description'])){
				echo $cms['page_description'];
				}
				?>
            </div>
            
            
        </div>
   </div>
</div>
<div class="clearfix"></div>
<?php 
if(!empty($blocks['inner_bottom'])){
	echo $blocks['inner_bottom']; 
}
?>
<div class="clearfix"></div>
<div class="news_letter">
	<div class="container">
		<div class="row" >
            <?php 
			if(!empty($blocks['content_newsletter'])){
			echo $blocks['content_newsletter']; 
			}
			?>
            
		</div>
	</div>
</div>
