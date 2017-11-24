[![Build Status](https://travis-ci.org/lemberg/draft-template.svg?branch=1.6.2)](https://travis-ci.org/lemberg/draft-template)

This is a [Composer](https://getcomposer.org)-based installer for the [Draft](https://github.com/lemberg/draft) Drupal profile.

## Requirements

- PHP 5.6+: http://php.net/downloads.php
- Composer: https://getcomposer.org/download/
- NFS server:
  * Windows: will be automatically installed with Vagrant WinNFSd plugin
  * MacOS: has built-in support
  * Ubuntu\Debian: install it by running `apt-get install nfs-kernel-server`
- Vagrant 1.8.0+: https://www.vagrantup.com/downloads.html
- VirtualBox 5.1+: https://www.virtualbox.org/wiki/Downloads

## Get Started

Run this command:

```
$ composer create-project --ignore-platform-reqs lemberg/draft-template my_awesome_project
```

Composer will create a new directory called `my_awesome_project` containing everything you need to get started.

## Changelog

Changelog can be found here [CHANGELOG.md](CHANGELOG.md)

## Upgrade

Upgrade instructions can be found here [UPGRADE.md](/UPGRADE.md)
