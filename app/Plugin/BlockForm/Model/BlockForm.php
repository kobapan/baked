<?php
App::uses('BlockAppModel', 'Model');

class BlockForm extends BlockAppModel
{
  public $name = 'BlockForm';
  public $useTable = FALSE;
  public $valid = array(
    'add' => array(
    ),
    'update' => array(
      'id' => 'required | isExist'
    ),
    'item' => array(
      'item_id' => 'required',
      'name'    => 'required',
      'type'    => 'required',
    ),
  );
  public $columnLabels = array();
  public static $TYPE;
  public static $TYPES_HAS_OPTIONS = array('select', 'checkbox', 'radio');

  public function __construct($id = false, $table = null, $ds = null)
  {
    $this->columnLabels = array(
      'name' => __('Item name'),
      'type' => __('Item type'),
    );
    self::$TYPE = array(
      'text'      => __('Text'),
      'textarea'  => __('Textarea'),
      'email'     => __('Email'),
      'tel'       => __('Tel'),
      'ja_states' => __('Japanese states'),
      'select'    => __('Select'),
      'checkbox'  => __('Check box'),
      'radio'     => __('Radio button'),
    );

    return parent::__construct($id, $table, $ds);
  }

  public function initialData()
  {
    return array(
      'sent_text' => __('The message has been sent.'),
      'lastId' => 4,
      'items' => array(
        1 => array(
          'item_id'  => 1,
          'name'     => __('Name'),
          'type'     => 'text',
          'required' => 1,
        ),
        2 => array(
          'item_id'  => 2,
          'name'     => __('Email'),
          'type'     => 'email',
          'required' => 1,
        ),
        3 => array(
          'item_id'  => 3,
          'name'     => __('Tel'),
          'type'     => 'tel',
          'required' => 0,
        ),
        4 => array(
          'item_id'  => 4,
          'name'     => __('Message'),
          'type'     => 'textarea',
          'required' => 1,
        ),
      ),
    );
  }

  public function send($blockId, $params)
  {
    try {
      $data = $this->getData($blockId);

      $sendValid = array();
      $emailVars = array();
      foreach ($data['items'] as $item) {
        $rules = array();
        if ($item['required']) $rules[] = 'required';
        if ($item['type'] == 'email') $rules[] = 'email';
        if ($item['type'] == 'tel') $rules[] = 'phone';
        if (!empty($rules)) $sendValid[$item['item_id']] = implode('|', $rules);

        $emailVars[$item['item_id']] = array(
          'item' => $item,
          'value' => @$params[$item['item_id']],
        );
      }
      $this->addLabelInValidate = FALSE;
      $this->valid['send'] = $sendValid;

      $r = $this->add($params, NULL, 'send', self::VALIDATION_MODE_ONLY);
      if ($r !== TRUE) throw new Exception(__('There is validation errors'));

      App::uses('CakeEmail', 'Network/Email');
      $email = new CakeEmail('default');
      $r = $email
        ->template('BlockForm.contact', 'BlockForm.default')
        ->to(MY_EMAIL)
        ->viewVars(array(
          'items' => $emailVars
        ))
        ->subject(__('Contact from Baked'))
        ->send();

      return TRUE;
    } catch (Exception $e) {
      return $e;
    }
  }

  public function addItem($item)
  {
    try {
      $this->begin();

      $blockId = $item['block_id'];
      $data = $this->getData($blockId);
      if (empty($data)) throw new Exception(__('Failed to get data'));

      if (isset($item['options_text'])) {
        $item['options'] = str_replace(array("\r\n", "\r"), "\n", $item['options_text']);
        $item['options'] = explode("\n", $item['options']);
        $item['options'] = array_map('trim', $item['options']);
        $item['options'] = array_filter($item['options'], 'strlen');
        $item['options'] = array_unique($item['options']);
        $item['options'] = array_values($item['options']);
      }

      $keys = array('item_id', 'name', 'type', 'required');
      if (in_array($item['type'], self::$TYPES_HAS_OPTIONS)) $keys[] = 'options';
      $item = arrayWithKeys($item, $keys);

      if (empty($item['item_id'])) {
         $data['lastId']++;
         $item['item_id'] = $data['lastId'];
      }

      $r = $this->add($item, NULL, 'item', self::VALIDATION_MODE_ONLY);
      if ($r !== TRUE) throw $r;

      $data['items'][$item['item_id']] = $item;
      $r = $this->updateData($blockId, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

  public function saveSort($blockId, $itemIds)
  {
    try {
      $this->begin();

      $data = $this->getData($blockId);
      if (empty($data)) throw new Exception('Not found block.');

      $newItems = array();
      foreach ($itemIds as $itemId) {
        $newItems[$itemId] = $data['items'][$itemId];
      }
      $data['items'] = $newItems;

      $r = $this->updateData($blockId, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return FALSE;
    }
  }

  public function deleteItem($blockId, $itemId)
  {
    try {
      $this->begin();

      $data = $this->getData($blockId);
      if (empty($data)) throw new Exception(__('Failed to get data'));

      foreach ($data['items'] as $id => $item) {
        if ($itemId == $id) unset($data['items'][$id]);
      }

      $r = $this->updateData($blockId, $data);
      if ($r !== TRUE) throw $r;

      $this->commit();
      return TRUE;
    } catch (Exception $e) {
      $this->rollback();
      return $e;
    }
  }

}



