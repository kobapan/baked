<?php
class DATABASE_CONFIG
{
  public function __construct()
  {
    $this->default = Configure::read('Environment.db');
  }
}

