# UPGRADE

## 1.6.x -> 1.7.0

1. Add the following code at the bottom of `settings.local.php` file:

    ```
    // Draft settings. These come last so that they can override anything.
    if (file_exists($app_root . '/' . $site_path . '/settings.draft.php')) {
      include $app_root . '/' . $site_path . '/settings.draft.php';
    }
    ```
