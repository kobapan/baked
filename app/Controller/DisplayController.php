<?php
App::uses('AppController', 'Controller');

class DisplayController extends AppController
{
  public $uses = array('Block',);

/**
 * Displays a page
 *
 * @param mixed What page to display
 * @return void
 */
  public function show()
  {
    $path = func_get_args();
    if (count($path) == 0) $path[] = 'index';

    $this->plugin = 'ThemeSkyblue';

    $menuList = $this->Page->menu($path, $parentMenu, $currentMenu, $pageId);

    $blocks = $this->Block->find('all', array(
      CONDITIONS => array(
        'Block.page_id' => $pageId,
      ),
      ORDER => array(
        'Block.order' => 'asc',
      ),
      FIELDS => array(
        'Block.id', 'Block.package', 'Block.sheet', 'Block.order', 'Block.data', 'Block.created', 'Block.modified',
      ),
    ));
    $loadedModels = array();
    foreach ($blocks as $block) {
      if (in_array($block['Block']['package'], $loadedModels)) continue;
      $this->uses[] = sprintf('%s.%s', $block['Block']['package'], $block['Block']['package']);
      $loadedModels[] = $block['Block']['package'];
      $this->{$block['Block']['package']}->create();
    }

    $blockEquipments = $this->_setupBlocks();

    $this->set(array(
      'menuList' => $menuList,
      'parentMenu' => $parentMenu,
      'currentMenu' => $currentMenu,
      'blocks' => $blocks,
      'blockEquipments' => $blockEquipments,
    ));

    $this->render(FALSE);
  }

  private function _setupBlocks()
  {
    $blockEquipments = array(
      'js' => array(),
    );

    App::uses('Folder', 'Utility');
    $folder = new Folder(APP.'Plugin');
    list($plugins, $files) = $folder->read();
    $pluginRoot = APP.'Plugin'.DS;
    foreach ($plugins as $plugin) {
      if (!preg_match('/^Block/', $plugin)) continue;
      $pluginWebroot = $pluginRoot.$plugin.DS.'webroot'.DS;

      $editorJsPath = $pluginWebroot.'js'.DS.'editor.js';
      if (file_exists($editorJsPath)) {
        $blockEquipments['js'][] = array(
          'file' => sprintf('%s/js/editor.js', $plugin),
          'editting' => TRUE,
        );
      }
    }

    return $blockEquipments;
  }

}

