<?php

/**
 * @file
 * Drush hooks and include commands..
 */

// if (!function_exists('omega_theme_get_setting')) {
//   require_once dirname(__FILE__) . '/omega.inc';
// }

/**
 * Implements hook_drush_command().
 */
function basic_drush_command() {

  $items['basic-install'] = array(
    'description' => dt('Run through the installation process of the basic theme.'),
    'aliases' => array('binstall'),
  );

  // $items['basic-grunt'] = array(
  //   'description' => dt('Runs grunt for the given theme including SASS watch and BrowserSync by default.'),
  //   'arguments' => array(
  //     'name' => dt('The name of your subtheme.'),
  //   ),
  //  'options' => array(
  //    'screen' => dt('Run guard watch in a detached screen.'),
  //    'force-polling' => dt('Polling is required for making guard watch work with remote file systems e.g. in case of virtual environments where guard runs on the guest but the files are modified on the host.'),
  //    'latency' => dt("Sometimes it seems to be required to set a latency (e.g. 5) if working with --force-polling because otherwise file changes are detected twice. Hence, not setting a latency might affect your system performance."),
  //   ),
  //   'aliases' => array('basicgrunt'),
  // );

  return $items;
}

/**
 * Implements hook_drush_help().
 */
function basic_drush_help($section) {
  switch ($section) {

    case 'drush:basic-install':
      return dt('Runs through an automated process for installing and renaming your theme to use as your own.');

    // case 'drush:basic-grunt':
    //   return dt('Runs guard for the given theme including Compass and LiveReload by default.');

  }
}

/**
 * Implements drush_hook_COMMAND().
 */
