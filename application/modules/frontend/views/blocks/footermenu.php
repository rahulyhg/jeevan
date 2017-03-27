
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_section1">
    <h3><?php echo $title; ?></h3>
    <?php
	if(!empty($menus_list)){
	?>
    <ul>
    	<?php
		foreach($menus_list as $footer){
		?>
        <li class="animated zoomIn"><a href="<?php  ?>"><?php echo $footer['name']; ?></a></li>
        <?php
		}
		?>
    </ul>
    <?php
	}
	?>
</div>