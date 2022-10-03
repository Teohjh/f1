<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | Register</title>

    <link rel="icon" href="{{ asset('assets/image/etcm_logo.JPG') }}" >

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Style -->
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body  class="d-flex flex-column min-vh-100">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5" style="Width:32rem">
                    <img src="{{ asset('assets/image/etcm_logo.JPG') }}" class="card-img-top mx-auto"  style="width: 6rem; Height: 6rem; margin-top:20px; margin-bottom:15px;"/>
                   
                    <div class="card-body">
                        <form method="POST" action="{{route('register-admin')}}"  aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="admin_name" class="col-md-4 col-form-label text-md-end">{{ __('Admin Name') }}</label>

                                <div class="col-md-6">
                                    <input id="admin_name" type="text" class="form-control @error('admin_name') is-invalid @enderror" name="admin_name" value="{{ old('admin_name') }}" required autocomplete="name" autofocus>

                                    @error('admin_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="admin_email" class="col-md-4 col-form-label text-md-end">{{ __('Admin Email') }}</label>

                                <div class="col-md-6">
                                    <input id="admin_email" type="email" class="form-control @error('admin_email') is-invalid @enderror" name="admin_email" value="{{ old('admin_email') }}" required autocomplete="email">

                                    @error('admin_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="admin_password" class="col-md-4 col-form-label text-md-end">{{ __('Admin Password') }}</label>

                                <div class="col-md-6">
                                    <input id="admin_password" type="password" class="form-control @error('admin_password') is-invalid @enderror" name="admin_password" required autocomplete="new-password">

                                    @error('admin_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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