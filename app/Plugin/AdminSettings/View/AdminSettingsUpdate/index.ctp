<div class="box">
  <header>
    <h1><?php echo __('アップデート') ?></h1>
  </header>
  <div class="inner">
    <?php
    echo $this->Form->create('System', array(
      'url' => '/admin/settings/update/auto_update',
      'class' => 'form-01 bk-general',
    ));
    echo $this->Baked->hiddenToken();
    ?>
    <button class="button button-primary button-pill button-small"><?php echo __('自動アップデート') ?></button>
    <?php
    echo $this->Form->end();
    ?>
  </div>
</div>
