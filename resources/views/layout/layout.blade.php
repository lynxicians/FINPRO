<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/scss/app.scss' ,'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
    <title>Document</title>
</head>
<body>
    @if(Route::currentRouteName() != "login" &&  Route::currentRouteName() != "register")
        @include('partial.navbar')
    @endif
    @yield('content')
    @yield('ck-editor')
</body>
</html>