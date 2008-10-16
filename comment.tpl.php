<?php
// $Id$
?>
<div class="comment<?php echo ($comment->new) ? ' comment-new' : ''; echo ($comment->status == COMMENT_NOT_PUBLISHED) ? ' comment-unpublished' : ''; echo $zebra; ?>">
  <div class="comment-inner">
			
    <?php if ($title): ?>
      <h3 class="title"><?php echo $title; if (!empty($new)): ?> <span class="new"><?php echo $new; ?></span><?php endif; ?></h3>
    <?php elseif (!empty($new)): ?>
      <div class="new"><?php echo $new; ?></div>
    <?php endif; ?>
	  
	  <?php if ($comment->status == COMMENT_NOT_PUBLISHED): ?>
      <div class="unpublished"><?php echo t('Unpublished'); ?></div>
    <?php endif; ?>
	  
    <?php if ($picture): ?>
	    <div class="picture"><?php echo $picture; ?></div>
	  <?php endif; ?>
    
	  <div class="submitted">
	  	<?php echo t('On ') . format_date($comment->timestamp, 'custom', 'F jS, Y'); ?> <?php echo theme('username', $comment) . t(' says:'); ?>
	  </div>
	  
    <div class="content">
      <?php echo $content; ?>
    </div>
    
    <?php if ($links): ?>
      <div class="links">
        <?php echo $links; ?>
      </div>
    <?php endif; ?>

  </div>
</div> 