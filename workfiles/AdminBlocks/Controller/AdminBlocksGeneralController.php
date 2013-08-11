<?php
App::uses('AppAdminController', 'Controller');

class AdminBlocksGeneralController extends AppAdminController
{
  public $uses = array('BlockPackage');

  public function installed()
  {
    $blockPackages = $this->BlockPackage->installed();

    $this->set(array(
      'blockPackages' => $blockPackages,
    ));
  }

  public function search()
  {
  }

}

