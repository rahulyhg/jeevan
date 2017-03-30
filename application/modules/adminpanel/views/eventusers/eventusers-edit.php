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
                <?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
                        <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('name',$records['name'],' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('email').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('email',$records['email'],' class="form-control required" ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('phone number').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('phone_no',$records['phone_no'],' class="form-control required"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('purpose of appointment').get_required();?></label>
							<?php $purposes = array(  "Astrology" => "Astrology","Business Problem" => "Business Problem","Marriage Problem" => "Marriage Problem","Family Problem" => "Family Problem","Other Problem" => "Other Problem"); ?>
                            <div class="col-sm-<?php echo get_form_size();?>">                            
                            <?php  
                            $checked_pupose = json_decode($records['purpose_of_appointment']);
                           
                            $i= 1;
                            foreach ($purposes as $purposes_value){
                            	if(in_array($purposes_value, $checked_pupose)){
                            		$data = array(
                            				'name'          => 'purpose_of_appointment[]',
                            				'id'            => 'purpose_of_appointment-'.$i,
                            				'value'         => $purposes_value,
                            				'checked'       => TRUE,
                            				'style'         => 'margin:10px'
                            		);
                            	}else{
                            		$data = array(
                            				'name'          => 'purpose_of_appointment[]',
                            				'id'            => 'purpose_of_appointment-'.$i,
                            				'value'         => $purposes_value,
                            				'checked'       => FALSE,
                            				'style'         => 'margin:10px'
                            		);
                            	}
                            	
                            	
                            ?>
                             <div class="checkbox3 checkbox-success checkbox-inline checkbox-check  checkbox-circle checkbox-light">
                                           <?php echo form_checkbox($data); ?>
                                            <label for="purpose_of_appointment-<?php echo $i; ?>">
                                              <?php echo $purposes_value; ?>
                                            </label>
                              </div>
                            
                           <?php  	
                           $i++;
                            }                     
                           
                            ?></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Booking date').'&nbsp;'.get_required();?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box available_date"><?php echo form_input('booked_date', $records['booked_date'],' class="form-control required availablelocation_datepicker"  ');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('message');?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('message',$records['message'],'class="form-control" ' )?></div></div>
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
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>
					<?php
					echo form_hidden('edit_id',$records['id']);
					echo form_hidden ( 'action', 'edit' );					
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
			        minDate : '<?php echo $event_data['start_date']; ?>',
			        maxDate : '<?php echo $event_data['end_date']; ?>',        
			    });
		
		});
    });
  
});


</script>