<?php

/**
 * @file
 * This file is included very early. See autoload.files in composer.json.
 *
 * @link https://getcomposer.org/doc/04-schema.md#files.
 */

use Dotenv\Dotenv;

/**
 * Load the .env file.
 */
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
