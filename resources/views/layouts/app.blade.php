<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Icons and Fonts -->
        <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

        <!-- Your Main CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
       <div class="site-wrap" id="home-section">

            <!-- Page Heading -->
                <header class="site-navbar site-navbar-target" role="banner">
                    @include('layouts.navigation')
                </header>

                <div class="site-section">
                    <div class="container"> 
                        @isset($header)
                        <div class="row align-items-center justify-content-center">
                            <div class="row mb-5">
                                <div class="col-lg-7">
                                <h1>{{ $header }}</h1>
                                </div>
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
