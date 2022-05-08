<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>

    <!-- Favicon -->
    {{ HTML::favicon('admin/img/brand/favicon.png') }}

    <!-- Fonts -->
    {{ HTML::style('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}

    <!-- Icons -->
    {{ HTML::style('/vendor/nucleo/css/nucleo.css') }}
    {{ HTML::style('/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}

    <!-- Bootstrap -->
    {{ HTML::style('/vendor/bootstrap/dist/css/bootstrap.min.css') }}

    <!-- Argon CSS -->
    {{ HTML::style('admin/css/argon.css?v=1.0.0') }}

    <!-- Jquery -->
    {{ HTML::script('/vendor/jquery/dist/jquery.min.js') }}
    {{ HTML::script('/vendor/js-cookie/js.cookie.js') }}
    {{ HTML::script('/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}
    {{ HTML::script('/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}

    <!-- Jquery UI -->
    {{ HTML::style('/vendor/jquery-ui/jquery-ui.min.css') }}
    {{ HTML::script('/vendor/jquery-ui/jquery-ui.min.js') }}

    <!-- Bootstrap -->
    {{ HTML::script('/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}

     <!--Transliterator -->
    {{ HTML::script('/vendor/transliterator.js') }}

    <!-- Quilljs -->
    {{ HTML::style('/vendor/quill/dist/quill.snow.css') }}
    {{ HTML::script('/vendor/quill/dist/quill.min.js') }}
    {{ HTML::script('/vendor/quill/modules/image-drop.min.js') }}
    {{ HTML::script('/vendor/quill/modules/image-resize.min.js') }}
    {{ HTML::script('/vendor/quill/modules/video-resize.min.js') }}
    {{ HTML::script('/vendor/quill/modules/QuillDeltaToHtmlConverter.bundle.js') }}

    <!-- Sweetalert2 -->
    {{ HTML::style('/vendor/sweetalert2/dist/sweetalert2.min.css') }}
    {{ HTML::script('/vendor/sweetalert2/dist/sweetalert2.min.js') }}

    <!-- Filer -->
    {{ HTML::style('/vendor/filer/jquery.filer.css') }}
    {{ HTML::style('/vendor/filer/jquery.filer-dragdropbox-theme.css') }}
    {{ HTML::script('/vendor/filer/jquery.filer.min.js') }}

    <!-- Custom CSS -->
    {{ HTML::style('admin/css/custom.css?v=1.0.0') }}

    <!-- Select2 -->
    {{ HTML::style('/vendor/select2/dist/css/select2.min.css') }}
    {{ HTML::script('/vendor/select2/dist/js/select2.full.min.js') }}

    <!-- Preloader -->
    {{ HTML::style('/admin/css/preloader.css') }}
    {{ HTML::script('/admin/js/preloader.js') }}

    @if (Route::currentRouteName() === 'admin.calendar')
      <!-- tui.calendar -->
      {{ HTML::style('/vendor/tui.calendar/dist/tui-calendar.min.css') }}
      {{ HTML::style('/vendor/tui.calendar/dist/tui-date-picker.css') }}
      {{ HTML::style('/vendor/tui.calendar/dist/tui-time-picker.css') }}
      {{ HTML::script('/vendor/tui.calendar/dist/tui-code-snippet.min.js') }}
      {{ HTML::script('/vendor/tui.calendar/dist/tui-time-picker.min.js') }}
      {{ HTML::script('/vendor/tui.calendar/dist/tui-date-picker.min.js') }}
      {{ HTML::script('/vendor/tui.calendar/dist/tui-calendar.min.js') }}
    @endif

    <!-- jquery.popup -->
    {{ HTML::style('/vendor/jquery.popup/dist/jquery.popup.css') }}
    {{ HTML::script('/vendor/jquery.popup/dist/jquery.popup.js') }}

  </head>
  <body>

    <script type="text/javascript">
      var name_route = "{{ Route::currentRouteName() }}";
    </script>

    <div class="main-content">
      @yield('content')
    </div>
        
    <!-- Argon JS -->
    {{ HTML::script('admin/js/argon.min.js') }}
    {{ HTML::script('admin/js/menu.js') }}

  </body>
</html>