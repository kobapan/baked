<?php
App::uses('BlockHeadingAppController', 'BlockHeading.Controller');

class ApiController extends BlockHeadingAppController
{
  public $uses = array('Block', 'BlockHeading.BlockHeading');

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
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

}

