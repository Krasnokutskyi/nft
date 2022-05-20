var ajaxForm = new Object();

ajaxForm.callbackAjaxUpdateForm = function (form, data)
{
  if (data.status === false) {

    $.each(data.errors, function(prefix, val){
      $(form).find('.' + prefix + '_error').text(val[0]);
      $(form).find('.' + prefix + '_error').show();
      $(form).find('[name="' + prefix + '"]').addClass('is-invalid');
      $(form).find('[name="' + prefix + '"]').parents('.input-group').addClass('invalid-feedback');
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

  if (data.redirect) {
    window.location.href = data.redirect;
  }
}

ajaxForm.refreshToken = function()
{
  $.ajax({
    url: '/refresh-token/',
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      $('[name="_token"]').val(response.csrf_token);
      $('meta[name="csrf-token"]').attr('content', response.csrf_token);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': response.csrf_token
        }
      });
    }
  });
}

document.addEventListener("DOMContentLoaded", () => {
  $(function(){
    $('.ajax-form').on('submit', function(e){

      e.preventDefault();

      var form = this;

      $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){

          if ($(form).is("[preloader-ajax-form]")) {
            preloader.start($(form).attr('preloader-ajax-form'));
          }

          $(form).find('.error-text').hide();
          $(form).find('.error-text').text('');
          $(form).find('input, textarea, select').removeClass('is-invalid');
          $(form).find('.input-group').removeClass('invalid-feedback');
        },
        success: function(data) {

          if ($(form).is("[preloader-ajax-form]")) {
            setTimeout( function() {

              preloader.stop($(form).attr('preloader-ajax-form'));

              ajaxForm.callbackAjaxUpdateForm(form, data);
              
            }, 500);

          } else {

            ajaxForm.callbackAjaxUpdateForm(form, data);
          }
        }

      }).fail(function (jqXHR, textStatus) {

        if (jqXHR.status === 419) {

          ajaxForm.refreshToken();
          $(form).submit();

          return;
        }

        if ($(form).is("[preloader-ajax-form]")) {
          setTimeout( function() {
            preloader.stop($(form).attr('preloader-ajax-form'));
          }, 350);
        }

        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'The request failed or the service hasn\'t been respond in a timely fashion!'
        });
      });
    });
  });
});