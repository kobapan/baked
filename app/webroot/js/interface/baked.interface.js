var baked = new Baked;

$(function(){

  $(document).on('click', '[data-bk-editor-opener]', function(){
    var $block = $(this).parent();
    baked.openEditor($block);
  });

  $(document).on('click', '[data-bk-toggle-editor]', function(){
    var $block = $(this).parents('.bk-block');
    baked.toggleEditor($block);
  });



});

function c(val) {
  console.log(val);
}
