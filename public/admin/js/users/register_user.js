document.addEventListener("DOMContentLoaded", () => {

  var phone = $('form input[name="phone"]').val().trim();
  if (phone.charAt(0) !== '+' && phone.length > 1) {
    $('form input[name="phone"]').val('+' + phone);
  }

  $('select[name="package"]').select2();

  $('form input[name="phone"]').on('input', function() {
    var phone = $(this).val().trim();
    if (phone.charAt(0) !== '+') {
      $(this).val('+' + phone);
    }
  });
});