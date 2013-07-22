<?php
App::uses('BlockTextAppModel', 'BlockText.Model');

class BlockText extends BlockTextAppModel
{
  public $name = 'BlockText';
  public $useTable = FALSE;
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
  );
  public $columnLabels = array();

  public function __construct($id = false, $table = null, $ds = null)
  {
    parent::__construct($id, $table, $ds);
    $this->columnLabels = array(
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
      'text' => __('Input text.'),
    );
  }

}



