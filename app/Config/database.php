<?php
class DATABASE_CONFIG
{
  public function __construct()
  {
    $this->default = array(
      'datasource' => 'Database/Mysql',
      'persistent' => FALSE,
      'host' => MY_DB_HOST,
      'login' => MY_DB_USER,
      'password' => MY_DB_PASSWORD,
      'database' => MY_DB_NAME,
      'prefix' => MY_DB_PREFIX,
      'encoding' => MY_DB_ENCODING,
    );
  }
}

