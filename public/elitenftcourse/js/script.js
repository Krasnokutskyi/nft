$(document).ready(function(){

  $('.faq__item').on('click', function() {
    $('.faq__item').removeClass('active');
    $('.faq__text-wrap').height(0);


    var isActive = $(this).hasClass('active');
    var textHeight = $(this).find('.faq__text').outerHeight();

    if (isActive) return;
  
    $(this).toggleClass('active');
    $(this).find('.faq__text-wrap').height(textHeight);
  });

  $('.purchase input[name="first_name"], .purchase input[name="last_name"], .purchase input[name="phone"], .purchase input[name="email"]').on('input', function() {
    var first_name = $('.purchase input[name="first_name"]').val();
    var last_name = $('.purchase input[name="last_name"]').val();
    var phone = $('.purchase input[name="phone"]').val();
    var email = $('.purchase input[name="email"]').val();
    $('.purchase .purchase__summery .purchase__summery-data .full_name').html(first_name + ' ' + last_name);
    $('.purchase .purchase__summery .purchase__summery-data .phone').html(phone);
    $('.purchase .purchase__summery .purchase__summery-data .email').html(email);
  });


  $('a[href="#next"]').on('click', function(e) {
    e.preventDefault();

    var form = $(this).closest('.purchase');

    form.find('.purchase__steps-step.current').removeClass('current').next().addClass('current');
    form.find('.purchase__step.current').removeClass('current').next().addClass('current');
  });

  $('a[href="#prev"]').on('click', function(e) {
    e.preventDefault();

    var form = $(this).closest('.purchase');

    form.find('.purchase__steps-step.current').removeClass('current').prev().addClass('current');
    form.find('.purchase__step.current').removeClass('current').prev().addClass('current');

  });


  $('a[href="#purchase"]').on('click', function(e) {
    e.preventDefault();
    $('#purchase').fadeIn(300);
  });


  $('a[href="#login"]').on('click', function(e) {
    e.preventDefault();
    $('#login').fadeIn(300);
  });

  $('a[href="#terms"]').on('click', function(e) {
    e.preventDefault();
    $('#terms').fadeIn(300);
  });

  $('a[href="#privacy"]').on('click', function(e) {
    e.preventDefault();
    $('#privacy').fadeIn(300);
  });

  $('.popup__close').on('click', function(e) {
    e.preventDefault();
    $('.popup').fadeOut(300);
  });

  $('.menu a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    var anchor = $(this).attr('href');
    var headerHeight = $('.header').outerHeight();
    var scrollTo = $(anchor).offset().top;

    $('body, html').animate({
      scrollTop: scrollTo - headerHeight
    }, 300);
  })


  // Blog
  if ($('.blog_inner').length) {
    $.each($('.blog_inner blockquote span'), function(index, value){
      $(value).parents('blockquote').css("border-color", $(value).css('color'));
    });
    $.each($('.blog_inner blockquote span'), function(index, value){
      $(value).parents('blockquote').css("border-color", $(value).css('color'));
    });
  }
});

function downloadFile (event, a) {

  event.preventDefault();

  $.ajax({
    url: $(a).attr('href'),
    data: $(a).serialize(),
    dataType: 'binary',
    xhrFields: {
      'responseType': 'blob'
    },
    beforeSend: function () {
      preloader.start();
    },
    success: function (data, status, xhr) {

      var link = document.createElement('a');
      var filename = $(a).attr('download');

      link.href = URL.createObjectURL(data);
      link.download = filename;
      link.click();
  
      setTimeout(preloader.stop(), 750);
    }
  });
}

function showVideo (url_video, preview = '') {
  Swal.fire({
    html: 
      '<video controls="controls" poster="' + preview + '">' +
        '<source src="' + url_video + '">' +
        'Your browser does not support the video tag.' +
      '</video>',
    showCloseButton: true,
    showCancelButton: false,
    showConfirmButton: false,
    cancelButtonText:'<i class="fa fa-thumbs-down"></i>',
    customClass: {
      container: 'container-show_video',
      popup: 'popup-show_video',
    }
  });
}