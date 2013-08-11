<?php
App::uses('AppModel', 'Model');

class ThemePackage extends AppModel
{
  public $name = 'ThemePackage';
  public $useTable = FALSE;

  public function installed()
  {
    $themePackages = Configure::read('Themes');
    return $themePackages;
  }

/**
 * ファイルパスに書き込み
 *
 * @param string $path
 * @param string $text
 * @return mixed true on success. Exception on failed.
 */
  public function write($path, $text)
  {
    try {
      $fp = @fopen($path, 'r+');
      if (!$fp) throw new Exception(__('Failed to open file (%s).', $path));

      $r = fwrite($fp, $text);
      if (!$r) throw new Exception(__('Failed to write text to %s.', $path));
      return TRUE;
    } catch (Exception $e) {
      return $e;
    }
  }

  public function set($package, $type)
  {
    try {
      $this->begin();

      $themePackage = Configure::read("Themes.{$package}");
      if (empty($themePackage)) throw new Exception(__('Not found the theme.'));

      if (!in_array($type, array('pc', 'mobile'))) throw new Exception(__('The type is invalid.'));
      if (!$themePackage['support'][$type]) throw new Exception(__('The theme cannot support to %s.', $type));

      $this->loadModel('System');

      if ($type == 'pc') {
        $key = System::KEY_USE_THEME;
      } else {
        $key = System::KEY_USE_THEME_MOBILE;
      }
      $this->System->saveValue($key, $package);

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

  public function remove($package)
  {
    try {
      $this->begin();

      $themePackage = Configure::read("Themes.{$package}");
      if (empty($themePackage)) throw new Exception(__('Not found the theme.'));

      $this->loadModel('System');
      $useTheme = $this->System->value(System::KEY_USE_THEME);
      $useThemeMobile = $this->System->value(System::KEY_USE_THEME_MOBILE);

      if (in_array($package, array($useTheme, $useThemeMobile))) {
        throw new Exception(__('Cannot delete the theme in use.'));
      }

      $this->loadModel('Plugin');
      $r = $this->Plugin->remove($package);
      if ($r !== TRUE) throw new Exception(__('Failed to delete plugin.'));

      Baked::deleteAllCache();

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

}
