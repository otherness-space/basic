<?php
// $Id$
?>
<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?> clearfix" id="node-<?php echo $node->nid; ?>">
  <?php if ($page == 0): ?> <h2 class="title node-title"> <a href="<?php echo $node_url ?>"><?php echo $title ?></a> </h2> <?php endif; ?>

  <?php if ($picture) print $picture ?>

	<?php if ($submitted or $has_terms): ?> <div class="meta<?php if ($has_terms) : ?> with-taxonomy<?php endif; ?>">

		<?php if ($submitted): ?> <div class="submitted"><?php echo t('Posted !date by !name', array('!date' => format_date($node->created, 'custom', "F jS, Y"), '!name' => theme('username', $node))); ?></div>  <?php endif; ?>

		<?php if ($has_terms) : ?> <div class="taxonomy"><?php echo $terms ?></div> <?php endif; ?>

	</div>

  <?php endif; ?>

  <div class="content">
    <?php echo $content?>
  </div>

  <?php if ($links): ?> <div class="links"> <?php echo $links ?> </div> <?php endif; ?>

</div>

