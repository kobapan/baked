<?php
echo $this->Form->create('Block', array(
  'default' => FALSE,
  'data-block-editor-heading',
));
?>


<ul class="bk-editor-boxes">
  <li>
    <div class="bk-title"><?php echo __('サイズ') ?></div>
    <?php
    echo $this->Form->input('Block.h', array(
      'value' => $block['Block']['data']['h'],
      'options' => BlockHeading::$H,
      'class' => 'bk-block-input-h',
      'label' => FALSE,
    ));
    ?>
  </li>
  <li>
    <div class="bk-title"><?php echo __('テキスト') ?></div>
    <?php
    echo $this->Form->input('Block.text', array(
      'value' => $block['Block']['data']['text'],
      'class' => 'bk-block-input-text',
      'label' => FALSE,
    ));
    ?>
  </li>
</ul>

<div class="spacer1"></div>

<button type="submit" class="button button-primary button-pill button-small"><?php echo __('保存') ?></button>

<?php
echo $this->Form->end();


