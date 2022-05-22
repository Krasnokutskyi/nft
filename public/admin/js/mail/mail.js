document.addEventListener("DOMContentLoaded", () => {

  var quill = new Quill('#editor', {
    modules: {
      'toolbar': [
        [ { 'size': [] } ],
        [ 'bold', 'italic', 'underline', 'strike' ],
        [ { 'color': [] }, { 'background': [] } ],
        [ { 'header': '1' }, { 'header': '2' } ],
        [ { 'list': 'ordered' }, { 'list': 'bullet'}, { 'align': [] } ],
        [ 'link', 'image' ],
        ['emoji'],
      ],
      'imageResize': {},
      'imageDrop': true,
      "emoji-toolbar": true,
      "emoji-shortname": true,
      "emoji-textarea": true
    },
    theme: 'snow'
  });

  quill.on('text-change', function() {
    var html = quill.root.innerHTML;
    if (quill.getText().trim().length > 0 || quill.getContents()['ops'].length > 1) {
      $('.create_post-form').find('textarea[name="text"]').val(html);
    } else {
      $('form').find('textarea[name="text"]').val('');
    }
  });
});