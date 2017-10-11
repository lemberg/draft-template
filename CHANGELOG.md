## Draft Template 1.6.0, 2017-10-11

- Add support of Drupal 8.4
- Updated vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^2.0.1**)
    * Symfony Filesystem Component (symfony/filesystem: **~2.8|~3.2**)
    * Symfony Yaml Component (symfony/yaml: **~2.8|~3.2**)

## Draft Template 1.5.0, 2017-07-05

- Updated vendor libraries:
    * A Multi-Framework Composer Library Installer (composer/installers": **^1.3**)
    * Draft (lemberg/draft: **^1.2.1**)
    * Draft Environment (lemberg/draft-environment: **^1.4.0**)
    * Drupal Scaffold (drupal-composer/drupal-scaffold": **^2.3**)
- Removed vendor libraries (Draft profile is taking care of that):
    * Drupal Core (drupal/core)
    * Drupal Console (drupal/console)
    * Drush (drush/drush)
- Fix incorrect path to the config sync directory in settings.php

## Draft Template 1.4.0, 2017-06-07

- Added this file :)
- Updated vendor libraries:
    * Drupal Core (drupal/core: **^8.3.0**)
- Added vendor libraries:
    * Composer Merge Plugin (wikimedia/composer-merge-plugin: **^1.4**)
    * Drupal Console (drupal/console: **^1.0**)
    * Symfony Filesystem Component (symfony/filesystem: **~2.8**)
    * Symfony Yaml Component (symfony/yaml: **~2.8**)
- Merge core composer.json
- Updated .gitignore to exclude settings/services related files
- Added default settings.php
- Added clean up and project configuration scripts
- Renamed main branch to 1.x.x

## Draft Template 1.3.0, 2017-02-22

- Removed local development environment set up and replaced it by script from Draft Environment package
- Updated .gitignore to include Drupal scaffold
- Updated vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^1.3.2**)

## Draft Template 1.2.1, 2017-02-15

- Updated README.md

## Draft Template 1.2.0, 2017-02-15

- Added script to set up local development environment provided by Draft Environment
- Added vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^1.2.0**)

## Draft Template 1.1.0, 2017-02-08

- Added basic integration with Travis CI
- Added vendor libraries:
    * Drush (drush/drush: **^8.0.0**)

## Draft Template 1.0.0, 2017-02-07

- Initial release, nothing fancy
