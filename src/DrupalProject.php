<?php

namespace Lemberg\Draft\Template;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

/**
 * Configurator for Drupal projects.
 */
class DrupalProject {

  /**
   * Creates files required by Drupal.
   *
   * @param \Composer\Script\EventEvent $event
   *   Composer command event object.
   */
  public static function createRequiredFiles(Event $event) {
    $fs = new Filesystem();
    $root = self::getProjectDocRoot();

    // Create the files directory with chmod 0777.
    if (!$fs->exists("$root/sites/default/files")) {
      $oldmask = umask(0);
      $fs->mkdir("$root/sites/default/files", 0777);
      umask($oldmask);
    }
  }

  /**
   * Sets up local development environment.
   *
   * @param \Composer\Script\EventEvent $event
   *   Composer command event object.
   */
  public static function localSetup(Event $event) {
    /** @var \Composer\IO\IOInterface $io */
    $io = $event->getIO();
    $fs = new Filesystem();
    $root = self::getProjectDocRoot();
    $local_settings_file = "$root/sites/default/settings.local.php";

    if (!$fs->exists($local_settings_file) && $event->isDevMode() && $io->isInteractive() && $io->askConfirmation('Would you like to setup project locally? <question>[Y,n]</question> ')) {

      // Create settings.local.php
      $fs->copy("$root/sites/example.settings.local.php", $local_settings_file);

      // Inject settings.draft.php at the bottom of the local settings file.
      $settings = file_get_contents($local_settings_file);
      $settings .= <<<HERE

// Draft settings. These come last so that they can override anything.
if (file_exists(\$app_root . '/' . \$site_path . '/settings.draft.php')) {
  include \$app_root . '/' . \$site_path . '/settings.draft.php';
}

HERE;
      file_put_contents($local_settings_file, $settings);

      // Create own development.services.yml.
      $development_services_file = "$root/sites/default/development.services.yml";
      if (!$fs->exists($development_services_file)) {
        $fs->copy("$root/sites/development.services.yml", $development_services_file);
        // Make sure we are using correct services file.
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("/sites/development.services.yml", "/sites/default/development.services.yml", $settings);
        file_put_contents($local_settings_file, $settings);
      }

      // Enable TWIG debugging.
      if ($io->askConfirmation('Enable <info>TWIG debugging</info>? <question>[Y,n]</question> ')) {
        $parser = new Parser();
        $config = $parser->parse(file_get_contents($development_services_file));
        $config['parameters']['twig.config'] = [
          'debug' => TRUE,
          'cache' => FALSE,
        ];

        $yaml = new Dumper();
        $yaml->setIndentation(2);
        $fs->dumpFile($development_services_file, $yaml->dump($config, PHP_INT_MAX));
      }

      // Disable the render cache.
      if ($io->askConfirmation('Disable <info>render cache</info> (including page cache)? <question>[y,N]</question> ', FALSE)) {
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("# \$settings['cache']['bins']['render']", "\$settings['cache']['bins']['render']", $settings);
        file_put_contents($local_settings_file, $settings);
      }

      // Disable caching for migrations.
      if ($io->askConfirmation('Disable <info>caching for migrations</info>? <question>[y,N]</question> ', FALSE)) {
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("# \$settings['cache']['bins']['discovery_migration']", "\$settings['cache']['bins']['discovery_migration']", $settings);
        file_put_contents($local_settings_file, $settings);
      }

      // Disable Dynamic Page Cache.
      if ($io->askConfirmation('Disable <info>Dynamic Page Cache</info>? <question>[y,N]</question> ', FALSE)) {
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("# \$settings['cache']['bins']['dynamic_page_cache']", "\$settings['cache']['bins']['dynamic_page_cache']", $settings);
        file_put_contents($local_settings_file, $settings);
      }
    }
  }

  /**
   * Returns absolute path to the project document root directory.
   *
   * @return string
   *   Absolute path to the project document root directory.
   */
  public static function getProjectDocRoot() {
    // Get document root from VM settings.
    $project_root = getcwd();
    $parser = new Parser();
    $vm_settings = $parser->parse(file_get_contents("$project_root/vm-settings.yml"));

    return $project_root . '/' . (!empty($vm_settings['apache2_document_root']) ? $vm_settings['apache2_document_root'] : 'docroot');
  }

  /**
   * Configure integrations with third party platforms.
   *
   * @param \Composer\Script\EventEvent $event
   *   Composer command event object.
   */
  public static function configureIntegrations(Event $event) {
    /** @var \Composer\IO\IOInterface $io */
    $io = $event->getIO();
    $fs = new Filesystem();
    $project_root = getcwd();

    if (!$fs->exists("$project_root/shippable.yml") && $io->askConfirmation('Enable integration with <info>Shippable CI</info>? <question>[Y,n]</question> ')) {
      $fs->copy("$project_root/integrations/shippable.com/shippable.yml", "$project_root/shippable.yml");
    }

    if (!$fs->exists("$project_root/.platform.app.yml") && $io->askConfirmation('Enable integration with <info>Platform.sh</info>? <question>[Y,n]</question> ')) {
      $fs->mirror("$project_root/integrations/platform.sh", "$project_root");
    }
  }

}
