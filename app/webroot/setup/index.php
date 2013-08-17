<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(dirname(dirname(__FILE__)))));
define('APP_DIR', basename(dirname(dirname(dirname(__FILE__)))));
define('WEBROOT_DIR', basename(dirname(dirname(__FILE__))));
define('WWW_ROOT', dirname(dirname(__FILE__)) . DS);
define('CAKE_ROOT', ROOT.DS.'lib'.DS.'Cake'.DS);

if (!defined('CAKE_CORE_INCLUDE_PATH')) {
  if (function_exists('ini_set')) {
    ini_set('include_path', ROOT . DS . 'lib' . PATH_SEPARATOR . ini_get('include_path'));
  }
  if (!include ('Cake' . DS . 'bootstrap.php')) {
    $failed = true;
  }
} else {
  if (!include (CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'bootstrap.php')) {
    $failed = true;
  }
}
if (!empty($failed)) {
  trigger_error("CakePHP core could not be found.  Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php.  It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
}

#require_once CAKE_ROOT.'View'.DS.'View.php';

#$View = new View();


exit;
