var Baked = function(){
  var token;
  var base;
  var showingBlockBox;
  var saveBlockSortTimer;
  var pageId;
  var busy;
};

Baked.prototype.blocks = {};
$.fn.bkCkeditor = function(){
  $(this).ckeditor({
    enterMode : CKEDITOR.ENTER_BR
  });
};

Baked.prototype.params = function($dom){
  var params = {};
  $($dom.serializeArray()).each(function(i, v) {
    params[v.name] = v.value;
  });
  return params;
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
      $.fn.resetSinglesender();
      if ('complete' in newOptions) { newOptions.complete(); };
    }
  });
};

Baked.prototype.domBlockById = function(blockId){
  return $('#bk-block-'+blockId);
};

Baked.prototype.showPageManager = function(){
  this.post('system/api_pages/html_manager', {
    ok: function(r){
      $.fancybox({
        'content': r.html,
      });
    }
  });
};

Baked.prototype.savePageManager = function(callbacks){
  if (!this.busyFilter()) return;
  var self = this;

  $form = $('#bk-page-manager-form');
  var params = baked.params($form);

  this.post('system/api_pages/update_all', {
    data: params,
    ok: function(r){
      self.reloadDynamic();
      if (callbacks && callbacks.ok) callbacks.ok(r);
    },
    complete: function(){
      self.busyEnd();
    }
  });
};

Baked.prototype.alignPageManager = function(){
  var beforeDepth = -1;
  var order = 0;
  $('#bk-page-manager > li').each(function(){
    $li = $(this);
    $li.removeClass('bk-bottom-page');
    $li.removeClass('bk-home');
    var hidden = parseInt($li.attr('data-bk-hidden'));
    var depth = parseInt($li.attr('data-bk-depth'));
    var name = $li.find('input.name').val();
    newDepth = depth;

    if (newDepth > beforeDepth+1) newDepth = beforeDepth+1;
    if (beforeDepth == -1
      || newDepth > beforeDepth
      || newDepth == 2
    ) {
      $li.addClass('bk-bottom-page');
    }

    beforeDepth = newDepth;

    if (depth != newDepth) {
      $li.attr('data-bk-depth', newDepth);
    }

    if (newDepth == 0 && name == 'index') {
      $li.addClass('bk-home');
    }

    $li.attr('data-bk-name', name);
    $li.find('input.order').val(order);
    $li.find('input.depth').val(newDepth);
    $li.find('input.hidden').val(hidden);
    order++;
  });
};

Baked.prototype.insertPage = function(params, callbacks){
  var self = this;

  this.post('system/api_pages/insert', {
    data: params,
    ok: function(r){
      if (callbacks && callbacks.ok) callbacks.ok(r);
    }
  });
};

Baked.prototype.deletePage = function(opts){
  var self = this;

  this.post('system/api_pages/delete', opts);
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
 * Load block html.
 *
 * @param {Object} blockId
 */
Baked.prototype.loadBlock = function(blockId, callbacks){
  var self = this;

  this.post('system/api_blocks/html_block', {
    data: {
      'block_id': blockId
    },
    ok: function(r){
      if (callbacks && callbacks.ok) callbacks.ok(r);
    }
  })
};

Baked.prototype.setupCkeditor = function(){
  $('.ckeditor-textarea').bkCkeditor();
};

Baked.prototype.sortableBlocks = function(){
  var self = this;
  $('.bk-sheet').sortable({
    zIndex: 2000,
    handle: 'a.bk-block-move-handle',
    connectWith: '.bk-sheet',
    revert: true,
    tolerance: 'pointer',
    start: function () {
      $('.ckeditor-textarea').each(function () {
        $(this).ckeditorGet().destroy();
      });
    },
    stop: function(){
      self.setupCkeditor();
    },
    update: function(){
      self.saveSort();
    }
  });
  $('.bk-sheet').disableSelection();
};

Baked.prototype.saveSort = function(){
  var self = this;
  clearTimeout(self.saveBlockSortTimer);
  self.saveBlockSortTimer = setTimeout(function(){
    var sortedIds = {};
    $('.bk-sheet').each(function(){
      var sheet = $(this).attr('data-bk-sheet');
      sortedIds[sheet] = [];
      $('.bk-block', this).each(function(){
        var blockId = $(this).attr('data-bk-block-id');
        sortedIds[sheet].push(blockId);
      });
    });
    self.post('system/api_blocks/save_sort', {
      data: {
        'page_id': this.pageId,
        'sorted_ids': sortedIds
      }
    });
  }, 500);
};

Baked.prototype.reloadDynamic = function(){
  $.ajax({
    url: location.href,
    type: 'get',
    dataType: 'html',
    success: function(r){
      var $body = $('body');
      $(r).find('[data-bk-dynamic]').each(function(){
        var dynamic = $(this).attr('data-bk-dynamic');
        var selector = '[data-bk-dynamic='+dynamic+']';
        $body.find(selector).replaceWith(this);
      });
    }
  });
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

Baked.prototype.busyFilter = function(){
  if (this.busy > 0) {
    c("Busy!");
    return false;
  }
  if (!this.busy) this.busy = 0;
  this.busy++;
  return true;
}

Baked.prototype.busyEnd = function(){
  this.busy--;
}





