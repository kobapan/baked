<?php
App::uses('AppModel', 'Model');

class Staff extends AppModel
{
  public $valid = array(
    'add' => array(
      'name'  => 'required | maxLen[50]',
      'email' => 'required | maxLen[100]',
    ),
  );

  public function auth($params)
  {
    if (empty($params['email'])) throw new Exception(__('Email is required.'));
    if (empty($params['password'])) throw new Exception(__('Password is required.'));

    $staff = $this->find('first', array(
      CONDITIONS => array(
        'Staff.email'    => $params['email'],
        'Staff.password' => $this->hash($params['password']),
      ),
      FIELDS => array(
        'Staff.id',
      ),
    ));
    if (empty($staff)) throw new Exception(__('Email or password is incorrect'));

    $this->signIn($staff['Staff']['id']);

    return TRUE;
  }

  public function signIn($staffId)
  {
    $staff = $this->find('first', array(
      CONDITIONS => array(
        'Staff.id' => $staffId,
      ),
      FIELDS => array(
        'Staff.id', 'Staff.name', 'Staff.email',
      ),
    ));
    $staff['Staff']['editmode'] = FALSE;
    $_SESSION['Staff'] = $staff['Staff'];
  }

  public function signOut()
  {
    $_SESSION['Staff'] = FALSE;
  }
}

