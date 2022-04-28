function remove_post(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the post?",   
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
                'Post has been deleted.',
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