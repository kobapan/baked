<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
  public $uses = array('System', 'Page', 'Block');

  public function beforeFilter()
  {
    parent::beforeFilter();

    if (!defined('URL')) define('URL', Router::url('/'));
    if (!defined('BK_URL')) define('BK_URL', Router::url('/'));
    if (!defined('BK_SITE_NAME')) define('BK_SITE_NAME', $this->System->value(System::KEY_SITE_NAME));
    if (!defined('BK_SITE_CAPTION')) define('BK_SITE_CAPTION', $this->System->value(System::KEY_SITE_CAPTION));

    #if (!defined('EDITTING')) define('EDITTING', !empty($this->request->query['e']));
    define('EDITTING', TRUE);

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

  protected function tokenFilterApi()
  {
    return TRUE;

    if ($_SESSION['token'] !== $this->request->data['token']) {
      $this->Api->ng(__('Invalid token.'));
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


