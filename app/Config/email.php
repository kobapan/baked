<?php
class EmailConfig
{
  public $default = array(
    'transport' => 'Mail',
    #'log' => 'emails',
  );

  public function __construct()
  {
    $this->default['from'] = MY_EMAIL;
  }

}
