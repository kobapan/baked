<?php
$hostName = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : exec('hostname') ;
define('HOST_NAME', $hostName);
define('DEVELOPE', in_array($hostName, array('farmers.dev')));

$type = 'RELEASE';
if (DEVELOPE) {
    // ローカル環境
    $type = 'LOCAL';
    define('URL', 'http://farmers.dev/');
    define('SSL', 'https://farmers.dev/');
} else if (in_array($hostName, array('testfarmers.forpeace.co.jp'))) {
    // テストサーバー
    $type = 'TEST';
    define('URL', 'http://mole-dev.ecbb.jp/');
    define('SSL', 'http://mole-dev.ecbb.jp/');
} else {
    // 本番サーバー
    define('URL', 'http://mole-dev.ecbb.jp/');
    define('SSL', 'http://mole-dev.ecbb.jp/');
}
define('TYPE', $type);
define('SHOW_LOG', ($type !== 'RELEASE'));
