<?php
App::uses('Controller', 'Controller');

class AppController extends Controller
{
  public $requiredSecurityActions = '';
  
  public function beforeFilter()
  {
    parent::beforeFilter();
    $this->__checkSSL();
  }
  
  private function __checkSSL()
  {
    // SSLチェック
    if (is_string($this->requiredSecurityActions)) $this->requiredSecurityActions = array($this->requiredSecurityActions);
    
    if ($this->requiredSecurityActions !== '' && TYPE !== 'TEST') {
      // httpアクセス
      if ($_SERVER['SERVER_PORT'] == 80) {
        // SSLアクションの場合、httpsプロトコルでリダイレクト
        if (in_array('*', $this->requiredSecurityActions)
          || in_array($this->action, $this->requiredSecurityActions)
        ) {
          #die("GO HTTPS:".'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
          $this->redirect('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        }
      }
      // httpsアクセス
      else {
        // SSLアクションでない場合、httpプロトコルでリダイレクト
        if (!in_array('*', $this->requiredSecurityActions)
          && !in_array($this->action, $this->requiredSecurityActions))
        {
          #die("GO HTTP:".'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
          $this->redirect('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        }
      }
    }
  }
  
}

