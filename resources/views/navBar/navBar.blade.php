
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

            <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link mx-5 @if(Request::route()->getName() == 'app_home') acitve @endif" aria-current href="{{ route('app_home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-5 @if(Request::route()->getName() == 'app_snake') acitve @endif" aria-current href="{{ route('app_snake') }}">Snake</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-5 @if(Request::route()->getName() == 'app_ducky') acitve @endif" aria-current href="{{ route('app_duky') }}">Flying Duky</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-5 @if(Request::route()->getName() == 'app_about') acitve @endif" href="{{ route('app_about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-5 @if(Request::route()->getName() == 'app_dashboard') acitve @endif" href="{{ route('app_dashboard') }}">Dashboard</a>
                        </li>
                        <!--Routes gérées par Fortify-->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link mx-5" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-5" href="{{ route('register') }}">Register</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item">
                                <a class="nav-link mx-5" href="{{ route('app_logout') }}">Logout</a>
                            </li>
                            <span class="text-center">
                                <div class="user">
                                    {{ Auth::user()->name }}
                                </div>
                            </span>
                        @endauth
                </ul>
            </div>
        </div>
      </nav>

