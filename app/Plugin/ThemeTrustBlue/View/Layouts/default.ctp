<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeTrustBlue/css/style.css" rel="stylesheet" type="text/css">

<?php echo $this->Element('Baked/js') ?>

<title><?php
  $pageTitle = '';
  if (!empty($title)) $pageTitle = $title.' - ';
  $pageTitle .= BK_SITE_NAME;
  echo h($pageTitle);
?></title>
</head>
<body class="<?php echo EDITTING ? 'editting' : 'default' ?>">

<?php echo $this->Element('Baked/html') ?>

<div id="wrap">

  <div id="primary-header">
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
  </div><!-- #primary-header -->

  <div id="primary-navigation" data-bk-dynamic="primary-navigation">
    <?php echo $this->element('Baked/navigation/primary') ?>
  </div><!-- #primary-navigation -->

  <div id="main-visual">
    <?php
    echo $this->element('Baked/sheet', array(
      'sheet' => 'visual',
    ));
    ?>
  </div><!-- #main-visual -->

  <div id="content" class="clearfix">

    <div id="main">
      <?php echo $this->fetch('content') ?>
    </div>

    <div id="side">
      <div id="global-navigation" data-bk-dynamic="global-navigation">
        <?php echo $this->element('Baked/navigation/straight') ?>
      </div><!--#global-navigation-->
      <?php
      echo $this->element('Baked/sheet', array(
        'sheet' => 'sub',
      ));
      ?>
    </div>

  </div><!-- #content -->

  <div id="primary-footer">
    <div class="copyright">Copyright <?php echo date('Y') ?>. All rights reserved.</div>
    <div class="powered">Powered by <a href="http://bakedcms.org/">Baked</a></div>
  </div>

</div><!-- #wrap -->

</body>
</html>


