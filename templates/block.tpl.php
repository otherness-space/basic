<div id="block-<?php print $block->module .'-'. $block->delta ?>" class="<?php print $classes; ?> clearfix">
  <div class="block-inner">

    <?php if (!empty($block->subject)): ?>
		  <h3 class="title block-title"><?php print $block->subject; ?></h3>
		<?php endif; ?>
		
		<div class="content">
		  <?php print $content; ?>
		</div>

  </div>
</div> <!-- /block-inner /block -->