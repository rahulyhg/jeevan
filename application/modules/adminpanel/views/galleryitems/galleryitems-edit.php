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
                         <div class="form-group" id="menu_name">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Title').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('title',$records['title'],' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Description');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('description',$records['description'],' class="form-control"  ');?></div></div>
						</div>
                        <div class="form-group" id="is_order">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Position');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<input type="number" name="is_order" class="form-control" value="<?php echo $records['is_order']; ?>">
							</div>
							</div>
						</div>
					<?php /* ?>	<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('thumbnail');?></label>
									<div class="col-sm-<?php echo get_form_size();?>"><div class="dropzone" id="galleryThumbnail" name="galleryThumbnailFileUploader"></div>
									<input id="galleryThumbnailHidden" type="hidden" name="thumbnail" value="" />
									</div>
						</div>
						<script type="text/javascript">					
							var galleryThumbnailDropzoneOptions = {
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
										document.getElementById("galleryThumbnailHidden").value = response.file;
									}
								}
							};
							var galleryThumbnailDropzone = new Dropzone("div#galleryThumbnail", galleryThumbnailDropzoneOptions);	
							galleryThumbnailDropzone.on("removedfile", (function(_this) {
								return function(file) {
									document.getElementById("galleryThumbnailHidden").value = '';
								};
							})(galleryThumbnailDropzone));
						</script>
					<?php */ ?>	
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Media Type').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">							
									<?php
										$media_types = array('1' => 'Image', '2' => 'Video File', '3' => 'Video URL');
										$selected = $records['media_type'];
										foreach($media_types as $key => $media_type) {
											$id = "media-type-".$key;
											$checked = ($key == $selected);
									?>
									<div class="radio3 radio-check radio-success radio-inline">
										<?php echo form_radio("media_type", $key, $checked, 'id="'.$id.'"'); ?>
										<label for="<?php echo $id; ?>"><?php echo $media_type; ?></label>
									</div>
									<?php } ?>				
                                </div>
							</div>
						</div>
                       <div class="form-group" id="file_upload_box" style="<?php echo ($records['media_type'] == 3) ? 'display:none;' :'';?>">
									<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Media Item');?></label>
									<div class="col-sm-<?php echo get_form_size();?>"><div class="dropzone" id="galleryMedia" name="galleryMediaFileUploader"></div>
									
									</div>
						</div>
								
						<script type="text/javascript">
						var galleryMediaDropzoneOptions = {
							url: "<?php echo admin_url().$module; ?>/upload_media",
							maxFiles : 1,
							addRemoveLinks: true,
							success:function(file, response, e) {
								response = JSON.parse(response);
								if(response.success == 0) {
									this.defaultOptions.error(file,response.message);
								} else {
									var input = document.createElement("input");
									input.setAttribute("type", "hidden");
									input.setAttribute("name", "mediaFiles");
									input.value = response.file;
									file.name = response.file;
									file.previewElement.appendChild(input);
								}
							},
							init: function(){
								this.on("sending", function(file, xhr, formData){
									var media_type = $('input:radio[name=media_type]:checked').val();
			                        formData.append("media_type", media_type);
			             	   });
								<?php 
								if($records['file_name'] != "" && $records['media_type'] != 3) {
											$url = media_url().$records['file_name'];
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
									input.setAttribute("name", "mediaFiles");
									input.value = '<?php echo $records['file_name']; ?>';
									mockFile.previewElement.appendChild(input);
									
									this.emit('complete', mockFile);
									this._updateMaxFilesReachedClass();
									<?php } ?>	   
							}
						};
						var galleryMediaDropzone = new Dropzone("div#galleryMedia", galleryMediaDropzoneOptions);
					</script>
                    
                    
					  <div class="form-group" id="video_url"   style="<?php echo ($records['media_type'] == 3) ? '' :'display:none;';?>">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Video URL');?></label>
							<?php $video_url = ($records['media_type'] == 3) ? $records['file_name'] :''; ?>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('video_url',$video_url,' class="form-control url"  ');?></div></div>
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
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
   
	$("[name='media_type']").change(function(){
		
		galleryMediaDropzone.removeAllFiles();	
		var types = ['image/*', 'video/*'];
		if(this.value != 3) {
			galleryMediaDropzone.options.acceptedFiles = types[this.value-1];
			galleryMediaDropzone.hiddenFileInput.setAttribute("accept", types[this.value-1]);
			$("#file_upload_box").show();
			$("#video_url").hide();
		} else {
			$("#file_upload_box").hide();
			$("#video_url").show();
		}
	});
});
</script>