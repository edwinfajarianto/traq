<div class="group">
	<label><?php echo l('page_title'); ?></label>
	<?php echo Form::text('title', array('value' => $page->title)); ?>
</div>
<div class="group">
	<label><?php echo l('slug'); ?></label>
	<?php echo Form::text('slug', array('value' => $page->slug)); ?> <abbr title="<?php echo l('help.slug'); ?>">?</abbr>
</div>
<div class="group">
	<label><?php echo l('page_content'); ?></label>
	<?php echo Form::textarea('body', array('value' => $page->body, 'class' => 'editor')); ?>
</div>