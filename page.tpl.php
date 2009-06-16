<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"
  <?php print $rdf_namespaces ?>>
  <head profile="<?php print $grddl_profile ?>">
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

<body class="<?php echo $classes; ?>">
  <div id="skip-nav"><a href="#content">Skip to Content</a></div>  
  <div id="page">
	
	<!-- ______________________ HEADER _______________________ -->
  
	<div id="header">
		
		<?php if($search_box): ?>
			<?php echo $search_box; ?>
		<?php endif; ?>
		
	  	<div id="logo-title">
	
        <?php if (!empty($logo)): ?>
          <a href="<?php echo $front_page; ?>" title="<?php echo t('Home'); ?>" rel="home" id="logo">
            <img src="<?php echo $logo; ?>" alt="<?php echo t('Home'); ?>" />
          </a>
        <?php endif; ?>
	  	
        <div id="name-and-slogan">
          <?php if (!empty($site_name)): ?>
            <h1 id="site-name">
              <a href="<?php echo $front_page ?>" title="<?php echo t('Home'); ?>" rel="home"><span><?php echo $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

          <?php if (!empty($site_slogan)): ?>
            <div id="site-slogan"><?php echo $site_slogan; ?></div>
          <?php endif; ?>
        </div> <!-- /name-and-slogan -->
	  	
	  	</div> <!-- /logo-title -->
	  		  		
	  		<?php if ($header): ?>
	  		  <div id="header-region">
	  		    <?php echo $header; ?>
	  		  </div>
	  		<?php endif; ?>
	
    	</div> <!-- /header -->

			<!-- ______________________ MAIN _______________________ -->
  	
    	<div id="main" class="clearfix">
		
	  			<div id="content">
						<div id="content-inner" class="inner column center">
              
		        	<?php if ($breadcrumb || $title|| $messages || $help || $tabs): ?>
		        	  <div id="content-header">
			
		        	    <?php echo $breadcrumb; ?>
		
		        	    <?php if ($title): ?>
		        	      <h1 class="title"><?php echo $title; ?></h1>
		        	    <?php endif; ?>
											
		        	    <?php echo $messages; ?>
		        	    
		        	    <?php echo $help; ?> 
		
		        	    <?php if ($tabs): ?>
		        	      <div class="tabs"><?php echo $tabs; ?></div>
		        	    <?php endif; ?>
				
		        	  </div> <!-- /#content-header -->
		        	<?php endif; ?>
            	
		        	<div id="content-area"> <!-- CONTENT AREA -->
                <?php print $content ?>
		        	</div>
		
  	  		  	<?php echo $feed_icons; ?>
	
  	  			</div>
					</div> <!-- /content-inner /content -->

		      <div id="navigation" class="menu <?php if (!empty($primary_links)) { echo "withprimary"; } if (!empty($secondary_links)) { echo " withsecondary"; } ?> ">
			
		        <?php if (!empty($main_menu)): ?>
		          <div id="primary" class="clear-block">
		            <?php print theme('links', $main_menu, array('class' => 'links primary-links', 'id' => 'navlist')) ?>
		          </div>
		        <?php endif; ?>

		        <?php if (!empty($secondary_menu)): ?>
		          <div id="secondary" class="clear-block">
		            <?php print theme('links', $secondary_menu, array('class' => 'links secondary-links', 'id' => 'subnavlist')); ?>
		          </div>
		        <?php endif; ?>

		      </div> <!-- /navigation -->

  	  		<?php if ($left): ?> <!-- SIDEBAR LEFT -->
  	  		  <div id="sidebar-left" class="column sidebar left">
							<div id="sidebar-left-inner" class="inner">
							  <?php echo $left; ?>
							</div>
  	  		  </div>
  	  		<?php endif; ?> <!-- /sidebar-left -->
      		
  	  		<?php if ($right): ?> <!-- SIDEBAR RIGHT -->
  	  		  <div id="sidebar-right" class="column sidebar right">
							<div id="sidebar-right-inner" class="inner">
								<?php echo $right; ?>
							</div>
  	  		  </div>
  	  		<?php endif; ?> <!-- /sidebar-right -->
	  
  	</div> <!-- /main -->
  	
		<!-- ______________________ FOOTER _______________________ -->

    <?php if(!empty($footer)): ?>
  	  <div id="footer">
	      <?php echo $footer; ?>
  	  </div> <!-- /footer -->
		<?php endif; ?>
		
  	<?php echo $closure; ?>
  </div> <!-- /page -->

</body>
</html>