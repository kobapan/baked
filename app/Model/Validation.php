<?php
App::uses('AppModel', 'Model');

class Validation extends AppModel
{
  public $name = 'Validation';
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
    ),
    'database' => array(
      'host'     => 'required',
      'user'     => 'required',
      'password' => 'required',
      'name'     => 'required',
      #'prefix'   => 'required',
    ),
    'site' => array(
      'site_name'     => 'required',
    ),
  );
  #public $columnLabels = array();
  public $useTable = FALSE;


}












