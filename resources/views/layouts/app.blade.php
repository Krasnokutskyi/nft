<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Elite NFT Course</title>

    {{ HTML::style('/elitenftcourse/css/style.css') }}

    <!-- Jquery -->
    {{ HTML::script('https://code.jquery.com/jquery-3.6.0.min.js', ['crossorigin' => 'anonymous', 'integrity' => 'sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=']) }}
    
    <!-- Custom preloader -->
    {{ HTML::script('/elitenftcourse/js/preloader.js') }}

    <!-- Sweetalert2 -->
    {{ HTML::style('/vendor/sweetalert2/dist/sweetalert2.min.css') }}
    {{ HTML::script('/vendor/sweetalert2/dist/sweetalert2.min.js') }}

    @if (Route::currentRouteName() === 'blog.post' or Route::currentRouteName() === 'calendar')
        <!-- Quilljs Core -->
        {{ HTML::style('/vendor/quill/dist/quill.core.css') }}
    @endif

    @if (Route::currentRouteName() === 'calendar')

        {{-- Icons --}}
        {{ HTML::style('/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}

        <!-- Bootstrap -->
        {{ HTML::script('/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}

        <!-- tui.calendar -->
        {{ HTML::style('/vendor/tui.calendar/dist/tui-calendar.min.css') }}
        {{ HTML::style('/vendor/tui.calendar/dist/tui-date-picker.css') }}
        {{ HTML::style('/vendor/tui.calendar/dist/tui-time-picker.css') }}
        {{ HTML::script('/vendor/tui.calendar/dist/tui-code-snippet.min.js') }}
        {{ HTML::script('/vendor/tui.calendar/dist/tui-time-picker.min.js') }}
        {{ HTML::script('/vendor/tui.calendar/dist/tui-date-picker.min.js') }}
        {{ HTML::script('/vendor/tui.calendar/dist/tui-calendar.js') }}

        <!-- Moment -->
        {{ HTML::script('/vendor/moment/dist/moment.min.js') }}

    @endif
    
</head>

<body @if(Route::currentRouteName() !== 'home') class="inner" @endif>

    {{-- Content --}}
    @yield('content')

    {{-- PopUp --}}
    @include('layouts.popup.terms')
    @include('layouts.popup.privacy')

    {{ HTML::script('/elitenftcourse/js/script.js') }}

</body>

</html>