<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/admin.js') }}" defer></script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-md-3 col-lg-2 mr-auto px-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                        data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav px-3">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown text-nowrap ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Hello, {{ Auth::user()->name }}!<span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                        <div class="position-sticky">
                            <ul class="nav flex-column mt-5 mb-2">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('admin.servers.index') ? 'active' : '' }}" href="{{ route('admin.servers.index') }}">Servers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('admin.users.index') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" href="{{ route('admin.users.index') }}">Users</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>
