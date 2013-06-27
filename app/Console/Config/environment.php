<?php
/**
 * 環境設定クラス
 */
class Environment
{
  private $_environments = array(
    // 秋山 ローカル環境
    array(
      'hosts'    => array('koicats.dev', 'Edison.local'), // この設定を適用する場合のホスト名。
      'host'     => 'koicats.dev', // 表示用ホスト名。URLなどに使用される。
      'constant' => 'AKIYAMA_LOCAL', // define('ENVIRONMENT', '***')で定数定義される値。
      'release'  => FALSE, // リリース環境の場合はtrue
      'db' => array( // DB設定
        'datasource' => 'Database/Mysql',
        'persistent' => FALSE,
        'host'       => '59.106.179.192',
        'login'      => 'koicats_dbuser',
        'password'   => 'j5VUZZWy2uuHntMu',
        'database'   => 'koicats',
        'prefix'     => '',
        'encoding'   => 'utf8mb4',
      ),
      'facebook' => array( // Facebook Api 設定
        'app_id'     => '614147235262888',
        'app_secret' => 'ef15cfed4c983767d10cfe358695ec7d',
      ),
    ),
    // ステージング環境
    array(
      'hosts'    => array('koicats.tabetto.com'),
      'host'     => 'koicats.tabetto.com',
      'constant' => 'STAGING',
      'release'  => FALSE,
      'db' => array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'localhost',
        'login'      => 'koicats',
        'password'   => '81WTIZDbg6tVMEC4',
        'database'   => 'koicats_db',
        'prefix'     => '',
        'encoding'   => 'utf8mb4',
      ),
      'facebook'     => array(
        'app_id'     => '544411115610248',
        'app_secret' => '9fa0d387dce944cd72035880f887278c',
      ),
    ),
    // リリース環境
    array(
      'hosts'    => array('koicats.com'),
      'host'     => 'koicats.com',
      'constant' => 'RELEASE',
      'release'  => TRUE,
      'db' => array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host'       => 'localhost',
        'login'      => 'koicats',
        'password'   => '81WTIZDbg6tVMEC4',
        'database'   => 'koicats_db',
        'prefix'     => '',
        'encoding'   => 'utf8mb4',
      ),
      'facebook' => array(
        'app_id'     => '396765540417398',
        'app_secret' => 'cebf8f7afb16166b2d5aa5baf865614c',
      ),
      'email' => array(
        'transport' => 'Smtp',
        'from'      => array('system@koicats.com' => 'koicats'),
        'to'        => array('system@koicats.com' => 'koicats'),
        'host'      => 'localhost',
        'port'      => 25,
        'timeout'   => 30,
        'username'  => 'system_koicats.com',
        'password'  => 'QNA25XsHbVxkr374',
        'client'    => null,
        'log'       => false,
        'charset'   => 'utf-8',
        'headerCharset' => 'utf-8',
      ),
    ),
  );
  public $environment; // $_environmentsのうちいずれか適用される配列のポインタ
  
  function __construct()
  {
  }
  
/**
 * 現在のサーバーのホスト名から、環境設定を適用する
 * マッチする環境設定が無い場合は例外をスロー
 * 
 * @return void
 */
  public function setup()
  {
    $hostName = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : exec('hostname');
    foreach ($this->_environments as $environment) {
      if (in_array($hostName, $environment['hosts'])) {
        $this->environment = &$environment;
        break;
      }
    }
    if (empty($this->environment)) throw new Exception('Not found environment settings.');
    
    define('HOST_NAME', $this->environment['host']);
    define('DEVELOPE', !$this->environment['release']);
    define('SHOW_LOG', DEVELOPE);
    define('URL', sprintf('http://%s/', HOST_NAME));
    define('SSL', sprintf('https://%s/', HOST_NAME));
    define('ENVIRONMENT', $this->environment['constant']);
    
    Configure::write('Environment', $this->environment);
  }
  
}



define('CONDITIONS', 'conditions');
define('FIELDS', 'fields');
define('ORDER', 'order');


