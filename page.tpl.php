<?php
// $Id$
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $language ?>" xml:lang="<?php echo $language ?>">

<head>
  <title><?php echo $head_title; ?></title>
  <?php echo $head; ?>
  <?php echo $styles; ?>
  <!--[if lte IE 6]>
  <style type="text/css" media="all">
    @import "<?php echo $base_path . path_to_theme() ?>/css/ie6.css";
  </style>
  <![endif]-->
  <!--[if IE 7]>
  <style type="text/css" media="all">
    @import "<?php echo $base_path . path_to_theme() ?>/css/ie7.css";
  </style>
  <![endif]-->
  <?php echo $scripts; ?>
</head>

<?php /* different ids allow for separate theming of the home page */ ?>
<body class="<?php echo $body_classes; ?>">
  <div id="skip-nav"><a href="#content">Skip to Content</a></div>  
  <div id="page">
	
		<!-- ______________________ HEADER _______________________ -->
		
		<div id="header">
		  	<div id="logo-title">
				  <!-- Uncomment to activate search box <?php echo $search_box; ?> -->
		  	  <?php if ($logo): ?>
		  	    <a href="<?php echo $base_path; ?>" title="<?php echo t('Home'); ?>">
		  	      <img src="<?php echo $logo; ?>" alt="<?php echo t('Home'); ?>" id="logo" />
		  	    </a>
		  	  <?php endif; ?>

	        <div id="name-and-slogan">
	          <?php if (!empty($site_name)): ?>
	            <h1 id="site-name">
	              <a href="<?php echo $base_path; ?>" title="<?php echo t('Home'); ?>"><span><?php print $site_name; ?></span></a>
	            </h1>
	          <?php endif; ?>

	          <?php if (!empty($site_slogan)): ?>
	            <div id="site-slogan"><?php print $site_slogan; ?></div>
	          <?php endif; ?>
	        </div> <!-- /name-and-slogan -->

		  	</div> <!-- /logo-title -->
	  	
	  	
	      <div id="navigation" class="menu <?php if (!empty($primary_links)) { print "withprimary"; } if (!empty($secondary_links)) { print " withsecondary"; } ?> ">
	        <?php if (!empty($primary_links)): ?>
	          <div id="primary" class="clear-block">
	            <?php print theme('links', $primary_links, array('class' => 'links primary-links')); ?>
	          </div>
	        <?php endif; ?>

	        <?php if (!empty($secondary_links)): ?>
	          <div id="secondary" class="clear-block">
	            <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')); ?>
	          </div>
	        <?php endif; ?>
	      </div> <!-- /navigation -->

		  		<?php if ($header): ?>
		  		  <div id="header-region">
		  		    <?php echo $header; ?>
		  		  </div>
		  		<?php endif; ?>
	    	</div> <!-- /header -->

				
					<!-- ______________________ MAIN _______________________ -->

		    	<div id="main" class="clearfix">
			    	<div id="main-inner">

		  	  		<div id="content" class="column">
								<div id="content-inner">

				        	<?php if ($breadcrumb or $title or $tabs or $help or $messages or $mission): ?>
				        	  <div id="content-header">
				        	    <?php print $breadcrumb; ?>
				        	    <?php if ($title): ?>
				        	      <h1 class="title"><?php print $title; ?></h1>
				        	    <?php endif; ?>
					  	  		  <?php if ($mission): ?>
												<div id="mission"><?php echo $mission; ?></div>
											<?php endif; ?>
				        	    <?php print $messages; ?>
				        	    <?php if ($tabs): ?>
				        	      <div class="tabs"><?php print $tabs; ?></div>
				        	    <?php endif; ?>
				        	    <?php print $help; ?>
				        	  </div> <!-- /#content-header -->
				        	<?php endif; ?>

				        	<div id="content-area"> <!-- CONTENT AREA -->
				        	  <?php print $content; ?>
				        	</div>
		  	  		  	<?php echo $feed_icons; ?>
		  	  		  	<?php if ($content_bottom): ?><div id="content-bottom"><?php echo $content_bottom; ?></div><?php endif; ?>

		  	  			</div>
							</div> <!-- /content-inner /content -->


		  	  		<?php if ($sidebar_left): ?> <!-- SIDEBAR LEFT -->
		  	  		  <div id="sidebar-left" class="column sidebar">
									<div id="sidebar-left-inner">
			    			  <?php if ($sidebar_left): ?>
		  	  		    	<div class="left" id="top-left"><?php echo $sidebar_left; ?></div>
			    			  <?php endif; ?>
									</div>
		  	  		  </div> <!-- /sidebar-left -->
		  	  		<?php endif; ?>


		  	  		<?php if ($sidebar_right): ?> <!-- SIDEBAR RIGHT -->
		  	  		  <div id="sidebar-right" class="column sidebar">
									<div id="sidebar-right-inner">
			    			  <?php if ($sidebar_right): ?>
		  	  		    	<div class="right" id="top-right"><?php echo $sidebar_right; ?></div>
			    			  <?php endif; ?>
									</div>
		  	  		  </div> <!-- /sidebar-right -->
		  	  		<?php endif; ?>

			  	</div> <!-- /main-inner -->
		  	</div> <!-- /main -->

				<!-- ______________________ FOOTER _______________________ -->
				

  	<div id="footer">
	    <?php echo $footer_message; ?>
	    <?php echo $footer_block; ?>
  	</div> <!-- /footer -->
  	<?php echo $closure; ?>
  </div> <!-- /page -->

</body>
</html>