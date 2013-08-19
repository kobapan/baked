<?php
App::uses('AppController', 'Controller');

class DisplayController extends AppController
{
  public $uses = array('Block', 'Page');
  public $components = array('RequestHandler');

/**
 * Displays a page
 *
 * @param mixed What page to display
 * @return void
 */
  public function show()
  {
    if (!defined('MY_CONFIGURED')) {
      $this->redirect('/system/setup/start');
    }

    $path = func_get_args();
    if (count($path) == 0) $path[] = 'index';

    $this->_selectTheme();

    $menuList = $this->Page->menu($path, $currentMenu, $pageId);

    $blocks = array();
    $view = 'show';

    if (empty($currentMenu)) {
      $view = '404';
    } else {
      $options = $this->Block->getOptions(array(Block::OPTION_ORDER_STANDARD), array(
        CONDITIONS => array('Block.page_id' => $pageId,),
        FIELDS => array(
          'Block.id', 'Block.package', 'Block.sheet', 'Block.order', 'Block.data', 'Block.created', 'Block.modified',
        ),
      ));
      $blocks = $this->Block->find('all', $options);
      $loadedModels = array();
      foreach ($blocks as $block) {
        if (in_array($block['Block']['package'], $loadedModels)) continue;
        $this->uses[] = sprintf('%s.%s', $block['Block']['package'], $block['Block']['package']);
        $loadedModels[] = $block['Block']['package'];
        $this->{$block['Block']['package']}->create();
      }
      foreach ($blocks as &$block) {
        $block = $this->{$block['Block']['package']}->convert($block);
      }
    }

    $this->_setupBlocks();

    $this->set(array(
      'menuList' => $menuList,
      'currentMenu' => $currentMenu,
      'blocks' => $blocks,
    ));

    $this->layout = 'default';
    $this->render($view);
  }

  private function _selectTheme()
  {
    if ($this->RequestHandler->isMobile()) {
      $this->plugin = $this->System->value(System::KEY_USE_THEME_MOBILE);
    } else {
      $this->plugin = $this->System->value(System::KEY_USE_THEME);
    }
  }

  private function _setupBlocks()
  {
    $blockEquipments = array(
      'js'  => array(),
      'css' => array(),
    );

    App::uses('Folder', 'Utility');
    $folder = new Folder(APP.'Plugin');
    list($plugins, $files) = $folder->read();
    $pluginRoot = APP.'Plugin'.DS;

    foreach ($plugins as $plugin) {
      if (!preg_match('/^Block/', $plugin)) continue;
      $pluginWebroot = $pluginRoot.$plugin.DS.'webroot'.DS;

      $blockJsPath = $pluginWebroot.'js'.DS.'block.js';
      if (file_exists($blockJsPath)) {
        $blockEquipments['js'][] = array(
          'file' => sprintf('%s/js/block.js', $plugin),
        );
      }

      $editorJsPath = $pluginWebroot.'js'.DS.'editor.js';
      if (file_exists($editorJsPath)) {
        $blockEquipments['js'][] = array(
          'file' => sprintf('%s/js/editor.js', $plugin),
          'editting' => TRUE,
        );
      }

      $blockCssPath = $pluginWebroot.'css'.DS.'block.css';
      if (file_exists($blockCssPath)) {
        $blockEquipments['css'][] = array(
          'file' => sprintf('%s/css/block.css', $plugin),
        );
      }

      $editorCssPath = $pluginWebroot.'css'.DS.'editor.css';
      if (file_exists($editorCssPath)) {
        $blockEquipments['css'][] = array(
          'file' => sprintf('%s/css/editor.css', $plugin),
          'editting' => TRUE,
        );
      }
    }

    $this->set(array(
      'blockEquipments' => $blockEquipments,
    ));
  }

}

