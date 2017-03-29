 <div class="scroll-top-wrapper">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>
 
 <?php
if(base_url(uri_string()) == BASE_URL() || base_url(uri_string()) == BASE_URL('frontend')){
 ?>
<section>

 
<div class="fullscreen-bg">
    <video loop muted autoplay class="fullscreen-bg__video">
        <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.webm" type="video/webm"></source>
     <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.mp4" type="video/mp4"></source>
    </video>
</div>
 
	
<nav>
	<div class="header">
		<div class="container-fluid">
			<div class="row">
			
				<a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
				<div id="sidebar-wrapper">
					<?php echo $blocks['site_header']; ?>
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_section">
					<div class="col-lg-3 col-md-3 logo_img">
					<a href="<?php echo BASE_URL(); ?>"><img class="pull-right" src="<?php echo skin_url(); ?>img/logo.png" alt="jeevanacharya"></a>
					</div>
					<div class="col-lg-9 col-md-9 menubar">
						<?php echo $blocks['site_header_desktop']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
</section>
<?php
}else{
	$scroll_position = '1';
?>

<section id="screen1">
	<div class="menu_text">
		<div class="container">
			<div class="row">
				<div class="col-lg-offset-4 col-lg-8 col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8">
					<h1>Jeevanacharya</h1>
					<h3>The way of life</h3>
					
				</div>
			</div>
		</div>
	</div>
<nav>
	<div class="header">
		<div class="container-fluid">
			<div class="row">
			
				<a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
				<div id="sidebar-wrapper">
					<?php echo $blocks['site_header']; ?>
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_section">
					<div class="col-lg-3 col-md-3 logo_img">
					<a href="<?php echo BASE_URL(); ?>"><img class="pull-right" src="<?php echo skin_url(); ?>img/logo.png" alt="jeevanacharya"></a>
					</div>
					<div class="col-lg-9 col-md-9 menubar">
						<?php echo $blocks['site_header_desktop']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
</section>

<?php
}
?>


<?php if(!empty($scroll_position) && $scroll_position == '1'){ ?>

<div class="scroll_top"></div>


<?php } ?>

