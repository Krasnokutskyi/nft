$(document).ready(function(){

  // Purchase
  $('#purchase .purchase__summery-package').not('.current').hide();

  $('.faq__item').on('click', function() {
    $('.faq__item').removeClass('active');
    $('.faq__text-wrap').height(0);
    var isActive = $(this).hasClass('active');
    var textHeight = $(this).find('.faq__text').outerHeight();

    if (isActive) return;
  
    $(this).toggleClass('active');
    $(this).find('.faq__text-wrap').height(textHeight);
  });

  $('#purchase input[name="first_name"], #purchase input[name="last_name"], #purchase input[name="phone"], #purchase input[name="email"]').on('input', function() {
    var first_name = $('.purchase input[name="first_name"]').val();
    var last_name = $('.purchase input[name="last_name"]').val();
    var phone = $('.purchase input[name="phone"]').val();
    var email = $('.purchase input[name="email"]').val();
    $('#purchase .purchase__summery .purchase__summery-data .full_name').html(first_name + ' ' + last_name);
    $('#purchase .purchase__summery .purchase__summery-data .phone').html(phone);
    $('#purchase .purchase__summery .purchase__summery-data .email').html(email);
  });

  $("#purchase input[name='package']").change(function() {
    var package_id = $(this).val();
    $('#purchase .purchase__summery-package').hide();
    $('#purchase .purchase__summery-package data-package_id="' + package_id + '"').css('display', 'flex');
  });

  $('a[href="#next"]').on('click', function(e) {
    e.preventDefault();

    var form = $(this).closest('.purchase');

    form.find('.purchase__steps-step.current').removeClass('current').next().addClass('current');
    form.find('.purchase__step.current').removeClass('current').next().addClass('current');
  });

  $('a[href="#prev"]').on('click', function(e) {

    e.preventDefault();

    $(this).parents('.purchase__step.current').removeClass('current').prev().addClass('current');
    $(this).parents('purchase__steps').find('.purchase__step.current').removeClass('current').prev().addClass('current');
  });


  $('a[href="#purchase"]').on('click', function(e) {
    e.preventDefault();
    $('#purchase').fadeIn(300);
  });

  $('a[href="#login"]').on('click', function(e) {
    e.preventDefault();
    $('#login').fadeIn(300);
    preloader.stopScroll();
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
    preloader.onScroll();
  });

  $('a[href="#buy_package"]').on('click', function(e) {
    
    e.preventDefault();

    $([document.documentElement, document.body]).animate({
      scrollTop: $("#welcome").offset().top - $("#welcome").height()
    }, 400);
    setTimeout(function(){
      $('#purchase').fadeIn(300);
    }, 350);

    $('input[name="package"][value="' + $(this).attr('data-package_id') + '"]').prop("checked", true);
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

  $('form input[name="phone"]').on('input', function() {
    var phone = $(this).val().trim();
    if (phone.charAt(0) !== '+') {
      $(this).val('+' + phone);
    }
  });

  if ($('input[name="package"]').length) {
    if ($('input[name="package"]:checked').length == 0){
      $('input[name="package"]:first').prop("checked", true);
    }
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
  
      setTimeout(function(){
        preloader.stop();
      }, 750);
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