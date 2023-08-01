<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />  
    @vite(['resources/scss/app.scss' ,'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> --}}
    <title>Document</title>
</head>
<body class="@yield('body_class', 'campus-voice')">
    @if(Route::currentRouteName() != "login" &&  Route::currentRouteName() != "register" && Route::currentRouteName() != "suggestion.SuggestionManagementSystem" && Route::currentRouteName() != "admin.index" )
        @include('partial.navbar')
    @endif
    @yield('content')
    @yield('ck-editor')
    @if(Route::currentRouteName() != "login" &&  Route::currentRouteName() != "register")
    @include('partial.footer')
    @endif
    @section('scripts')
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <!-- Replace with the appropriate URLs for your jQuery and DataTables version -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    @show 
    @stack('scripts') 
</body>
</html>