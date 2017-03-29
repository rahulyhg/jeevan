<?php
if(!empty($page_breadcrums)){
?>
<div class="about_webcame">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h5><a href="<?php echo BASE_URL(); ?>">Home</a> <span class="coloum">|</span> <span><?php echo $page_breadcrums; ?></span></h5>
			</div>
		</div>
	</div>
</div>
<?php
}
?>