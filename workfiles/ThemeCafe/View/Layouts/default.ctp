<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeCafe/css/style.css" rel="stylesheet" type="text/css" />

<?php echo $this->Element('Baked/js') ?>

<title><?php
  echo sprintf('%s - %s', $title, BK_SITE_NAME);
?></title>
</head>
<body>

<?php echo $this->Element('Baked/html') ?>

<div id="wrap">
  <div id="primary-header">
    <div class="main">
      <div class="logo"><a href="<?php echo URL ?>"><?php echo BK_SITE_NAME ?></a></div>
      <div class="caption"><?php echo h(Reception::read('site_caption')) ?></div>
    </div>
    <div class="aside">
      <?php if (Reception::read('company')) : ?>
        <div class="company"><?php echo h(Reception::read('company')) ?></div>
      <?php endif ; ?>
      <?php if (Reception::read('address')) : ?>
        <div class="address"><?php echo h(Reception::read('address')) ?></div>
      <?php endif ; ?>
      <?php if (Reception::read('tel')) : ?>
        <div class="tel"><?php echo h(Reception::read('tel')) ?></div>
      <?php endif ; ?>
    </div>
  </div>

  <div id="content" class="clearfix">
    <?php echo $this->fetch('content') ?>
  </div><!-- #content -->

</div><!-- #wrap -->

</body>
</html>





