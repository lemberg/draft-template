<?php

namespace Lemberg\Draft\Template;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Cleans template after project creation.
 */
class Cleaner {

  /**
   * List of not relevant files, that should be removed after project creation.
   *
   * @var array
   */
  const FILES_TO_REMOVE = [
    './.travis.yml',
    './CHANGELOG.md',
    './README.md',
    './UPGRADE.md',
    './integrations'
  ];

  /**
   * Cleans up project template after creation by removing not relevant files.
   *
   * @param \Composer\Script\Event $event
   *   Composer command event object.
   */
  public static function cleanUp(Event $event) {
    /** @var \Composer\IO\IOInterface $io */
    $io = $event->getIO();

    if (!$io->isInteractive() || $io->askConfirmation('Would you like to clean up project template and remove some not relevant files (like README.md)? <question>[Y,n]</question> ')) {
      $fs = new Filesystem();
      $fs->remove(self::FILES_TO_REMOVE);
    }
  }

}
