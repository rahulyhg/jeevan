<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
			<span class="title"><?php echo $module_labels; ?></span>
			
		
        </div>

		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-header">
		 			  <div class="pull-right card-action">
		                     <div class="btn-group" role="group" aria-label="...">
		                       
		                         	<a  href="<?php echo admin_url().$module."/add";?>" class="btn btn-success"><?php echo get_label('add');?> </a>
		                     	
		                      </div>
		              </div>
                        <div class="card-title"> 
                            
                            <?php echo form_open('',' id="common_search" class="form-inline"');?> 
                               
                                <?php echo form_hidden('search_value', 'title'); ?>
								<?php echo form_input('search_value',get_session_value($module."_search_value"),'class="form-control" placw');?>
								<?php echo form_dropdown('search_block_type',$block_types,get_session_value($module."_search_block_type")); ?>
								<?php echo form_dropdown('search_page',$block_pages,get_session_value($module."_search_page"), "onchange=\"getBlockPositions(this)\" id=\"search_block_page\""); ?>
								<?php echo form_dropdown('search_position',array(),'', "id=\"search_block_position\""); ?>
								<?php echo get_is_active_dropdown(get_session_value($module."_search_status"));?>
                                  
                                <button class="btn btn-primary" type="button" id="submit_search" onclick="get_content('')"><i class="fa fa-search"></i></button> <a class="btn btn-info"  id="reset_search"  href="<?php echo admin_url().$module."/refresh"?>"><i class="fa fa-refresh"></i>&nbsp; Refresh</a> 
                             <?php echo form_close(); ?>   
                             
                          </div>
                    </div>
					<div class="card-body">
                        
						
						
					  <?php echo form_open(admin_url().$module."/action",array("id"=>"mainform","class"=>"action_form"));?>
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
						<input  type="hidden"  name="multiaction"  id="multiaction"  value="">
					    <input  type="hidden"  name="page_id"  id="page_id" value="0">
						<div class="cntloading_wrapper min_height" > <?php echo loading_image('cnt_loading');?>  <div class="append_html"></div></div>
							
                                    <?php // echo $paging;?>
                                  <?php echo form_close();?>  
                                             
                                </div>
				</div>
			</div>
		</div>

	</div>
</div>

<script>
/*  load initial content.. */
$(window).load(function(){
	get_content({paging:"true"});
});
var block_positions = <?php echo json_encode($page_postions); ?>;
function getBlockPositions(obj, block_position) {
	if(typeof block_position === 'undefined') {
		block_position = '';
	}
	
	var block_page_position = document.getElementById("search_block_position");
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

var block_page_obj = document.getElementById("search_block_page");
var block_position = '<?php echo get_session_value($module."_search_position"); ?>';
getBlockPositions(block_page_obj, block_position);
</script>