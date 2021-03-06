<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>Nazmohal - Dashboard System</title>
        
        <!-- Favicon -->
        <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('samajikadmin/css/slidercss.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/font-awesome.min.css') }}">
        
        <!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/feathericon.min.css') }}">
        
        <link rel="stylesheet" href="{{ asset('samajikadmin/plugins/morris/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('samajikadmin/plugins/datatables/datatables.min.css') }}">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/admin-custom.css') }}">
        <link rel="stylesheet" href="{{ asset('samajikadmin/css/select2.min.css') }}">

</head>
<body>
    @yield('content')
    <!-- jQuery -->
        <script src="{{ asset('samajikadmin/js/jquery-3.2.1.min.js') }}"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{ asset('samajikadmin/js/popper.min.js') }}"></script>
        <script src="{{ asset('samajikadmin/js/bootstrap.min.js') }}"></script>
        
        <!-- Slimscroll JS -->
        <script src="{{ asset('samajikadmin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        
        <script src="{{ asset('samajikadmin/plugins/raphael/raphael.min.js') }}"></script>    
        <script src="{{ asset('samajikadmin/plugins/morris/morris.min.js') }}"></script>  
        <script src="{{ asset('samajikadmin/js/chart.morris.js') }}"></script>
        <script src="{{ asset('samajikadmin/js/select2.min.js') }}"></script>
        <script src="{{ asset('samajikadmin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('samajikadmin/plugins/datatables/datatables.min.js')}}"></script>

        <script src="{{ asset('samajikadmin/js/script.js') }}"></script>
        @yield('pagescript')
</body>
</html>
