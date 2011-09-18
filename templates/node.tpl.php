<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
	<div class="node-inner">
    
    <?php if (!$page): ?>
    	<header>
    		<?php print render($title_prefix); ?>
		      <h2<?php print $title_attributes; ?>>
		      	<a href="<?php print $node_url; ?>"><?php print $title; ?></a>
		      </h2>
	      <?php print render($title_suffix); ?>
      </header>
    <?php endif; ?>

	  <?php if ($display_submitted || $user_picture): ?>
	    <footer class="author">
	      <?php print $user_picture; ?>
	      <?php print $submitted; ?>
	    </footer>
	  <?php endif; ?>

  	<div class="content">
  	  <?php 
  	    // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        print render($content);
       ?>
  	</div> <!-- /content -->
  	
    <?php if (!empty($content['links']['terms'])): ?>
      <div class="terms">
      	<?php print render($content['links']['terms']); ?>
      </div> <!-- /terms -->
    <?php endif;?>
  	
    <?php if (!empty($content['links'])): ?>
	    <div class="links">
	    	<?php print render($content['links']); ?>
	    </div> <!-- /links -->
	  <?php endif; ?>
        
	</div> <!-- /node-inner -->
</article> <!-- /article #node -->

<?php print render($content['comments']); ?>