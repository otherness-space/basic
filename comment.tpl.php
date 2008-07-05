<?php
// $Id$
?>
<div class="comment<?php echo ($comment->new) ? ' comment-new' : ''; print ($comment->status == COMMENT_NOT_PUBLISHED) ? ' comment-unpublished' : ''; ?> <?php echo $zebra; ?>">
		
	<?php if ($new != '') { ?><span class="new"><?php echo $new; ?></span><?php } ?>

	<h3 class="title comment-title"><?php echo $title; ?></h3>
	
	<?php if ($picture) print $picture; ?>
  
	<div class="submitted">
		<?php echo t('On ') . format_date($comment->timestamp, 'custom', 'F jS, Y'); ?> <?php echo theme('username', $comment) . t(' says:'); ?>
	</div>
  <div class="content"><?php echo $content; ?></div>
  <div class="links"><?php echo $links; ?></div>
</div>
