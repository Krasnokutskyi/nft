document.addEventListener("DOMContentLoaded", () => {
  $(function(){
    $('.ajax-form').on('submit', function(e){

      e.preventDefault();

      var form = this;

      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){

          if ($(form).is("[preloader-ajax-form]")) {
            preloader.start($(form).attr('preloader-ajax-form'));
          }

          $(form).find('.error-text').hide();
          $(form).find('.error-text').text('');
          $(form).find('input, textarea, select').removeClass('is-invalid');
        },
        success: function(data) {
          if ($(form).is("[preloader-ajax-form]")) {
            setTimeout( function() {

              preloader.stop($(form).attr('preloader-ajax-form'));

              callbackAjaxUpdateForm(form, data);
              
            }, 500);

          } else {

            callbackAjaxUpdateForm(form, data);
          }
        }
      }).fail(function (jqXHR, textStatus) {
        if ($(form).is("[preloader-ajax-form]")) {
          setTimeout(function() {
            preloader.stop($(form).attr('preloader-ajax-form'));
          }, 250);
        }
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Server connection error!'
        });
      });
    });
  });

  function callbackAjaxUpdateForm(form, data)
  {
    if (data.status === false) {

      $.each(data.errors, function(prefix, val){
        $(form).find('.' + prefix + '_error').text(val[0]);
        $(form).find('.' + prefix + '_error').show();
        $(form).find('[name="' + prefix + '"]').addClass('is-invalid');
      });

      if (data.message) {

        if (typeof data.title !== 'number' || typeof data.title !== 'string') {
          data.title = 'Oops...';
        }

        Swal.fire({
          icon: 'error',
          title: data.title,
          text: data.message
        })
      }

    } else {

      if (typeof data.title === 'string') {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: data.title,
          showConfirmButton: false,
          timer: 2000
        })
      }
    }

      if (typeof data.step === 'string') {
        if (data.step === 'next') {

          var next_step = $(form).attr('next_step-ajax-form');

          $(next_step).addClass('current').prev().removeClass('current');

          if (data.status && $(next_step).find('[object-status]').length) {
            $(next_step).find("[object-status=\"true\"]").show();
            $(next_step).find("[object-status=\"false\"]").hide();
          } else {
            $(next_step).find("[object-status=\"false\"]").show();
            $(next_step).find("[object-status=\"true\"]").hide();
          }
        }
      }

    if (data.redirect) {
      window.location.href = data.redirect;
    }

    if (data.urls instanceof Array || data.urls instanceof Object) {
      $.each(data.urls, function(key, value) {
        $('a[href=\"#' + key + '\"]').attr('href', value);
      });
    }
  }
});