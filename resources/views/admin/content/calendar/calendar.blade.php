@extends('admin.layouts.app', ['title' => __('User Profile')])

@section('content')

  <!-- Sidenav -->
  @include('admin.layouts.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item" aria-current="page">Content</li>
                  <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              {{-- <a href="{{ route('admin.downloads.files.upload') }}" class="btn btn-sm btn-neutral">Upload file</a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Calendar</h3>
            </div>
            <div class="code-html">
{{--               <div id="menu">
                <span id="menu-navi">
                <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                  <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                  <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                </button>
                </span>
                <span id="renderRange" class="render-range"></span>
              </div> --}}
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{ HTML::script('admin/js/calendar/data/calendars.js') }}

  <script type="text/javascript">

  var calendar = new tui.Calendar('#calendar', {
    defaultView: 'month',
    useCreationPopup: true,
    useDetailPopup: true,
    calendars: CalendarList
  });

  calendar.createSchedules({!! json_encode($calendar) !!});

  calendar.on({
    'afterRenderSchedule': function(event) {
      var schedule = event.schedule;
      var element = calendar.getElement(schedule.id, schedule.calendarId);
      // use the element
      console.log(element);
    },
    'beforeCreateSchedule': function(e) {
      saveNewSchedule(e);
    }
  });

  function saveNewSchedule(scheduleData) {

    var schedule = {
      // id: String(chance.guid()),
      title: scheduleData.title,
      isAllDay: scheduleData.isAllDay,
      start: scheduleData.start,
      end: scheduleData.end,
      category: scheduleData.isAllDay ? 'allday' : 'time',
      dueDateClass: '',
      color: calendar.color,
      bgColor: calendar.bgColor,
      dragBgColor: calendar.bgColor,
      borderColor: calendar.borderColor,
      location: scheduleData.location,
      isPrivate: scheduleData.isPrivate,
      state: scheduleData.state
    };

    console.log(scheduleData);

    calendar.createSchedules([schedule]);
  }

// /* eslint-disable */
// function init() {

//   setEventListener();
// }

// function getDataAction(target) {
//   return target.dataset ? target.dataset.action : target.getAttribute('data-action');
// }

// function setDropdownCalendarType() {
//   var calendarTypeName = document.getElementById('calendarTypeName');
//   var calendarTypeIcon = document.getElementById('calendarTypeIcon');
//   var options = cal.getOptions();
//   var type = cal.getViewName();
//   var iconClassName;

//   if (type === 'day') {
//     type = 'Daily';
//     iconClassName = 'calendar-icon ic_view_day';
//   } else if (type === 'week') {
//     type = 'Weekly';
//     iconClassName = 'calendar-icon ic_view_week';
//   } else if (options.month.visibleWeeksCount === 2) {
//     type = '2 weeks';
//     iconClassName = 'calendar-icon ic_view_week';
//   } else if (options.month.visibleWeeksCount === 3) {
//     type = '3 weeks';
//     iconClassName = 'calendar-icon ic_view_week';
//   } else {
//     type = 'Monthly';
//     iconClassName = 'calendar-icon ic_view_month';
//   }

//   calendarTypeName.innerHTML = type;
//   calendarTypeIcon.className = iconClassName;
// }

// function onClickMenu(e) {
//   var target = $(e.target).closest('a[role="menuitem"]')[0];
//   var action = getDataAction(target);
//   var options = cal.getOptions();
//   var viewName = '';

//   switch (action) {
//     case 'toggle-daily':
//       viewName = 'day';
//       break;
//     case 'toggle-weekly':
//       viewName = 'week';
//       break;
//     case 'toggle-monthly':
//       options.month.visibleWeeksCount = 0;
//       viewName = 'month';
//       break;
//     case 'toggle-weeks2':
//       options.month.visibleWeeksCount = 2;
//       viewName = 'month';
//       break;
//     case 'toggle-weeks3':
//       options.month.visibleWeeksCount = 3;
//       viewName = 'month';
//       break;
//     case 'toggle-narrow-weekend':
//       options.month.narrowWeekend = !options.month.narrowWeekend;
//       options.week.narrowWeekend = !options.week.narrowWeekend;
//       viewName = cal.getViewName();

//       target.querySelector('input').checked = options.month.narrowWeekend;
//       break;
//     case 'toggle-start-day-1':
//       options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
//       options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
//       viewName = cal.getViewName();

//       target.querySelector('input').checked = options.month.startDayOfWeek;
//       break;
//     case 'toggle-workweek':
//       options.month.workweek = !options.month.workweek;
//       options.week.workweek = !options.week.workweek;
//       viewName = cal.getViewName();

//       target.querySelector('input').checked = !options.month.workweek;
//       break;
//     default:
//       break;
//   }

//   cal.setOptions(options, true);
//   cal.changeView(viewName, true);

//   setDropdownCalendarType();
//   setRenderRangeText();
//   setSchedules();
// }

// function onClickNavi(e) {
//   var action = getDataAction(e.target);

//   switch (action) {
//     case 'move-prev':
//       cal.prev();
//       break;
//     case 'move-next':
//       cal.next();
//       break;
//     case 'move-today':
//       cal.today();
//       break;
//     default:
//       return;
//   }
// }



// resizeThrottled = tui.util.throttle(function() {
//   cal.render();
// }, 50);

// function setEventListener() {
//   $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
//   $('#menu-navi').on('click', onClickNavi);
//   window.addEventListener('resize', resizeThrottled);
// }


// init();
            </script>

@endsection