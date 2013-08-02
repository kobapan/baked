<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<?php echo $this->Element('Baked/head') ?>

<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeCleanPaperOrange/css/style.css" rel="stylesheet" type="text/css" />

<?php echo $this->Element('Baked/js') ?>

<title></title>
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
            </a>
            <?php if (!empty($menu['sub'])) : ?>
              <div class="depth-1 under">
                <ul>
                  <?php foreach ($menu['sub'] as $menu) : ?>
                    <?php
                    $classes = array();
                    if ($menu['current']) $classes[] = 'current';
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

      <div id="visual">
        <?php
        echo $this->element('Baked/sheet', array(
          'sheet' => 'visual',
        ));
        ?>
      </div>

      <div class="wring">

        <div id="main">
          <?php
          echo $this->element('Baked/sheet', array(
            'sheet' => 'main',
          ));
          ?>
        </div><!-- #main -->

        <div id="sub">
          <?php
          echo $this->element('Baked/sheet', array(
            'sheet' => 'sub',
          ));
          ?>
        </div><!-- #sub -->

      </div><!-- .wring -->

    </div><!-- #content -->

  </div><!-- #paper -->

</div><!-- #wrap -->

</body>
</html>

