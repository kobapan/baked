<?php
App::uses('BlockAppModel', 'Model');

class BlockHeading extends BlockAppModel
{
  public $name = 'BlockHeading';
  public $useTable = FALSE;
  public $valid = array(
    'add' => array(
      'h'    => 'required | inClassArrayKeys[H]',
      'text' => 'required | maxLen[50]',
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
  );
  public $columnLabels = array();
  public static $H = array(
    1 => 'Large',
    2 => 'Medium',
    3 => 'Small',
  );

  public function __construct($id = false, $table = null, $ds = null)
  {
    parent::__construct($id, $table, $ds);
    $this->columnLabels = array(
      'h'    => __('Size'),
      'text' => __('Text'),
    );
  }

}



