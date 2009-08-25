<?php  /* only display block markup if not main content */  if ($block->delta != 'main'): ?>
<div id="block-<?php print $block->module .'-'. $block->delta ?>" class="<?php print $classes; ?> clearfix">
  <div class="block-inner">
<?php endif; ?>

    <?php if (!empty($block->subject)): ?>
		  <h3 class="title block-title"><?php print $block->subject; ?></h3>
		<?php endif; ?>
		
		<div class="content">
		  <?php print $content; ?>
		</div>

<?php if ($block->delta != 'main'): ?>
  <?php echo $edit_links; ?>
  </div>
</div> <!-- /block-inner /block -->
<?php endif; ?>