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
  var url = $('.create_post-form').find('input[name="alias"]').attr('data-url_post');
  var alias = transliterator.format_uri(text);
  if (updateAlias) {
    $('input[name="alias"]').val(alias);
  }
  set_subtitle(' ' + url.replace('%alias%', alias));
}

$('input[name="title"]').on('input', function() {
  formatAlias($(this).val(), true);
});

$('input[name="alias"]').on('input', function() {
  $(this).val( $(this).val().toLowerCase() );
  formatAlias( $(this).val() );
});

$('body').on('submit', 'form.create_post-form', function () {
  var textAliasInput = $(this).find('input[name="alias"]').val();
  formatAlias(textAliasInput, true);
});

function hideAndShowPackages(object)
{
  if ($(object).val() === 'packages') {
    $('.post-packages').removeClass('d-none');
  } else {
    $('.post-packages').addClass('d-none');
  }
}

document.addEventListener("DOMContentLoaded", () => {

  hideAndShowPackages($('select[name=access]'));

  var quill = new Quill('#editor', {
    modules: {
      'toolbar': [
        [{ 'font': [] }, { 'size': [] }],
        [ 'bold', 'italic', 'underline', 'strike' ],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'script': 'super' }, { 'script': 'sub' }],
        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
        [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
        [ 'direction', { 'align': [] }],
        [ 'link', 'image', 'video', 'formula' ],
        [ 'clean' ],
      ],
      'imageResize': {},
      'imageDrop': true,
      'videoResize': {}
    },
    theme: 'snow'
  });

  quill.on('text-change', function() {
    var html = quill.root.innerHTML;
    if (quill.getText().trim().length > 0 || quill.getContents()['ops'].length > 1) {
      $('.create_post-form').find('textarea[name="text"]').val(html);
    }
  });

  var url = $('.create_post-form').find('input[name="alias"]').attr('data-url_post');
  if ($('input[name="alias"]').val() != '') {
    var alias = $('input[name="alias"]').val();
    set_subtitle(' ' + url.replace('%alias%', alias));
  } else {
    set_subtitle(' ' + url.replace('%alias%', ''));
  }

  $('select[name=access]').on('change', function() {
    hideAndShowPackages(this);
  });

  $('#preview').filer({
    limit: 1,
    maxSize: null,
    extensions: ['wepb', 'jpeg', 'svg', 'png', 'jpg', 'gif'],
    changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop image here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse image file</a></div></div>',
    showThumbs: true,
    theme: "dragdropbox",
    templates: {
      box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
      item: '<li class="jFiler-item">\
            <div class="jFiler-item-container">\
              <div class="jFiler-item-inner">\
                <div class="jFiler-item-thumb">\
                  <div class="jFiler-item-status"></div>\
                  <div class="jFiler-item-thumb-overlay">\
                    <div class="jFiler-item-info">\
                      <div style="display:table-cell;vertical-align: middle;">\
                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                      </div>\
                    </div>\
                  </div>\
                  {{fi-image}}\
                </div>\
                <div class="jFiler-item-assets jFiler-row">\
                  <ul class="list-inline pull-left">\
                    <li>{{fi-progressBar}}</li>\
                  </ul>\
                  <ul class="list-inline pull-right">\
                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                  </ul>\
                </div>\
              </div>\
            </div>\
          </li>',
      itemAppend: '<li class="jFiler-item">\
              <div class="jFiler-item-container">\
                <div class="jFiler-item-inner">\
                  <div class="jFiler-item-thumb">\
                    <div class="jFiler-item-status"></div>\
                    <div class="jFiler-item-thumb-overlay">\
                      <div class="jFiler-item-info">\
                        <div style="display:table-cell;vertical-align: middle;">\
                          <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
                          <span class="jFiler-item-others">{{fi-size2}}</span>\
                        </div>\
                      </div>\
                    </div>\
                    {{fi-image}}\
                  </div>\
                  <div class="jFiler-item-assets jFiler-row">\
                    <ul class="list-inline pull-left">\
                      <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                    </ul>\
                    <ul class="list-inline pull-right">\
                      <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                    </ul>\
                  </div>\
                </div>\
              </div>\
            </li>',
      progressBar: '<div class="bar"></div>',
      itemAppendToEnd: false,
      canvasImage: true,
      removeConfirmation: true,
      _selectors: {
        list: '.jFiler-items-list',
        item: '.jFiler-item',
        progressBar: '.bar',
        remove: '.jFiler-item-trash-action'
      }
    },
    dragDrop: {},
    addMore: false,
    allowDuplicates: false,
    clipBoardPaste: true,
    dialogs: {
      alert: function(text) {
        return Swal.fire(text);
      },
      confirm: function (text, callback) {
        Swal.fire({
          icon: 'question',
          title: text, 
          showCancelButton: true,
          confirmButtonColor: "red", 
          cancelButtonText: "Cancel",  
          confirmButtonText: "Ok",
        }).then((result) => {
          if (result.value) {
            callback();
          }
        });
      }
    },
    captions: {
      button: "Choose image",
      feedback: "Choose image To Upload",
      feedback2: "Image was chosen",
      drop: "Drop image here to Upload",
      removeConfirmation: "Are you sure you want to remove this image?",
      errors: {
        filesLimit: "Only {{fi-limit}} images are allowed to be uploaded.",
        filesType: "Only images are allowed to be uploaded.",
        filesSize: "{{fi-name}} is too large! Please upload image up to {{fi-maxSize}} MB.",
        filesSizeAll: "Images you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
      }
    }
  });

});