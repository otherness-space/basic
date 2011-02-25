<?php

/**
 *
 * ABOUT
 *
 * The template.php file is one of the most useful files when creating or
 * modifying Drupal themes. You can add new regions for block content, modify or
 * override Drupal's theme functions, intercept or make additional variables
 * available to your theme, and create custom PHP logic. For more information,
 * please visit the Theme Developer's Guide on Drupal.org:
 * http://drupal.org/theme-guide
 *
 * More Themeable functions: http://api.drupal.org/api/group/themeable
 */

// Adding the CSS files to the page template //


$vars['css'] = drupal_add_css( path_to_theme() .'/css/default.css', 'theme', 'all');
$vars['css'] = drupal_add_css( path_to_theme() .'/css/tabs.css', 'theme', 'all');
$vars['css'] = drupal_add_css( path_to_theme() .'/css/layout.css', 'theme', 'all');
$vars['css'] = drupal_add_css( path_to_theme() .'/css/style.css', 'theme', 'all');

// Add a print style sheet
$vars['css'] = drupal_add_css( path_to_theme() .'/css/print.css', 'theme', 'print');
$vars['styles'] = drupal_get_css();


/**
 * Declare the available regions implemented by this theme.
 * Replace basic_regions by 'name of your theme'_regions
 *
 * @return
 *   An array of regions.
 */
function basic_regions() {
  return array(
    'sidebar_left' => t('left sidebar'),
    'sidebar_right' => t('right sidebar'),
    'content_top' => t('content top'),
    'content_bottom' => t('content bottom'),
    'header' => t('header'),
    'footer_block' => t('footer'),  
  );
}
// */


/**
 * Intercept template variables
 *
 * @param $hook
 *   The name of the theme function being executed
 * @param $vars
 *   A sequential array of variables passed to the theme function.
 */

