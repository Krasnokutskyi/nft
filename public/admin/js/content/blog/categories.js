function remove_category(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the category?",   
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
            $(e).parents('tr').remove();
            if ($('table tbody tr').length <= 1) {
              location.reload();
            }
          }
        }
      });
    }
  });
}