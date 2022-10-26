<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="icon" href="{{ asset('assets/image/etcm_logo.JPG') }}" >

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Style -->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap Toggle-->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!------JQuery Confirm---------->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.inc.admin_navbar')

    <div id="layoutSidenav">

         @include('layouts.inc.admin_sidebar')

         <div id="layoutSidenav_content">
             <main>
                    
                @yield('admin_content')

             </main>
             @include('layouts.inc.admin_footer')
        </div>
    </div>

    <!--Java Script-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/scripts.css')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.js" 
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!------JQuery Confirm---------->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <!--Facebook Plugin -->
    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0"></script>

    @stack('scripts')

</body>
</html>