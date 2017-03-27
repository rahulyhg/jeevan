<div class="nav_color">
	<?php
	if(!empty($menus_list)){
	?>
    <ul class="nav navbar-nav menubar">
    	<?php
		foreach($menus_list as $desktop){
		?>
        <li><a class="animated zoomIn " href="<?php echo $desktop['url']; ?>"><?php echo $desktop['name']; ?><br><span class="jeevan">JEEVANACHARYA</span></a></li>
        <?php
		}
		?>
    </ul>  
    <?php
	}
	?>
</div>