
 
 <?php
if(base_url(uri_string()) == BASE_URL() || base_url(uri_string()) == BASE_URL('frontend')){
 ?>
<section class="screen2">

 
<div class="fullscreen-bg">
    <video loop muted autoplay class="fullscreen-bg__video">
        <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.webm" type="video/webm"></source>
     <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.mp4" type="video/mp4"></source>
    </video>
</div>
 
	
<nav class="videonav">
	<div class="header">
		<div class="container">
			<div class="row">
			
				<a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
				<div id="sidebar-wrapper">
					<?php echo $blocks['site_header']; ?>
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_section">
					<div class="col-lg-2 col-md-3 logo_img">
					<a href="<?php echo BASE_URL(); ?>"><img class="pull-right" src="<?php echo skin_url(); ?>img/logo.png" alt="jeevanacharya"></a>
					</div>
					<div class="col-lg-10 col-md-9 menubar">
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
				<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php 
					$page_url = str_replace('-', " ", uri_string());
					$page_title = explode("/", $page_url)
				?>
					<h1><?php echo $page_title[0]; ?></h1>
				</div>
			</div>
		</div>
	</div>
<nav class="innernav">
	<div class="header">
		<div class="container">
			<div class="row">
			
				<a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
				<div id="sidebar-wrapper">
					<?php echo $blocks['site_header']; ?>
				</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu_section">
					<div class="col-lg-2 col-md-3 logo_img">
					<a href="<?php echo BASE_URL(); ?>"><img class="pull-right" src="<?php echo skin_url(); ?>img/logo.png" alt="jeevanacharya"></a>
					</div>
					<div class="col-lg-10 col-md-9 menubar">
						<?php echo $blocks['site_header_desktop']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
</section>

<div class="about_webcame">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h5><a href="<?php echo BASE_URL(); ?>">Home</a> <span class="coloum">|</span> <a href="<?php echo $this->uri->segment(); ?>"><span class="text-capitalize"><?php echo str_replace('-', ' ',$this->uri->segment(1)); ?></span></a></h5>
			</div>
		</div>
	</div>
</div>
<?php
}
?>


<?php if(!empty($scroll_position) && $scroll_position == '1'){ ?>

<div class="scroll_top"></div>


<?php } ?>

