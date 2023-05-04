{{--@extends('layouts.app')--}}

{{--@section('content')--}}

        {{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}

{{--@include('inc/header')--}}


{{--<!-- AdminLTE -->--}}
    {{--<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">--}}
    {{--<title>Dashboard</title>--}}

    {{--Fontawesome--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}

    {{--select2--}}
    {{--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>--}}

    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

    {{--@stack('page_css')--}}
{{--</head>--}}


        <!DOCTYPE html>
<html lang="en">
<head>
    @include('inc/header')
</head>



<body class="login_body">

{{--<body class="hold-transition sidebar-mini layout-fixed">--}}

<section class="main_section">

    <div class="main_div">
        <a href="#" class="logo_a">
            <img class="" src="{{ asset('/img/logo.png') }}" alt="SL Army logo">
            Weapons & Troops Transport Authority Management System
        </a>
        <div class="main_div_inner">
            <div class="main_div_innerin">
                <!-- <h1 class="">
                Login to Account
                </h1> -->
                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf

                        <div class="">
                            <label for="email" class="">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="">
                            <label for="password" class="">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="">
                            <div class="remember_me">
                                <div>
                                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{--<div class="row mb-0">--}}
                            <div class="loginlink">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        {{--</div>--}}
                    </form>
            </div>
        </div>
    </div>

</section>
{{--@endsection--}}


</body>
</html>