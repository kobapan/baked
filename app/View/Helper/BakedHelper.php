<?php
App::uses('AppHelper', 'View/Helper');

class BakedHelper extends AppHelper
{
  public function setElements($list)
  {
    foreach ($list as $plugin => $items) {
      if (empty($items)) continue;
      if (is_string($items)) $items = array($items);
      foreach ($items as $item) {
        echo $this->_View->element($item, array(), array(
          'plugin' => $plugin,
        ));
      }
    }
  }
}
