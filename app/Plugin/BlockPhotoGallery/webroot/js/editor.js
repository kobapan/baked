baked.blocks.blockPhotoGallery = {
  instances: {}
};

$(function(){
  $(document).on('click', '[data-bk-block-photo-gallery-increase]', function(){
    var $block = $(this).parents('div.bk-block');
    var bkBlockId = $block.attr('data-bk-block-id');

    baked.post('block_photo_gallery/api/increase', {
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

    baked.post('block_photo_gallery/api/decrease', {
      data: {
        'block_id': bkBlockId
      },
      ok: function(r){
        $block.find('ul.block-photo-gallery').replaceWith($(r.html).find('ul.block-photo-gallery'));
      }
    });
  });
});
