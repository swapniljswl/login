(function($) {

  var rightDrawer = {

    init: function(options, div){
      var wrapper = $(div).wrap('<div class="drawer-wrapper drawer-right"></div>').parent();
      var btnId = div.attr('id') + '-left-btn'
      wrapper.append('<button id=' + btnId + ' class="toggle-drawer-btn left-btn"></button>');
      var btn = $('#' + btnId).button({
        icons: {
          primary: "ui-icon-triangle-1-e"
        },
        text: false
      });

      toggleBtnWidth = btn.outerWidth(true);
      wrapper.width($(div).outerWidth(true) + toggleBtnWidth);
      wrapper.height($(div).outerHeight(true));

      if(options.type == 'sticky'){
        wrapper.css({position: 'fixed', 'z-index': '999'});
      } else {
        wrapper.css({position: 'absolute'});
      }
      
      if (options.top){
        wrapper.css({top: options.top});
      }

      if (options.bottom){
        wrapper.css({bottom: options.bottom});
      }

      if (options.handleSize){
        btn.css({height: options.handleSize});
      }

      btn.on('click', function(){
        if (wrapper.width() <= toggleBtnWidth){

          $(div).show();
          wrapper.animate( {width: $(div).outerWidth(true) + toggleBtnWidth}, function(){
            wrapper.width($(div).outerWidth(true) + toggleBtnWidth);
            wrapper.height($(div).outerHeight(true));
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-e"
              },
              text: false
            });
          });
        } else {
          wrapper.animate( {width: toggleBtnWidth}, function(){
            $(div).hide();
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-w"
              },
              text: false
            });
          });
        }
      });
    }
  };

  var leftDrawer = {

    init: function(options, div){
      var wrapper = $(div).wrap('<div class="drawer-wrapper drawer-left"></div>').parent();
      var btnId = div.attr('id') + '-right-btn'
      wrapper.append('<button id=' + btnId + ' class="toggle-drawer-btn right-btn"></button>');
      var btn = $('#' + btnId).button({
        icons: {
          primary: "ui-icon-triangle-1-w"
        },
        text: false
      });

      toggleBtnWidth = btn.outerWidth(true);
      wrapper.width($(div).outerWidth(true) + toggleBtnWidth);
      wrapper.height($(div).outerHeight(true));

      if(options.type == 'sticky'){
        wrapper.css({position: 'fixed', 'z-index': '999'});
      } else {
        wrapper.css({position: 'absolute'});
      }
      
      if (options.top){
        wrapper.css({top: options.top});
      }

      if (options.bottom){
        wrapper.css({bottom: options.bottom});
      }

      if (options.handleSize){
        btn.css({height: options.handleSize});
      }

      btn.on('click', function(){
        if (wrapper.width() <= toggleBtnWidth){

          $(div).show();
          wrapper.animate( {width: $(div).outerWidth(true) + toggleBtnWidth}, function(){
            wrapper.width($(div).outerWidth(true) + toggleBtnWidth);
            wrapper.height($(div).outerHeight());
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-w"
              },
              text: false
            });

          });
        } else {
          wrapper.animate( {width: toggleBtnWidth}, function(){
            $(div).hide();
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-e"
              },
              text: false
            });
          });
        }
      });
    }
  };

  var topDrawer = {

    init: function(options, div){
      var wrapper = $(div).wrap('<div class="drawer-wrapper drawer-top"></div>').parent();
      var btnId = div.attr('id') + '-bottom-btn'
      wrapper.append('<button id=' + btnId + ' class="toggle-drawer-btn bottom-btn"></button>');
      var btn = $('#' + btnId).button({
        icons: {
          primary: "ui-icon-triangle-1-n"
        },
        text: false
      });

      toggleBtnHeight = btn.outerHeight(true);
      wrapper.width($(div).outerWidth(true));
      wrapper.height($(div).outerHeight(true) + toggleBtnHeight);

      if(options.type == 'sticky'){
        wrapper.css({position: 'fixed'});
      } else {
        wrapper.css({position: 'absolute'});
      }

      if (options.left){
        wrapper.css({left: options.left});
      }

      if (options.right){
        wrapper.css({right: options.right});
      }

      if (options.handleSize){
        btn.css({width: options.handleSize});
      }

      btn.on('click', function(){
        if (wrapper.height() <= toggleBtnHeight){

          $(div).show();
          wrapper.animate( {height: $(div).outerHeight(true) + toggleBtnHeight}, function(){
            wrapper.height($(div).outerHeight(true) + toggleBtnHeight);
            wrapper.width($(div).outerWidth());
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-n"
              },
              text: false
            });
          });
        } else {
          wrapper.animate( {height: toggleBtnHeight}, function(){
            $(div).hide();
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-s"
              },
              text: false
            });
          });
        }
      });

    }
  };

  var bottomDrawer = {

    init: function(options, div){
      var wrapper = $(div).wrap('<div class="drawer-wrapper drawer-bottom"></div>').parent();
      var btnId = div.attr('id') + '-top-btn'
      wrapper.append('<button id=' + btnId + ' class="toggle-drawer-btn top-btn"></button>');
      var btn = $('#' + btnId).button({
        icons: {
          primary: "ui-icon-triangle-1-s"
        },
        text: false
      });

      toggleBtnHeight = btn.outerHeight(true);
      wrapper.width($(div).outerWidth(true));
      wrapper.height($(div).outerHeight(true) + toggleBtnWidth);

      if(options.type == 'sticky'){
        wrapper.css({position: 'fixed'});
      } else {
        wrapper.css({position: 'absolute'});
      }

      if (options.left){
        wrapper.css({left: options.left});
      }

      if (options.right){
        wrapper.css({right: options.right});
      }

      if (options.handleSize){
        btn.css({width: options.handleSize});
      }

      btn.on('click', function(){
        if (wrapper.height() <= toggleBtnHeight){

          $(div).show();
          wrapper.animate( {height: $(div).outerHeight(true) + toggleBtnHeight}, function(){
            wrapper.height($(div).outerHeight(true) + toggleBtnHeight);
            wrapper.width($(div).outerWidth());
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-s"
              },
              text: false
            });
          });
        } else {
          wrapper.animate( {height: toggleBtnHeight}, function(){
            $(div).hide();
            btn.button({
              icons: {
                primary: "ui-icon-triangle-1-n"
              },
              text: false
            });
          });
        }
      });

    }
  };

  $.fn.drawer = function( options ) {

    var options = $.extend({
      align: 'right',
      type: 'normal' //sticky
    }, options);

    if (options.align == 'left'){
      return leftDrawer.init(options, this);
    }

    if (options.align == 'right'){
      return rightDrawer.init(options, this);
    }

    if (options.align == 'top'){
      return topDrawer.init(options, this);
    }

    if (options.align == 'bottom'){
      return bottomDrawer.init(options, this);
    }

  };

}(jQuery));
