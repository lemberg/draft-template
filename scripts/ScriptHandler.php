<?php

namespace Lemberg\Draft\Environment;

use Composer\Script\Event;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;

class ScriptHandler {

  /**
   * Sets up new project environment.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function setUpProject(Event $event) {
    $composer = $event->getComposer();

    // Use Composer's local repository to find the path to Draft Environment.
    $packages = $composer
      ->getRepositoryManager()
      ->getLocalRepository()
      ->findPackages('lemberg/draft-environment');
    if ($packages) {
      $installPath = $composer
        ->getInstallationManager()
        ->getInstallPath($packages[0]);
    }
    else {
      throw new \RuntimeException('lemberg/draft-environment package not found in local repository.');
    }

    if (!file_exists("./vm-settings.yml")) {
      $parser = new Parser();
      $config = $parser->parse(file_get_contents("$installPath/default.vm-settings.yml"));
      $config['vagrant']['hostname'] = $event->getIO()->ask('Please specify project name (lowercase letters, numbers, and underscores): ', 'default');

      $yaml = new Dumper();
      $yaml->setIndentation(2);
      file_put_contents("./vm-settings.yml", $yaml->dump($config, PHP_INT_MAX));
    }
  }
}
