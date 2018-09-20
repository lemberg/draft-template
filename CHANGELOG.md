## Draft template 1.x.x

- Updated .gitignore to include router file for PHP's built-in webserver, which was added in Drupal 8.5 (`./docroot/.ht.router.php`)
- Optimize `composer install` command on Shippable CI
- Update default Platform.sh settings to catch up with changes on the platform:
    * Make sure project utilizes all 5Gb of space available
    * Improve `.environment` and `settings.platformsh.php` files
    * New default file mounts: `'/.drush': 'shared:files/.drush'` and `'/drush-backups': 'shared:files/drush-backups'`
    * Deny direct access to configuration files
    * Improve handling of nested environment variables
    * Update default PHP version to **7.2**
- Updated vendor libraries:
    * Drupal Scaffold (drupal-composer/drupal-scaffold: **^2.5**)
    * Drupal Core (drupal/core: **^8.6.0**)
- Test this project against PHP 7.2 on Travis CI

## Draft template 1.8.0, 2018-03-15

- Update default project license to **GPL-2.0-or-later**
- Do not import develop configuration split on master (i.e. production) Platform.sh environment
- PHP Code Sniffer to ignore fonts folders on Shippable CI
- Run clean up after configuring integrations
- Include Platform.sh settings by default in site settings.php
- Clean up `./UPGRADE.md` and `./integrations` after running `composer create-project`
- Updated vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^2.5.0**)
    * Drupal Core (drupal/core: **^8.5.0**)
    * Symfony Filesystem Component (symfony/filesystem: **^3.4**)
    * Symfony Yaml Component (symfony/yaml: **^3.4**)

## Draft template 1.7.2, 2017-12-13

- Fix path to config directory in Shippable CI template

## Draft template 1.7.1, 2017-11-27

- Local setup assumes that VM is already set up (i.e. `Lemberg\Draft\Environment\Configurer::setUp` must run before `Lemberg\Draft\Template\DrupalProject::localSetup`)

## Draft Template 1.7.0, 2017-11-24

- Sort dependencies in composer.json by default
- Add Draft settings file with common configuration for running Drupal in VM
- Updated vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^2.1.1**)
- Added vendor libraries:
    * Coder (drupal/coder: **^8.2**)
    * Drupal Console (drupal/console: **^1.2**)
    * Devel (drupal/devel: **^1.2**)
    * Reroute Email (drupal/reroute_email: **^1.0**)
    * Stage File Proxy (drupal/stage_file_proxy: **^1.0**)
    * Drush (drush/drush: **^8.1.15**)
- Do not merge core and Draft profile composer.json files anymore, because this is causing troubles with updating core
- Add integration with Shippable CI
- Add integration with Platform.sh
- Explicitly depend on drupal/core: **^8.4.2** in order to avoid downgrading to 8.4.0-alpha1

## Draft Template 1.6.2, 2017-10-12

- Updated vendor libraries:
    * Draft Environment (lemberg/draft-environment: **^2.0.2**)

## Draft Template 1.6.1, 2017-10-12

- Catch up with changes in Draft environment 2.x.x

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
