<div class="aboutus_section">
	<div class="container">
		<div class="row">
        	<?php
			if(!empty($emailmsg)){
			?>
			<div class="col-xs-12 guru_aboutus text-center">
				<h2>Account Activation</h2>
				<p><?php echo $emailmsg; ?>.</p>
                
			</div>
			<?php
			}
			?>
		</div>
	</div>
</div>