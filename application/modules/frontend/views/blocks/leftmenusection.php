
<?php

if(!empty($menus_list)){
?>
<ul>
	<?php
		foreach($menus_list as $desktop){
		?>
    <li <?php if(base_url(uri_string()) == $desktop['url']){  ?> class="active" <?php } ?>><a class="animated zoomIn text-uppercase" href="<?php echo $desktop['url']; ?>"><?php echo $desktop['name']; ?></a></li>
    <?php
		}
		?>
</ul>
<?php
	}
?>