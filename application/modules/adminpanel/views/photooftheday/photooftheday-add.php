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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('title',set_value('title'),' class="form-control required"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('description',set_value('description'),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('date').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('date',set_value('date'),' class="form-control required datepicker"  ');?></div></div>
						</div>
						
						
						<div class="form-group" id="file_upload_box">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Upload Image');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"> 
							  <div class="dropzone" id="photoofthedayFiles" name="photoofthedayFilesUploader"></div>
								 <div id="photoofthedayFilesHiddenContainer"></div>
							</div></div>
							<script type="text/javascript">
							var photoofthedayFilesDropzoneOptions = {
								url: "<?php echo admin_url().$module."/upload_media"; ?>",
								maxFiles : 10,
								addRemoveLinks: true,
								success:function(file, response, e) {
									response = JSON.parse(response);
									if(response.success == 0) {
										this.defaultOptions.error(file,response.message);
									} else {
										var input = document.createElement("input");
										input.setAttribute("type", "hidden");
										input.setAttribute("name", "mediaFiles[]");
										input.value = response.file;
										file.name = response.file;
										file.previewElement.appendChild(input);
									}
								},
								
							};
							var photoofthedayFilesDropzone = new Dropzone("div#photoofthedayFiles", photoofthedayFilesDropzoneOptions);
					</script>
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
