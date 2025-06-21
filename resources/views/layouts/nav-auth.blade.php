<header class="site-navbar site-navbar-target" role="banner">
    <div class="container">
        <div class="row align-items-center position-relative">
            <!-- Logo -->
            <div class="col-3">
                <div class="site-logo">
                    <a href="{{ route('dashboard') }}"><strong>SewaSmart</strong></a>
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
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        <li class="{{ request()->routeIs('listing') ? 'active' : '' }}">
                            <a href="{{ route('listing') }}" class="nav-link">Listing</a>
                        </li>
                        <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link px-0" style="text-decoration: none;">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>

                <!-- Username Display -->
                <div class="d-none d-lg-inline-block mx-2 text-muted">
                    {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</header>
