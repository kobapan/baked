<?php
require_once 'Box.php';

class Baked extends Box
{
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





