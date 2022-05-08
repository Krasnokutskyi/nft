var preloader = class {

  constructor() {}

  static stopScroll()
  {
    $('body').addClass('stop-scroll');
    $('body').bind(
      'touchmove', function (e) {
        e.preventDefault();
      }
    );
  }

  static onScroll()
  {
    $('body').removeClass('stop-scroll');
    $('body').unbind('touchmove');
  }

  static start(parent = 'body', text = '')
  {
    if ($(parent).find('.loader').length == 0) {

      var container = document.createElement('div');
      container.className = 'loader';
      $(parent).append(container);

      var loader_linner = document.createElement('div');
      loader_linner.className = 'loader-inner';
      $(container).append(loader_linner);

      var wrapper = document.createElement('div');
      wrapper.className = 'wrapper';
      $(loader_linner).append(wrapper);

      for (var i = 0; i < 7; i++) {  
        $(wrapper).append('<div class="loader-dot-wrap"><div class="dot"></div></div>');
      }

      var text_block = document.createElement('div');
      text_block.className = 'text';
      $(loader_linner).append(text_block);

      if (!text) {
        text = 'Please wait';
      }

      $(parent).find('.loader .loader-inner .text').html(text);
    }
  }

  static stop(parent = 'body')
  {
    $(parent).find('.loader').remove();
    this.onScroll();
  }
}