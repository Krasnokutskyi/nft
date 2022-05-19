$(document).ready(function(){

  $('input[name="card_number"]').mask('0000 0000 0000 0000');
  $('input[name="expiration_month"]').mask('00');
  $('input[name="expiration_year"]').mask('00');
  $('input[name="cvv"]').mask('000');

  // Remove comments
  removeComments();

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
    $('#purchase .purchase__summery-package[data-package_id=\"' + package_id + '\"]').css('display', 'flex');

    setPackageForPaymentSuccessful(package_id);
  });

  $('a[href="#next"]').on('click', function(e) {
    e.preventDefault();

    var form = $(this).closest('.purchase');

    form.find('.purchase__steps-step.current').removeClass('current').next().addClass('current');
    form.find('.purchase__step.current').removeClass('current').next().addClass('current');
  });

  $('a[href="#prev"]').bind('click', function(e) {

    e.preventDefault();

    $(this).parents('.purchase__step.current').removeClass('current').prev().addClass('current');
    $(this).parents('#purchase').find('.purchase__steps .purchase__steps-step.current').removeClass('current').prev().addClass('current');
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

    var package_id = $(this).attr('data-package_id');

    $('input[name="package"][value="' + package_id + '"]').prop("checked", true);

    $('#purchase .purchase__summery-package').hide();
    $('#purchase .purchase__summery-package[data-package_id=\"' + package_id + '\"]').css('display', 'flex');

    setPackageForPaymentSuccessful(package_id);
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

  // If there are siblings lock container
  $('.lock-container').siblings().find('.lock-container').remove();

  // Lock
  $('.lock-container').parent().closest('div').each(function() {

    $(this).css({
      'box-sizing': 'border-box',
      'position': 'relative',
      'overflow': 'hidden',
      'padding': $(this).css('padding') == '0px' ? '10px' : $(this).css('padding'),
    });

    $(this).find('.lock-container').css({
      'border-radius': $(this).css('border-radius') == '0px' ? '15px' : $(this).css('border-radius'),
    });
  });

  $('.lock-container').parent().closest('div').not('.item-lock').css({
    'margin-top': '5px',
  });

  // UnLock
  $('.lock-container .lock').hover(
    function() {
      $(this).find('svg').replaceWith('<i class="fas fa-unlock"></i>');
      $(this).find('span').text('Unlock content');
      removeComments();
    },
    function() {
      $(this).find('svg').replaceWith('<i class="fas fa-lock"></i>');
      $(this).find('span').text('Access is denied!');
      removeComments();
    }
  );

  $('#package-change a[href="#change_package"]').bind('click', function(e) {

    var package_id = $(this).attr('data-package_id');

    $('#package-change .purchase__summery-package').css('display', 'flex');
    $('#package-change .purchase__summery-package').not('[data-package_id=\"' + package_id + '\"]').hide();

    $('#package-change .purchase__step form input[name="package"]').val(package_id);

    $('#package-change .purchase__step.current').removeClass('current').next().addClass('current');

    var package = $('#package-change').find('.packages__item[data-package_id=\"' + package_id + '\"]');
    var package_image = $(package).find('.packages__img').html();
    var package_name = $(package).find('.packages__info .packages__title').html();
    var package_price = $(package).find('.packages__price .packages__price-current').html();

    var purchase = $('#package-change .purchase__step .purchase__finish[object-status="true"]');
    $(purchase).find('.purchase__finish-img').html(package_image);
    $(purchase).find('.purchase__finish-subtitle').html(package_name);
    $(purchase).find('.purchase__finish-price').html(package_price);
  });
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
  
      setTimeout(function(){
        preloader.stop();
        link.click();
      }, 750);
    }
  }).fail(function (jqXHR, textStatus) {
    setTimeout(function(){
      preloader.stop();
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Server connection error!'
      });
    }, 750);
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

function setPackageForPaymentSuccessful(package_id) {

  if ($('#packages').length) {

    var package = $('#packages').find('.packages__item[data-package_id=\"' + package_id + '\"]');
    var package_image = $(package).find('.packages__img').html();
    var package_name = $(package).find('.packages__info .packages__title').html();
    var package_price = $(package).find('.packages__price .packages__price-current').html();

    var purchase = $('#purchase .purchase__step .purchase__finish[object-status="true"]');
    $(purchase).find('.purchase__finish-img').html(package_image);
    $(purchase).find('.purchase__finish-subtitle').html(package_name);
    $(purchase).find('.purchase__finish-price').html(package_price);
  }
}

function setLockContent(events)
{
  events.preventDefault();
  $('#package-change').fadeIn(300);
  preloader.stopScroll();
}

function removeComments()
{
  $('*').contents().each(function() {
    if(this.nodeType === Node.COMMENT_NODE) {
      $(this).remove();
    }
  });
}