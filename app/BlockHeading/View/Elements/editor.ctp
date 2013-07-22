<?php
echo $this->Form->create('Block', array(
  'default' => FALSE,
  'data-block-editor-heading',
));
?>
<?php
echo $this->Form->input('Block.h', array(
  'value' => $block['Block']['data']['h'],
  'options' => BlockHeading::$H,
  'class' => 'bk-block-input-h',
));
echo $this->Form->input('Block.text', array(
  'value' => $block['Block']['data']['text'],
  'class' => 'bk-block-input-text',
));
?>
<button type="submit" class="bk-btn-mini">送信</button>
<?php
echo $this->Form->end();


