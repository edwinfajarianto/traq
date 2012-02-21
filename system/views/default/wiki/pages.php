<?php View::render('wiki/_nav'); ?>
<div class="wiki content">
	<div id="head">
		<h2 id="page_title"><?php echo l('pages'); ?></h2>
		<ul id="wiki_actions">
			<?php if (current_user()->permission($project->id, 'create_wiki_page')) { ?>
			<li><?php echo HTML::link(l('new_page'), $project->href('wiki/_new'), array('class' => 'button_new')); ?></li>
			<?php } ?>
		</ul>
	</div>
	

	<ul id="pages">
	<?php foreach ($pages as $page) { ?>
		<li><?php echo HTML::link($page->title, $page->href()); ?></li>
	<?php } ?>
	</ul>
</div>