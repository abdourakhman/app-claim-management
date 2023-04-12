<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('img/images/favicon.png')}}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LydecResolver') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #1A202C;">
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm"style="background-color: #1A202C; border-bottom:1px solid gray;">
            <div class="container">
                <a class="navbar-brand text-light mr-5 ml-0" href="{{ url('/') }}">
                    <img class="img-circle" src="{{asset('img/images/favicon.png')}}" alt="logo">
                    <span class="brand-text">{{ config('app.name', 'LydecResolver') }}</span>
                </a>
                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item ml-5">
                                    <a class="navbar-brand text-light text-right" href="{{ route('login') }}">
                                        <span class="brand-text">{{ __('Login') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ml-5">
                                    <a class="navbar-brand text-light" href="{{ route('register') }}">
                                        <span class="brand-text"> {{ __('Register') }}</span>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown" style="right: 0px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->prennom }} {{ Auth::user()->nom }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="text-center">
                <img class="img-circle" style="width: 10%;" src="{{asset('img/images/logo.png')}}" alt="logo">
            </div>
            <hr class="w-50">
            @yield('content')
        </main>
    </div>
</body>
</html>
