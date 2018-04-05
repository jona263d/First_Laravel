<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eindprojecten database') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav  style="padding: 0px;" class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div  style="padding: 0px;" class="container">
                <a style="padding: 0px;" class="navbar-brand" href="{{ url('/') }}">
                    @php
                        $Settings = DB::table('settings')->where('SettingsID', '1')->First();
                        $Link = $Settings->Logo;
                    @endphp
                    <img width="{{ $Settings->Logo_Size }}" src="{{ $Link }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Inloggen</a></li>
                            <li><a class="nav-link" href="/Accounttype">Registreren</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->rank == 'Admin'||auth()->user()->rank == 'Assessor')
                                        <a class="dropdown-item" href="/Manage">Gebruikers beheren</a>
                                    @endif
                                     @if(auth()->user()->rank == 'Bedrijf')
                                        <a class="dropdown-item" href="/EigenOpdrachten">Eigen opdrachten</a>
                                    @endif
                                    <a class="dropdown-item" href="/settings">Instellingen</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Uitloggen
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="/js/test.js"></script>

</body>
</html>
