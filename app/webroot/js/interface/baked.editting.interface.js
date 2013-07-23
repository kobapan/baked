$(function(){

  $(document).on('click', '[data-bk-editor-opener]', function(){
    var $block = $(this).parent();
    baked.openEditor($block);
  });

  $(document).on('click', '[data-bk-toggle-editor]', function(){
    var $block = $(this).parents('.bk-block');
    baked.toggleEditor($block);
  });

  $(document).on('click', '[data-bk-add-block]', function(){
    c("ADDDD!");
    var $ul = $('#bk-available-blocks');
    var package = $(this).attr('data-bk-add-block');
    var sheet = $ul.attr('data-bk-sheet');
    var beforeBlockId = $ul.attr('data-bk-before-block-id');
    baked.addBlock(baked.pageId, sheet, package, beforeBlockId);
  });

  $(document).on('click', '[data-bk-delete-block]', function(){
    var blockId = $(this).attr('data-bk-delete-block');
    baked.deleteBlock(blockId);
  });

  $(document).on('click', '[data-bk-show-block-list]', function(e){
    var sheet = $(this).attr('data-bk-sheet');
    var beforeBlobkId = $(this).attr('data-bk-before-block-id');
    if (!beforeBlobkId) beforeBlobkId = 0;
    $('#bk-available-blocks')
      .attr('data-bk-sheet', sheet)
      .attr('data-bk-before-block-id', beforeBlobkId)
      .css({
        top: e.pageY,
        left: e.pageX
      })
      .show();
    baked.showingBlockBox = true;
  });

  $(document).on('click', '[data-bk-editor-opener]', function(){
    var $block = $(this).parent();
    baked.openEditor($block);
  });

  $(document).on('click', function(e){
    if (!baked.showingBlockBox) return;

    var attr = $(e.target).attr('data-bk-show-block-list');
    if ('undefined' != typeof attr) return;

    //if ($(e.target).parents('#bk-available-blocks').length > 0) return;

    $('#bk-available-blocks').hide();
    baked.showingBlockBox = false;
  });

});

