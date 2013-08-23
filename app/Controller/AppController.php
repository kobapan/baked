<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
  public $uses = array('System', 'Block');

  public function beforeFilter()
  {
    parent::beforeFilter();

    if (session_id() != '') {
      die("４０４〜");
      header('HTTP/1.0 404 Not Found');
      die('404 Not Found');
    }
    session_start();

    define('URL', Router::url('/'));
    $url = Router::url(array(), TRUE);
    define('CURRENT_URL', $url);
    define('EDITTING', (@$_SESSION['Staff']['Editmode'] === TRUE));

    if (defined('MY_CONFIGURED')) {
      define('BK_SITE_NAME', $this->System->value(System::KEY_SITE_NAME));
    }

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


