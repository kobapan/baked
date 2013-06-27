var Baked = function(){
  var token;
  var base;
};

/**
 * POST
 *
 * @param {Object} url
 * @param {Object} options
 */
Baked.prototype.post = function(url, options){
  var newOptions = $.extend({
    type: 'post',
    dataType: 'json',
    data: {}
  }, options);
  newOptions.data.token = this.token;
  newOptions.url = this.base + url;

  $.ajax({
    cache: false,
    url: newOptions.url,
    type: newOptions.type,
    dataType: newOptions.dataType,
    data: newOptions.data,
    beforeSend: function(x) {
      if ('beforeSend' in newOptions) { newOptions.beforeSend(x); };
    },
    success: function(r) {
      if (newOptions.dataType == 'json') {
        if (r.result == 'OK') {
          if ('ok' in newOptions) { newOptions.ok(r); };
        } else {
          alert(r.message);
          //common.showFloatingMessage(r.mes, 'error');
          if ('ng' in newOptions) { newOptions.ng(r); };
        }
        return;
      }

      if ('success' in newOptions) { newOptions.success(r); };
    },
    error: function(r) {
      if ('error' in newOptions) { newOptions.error(r); };
    },
    complete: function() {
      if ('complete' in newOptions) { newOptions.complete(); };
    }
  });
};

// 編集エリアを表示
Baked.prototype.openEditor = function($block){
  this.closeAllEditor();
  $block.addClass('bk-open');
};

// 編集エリアをToggle
Baked.prototype.toggleEditor = function($block){
  if ($block.hasClass('bk-open')) {
    this.closeAllEditor();
  } else {
    this.openEditor($block);
  }
};

// 全ての編集エリアを閉じる
Baked.prototype.closeAllEditor = function(){
  $('div.bk-block.bk-open').removeClass('bk-open');
};



