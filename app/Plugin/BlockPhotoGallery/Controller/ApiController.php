<?php
App::uses('BlockPhotoGalleryAppController', 'BlockHeading.Controller');

class ApiController extends BlockPhotoGalleryAppController
{
  public $uses = array('BlockPhotoGallery.BlockPhotoGallery');

  public function update()
  {
    $this->tokenFilterApi();

    $data = array(
      'h'    => @$this->request->data['h'],
      'text' => @$this->request->data['text'],
    );
    $r = $this->BlockHeading->updateData(@$this->request->data['block_id'], $data);
    if ($r !== TRUE) $this->Api->ng($r->getMessage());

    $this->Api->ok(array(
      'html' => $this->htmlBlock($this->request->data['block_id']),
    ));
  }

}

