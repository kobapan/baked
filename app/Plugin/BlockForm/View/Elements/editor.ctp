<?php
$tableId = "block-form-editor-table-{$block['Block']['id']}";
?>
<table class="bk-block-form-editor" id="<?php echo $tableId ?>">
  <thead>
    <tr>
      <th></th>
      <th><?php echo __('Item name') ?></th>
      <th><?php echo __('Item type') ?></th>
      <th><?php echo __('Options') ?></th>
      <th><?php echo __('Required') ?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($block['Block']['data']['items'] as $item) : ?>
    <tr data-id="<?php echo $item['item_id'] ?>">
      <td><i class="icon-move icon-large"></i></td>
      <td><a href="javascript:;" class="bk-block-form-edit-item"><?php echo $item['name'] ?></a></td>
      <td><?php echo BlockForm::$TYPE[$item['type']] ?></td>
      <td class="bk-center"><?php echo isset($item['options']) ? count($item['options']) : '-' ?></td>
      <td class="bk-center"><?php echo $item['required'] ? '○' : '-' ?></td>
      <td><a href="javascript:;" class="bk-block-form-delete-item"><i class="icon-trash icon-large"></i></a></td>
    </tr>
  <?php endforeach ; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="100%"><a href="javascript:;" class="bk-block-form-add-item"><?php echo __('Add form item') ?></a></td>
    </tr>
  </tfoot>

  <script>
  $(function(){
    $('#<?php echo $tableId ?> > tbody').sortable({
      axis: 'y',
      helper: function(e, tr){
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index){
          $(this).width($originals.eq(index).width());
        });
        return $helper;
      },
      update: function(event, ui) {
        baked.blocks.blockForm.saveSort(<?php echo $block['Block']['id'] ?>);
      }
    });
  });
  </script>
</table>
