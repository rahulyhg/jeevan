<div class="pagination_bar">
   
    <div class="pagination_custom pull-right">
        <div class="pagination_txt">
            <?php echo show_record_info($total_rows,$start,$limit);?>
        </div>
        <?php echo $paging;?>
    </div>
    <div class="clear"></div>
</div>
<div class="table-responsive">
<table class="table ">
	<thead class="first">
		<tr>
			<th><?=get_label('firstname');?></th>
            <th><?=get_label('lastname');?></th>
			<th><?= get_label('email');?></th>
			<th><?= get_label('phone');?></th>
			<th><?=get_label('message');?></th>
			<th><?= get_label('created_on');?></th>
			<th><?=get_label('reply');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
<tr>
  
		
			
			<td><?php echo output_value($val['firstname']);?></td>
            <td><?php echo output_value($val['lastname']);?></td>
			<td><?php echo output_value($val['email']);?></td>
			<td><?php echo output_value($val['phone']);?></td>
            <td><?php echo output_value($val['message_text']);?></td>
			<td><?php echo get_date_formart(($val['created']));?></td>
			<th><a href="javascript:void(0);" class="btn btn-primary Myreply" id="<?php echo $val['id']; ?>" data-toggle="modal" data-target=".myReply"><i class="fa fa-reply" aria-hidden="true"></i>
</a></th>



			</tr>
<?php  } } else { ?>
<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_label); ?></td>
		</tr>

<?php } ?>





	</tbody>
		<thead class="last">
		<tr>
			<th><?=get_label('firstname');?></th>
            <th><?=get_label('lastname');?></th>
			<th><?= get_label('email');?></th>
			<th><?= get_label('phone');?></th>
			<th><?=get_label('message');?></th>
			<th><?= get_label('created_on');?></th>
			<th><?=get_label('reply'); ?></th>

		</tr>
	</thead>

</table>
</div>
    
				<div class="pagination_bar">
                    
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
  <!--########## Reply ########-->            
<div class="modal fade myReply" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Feedback Reply</h4>
</div>
<div class="modal-body">
<p class="reply_status alert" style="display:none;"></p>
<?php echo form_open_multipart(admin_url().$module.'/feedback_reply',' class="form-horizontal" id="reply_form" ' );?>
<input type="hidden" name="feedback_id" id="feedback_id" value="">					
<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 pull-left"><?php echo get_label('reply message').'&nbsp;'.get_required();?></label>
    <div class="col-sm-5"><div class="input_box">
    <?php  echo form_textarea('reply_message',set_value('reply_message'),' class="form-control required"  maxlenght="250" ');?>
    </div></div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-<?php echo get_form_size();?>  btn_submit_div">
        <button type="submit" class="btn btn-primary " name="submit" id="reply_submit"
            value="Submit"><?php echo get_label('submit');?></button>
        <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
    </div>
</div>
<?php
echo form_hidden ( 'action', 'reply' );
echo form_close ();
?>	

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

<script>
$(document).ready(function(e) {
    $(".Myreply").click(function(e) {
		var id = $(this).attr('id');
		$("#feedback_id").val(id);
        $('.myModal').modal('show');
    });
});
function MyReply(id) {
	
	
	
}

</script>
<script type="text/javascript">
 $("#reply_form").validate({
ignore: ".ignore",
rules: {
	reply_message:{required: true},
	
},
messages: {
	reply_message:{required: "Enter your reply message"},
},
submitHandler: function (form) {

	var request;
	$('#reply_submit').attr("disabled", true);
	var last = $('#reply_form').serialize();
	request =  $.ajax({
		type: 'POST',
		url: admin_url + 'feedback/feedback_reply',
		dataType:"json",
		data:last,
		success: function(data) {
			
			if (data.status == 'success') {
				$('.reply_status').show();
				$('.reply_status').addClass('alert-success');
				$('.reply_status').html(data.message).slideDown();
				$("#reply_message").val('');
				setTimeout(function () {
					location.href = admin_url + 'feedback';
				}, 1000);
			}
			else {
				$('.reply_status').show();
				$('.reply_status').addClass('alert-warning');
				$('.reply_status').html(data.message).slideDown();
				$("#reply_message").val('');
				$('#reply_submit').attr("disabled", false);
			} 
		}
	});
}
});




</script>
		