<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/generic.css') }}" rel="stylesheet">
        <link href="{{ asset('css/tables.css') }}" rel="stylesheet">

        @yield('style')

        @yield('jquery')
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">Incident Manager</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor03">

                    @if(Auth::check())
                    
                    <ul class="navbar-nav mr-auto">
                        @foreach(Auth::user()->menus() as $menu)
                            @if($menu["menus_hijos"] == 0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url($menu["ruta"]) }}">{{ $menu["nombre"]}} <span class="sr-only">(current)</span></a>
                            </li>
                            @else
                                @include("includes.submenus", ["menu"=>$menu])
                            @endif
                            
                        @endforeach                        
                    </ul>
                    
                    @endif
                    <ul class="navbar-nav ml-auto ulLogout">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>


            <main class="main">
                <div class="jumbotron">
                    @include('includes.alerts')

                    @yield('content')
                </div>
            </main>
        </div>

        @yield('script')

    </body>
</html>
