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

    if ($fs->exists($local_settings_file)) {
      $io->write('<info>File local.settings.php exists, skipping. To start over remove local.settings.php and run composer install</info>');
    }
    else if ($event->isDevMode() && $io->askConfirmation('<info>Would you like to setup project locally</info> [<comment>Y,n</comment>]? ')) {

      // Create settings.local.php
      $fs->copy("$root/sites/example.settings.local.php", $local_settings_file);

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
      if ($io->askConfirmation('<info>Enable TWIG dubegging</info> [<comment>Y,n</comment>]? ')) {
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
      if ($io->askConfirmation('<info>Disable the render cache</info> [<comment>y,N</comment>]? ', FALSE)) {
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("# \$settings['cache']['bins']['render']", "\$settings['cache']['bins']['render']", $settings);
        file_put_contents($local_settings_file, $settings);
      }

      // Disable caching for migrations.
      if ($io->askConfirmation('<info>Disable caching for migrations</info> [<comment>y,N</comment>]? ', FALSE)) {
        $settings = file_get_contents($local_settings_file);
        $settings = str_replace("# \$settings['cache']['bins']['discovery_migration']", "\$settings['cache']['bins']['discovery_migration']", $settings);
        file_put_contents($local_settings_file, $settings);
      }

      // Disable Dynamic Page Cache.
      if ($io->askConfirmation('<info>Disable Dynamic Page Cache</info> [<comment>y,N</comment>]? ', FALSE)) {
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
    return getcwd() . '/docroot';
  }

}
