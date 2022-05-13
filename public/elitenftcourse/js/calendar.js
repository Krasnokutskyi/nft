var calendar = new tui.Calendar('#calendar', {
  defaultView: 'month',
  useCreationPopup: false,
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