function drush_basic_install() {

  // Prompt the user what we're doing.
  drush_confirm(dt('Welcome to the Basic Install. We will perform the automated tasks for you to use your new theme. We will create a copy of the basic theme and store it within the same folder. Do you wish to continue?'));

  // Rebuild the theme data so that we can safely check for the existence of
  // themes by using the information provided by list_themes().
  $theme_handler = \Drupal::service('theme_handler');
  $theme_handler->rebuildThemeData();

  // Prompt for a theme name.
  $name = drush_prompt(dt('Please enter the name of that you want for your theme'), 'Basic theme copy');

  // Try to generate a machine-readable name. If that fails, prompt for one.
  if (!$machine_name = drush_basic_generate_theme_name($name)) {
    drush_print(dt("Sorry, I couldn't generate a machine-readable name for @name", array(
      '@name' => $name,
    )));
  }
  // Prompt for a theme name using the automatically generated default if any.
  drush_set_option('machine-name', drush_basic_require_valid_theme_name(dt('Please enter a machine-readable name for your new theme'), $machine_name));

  // Set the destination of the new theme.
  drush_set_option('destination', 'themes');
// 
//   // Let the user choose a destination.
//   $destination = drush_prompt(dt('Please choose a destination. This is where your sub-theme will be placed'), 'sites/all/themes');
//   drush_set_option('destination', $destination);
//  
//   // Optionally skip readme files when generating the subtheme.
//   drush_set_option('no-readme', !drush_confirm(dt("Do you want to keep the starterkit's readme files?")));
// 
//   // Finally, let the user choose to directly enable the subtheme.
//   if ($enable = drush_confirm(dt('Do you want to enable your new theme?'))) {
//     drush_set_option('set-default', drush_confirm(dt('Do you want to make your new theme the default theme?')));
//   }
//   drush_set_option('enable', $enable);
// 
//   // Finally, let the user decide whether he/she wants to download the libraries directly.
//   if (is_file("{$starterkits[$starterkit]['path']}/libraries.make")) {
//     drush_set_option('with-libraries', drush_confirm(dt('Do you want to download the libraries defined in libraries.make now?')));
//   }
// 
  

  // Try to generate a machine-readable name. If that fails, prompt for one.
  if (!$machine_name = drush_get_option('machine-name', drush_basic_generate_theme_name($name))) {
    drush_print(dt("Sorry, I couldn't generate a machine-readable name for @name. Please use the '--machine-name' option to specify it manually.", array(
      '@name' => $name,
    )));
  }

  // Check whether the destination path does not exist and bail out if it does
  // so we don't delete any important data by accident.
  $destination = drush_get_option('destination', 'themes') . '/' . $machine_name;
  if (file_exists($destination)) {
    return drush_set_error('BASIC_COPY_PATH', dt('The path @path already exists.', array('@path' => $destination)));
  }

  // Create a temporary directory so we don't leave any stale files if an
  // operation fails.
  $temporary = drush_tempdir() . '/' . $machine_name;

  // Try to copy basic to the destination path of the new theme.
  // if (!drush_copy_dir('themes/basic', $temporary)) {
  //   return drush_set_error('BASIC_COPY_GENERATE_THEME', dt('Failed to generate theme.'));
  // }

  // Copy into main folder.
  drush_copy_dir('themes/basic', 'themes/' . $machine_name);

  // Recursively rewrite the file names and contents of all the files that are
  // now in the subtheme's directory to represent the human- and
  // machine-readable names of the subtheme.
  $camel = strtr(ucwords(strtr($machine_name, array('_' => ' ', '.' => '_ '))), array(' ' => ''));
  $search = array(
    'basic' => $machine_name,
    'Basic' => $name,
    'basic_' => str_replace('_', '-', $machine_name),
    'basic' => $camel,
    'basic' => lcfirst($camel),
  );

  // @TODO: Change to temp dir.
  if (!drush_basic_rewrite_recursive('themes/' . $machine_name, array_keys($search), array_values($search))) {
    return drush_set_error('BASIC_COPY_GENERATE_THEME', dt('Failed to rewrite files and contents while generating theme.'));
  }

  drush_op('chdir', 'themes/' . $machine_name);

  drush_shell_exec('npm install');

  return;
  // Delete the .starterkit.inc file.
  // drush_delete_dir($temporary . '/' . basename($starterkit['file']));

  // Put the name and description for the new subtheme in place.
  $info = array(
    'name' => $name,
    'description' => 'Please provide a description for your theme.',
    'base theme' => $basetheme,
  ) + $starterkit['info'];

  // If the starterkit does not provide any regions, use those defined in the
  // base theme (if any).
  if (empty($info['regions'])) {
    // We explicitly avoid reading from the generated theme info array for this
    // and get the raw, unprocessed .info file data of the base theme instead to
    // prevent any system- or module-provided regions to leak into our theme's
    // .info file (e.g. via hook_system_info_alter() as used by the dashboard
    // module).
    $basetheme_info = drupal_parse_info_file(drupal_get_path('theme', $basetheme) . "/$basetheme.info");
    if (!empty($basetheme_info['regions'])) {
      $info['regions'] = $basetheme_info['regions'];
    }
  }

  // Write to the new .info file.
  $file = $temporary . '/' . $machine_name . '.info';
  if (!file_put_contents($file, drush_omega_compose_info_file($info))) {
    return drush_set_error('BASIC_COPY_GENERATE_THEME', dt('Failed to generate subtheme.'));
  }

  

  // Move the new subtheme to its destination.
  if (!drush_op('drush_mkdir', dirname($destination)) || !drush_op('drush_move_dir', $temporary, $destination)) {
    return drush_set_error('BASIC_COPY_GENERATE_THEME', dt('Failed to generate subtheme.'));
  }

  // Rebuild the theme caches so that  we can do some final tasks.
  drupal_theme_rebuild();
  system_rebuild_theme_data();

  if (($default = drush_get_option('set-default')) || !drush_get_option('enable')) {
    // Enable the subtheme.
    drush_op('theme_enable', array($machine_name));

    if ($default) {
      // Make the newly created subtheme the default theme.
      drush_op('variable_set', 'theme_default', $machine_name);
    }
  }

  // Execute the theme's libraries.make file unless disabled.
  if (drush_get_option('with-libraries') && is_file("$destination/libraries.make")) {
    drush_op('chdir', $destination);
    drush_invoke_process('@self', 'make', array('libraries.make'), array(
      'no-core' => TRUE,
      'contrib-destination' => '.',
      'yes' => TRUE,
    ));
  }

  drush_log(dt('You have successfully created the theme @theme (@name) in @path.', array(
    '@theme' => $name,
    '@name' => $machine_name,
    '@path' => dirname($destination),
  )), 'success');
}

