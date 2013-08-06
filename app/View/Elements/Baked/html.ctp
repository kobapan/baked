<?php if (EDITTING) : ?>
  <ul id="bk-available-blocks" class="bk-general">
    <?php foreach (Configure::read('Blocks') as $plugin => $info) : ?>
      <li><a href="javascript:;" data-bk-add-block="<?php echo $plugin ?>"><?php if (isset($info['icon'])) echo sprintf('<i class="icon %s"></i>', $info['icon']); ?><?php echo $info['name'] ?></a></li>
    <?php endforeach ; ?>
  </ul>

  <ul id="bk-toolbar">
    <li><a href="<?php echo URL ?>admin"><?php echo __('Dasboard') ?></a></li>
    <li><a href="javascript:;" data-bk-show-page-manager><?php echo __('Manage page') ?></a></li>
    <li><a href="javascript:;" class="bk-cancel-editmode"><?php echo __('Exit editmode') ?></a></li>
    <li><a href="javascript:;" class="bk-sign-out"><?php echo __('Sign out') ?></a></li>
  </ul>
<?php endif ; ?>


