<?php
// $Id$
?>
<div class="block block-<?php echo $block->module; ?> clearfix" id="block-<?php echo $block->module; ?>-<?php echo $block->delta; ?>">
  <div class="block-inner">

    <?php if ($block->subject): ?>
		  <h3 class="title block-title"><?php echo $block->subject; ?></h3>
		<?php endif; ?>

    <div class="content">
      <?php echo $block->content; ?>
    </div>
    
    <?php if($edit_links): ?>
      <?php echo $edit_links; ?>
    <?php endif; ?>

  </div>
</div>
