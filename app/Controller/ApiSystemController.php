<?php
App::uses('AppController', 'Controller');

class ApiSystemController extends AppController
{
  public $uses = array('System', 'Staff');
  public $components = array('Api');

  public function beforeFilter()
  {
    parent::beforeFilter();
  }

  public function sign_in()
  {
    $this->tokenFilterApi();

    try {
      $this->Staff->auth($this->request->data['Staff']);
    } catch (Exception $e) {
      $this->Api->ng($e->getMessage());
    }

    $this->Api->ok();
  }

  public function sign_out()
  {
    $this->tokenFilterApi();

    try {
      $this->Staff->signOut();
    } catch (Exception $e) {
      $this->Api->ng($e->getMessage());
    }

    $this->Api->ok();
  }

  public function go_editmode()
  {
    $this->tokenFilterApi();

    if (empty($_SESSION['Staff'])) $this->Api->ng(__('サインインしてください。'));

    $_SESSION['Staff']['Editmode'] = TRUE;
    $this->Api->ok();
  }

  public function cancel_editmode()
  {
    $this->tokenFilterApi();

    $_SESSION['Staff']['Editmode'] = FALSE;
    $this->Api->ok();
  }

  public function signed_in()
  {
    $result = array();

    if (!empty($_SESSION['Staff'])) {
      $result['signed'] = TRUE;
    } else {
      $result['signed'] = FALSE;
    }
    $result['editmode'] = (@$_SESSION['Staff']['Editmode'] === TRUE);

    $this->Api->ok($result);
  }

  public function html_signin()
  {
    $this->layout = 'ajax';
  }

}

