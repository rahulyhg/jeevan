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
			<th><?=get_label('message');?></th>
			<th><?= get_label('created_on');?></th>

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
            <td><?php echo output_value($val['message_text']);?></td>
			<td><?php echo get_date_formart(($val['created']));?></td>
			
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
			<th><?=get_label('message');?></th>
			<th><?= get_label('created_on');?></th>


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
		