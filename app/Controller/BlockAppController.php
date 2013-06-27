<?php
App::uses('AppController', 'Controller');

class BlockAppController extends AppController
{
  public $uses = array();
  public $components = array('Api');

  public function beforeFilter()
  {
    parent::beforeFilter();
  }

  protected function tokenFilterApi()
  {
    return TRUE;
  }

}



