<div class="content">
	<?php echo link_to(l('new_user'), '/admin/users/new', array('class' => 'button_new')); ?>
</div>
<div>
	<table class="list">
		<thead>
			<th class="fixed_username"><?php echo l('username'); ?></th>
			<th class="usergroup"><?php echo l('group'); ?></th>
			<th class="actions"><?php echo l('actions'); ?></th>
		</thead>
		<tbody>
		<?php foreach ($users as $user) { ?>
			<tr>
				<td><?php echo link_to($user->username, "/admin/users/{$user->id}/edit"); ?></td>
				<td><?php echo $user->group->name; ?></td>
				<td>
					<?php echo link_to(l('edit'), "/admin/users/{$user->id}/edit", array('class' => 'button_edit')); ?>
					<?php echo link_to(l('delete'), "/admin/users/{$user->id}/delete", array('class' => 'button_delete', 'data-confirm' => l('confirm:delete_x', $user->username))); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>