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

                <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">
                    <div class="container">
                    <div class="row align-items-center ">
                        <div class="col-lg-5">
                        <div class="intro">
                            @isset($header)
                            <h1><strong>{{ $header }}</strong></h1>
                            @endisset
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- Page Content -->
            <div class="site-section bg-light">
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.sticky.js') }}"></script>
        <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>


        <script src="{{ asset('js/main.js') }}"></script>

    </body>
</html>
