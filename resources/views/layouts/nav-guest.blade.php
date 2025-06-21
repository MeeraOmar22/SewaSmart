<header class="site-navbar site-navbar-target" role="banner">
                <div class="container">
                    <div class="row align-items-center position-relative">
                        <!-- Logo -->
                        <div class="col-3">
                            <div class="site-logo">
                                <a href="{{ url('/') }}"><strong>SewaSmart</strong></a>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="col-9 d-flex justify-content-end align-items-center">
                            <!-- Mobile toggle -->
                            <span class="d-inline-block d-lg-none">
                                <a href="#" class="site-menu-toggle js-menu-toggle py-5">
                                    <span class="icon-menu h3 text-black"></span>
                                </a>
                            </span>

                            <!-- Menu Items -->
                            <nav class="site-navigation d-none d-lg-block mr-3" role="navigation">
                                <ul class="site-menu main-menu js-clone-nav ml-auto">
                                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                                    <li><a href="{{ url('/listing') }}" class="nav-link">Listing</a></li>
                                    <li><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                                    <li><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                                </ul>
                            </nav>

                            <!-- Auth Buttons -->
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary d-none d-lg-inline-block">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary d-none d-lg-inline-block mx-2">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary d-none d-lg-inline-block mx-2">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </header>