<?php
App::uses('AppController', 'Controller');

class ApiBlocksController extends AppController
{
  public $uses = array('Block');
  public $components = array('Api');

  public function beforeFilter()
  {
    parent::beforeFilter();
  }

/**
 * Add the block.
 *
 * @param string $plugin
 * @param int $beforeBlockId
 * @return void
 */
  public function add()
  {
    $r = $this->Block->addByPackage(
      @$this->request->data['page_id'],
      @$this->request->data['package'],
      @$this->request->data['sheet'],
      @$this->request->data['before_block_id'],
      $addedBlockId
    );
    if ($r !== TRUE) $this->Api->ng($r->getMessage());

    $this->Api->ok(array(
      'html' => $this->htmlBlock($addedBlockId),
    ));
  }


/**
 * Delete the block.
 *
 * @param int $blockId
 * @return void
 */
  public function delete()
  {
    $r = $this->Block->delete(@$this->request->data['block_id'], TRUE);
    if ($r !== TRUE) $this->Api->ng($r->getMessage());

    $this->Api->ok();
  }

}



