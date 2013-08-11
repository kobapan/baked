<?php
Configure::write('Admin.AdminBlocks', array(
  'order' => 10,
  'navigation' => array(
    'name' => __('ブロック'),
    'icon' => 'icon-archive',
    'href' => 'admin/blocks/general/installed',
    'sub' => array(
      array(
        'name' => __('ブロックリスト'),
        'href' => 'admin/blocks/general/installed',
      ),
      array(
        'name' => __('ブロック検索'),
        'href' => 'admin/blocks/general/search',
      ),
    ),
  ),
));

