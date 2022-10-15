<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <link rel="icon" href="{{ asset('assets/image/etcm_logo.JPG') }}" >

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Style -->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .fb-btn{
            background-color: blue;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                 <div class="card">
                    <div class="card-header">
                        {{ __('Login') }}
                    </div>
                    <div class="card-body text-center">
                    @csrf
                            <div class="text-center">
                                <p style="text-align:center">Login with Facebook</p>
                                <a href="{{ route('facebook-redirect') }}">
                                <button type="button" class="btn btn-lg btn-social fb-btn">
                                <i class="fa fa-facebook-official"></i>Facebook Login
                                </button>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.inc.admin_footer')
    <!--Java Script-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/scripts.css')}}"></script>
</body>
</html>