
<div class="pagination_bar">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        
            <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
            <button class="btn btn-default multi_action" data="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
            
            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
        
        </div>     
    </div>
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
			<th>
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  ');?>
            </th>		 		 
			<th><?=get_label('title');?></th> 
			<th><?=get_label('type');?></th> 
			<th><?=get_label('page');?></th> 
			<th><?=get_label('position');?></th> 
			<th><?=get_label('actions');?></th>
		</tr>
	</thead>


	<tbody class="append_html">
 <?php
	if (! empty ( $records )) {
		foreach ( $records as $val ) {
			?>
<tr>
			<th scope="row"><?php echo form_checkbox('id[]',$val['id'],'',' class="multi_check" ');?> 
			<td><?php echo $val['title'];?></td>
			<td><?php echo $block_types[$val['type']];?></td>
			<td><?php echo $block_pages[$val['page']];?></td>
			<td><?php echo $page_postions[$val['page']][$val['position']];?></td>
			
				<td><a href="javascript:;"><?php echo show_status($val['is_active'],$val['id']);?></a></td>
			
		 
			<td>
				
				<a href="javascript:;" class="delete_record btn btn-danger" id="<?php echo encode_value($val['id']);?>"
					data="Delete"><i class="fa fa-trash"
				title="<?php echo get_label('delete')?>"></i></a>
	
					<a  href="<?php echo admin_url().$module."/edit/".encode_value($val['id']);?>" class="btn btn-success"><i class="fa fa-edit"
					title="<?php echo get_label('edit')?>"></i></a>
				
			</td>
		</tr>
<?php  } } else { ?>
<tr class="no_records" >

			<td colspan="15" class=""><?php echo sprintf(get_label('admin_no_records_found'),$module_label); ?></td>
		</tr>

<?php } ?>



	</tbody>
		<thead class="last">
		<tr>	
			<th>
                    <?= form_checkbox('multicheck','Y',FALSE,' class="multicheck_top"  ');?>
            </th>		 
			<th><?=get_label('title');?></th> 
			<th><?=get_label('type');?></th> 
			<th><?=get_label('page');?></th> 
			<th><?=get_label('position');?></th> 
			<th><?=get_label('actions');?></th>
		</tr>
	</thead>

</table>
</div>
    
				<div class="pagination_bar">
                    <div class="btn-toolbar pull-left">
                        <div class="btn-group">
				       
				            <button class="btn btn-default multi_action" data="Activate" type="button"><?php echo get_label('activate');?></button>
				            <button class="btn btn-default multi_action" data="Deactivate" type="button"><?php echo get_label('deactivate');?></button>
				       		  
				            <button class="btn btn-default multi_action" data="Delete" type="button"><?php echo get_label('delete');?></button>
				        
				        </div>        
                    </div>
                    <div class="pagination_custom pull-right">
                        <div class="pagination_txt">
                            <?php echo show_record_info($total_rows,$start,$limit);?>
                        </div>
                        <?php echo $paging;?>
                    </div>
                    <div class="clear"></div>
				</div>
		