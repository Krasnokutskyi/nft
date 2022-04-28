function remove_file(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the file?",   
    showCancelButton: true,
    confirmButtonColor: "red", 
    cancelButtonText: "Cancel",  
    confirmButtonText: "Delete!",
  }).then((result) => {
    if (result.value) {
      var url = $(e).attr('href');
      $.ajax({
        url: url,
        type: "POST",
        data: {
          "_token": $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          if (response.result === true) {
            if ($('table tbody tr').length <= 1) {
              location.reload();
            } else {
              Swal.fire(
                'Deleted!',
                'File has been deleted.',
                'success'
              );
              $(e).parents('tr').remove();
            }
          }
        }
      }).fail(function (jqXHR, textStatus) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'The request failed or the service hasn\'t been respond in a timely fashion!'
        });
      });
    }
  });
}

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
      preloader.start('body');
    },
    success: function (data, status, xhr) {

      var link = document.createElement('a');
      var filename = $(a).attr('download');

      link.href = URL.createObjectURL(data);
      link.download = filename;
      link.click();
  
      setTimeout(preloader.stop('body'), 750);
    }
  }).fail(function (jqXHR, textStatus) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'The request failed or the service hasn\'t been respond in a timely fashion!'
    });
  });
}