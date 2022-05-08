document.addEventListener("DOMContentLoaded", () => {

  $(".js__p_start").simplePopup();

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
      var market_id = $(ui.item).attr('data-market_id');

      $.ajax({
        url: url_sortable,
        type: "POST",
        data: {
          "_token": $('meta[name="csrf-token"]').attr('content'),
          "new_index": new_index,
          "old_index": old_index,
          "market_id": market_id
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

function remove_item(e)
{
  event.preventDefault();
  Swal.fire({
    icon: 'question',
    title: "Are you sure?",   
    text: "Are you sure you want to delete the item?",   
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
                'Item has been deleted.',
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