<?php
App::uses('AppModel', 'Model');

class System extends AppModel
{
  public $name = 'System';
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | valid_isExist'
    ),
  );
  public $columnLabels = array();
  const KEY_USE_THEME = 'USE_THEME';
  const KEY_SITE_NAME = 'SITE_NAME';
  const KEY_SITE_CAPTION = 'SITE_CAPTION';

  public function afterFind($results, $primary = false)
  {
    foreach ($results as &$result) {
      if (empty($result[$this->name])) continue;

      $result[$this->name]['value'] = json_decode($result[$this->name]['value']);
    }

    return $results;
  }

  public function add($data, $update = NULL, $useValid = NULL, $validateMode = FALSE)
  {
    $data = $this->getDeepArray($data);
    if (isset($data['value'])) $data['value'] = json_encode($data['value']);

    return parent::add($data, $update, $useValid, $validateMode);
  }

  public function value($key)
  {
    $system = $this->find('first', array(
      'conditions' => array(
        'key' => $key,
      ),
      'fiedls' => array('value'),
      ));
      if (empty($system)) return FALSE;

      return $system[$this->name]['value'];
    }

  public function saveValue($key, $value)
  {
    $data = array(
      'key' => $key,
      'value' => $value,
    );

    $system = $this->find('first', array(
      'conditions' => array(
        'key' => $key,
      ),
      'fiedls' => array('id'),
    ));
    if (!empty($system)) $data['id'] = $system[$this->name]['id'];

    return $this->add($data);
  }

}












