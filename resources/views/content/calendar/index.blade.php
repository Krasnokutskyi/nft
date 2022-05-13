@extends('layouts.app')

@section('content')

    <div class="page">

        @include('layouts.headers.header-content')

        <div class="wrapper">
            <div class="market__title"><span>Calendary</span></div>
            <div class="market market_inner">
                <div class="row">
                    <div class="container-calendar">
                      <div id="menu">
                        <span class="dropdown">
                          <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <i class="fas fa-bars"></i>
                              <span id="calendarTypeName">Dropdown</span>&nbsp;
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                  <i class="fas fa-calendar-week"></i>Daily
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                  <i class="fas fa-calendar-week"></i>Weekly
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                  <i class="fas fa-calendar-week"></i>Month
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                  <i class="fas fa-calendar-week"></i>2 weeks
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                  <i class="fas fa-calendar-week"></i>3 weeks
                                </a>
                              </li>
                              <li role="presentation" class="dropdown-divider"></li>
                              <li role="presentation">
                                <a role="menuitem" data-action="toggle-workweek">
                                    <input type="checkbox" checked class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
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
        
        @include('layouts.footers.footer-content')
        
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

    </script>

    {{ HTML::script('/elitenftcourse/js/calendar.js') }}

@endsection