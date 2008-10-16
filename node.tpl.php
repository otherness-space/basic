<?php
// $Id$
?>

<div class="node<?php if ($sticky) { echo " sticky"; } ?><?php if (!$status) { echo " node-unpublished"; } ?> clearfix" id="node-<?php echo $node->nid; ?>">
	<div class="node-inner">
		
    <?php if ($page == 0): ?>
	    <h2 class="title node-title"> <a href="<?php echo $node_url ?>"><?php echo $title; ?></a></h2>
    <?php endif; ?>
    
    <?php if ($picture): ?>
	    <div class="picture"><?php echo $picture; ?></div>
	  <?php endif; ?>
    
	  <?php if ($submitted || $has_terms): ?>
	  	<div class="meta<?php if ($has_terms): ?> with-taxonomy<?php endif; ?>">
    
	  	<?php if ($submitted): ?>
	  		<div class="submitted"><?php echo t('Posted !date by !name', array('!date' => format_date($node->created, 'custom', "F jS, Y"), '!name' => theme('username', $node))); ?></div>
	  	<?php endif; ?>
    
	  	<?php if ($has_terms): ?> 
	  		<div class="taxonomy"><?php echo $terms; ?></div>
	  	<?php endif; ?>
    
	    </div>
    <?php endif; ?>
    
    <div class="content">
      <?php echo $content; ?>
    </div>
    
    <?php if ($links): ?> 
	    <div class="links"> <?php echo $links; ?></div>
	  <?php endif; ?>
	
  </div>
</div>

