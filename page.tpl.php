<?php
// $Id$

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?= $head_title; ?></title>
  <?= $head; ?>
  <?= $styles; ?>
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
  <?= $scripts; ?>
</head>

<body class="<?= $body_classes; ?>">
  <div id="skip-nav"><a href="#content">Skip to Content</a></div>  
  <div id="page">
	
	<!-- ______________________ HEADER _______________________ -->
  
	<div id="header">
	  	<div id="logo-title">
	
        <?php if (!empty($logo)): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        <?php endif; ?>
	  	
        <div id="name-and-slogan">
          <?php if (!empty($site_name)): ?>
            <h1 id="site-name">
              <a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
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
	  		    <?= $header; ?>
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
										<div id="mission"><?php print $mission; ?></div>
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
  	  		  	<?= $feed_icons; ?>
  	  		  	<?php if ($content_bottom): ?><div id="content-bottom"><?= $content_bottom; ?></div><?php endif; ?>
	
  	  			</div>
					</div> <!-- /content-inner /content -->


  	  		<?php if ($left): ?> <!-- SIDEBAR LEFT -->
  	  		  <div id="sidebar-left" class="column sidebar">
							<div id="sidebar-left-inner">
	    			  <?php if ($left): ?>
  	  		    	<div class="left" id="top-left"><?= $left; ?></div>
	    			  <?php endif; ?>
							</div>
  	  		  </div> <!-- /sidebar-left -->
  	  		<?php endif; ?>
      		
  	  		
  	  		<?php if ($right): ?> <!-- SIDEBAR RIGHT -->
  	  		  <div id="sidebar-right" class="column sidebar">
							<div id="sidebar-right-inner">
	    			  <?php if ($right): ?>
  	  		    	<div class="right" id="top-right"><?= $right; ?></div>
	    			  <?php endif; ?>
							</div>
  	  		  </div> <!-- /sidebar-right -->
  	  		<?php endif; ?>
	  
	  	</div> <!-- /main-inner -->
  	</div> <!-- /main -->
  	
		<!-- ______________________ FOOTER _______________________ -->

  	<div id="footer">
	    <?= $footer_message; ?>
	    <?= $footer; ?>
  	</div> <!-- /footer -->
  	<?= $closure; ?>
  </div> <!-- /page -->

</body>
</html>