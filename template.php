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
  // Add a striping class.
  $vars['classes_array'][] = 'block-' . $vars['zebra'];

  // Display 'edit block' for all blocks except main content
  if (theme_get_setting('block_editing') && user_access('administer blocks')) {
    $block = $vars['block'];
    if ($block->module != 'system') {
      $vars['content'] .= l(t('edit block'), 'admin/structure/block/configure/' . $block->module . '/' . $block->delta, 
      array(
        'attributes'=>array(
          'class'=>array('edit'), 
          'title'=>'edit '. $block->subject.' block'
          ), 
          'query'=>drupal_get_destination(),
        )
      );
    } else {
      if ($block->delta != 'main') {
        $vars['content'] .= l(t('configure block'), 'admin/structure/block/configure/system/' . $block->delta, 
        array(
          'attributes'=>array(
            'class'=>array('edit'), 
            'title'=>'edit '. $block->subject.' block'
            ),
            'query'=>drupal_get_destination(),
          )
        );
      }
    }  
  }
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


/**
 * Generate the HTML output for a menu link and submenu.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: Structured array data for a menu link.
 *
 * @return
 *   A themed HTML string.
 *
 * @ingroup themeable
 */
function basic_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  // Adding a class depending on the TITLE of the link (not constant)
  $element['#attributes']['class'][] = basic_id_safe($element['#title']);
  // Adding a class depending on the ID of the link (constant)
  $element['#attributes']['class'][] = 'mid-' . $element['#original_link']['mlid'];
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


/* 	
 * 	Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
 */ 	

function basic_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link['localized_options']['html'] = TRUE;
  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l('<span class="tab">' . $link['title'] . '</span>', $link['href'], $link['localized_options']) . "</li>\n";
}


/*
 *  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */

function basic_menu_local_tasks() {
  $output = array();
  if ($primary = menu_primary_local_tasks()) {
    if(menu_secondary_local_tasks()) {
      $primary['#prefix'] = '<ul class="tabs primary with-secondary clearfix">';
    }
    else {
      $primary['#prefix'] = '<ul class="tabs primary clearfix">';
    }
    $primary['#suffix'] = '</ul>';
    $output[] = $primary;
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $secondary['#prefix'] = '<ul class="tabs secondary clearfix">';
    $secondary['#suffix'] = '</ul>';
    $output[] = $secondary;
  }
  return $output;
}


/*
 *  Return a themed breadcrumb trail.
 *	Alow you to customize the breadcrumb markup
 */

function basic_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<strong class="element-invisible">' . t('You are here') . ':</strong>';
    $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
    return $output;
  }
}