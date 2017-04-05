<div class="container-fluid">
	<div class="side-body">

		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php //echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open(admin_url().$module."/$module_action",' class="form-horizontal" id="changepassword_form" ' ); ?>
                         
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Old Password').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>">
							<div class="input_box"><?php echo form_password('old_password',set_value('old_password'),'class="form-control required catname_check" id="old_password"'); ?>
							</div>
							</div>
						</div>
                    	<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('New Password').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>">
							<div class="input_box"><?php echo form_password('new_password',set_value('new_password'),'class="form-control required catname_check" id="new_password"'); ?>
							</div>
							</div>
						</div>
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Confirm Password').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>">
							<div class="input_box"><?php echo form_password('confirm_password',set_value('confirm_password'),'class="form-control required catname_check" id="confirm_password"'); ?>
							</div>
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('save');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden ( 'action', 'changepassword' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
