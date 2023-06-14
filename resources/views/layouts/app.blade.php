<!DOCTYPE html>
<html lang="en">
<head>

@include('inc/header')


<!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <title>Dashboard</title>

    {{--Fontawesome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{--select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        @include('inc/topnavbar')
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        @include('inc/sidebar')
    </aside>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('js/adminlte.js') }}"></script>


    <div class="content-wrapper">

        @if(session()->has('waring'))
            <div class="alert alert-warning text-end" role="alert">
                <i class="fa-regular fa-square-exclamation"></i>&nbsp;{{ session()->get('waring')}}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success text-end" role="alert">
                <i class="fa-sharp fa-regular fa-square-check"></i>&nbsp;{{ session()->get('success')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger text-end" role="alert">
                <i class="fa-sharp fa-regular fa-square-xmark"></i>&nbsp;{{ session()->get('error')}}
            </div>
        @endif

        @yield('content')
    </div>

</div>

    {{--select-2--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts')

</body>
</html>