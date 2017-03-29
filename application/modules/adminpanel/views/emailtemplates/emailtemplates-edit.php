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
                <?php echo form_open_multipart(admin_url().$module.'/'.$module_action,' class="form-horizontal" id="common_validate_form" ' );?>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('template_name').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('name',$record['name'],' class="form-control required"  ');?>
							</div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('slug').'&nbsp;'; ?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('slug',$record['slug'],' class="form-control"  readonly');?>
							</div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('from_email').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('from_email',$record['from_email'],' class="form-control required"  ');?>
							</div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('reply_to').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('reply_to', $record['reply_to'],' class="form-control required"  ');?>
							</div></div>
						</div>
						
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_textarea('description',$record['description'],' class="form-control required"  ');?>
                                </div>
							</div>
						</div>
						
						
                      	 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('subject').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('subject',$record['subject'],' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('template_content').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"> <?php echo get_editor(array('field_name' => 'email_content', 'field_value' => $record['email_content'])); ?></div></div>
									
						</div>	
                       	
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('email_variables').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_input('email_variables',$record['email_variables'],' class="form-control required"  ');?>
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('is_html').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php echo form_checkbox('is_html',$record['is_html'],' class="form-control required"  ');?>
							
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo  get_is_active_dropdown($record['is_active']);?>
                                </div>
							</div>
						</div>
						
                      <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                            <?php echo form_hidden('edit_id',$edit_id);?>
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>			
			
				</div>
			</div>
		</div>
	</div>
</div>

