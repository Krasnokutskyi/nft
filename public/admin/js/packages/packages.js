document.addEventListener("DOMContentLoaded", () => {
  $('tbody.list').sortable({
    start: function(e, ui) {
      // creates a temporary attribute on the element with the old index
      $(this).attr('data-previndex', ui.item.index());
    },
    update: function(e, ui) {

      // gets the new and old index then removes the temporary attribute
      var new_index = ui.item.index();
      var old_index = $(this).attr('data-previndex');
      $(this).removeAttr('data-previndex');

      var url_sortable = $(this).attr('data-url_sortable');
      var package_id = $(ui.item).attr('data-package_id');

      $.ajax({
        url: url_sortable,
        type: "POST",
        data: {
          "_token": $('meta[name="csrf-token"]').attr('content'),
          "new_index": new_index,
          "old_index": old_index,
          "package_id": package_id
        },
        beforeSend: function(){
          preloader.start('.card');
        },
        success: function (response) {
          setTimeout(preloader.stop('.card'), 300);
        }
      });
    }
  });
});

function remove_package(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the package?",   
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
        beforeSend: function(){
          preloader.start('.card');
        },
        success: function (response) {

          setTimeout( function() {

            preloader.stop('.card');

            if (response.result === true) {
              if ($('table tbody tr').length <= 1) {
                location.reload();
              } else {
                Swal.fire(
                  'Deleted!',
                  'Package has been deleted.',
                  'success'
                );
                $(e).parents('tr').remove();
              }
            } else {

              if (response.message) {

                if (typeof response.title !== 'number' || typeof response.title !== 'string') {
                  response.title = 'Oops...';
                }

                Swal.fire({
                  icon: 'error',
                  title: response.title,
                  text: response.message
                })
              }
            }
            
          }, 500);
        }
      }).fail(function (jqXHR, textStatus) {
        setTimeout( function() {
          preloader.stop('.card');
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The request failed or the service hasn\'t been respond in a timely fashion!'
          });
        }, 500);
      });
    }
  });
}