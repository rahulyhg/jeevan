						<?php  echo form_hidden('params[css_id]','');?>
						<?php  echo form_hidden('params[css_id]','');?>
						<?php /** div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('block_element_id');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('params[css_id]',$records["type_params"]['css_id'],' class="form-control"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('block_element_class');?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('params[css_class]',$records["type_params"]['css_class'],' class="form-control"  ');?></div></div>
						</div> **/?>
						
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
					echo form_hidden ( 'type', $block_type );
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var block_positions = <?php echo json_encode($page_postions); ?>;
function getBlockPositions(obj, block_position) {
	if(typeof block_position === 'undefined') {
		block_position = '';
	}
	
	var block_page_position = document.getElementById("form_block_position");
	block_page_position.innerHTML = '';	
		
	var opt = document.createElement('option');
	opt.value = '';
	opt.innerHTML = 'Select Position';
	opt.selected = true;
	block_page_position.appendChild(opt);
	
	if(obj && obj.value != '') {	
		if (block_positions.hasOwnProperty(obj.value)) {
			var position = block_positions[obj.value];
			for(var key1 in position) {
				var opt = document.createElement('option');
				opt.value = key1;
				opt.innerHTML = position[key1];
				if(key1 == block_position) {
					opt.selected = true;
				}
				block_page_position.appendChild(opt);
			}
		}
	}
}

var block_page_obj = document.getElementById("form_block_page");
var block_position = '<?php echo $records["position"]; ?>';
getBlockPositions(block_page_obj, block_position);
</script>