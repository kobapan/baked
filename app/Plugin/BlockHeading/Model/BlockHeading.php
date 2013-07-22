<?php
App::uses('BlockHeadingAppModel', 'BlockHeading.Model');

class BlockHeading extends BlockHeadingAppModel
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
  public static $H;

  public function __construct($id = false, $table = null, $ds = null)
  {
    parent::__construct($id, $table, $ds);
    self::$H = array(
      1 => 'Large',
      2 => 'Medium',
      3 => 'Small',
    );
    $this->columnLabels = array(
      'h'    => __('Size'),
      'text' => __('Text'),
    );
  }

/**
 * Return initiali data
 *
 * @return mixed array on success. true to ignore. false to occur error.
 */
  public function initialData()
  {
    return array(
      'h' => 1,
      'text' => __('Heading'),
    );
  }

/**
 * Callback before delete.
 *
 * @param int $blockId
 * @boolean
 */
  public function willDelete()
  {
    return TRUE;
  }



}



