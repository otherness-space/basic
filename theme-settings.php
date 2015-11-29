<?php

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * Form override for theme settings.
 */
function basic_form_system_theme_settings_alter(array &$form, FormStateInterface $form_state) {

  $form['options_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Theme Specific Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  // Guard support
  // TODO: still need to output browsersync JS file
  $form['options_settings']['basic_browser_sync'] = array(
    '#type' => 'fieldset',
    '#title' => t('BrowserSync Settings'),
    '#attributes' => array('id' => 'basic-browsersync'),
  );
  $form['options_settings']['basic_browser_sync']['basic_browser_sync_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable BrowserSync support for theme'),
    '#default_value' => theme_get_setting('basic_browser_sync_enabled'),
    '#description' => t('Checking this box will automatically add the BrowserSync JS to your theme for development. You will not require the browser plugin.'),
  );

  // IE specific settings.
  $form['options_settings']['basic_ie'] = array(
    '#type' => 'fieldset',
    '#title' => t('Internet Explorer Stylesheets'),
    '#attributes' => array('id' => 'basic-ie'),
  );
  $form['options_settings']['basic_ie']['ie_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Internet Explorer stylesheets in theme'),
    '#default_value' => theme_get_setting('ie_enabled'),
    '#description' => t('If you check this box you can choose which IE stylesheets in theme get rendered on display.'),
  );
  $form['options_settings']['basic_ie']['ie_enabled_css'] = array(
    '#type' => 'fieldset',
    '#title' => t('Check which IE versions you want to enable .lt-ie CSS class for'),
    '#states' => array(
      'visible' => array(
        ':input[name="ie_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options_settings']['basic_ie']['ie_enabled_css']['ie_enabled_versions'] = array(
    '#type' => 'checkboxes',
    '#options' => array(
      'ie8' => t('Internet Explorer 8'),
      'ie9' => t('Internet Explorer 9'),
    ),
    '#default_value' => array_keys(array_filter(theme_get_setting('ie_enabled_versions'))) ?: [],
  );

  // Clear theme registry.
  $form['options_settings']['clear_registry'] = array(
    '#type' => 'checkbox',
    '#title' => t('Rebuild theme registry on every page.'),
    '#description' => t('During theme development, it can be very useful to continuously <a href=":link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array(':link' => 'http://drupal.org/node/173880#theme-registry')),
    '#default_value' => theme_get_setting('clear_registry'),
  );
}
