<div class="sub-navigation">

  <?php if ($parentMenu['sub']) : ?>

  <h3>SUB MENU</h3>

  <ul class="submenu">
    <?php foreach ($parentMenu['sub'] as $menu) : ?>
      <?php
      $classes = array();
      if ($menu['current']) $classes[] = 'current';
      ?>
      <li class="<?php echo implode(' ', $classes) ?>"><a href="<?php echo $menu['Page']['url'] ?>"><?php echo h($menu['Page']['title']) ?></a></li>
    <?php endforeach ; ?>
  </ul>

  <?php endif ; ?>

</div>
