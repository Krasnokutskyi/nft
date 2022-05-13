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
            <div class="col-lg-6 col-5 text-right"></div>
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
            <div class="code-html container-calendar">

              <div id="menu">
                <span class="dropdown">
                  <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fas fa-bars"></i>
                      <span id="calendarTypeName">Dropdown</span>&nbsp;
                      <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                            <i class="calendar-icon ic_view_day"></i>Daily
                        </a>
                      </li>
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                            <i class="calendar-icon ic_view_week"></i>Weekly
                        </a>
                      </li>
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                            <i class="calendar-icon ic_view_month"></i>Month
                        </a>
                      </li>
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                          <i class="calendar-icon ic_view_week"></i>2 weeks
                        </a>
                      </li>
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                          <i class="calendar-icon ic_view_week"></i>3 weeks
                        </a>
                      </li>
                      <li role="presentation" class="dropdown-divider"></li>
                      <li role="presentation">
                        <a role="menuitem" data-action="toggle-workweek">
                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                            <span class="checkbox-title"></span>Show weekends
                        </a>
                      </li>
                      <li role="presentation">
                          <a role="menuitem" data-action="toggle-start-day-1">
                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                            <span class="checkbox-title"></span>Start Week on Monday
                          </a>
                      </li>
                      <li role="presentation">
                          <a role="menuitem" data-action="toggle-narrow-weekend">
                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                            <span class="checkbox-title"></span>Narrower than weekdays
                          </a>
                      </li>
                    </ul>
                </span>
                <span id="menu-navi">
                  <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                  <button type="button" class="btn btn-default btn-sm move-day prev-button" data-action="move-prev">
                    <i data-action="move-prev" class="fas fa-angle-left"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm move-day next-button" data-action="move-next">
                    <i data-action="move-next" class="fas fa-angle-right"></i>
                  </button>
                </span>
                <span id="renderRange" class="render-range"></span>
              </div>
        
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">

    var schedules = {!! json_encode($schedules) !!};
    for (var i = 0; i < schedules.length; i++) {

      schedules[i].body = schedules[i].text;
      schedules[i].isAllDay = (schedules[i].is_all_day == 1) ? true : false;
      schedules[i].color = schedules[i].text_color;
      schedules[i].bgColor = schedules[i].bg_color;
      schedules[i].dragBgColor = schedules[i].bg_color;
      schedules[i].borderColor = schedules[i].bg_color;
      schedules[i].category = schedules[i].isAllDay ? 'allday' : 'time';
      schedules[i].start = new Date(schedules[i].start).setMinutes(new Date().getTimezoneOffset() * -1);
      schedules[i].end = new Date(schedules[i].end).setMinutes(new Date().getTimezoneOffset() * -1);

      delete schedules[i].text, schedules[i].is_all_day;
      delete schedules[i].text_color, schedules[i].bg_color;
    }

    var urls = {};
    urls.addSchedule = '{{ route('admin.calendar.schedule.addAction') }}';
    urls.editSchedule = '{{ route('admin.calendar.schedule.editAction') }}';
    urls.deleteSchedule = '{{ route('admin.calendar.schedule.deleteAction') }}';

  </script>

  {{ HTML::script('admin/js/content/calendar/calendar.js') }}
  
@endsection