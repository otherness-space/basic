<?php 
    
// 	
// 	Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
// 	An implementation of theme_menu_item_link()
// 	
// 	@param $link
// 	  array The menu item to render.
// 	@return
// 	  string The rendered menu item.
// 	

function basic_menu_item_link($link) {
  if (empty($link['options'])) {
    $link['options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">'. check_plain($link['title']) .'</span>';
    $link['options']['html'] = TRUE;
  }

  if (empty($link['type'])) {
    $true = TRUE;
  }

  return l($link['title'], $link['href'], $link['options']);
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
function basic_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= "<ul class=\"tabs primary clearfix\">\n". $primary ."</ul>\n";
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= "<ul class=\"tabs secondary clearfix\">\n". $secondary ."</ul>\n";
  }

  return $output;
}

//	
//	Add custom classes to menu item
//	
	
function basic_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
#New line added to get unique classes for each menu item
  $css_class = basic_id_safe(str_replace(' ', '_', strip_tags($link)));
  return '<li class="'. $class . ' ' . $css_class . '">' . $link . $menu ."</li>\n";
}


//	
//	Converts a string to a suitable html ID attribute.
//	
//	 http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
//	 valid ID attribute in HTML. This function:
//	
//	- Ensure an ID starts with an alpha character by optionally adding an 'n'.
//	- Replaces any character except A-Z, numbers, and underscores with dashes.
//	- Converts entire string to lowercase.
//	
//	@param $string
//	  The string
//	@return
//	  The converted string
//	


function basic_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}


//
//  Return a themed breadcrumb trail.
//	Alow you to customize the breadcrumb markup
//

function basic_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' » ', $breadcrumb) .'</div>';
  }
}