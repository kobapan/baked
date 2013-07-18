<?php
App::uses('BlockAppModel', 'Model');

class BlockPhotoGallery extends BlockAppModel
{
  public $name = 'BlockPhotoGallery';
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
    );
  }

  public function convert($block)
  {
    return $block;
  }

/**
 * Return initiali data
 *
 * @return mixed array on success. true to ignore. false to occur error.
 */
  public function initialData()
  {
    return array(
      'width'  => 80,
      'photos' => array(),
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

  public function insert()
  {

  }

}



