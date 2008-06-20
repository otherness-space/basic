<?php
// $Id$

//
//	from ZEN // Override or insert PHPTemplate variables into the page templates.
//	
//	 This function creates the body classes that are relative to each page
//	
//	@param $vars
//	  A sequential array of variables to pass to the theme template.
//	@param $hook
//	  The name of the theme function being called ("page" in this case.)
//

function phptemplate_preprocess_page(&$vars, $hook) {
  global $theme;

  // Don't display empty help from node_help().
  if ($vars['help'] == "<div class=\"help\"><p></p>\n</div>") {
    $vars['help'] = '';
  }

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  $body_classes = array($vars['body_classes']);
  if (!$vars['is_front']) {
    // Add unique classes for each page and website section
    $path = drupal_get_path_alias($_GET['q']);
    list($section, ) = explode('/', $path, 2);
    $body_classes[] = phptemplate_id_safe('page-' . $path);
    $body_classes[] = phptemplate_id_safe('section-' . $section);
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
        $body_classes[] = 'section-node-' . arg(2); // Add 'section-node-edit' or 'section-node-delete'
      }
    }
  }
  $vars['body_classes'] = implode(' ', $body_classes); // Concatenate with spaces
}



//
//	from ZEN // Override or insert PHPTemplate variables into the node templates.
//	
//	 This function creates the NODES classes, like 'node-unpublished' for nodes
//	 that are not published, or 'node-mine' for node posted by the connected user...
//	
//	@param $vars
//	  A sequential array of variables to pass to the theme template.
//	@param $hook
//	  The name of the theme function being called ("node" in this case.)
//

function phptemplate_preprocess_node(&$vars, $hook) {
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
  $node_classes[] = 'node-type-' . $vars['node']->type;
  $vars['node_classes'] = implode(' ', $node_classes); // Concatenate with spaces
}


//
// from ZEN // Override or insert PHPTemplate variables into the block templates.
//
//	This function create the EDIT LINKS for blocks and menus blocks.
//	When overing a block (except in IE6), some links appear to edit
//	or configure the block. You can then edit the block, and once you are
//	done, brought back to the first page.
//
// @param $vars
//   A sequential array of variables to pass to the theme template.
// @param $hook
//   The name of the theme function being called ("block" in this case.)
// 

function phptemplate_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];

  if (user_access('administer blocks')) {
    // Display 'edit block' for custom blocks
    if ($block->module == 'block') {
      $edit_links[] = l( t('edit block'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('edit the content of this block'), 'class' => 'block-edit'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    // Display 'configure' for other blocks
    else {
      $edit_links[] = l(t('configure'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, array('title' => t('configure this block'), 'class' => 'block-config'), drupal_get_destination(), NULL, FALSE, TRUE);
    }

    // Display 'edit menu' for menu blocks
    if (($block->module == 'menu' || ($block->module == 'user' && $block->delta == 1)) && user_access('administer menu')) {
      $edit_links[] = l(t('edit menu'), 'admin/build/menu', array('title' => t('edit the menu that defines this block'), 'class' => 'block-edit-menu'), drupal_get_destination(), NULL, FALSE, TRUE);
    }
    $vars['edit_links_array'] = $edit_links;
    $vars['edit_links'] = '<div class="edit">'. implode(' ', $edit_links) .'</div>';
  }
}


//
//  Create some custom classes for comments
//

function comment_classes($comment) {
	$node = node_load($comment->nid);   global $user;
 
 $output .= ($comment->new) ? ' comment-new' : ''; 
 $output .=  ' '. $status . ' '; 
 if ($node->name == $comment->name){	
 	$output .= 'node-author';
 }
 if ($user->name == $comment->name){	
 	$output .=  ' '. 'mine';
 }
  return $output;
}


// 	$Id$
// 	
// 	Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
// 	Generate the HTML representing a given menu item ID.
// 	An implementation of theme_menu_item_link()
// 	
// 	@param $link
// 	  array The menu item to render.
// 	@return
// 	  string The rendered menu item.
// 	

function phptemplate_menu_item_link($link) {
  if (empty($link['options'])) {
    $link['options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">' . check_plain($link['title']) . '</span>';
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
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= "<ul class=\"tabs primary clear-block\">\n". $primary ."</ul>\n";
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= "<ul class=\"tabs secondary clear-block\">\n". $secondary ."</ul>\n";
  }

  return $output;
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


function phptemplate_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id' . $string;
  }
  return $string;
}

// 
// from STEVE KRUEGER truncate text characters
//
//	You can use this function in the node templates to maximize the number of words
//	of an item. For example, if you wish to have a teaser of the body, limited to
//	15 words, use this : 
//
//	print truncate($node->body,15)
//
//	This function also remove all markup, like <a> or <strong> to preserve the integrity
//	of the markup


function truncate($phrase, $max_words) {
	$phrase = strip_tags($phrase);
   $phrase_array = explode(' ',$phrase);
   if(count($phrase_array) > $max_words && $max_words > 0)
      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...'; 
   return $phrase;
}

//
//  Return a themed breadcrumb trail.
//	Alow you to customize the breadcrumb markup
//

function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' » ', $breadcrumb) .'</div>';
  }
}