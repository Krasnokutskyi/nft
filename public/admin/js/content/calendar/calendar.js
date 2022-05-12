var calendar = new tui.Calendar('#calendar', {
  defaultView: 'month',
  useCreationPopup: true,
  useDetailPopup: true
});

calendar.createSchedules(schedules);

$(document).bind('DOMNodeInserted', function(event) {

  var popup = $(event.target).find('.tui-full-calendar-popup');

  if (popup.length) {

    // Title schedule
    $(popup).find('input#tui-full-calendar-schedule-title').attr('placeholder', 'Title');

    // Text schedule
    var textarea = document.createElement("div");
    textarea.id = "editor";
    $(popup).find('.tui-full-calendar-popup-section:eq(1)').after(textarea);
    if ($('#editor').length) {
      new Quill('#editor', {
        theme: 'snow'
      });
    }

    // Colors
    var colors_container = document.createElement('div');
    colors_container.className = 'colors_container';
    $(colors_container).append(
      '<label>' +
        'Background color:' +
        '<input type="text" name="bgColor" id="bgColor" value="#D32252" placeholder="#D32252">' +
      '</label>' +
      '<label>' +
        'Text color:' +
        '<input type="text" name="textColor" id="textColor" value="#f3f6f4" placeholder="">' +
      '</label>'
    );

    $(popup).find('.tui-full-calendar-popup-section:eq(1)').before(colors_container);
    $('#bgColor, #textColor').spectrum({
      type: "component",
      showInput: false,
    });
    $('#bgColor, #textColor').attr('readonly', 'readonly');
    $('.sp-container').addClass('tui-full-calendar-floating-layer');
    $('.sp-container').addClass('tui-full-calendar-popup');


    // Hide input state and location
    $(popup).find('.tui-full-calendar-popup-section.tui-full-calendar-dropdown.tui-full-calendar-close.tui-full-calendar-section-calendar.tui-full-calendar-hide').hide();
    $(popup).find('.tui-full-calendar-popup-section button#tui-full-calendar-schedule-private').hide();
    $(popup).find('.tui-full-calendar-section-state').hide();
    $(popup).find('.tui-full-calendar-section-location').parents('.tui-full-calendar-popup-section').hide();
  }
});

calendar.on({
  'beforeCreateSchedule': function(e) {
    saveNewSchedule(e);
  },
  'beforeUpdateSchedule': function(e) {
    updateSchedule(e);
  },
  'beforeDeleteSchedule': function(e) {
    deleteSchedule(e);
  }
});

function saveNewSchedule(scheduleData) {

  var schedule = {
    title: scheduleData.title,
    body: $('.tui-full-calendar-popup').find('#editor .ql-editor').html(),
    isAllDay: scheduleData.isAllDay,
    start: scheduleData.start,
    end: scheduleData.end,
    category: scheduleData.isAllDay ? 'allday' : 'time',
    dueDateClass: '',
    color: $('.tui-full-calendar-popup').find('input[name="textColor"]').val(),
    bgColor: $('.tui-full-calendar-popup').find('input[name="bgColor"]').val(),
    dragBgColor: $('.tui-full-calendar-popup').find('input[name="bgColor"]').val(),
    borderColor: $('.tui-full-calendar-popup').find('input[name="bgColor"]').val(),
  };
  
  $.ajax({
    url: urls.addSchedule,
    type: "POST",
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content'),
      "title": schedule.title,
      "text": schedule.body,
      "is_all_day": schedule.isAllDay ? 1 : 0,
      "start": Number(schedule.start.getTime() * 0.001),
      "end": Number(schedule.end.getTime() * 0.001),
      "bg_color": schedule.bgColor,
      "text_color": schedule.color
    },
    beforeSend: function(){
      preloader.start('.card');
    },
    success: function (response) {

      setTimeout( function() {

        preloader.stop('.card');

        if (response.status == true) {
          schedule.id = response.schedule.id;
          calendar.createSchedules([schedule]);
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

function updateSchedule(e) {

  var schedule = e.schedule;
  var changes = e.changes != null ? e.changes : {};

  if (changes && !changes.isAllDay && schedule.category === 'allday') {
    changes.category = 'time';
  }

  changes.body = $('.tui-full-calendar-popup').find('#editor .ql-editor').html();
  changes.color = $('.tui-full-calendar-popup').find('input[name="textColor"]').val();
  changes.bgColor = $('.tui-full-calendar-popup').find('input[name="bgColor"]').val();
  changes.dragBgColor = $('.tui-full-calendar-popup').find('input[name="bgColor"]').val();
  changes.borderColor = $('.tui-full-calendar-popup').find('input[name="bgColor"]').val();

  dataForUpdate = {};
  dataForUpdate.schedule_id = schedule.id;
  dataForUpdate.title = (changes.title !== null && changes.title !== undefined) ? changes.title : schedule.title;
  dataForUpdate.text = (changes.body !== null && changes.body !== undefined) ? changes.body : schedule.body;
  dataForUpdate.is_all_day = (changes.isAllDay !== null && changes.isAllDay !== undefined) ? changes.isAllDay : schedule.isAllDay;
  dataForUpdate.start = (changes.start !== null && changes.start !== undefined) ? changes.start : schedule.start;
  dataForUpdate.end = (changes.end !== null && changes.end !== undefined) ? changes.end : schedule.end;
  dataForUpdate.bg_color = (changes.bgColor !== null && changes.bgColor !== undefined) ? changes.bgColor : schedule.bgColor;
  dataForUpdate.text_color = (changes.color !== null && changes.color !== undefined) ? changes.color : schedule.color;

  $.ajax({
    url: urls.editSchedule,
    type: "POST",
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content'),
      "schedule_id": dataForUpdate.schedule_id,
      "title": dataForUpdate.title,
      "text": dataForUpdate.text,
      "is_all_day": dataForUpdate.is_all_day ? 1 : 0,
      "start": Number(dataForUpdate.start.getTime() * 0.001),
      "end": Number(dataForUpdate.end.getTime() * 0.001),
      "bg_color": dataForUpdate.bg_color,
      "text_color": dataForUpdate.text_color
    },
    beforeSend: function(){
      preloader.start('.card');
    },
    success: function (response) {

      setTimeout( function() {

        preloader.stop('.card');

        if (response.status == true) {
          calendar.updateSchedule(schedule.id, schedule.calendarId, changes);
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

function deleteSchedule(e) {
  $.ajax({
    url: urls.deleteSchedule,
    type: "POST",
    data: {
      "_token": $('meta[name="csrf-token"]').attr('content'),
      "schedule_id": e.schedule.id,
    },
    beforeSend: function(){
      preloader.start('.card');
    },
    success: function (response) {

      setTimeout( function() {

        preloader.stop('.card');

        if (response.status == true) {
          calendar.deleteSchedule(e.schedule.id, e.schedule.calendarId);
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