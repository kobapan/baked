<div id="bk-block-<?php echo $block['Block']['id'] ?>" class="bk-block" data-bk-block-id="<?php echo $block['Block']['id'] ?>">
  <?php
  echo $this->element("{$block['Block']['package']}.block", array(
    'block' => $block,
  ));
  ?>

  <?php if (EDITTING) : ?>
    <div class="bk-editor">
      <?php
      echo $this->element("{$block['Block']['package']}.editor", array(
        'block' => $block,
      ));
      ?>
    </div>
    <ul class="bk-controller">
      <li><a href="javascript:;" data-bk-show-block-list data-bk-sheet="<?php echo $block['Block']['sheet'] ?>" data-bk-before-block-id="<?php echo $block['Block']['id'] ?>">N</a></li>
      <li><a href="javascript:;" data-bk-toggle-editor>B</a></li>
      <li><a href="javascript:;" data-bk-delete-block="<?php echo $block['Block']['id'] ?>">x</a></li>
    </ul>
    <a href="javascript:;" class="bk-editor-opener" data-bk-editor-opener></a>
  <?php endif ; ?>
</div>
