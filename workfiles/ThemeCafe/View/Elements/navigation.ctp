<ul id="primary-navigation" data-bk-dynamic="primary-navigation">
  <!--１番目の階層のメニューを表示-->
  <?php foreach ($menuList as $menu) : ?>
    <?php
    $classes = array();
    if ($menu['current']) $classes[] = 'current';
    if ($menu['here']) $classes[] = 'here';
    ?>
    <li class="<?php echo implode(' ', $classes) ?>">
      <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>

      <!--２番目の階層のメニューを表示-->
      <?php if (!empty($menu['current']) && !empty($menu['sub'])) : ?>
        <ul>
          <?php foreach ($menu['sub'] as $menu) : ?>
            <?php
            $classes = array();
            if ($menu['current']) $classes[] = 'current';
            if ($menu['here']) $classes[] = 'here';
            ?>
            <li class="<?php echo implode(' ', $classes) ?>">
              <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>

              <!--３番目の階層のメニューを表示-->
              <?php if (!empty($menu['current']) && !empty($menu['sub'])) : ?>
                <ul>
                  <?php foreach ($menu['sub'] as $menu) : ?>
                    <?php
                    $classes = array();
                    if ($menu['current']) $classes[] = 'current';
                    if ($menu['here']) $classes[] = 'here';
                    ?>
                    <li class="<?php echo implode(' ', $classes) ?>">
                      <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>
                    </li>
                  <?php endforeach ; ?>
                </ul>

              <?php endif ; ?>

            </li>
          <?php endforeach ; ?>
        </ul>
      <?php endif ; ?>

    </li>
  <?php endforeach ; ?>
</ul>

