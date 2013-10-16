<?php
App::uses('AppAdminController', 'Controller');

class AdminSettingsUpdateController extends AppAdminController
{
  public $uses = array('System');

  public function index()
  {
    $this->title = __('アップデート');
  }

  public function auto_update()
  {
    $this->tokenFilter();

    App::uses('AutoUpdater', 'Vendor');
    $autoUpdater = new AutoUpdater;
    $autoUpdater->setTargetDirPath(ROOT);
    #$autoUpdater->zipUrl = 'http://bakedcms.dev/download/download/0.0.6';
    $autoUpdater->zipUrl = 'http://bakedcms.org/download/download/0.0.6';
    $r = $autoUpdater->update();
    v($r);
    v($autoUpdater->error);

    exit;
  }

}

