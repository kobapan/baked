<?php
App::uses('AppShell', 'Console/Command');

class CleanShell extends AppShell
{
  public $uses = array();

  public function getOptionParser()
  {
    $parser = parent::getOptionParser();
    return $parser;
  }

  public function main()
  {
    $this->__prepare();

    try {
      App::uses('Folder', 'Utility');

      $myConfPath = ROOT.DS.'my.php';
      $fp = @fopen($myConfPath, 'w');
      if (!$fp) throw new Exception("Failed to open {$myConfPath}");
      if (fwrite($fp, '') === FALSE) throw new Exception("Failed to write to {$myConfPath}");
      $this->out("Clear: {$myConfPath}");


      $tmpDirPath = APP.'tmp';
      $folder = new Folder($tmpDirPath);
      $files = $folder->findRecursive();
      foreach ($files as $file) {
        $r = @unlink($file);
        if ($r === FALSE) throw new Exception("Failed to delete {$file}");
      }
      $this->out("Clear: {$tmpDirPath}");


      $paths = array(
        ROOT.DS.'.git',
        ROOT.DS.'workfiles',
        WWW_ROOT.'files'.DS.'images',
      );
      foreach ($paths as $path) {
        if (!file_exists($path)) continue;
        $folder = new Folder($path);
        $r = $folder->delete();
        if ($r === FALSE) throw new Exception("Failed to delete {$path}");
        $this->out("Clear: {$path}");
      }


      $paths = array(
        ROOT.DS.'.gitignore',
        ROOT.DS.'.project',
      );
      foreach ($paths as $path) {
        if (!file_exists($path)) continue;
        if (!@unlink($path)) throw new Exception("Failed to delete {$path}");
      }

    } catch (Exception $e) {
      $this->error($e->getMessage());
    }

    $this->out('All done').

    $this->__outputEnd();
  }


}





