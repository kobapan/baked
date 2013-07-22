<?php
#Router::connect('/system/:controller/:action/*');
#Router::connect('/files/:action/*', array('controller' => 'files'));
#Router::connect('/:plugin/:controller/:action/*');

Router::connect('/', array('controller' => 'display', 'action' => 'show'));
#Router::connect('/*', array('controller' => 'display', 'action' => 'show'));
#Router::connect('/*/*', array('controller' => 'display', 'action' => 'show'));

CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
