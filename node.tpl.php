<?php // $Id$ ?>
<div class="node <?php echo $node_classes; ?>" id="node-<?php echo $node->nid; ?>">
	<div class="node-inner">
    
    <?php if ($page == 0): ?>
	    <h2 class="title node-title">
				<a href="<?php echo $node_url; ?>"><?php echo $title; ?></a>
			</h2>
    <?php endif; ?>

    <?php if ($picture): ?>
	    <div class="picture"><?php echo $picture; ?></div>
	  <?php endif; ?>
		    
    <?php if ($submitted): ?>
      <span class="submitted"><?php echo $submitted; ?></span>
    <?php endif; ?>
    
    <?php if ($terms): ?>
      <div class="terms"><?php print $terms ?></div>
    <?php endif;?>
  	
  	<div class="content">
  	  <?php echo $content; ?>
  	</div>
  	
    <?php if ($links): ?> 
	    <div class="links"> <?php echo $links; ?></div>
	  <?php endif; ?>
    
	</div> <!-- /node-inner -->
</div> <!-- /node-->

 <?php print $comments; ?>