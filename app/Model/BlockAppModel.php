<?php
App::uses('AppModel', 'Model');

class BlockAppModel extends AppModel
{
  public $name = 'BlockAppModel';

  public function valid($data)
  {
    return $this->add($data, NULL, NULL, self::VALIDATION_MODE_ONLY);
  }

  public function updateData($id, $data)
  {
    try {
      $this->begin();

      $r = $this->valid($data);
      if ($r !== TRUE) throw $r;

      $this->loadModel('Block');
      $r = $this->Block->updateData($id, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

}




















