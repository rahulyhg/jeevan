<ul class="sidebar-nav">
    <a id="menu-close" href="index.html" class="btn btn-default  pull-right toggle"><i class="glyphicon glyphicon-remove"></i></a>
    <li class="sidebar-brand"><a href="index.php"><img src="<?php echo skin_url(); ?>img/logo.png" alt=""></a></li>
    <?php
	if(!empty($menus_list)){
		
		foreach($menus_list as $header){
	?>
    <li><a href="<?php echo $header['url']; ?>"><?php echo $header['name']; ?></a></li>
    <?php
		}
	}
	?>
</ul>