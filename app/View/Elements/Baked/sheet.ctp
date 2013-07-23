<div id="bk-sheet-<?php echo $sheet; ?>" class="bk-sheet" data-bk-sheet="<?php echo $sheet; ?>">
  <?php foreach ($blocks as $block) : ?>
    <?php
    if ($block['Block']['sheet'] != $sheet) continue;
    echo $this->element('Baked/block', array(
      'block' => $block,
    ));
    ?>
  <?php endforeach ; ?>
</div>

<?php if (EDITTING) : ?>
  <a href="javascript:;" data-bk-show-block-list data-bk-sheet="<?php echo $sheet ?>"><?php echo __('New Block') ?></a>
<?php endif ; ?>
