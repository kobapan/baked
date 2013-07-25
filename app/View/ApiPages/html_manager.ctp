<?php
echo $this->Form->create('Page', array(
  'default' => FALSE,
  'id' => 'bk-page-manager-form',
));
?>

<ul id="bk-page-manager" class="bk-general">
  <?php foreach ($pages as $page) : ?>
    <li data-page-id="<?php echo $page['Page']['id'] ?>" data-bk-depth="<?php echo $page['Page']['depth'] ?>" data-bk-hidden="<?php echo (int)$page['Page']['hidden'] ?>">
      <?php
      echo $this->Form->input("Page.{$page['Page']['id']}.title", array(
        'label' => FALSE,
        'value' => $page['Page']['title'],
        'class' => 'title',
      ));
      echo $this->Form->input("Page.{$page['Page']['id']}.name", array(
        'label' => FALSE,
        'value' => $page['Page']['name'],
        'class' => 'name',
      ));
      echo $this->Form->input("Page.{$page['Page']['id']}.order", array(
        'type' => 'hidden',
        'value' => $page['Page']['order'],
        'class' => 'order',
      ));
      echo $this->Form->input("Page.{$page['Page']['id']}.depth", array(
        'type' => 'hidden',
        'value' => $page['Page']['depth'],
        'class' => 'depth',
      ));
      echo $this->Form->input("Page.{$page['Page']['id']}.id", array(
        'type' => 'hidden',
        'value' => $page['Page']['id'],
      ));
      echo $this->Form->input("Page.{$page['Page']['id']}.hidden", array(
        'type' => 'hidden',
        'value' => (int)$page['Page']['hidden'],
        'class' => 'hidden',
      ));
      ?>
      <a href="javascript:;" class="bk-up"><i class="icon-arrow-up icon-large"></i></a>
      <a href="javascript:;" class="bk-down"><i class="icon-arrow-down icon-large"></i></a>
      <a href="javascript:;" class="bk-left"><i class="icon-arrow-left icon-large"></i></a>
      <a href="javascript:;" class="bk-right"><i class="icon-arrow-right icon-large"></i></a>
      <a href="javascript:;" class="bk-hide"><i class="icon-eye-open icon-large"></i></a>
      <a href="javascript:;" class="bk-open"><i class="icon-eye-close icon-large"></i></a>
      <a href="javascript:;" class="bk-add"><i class="icon-plus icon-large"></i></a>
      <a href="javascript:;" class="bk-add"><i class="icon-trash icon-large"></i></a>
    </li>
  <?php endforeach ; ?>
</ul>

<button type="submit"><?php echo __('Save') ?></button>

<?php
echo $this->Form->end();
?>

<script>
$(function(){
  baked.alignPageManager();
});
</script>

