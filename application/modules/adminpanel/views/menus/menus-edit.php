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
                <?php echo form_open_multipart(admin_url().$module.'/edit',' class="form-horizontal" id="common_form" ' );?>
                          <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Type').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php 
							
								$options = array('' => 'Select Menu Type',
								        	'page'    => 'Page',
								       		'custom_link' => 'Custom Link',								        	
											);
								
							
								echo form_dropdown('menu_type', $options, $records['link_type'], ' class="form-control required" id="menu_type" onchange="get_menu_types(this)"');
							?>							
                                </div>
							</div>
						</div>
						 
						<div id="cmspage_list" class="form-group" <?php echo ($records['link_type'] == "page") ? "style='display:block'":"style='display:none'"; ?>>
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
							echo form_dropdown('cms_page', $page_dropdown, $records['page_id'], 'id="cms_page" class="form-control required" ');
							?>
                                </div>
							</div>
						</div>
                          <div class="form-group" id="menu_name">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu name').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('name', $records['name'],' class="form-control"  ');?></div></div>
						</div>
						<div id="custom_link" class="form-group"  <?php echo ($records['link_type'] == "custom_link") ? "style='display:block'":"style='display:none'"; ?>>
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Custom Link').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('url', $records['url'],' class="form-control required" id="custom_url" ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Target');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php 
							$target = array('' => 'Select Target',
									'_blank'    => 'New Tab',
									'_top'  => 'Same Window ',
									
							);
							echo form_dropdown('target', $target,$records['target'],' class="form-control"  ');?></div></div>
						</div>
						 <div class="form-group" id="menu_position">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Position');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type="number" name="menu_position" class="form-control" value="<?php echo $records['position']; ?>">
							</div>
							</div>
						</div>
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Menu Class');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('menu_class', $records['menu_class'],' class="form-control"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Extra Attributes ');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('extra_attributes',$records['extra_attributes'],' class="form-control"  ');?></div></div>
						</div>
						<div id="parent_menu_sec" class="form-group" <?php echo ($records['parent_id'] != "0") ? "style='display:block'":"style='display:none'"; ?>>
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Parent Menu');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo getMenuwithSubmenu('parent_menu','', $records['parent_id'],' class="form-control" id="parent_menu" ');?>
                                </div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo  get_is_active_dropdown($records['is_active']);?>
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
					echo form_hidden('remove_category_image','No');
					echo form_hidden('remove_category_icon','No');
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
<script>
/* Add Multi field   */
$(document).ready(function(){
	$('#category_list #category').removeClass('required');
	$('#cmspage_list #cms_page').removeClass('required');
	$("#menu_name input[name=name]").removeClass('required');	
	$("#custom_link #custom_url").removeClass('required');	
	/* Remove Image Yes or No*/
    $(".delete_category_image").click(function() {
  	  
   	 if(confirm('Are you want delete this image?'))
   	  {
   		    $('.show_category_image_box').remove();
   			$('input[name="remove_category_image"]').val('Yes');
   	  }
    });
   $(".delete_category_icon").click(function() {
   	  
   	 if(confirm('Are you want delete this image?'))
   	  {
   		    $('.show_category_icon_box').remove();
   			$('input[name="remove_category_icon"]').val('Yes');
   	  }
   });
});


</script>