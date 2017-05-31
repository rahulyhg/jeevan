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
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module.'/add',' class="form-horizontal" id="common_form" ' );?>
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Type').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php 
								$options = array('' => 'Select Menu Type',
								        	'page'    => 'Page',
								       		'custom_link' => 'Custom Link',								        	
											);
								
							
								echo form_dropdown('menu_type', $options, set_value('menu_type'), ' class="form-control required" id="menu_type" onchange="get_menu_types(this)"');
							?>							
                                </div>
							</div>
						</div>
                       
						<div id="cmspage_list" class="form-group" style="display:none;">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('CMS Pages').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php 
							$page_dropdown = array();
							if(!empty($cms_pages)){
								$page_dropdown[''] = get_label('Select Pages'); 
								foreach ($cms_pages as $page){
									$page_dropdown[$page['id']] = $page['page_title'];
								}
							}
							echo form_dropdown('cms_page', $page_dropdown, set_value('cms_page'), 'id="cms_page" class="form-control required" ');
							?>
                                </div>
							</div>
						</div>
                        <div class="form-group" id="menu_name">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu name').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('name',set_value('name'),' class="form-control required"  ');?></div></div>
						</div>
						<div id="custom_link" class="form-group"  style="display:none;">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Custom Link').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('url',set_value('url'),' class="form-control required" id="custom_url" ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Target');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php 
							$target = array('' => 'Select Target',
									'_blank'    => 'New Tab',
									'_top'  => 'Same Window ',
									
							);
							echo form_dropdown('target', $target,set_value('target'),' class="form-control"  ');?></div></div>
						</div>
						 <div class="form-group" id="menu_position">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Position');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type="number" name="position" class="form-control" value="<?php echo set_value('position'); ?>">
							</div>
							</div>
						</div>
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Class');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('menu_class', set_value('menu_class'),' class="form-control"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Extra Attributes ');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('extra_attributes',set_value('extra_attributes'),' class="form-control"  ');?></div></div>
						</div>
						<div id="parent_menu_sec" class="form-group" style="display:none;">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Parent Menu');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo getMenuwithSubmenu('parent_menu','',set_value('parent_menu'),' class="form-control" id="parent_menu" ');?>
                                </div>
							</div>
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
