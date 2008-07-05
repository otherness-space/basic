<?php
// $Id$
?>
<div class="block block-<?php echo $block->module; ?> clearfix" id="block-<?php echo $block->module; ?>-<?php echo $block->delta; ?>">
  <div class="blockinner">

    <?php if ($block->subject) { ?><h2 class="title block-title"> <?php echo $block->subject; ?> </h2><?php } ?>

    <div class="content">
      <?php echo $block->content; ?>
    </div>
    
    <?php echo $edit_links; ?>

  </div>
</div>
