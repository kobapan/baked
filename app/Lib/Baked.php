<?php
require_once 'Box.php';

class Baked extends Box
{
  public static $_timezone = 'UTC';

/**
 * テーマプラグインの設定ファイルに記述されたリソースファイルを読み込む
 *
 * @return void
 */
  public static function loadThemePluginResources($plugin)
  {
    $resourcesList = Configure::read("Themes.{$plugin}.resources");
    if ($resourcesList) {
      foreach ($resourcesList as $key => $resources) {
        Baked::add($key, $resources);
      }
    }
  }

/**
 * 各種ブロックに必要なリソースを読み込むよう設定
 *
 * @return void
 */
  public static function setupBlocks()
  {
    $searchFilesList = array(
      'CSS' => array(
        '/css/block.css',
      ),
      'CSS_EDITTING' => array(
        '/css/editor.css',
      ),
      'JS' => array(
        '/js/block.js',
      ),
      'JS_EDITTING' => array(
        '/js/editor.js',
      ),
    );

    App::uses('Folder', 'Utility');
    $pluginsRoot = APP.'Plugin';
    $folder = new Folder($pluginsRoot);
    list($plugins, $files) = $folder->read();

    foreach ($plugins as $plugin) {
      if (!preg_match('/^Block/', $plugin)) continue;

      foreach ($searchFilesList as $key => $searchFiles) {
        foreach ($searchFiles as $searchFile) {
          $realpath = $pluginsRoot.'/'.$plugin.'/webroot'.$searchFile;
          if (file_exists($realpath)) {
            $path = '/'.$plugin.$searchFile;
            Baked::add($key, $path);
          }
        }
      }
    }
  }

  public static function setTimezone($timezone)
  {
    self::$_timezone = $timezone;
  }

  public static function dateFormat($utcStr, $format = NULL, $timezone = NULL)
  {
    if (!$format) $format = 'Y-m-d H:i:s';
    if (!$timezone) $timezone = self::$_timezone;

    return CakeTime::format($format, $utcStr, FALSE, $timezone);
  }

  public static function utc($localStr, $timezone = NULL)
  {
    if (!$timezone) $timezone = self::$_timezone;

    $date = new DateTime($localStr, new DateTimeZone($timezone));
    $date->setTimezone(new DateTimeZone('UTC'));
    return $date->format('Y-m-d H:i:s');
  }

  public static function getRequirements()
  {
    require_once APP.'Config/requirements.php';
    return Configure::read('Baked.requirements');
  }

  public static function deleteAllCache()
  {
    App::uses('Folder', 'Utility');
    $folder = new Folder();
    $trees = $folder->tree(APP."tmp/cache", FALSE, 'dir');
    foreach ($trees as $tree) {
      $files = $folder->tree($tree, FALSE, 'file');
      foreach ($files as $file) @unlink($file);
    }
  }

  public static function setFlash($mes, $type)
  {
    $_SESSION['floating_message'] = array(
      'message' => $mes,
      'type'    => $type,
    );
  }

  public static function getFlash()
  {
    $flash = @$_SESSION['floating_message'];
    $_SESSION['floating_message'] = FALSE;
    return $flash;
  }



}





