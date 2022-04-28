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

  $('select[name=access]').on('change', function() {
    hideAndShowPackages(this);
  });

  $("#video").filer({
    limit: 1,
    maxSize: null,
    extensions: ['mp4', 'webm', 'ogv', 'swf'],
    changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop video file here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse video file</a></div></div>',
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
      itemAppend: '<li class="jFiler-item video-item">\
              <div class="jFiler-item-container">\
                <div class="jFiler-item-inner">\
                  <div class="jFiler-item-thumb">\
                    <div class="jFiler-item-status"></div>\
                    <div class="jFiler-item-thumb-video">\
                      <video loop="loop" autoplay="autoplay" muted="muted" controls="controls">\
                       <source src="' + video[0].file + '" type="video/mp4">\
                      </video>\
                    </div>\
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
      removeConfirmation: false,
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
    clipBoardPaste: false,
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
      button: "Choose video file",
      feedback: "Choose video file To Upload",
      feedback2: "Video file was chosen",
      drop: "Drop video file here to Upload",
      removeConfirmation: "Are you sure you want to remove this video file?",
      errors: {
        filesLimit: "Only {{fi-limit}} video files are allowed to be uploaded.",
        filesType: "Only video files are allowed to be uploaded.",
        filesSize: "{{fi-name}} is too large! Please upload video file up to {{fi-maxSize}} MB.",
        filesSizeAll: "Video files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
      }
    },
    files: video,
    onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
      var result = null;
      Swal.fire({
        icon: 'question',
        title: "Are you sure you want to remove this video?", 
        showCancelButton: true,
        confirmButtonColor: "red", 
        cancelButtonText: "Cancel",  
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.value) {
          $('form').find('input[name="remote_video"').val(file.name);
          $(itemEl).remove();
        }
      });
      return false;
    },
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
      removeConfirmation: false,
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
    clipBoardPaste: false,
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
    },
    files: preview,
    onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl) {
      var result = null;
      Swal.fire({
        icon: 'question',
        title: "Are you sure you want to remove this image?", 
        showCancelButton: true,
        confirmButtonColor: "red", 
        cancelButtonText: "Cancel",  
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.value) {
          $('form').find('input[name="remote_preview"').val(file.name);
          $(itemEl).remove();
        }
      });
      return false;
    }
  });
});