<div id="bk-sheet-<?php echo $sheet; ?>" class="bk-sheet" data-bk-sheet="<?php echo $sheet; ?>">

  <div class="bk-blocks">
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
    <div class="bk-general bk-add-block-outer">
      <a href="javascript:;" class="button button-primary button-pill button-small" data-bk-show-block-list data-bk-sheet="<?php echo $sheet ?>"><?php echo __('New Block') ?></a>
    </div>
  <?php endif ; ?>

</div>

