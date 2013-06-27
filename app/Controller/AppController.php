<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
  public $uses = array('System', 'Page', );

  public function beforeFilter()
  {
    parent::beforeFilter();

    if (!defined('URL')) define('URL', Router::url('/'));
    if (!defined('BK_URL')) define('BK_URL', Router::url('/'));
    if (!defined('BK_SITE_NAME')) define('BK_SITE_NAME', $this->System->value(System::KEY_SITE_NAME));
    if (!defined('BK_SITE_CAPTION')) define('BK_SITE_CAPTION', $this->System->value(System::KEY_SITE_CAPTION));

    if (!defined('EDITTING')) define('EDITTING', !empty($this->request->query['e']));

    $this->_setToken();
  }

  private function _setToken()
  {
    session_start();
    if (empty($_SESSION['token'])) $_SESSION['token'] = getRandomString(32);
    $this->set(array(
      '_token' => $_SESSION['token'],
    ));
  }

}


