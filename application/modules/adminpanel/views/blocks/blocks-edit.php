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
					<?php echo form_open_multipart(admin_url().$module.'/edit',' class="form-horizontal" id="common_form" ' );?>
					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('title').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('title',$records['title'],' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('order').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('order',$records['order'],' class="form-control required"  ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('page').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo form_dropdown('page',$block_pages,$records['page'], "class=\"form-control required\" onchange=\"getBlockPositions(this)\" id=\"form_block_page\""); ?>						 
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('position').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo form_dropdown('position',array(),$records['position'], "class=\"form-control required\" id=\"form_block_position\""); ?>						 
                                </div>
							</div>
						</div>