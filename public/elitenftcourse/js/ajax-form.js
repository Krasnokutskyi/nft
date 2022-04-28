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

          if ($(form).hasClass('full_preloader-ajax-form')) {
            preloader.start();
          }

          $(form).find('.error-text').hide();
          $(form).find('.error-text').text('');
          $(form).find('input, textarea, select').removeClass('is-invalid');
        },
        success: function(data) {

          if ($(form).hasClass('full_preloader-ajax-form')) {
            setTimeout(preloader.stop(), 500);
          }

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

          if (data.redirect) {
            window.location.href = data.redirect;
          }

          // Steps
          var steps = $(form).find('.step-ajax-form');
          if (steps.length > 0) {
            for (var i = 0; i < steps.length; i++) {
              
              if ($(steps[i]).find('.is-invalid').length && !$(steps[i]).hasClass('current')) {

                $(form).find('.step-ajax-form').removeClass('current');
                $(steps[i]).addClass('current');

                $('[step-ajax-form="register"]').removeClass('current');
                $('[step-ajax-form="register"]:eq(' + i +')').addClass('current');

                break;

              } else if ($(steps[i]).hasClass('current') && $(steps[i]).find('.is-invalid').length == 0 && (i + 1) !== steps.length) {
                
                $(form).find('.error-text').hide();
                $(form).find('.error-text').text('');
                $(form).find('input, textarea, select').removeClass('is-invalid');

                $(steps[i]).removeClass('current').next().addClass('current');
                $('.current[step-ajax-form="register"]').removeClass('current').next().addClass('current');
              
                break;
              }

              if ($(steps[i]).hasClass('current')) {
                break;
              }
            }
          }
        }
      }).fail(function (jqXHR, textStatus) {
        if ($(form).hasClass('full_preloader-ajax-form')) {
          setTimeout(preloader.stop(), 1000);
        }
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Server connection error!'
        });
      });
    });
  });
});