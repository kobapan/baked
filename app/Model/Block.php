<?php
App::uses('AppModel', 'Model');

class Block extends AppModel
{
  public $name = 'Block';
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
  );
  public $columnLabels = array();

  public function afterFind($results, $primary = false)
  {
    foreach ($results as &$result) {
      if (empty($result[$this->name])) continue;

      if (isset($result[$this->name]['data']))
        $result[$this->name]['data'] = json_decode($result[$this->name]['data'], TRUE);
    }

    return $results;
  }

  public function beforeSave($options = array())
  {
    if (isset($this->data['Block']['data'])) $this->data['Block']['data'] = json_encode($this->data['Block']['data']);

    return true;
  }

/**
 * IDとdata配列を渡して更新
 *
 * @param int $id
 * @param array $data
 * @return mixed true on success. Exception on failed.
 */
  public function updateData($id, $data)
  {
    try {
      $this->begin();

      $block = $this->find('first', array(
        CONDITIONS => array('Block.id' => $id),
        FIELDS => array('Block.id', 'Block.data'),
      ));
      if (empty($block)) throw new Exception(__('Not found block'));

      $data += $block['Block']['data'];
      $modelData = array(
        'id'   => $id,
        'data' => $data,
      );
      $r = $this->add($modelData, TRUE);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

}




















