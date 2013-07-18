var Baked = function(){
  var token;
  var base;
  var showingBlockBox;
  var pageId;
};

Baked.prototype.blocks = {};

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

Baked.prototype.domBlockById = function(blockId){
  return $('#bk-block-'+blockId);
};

/**
 * Add the block.
 *
 * @param int pageId
 * @param string sheet
 * @param string package
 * @param int beforeBlockId
 */
Baked.prototype.addBlock = function(pageId, sheet, package, beforeBlockId){
  var self = this;

  this.post('system/api_blocks/add', {
    data: {
      'page_id': pageId,
      sheet: sheet,
      package: package,
      'before_block_id': beforeBlockId
    },
    ok: function(r){
      if (beforeBlockId != 0) {
        $beforeBlock = self.domBlockById(beforeBlockId);
        $beforeBlock.before(r.html);
      } else {
        $('#bk-sheet-'+sheet).append(r.html);
      }
    }
  })
};

/**
 * Delete the block.
 *
 * @param {Object} blockId
 */
Baked.prototype.deleteBlock = function(blockId){
  var self = this;

  this.post('system/api_blocks/delete', {
    data: {
      'block_id': blockId
    },
    ok: function(r){
      $block = self.domBlockById(blockId);
      $block.slideUp('first', function(){
        $block.remove();
      });
    }
  })
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





