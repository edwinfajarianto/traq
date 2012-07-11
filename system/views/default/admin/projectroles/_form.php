<div class="group">
	<label><?php echo l('name'); ?></label>
	<?php echo Form::text('name', array('value' => $role->name)); ?>
</div>
<div class="group">
	<?php echo Form::label(l('project'), 'project'); ?>
	<?php echo Form::select('project', array_merge(array(array('label' => l('all'), 'value' => 0)), Project::select_options()), array('value' => $role->project_id)); ?>
</div>