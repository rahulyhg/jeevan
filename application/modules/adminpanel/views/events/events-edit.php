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
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('trip_name',stripslashes($records['trip_name']),' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('description').'&nbsp;'.get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('description',stripslashes($records['description']),' class="form-control required"');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('start date');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('start_date',get_date_formart(($records['start_date']), 'Y-m-d'),' class="form-control required event_from_date_picker required"');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('end date');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('end_date',get_date_formart(($records['end_date']), 'Y-m-d'),' class="form-control event_to_date_picker required"');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Trip Details');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('destinations',stripslashes(str_replace('|*|',' >>> ',$records['destinations'])),' class="form-control"  readonly');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Availalbe date');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box available_date"><?php echo form_input('available_date',$records['available_date'],' class="form-control availablelocation_datepicker"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Availalbe Location');?></label>							
							<?php 
								$desitinations_value = explode('|*|', $records['destinations']);
								$desitinations_key = $desitinations_value;
								$desitinations = array_combine($desitinations_key, $desitinations_value);							
							?>
							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box">
							<select name="available_location" class="form-control">
							<option value="">Select Location </option>
							<?php 
								foreach ($desitinations as $routes) : 
								if($records['available_location'] == $routes){
								 $selected = "selected";	
								}else{
									$selected = "";	
								}
								echo '<option value="'.$routes.'" '.$selected.'>'.stripslashes($routes)."</option>";
								endforeach;
							?>
						
							</select>
							<?php  //echo form_dropdown('available_location', $desitinations,stripslashes($records['available_location']),' class="form-control"  ');?></div></div>
						</div>
							<div class="form-group" id="file_upload_box">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Upload Image');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"> 
							  <div class="dropzone" id="photoofthedayFiles" name="photoofthedayFilesUploader"></div>
								 <div id="photoofthedayFilesHiddenContainer">
								<?php
								$media_files = json_decode($records['image']); 
								$i = 1;
								if($media_files != ""){
									
									foreach ($media_files->files as $media ){
										echo "<input type=\"hidden\" name=\"mediaFiles_stopped[]\" value=\"".$media."\" id='photooftheday_media_img_".$i."' />";
									$i++;	
									}
									
								}
								?>
								 </div>
							</div></div>
							<script type="text/javascript">
							var photoofthedayFilesDropzoneOptions = {
									url:  "<?php echo admin_url().$module."/upload_media"; ?>",
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
											file.previewElement.appendChild(input);
										}
									},
									
									init: function(){
										
										<?php 
										if($media_files != ""){
											foreach($media_files->files as $media) {
												$url = media_url().$media;
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
										input.setAttribute("name", "mediaFiles[]");
										input.value = '<?php echo $media; ?>';
										mockFile.previewElement.appendChild(input);
										
										this.emit('complete', mockFile);
										this._updateMaxFilesReachedClass();
										<?php } 
											}
										?>
									}
								};
								var photoofthedayFilesDropzone = new Dropzone("div#photoofthedayFiles", photoofthedayFilesDropzoneOptions);


						</script>
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
					echo form_hidden('remove_day_image','No');
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
	
    $(".available_date").mouseenter(function() {
  	  
	    	$(function () {
	    		
			    $('.availablelocation_datepicker').datetimepicker({
			        format: 'YYYY-MM-DD',	  		          
			        minDate : '<?php echo $records['start_date']; ?>',
			        maxDate : '<?php echo $records['end_date']; ?>',        
			    });
		
		});
    });
  
});


</script>