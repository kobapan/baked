<?php
App::uses('BlockPhotoGalleryAppController', 'BlockPhotoGallery.Controller');

class ApiController extends BlockPhotoGalleryAppController
{
  public $uses = array('BlockPhotoGallery.BlockPhotoGallery', 'File');

  public function upload()
  {
    $this->tokenFilterApi();

    try {
      $r = $this->File->saveWithFilePost($_FILES['file'], 'image');
      if ($r !== TRUE) throw $r;

      $file = $this->File->find('first', array(
        CONDITIONS => array('File.id' => $this->File->id),
      ));

      $data = $this->BlockPhotoGallery->getData($this->request->data['block_id']);
      if (!isset($data['photos'])) $data['photos'] = array();
      $photo = array(
        'file_id' => $file['File']['id'],
        'file'    => $file['File'],
        'title'   => NULL,
        'caption' => NULL,
        'alt'     => NULL,
      );
      $data['photos'][] = $photo;
      $r = $this->BlockPhotoGallery->updateData($this->request->data['block_id'], $data);
    } catch (Exception $e) {
      $this->Api->ng($r->getMessage());
    }

    $this->Api->ok();
  }

  public function increase()
  {
    $this->tokenFilterApi();

    try {
      $data = $this->BlockPhotoGallery->getData($this->request->data['block_id']);
      $data['width'] = (int)$data['width'];
      if ($data['width'] >= 200) throw new Exception(__('Can not to enlarge any more.'));
      $data['width'] += 20;

      $r = $this->BlockPhotoGallery->updateData($this->request->data['block_id'], $data);
      if ($r !== TRUE) throw $r;
    } catch (Exception $e) {
      $this->Api->ng($e->getMessage());
    }

    $this->Api->ok(array(
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

  public function decrease()
  {
    $this->tokenFilterApi();

    try {
      $data = $this->BlockPhotoGallery->getData($this->request->data['block_id']);
      $data['width'] = (int)$data['width'];
      if ($data['width'] <= 50) throw new Exception(__('Can not to reduce any more.'));
      $data['width'] -= 20;

      $r = $this->BlockPhotoGallery->updateData($this->request->data['block_id'], $data);
      if ($r !== TRUE) throw $r;
    } catch (Exception $e) {
      $this->Api->ng($e->getMessage());
    }

    $this->Api->ok(array(
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

}

