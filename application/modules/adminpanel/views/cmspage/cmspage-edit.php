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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page_title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('page_title',custom_strip_slashes($record['page_title']),' class="form-control required"  ');?>
							</div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page_description').get_required();?></label>
							<div class="col-sm-8"><div class="input_box">
							
							<?php echo get_editor(array('field_name' => 'page_description', 'field_value' => $record['page_description'])); ?>
							</div></div>
									
						</div>	
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page_image').'&nbsp;';?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type ="file" name="page_image" value="<?php set_value('page_image'); ?>"  class="form-control"  >
							
							</div></div>
						</div>
                        
						
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_input('page_meta_title',$record['page_meta_title'],' class="form-control required"  ');?>
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_keyword').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('page_meta_keyword',$record['page_meta_keyword'],' class="form-control required"  ');?></div></div>
						</div>
					
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_input('page_meta_description',$record['page_meta_description'],' class="form-control required"  ');?>
                              
                             
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page_template').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php 
								$options = array(
								        	'full-width'    => 'Full Width',
								       		'left-sidebar'  => 'Left Sidebar',
								        	'right-sidebar' => 'Right Sidebar',
								        	'left-right-sidebar' => 'Left & Right Sidebar',
										);
								
							
								echo form_dropdown('page_template', $options, $record['page_template']);
							?>							
                                </div>
							</div>
						</div>
                        
                        <div class="form-group">
                        <?php echo form_hidden('edit_id',$edit_id);?>
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
                        
                        <?php
					echo form_hidden ( 'action', 'edit' );
					echo form_hidden('remove_page_image','No');
					echo form_close ();
					?>			
			
                        
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>

