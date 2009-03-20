<?php // $Id$ ?>
<div id="block-<?php echo $block->module .'-'. $block->delta ?>" class="block block-<?php echo $block->module .' '. $block_zebra .' '. $block->region ?>">
	<div class="block-inner">

		<?php if ($block->subject): ?>
		  <h3 class="title block-title"><?php echo $block->subject; ?></h3>
		<?php endif; ?>
		
		<div class="content">
		  <?php echo $block->content; ?>
		</div>
		
	  <?php
	   if (user_access('administer blocks')) {
  	   echo $edit_links; 	     
	   }
	   ?>

	</div> <!-- /block-inner -->
</div> <!-- /block -->