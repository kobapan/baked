<?php
/**
 * 環境設定クラス
 */
class Environment
{
  private $_hosts = array('baked.dev', 'Edison.local');
  
/**
 * Set up environment config.
 * 
 * @return void
 */
  public function setup()
  {
    $hostName = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : exec('hostname');
    define('DEVELOPE', in_array($hostName, $this->_hosts));
    define('SHOW_LOG', DEVELOPE);
  }
  
}

define('CONDITIONS', 'conditions');
define('FIELDS', 'fields');
define('ORDER', 'order');

