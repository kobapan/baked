<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeSolidBlack/css/style.css" rel="stylesheet" type="text/css">

<?php echo $this->Element('Baked/js') ?>

<title><?php
  $pageTitle = '';
  if (!empty($title)) $pageTitle = $title.' - ';
  $pageTitle .= BK_SITE_NAME;
  echo h($pageTitle);
?></title>
</head>
<body>

<?php echo $this->Element('Baked/html') ?>

<div id="all">

  <div id="primary-header" class="wring">
    <a href="<?php echo URL ?>" class="logo"><?php echo BK_SITE_NAME ?></a>
    <dl>
      <?php if (Reception::read('company')) : ?>
        <dd><?php echo Reception::read('company'); ?></dd>
      <?php endif ; ?>
      <?php if (Reception::read('address')) : ?>
        <dd><?php echo Reception::read('address'); ?></dd>
      <?php endif ; ?>
      <?php if (Reception::read('tel')) : ?>
        <dd><?php echo Reception::read('tel'); ?></dd>
      <?php endif ; ?>
    </dl>
  </div>

  <div id="primary-navigation" data-bk-dynamic="primary-navigation">
    <ul class="wring">
      <?php foreach ($menuList as $menu) : ?>
        <?php
        $classes = array();
        if ($menu['current']) $classes[] = 'current';
        ?>
        <li class="<?php echo implode(' ', $classes) ?>">
          <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>
        </li>
      <?php endforeach ; ?>
    </ul>
  </div>

  <div id="content" class="clearfix wring">
    <div id="main">
      <?php echo $this->fetch('content') ?>
    </div>
    <div id="side">

      <div id="all-navigation" data-bk-dynamic="all-navigation">
        <?php echo $this->element('Baked/navigation/straight') ?>
      </div><!--#primary-navigation-->

      <?php
      echo $this->element('Baked/sheet', array(
        'sheet' => 'sub',
      ));
      ?>
    </div>
  </div>

</div>

<div id="primary-footer" class="wring">
  <div class="copyright">Copyright <?php echo date('Y') ?>. All rights reserved.</div>
  <div class="powered">Powered by <a href="http://bakedcms.org/">Baked</a></div>
</div>

</body>
</html>