/**
 * Generates a valid machine-readable name for a theme from any string.
 *
 * @param string $string
 *   The string to generate the machine-readable name from.
 *
 * @return string
 *   The generated machine-readable name.
 */
function drush_basic_generate_theme_name($string) {
  // Machine-readable names have to start with a lowercase letter.
  $string = preg_replace('/^[^a-z]+/', '', strtolower($string));
  // Machine-readable names may only contain alphanumeric characters and
  // underscores.
  $string = preg_replace('/[^a-z0-9_]+/', '_', $string);
  // Trim all trailing and leading underscores.
  $string = trim($string, '_');

  // Get list of current themes.
  $theme_handler = \Drupal::service('theme_handler');
  $themes = $theme_handler->listInfo();

  if (isset($themes[$string])) {
    $plain = $string;
    $counter = 0;

    while (isset($themes[$string])) {
      // Make sure that the machine-readable name of the theme is unique.
      $string = $plain . '_' . $counter++;
    }
  }

  return $string;
}

/**
 * Helper function that continuously prompts for a valid machine-readable name.
 *
 * @param string $message
 *   The message that should be displayed.
 * @param string $default
 *   (Optional) The default theme name. Defaults to NULL.
 *
 * @return string
 *   A valid, unique machine-readable name.
 */
function drush_basic_require_valid_theme_name($message, $default = NULL) {
  while (TRUE) {
    // Keep prompting for a machine-name until we get an acceptable value.
    $prompt = drush_prompt($message, $default);

    if (!preg_match('/^[a-z][a-z0-9_]*$/', $prompt)) {
      drush_print('The machine-readable name is invalid. It may only contain lowercase numbers, letters and underscores and must start with a letter.');
    }
    else {

      // Get list of current themes.
      $theme_handler = \Drupal::service('theme_handler');
      $themes = $theme_handler->listInfo();

      // Validate that the machine-readable name of the theme is unique.
      if (isset($themes[$prompt])) {
        drush_print(dt('A theme with the name @name already exists. The machine-readable name must be unique.', array(
          '@name' => $prompt,
        )));
      }
      else {
        // The given machine-readable name is valid. Let's proceed.
        return $prompt;
      }
    }
  }
}


/**
 * Recursively rewrites (and renames) all files in a given path.
 *
 * @param string $path
 *   The path to rewrite all files in.
 * @param string|array $search
 *   The string(s) to look for when replacing the file names and contents. Can
 *   be an array or a string.
 * @param string|array $replace
 *   The string(s) to replace $search with. Can be an array or a string.
 *
 * @return bool
 *   TRUE if the operation succeeded, FALSE otherwise.
 *
 * @see omega_drush_replace_contents()
 * @see str_replace()
 */
function drush_basic_rewrite_recursive($path, $search, $replace) {
  if (!is_dir($path)) {
    return drush_set_error('INVALID_PATH', dt('The given path @path is not a directory.', array(
      '!path' => $path,
    )));
  }

  // If the file actually is a directory, proceed with the recursion.
  $directory = new DirectoryIterator($path);
  foreach ($directory as $item) {
    if ($item->isDot()) {
      // Do not process '..' and '.'.
      continue;
    }

    // Retrieve the path of the current item.
    $pathname = $item->getPathname();
    if ($item->isDir() && !drush_basic_rewrite_recursive($pathname, $search, $replace)) {
      return FALSE;
    }
    elseif ($item->isFile()) {
      // If it is a file, try to replace its contents.
      $contents = file_get_contents($pathname);
      if (($changed = preg_replace($search, $replace, $contents)) === NULL) {
        return drush_set_error('REWRITE_FAILURE', dt('There was an error while trying to rewrite !path (!search to !replace)', array(
          '!path' => $pathname,
          '!search' => $search,
          '!replace' => $replace,
        )));
      }

      if ($contents !== $changed) {
        file_put_contents($pathname, $changed);
      }
    }

    // Try to rename (move) the file if the name was changed.
    $original = basename($pathname);
    if (($renamed = preg_replace($search, $replace, $original)) === NULL) {
      return drush_set_error('REWRITE_FAILURE', dt('There was an error while trying to rewrite !path (!search to !replace)', array(
        '!path' => $path,
        '!search' => $search,
        '!replace' => $replace,
      )));
    }

    // Move (rename) if the file or directory name was changed.
    if ($original !== $renamed) {
      $new = dirname($pathname) . "/$renamed";
      if (!drush_move_dir($pathname, $new, TRUE)) {
        return FALSE;
      };
    }
  }

  return TRUE;
}


