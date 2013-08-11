<?php
Configure::write('Admin.AdminSettings', array(
  'order' => 20,
  'navigation' => array(
    'name' => __('設定'),
    'icon' => 'icon-wrench',
    'href' => 'admin/settings/input/general',
    'sub' => array(
      array(
        'name' => __('基本設定'),
        'href' => 'admin/settings/input/general',
      ),
      array(
        'name' => __('管理者設定'),
        'href' => 'admin/settings/input/staff',
      ),
    ),
  ),
));

