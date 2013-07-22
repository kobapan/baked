baked.blocks.blockPhotoGallery = {
  instances: {},
  reload: function(blockId){
    baked.loadBlock(blockId, {
      ok: function(r){
        $block = baked.domBlockById(blockId);
        $block.find('.block-photo-gallery').replaceWith($(r.html).find('.block-photo-gallery'));
        $block.find('.block-photo-gallery-edit-list').replaceWith($(r.html).find('.block-photo-gallery-edit-list'));
      }
    });
  },
  saveSortTimer: null,
  saveSort: function(blockId){
    clearTimeout(baked.blocks.blockPhotoGallery.saveSortTimer);
    baked.blocks.blockPhotoGallery.saveSortTimer = setTimeout(function(){
      $block = baked.domBlockById(blockId);
      $ul = $block.find('ul.block-photo-gallery-edit-list');
      var fileIds = [];
      $ul.find('li').each(function(){
        fileIds.push($(this).attr('data-bk-file-id'));
      });

      baked.post('block_photo_gallery/block_photo_gallery_api/save_sort', {
        data: {
          'block_id': blockId,
          'file_ids': fileIds
        },
        ok: function(r){
          $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
        }
      });
    }, 500);
  }
};

$(function(){
  $(document).on('click', '[data-bk-block-photo-gallery-increase]', function(){
    var $block = $(this).parents('div.bk-block');
    var bkBlockId = $block.attr('data-bk-block-id');

    baked.post('block_photo_gallery/block_photo_gallery_api/increase', {
      data: {
        'block_id': bkBlockId
      },
      ok: function(r){
        $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
      }
    });
  });

  $(document).on('click', '[data-bk-block-photo-gallery-decrease]', function(){
    var $block = $(this).parents('div.bk-block');
    var bkBlockId = $block.attr('data-bk-block-id');

    baked.post('block_photo_gallery/block_photo_gallery_api/decrease', {
      data: {
        'block_id': bkBlockId
      },
      ok: function(r){
        $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
      }
    });
  });

  $(document).on('submit', 'form.bk-photo-gallery-form', function(){
    var $block = $(this).parents('div.bk-block');
    var bkBlockId = $block.attr('data-bk-block-id');

    var params = {};
    $($(this).serializeArray()).each(function(i, v) {
      params[v.name] = v.value;
    });
    params['block_id'] = bkBlockId;
    baked.post('block_photo_gallery/block_photo_gallery_api/update', {
      data: params,
      ok: function(r){
        $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
      }
    });
  });

  $(document).on('click', 'a.bk-photo-gallery-delete-photo', function(){
    var $block = $(this).parents('div.bk-block');
    var bkBlockId = $block.attr('data-bk-block-id');
    var $photo = $(this).parent();
    var fileId = $photo.attr('data-bk-file-id');

    baked.post('block_photo_gallery/block_photo_gallery_api/delete_photo', {
      data: {
        'block_id': bkBlockId,
        'file_id': fileId
      },
      ok: function(r){
        $photo.fadeOut('normal', function(){
          $photo.remove();
        });
        $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
      }
    });
  });


});







