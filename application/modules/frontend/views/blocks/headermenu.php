<a id="menu-close" href="javascript:void(0);" class="btn btn-default  pull-right toggle"><i class="glyphicon glyphicon-remove"></i></a>
<ul class="sidebar-nav">
    
    <li class="sidebar-brand"><a href="<?php echo base_url(); ?>"><img src="<?php echo skin_url(); ?>img/logo.png" alt="Jeevanacharya" title="Jeevanacharya"></a></li>
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