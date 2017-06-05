<div class="aboutus_section">
	<div class="container">
		<div class="row">
        	
			<div class="col-xs-12 guru_aboutus">
            
				<div class="col-lg-3">
                	<img src="<?php echo $user[0]['profile']; ?>" alt="" width="280" height="280" class="">
                </div>
                <div class="col-lg-9">
                	<div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_username']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_firstname'].' '.$user[0]['admin_lastname']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_email_address']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_phone_number']; ?></div>
                    <div class="col-xs-12"><i class="fa fa-user"></i> <?php echo $user[0]['admin_country']; ?></div>
                </div>
                
			</div>
			
		</div>
	</div>
</div>