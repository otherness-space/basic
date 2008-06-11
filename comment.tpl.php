<?php
// $Id$
?>
<div class="comment<?= ($comment->new) ? ' comment-new' : ''; print ($comment->status == COMMENT_NOT_PUBLISHED) ? ' comment-unpublished' : ''; ?> <?= $zebra; ?>">
		
	<?php if ($new != '') { ?><span class="new"><?= $new; ?></span><?php } ?>

	<h3 class="title comment-title"><?= $title; ?></h3>
	
	<?php if ($picture) print $picture; ?>
  
	<div class="submitted">
		<?= t('On ') . format_date($comment->timestamp, 'custom', 'F jS, Y'); ?> <?= theme('username', $comment) . t(' says:'); ?>
	</div>
  <div class="content"><?= $content; ?></div>
  <div class="links"><?= $links; ?></div>
</div>
