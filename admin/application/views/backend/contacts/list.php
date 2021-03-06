<div class="table-responsive animated fadeInRight">
	<table class="table m-0 table-striped">
		<tr>
			<th><?php echo get_msg('no')?></th>
			<th><?php echo get_msg('contact_name')?></th>
			<th><?php echo get_msg('contact_email')?></th>
			
			<?php if ( $this->ps_auth->has_access( DEL )): ?>
				
				<th><?php echo get_msg('btn_delete')?></th>
			
			<?php endif; ?>
		</tr>

	<?php $count = $this->uri->segment(4) or $count = 0; ?>

	<?php if ( !empty( $contacts ) && count( $contacts->result()) > 0 ): ?>

		<?php foreach($contacts->result() as $contact): ?>
			
			<tr>
				<td><?php echo ++$count;?></td>
				<td><?php echo $contact->name;?></td>
				<td><?php echo $contact->email;?></td>

				<?php if ( $this->ps_auth->has_access( DEL )): ?>
					
					<td>
						<a herf='#' class='btn-delete' data-toggle="modal" data-target="#myModal" id="<?php echo $contact->id;?>">
							<i class='fa fa-trash-o'></i>
						</a>
					</td>
				
				<?php endif; ?>
				
				

			</tr>

		<?php endforeach; ?>

	<?php else: ?>
			
		<?php $this->load->view( $template_path .'/partials/no_data' ); ?>

	<?php endif; ?>

</table>
</div>