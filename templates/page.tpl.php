<div id="skip"><a href="#content">Skip to Content</a> <a href="#navigation">Skip to Navigation</a></div>  
<div id="page">

<!-- ______________________ HEADER _______________________ -->

<div id="header">
			
  	<div id="logo-title">

      <?php if ($logo): ?>
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
  		  		
  		<?php if ($page['header']): ?>
  		  <div id="header-region">
  		    <?php print render($page['header']); ?>
  		  </div>
  		<?php endif; ?>
  		
      <?php print $search_box; ?>

  	</div> <!-- /header -->

		<!-- ______________________ MAIN _______________________ -->
	
  	<div id="main" class="clearfix">
	
  			<div id="content">
					<div id="content-inner" class="inner column center">
            
	        	<?php if ($breadcrumb || $title|| $messages || $tabs): ?>
	        	  <div id="content-header">
		
	        	    <?php print $breadcrumb; ?>

                <?php if ($page['highlight']): ?>
                  <div id="highlight"><?php print render($page['highlight']) ?></div>
                <?php endif; ?>

	        	    <?php if ($title): ?>
	        	      <h1 class="title"><?php print $title; ?></h1>
	        	    <?php endif; ?>
										
	        	    <?php print $messages; ?>
	        	    
	        	    <?php print render($page['help']); ?> 
	
	        	    <?php if ($tabs): ?>
	        	      <div class="tabs"><?php print $tabs; ?></div>
	        	    <?php endif; ?>
			
	        	  </div> <!-- /#content-header -->
	        	<?php endif; ?>
	        	            	
	        	<div id="content-area"><?php print render($page['content']) ?></div>
	
	  		  	<?php print $feed_icons; ?>

	  			</div>
				</div> <!-- /content-inner /content -->

        <?php if ($main_menu || $secondary_menu): ?>
          <div id="site-menu" class="menu <?php if (!empty($main_menu)) { print "withprimary"; } if (!empty($secondary_menu)) { print " withsecondary"; } ?>">
            <?php if ($main_menu): print $main_menu; endif; ?>
            <?php if ($secondary_menu): print $secondary_menu; endif; ?>
          </div>
        <?php endif; ?>

	  		<?php if ($page['sidebar_first']): ?>
	  		  <div id="sidebar-first" class="column sidebar first">
						<div id="sidebar-first-inner" class="inner">
						  <?php print render($page['sidebar_first']); ?>
						</div>
	  		  </div>
	  		<?php endif; ?> <!-- /sidebar-first -->
    		
	  		<?php if ($page['sidebar_second']): ?>
	  		  <div id="sidebar-second" class="column sidebar second">
						<div id="sidebar-second-inner" class="inner">
						  <?php print render($page['sidebar_second']); ?>
						</div>
	  		  </div>
	  		<?php endif; ?> <!-- /sidebar-second -->
  
	</div> <!-- /main -->
	
	<!-- ______________________ FOOTER _______________________ -->

  <?php if ($page['footer']): ?>
	  <div id="footer">
      <?php print render($page['footer']); ?>
	  </div> <!-- /footer -->
	<?php endif; ?>
	
</div> <!-- /page -->

<?php print render($page['page_bottom']); ?>