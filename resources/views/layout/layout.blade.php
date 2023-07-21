<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/scss/app.scss' ,'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
    <title>Document</title>
</head>
<body class="@yield('body_class', 'campus-voice')">
    @if(Route::currentRouteName() != "login" &&  Route::currentRouteName() != "register")
        @include('partial.navbar')
    @endif
    @yield('content')
    @yield('ck-editor')
    @include('partial.footer')
    @stack('scripts') 
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>