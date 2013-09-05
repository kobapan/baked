<ul id="primary-navigation">
  <!--１番目の階層のメニューを表示-->
  <?php foreach ($menuList as $menu) : ?>
    <li>
      <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>

      <!--２番目の階層のメニューを表示-->
      <?php if (!empty($menu['current']) && !empty($menu['sub'])) : ?>
        <ul>
          <?php foreach ($menu['sub'] as $menu) : ?>
            <li>
              <a href="<?php echo $menu['Page']['path'] ?>"><?php echo $menu['Page']['title'] ?></a>

              <!--３番目の階層のメニューを表示-->
              <?php if (!empty($menu['current']) && !empty($menu['sub'])) : ?>
                <ul>
                  <?php foreach ($menu['sub'] as $menu) : ?>
                    <li>
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

