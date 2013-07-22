<?php
App::uses('BlockAppController', 'Controller');

class BlockTextPhotoApiController extends BlockAppController
{
  public $uses = array('BlockTextPhoto.BlockTextPhoto', 'File');

  public function upload()
  {
    $this->tokenFilterApi();

    try {
      $this->BlockTextPhoto->begin();

      $r = $this->File->saveWithFilePost($_FILES['file'], 'image');
      if ($r !== TRUE) throw $r;

      $file = $this->File->find('first', array(
        CONDITIONS => array('File.id' => $this->File->id),
      ));

      $data = $this->BlockTextPhoto->getData($this->request->data['block_id']);
      if (!empty($data['photo'])) {
        $r = $this->File->delete($data['photo']['id']);
        if ($r !== TRUE) throw new Exception(__('Failed to delete old photo.'));
      }

      if ($data === FALSE) throw new Exception(__('Not found block'));
      $data['photo'] = $file['File'];
      $r = $this->BlockTextPhoto->updateData($this->request->data['block_id'], $data);
      if ($r !== TRUE) throw $r;
      $this->BlockTextPhoto->commit();
    } catch (Exception $e) {
      $this->BlockTextPhoto->rollback();
      $this->Api->ng($e->getMessage());
    }

    $this->Api->ok(array(
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

  public function update()
  {
    $this->tokenFilterApi();

    $data = arrayWithKeys($this->request->data, array('text', 'align', 'size'));
    if (isset($data['size'])) $data['size'] = round($data['size'], -1);
    $r = $this->BlockTextPhoto->updateData(@$this->request->data['block_id'], $data);
    if ($r !== TRUE) $this->Api->ng($r->getMessage());

    $this->Api->ok(array(
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

}
