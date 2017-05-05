<div class="container-fluid">
	<div class="side-body">

		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<?php if(validation_errors() !=""){?>
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: block;">
					<?php echo validation_errors(); ?>					
					</ul>	   
					<?php } ?>       
               		 <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal"' );?>
               		 	<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('template_name').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('name',set_value('name'),' class="form-control required"  ');?>
							</div></div>
						</div>
						
						
						
                      <?php ?>  <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('sms_content').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_textarea('sms_content',set_value('sms_content'),' class="form-control required"  ');?>
                                </div>
							</div>
						</div>
						
						                     
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('sms_variables').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('sms_variables',set_value('sms_variables'),' class="form-control required"  ');?></div></div>
						</div>
						
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden ( 'action', 'Add' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>

