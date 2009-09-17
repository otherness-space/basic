<?php

/*
 * Here we override the default HTML output of drupal.
 * refer to http://drupal.org/node/550722
 */
 
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
  drupal_theme_rebuild();
}
// Add Zen Tabs styles
if (theme_get_setting('zen_tabs')) {
  drupal_add_css( drupal_get_path('theme', 'basic') .'/css/tabs.css');
}

function basic_preprocess_page(&$vars, $hook) {

  // Adding a class to #page in wireframe mode
  if (theme_get_setting('wireframe_mode')) {
    $vars['classes_array'][] = 'wireframe-mode';
  }
  // Adding classes wether #navigation is here or not
  if (!empty($vars['main_menu']) or !empty($vars['sub_menu'])) {
    $vars['classes_array'][] = 'with-navigation';
  }
  if (!empty($vars['secondary_menu'])) {
    $vars['classes_array'][] = 'with-subnav';
  }  

  // changing #navigation markup for easier theming of main and submenus
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links', $vars['main_menu'],
      array(
        'class' => array('links', 'main-menu'),
        'id' => array('primary'),
      )
    );
  } else {
    $vars['primary_nav'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links', $vars['secondary_menu'],
      array(
        'class' => array('links', 'sub-menu'),
        'id' => array('secondary'),
      )
    );
  } else {
    $vars['secondary_menu'] = FALSE;
  }
      
}

function basic_preprocess_node(&$vars) {
  // Add a striping class.
  $vars['classes_array'][] = 'node-' . $vars['zebra'];
}

function basic_preprocess_block(&$vars, $hook) {

  $vars['classes_array'][] = 'block-' . $vars['zebra'];

  $block = $vars['block'];
  // Display 'edit block' for custom blocks.
  if ($block->module != 'system') {
    $vars['content'] .= l('<span>' . t('edit block') . '</span>', 'admin/structure/block/configure/block/' . $block->delta, 
    array(
      'attributes'=>array(
        'class'=>'edit', 
        'title'=>'edit '. $block->subject.' block'
        ), 
        'query'=>drupal_get_destination(),
        'html' => TRUE,
      )
    );
  } else {
    if ($block->delta != 'main') {
      $vars['content'] .= l('<span>' . t('configure block') . '</span>', 'admin/structure/block/configure/system/' . $block->delta, 
      array(
        'attributes'=>array(
          'class'=>'edit', 
          'title'=>'edit '. $block->subject.' block'
          ), 
          'query'=>drupal_get_destination(),
          'html' => TRUE,
        )
      );
    }
  }
}


/*   
 *   Add custom classes to menu item
 */  
	
function basic_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
  // New line added to get unique classes for each menu item
  $css_class = basic_id_safe(str_replace(' ', '_', strip_tags($link)));
  return '<li class="'. $class . ' ' . $css_class . '">' . $link . $menu ."</li>\n";
}

/* 	
 * 	Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
 * 	An implementation of theme_menu_item_link()
 * 	
 * 	@param $link
 * 	  array The menu item to render.
 * 	@return
 * 	  string The rendered menu item.
 */ 	

function basic_menu_item_link($link) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">' . check_plain($link['title']) . '</span>';
    $link['localized_options']['html'] = TRUE;
  }

  return l($link['title'], $link['href'], $link['localized_options']);
}

/*
 *  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
 
function basic_menu_local_tasks() {
  $output = '';
  if ($primary = menu_primary_local_tasks()) {
    if(menu_secondary_local_tasks()) {
      $output .= '<ul class="tabs primary with-secondary clearfix">' . $primary . '</ul>';
    }
    else {
      $output .= '<ul class="tabs primary clearfix">' . $primary . '</ul>';
    }
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clearfix">' . $secondary . '</ul>';
  }
  return $output;
}


/* 	
 * 	Converts a string to a suitable html ID attribute.
 * 	
 * 	 http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 * 	 valid ID attribute in HTML. This function:
 * 	
 * 	- Ensure an ID starts with an alpha character by optionally adding an 'n'.
 * 	- Replaces any character except A-Z, numbers, and underscores with dashes.
 * 	- Converts entire string to lowercase.
 * 	
 * 	@param $string
 * 	  The string
 * 	@return
 * 	  The converted string
 */	


function basic_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}


/*
 *  Return a themed breadcrumb trail.
 *	Alow you to customize the breadcrumb markup
 */

function basic_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' » ', $breadcrumb) .'</div>';
  }
}