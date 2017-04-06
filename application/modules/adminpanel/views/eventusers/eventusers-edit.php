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
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php echo form_input('booked_date', $records['booked_date'],' class="form-control required"  readonly');?></div></div>
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Appointment date');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box available_date">
							<?php echo form_input('appointment_date', (($records['appointment_date'] !="0000-00-00" && $records['appointment_date'] != "") ? $records['appointment_date'] : '0000-00-00'),' class="form-control availablelocation_datepicker"');?>
							
							</div></div>
							
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Appointment Start Time');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>">
							<div class="input-group  appointment_start_time">
							<?php 
							$appointment_start_time = (($records['appointment_start_time'] !="0000-00-00" && $records['appointment_start_time'] != "") ? $records['appointment_start_time'] : $records['appointment_start_time']);
							echo form_input('appointment_start_time', get_date_formart($appointment_start_time, 'H:i'),' class="form-control "');?>
							<span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
							</div></div>
							
						</div>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Appointment End Time');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input-group appointment_end_time">
							<?php 
							$appointment_end_time = (($records['appointment_end_time'] !="0000-00-00" && $records['appointment_start_time'] != "") ? $records['appointment_end_time'] : $records['appointment_end_time']);
							echo form_input('appointment_end_time', get_date_formart($appointment_end_time, 'H:i'),' class="form-control appointment_end_time"');?>
							<span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
							</div></div>
						</div>
						<div class="form-group appointment_booked_list" style="display: none">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('Appointment Scheduled Times');?></label>							
							<div class="col-sm-<?php echo get_form_size();?>">
							<div class="input_box">
							<div id="appointment_history">
							
							</div>
								<?php /*	echo form_input(array('name' => 'appointment_time', 'type'=>'hidden', 'id' =>'appointment_time', 'value' => $records['appointment_time'])); ?>
								<?php $appointment_hours = get_hoursRange(0, 86400, 60 * 30, 'h:i a'); ?>
								<table class="table timebox">
	                                   <thead>
	                                     <?php 
	                                    	 $j = 0;
		                                     foreach ($appointment_hours as $key => $hours){
		                                     	if($j%12 == 0 || $j == 0):
		                                     	echo "<tr>";
		                                     	endif;
		                                  ?>
		                                  <td><button name="times-<?php echo $j; ?>" class="get_booking_time btn btn-primary" data-gettime='<?= $key?>'> <?=  $hours ?></button> </td>
		                                  <?php    	
		                                     	$j++;
		                                     	if($j%12 == 0 && $j != 0):
		                                     	echo "</tr>";
		                                     	endif;
		                                     }
	                                     ?>
							  			 
							    </table>
							    <?php */ ?>
							</div>
							</div>
							
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
	$('.get_booking_time').click(function(e){
		e.preventDefault();
	    var gettime = $(this).data('gettime');
	   
	    $('#appointment_time').val(gettime);
	    if ($('td').is('.activetime_colmn')){
	    	$('td').removeClass('activetime_colmn');
		}
	    $(this).closest( "td" ).toggleClass('activetime_colmn');
	    
	});

  $(".available_date").focusin(function() {  
	    	$(function () {	    		
			    $('.availablelocation_datepicker').datetimepicker({
			        format: 'YYYY-MM-DD',	  		          
			        minDate : '<?php echo $event_data['start_date']; ?>',
			        maxDate : '<?php echo $event_data['end_date']; ?>',        
			        showClear:true,
			    });			    
		});
	
   });
 
  var startTime =  $('.appointment_start_time').clockpicker({
    	placement: 'top',
    	align: 'left',
    	autoclose: true,
    	'default': 'now'
    }).find('input').change(function(){
    	$(".alert_msg").hide();
    	/* start time */
    	var start_time = this.value;

    	/* end time */
    	var end_time = $('.appointment_end_time').find('input').val();

    	/* convert both time into timestamp */
    	var stt = new Date("November 13, 2013 " + start_time);
    	stt = stt.getTime();

    	var endt = new Date("November 13, 2013 " + end_time);
    	endt = endt.getTime();

    	/* by this you can see time stamp value in console via firebug */
    	console.log("Time1: "+ stt + " Time2: " + endt);

    	if(stt > endt || stt == endt) {
        	
    	    $(".alert_msg").show().html('Start-time must be smaller then End-time.');
            $('.side-body').scrollView();
    	        return false;
    	}
    });
    $('.appointment_end_time').clockpicker({
    	placement: 'bottom',
    	align: 'left',
    	autoclose: true,
    	'default': 'now'
    }).find('input').change(function(){
    	$(".alert_msg").hide();
    	
    	var edit_id = $("input[name='edit_id']").find().val();
    	var appointment_date = $('.available_date').find('input').val();
    	/* start time */
    	var start_time = $('.appointment_start_time').find('input').val();

    	/* end time */
    	var end_time = this.value;

    	/* convert both time into timestamp */
    	var stt = new Date("November 13, 2013 " + start_time);
    	stt = stt.getTime();

    	var endt = new Date("November 13, 2013 " + end_time);
    	endt = endt.getTime();

    	/* by this you can see time stamp value in console via firebug */
    	console.log("Time1: "+ stt + " Time2: " + endt);

    	if(stt > endt || stt == endt) {
        	
    	    $(".alert_msg").show().html('End-time must be bigger then Start-time.');
            $('.side-body').scrollView();
    	        return false;
    	}
    	$.ajax({
            url: admin_url + module + "/check_available_time",
            data: { 'ajax_request' : 'yes' , 'edit_id' : edit_id,'appointment_date' : appointment_date, 'appointment_start_time' : start_time, 'appointment_end_time' : end_time },
            type: 'POST',
            dataType: "json",
            success: function (data) {
            	 if (data == "1") {
            		 $(".alert_msg").show().html('The appointment time hase been already booked on this date.');
                     $('.side-body').scrollView();
                      
                  } else {
                	  $(".alert_msg").hide();
                  }
              }
            
        });
    });
    

   
    $(function () {	    		
	   /* $('.appointment_start_time').datetimepicker({
	    	 format: 'LT',	 	
	    	 disabledTimeIntervals: [
	    	      [moment().hour(00).minutes(00), moment().hour(13).minutes(30)],
	    	      [moment().hour(20).minutes(00), moment().hour(21).minutes(00)]
	    	   ]
	    });
	   
	    $('.appointment_end_time').datetimepicker({
	    	 format: 'LT',	 
	    	 
	    	 disabledTimeIntervals: [
	    	      [moment().hour(00).minutes(00), moment().hour(13).minutes(30)],
	    	      [moment().hour(20).minutes(00), moment().hour(21).minutes(00)]
	    	   ]
	    	
	    });
	  */

    	
    });
});

</script>