<?php
App::uses('AppModel', 'Model');

class Page extends AppModel
{
  public $name = 'Page';
  public $valid = array(
    'add' => array(
      'title'          => 'required | maxLen[255]',
      'name'           => 'required | maxLen[255] | alphaNumeric',
      'parent_page_id' => 'isExist[Page,id]',
      'hidden'         => 'valid_no_hidden',
    ),
    'update' => array(
      'id' => 'required | valid_isExist'
    ),
  );
  public $columnLabels = array();

  public function __construct($id = false, $table = null, $ds = null)
  {
    $this->columnLabels = array(
      'title'  => __('Page title'),
      'name'   => __('Page name'),
      'hidden' => __('Hide setting'),
    );

    return parent::__construct($id, $table, $ds);
  }

  public function loadValidate()
  {
    parent::loadValidate();

    if (isset($this->validate['hidden']['valid_no_hidden'])) {
      $this->validate['hidden']['valid_no_hidden']['message'] = __('Cat not set the index page hidden.');
    }
  }

/**
 * @param array $pages Ordered pages.
 * @return mixed true on success. Exception on failed.
 */
  public function update($pages)
  {
    try {
      $this->begin();

      $parentPageIds = array(0);
      $beforePage = NULL;
      $hasIndex = FALSE;

      foreach ($pages as $page) {
        $page = arrayWithKeys($page, array('id', 'name', 'title', 'depth', 'order', 'hidden'));

        if ($page['depth'] == 0 && $page['name'] == 'index') {
          $hasIndex = TRUE;
        }

        if (!empty($beforePage)) {
          if ($beforePage['depth'] < $page['depth']) {
            $parentPageIds[] = $beforePage['id'];
          }
          elseif ($beforePage['depth'] > $page['depth']) {
            $diff = $beforePage['depth']-$page['depth'];
            for ($i=0; $i < $diff; $i++) array_pop($parentPageIds);
          }
        }
        $page['parent_page_id'] = $parentPageIds[count($parentPageIds)-1];
        $r = $this->add($page, TRUE);
        if ($r !== TRUE) throw $r;

        $beforePage = $page;
      }

      if (!$hasIndex) throw new Exception('There is no index page.');

      $subQuery = "EXISTS (SELECT TmpPage.id FROM pages as TmpPage WHERE TmpPage.id <> Page.id AND TmpPage.name = Page.name AND TmpPage.parent_page_id = Page.parent_page_id)";
      $page = $this->find('first', array(
        CONDITIONS => array($subQuery),
        FIELDS => array('Page.id', 'Page.name'),
      ));
      if (!empty($page)) throw new Exception(__('There is more than one page of the same name (%s) in the same directory.', $page['Page']['name']));

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

/**
 * Get menu list.
 *
 * @param array $path
 * @param pointer &$parentMenuP
 * @param pointer &$currentMenu
 * @param pointer &$pageId
 * @return array
 */
  public function menu($path, &$parentMenuP, &$currentMenuP, &$pageId)
  {
    $pages = $this->find('all', array(
      CONDITIONS => array(
        "{$this->name}.hidden" => 0,
      ),
      FIELDS => array(
        "{$this->name}.id", "{$this->name}.name", "{$this->name}.title", "{$this->name}.parent_page_id",
      ),
      ORDER => array(
        #"{$this->name}.parent_page_id" => 'asc',
        "{$this->name}.order" => 'asc',
      )
    ));

    $menuList = array();
    $pagePointers = array();
    $parentPageId = NULL;

    foreach ($pages as &$page) {
      $pointer;
      $depth = 0;
      if ($page['Page']['parent_page_id'] == 0) {
        $page['Page']['url'] = URL.$page['Page']['name'];
        $pointer = &$menuList;
      } else {
        $p = &$pagePointers[$page['Page']['parent_page_id']];
        $page['Page']['url'] = $p['Page']['url'].'/'.$page['Page']['name'];
        $pointer = &$p['sub'];
      }
      $page['sub'] = array();
      $page['current'] = (count($path) > $depth && $path[$depth] == $page['Page']['name']);

      $pagePointers[$page['Page']['id']] = $page;
      $pointer[] = &$pagePointers[$page['Page']['id']];

      if ($page['current']) {
        $parentPageId = $page['Page']['parent_page_id'];
        $pageId = $page['Page']['id'];
      }
    }

    $currentMenuP = $pagePointers[$pageId];
    if (!empty($parentPageId)) {
      $parentMenuP = $pagePointers[$parentPageId];
    } else {
      $parentMenuP = $pagePointers[$pageId];
    }

    return $menuList;
  }

  public function valid_no_hidden($data)
  {
    list($k, $v) = each($data);
    if ($v === '') return TRUE;
    if (!isset($this->data[$this->name]['name'])) return;
    if (!isset($this->data[$this->name]['parent_page_id'])) return;

    if ($v == 0) return TRUE;
    if ($this->data[$this->name]['name'] !== 'index') return TRUE;
    if ($this->data[$this->name]['parent_page_id'] !== 0) return TRUE;

    return FALSE;
  }

}












