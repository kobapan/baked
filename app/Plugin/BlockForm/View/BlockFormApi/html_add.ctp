<div class="bk-block-form-editor-box">
  <?php
  echo $this->Form->create('BlockForm', array(
    'default' => FALSE,
  ));
  if (!empty($this->data['BlockForm']['item_id'])) {
    echo $this->Form->input('BlockForm.item_id', array(
      'type' => 'hidden',
    ));
  }
  echo $this->Form->input('BlockForm.name', array(
    'label' => __('Item name'),
  ));
  echo $this->Form->input('BlockForm.block_id', array(
    'type' => 'hidden',
  ));
  echo $this->Form->input('BlockForm.required', array(
    'label' => __('Required'),
    'type' => 'checkbox',
  ));
  echo $this->Form->input('BlockForm.type', array(
    'label' => __('Item type'),
    'options' => BlockForm::$TYPE,
    'class' => 'select-item-type',
  ));
  echo $this->Form->input('BlockForm.options_text', array(
    'label' => __('Options'),
    'type' => 'textarea',
    'div' => array(
      'class' => 'input options',
      'style' => 'display: none',
    ),
    'value' => isset($this->data['BlockForm']['options']) ? implode("\n", $this->data['BlockForm']['options']) : '',
  ));
  ?>
  <button type="submit"><?php echo __('Save') ?></button>
  <?php
  echo $this->Form->end();
  ?>
</div>

<script>
$(function(){
  baked.blocks.blockForm.setup();
});
</script>
