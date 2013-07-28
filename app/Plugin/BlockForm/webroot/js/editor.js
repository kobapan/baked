baked.blocks.blockForm.itemsHasOptions = ['select', 'checkbox', 'radio'];
baked.blocks.blockForm.setup = function(){
  var self = this;
  $('.bk-block-form-editor-box').each(function(){
    var type = $(this).find('select.select-item-type > option:selected').val();
    if (0 <= $.inArray(type, self.itemsHasOptions)) {
      $(this).find('div.options').slideDown();
    } else {
      $(this).find('div.options').slideUp();
    }
  });
};
baked.blocks.blockForm.saveSortTimer = null;
baked.blocks.blockForm.saveSort = function(blockId){
  clearTimeout(baked.blocks.blockForm.saveSortTimer);
  baked.blocks.blockForm.saveSortTimer = setTimeout(function(){
    $block = baked.domBlockById(blockId);
    $table = $block.find('table.bk-block-form-editor');
    var itemIds = [];
    $table.find('tbody > tr').each(function(){
      itemIds.push($(this).attr('data-id'));
    });

    baked.post('block_form/block_form_api/save_sort', {
      data: {
        'block_id': blockId,
        'item_ids': itemIds
      },
      ok: function(r){
        var $bkBlock = baked.domBlockById(blockId);
        var selector = 'form.bk-block-form';
        $bkBlock.find(selector).replaceWith($(r.html).find(selector));
      }
    });
  }, 1000);
};

$(function(){
  $(document).on('click', '.bk-block-form-add-item', function(){
    var blockId = $(this).parents('.bk-block').attr('data-bk-block-id');
    baked.post('block_form/block_form_api/html_add', {
      data: {
        'data[BlockForm][block_id]': blockId
      },
      ok: function(r){
        $.fancybox({
          'content': r.html
        });
      }
    });
  });

  $(document).on('click', '.bk-block-form-delete-item', function(){
    var blockId = $(this).parents('.bk-block').attr('data-bk-block-id');
    var $tr = $(this).parents('tr');
    var itemId = $tr.attr('data-id');
    baked.post('block_form/block_form_api/delete_item', {
      data: {
        'data[BlockForm][block_id]': blockId,
        'data[BlockForm][item_id]': itemId
      },
      ok: function(r){
        $tr.fadeOut(function(){
          $tr.remove();
        });
      }
    });
  });

  $(document).on('click', '.bk-block-form-edit-item', function(){
    var blockId = $(this).parents('.bk-block').attr('data-bk-block-id');
    var itemId = $(this).parents('tr').attr('data-id');
    baked.post('block_form/block_form_api/html_add', {
      data: {
        'data[BlockForm][block_id]': blockId,
        'data[BlockForm][item_id]': itemId
      },
      ok: function(r){
        $.fancybox({
          'content': r.html
        });
      }
    });
  });

  $(document).on('submit', '.bk-block-form-editor-box form', function(){
    if (!baked.busyFilter()) return;
    $form = $(this);
    var params = baked.params($form);

    baked.post('block_form/block_form_api/add_item', {
      data: params,
      ok: function(r){
        var $bkBlock = baked.domBlockById(r.blockId);
        var selector = 'table.bk-block-form-editor';
        $bkBlock.find(selector).replaceWith($(r.html).find(selector));
        selector = 'form.bk-block-form';
        $bkBlock.find(selector).replaceWith($(r.html).find(selector));

        $.fancybox.close();
      },
      complete: function(){
        baked.busyEnd();
      }
    });
  });

  $(document).on('change', '.bk-block-form-editor-box select.select-item-type', function(){
    baked.blocks.blockForm.setup();
  });
});