function _phptemplate_variables($hook, $vars = array()) {
	
  switch ($hook) {
    // Send a new variable, $logged_in, to page.tpl.php to tell us if the current user is logged in or out.
   case 'page':
     // get the currently logged in user
     global $user;

     // An anonymous user has a user id of zero.
     if ($user->uid > 0) {
       // The user is logged in.
       $vars['logged_in'] = TRUE;
     }
     else {
       // The user has logged out.
       $vars['logged_in'] = FALSE;
     }

     // Classes for body element. Allows advanced theming based on context
     // (home page, node of certain type, etc.)
     $body_classes = array();
     $body_classes[] = ($vars['is_front']) ? 'front' : 'not-front';
     $body_classes[] = ($vars['logged_in']) ? 'logged-in' : 'not-logged-in';
     if ($vars['node']->type) {
       // If on an individual node page, put the node type in the body classes
       $body_classes[] = 'node-type-'. $vars['node']->type;
     }
     if ($vars['sidebar_left'] && $vars['sidebar_right']) {
       $body_classes[] = 'two-sidebars';
     }
     elseif ($vars['sidebar_left']) {
       $body_classes[] = 'one-sidebar sidebar-left';
     }
     elseif ($vars['sidebar_right']) {
       $body_classes[] = 'one-sidebar sidebar-right';
     }
     else {
       $body_classes[] = 'no-sidebars';
     }
     if (!$vars['is_front']) {
       // Add unique classes for each page and website section
       $path = drupal_get_path_alias($_GET['q']);
       list($section,) = explode('/', $path, 2);
       $body_classes[] = phptemplate_id_safe('page-'. $path);
       $body_classes[] = phptemplate_id_safe('section-'. $section);
       if (arg(0) == 'node') {
         if (arg(1) == 'add') {
           if ($section == 'node') {
             array_pop($body_classes); // Remove 'section-node'
           }
           $body_classes[] = 'section-node-add'; // Add 'section-node-add'
         }
         elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
           if ($section == 'node') {
             array_pop($body_classes); // Remove 'section-node'
           }
           $body_classes[] = 'section-node-'. arg(2); // Add 'section-node-edit' or 'section-node-delete'
         }
       }
     }
     // Check what the user's browser is and add it as a body class    
     $user_agent = $_SERVER['HTTP_USER_AGENT'];
     if($user_agent) {
       if (strpos($user_agent, 'MSIE')) {
         $body_classes[] = 'browser-ie';
       } else if (strpos($user_agent, 'MSIE 6.0')) {
         $body_classes[] = 'browser-ie6';
       } else if (strpos($user_agent, 'MSIE 7.0')) {
         $body_classes[] = 'browser-ie7';
       } else if (strpos($user_agent, 'MSIE 8.0')) {
         $body_classes[] = 'browser-ie8'; 
       } else if (strpos($user_agent, 'Firefox/2')) {
         $body_classes[] = 'browser-firefox2';
       } else if (strpos($user_agent, 'Firefox/3')) {
         $body_classes[] = 'browser-firefox3';
       }else if (strpos($user_agent, 'Safari')) {
         $body_classes[] = 'browser-safari';
       } else if (strpos($user_agent, 'Opera')) {
         $body_classes[] = 'browser-opera';
       }
     }
     $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces

     break;

    case 'node':
      // get the currently logged in user
      global $user;

		  // Special classes for nodes
		  $node_classes = array();
		  if ($vars['sticky']) {
		    $node_classes[] = 'sticky';
		  }
		  if (!$vars['node']->status) {
		    $node_classes[] = 'node-unpublished';
		    $vars['unpublished'] = TRUE;
		  }
		  else {
		    $vars['unpublished'] = FALSE;
		  }
		  if ($vars['node']->uid && $vars['node']->uid == $user->uid) {
		    // Node is authored by current user
		    $node_classes[] = 'node-mine';
		  }
		  if ($vars['teaser']) {
		    // Node is displayed as teaser
		    $node_classes[] = 'node-teaser';
		  }
		  // Class for node type: "node-type-page", "node-type-story", "node-type-my-custom-type", etc.
		  $node_classes[] = 'node-type-'. $vars['node']->type;
		  $vars['node_classes'] = implode(' ', $node_classes); // Concatenate with spaces

      break;

			case 'block':
		  $block = $vars['block'];

		  // Special classes for blocks
		  $block_classes = array();
		  $block_classes[] = 'block-'. $block->module;
		  $block_classes[] = 'region-'. $vars['block_zebra'];
		  $block_classes[] = $vars['zebra'];
		  $block_classes[] = 'region-count-'. $vars['block_id'];
		  $block_classes[] = 'count-'. $vars['id'];
		  $vars['block_classes'] = implode(' ', $block_classes);

		  $vars['edit_links'] = '';
		  if (user_access('administer blocks')) {
		    // Display 'edit block' for custom blocks
		    if ($block->module == 'block') {
		      $edit_links[] = l('<span>'. t('edit block') .'</span>', 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('edit the content of this block'), 'class' => 'block-edit'), drupal_get_destination(), NULL, FALSE, TRUE);
		    }
		    // Display 'configure' for other blocks
		    else {
		      $edit_links[] = l('<span>'. t('configure') .'</span>', 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('configure this block'), 'class' => 'block-config'), drupal_get_destination(), NULL, FALSE, TRUE);
		    }

		    // Display 'administer views' for views blocks
		    if ($block->module == 'views' && user_access('administer views')) {
		      $edit_links[] = l('<span>'. t('edit view') .'</span>', 'admin/build/views/'. $block->delta .'/edit', array('title' => t('edit the view that defines this block'), 'class' => 'block-edit-view'), drupal_get_destination(), 'edit-block', FALSE, TRUE);
		    }
		    // Display 'edit menu' for menu blocks
		    elseif (($block->module == 'menu' || ($block->module == 'user' && $block->delta == 1)) && user_access('administer menu')) {
		      $edit_links[] = l('<span>'. t('edit menu') .'</span>', 'admin/build/menu', array('title' => t('edit the menu that defines this block'), 'class' => 'block-edit-menu'), drupal_get_destination(), NULL, FALSE, TRUE);
		    }
		    $vars['edit_links_array'] = $edit_links;
		    $vars['edit_links'] = '<div class="edit">'. implode(' ', $edit_links) .'</div>';
		  }

	      break;

    case 'comment':

	  global $user;

	  // We load the node object that the current comment is attached to
	  $node = node_load($vars['comment']->nid);
	  // If the author of this comment is equal to the author of the node, we
	  // set a variable so we can theme this comment uniquely.
	  $vars['author_comment'] = $vars['comment']->uid == $node->uid ? TRUE : FALSE;

	  $comment_classes = array();

	  // Odd/even handling
	  static $comment_odd = TRUE;
	  $comment_classes[] = $comment_odd ? 'odd' : 'even';
	  $comment_odd = !$comment_odd;

	  if ($vars['comment']->status == COMMENT_NOT_PUBLISHED) {
	    $comment_classes[] = 'comment-unpublished';
	    $vars['unpublished'] = TRUE;
	  }
	  else {
	    $vars['unpublished'] = FALSE;
	  }
	  if ($vars['author_comment']) {
	    // Comment is by the node author
	    $comment_classes[] = 'comment-by-author';
	  }
	  if ($vars['comment']->uid == 0) {
	    // Comment is by an anonymous user
	    $comment_classes[] = 'comment-by-anon';
	  }
	  if ($user->uid && $vars['comment']->uid == $user->uid) {
	    // Comment was posted by current user
	    $comment_classes[] = 'comment-mine';
	  }
	  $vars['comment_classes'] = implode(' ', $comment_classes);

	  // If comment subjects are disabled, don't display 'em
	  if (variable_get('comment_subject_field', 1) == 0) {
	    $vars['title'] = '';
	  }

      break;
  }

  return $vars;
}

