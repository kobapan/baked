baked.blocks.blockForm = {
  send: function(blockId, params){
    if (!baked.busyFilter()) return;
    $('div.bk-block-form-error').remove();

    params['data[block_id]'] = blockId;
    baked.post('block_form/block_form_api/send', {
      data: params,
      ok: function(r){
        var $form = $('form#bk-block-form-'+blockId);
        var $sentText = $('<div>', {
          html: r.data.sent_text,
          css: {'display': 'none'}
        });
        $form.after($sentText);
        $form.slideUp(function(){
          $sentText.slideDown();
        });
      },
      ng: function(r){
        var $form = $('form#bk-block-form-'+blockId);
        for (var itemId in r.errors) {
          var $area = $form.find('div.bk-block-form-item-'+itemId);
          var $error = $('<div>', {
            text: r.errors[itemId][0],
            class: 'bk-block-form-error',
          });
          $error.appendTo($area).fadeIn();
        }
      },
      complete: function(){
        baked.busyEnd();
      }
    });
  }
};

$(function(){
  $(document).on('click', 'div.bk-block-form-error', function(){
    $(this).fadeOut('fast', function(){
      $(this).remove();
    });
  });
  $(document).on('submit', 'form.bk-block-form', function(){
    var $form = $(this);
    var $bkBlock = $form.parents('.bk-block');
    var blockId = $bkBlock.attr('data-bk-block-id');
    //baked.blocks.blockForm.send(blockId);
    var params = baked.params($form);
    baked.blocks.blockForm.send(blockId, params);
  });
});

