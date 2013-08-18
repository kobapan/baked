<?php if (EDITTING) : ?>
  <ul id="bk-available-blocks" class="bk-general">
    <?php foreach (Configure::read('Blocks') as $plugin => $info) : ?>
      <li><a href="javascript:;" data-bk-add-block="<?php echo $plugin ?>"><?php if (isset($info['icon'])) echo sprintf('<i class="icon %s"></i>', $info['icon']); ?><?php echo $info['name'] ?></a></li>
    <?php endforeach ; ?>
  </ul>

  <ul id="bk-toolbar" class="bk-general">
    <li><a href="<?php echo URL ?>admin/themes/general/installed"><?php echo __('管理画面') ?></a></li>
    <li><a href="javascript:;" data-bk-show-page-manager><?php echo __('ページ管理') ?></a></li>
    <li><a href="javascript:;" class="bk-cancel-editmode"><?php echo __('編集モード終了') ?></a></li>
    <li><a href="javascript:;" class="bk-sign-out"><?php echo __('サインアウト') ?></a></li>
  </ul>
<?php endif ; ?>


