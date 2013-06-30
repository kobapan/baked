<?php
App::uses('BlockAppModel', 'Model');

class BlockPhotoGallery extends BlockAppModel
{
  public $name = 'BlockPhotoGallery';
  public $valid = array(
    'add' => array(
      'text' => 'required | maxLen[50]',
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
    );
  }

/**
 * Return initiali data
 *
 * @return mixed array on success. true to ignore. false to occur error.
 */
  public function initialData()
  {
    return array();
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



