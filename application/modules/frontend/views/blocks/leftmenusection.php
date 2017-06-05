
<?php

if(!empty($menus_list)){
?>
<p class="pull-right topmenu">
	<a href="#"><span>DONATE</span></a>
	<?php
    if (get_session_value('current_user_id') == '') {
    ?>
    <a href="javascript:void(0);" data-type="login-modal" data-toggle="modal" class="allmodal"><span>LOGIN</span></a>
    <a href="javascript:void(0);" data-type="register-modal" data-toggle="modal" class="allmodal"><span>REGISTER</span></a>
    <?php
	}else{
	?>
    <a href="<?php echo base_url('dashboard/myaccount'); ?>"><span>MY ACCOUNT</span></a>
    <a href="<?php echo frontend_url('logout'); ?>"><span>LOGOUT</span></a>
    <?php
	}
	?>
</p>
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