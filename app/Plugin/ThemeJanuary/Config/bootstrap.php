<?php
Configure::write('Themes.ThemeJanuary', array(
  'name' => __('January'),
  'support' => array(
    'pc'     => FALSE,
    'mobile' => TRUE,
  ),
));

Baked::add('CSS', array('/ThemeJanuary/css/jquery.sidr.light.css'));
Baked::add('JS', array(
  '/ThemeJanuary/js/jquery.sidr.min.js',
  '/ThemeJanuary/js/interface.js',
));

