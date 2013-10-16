<?php
/**
 * AutoUpdater
 *
 * @author Masayuki Akiyama
 * @version 0.0.0
 */
class AutoUpdater
{
  const ERROR_UNKNOWN = 100;
  const ERROR_BACKUP = 101;
  const ERROR_OVERWRITE = 102;

  public $errors = array();
  public $ignoreFiles = array();
  public $zipUrl = null;
  public $zipBase = 'baked';
  private $_targetDirPath = null;
  private $_tmpZipPath = null;

  private function _createBackup()
  {
    if (is_null($this->_targetDirPath)) throw new Exception('$_targetDirPath is null');

    $tmpDir = sys_get_temp_dir();
    if (!preg_match('/\\'.DIRECTORY_SEPARATOR.'$/', $tmpDir)) $tmpDir .= DIRECTORY_SEPARATOR;
    $this->_tmpZipPath = sprintf('%sbackup-%s-%s.zip', $tmpDir, time(), uniqid());

    $zip = new ZipArchive;
    $zip->open($this->_tmpZipPath, ZipArchive::CREATE);
    $this->_addDirectoryToZip($zip, $this->_targetDirPath, $this->_targetDirPath);
    $zip->close();
  }

  private function _addDirectoryToZip($zip, $dir, $base)
  {
    $newFolder = str_replace($base, '', $dir);
    $zip->addEmptyDir($newFolder);
    foreach (glob($dir . '/*') as $file) {
      if (is_dir($file)) {
        $zip = $this->_addDirectoryToZip($zip, $file, $base);
      } else {
        $newFile = str_replace($base, '', $file);
        $r = $zip->addFile($file, $newFile);
        if ($r !== TRUE) throw new Exception(sprintf('Failed to add %s to zip', $file));
      }
    }
    return $zip;
  }

  private function _filterFiles($files, $base = '')
  {
    $base = rtrim($base, DIRECTORY_SEPARATOR);

    $ignoreFilesPath = array();
    foreach ($this->ignoreFiles as $key => $ignoreFile) {
      $ignoreFilesPath[$key] = $base.$ignoreFile;
    }

    $basename;
    foreach ($files as $key => $file) {
      foreach ($ignoreFilesPath as $ignoreFile) {
        $pat = str_replace(DIRECTORY_SEPARATOR, "\\".DIRECTORY_SEPARATOR, $ignoreFile);
        if (preg_match("/^{$pat}/i", $file)) {
          unset($files[$key]);
          break;
        }
      }
    }

    return $files;
  }

  private function _extractZip($zipUrl, $destination)
  {
    $uniqId = uniqid('auto-update');

    $getTmpZip = $this->_getTmpPath($uniqId.'.zip');
    $r = copy($zipUrl, $getTmpZip);
    if (!$r) throw new Exception(sprintf('Failed to download %s', $zipUrl));

    $zip = new ZipArchive;
    $r = $zip->open($getTmpZip);
    if (!$r) throw new Exception(sprintf('Failed to open %s', $zipUrl));

    for ($i = 0; $i < $zip->numFiles; $i++) {
      $filename = str_replace($this->zipBase, '', $zip->getNameIndex($i));
      foreach ($this->ignoreFiles as $ignoreFile) {
        $pat = str_replace(DIRECTORY_SEPARATOR, "\\".DIRECTORY_SEPARATOR, $ignoreFile);
        if (preg_match("/^{$pat}/i", $filename)) {
          $zip->deleteIndex($i);
          break;
        }
      }
    }

    $extractDir = $this->_getTmpPath($uniqId);
    $zip->extractTo($extractDir);

    $dest = rtrim($this->_targetDirPath, DIRECTORY_SEPARATOR);
    $this->_copyRecursively($extractDir.DIRECTORY_SEPARATOR.$this->zipBase, $dest);

    return TRUE;
  }

  private function _getTmpPath($path = '')
  {
    $tmpDir = sys_get_temp_dir();
    if (!preg_match('/\\'.DIRECTORY_SEPARATOR.'$/', $tmpDir)) $tmpDir .= DIRECTORY_SEPARATOR;

    return sprintf('%s%s', $tmpDir, $path);
  }

  private function _canOverwrite()
  {
    $files = $this->_tree($this->_targetDirPath);
    $files = $this->_filterFiles($files, $this->_targetDirPath);

    foreach ($files as $file) {
      $r = $this->_isWritable($file);
      if ($r !== TRUE) throw new Exception(sprintf('Can not overwrite %s', $file));
    }
  }

  private function _copyRecursively($src, $dest)
  {
    $dir = opendir($src);
    @mkdir($dest);
    while (FALSE !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($src.DIRECTORY_SEPARATOR.$file)) {
          $this->_copyRecursively($src.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file);
        } else {
          copy($src.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file);
        }
      }
    }
    closedir($dir);
  }

  private function _isWritable($path)
  {
    if ($path{strlen($path)-1} == DIRECTORY_SEPARATOR) {
      return $this->_isWritable($path.uniqid(mt_rand()).'.tmp');
    }
    else if (is_dir($path)) {
      return $this->_isWritable($path.DIRECTORY_SEPARATOR.uniqid(mt_rand()).'.tmp');
    }

    $rm = file_exists($path);
    $f = @fopen($path, 'a');
    if ($f === FALSE) return FALSE;
    fclose($f);
    if (!$rm) unlink($path);
    return TRUE;
  }


  private function _tree($dir)
  {
    if (!preg_match('/\\'.DIRECTORY_SEPARATOR.'$/', $dir)) $dir .= DIRECTORY_SEPARATOR;
    $result = array();
    $root = scandir($dir);
    $result[] = $dir;
    foreach ($root as $value) {
      if ($value === '.' || $value === '..') continue;
      if (is_file($dir.$value)) {
        $result[] = $dir.$value;
        continue;
      }
      foreach($this->_tree($dir.$value) as $value) {
        $result[] = $value;
      }
    }
    return $result;
  }

  public function setTargetDirPath($path)
  {
    $this->_targetDirPath = $path;

    if (!preg_match('/\\'.DIRECTORY_SEPARATOR.'$/', $this->_targetDirPath))
      $this->_targetDirPath .= DIRECTORY_SEPARATOR;
  }

  public function update()
  {
    try {
      $this->_canOverwrite();
      $this->_extractZip($this->zipUrl, $this->_targetDirPath);
      return TRUE;
    } catch (Exception $e) {
      $this->errors[] = $e->getMessage();
      return FALSE;
    }
  }
}


