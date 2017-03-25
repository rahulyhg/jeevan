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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('title',stripslashes($records['title']),' class="form-control required"  ');?></div></div>
						</div>
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('abbreviation');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('abbreviation',stripslashes($records['abbreviation']),' class="form-control"  ');?></div></div>
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