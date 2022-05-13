var calendar = new tui.Calendar('#calendar', {
  defaultView: 'month',
  useCreationPopup: true,
  useDetailPopup: true,
  template: {
    milestone: function(model) {
      return '<span class="calendar-font-icon ic-milestone-b"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
    },
    allday: function(schedule) {
      return getTimeTemplate(schedule);
    },
    time: function(schedule) {
      return getTimeTemplate(schedule);
    }
  }
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

/**
 * A listener for click the menu
 * @param {Event} e - click event
 */
function onClickMenu(e) {

  var target = $(e.target).closest('a[role="menuitem"]')[0];
  var action = getDataAction(target);
  var options = calendar.getOptions();
  var viewName = '';

  switch (action) {
    case 'toggle-daily':
      viewName = 'day';
      break;
    case 'toggle-weekly':
      viewName = 'week';
      break;
    case 'toggle-monthly':
      options.month.visibleWeeksCount = 0;
      viewName = 'month';
      break;
    case 'toggle-weeks2':
      options.month.visibleWeeksCount = 2;
      viewName = 'month';
      break;
    case 'toggle-weeks3':
      options.month.visibleWeeksCount = 3;
      viewName = 'month';
      break;
    case 'toggle-narrow-weekend':
      options.month.narrowWeekend = !options.month.narrowWeekend;
      options.week.narrowWeekend = !options.week.narrowWeekend;
      viewName = calendar.getViewName();

      target.querySelector('input').checked = options.month.narrowWeekend;
      break;
    case 'toggle-start-day-1':
      options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
      options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
      viewName = calendar.getViewName();

      target.querySelector('input').checked = options.month.startDayOfWeek;
      break;
    case 'toggle-workweek':
      options.month.workweek = !options.month.workweek;
      options.week.workweek = !options.week.workweek;
      viewName = calendar.getViewName();

      target.querySelector('input').checked = !options.month.workweek;
      break;
    default:
      break;
  }

  calendar.setOptions(options, true);
  calendar.changeView(viewName, true);

  setDropdownCalendarType();
  setRenderRangeText();
}

function onClickNavi(e) {

  var action = getDataAction(e.target);

  switch (action) {
    case 'move-prev':
      calendar.prev();
      break;
    case 'move-next':
      calendar.next();
      break;
    case 'move-today':
      calendar.today();
      break;
    default:
      return;
  }

  setRenderRangeText();
}

function setEventListener() {
  $('#menu-navi').on('click', onClickNavi);
  $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
  $('#lnb-calendars').on('change', onChangeCalendars);

  window.addEventListener('resize', resizeThrottled);
}

function setRenderRangeText() {
  var renderRange = document.getElementById('renderRange');
  var options = calendar.getOptions();
  var viewName = calendar.getViewName();

  var html = [];
  if (viewName === 'day') {
    html.push(currentCalendarDate('YYYY.MM.DD'));
  } else if (viewName === 'month' &&
    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
    html.push(currentCalendarDate('YYYY.MM'));
  } else {
    html.push(moment(calendar.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
    html.push(' ~ ');
    html.push(moment(calendar.getDateRangeEnd().getTime()).format(' MM.DD'));
  }
  renderRange.innerHTML = html.join('');
}

function refreshScheduleVisibility() {
  var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

  CalendarList.forEach(function(calendar) {
    calendar.toggleSchedules(calendar.id, !calendar.checked, false);
  });

  calendar.render(true);

  calendarElements.forEach(function(input) {
    var span = input.nextElementSibling;
    span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
  });
}

function onChangeCalendars(e) {

  var calendarId = e.target.value;
  var checked = e.target.checked;
  var viewAll = document.querySelector('.lnb-calendars-item input');
  var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
  var allCheckedCalendars = true;

  if (calendarId === 'all') {

    allCheckedCalendars = checked;

    calendarElements.forEach(function(input) {
      var span = input.parentNode;
      input.checked = checked;
      span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
    });

    CalendarList.forEach(function(calendar) {
      calendar.checked = checked;
    });

  } else {

    findCalendar(calendarId).checked = checked;

    allCheckedCalendars = calendarElements.every(function(input) {
      return input.checked;
    });

    if (allCheckedCalendars) {
      viewAll.checked = true;
    } else {
      viewAll.checked = false;
    }
  }

  refreshScheduleVisibility();
}

function getDataAction(target) {
  return target.dataset ? target.dataset.action : target.getAttribute('data-action');
}

resizeThrottled = tui.util.throttle(function() {
  calendar.render();
}, 50);

function setDropdownCalendarType() {

  var calendarTypeName = document.getElementById('calendarTypeName');
  var options = calendar.getOptions();
  var type = calendar.getViewName();
  var iconClassName;

  if (type === 'day') {
      type = 'Daily';
      iconClassName = 'calendar-icon ic_view_day';
  } else if (type === 'week') {
      type = 'Weekly';
      iconClassName = 'calendar-icon ic_view_week';
  } else if (options.month.visibleWeeksCount === 2) {
      type = '2 weeks';
      iconClassName = 'calendar-icon ic_view_week';
  } else if (options.month.visibleWeeksCount === 3) {
      type = '3 weeks';
      iconClassName = 'calendar-icon ic_view_week';
  } else {
      type = 'Monthly';
      iconClassName = 'calendar-icon ic_view_month';
  }

  calendarTypeName.innerHTML = type;
}

function currentCalendarDate(format) {

  var currentDate = moment([calendar.getDate().getFullYear(), calendar.getDate().getMonth(), calendar.getDate().getDate()]);

  return currentDate.format(format);
}

  /**
   * Get time template for time and all-day
   * @param {Schedule} schedule - schedule
   * @param {boolean} isAllDay - isAllDay or hasMultiDates
   * @returns {string}
   */
  function getTimeTemplate(schedule, isAllDay) {

    var html = [];
    var start = moment(schedule.start.toUTCString());

    if (!schedule.isAllDay) {
      html.push('<strong>' + start.format('HH:mm') + '</strong> ');
    }

    if (schedule.isPrivate) {
        html.push('<span class="calendar-font-icon ic-lock-b"></span>');
        html.push(' Private');
    } else {
      if (schedule.isReadOnly) {
        html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
      } else if (schedule.recurrenceRule) {
        html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
      } else if (schedule.attendees.length) {
         html.push('<span class="calendar-font-icon ic-user-b"></span>');
      } else if (schedule.location) {
        html.push('<span class="calendar-font-icon ic-location-b"></span>');
      }

      html.push(' ' + schedule.title);
    }

    return html.join('');
  }

document.addEventListener("DOMContentLoaded", () => {
  setEventListener();
});