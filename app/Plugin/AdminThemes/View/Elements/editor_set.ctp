<div class="editor-set">
  <div class="editor">
    <?php if (empty($currentFile)) : ?>
      <div><?php echo __('Select file on the right panel.') ?></div>
    <?php else : ?>
      <?php
      echo $this->Form->create('Editor', array(
        'url' => sprintf("/admin/themes/general/edit_%s?%s", $type, http_build_query($_GET)),
      ));
      echo $this->Baked->hiddenToken();
      echo $this->Form->input('path', array(
        'type' => 'hidden',
        'value' => $currentFile['path'],
      ));
      echo $this->Form->input('file', array(
        'label' => FALSE,
        'type' => 'textarea',
        'value' => file_get_contents($currentFile['path']),
      ));
      ?>

      <div class="spacer2"></div>
      <button type="submit" class="button button-primary button-pill button-small"><?php echo __('Save') ?></button>

      <?php
      echo $this->Form->end();
      ?>

    <?php endif ; ?>
  </div>
  <div class="explorer">
    <ul>
      <?php foreach ($files as $file) : ?>
        <?php
        $classes = array();
        if (@$currentFile['file'] == $file['file']) $classes[] = 'current';
        ?>
        <li class="<?php echo implode(' ', $classes) ?>"><a href="?file=<?php echo urlencode($file['file']) ?>"><?php echo h($file['file']) ?></a></li>
      <?php endforeach ; ?>
    </ul>
  </div>
</div>
