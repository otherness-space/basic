<?php
// Default style configuration for Basic theme: 
function basic_default_style() {
  $style['text_color']['list'] = "default";
  $style['text_color']['value'] = "#000000"; 
  $style['text_color']['form'] = "textfield";
  $style['text_color']['comment'] = t("Text color");     
  
  $style['background_color']['list'] = "default";
  $style['background_color']['value'] = "#FFFFFF";
  $style['background_color']['form'] = "textfield";
  $style['background_color']['comment'] = t("Background color");

  $style['enable_columns']['list'] = "default"; 
  $style['enable_columns']['value'] = 1;    
  $style['enable_columns']['form'] = "select";
  $style['enable_columns']['presets'] = "0|1";
  $style['enable_columns']['comment'] = t("Enable side block (column) support");
 
  $style['left_column_width']['list'] = "expert";
  $style['left_column_width']['value'] = 140;
  $style['left_column_width']['form'] = "select";
  $style['left_column_width']['presets'] = "0|120|130|140|150|160|170|180|190|200|220|240|260|280|300|320";
  $style['left_column_width']['comment'] = t("Width left side column (requires block support)");
  
  $style['right_column_width']['list'] = "expert";
  $style['right_column_width']['value'] = 0;
  $style['right_column_width']['form'] = "select";
  $style['right_column_width']['presets'] = "0|120|130|140|150|160|170|180|190|200|220|240|260|280|300|320";
  $style['right_column_width']['comment'] = t("Width right side column (requires block support)");

  $style['enable_logo']['list'] = "expert";
  $style['enable_logo']['value'] = 1;
  $style['enable_logo']['form'] = "select";
  $style['enable_logo']['presets'] = "0|1";
  $style['enable_logo']['comment'] = t("Show logo in header");
    
  $style['path_logo']['list'] = "expert";
  $style['path_logo']['value'] = "/themes/basic/images/logo.gif";
  $style['path_logo']['form'] = "textfield";
  $style['path_logo']['comment'] = t("Logo file");  
  
  $style['enable_header_text']['list'] = "expert";
  $style['enable_header_text']['value'] = 0;
  $style['enable_header_text']['form'] = "select";
  $style['enable_header_text']['presets'] = "0|1";
  $style['enable_header_text']['comment'] = "Show header text";   
  
  $style['header_text']['list'] = "expert";
  $style['header_text']['value'] = "Drupal";
  $style['header_text']['form'] = "textfield";
  $style['header_text']['presets'] = "";
  $style['header_text']['comment'] = t("Text shown in header");  
  
  $style['enable_header_menu']['list'] = "expert";
  $style['enable_header_menu']['value'] = 1;
  $style['enable_header_menu']['form'] = "select";
  $style['enable_header_menu']['presets'] = "0|1";
  $style['enable_header_menu']['comment'] = t("Show horizontal menu in header");
  
  $style['enable_footer_menu']['list'] = "expert";
  $style['enable_footer_menu']['value'] = 0;
  $style['enable_footer_menu']['form'] = "select";
  $style['enable_footer_menu']['presets'] = "0|1";
  $style['enable_footer_menu']['comment'] = t("Show horizontal menu in footer"); 
  
  $style['date_format']['list'] = "expert";
  $style['date_format']['value'] = "D j M Y - H:i";
  $style['date_format']['form'] = "textfield";
  $style['date_format']['presets'] = "";
  $style['date_format']['comment'] = t("Format date using date format codes. Ex. 'D j M Y - H:i'");
  
  $style['link_color']['list'] = "expert";
  $style['link_color']['value'] = "#3366CC";
  $style['link_color']['form'] = "textfield";
  $style['link_color']['comment'] = t("Font color new links");
 
  $style['active_link_color']['list'] = "expert";
  $style['active_link_color']['value'] = "#FF0033";
  $style['active_link_color']['form'] = "textfield";
  $style['active_link_color']['comment'] = t("Font color active links"); 
  
  $style['visited_link_color']['list'] = "expert";
  $style['visited_link_color']['value'] = "#993399";
  $style['visited_link_color']['form'] = "textfield";
  $style['visited_link_color']['comment'] = t("Font color followed links");  
 
  $style['header_font_size']['list'] = "expert";
  $style['header_font_size']['value'] = "+4";
  $style['header_font_size']['form'] = "select";
  $style['header_font_size']['presets'] = "+1|+2|+3|+4";
  $style['header_font_size']['comment'] = t("Font size header");  
   
  $style['header_font_weight']['list'] = "expert";
  $style['header_font_weight']['value'] = "bold";
  $style['header_font_weight']['form'] = "select";
  $style['header_font_weight']['presets'] = "normal|bold";
  $style['header_font_weight']['comment'] = t("Bold or normal header fonts");
  
  $style['title_font_size']['list'] = "expert";
  $style['title_font_size']['value'] = "+1";
  $style['title_font_size']['form'] = "select";
  $style['title_font_size']['presets'] = "+1|+2|+3|+4";
  $style['title_font_size']['comment'] = t("Title font size");  
  
  $style['title_font_weight']['list'] = "expert";
  $style['title_font_weight']['value'] = "bold";
  $style['title_font_weight']['form'] = "select";
  $style['title_font_weight']['presets'] = "normal|bold";
  $style['title_font_weight']['comment'] = t("Bold or normal title fonts");
  
  $style['link_delimiter']['list'] = "expert";
  $style['link_delimiter']['value'] = " &middot; ";
  $style['link_delimiter']['form'] = "textfield";
  $style['link_delimiter']['presets'] = "";
  $style['link_delimiter']['comment'] = t("Code for the menu link seperators");

  $style['item_bullet']['list'] = "expert";
  $style['item_bullet']['value'] = " &middot; ";
  $style['item_bullet']['form'] = "textfield";
  $style['item_bullet']['presets'] = "";
  $style['item_bullet']['comment'] = t("Code for bullet in item list");
   
  $style['path_new_icon']['list'] = "expert";
  $style['path_new_icon']['value'] = "/themes/basic/images/new.gif";
  $style['path_new_icon']['form'] = "textfield";
  $style['path_new_icon']['comment'] = t("Path to 'new' icon");    
  
  return $style;
}  

// Return font and color mapped style array: 
function basic_style_mapping(&$style) {
  return $style;
}

// AND SOME THEME SPECIFIC FUNCTIONS 

// Return code for taxonomy terms: 
function basic_get_taxonomy($nid) {
  if ($terms = taxonomy_node_get_terms($nid)) {
    foreach ($terms as $term) {
      $link[] = l($term->name, NULL, array(), "or=$term->tid");
    }
    $theme = new Theme_basic();
    $out = $theme->links($link);
  }
  return $out;
}

// Return meta string with author and date: 
function basic_get_meta_line(&$type, $format) {
  // if node 
  if ($type->type) {
    $date = $type->created;
    $out .= ucfirst($type->type) . " " . t("submitted");
  }
  // else is comment 
  else {
    $date = $type->timestamp;
    $out .= t("Comment added");
  }
  $out .=  " " . strtr(t("by %a on %b"), 
    array("%a" => format_name($type), "%b" => 
    format_date($date, "custom", $format))) . "&nbsp;h. ";  
  if ($type->score) $out .= " (Score: " . $type->score . ")";  
  return $out;
}
?>
