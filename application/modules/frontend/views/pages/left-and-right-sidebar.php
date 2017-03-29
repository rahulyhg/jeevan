<?php 
if(!empty($blocks['inner_top'])){
	echo $blocks['inner_top']; 
}
?>
<div class="clearfix"></div>
<div class="left-and-right-siderbar">
	<div class="container">
		<div class="row">
        	<div class="col-lg-3">
            	<?php 
				if(!empty($blocks['inner_left'])){
					echo $blocks['inner_left']; 
				}
				?>
            </div>
            <div class="col-lg-6">
            	<?php
				if(!empty($cms['page_description'])){
				echo $cms['page_description'];
				}
				?>	
            </div>
            <div class="col-lg-3">
            	<?php 
				if(!empty($blocks['inner_right'])){
					echo $blocks['inner_right']; 
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
