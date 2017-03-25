<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
			<span class="title"><?=get_label('block_types');?></span>
			
		
        </div>

		<div class="row">
			<div class="col-xs-12">
				<div class="card ">
					<div class="card-body">
						<table class="table ">

							<tbody class="append_html">
						 <?php
								foreach ( $block_types as $type => $label ) {
									if($type == "") continue;
									?>
								<tr>
									<td><a href="<?php echo admin_url() . $module . "/add/" . $type; ?>" class="btn" style="display:block; text-align:left;"><?=$label?></a></td>
								</tr>
								<?php } ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
