<?php

// @codingStandardsIgnoreFile

require_once 'default.settings.php';

// This is defined inside the read-only "config" directory, deployed via Git.
$settings['config_sync_directory'] = $app_root . '/../config/' . basename($site_path);

// Include Platform.sh settings if available.
if (getenv('PLATFORM_APPLICATION') && file_exists($app_root . '/' . $site_path . '/settings.platformsh.php')) {
  include $app_root . '/' . $site_path . '/settings.platformsh.php';
}
// Include CI settings if available.
elseif (getenv('CI') && file_exists($app_root . '/' . $site_path . '/settings.ci.php')) {
  include $app_root . '/' . $site_path . '/settings.ci.php';
}
elseif (getenv('DRAFT_ENVIRONMENT') == 'true' && file_exists($app_root . '/' . $site_path . '/settings.draft.php')) {
  include $app_root . '/' . $site_path . '/settings.draft.php';
}
// Local settings. These come last so that they can override anything.
if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
