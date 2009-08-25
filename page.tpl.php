<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>"
  <?php print $rdf_namespaces ?>>
  
  <head profile="<?php print $grddl_profile ?>">
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <?php print $styles; ?>
    <!--[if lte IE 6]><style type="text/css" media="all">@import "<?php print $base_path . path_to_theme() ?>/css/ie6.css";</style><![endif]-->
    <!--[if IE 7]><style type="text/css" media="all">@import "<?php print $base_path . path_to_theme() ?>/css/ie7.css";</style><![endif]-->
    <?php print $scripts; ?>
  </head>

  <body class="<?php print $classes; ?>"><?php print $page_top; ?>
  
    <div id="skip-nav"><a href="#content">Skip to Content</a></div>  
    <div id="page">
  	
  	<!-- ______________________ HEADER _______________________ -->
    
  	<div id="header">
  				
  	  	<div id="logo-title">
  	
          <?php if (!empty($logo)): ?>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
            </a>
          <?php endif; ?>
  	  	
          <div id="name-and-slogan">
            <?php if (!empty($site_name)): ?>
              <h1 id="site-name">
                <a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a>
              </h1>
            <?php endif; ?>
  
            <?php if (!empty($site_slogan)): ?>
              <div id="site-slogan"><?php print $site_slogan; ?></div>
            <?php endif; ?>
          </div> <!-- /name-and-slogan -->
  	  	
  	  	</div> <!-- /logo-title -->
  	  		  		
  	  		<?php if ($header): ?>
  	  		  <div id="header-region">
  	  		    <?php print $header; ?>
  	  		  </div>
  	  		<?php endif; ?>
  	  		
          <?php print $search_box; ?>
  	
      	</div> <!-- /header -->
  
  			<!-- ______________________ MAIN _______________________ -->
    	
      	<div id="main" class="clearfix">
  		
  	  			<div id="content">
  						<div id="content-inner" class="inner column center">
                
  		        	<?php if ($breadcrumb || $title|| $messages || $help || $tabs): ?>
  		        	  <div id="content-header">
  			
  		        	    <?php print $breadcrumb; ?>
  		
  		        	    <?php if ($title): ?>
  		        	      <h1 class="title"><?php print $title; ?></h1>
  		        	    <?php endif; ?>
  											
  		        	    <?php print $messages; ?>
  		        	    
  		        	    <?php print $help; ?> 
  		
  		        	    <?php if ($tabs): ?>
  		        	      <div class="tabs"><?php print $tabs; ?></div>
  		        	    <?php endif; ?>
  				
  		        	  </div> <!-- /#content-header -->
  		        	<?php endif; ?>
  		        	            	
  		        	<div id="content-area"> <!-- CONTENT AREA -->
                  <?php print $content ?>
  		        	</div>
  		
    	  		  	<?php print $feed_icons; ?>
  	
    	  			</div>
  					</div> <!-- /content-inner /content -->
  
            <?php if ($main_menu || $sub_menu): ?>
              <div id="site-menu" class="menu <?php if (!empty($main_menu)) { print "withprimary"; } if (!empty($sub_menu)) { print " withsecondary"; } ?>">
                <?php if ($main_menu): print $main_menu; endif; ?>
                <?php if ($sub_menu): print $sub_menu; endif; ?>
              </div>
            <?php endif; ?>
  
    	  		<?php if ($sidebar_first): ?>
    	  		  <div id="sidebar-first" class="column sidebar first">
  							<div id="sidebar-first-inner" class="inner">
  							  <?php print $sidebar_first; ?>
  							</div>
    	  		  </div>
    	  		<?php endif; ?> <!-- /sidebar-first -->
        		
    	  		<?php if ($sidebar_second): ?>
    	  		  <div id="sidebar-second" class="column sidebar second">
  							<div id="sidebar-second-inner" class="inner">
  								<?php print $sidebar_second; ?>
  							</div>
    	  		  </div>
    	  		<?php endif; ?> <!-- /sidebar-second -->
  	  
    	</div> <!-- /main -->
    	
  		<!-- ______________________ FOOTER _______________________ -->
  
      <?php if(!empty($footer)): ?>
    	  <div id="footer">
  	      <?php print $footer; ?>
    	  </div> <!-- /footer -->
  		<?php endif; ?>
  		
    </div> <!-- /page -->
  
  	<?php print $page_bottom; ?>
  
  </body>
</html>