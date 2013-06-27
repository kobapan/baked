<div id="bk-sheet-<?php echo $sheet; ?>" class="bk-sheet">
  <?php foreach ($blocks as $block) : ?>
    <?php
    if ($block['Block']['sheet'] != $sheet) continue;
    ?>
    <div class="bk-block" data-bk-block-id="<?php echo $block['Block']['id'] ?>">
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
          <li><a href="javascript:;" data-bk-toggle-editor>B</a></li>
          <li><a href="javascript:;" data-bk-delete-block>x</a></li>
        </ul>
        <a href="javascript:;" class="bk-editor-opener" data-bk-editor-opener></a>
      <?php endif ; ?>
    </div>
  <?php endforeach ; ?>
</div>

