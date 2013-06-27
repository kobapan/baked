<?php
App::uses('AppModel', 'Model');

class Page extends AppModel
{
  public $name = 'Page';
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | valid_isExist'
    ),
  );
  public $columnLabels = array();

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
        "{$this->name}.parent_page_id" => 'asc',
        "{$this->name}.order" => 'asc',
      )
    ));

    $menuList = array();
    $menuPointers = array();
    $parentPageIdForPointer = NULL;
    $currentPageIdForPointer = NULL;

    foreach ($pages as $page) {
      $pageId = $page['Page']['id'];
      $parentPageId = $page['Page']['parent_page_id'];
      $pageP;
      $depth = 0;

      if ($parentPageId == 0) {
        $page['Page']['url'] = URL.$page['Page']['name'];
        $page['sub'] = array();
        $menuList[] = $page;
        $pageP = &$menuList[count($menuList)-1];
      } else {
        $parentPage = &$menuPointers[$parentPageId];
        $page['Page']['url'] = $parentPage['Page']['url'].'/'.$page['Page']['name'];
        $page['sub'] = array();
        $depth = $parentPage['depth'] + 1;
        $parentPage['sub'][] = $page;
        $pageP = &$parentPage['sub'][count($parentPage['sub'])-1];
      }

      $pageP['depth'] = $depth;
      $pageP['current'] = (count($path) > $pageP['depth'] && $path[$depth] == $pageP['Page']['name']);

      $menuPointers[$pageId] = &$pageP;

      if ($pageP['current']) {
        if ($parentPageIdForPointer == NULL && $depth == 0) {
          $parentPageIdForPointer = $pageId;
        }
        $currentPageIdForPointer = $pageId;
      }
    }

    $parentMenuP = FALSE;
    if ($parentPageIdForPointer) $parentMenuP = $menuPointers[$parentPageIdForPointer];
    $currentMenuP = $menuPointers[$currentPageIdForPointer];

    $pageId = $currentPageIdForPointer;

    return $menuList;
  }

}












