<?php
// $Id$
?>
<div class="block block-<?= $block->module; ?> clearfix" id="block-<?= $block->module; ?>-<?= $block->delta; ?>">
  <div class="blockinner">

    <?php if ($block->subject) { ?><h2 class="title block-title"> <?= $block->subject; ?> </h2><?php } ?>

    <div class="content">
      <?= $block->content; ?>
    </div>
    
    <?= $edit_links; ?>

  </div>
</div>
