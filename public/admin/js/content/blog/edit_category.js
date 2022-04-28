function set_subtitle(text)
{
  var head = $('form .subtitle').attr('data-head');
  if (head === undefined || head === null) {
    head = '';
  }
  $('form .subtitle').text(head + text);
}

function formatAlias(text = '', updateAlias = false)
{
  var url_category = $('form').find('input[name="alias"]').attr('data-url_category');
  var alias = transliterator.format_uri(text);
  if (updateAlias) {
    $('input[name="alias"]').val(alias);
  }
  set_subtitle(' ' + url_category.replace('%alias%', alias));
}

function hideAndShowPackages(object)
{
  if ($(object).val() === 'packages') {
    $('.categories-packages').removeClass('d-none');
  } else {
    $('.categories-packages').addClass('d-none');
  }
}

$('input[name="alias"]').on('input', function() {
  $(this).val( $(this).val().toLowerCase() );
  formatAlias( $(this).val() );
});

$('body').on('submit', 'form', function () {
  var textAliasInput = $(this).find('input[name="alias"]').val();
  formatAlias(textAliasInput, true);
});

document.addEventListener("DOMContentLoaded", () => {

  hideAndShowPackages($('select[name=access]'));

  var url_category = $('form').find('input[name="alias"]').attr('data-url_category');
  if ($('input[name="alias"]').val() != '') {
    var alias = $('input[name="alias"]').val();
    set_subtitle(' ' + url_category.replace('%alias%', alias));
  } else {
    set_subtitle(' ' + url_category.replace('%alias%', ''));
  }
});

$('select[name=access]').on('change', function() {
  hideAndShowPackages(this);
});
