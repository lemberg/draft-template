<?php

/**
 * This file is included very early. See autoload.files in composer.json and
 * https://getcomposer.org/doc/04-schema.md#files
 */

use Symfony\Component\Dotenv\Dotenv;

/**
 * Load any .env file.
 *
 * Drupal has no official method for loading environment variables and uses
 * getenv() in some places.
 */

if (file_exists(__DIR__ . '/.env')) {
  // Drupal core still uses `getenv()`.
  $dotenv = (new Dotenv())->usePutenv(TRUE);
  $dotenv->load(__DIR__ . '/.env');
}
