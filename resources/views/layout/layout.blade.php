<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@grammarly/editor-sdk?clientId=client_CLCuSMgNA74LwPhgFyLn7W"></script>
        <!-- Replace with the appropriate URLs for your jQuery and DataTables version -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @show
    @stack('scripts') 
</body>
</html>