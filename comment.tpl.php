<div class="<?php print $classes . ' ' . $zebra; ?>">
	<div class="comment-inner">
		
    <h3 class="title"><?php print $title ?></h3>
    
    <?php if ($new) : ?>
      <span class="new"><?php print drupal_ucfirst($new) ?></span>
    <?php endif; ?>
    
    <?php print $picture ?>
	    
    <?php if ($submitted): ?>
      <span class="submitted"><?php print $submitted; ?></span>
    <?php endif; ?>
    
    <div class="content">
      <?php 
        hide($content['links']); 
        print render($content);
        if ($signature) {
          print $signature;
        }?>
    </div>
    
    <?php if (!empty($content['links'])): ?>
	    <div class="links"><?php print render($content['links']); ?></div>
	  <?php endif; ?>

  </div> <!-- /comment-inner -->
</div> <!-- /comment -->