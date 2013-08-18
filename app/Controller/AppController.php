<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
  public $uses = array('System', 'Block');

  public function beforeFilter()
  {
    parent::beforeFilter();

    if (session_id() != '') {
      header('HTTP/1.0 404 Not Found');
      die('404 Not Found');
    }
    session_start();

    if (!defined('URL')) define('URL', Router::url('/'));
    if (!defined('CURRENT_URL')) {
      $url = Router::url(array(), TRUE);
      define('CURRENT_URL', $url);
    }

    define('EDITTING', (@$_SESSION['Staff']['Editmode'] === TRUE));

    $this->_setToken();
  }

  private function _setToken()
  {
    if (empty($_SESSION['token'])) $_SESSION['token'] = getRandomString(32);
    $this->set(array(
      '_token' => $_SESSION['token'],
    ));
  }

  protected function tokenFilterApi()
  {
    if ($_SESSION['token'] !== $this->request->data['token']) {
      $this->Api->ng(__('不正なトークンです。'));
    }
    return TRUE;
  }

  protected function tokenFilter()
  {
    if ($_SESSION['token'] !== $this->request->data['token']) {
      die(__('不正なトークンです。'));
    }
    return TRUE;
  }

/**
 * Get html of block.
 *
 * @param int $blockId
 * @return html
 */
  protected function _htmlBlock($blockId)
  {
    $block = $this->Block->find('first', array(
      CONDITIONS => array('Block.id' => $blockId),
    ));

    $this->uses[] = "{$block['Block']['package']}.{$block['Block']['package']}";
    $this->{$block['Block']['package']}->create();

    $view = new View();
    return $view->element('Baked/block', array(
      'block' => $block,
    ));
  }

}


