<ul id="menu" class="global-navigation" data-bk-dynamic="global-navigation">
  <?php foreach ($menuList as $menu) : ?>
    <?php
    $classes = array();
    if ($menu['current']) $classes[] = 'current';
    ?>
    <li class="<?php echo implode(' ', $classes) ?>"><a href="<?php echo $menu['Page']['url'] ?>"><?php echo h($menu['Page']['title']) ?></a></li>
  <?php endforeach ; ?>
</ul>
