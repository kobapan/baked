<?php if (EDITTING) : ?>
  <ul id="bk-available-blocks">
    <?php foreach (Configure::read('Blocks') as $plugin => $info) : ?>
      <li><a href="javascript:;" data-bk-add-block="<?php echo $plugin ?>"><?php echo $info['name'] ?></a></li>
    <?php endforeach ; ?>
  </ul>
<?php endif ; ?>

