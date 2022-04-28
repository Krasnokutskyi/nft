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

    @if (Route::currentRouteName() === 'blog.post')
        <!-- Quilljs Core -->
        {{ HTML::style('/vendor/quill/dist/quill.core.css') }}
    @endif
</head>

<body @if(Route::currentRouteName() !== 'home') class="inner" @endif>

    @yield('content')

    {{ HTML::script('/elitenftcourse/js/script.js') }}

</body>

</html>