/**
 * Discovers layouts, extensions or other plugins in the theme trail.
 *
 * @param string $type
 *   A theme extension type (e.g. layout or extension).
 * @param string $theme
 *   (Optional) The key (machine-readable name) of a theme. Defaults to the key
 *   of the current theme.
 *
 * @return array
 *   An array containing the discovered definitions.
 */
function basic_discovery($type, $theme = NULL) {
  $theme = isset($theme) ? $theme : $GLOBALS['theme_key'];

  if (($discovery = &drupal_static(__FUNCTION__, array())) && isset($discovery[$theme][$type])) {
    return $discovery[$theme][$type];
  }

  $discovery[$theme][$type] = array();

  // Retrieve all themes from the theme trail of the given theme.
  // Get list of current themes.
  $theme_handler = \Drupal::service('theme_handler');
  $themes = $theme === FALSE ? $theme_handler->listInfo() : basic_theme_trail($theme);

  // Collect paths to all sub-themes grouped by base themes. These will be
  // used for filtering. This allows base themes to have sub-themes in its
  // folder hierarchy without affecting the base themes template discovery.
  $paths = array();
  foreach (list_themes() as $key => $info) {
    if (!empty($info->base_theme)) {
      $paths[$info->base_theme][$key] = dirname($info->filename);
    }
  }
  foreach ($paths as $basetheme => $subthemes) {
    foreach ($subthemes as $subtheme => $path) {
      if (isset($paths[$subtheme])) {
        $paths[$basetheme] = array_merge($paths[$basetheme], $paths[$subtheme]);
      }
    }
  }

  $strlen = strlen($type) + 1;
  foreach ($themes as $key => $label) {
    // Retrieve the array of paths that should be ignored for this theme.
    $ignore = isset($paths[$key]) ? $paths[$key] : array();
    $path = drupal_get_path('theme', $key);

    // Support files without '.inc' extension for backwards compatibility.
    foreach (file_scan_directory($path, '/\.' . $type . '(\.inc)?$/', array('key' => 'name')) as $name => $file) {
      // Ignore sub-theme implementations for the current theme.
      if (strpos($file->uri, str_replace($ignore, '', $file->uri)) !== 0) {
        continue;
      }

      if (substr($name, -$strlen) === '.' . $type) {
        $name = substr($name, 0, strlen($name) - $strlen);
      }

      if ($info = drupal_parse_info_file($file->uri)) {
        $discovery[$theme][$type][$name] = array(
          'name' => $name,
          'path' => dirname($file->uri),
          'file' => $file->uri,
          'info' => $info,
          'theme' => $key,
        );
      }
    }
  }

  return $discovery[$theme][$type];
}

/**
 * Builds the full theme trail (deepest base theme first) for a theme.
 *
 * @param string $theme
 *   (Optional) The key (machine-readable name) of a theme. Defaults to the key
 *   of the current theme.
 *
 * @return array
 *   An array of all themes in the trail, keyed by theme key.
 */
function basic_theme_trail($theme = NULL) {
  $theme = isset($theme) ? $theme : $GLOBALS['theme_key'];

  if (($cache = &drupal_static(__FUNCTION__)) && isset($cache[$theme])) {
    return $cache[$theme];
  }

  $cache[$theme] = array();

  if ($theme == $GLOBALS['theme'] && isset($GLOBALS['theme_info']->base_themes)) {
    $cache[$theme] = $GLOBALS['theme_info']->base_themes;
  }

  $themes = list_themes();
  if (empty($cache[$theme]) && isset($themes[$theme]->info['base theme'])) {
    $cache[$theme] = system_find_base_themes($themes, $theme);
  }

  // Add our current subtheme ($key) to that array.
  $cache[$theme][$theme] = $themes[$theme]->info['name'];

  return $cache[$theme];
}