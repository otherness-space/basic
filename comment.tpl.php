<div class="comment<?php print ($comment->new) ? ' comment-new' : ''; print ' ' . $status; print ' ' . $zebra; ?>">
	<div class="comment-inner">
		
    <?php if ($title): ?>
      <h3 class="title"><?php echo $title; if (!empty($new)): ?> <span class="new"><?php echo $new; ?></span><?php endif; ?></h3>
    <?php elseif (!empty($new)): ?>
      <div class="new"><?php echo $new; ?></div>
    <?php endif; ?>
        
    <?php if ($picture): ?>
	    <div class="picture"><?php echo $picture; ?></div>
	  <?php endif; ?>
	    
    <div class="submitted">
      <?php echo $submitted; ?>
    </div>
    
    <div class="content">
      <?php echo $content ?>
      <?php if ($signature): ?>
      <div class="user-signature clearfix">
        <?php echo $signature; ?>
      </div>
      <?php endif; ?>
    </div>
    
    <?php if ($links): ?>
      <div class="links">
        <?php echo $links; ?>
      </div>
    <?php endif; ?>  

  </div> <!-- /comment-inner -->
</div> <!-- /comment -->