<?php
require_once 'Box.php';

class Baked extends Box
{
  public static $_timezone = 'UTC';

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





