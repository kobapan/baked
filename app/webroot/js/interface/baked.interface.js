var baked = new Baked;

$(function(){
  var keyups = [];
  $(document).on('keyup', function(e){
    keyups.unshift(e.keyCode);
    if (keyups.length > 3) keyups.splice(3);
    if (keyups.join('') == '272727') {
      baked.goEditModeOrShowSigninBox();
      keyups = [];
    }
  });

  $(document).on('submit', '#bk-sign-in-form', function(e){
    var params = baked.params($(this));
    baked.post('system/api_system/sign_in', {
      data: params,
      ok: function(r){
        baked.goEditmode(function(){
          baked.reload();
        });
      }
    });
  });

  $(document).on('click', '[data-toggle]', function(e){
    var selector = $(this).attr('data-toggle');
    $(selector).toggle('fast');
  });
});

function c(val) {
  console.log(val);
}
