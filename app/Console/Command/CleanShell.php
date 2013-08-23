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


      $tmpDirPath = WWW_ROOT.'files'.DS.'images';
      $folder = new Folder($tmpDirPath);
      $files = $folder->findRecursive();
      foreach ($files as $file) {
        $r = @unlink($file);
        if ($r === FALSE) throw new Exception("Failed to delete {$file}");
      }
      $this->out("Clear: {$tmpDirPath}");


      $tmpDirPath = ROOT.DS.'workfiles';
      $folder = new Folder($tmpDirPath);
      $r = $folder->delete();
      if ($r === FALSE) throw new Exception("Failed to delete {$tmpDirPath}");
      $this->out("Clear: {$tmpDirPath}");

    } catch (Exception $e) {
      $this->error($e->getMessage());
    }

    $this->out('All done').

    $this->__outputEnd();
  }


}





