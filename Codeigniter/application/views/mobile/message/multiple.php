<div id="messages" class="alert alert-<?php print $state; ?> multiple">
	<ul>
	<?php foreach $messages as $message : ?>
		<li><?php $message['message']; ?></li>
	<?php endforeach; ?>
	</ul>
</div>