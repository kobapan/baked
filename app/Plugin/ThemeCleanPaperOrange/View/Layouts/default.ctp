<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeCleanPaperOrange/css/style.css" rel="stylesheet" type="text/css" />

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

<div id="wrap">

  <div id="paper" class="clearfix">

    <div id="primary-header" class="wring">
      <div class="logo">
        <a href="<?php echo URL ?>"><?php echo BK_SITE_NAME ?></a>
      </div>
      <ul class="navigation depth-0" data-bk-dynamic="global-navigation">
        <?php foreach ($menuList as $menu) : ?>
          <?php
          $classes = array();
          if ($menu['current']) $classes[] = 'current';
          if ($menu['Page']['hidden']) $classes[] = 'hidden';
          ?>
          <li class="<?php echo implode(' ', $classes) ?>">
            <a href="<?php echo $menu['Page']['url'] ?>">
              <span class="normal">
                <?php echo h($menu['Page']['title']) ?>
                <?php if (!empty($menu['sub'])) : ?><span class="more">&raquo;</span><?php endif ; ?>
              </span>
              <span class="hover">
                <?php echo h($menu['Page']['title']) ?>
                <?php if (!empty($menu['sub'])) : ?><span class="more">&raquo;</span><?php endif ; ?>
              </span>
              <div class="cover"></div>
            </a>
            <?php if (!empty($menu['sub'])) : ?>
              <div class="depth-1 under">
                <ul>
                  <?php foreach ($menu['sub'] as $menu) : ?>
                    <?php
                    $classes = array();
                    if ($menu['current']) $classes[] = 'current';
                    if ($menu['Page']['hidden']) $classes[] = 'hidden';
                    ?>
                    <li class="<?php echo implode(' ', $classes) ?>">
                      <a href="<?php echo $menu['Page']['url'] ?>">
                        <?php echo $menu['Page']['title'] ?>
                        <?php if (!empty($menu['sub'])) : ?><span class="more">&raquo;</span><?php endif ; ?>
                      </a>
                      <?php if (!empty($menu['sub'])) : ?>
                        <div class="depth-2 under">
                          <ul>
                            <?php foreach ($menu['sub'] as $menu) : ?>
                              <?php
                              $classes = array();
                              if ($menu['current']) $classes[] = 'current';
                              if ($menu['Page']['hidden']) $classes[] = 'hidden';
                              ?>
                              <li class="<?php echo implode(' ', $classes) ?>">
                                <a href="<?php echo $menu['Page']['url'] ?>"><?php echo $menu['Page']['title'] ?></a>
                              </li>
                            <?php endforeach ; ?>
                          </ul>
                        </div><!-- .depth-2 -->
                      <?php endif ; ?>
                    </li>
                  <?php endforeach ; ?>
                </ul>
              </div><!-- .depth-1 -->
            <?php endif ; ?>
          </li>
        <?php endforeach ; ?>
      </ul>
    </div><!-- #primary-header -->

    <div id="content">
      <?php echo $this->fetch('content') ?>
    </div><!-- #content -->

  </div><!-- #paper -->

  <div id="primary-footer">
    <div class="copyright">Copyright <?php echo date('Y') ?>. All rights reserved.</div>
    <div class="powered">Powered by <a href="http://bakedcms.org/">Baked</a></div>
  </div>


</div><!-- #wrap -->

</body>
</html>





