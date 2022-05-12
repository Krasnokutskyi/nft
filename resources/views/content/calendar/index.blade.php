@extends('layouts.app')

@section('content')

    <div class="page">

        @include('layouts.headers.header-content')

        <div class="wrapper">
            <div class="market__title"><span>Calendary</span></div>
            <div class="market market_inner">
                <div class="row">
                    <div id="calendar"></div>
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

        var calendar = new tui.Calendar('#calendar', {
            defaultView: 'month',
            useCreationPopup: false,
            useDetailPopup: true
        });

        calendar.createSchedules(schedules);

    </script>

    <style type="text/css">
        #calendar{
            width: 100%;
        }
        #calendar .tui-full-calendar-layout
        {
            background-color: transparent !important;
        }
        #calendar .tui-full-calendar-layout .tui-full-calendar-month-dayname .tui-full-calendar-month-dayname-item span,
        #calendar .tui-full-calendar-layout .tui-full-calendar-weekday-grid-header .tui-full-calendar-weekday-grid-date,
        #calendar  .tui-full-calendar-weekday-schedule.tui-full-calendar-weekday-schedule-time .tui-full-calendar-weekday-schedule-title
        {
            color: #E4E4E8 !important;
        }
        #calendar .tui-full-calendar-month-week-item .tui-full-calendar-weekday-schedule
        {
            z-index: 30 !important;
        }
        #calendar .tui-full-calendar-month-creation-guide
        {
            background-color: transparent !important;
            border-color: transparent !important;
        }
        #calendar .tui-full-calendar-popup .tui-full-calendar-popup-container
        {
            background-color: black !important;
            min-width: 360px !important;
            width: 100% !important;
        }
        #calendar .tui-full-calendar-popup-detail .tui-full-calendar-content p
        {
            line-height: 1.3 !important;
            margin: 0px !important;
            padding: 0px !important;
        }
        #calendar .tui-full-calendar-popup-detail .tui-full-calendar-section-button 
        {
            display: none !important;
        }
        #calendar .tui-full-calendar-weekday-border,
        #calendar .tui-full-calendar-layout .tui-full-calendar-month-dayname,
        #calendar .tui-full-calendar-weekday-grid-line
        {
            border-color: #2B3245 !important;
        }
        #calendar .tui-full-calendar-layout .tui-full-calendar-month-dayname .tui-full-calendar-month-dayname-item:first-child span,
        #calendar .tui-full-calendar-layout .tui-full-calendar-weekday-grid-line:first-child .tui-full-calendar-weekday-grid-header .tui-full-calendar-weekday-grid-date
        {
            color: #B81414 !important;
        }
    </style>

@endsection