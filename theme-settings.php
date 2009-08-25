<?php

// Implementation of THEMEHOOK_settings() function.

// @param $saved_settings
//   array An array of saved settings for this theme.
// @return
//   array A form array.

function phptemplate_settings($saved_settings) {
  
  // The default values for the theme variables. Make sure $defaults exactly
  // matches the $defaults in the template.php file.
  
  $defaults = array(
    'wireframe_mode'  => 0,
    'block_editing'   => 0,
    'clear_registry'  => 0,
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  $form['dev_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Development Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  );
  $form['dev_settings']['wireframe_mode'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Display borders around main layout elements'),
    '#description'   => t('<a href="!link">Wireframes</a> are useful when prototyping a website.', array('!link' => 'http://www.boxesandarrows.com/view/html_wireframes_and_prototypes_all_gain_and_no_pain')),
    '#default_value' => $settings['wireframe_mode']
  );
  $form['dev_settings']['block_editing'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Show block editing on hover'),
    '#description'   => t('When hovering over a block, privileged users will see block editing links. <strong>You might need to rebuild the theme registry after activating this option.</strong>'),
    '#default_value' => $settings['block_editing']
  );
  $form['dev_settings']['clear_registry'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Rebuild theme registry on every page.'),
    '#description'   =>t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
    '#default_value' => $settings['clear_registry']
  );
  
  // Return the additional form widgets
  return $form;
}