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
            background-color: rgb(44, 139, 248);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5" style=" Width:32rem">
                 <div class="card">
                    <div class="card-body text-center">
                        <form method="POST" action="{{route('login-success-consumer')}}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                   
                            <div class="text-center">   
                                <button type="submit" class="btn btn-lg btn-social fb-btn">
                                    <i class="fab fa-facebook-square"></i></i>Facebook Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Java Script-->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/scripts.css')}}"></script>
</body>
</html>