<?php
App::uses('AppModel', 'Model');

class Staff extends AppModel
{
  public $valid = array(
  );
  public $useTable = FALSE;

  public function auth($params)
  {
    if (empty($params['email'])) throw new Exception(__('Email is required.'));
    if (empty($params['password'])) throw new Exception(__('Password is required.'));
    if ($params['email'] != MY_EMAIL || $params['password'] != MY_PASSWORD)
      throw new Exception(__('Email or password is incorrect'));

    $this->signIn();

    return TRUE;
  }

  public function signIn()
  {
    $_SESSION['Staff'] = array(
      'name'  => MY_NAME,
      'email' => MY_EMAIL,
      'editmode' => FALSE,
    );
  }

  public function signOut()
  {
    $_SESSION['Staff'] = FALSE;
  }
}

