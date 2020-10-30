<!doctype html>
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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>
    body {
        font-family: Arial;
    }
</style>
<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                Social Pack
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                <a id="gallery" class="nav-link" href="{{route('get_page')}}">
                    Social Pages
                </a>
                </li>
                    {{--<li class="nav-item dropdown">--}}

                        {{--<a id="gallery" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Gallery--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gallery">--}}
                            {{--<a class="dropdown-item" href="{{ route('water_damage') }}">--}}
                                {{--Water Damage--}}
                            {{--</a>--}}
                            {{--<a class="dropdown-item" href="{{ route('physical_damage') }}">--}}
                                {{--Physical Damage--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item">--}}
                        {{--<a id="navbarDropdown" class="nav-link" href="{{route('invoices')}}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                            {{--Invoices--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a id="gallery" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Devices--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gallery">--}}
                            {{--<a class="dropdown-item" href="{{route('device_submission')}}">--}}
                                {{--Submitted Devices--}}
                            {{--</a>--}}
                            {{--<a class="dropdown-item" href="{{route('delivered_device_submission')}}">--}}
                                {{--Delivered Devices--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a id="gallery" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Messages--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gallery">--}}
                            {{--<a class="dropdown-item" href="{{route('messages')}}">--}}
                                {{--Send Custom Message--}}
                            {{--</a>--}}
                            {{--<a class="dropdown-item" href="{{route('invoice_messages')}}">--}}
                                {{--Send Invoice Message--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a id="gallery" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Inventory--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gallery">--}}
                            {{--<a class="dropdown-item" href="{{route('inbound_inventory')}}">--}}
                                {{--InBound Process--}}
                            {{--</a>--}}
                            {{--<a class="dropdown-item" href="{{route('outbound_inventory')}}">--}}
                                {{--OutBound Process--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a id="gallery" class="nav-link" href="{{route('attendance')}}">--}}
                            {{--Attendance--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item pull-left">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if( Session::has( 'success' ))
                <div class="alert alert-success" role="alert">
                    {{ Session::get( 'success' ) }}
                </div>
            @elseif( Session::has( 'errors' ))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get( 'errors' ) }}
                </div>
            @endif
        </div>
        @yield('content')
    </main>
</div>
</body>
<style>
    body {
        {{--background:url({{url('public/social-pack.png')}}) no-repeat center  fixed ;--}}
         background-color: snow;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .nav-item{
        padding: 0px 15px 0px 15px;
        font-size: 17px;
        font-weight: 600;
    }
</style>
</html>
