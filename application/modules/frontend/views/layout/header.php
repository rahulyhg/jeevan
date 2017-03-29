 <div class="scroll-top-wrapper">
	<span class="scroll-top-inner">
		<i class="fa fa-2x fa-arrow-circle-up"></i>
	</span>
</div>
 
 <?php
if(base_url(uri_string()) == BASE_URL() || base_url(uri_string()) == BASE_URL('frontend')){
 ?>
 <div id="videoBlock" class="video_menu">
	 <a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
			<div id="sidebar-wrapper">
            	<?php echo $blocks['site_header']; ?>
			</div>
		 <video preload="preload" id="video" autoplay loop width="100%" height="650px"  >
			 <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.webm" type="video/webm"></source>
			 <source src="<?php echo skin_url(); ?>video/jeevanacharya_videos.mp4" type="video/mp4"></source>
		 </video>
		 
		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menubar" id="videoMessage">
		 <h1>Jeevanacharya</h1>
				
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 logo">
						<a href="<?php echo BASE_URL(); ?>"><img src="<?php echo skin_url(); ?>img/logo.png" alt="wayof life"></a>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 guru_menu">
						<nav class="navbar navbar-inverse">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							<a class="navmenu" href="#">Menu</a>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            	<?php echo $blocks['site_header_desktop']; ?>
								
							</div> 
						</nav>
					</div>
				</div>
 </div>
 <style>
	#videoBlock 
	 	{ 
		position: relative;
		float: left;
		margin: 0px;
		padding: 0px;
		max-width: 100%;
		width: 100%;
		height: auto;
		overflow-x: hidden;
		/*background:url(img/gurujeee.png) no-repeat;*/
		}
	 #videoBlock video{width: 100%; height: 100%; }
	 #videoMessage
	 {
		 position: absolute;
		 bottom:15px;
		 left: 0;
	 }
</style>
<?php
}else{
?>
<div class="header">
	<div class="container-fluid">
		<div class="row">
		<a id="menu-toggle" href="#" class="btn btn-primary toggle"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
			<div id="sidebar-wrapper">
				<?php echo $blocks['site_header']; ?>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menu menu_watch prg_watch media_header contact_header">
				
                <h2>Contactus</h2>
				<p>jeevanacharya</p>
                
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 menubar menu_dropdown">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 logo">
						<a href="<?php echo BASE_URL(); ?>"><img src="<?php echo skin_url(); ?>img/logo.png" alt="wayof life"></a>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 guru_menu">
						<nav class="navbar navbar-inverse">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							<a class="navmenu" href="#">Menu</a>
							</div>
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								
                            	<?php echo $blocks['site_header_desktop']; ?>
							</div> 
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>