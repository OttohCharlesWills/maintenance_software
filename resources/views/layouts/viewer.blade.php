<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Maintainance Software') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <div>
            <h5 style="margin: 0"><b>Admin Panel</b></h5>
        </div>

        <div style="display: flex; gap: 1rem; align-items:center;">
            <span>
                Welcome, {{ Auth::user()->name }}
            </span>

            <li class="nav-item" style="list-style-type: none">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger w-100">
                        Logout
                    </button>
                </form>
            </li>
        </div>
    </nav>

    <div id="app" class="d-flex">
        @include('includes.viewersidebar')

        <main class="flex-grow-1">
            @yield('viewercontent')
        </main>
    </div>
</body>
</html>
