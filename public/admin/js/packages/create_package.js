document.addEventListener("DOMContentLoaded", () => {

  $('select[name="redirect_content[]"]').select2({
    placeholder: "First, select the content that will be available to the user."
  });

  $('input[name="content[]"]').change(function(){

    $('select[name="redirect_content[]"] option').remove();

    var checkbox = $('input[name="content[]"]:checked');

    for (var i = 0; i < checkbox.length; i++) {
      var option = document.createElement("option");
      option.value = $(checkbox[i]).val();
      option.text = $(checkbox[i]).siblings('label').text().trim();
      $('select[name="redirect_content[]"]').append(option);
    }

    $('select[name="redirect_content[]"]').select2("destroy");
    $('select[name="redirect_content[]"]').select2({
      placeholder: "First, select the content that will be available to the user."
    });
  });
});