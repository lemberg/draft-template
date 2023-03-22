<?php

/**
 * @file
 * CI settings.
 */

if (getenv('CI')) {

  // Set up default database.
  $databases['default']['default'] = [
    'database' => 'drupal',
    'username' => 'drupal',
    'password' => 'drupal',
    'prefix' => '',
    'host' => 'localhost',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
  ];

  // Hash salt doesn't matter for the CI.
  $settings['hash_salt'] = 'ci';

  // Config split.
  $config['config_split.config_split.develop']['status'] = TRUE;
}
