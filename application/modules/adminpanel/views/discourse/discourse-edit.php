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
					<?php if(validation_errors() !=""){ ?>
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: block;">
					<?php echo validation_errors(); ?>					
					</ul>	   
					<?php } ?>   	
                              
               		<?php echo form_open_multipart(admin_url().$module.'/'.$module_action,' class="form-horizontal" id="common_validate_form" ' );?>
                
						
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<?php  echo form_input('title',custom_strip_slashes($record['title']),' class="form-control required"  ');?>
							</div></div>
						</div>
                        
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Short Description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('shortdesc',custom_strip_slashes($record['shortdesc']),' class="form-control required" maxlength="250"   ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('description').get_required();?></label>
							<div class="col-sm-8"><div class="input_box">
							
							<?php echo get_editor(array('field_name' => 'description', 'field_value' => $record['description'])); ?>
							</div></div>
									
						</div>	
						
							<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('photo');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"> 
							 <div class="custom_browsefile">
                                        <?php  echo form_upload('discourse_image')?>
                                        <span class="result_browsefile"><span class="brows"></span>+ Upload Image</span>
                                    </div>
							</div></div>
							<?php
							if($record['image'] != ""):	
							?>
								<div class="col-xs-6 col-md-3 show_profile_image_box show_image_box">
								<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
								<i class="fa fa-trash-o fa-2x pull-right" style="color:red "></i>
								<img class="img-responsive img-thumbnail delete_discourse_image" style="width: 250px; height:250px;"  src="<?php echo media_url()."/discourse/".$record['image'];?>">
								</a>
								</div>
							<?php
							endif;
							?>		
							
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('status').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo  get_is_active_dropdown($record['is_active']);?>
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
					echo form_hidden('remove_discourse_image','No');
					echo form_close ();
					?>			
			
                        
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	/* Remove Image Yes or No*/
    $(".delete_discourse_image").click(function() {
  	  
   	 if(confirm('Are you want delete this image?'))
   	  {
   		    $('.show_image_box').remove();
   			$('input[name="remove_discourse_image"]').val('Yes');
   	  }
    });
   
});
</script>

