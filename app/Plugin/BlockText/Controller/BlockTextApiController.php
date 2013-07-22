<?php
App::uses('BlockAppController', 'Controller');

class BlockTextApiController extends BlockAppController
{
  public $uses = array('Block', 'BlockText.BlockText');

  public function update()
  {
    $this->tokenFilterApi();

    $data = array(
      'text' => @$this->request->data['Block']['text'],
    );
    $r = $this->BlockText->updateData(@$this->request->data['block_id'], $data);
    if ($r !== TRUE) $this->Api->ng($r->getMessage());

    $this->Api->ok(array(
      't' => 'OK',
      'html' => $this->_htmlBlock($this->request->data['block_id']),
    ));
  }

}

