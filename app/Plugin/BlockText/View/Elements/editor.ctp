<?php
$id = "bk-block-text-{$block['Block']['id']}";
echo $this->Form->create('Block', array(
  'default' => FALSE,
  'data-block-editor-text',
));
?>
<?php
echo $this->Form->input('Block.text', array(
  'type' => 'textarea',
  'id' => $id,
  'label' => FALSE,
  'value' => $block['Block']['data']['text'],
  'default' => FALSE,
));
?>
<div class="spacer1"></div>
<button type="submit" class="bk-btn-mini"><?php echo __('Save') ?></button>
<?php
echo $this->Form->end();
?>

<script>
$(function(){
  CKEDITOR.replace('<?php echo $id ?>');
});
</script>
