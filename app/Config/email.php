<?php
class EmailConfig
{
	public $smtp = array(
    'transport' => 'Smtp',
    'from' => array('info@gunjodo.com'),
    'host' => 'gunjodo.sakura.ne.jp',
    'port' => 587,
    'timeout' => 10,
    'username' => 'info@gunjodo.com',
    'password' => 'cup_soup',
    'client' => null,
    'log' => 'mail_smtp',
    'charset' => 'utf-8',
    'headerCharset' => 'utf-8',
	);
  
  public function __construct()
  {
    if (Configure::read('Environment.email')) {
      $this->smtp = Configure::read('Environment.email');
    }
  }

}
