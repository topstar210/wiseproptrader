@extends('layouts.auth_page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="cryptorio-forms cryptorio-forms-dark text-center pt-5 pb-5">
                    <div class="logo">
                        <img src="{{asset('landingAssets/images/logo.png')}}" alt="logo-image">
                    </div>
                    <h3 class="p-4">Welcome To Login</h3>
                    <div class="cryptorio-main-form">
                        <form method="POST" action="{{ route('login') }}" class="text-left">
                        @csrf
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                        <p class="float-left"><a href="{{ route('register') }}">{{ __('Sign Up') }}</a></p>
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
@endsection
