<?php
App::uses('AppController', 'Controller');

class MyController extends AppController
{
  public $uses = array('Block',);

  public function add_block($pageId, $package, $sheet = 'main', $beforeBlockId = 0)
  {
    $r = $this->Block->addByPackage($pageId, $package, $sheet, $beforeBlockId);
    v($r);
    exit;
  }

}

