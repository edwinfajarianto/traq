<h3><?php echo l('edit_user'); ?></h3>
<form action="<?php echo Request::full_uri(); ?>" method="post" class="overlay_thin">
	<?php show_errors($user->errors); ?>
	<div class="tabular box">
		<?php View::render('admin/users/_form'); ?>
	</div>
	<div class="actions">
		<input type="submit" value="<?php echo l('save'); ?>" />
	</div>
</form>