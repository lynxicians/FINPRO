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
    @yield('content')
    @yield('register')
    @yield('suggestion')
    @yield('about')
</body>
</html>