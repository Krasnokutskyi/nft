function delete_user(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the user?",   
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
          }
        }
      });
    }
  });
}