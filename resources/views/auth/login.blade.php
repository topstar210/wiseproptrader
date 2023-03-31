<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('landingAssets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/icons.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/ui.css')}}">
    <style>
        .cryptorio-forms-dark {
    border: solid;
    border-color: #5ADBE0;
        }
        .cryptorio-forms-dark .cryptorio-main-form input {
    background-color: rgb(0 0 0 / 60%);
    border: 1px solid #5ADBE0;
}
.crypt-button-red-full {
    background: #000000 !important;
    border: solid #55cfd3!important;
    color: #fff;
    padding: 9px;
    text-align: center;
    text-decoration: none;
    display: block;
    width: 100%;
    font-size: 20px;
    transition: all 0.4s ease;
}
body {
    font-family: 'Din Pro',Arial,sans-serif;
    background: #f9faff;
    overflow-x: hidden;
    margin-top: 200px;
    font-size: 13px;
}

@media(min-width: 750px) {
    body {
    font-family: 'Din Pro',Arial,sans-serif;
    background: #f9faff;
    overflow-x: hidden;
    margin-top: 140px;
    font-size: 13px;
}
}

@media(min-width: 400px) {
    body {
    font-family: 'Din Pro',Arial,sans-serif;
    background: #f9faff;
    overflow-x: hidden;
    margin-top: 90px;
    font-size: 13px;
}
}


      </style>
</head>

<body class="crypt-dark" style="background: #000; background-repeat: no-repeat; background-size:cover">
    @if (Session::has('message'))
    <div id="showMessage" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px;">
        <button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        {{Session::get('message')}}
    </div>

    @endif

    <div id="showError" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px; color:red; font-size: 16px; display:none">
        <button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <div id="errormsg"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="cryptorio-forms cryptorio-forms-dark text-center pt-5 pb-5">
                    <div class="crypt-logo"><img src="https://app.wiseproptrader.com/public/uploads/{{$app_settings['logo_path']??''}}" alt="" style="width: 306px!important;height: 111px!important;margin-left: 17px!important"></div>
                    <!--<h3 class="p-4"></h3>-->
                    <div class="cryptorio-main-form">
                        <form method="POST" action="{{ route('login') }}" class="text-left" id="login_form">
                            @csrf
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="submit" value="{{ __('Login') }}" class="crypt-button-red-full">
                        </form>
                        <p class="float-right">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </p>

                        
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>


    <script src="{{asset('landingAssets/js/jquery.js')}}"></script>
    <script src="{{asset('landingAssets/amc/core.js')}}"></script>
    <script src="{{asset('landingAssets/amc/charts.js')}}"></script>
    <script src="{{asset('landingAssets/amc/dark.js')}}"></script>
    <script src="{{asset('landingAssets/amc/animated.js')}}"></script>
    <script src="{{asset('landingAssets/js/Chart.min.js')}}"></script>
    <script src="{{asset('landingAssets/js/popper.min.js')}}"></script>
    <script src="{{asset('landingAssets/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('landingAssets/bootstrap/js/bootstrap.js')}}"></script>

    <script>
        setInterval(() => {
            $("#showError").hide();
        }, 7000);
    </script>

</body>


</html>