<?php
// Form override fo theme settings
function basic_form_system_theme_settings_alter(&$form, $form_state) {

  $form['options_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Visual Options'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  );
  $form['options_settings']['zen_tabs'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Use the ZEN tabs'),
    '#description'   => t('Check this if you wish to replace the default tabs by the ZEN tabs'),
  );

  $form['dev_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Development Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE
  );
  $form['dev_settings']['wireframe_mode'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Wireframe Mode - Display borders around main layout elements'),
    '#description'   => t('<a href="!link">Wireframes</a> are useful when prototyping a website.', array('!link' => 'http://www.boxesandarrows.com/view/html_wireframes_and_prototypes_all_gain_and_no_pain')),
  );
  $form['dev_settings']['block_editing'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Show block editing on hover'),
    '#description'   => t('When hovering over a block, privileged users will see block editing links. <strong>You might need to rebuild the theme registry after activating this option.</strong>'),
  );
  $form['dev_settings']['clear_registry'] = array(
    '#type' => 'checkbox',
    '#title' =>  t('Rebuild theme registry on every page.'),
    '#description'   =>t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'http://drupal.org/node/173880#theme-registry')),
  );
  
}