<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeCustom/css/style.css" rel="stylesheet" type="text/css" />

<?php echo $this->Element('Baked/js') ?>

<title><?php
  echo sprintf('%s - %s', $title, BK_SITE_NAME);
?></title>
</head>
<body>

<?php echo $this->Element('Baked/html') ?>

<div id="wrap">
  <div id="primary-header">
    <a href="<?php echo URL ?>"><?php echo BK_SITE_NAME ?></a>
  </div>

  <div id="content" class="clearfix">
    <?php echo $this->fetch('content') ?>
  </div><!-- #content -->

</div><!-- #wrap -->

</body>
</html>