/**
 * Converts a string to a suitable html ID attribute.
 * - Preceeds initial numeric with 'n' character.
 * - Replaces space and underscore with dash.
 * - Converts entire string to lowercase.
 * - Works for classes too!
 *
 * @param string $string
 *  the string
 * @return
 *  the converted string
 */
function phptemplate_id_safe($string) {
  if (is_numeric($string{0})) {
    // if the first character is numeric, add 'n' in front
    $string = 'n'. $string;
  }
  return strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $string));
}

/**
 *	Adding span to tabs for theming purposes (ZEN tabs)
 */
function phptemplate_menu_item_link($item, $link_item) {
  // If an item is a LOCAL TASK, render it as a tab
  $tab = ($item['type'] & MENU_IS_LOCAL_TASK) ? TRUE : FALSE;
  return l(
    $tab ? '<span class="tab">'. check_plain($item['title']) .'</span>' : $item['title'],
    $link_item['path'],
    !empty($item['description']) ? array('title' => $item['description']) : array(),
    !empty($item['query']) ? $item['query'] : NULL,
    !empty($link_item['fragment']) ? $link_item['fragment'] : NULL,
    FALSE,
    $tab
  );
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">'. $primary .'</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">'. $secondary .'</ul>';
  }

  return $output;
}

/**
 * Implementation of theme_menu_item().
 * Add active class and custom id to current menu item links.
 */
function phptemplate_menu_item($mid, $children = '', $leaf = TRUE) {
  $item = menu_get_item($mid); // get current menu item
  // decide whether to add the active class to this menu item
  if ((drupal_get_normal_path($item['path']) == $_GET['q']) // if menu item path...
  || (drupal_is_front_page() && $item['path'] == '<front>')) { // or front page...
    $active_class = ' active'; // set active class
  } else { // otherwise...
    $active_class = ''; // do nothing
  }
  $attribs = isset($item['description']) ?
array('title' => $item['description']) : array();
  $replace = array(' ', '&');
  $attribs['id'] = 'menu-'. str_replace($replace, '-', strtolower($item['title']));
  return
'
<li class="'. ($leaf ? 'leaf' : ($children ? 'expanded' : 'collapsed')) .
$active_class .'" id="'. $attribs['id'] . '">' .
menu_item_link($mid) . $children ."</li>
\n";
}


/**
 *  Return a themed breadcrumb trail.
 *  Allow you to customize the breadcrumb markup
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' » ', $breadcrumb) .'</div>';
  }
}

/**
 * Format a query pager.
 * Menu callbacks that display paged query results should call theme('pager') to retrieve a pager control so that users can view other results.
 */
function phptemplate_pager($tags = array(), $limit = 10, $element = 0, $parameters = array()) {
  global $pager_total;
  $output = '';

  if ($pager_total[$element] > 1) {
    $output .= '<div class="pager">';
    $output .= theme('pager_first', ($tags[0] ? $tags[0] : t('« first')), $limit, $element, $parameters);
    $output .= theme('pager_previous', ($tags[1] ? $tags[1] : t('‹ previous')), $limit, $element, 1, $parameters);
    $output .= theme('pager_list', $limit, $element, ($tags[2] ? $tags[2] : 9 ), '', $parameters);
    $output .= theme('pager_next', ($tags[3] ? $tags[3] : t('next ›')), $limit, $element, 1, $parameters);
    $output .= theme('pager_last', ($tags[4] ? $tags[4] : t('last »')), $limit, $element, $parameters);
    $output .= '</div>';

    return $output;
  }
}

/**
 * Return code that emits an feed icon.
 */
function phptemplate_feed_icon($url) {
  if ($image = theme('image', 'misc/feed.png', t('Syndicate content'), t('Syndicate content'))) {
    return '<a href="'. check_url($url) .'" class="feed-icon">'. $image. '</a>';
  }
}

/**
 * Allow wrapping of all comments.
 */
function phptemplate_comment_wrapper($content, $type = null) {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
}