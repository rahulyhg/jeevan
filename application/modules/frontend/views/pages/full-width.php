<?php 
if(!empty($blocks['inner_top'])){
	echo $blocks['inner_top']; 
}
?>
<div class="clearfix"></div>


<?php
echo $cms['page_description'];
?>

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
            <?php echo $blocks['content_newsletter']; ?>
            
		</div>
	</div>
</div>
