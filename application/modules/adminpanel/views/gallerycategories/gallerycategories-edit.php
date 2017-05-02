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
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('category name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('name',stripslashes($records['name']),' class="form-control required"  ');?></div></div>
						</div>
                        <?php echo $record['meta_title']; ?>
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_input('meta_title',$records['meta_title'],' class="form-control required"  ');?>
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_keyword').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('meta_keyword',$records['meta_keyword'],' class="form-control required"  ');?></div></div>
						</div>
					
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('meta_description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							<?php  echo form_input('meta_description',$records['meta_description'],' class="form-control required"  ');?>
                              
                             
                                </div>
							</div>
						</div>
                        
						 <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('category description');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('description',stripslashes($records['description']),' class="form-control"  ');?></div></div>
						</div>
                         <div class="form-group" id="is_order">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Position');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type="number" name="is_order" class="form-control" value="<?php echo $records['is_order']; ?>">
							</div>
							</div>
						</div>
						
							<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('category thumbnail');?></label>
									<div class="col-sm-<?php echo get_form_size();?>"><div class="dropzone" id="categoryThumbnail" name="categoryThumbnailFileUploader"></div>
									<input id="categoryThumbnailHidden" type="hidden" name="thumbnail" value="<?php echo $records['category_image']?>" />
									</div>
						</div>
                       <script type="text/javascript">					
					var categoryThumbnailDropzoneOptions = {
						url: "<?php echo admin_url().$module; ?>/upload_thumbnail",
						maxFiles : 1,
						addRemoveLinks: true,
						acceptedFiles : 'image/*',
						maxfilesexceeded: function(file) {
							this.removeAllFiles();
							this.addFile(file);
						},
						success:function(file, response, e) {
							response = JSON.parse(response);
							if(response.success == 0) {
								this.defaultOptions.error(file,response.message);
							} else {
								document.getElementById("categoryThumbnailHidden").value = response.file;
							}
						},
						init: function(){
							<?php
								if($records['category_image'] != '') {
									
									$url = media_url().$records['category_image'];
									$fileInfo = pathinfo($url);
									if(empty($fileInfo)){
										continue;
									}
									$fileName = $fileInfo['basename'];
									
							?>
							var mockFile = {
								name: '<?php echo $fileName; ?>',
								accepted: true,
								url: '<?php echo $url; ?>',
								status: Dropzone.SUCCESS,
								upload: {progress:100}
							};
							this.files.push(mockFile);
							this.emit('addedfile', mockFile);
							mockFile.previewElement.classList.remove("dz-file-preview");
							_ref = mockFile.previewElement.querySelectorAll("[data-dz-thumbnail]");
							for (_i = 0, _len = _ref.length; _i < _len; _i++) {
								thumbnailElement = _ref[_i];
								thumbnailElement.src = mockFile.url;
								thumbnailElement.style.maxHeight ='100%';
							}
							
							var input = document.createElement("input");
							input.setAttribute("type", "hidden");
							input.setAttribute("name", "thumbnail");
							input.value = '<?php echo $records['category_image']; ?>';
							mockFile.previewElement.appendChild(input);
							
							this.emit('complete', mockFile);
							this._updateMaxFilesReachedClass();
							<?php } ?>
						}
					};
					var categoryThumbnailDropzone = new Dropzone("div#categoryThumbnail", categoryThumbnailDropzoneOptions);	
					categoryThumbnailDropzone.on("removedfile", (function(_this) {
						return function(file) {
							document.getElementById("categoryThumbnailHidden").value = '';
						};
					})(categoryThumbnailDropzone));
				</script>
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