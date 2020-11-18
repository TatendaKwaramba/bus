<!DOCTYPE html >


<html lang="en" ng-app="adminApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GetCash | Business Wallet') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/gc/logo.jpeg') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('lib/materialize/dist/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/sweetalert/dist/sweetalert.css') }}">

    <script src={{ asset('lib/jquery/dist/jquery.min.js') }}></script>
    <style>
        body {
            background: url(img/2-compressor.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            overflow-y: hidden;
        }
    </style>
</head>


<body>
{{--
<div class="navbar-fixed">
    <nav class="white">
        <div class="nav-wrapper">
            <div class="row">
                <ul class="right hide-on-med-and-down">
                    @if( ! (Request::is('login*')))
                        <li><a class="grey-text" href="{{ url('/login') }}">Login</a></li>
                    @endif

                    @if( ! (Request::is('register*')))
                        <li><a class="grey-text" href="{{ url('/register') }}">Register</a></li>@endif
                </ul>
            </div>
        </div>

    </nav>
</div>
--}}
<center>
    <img class="center responsive-img" width="150px" src={{ asset("img/gc/logo.jpeg") }}>
</center>

<div style="margin-top: 40px">
    @yield('content')
</div>
<script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('lib/angular/angular.min.js') }}"></script>
<script src="{{ asset('lib/angular-messages/angular-messages.js') }}"></script>
<script src="{{ asset('lib/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
<script src="{{ asset('lib/materialize/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('lib/angularUtils-pagination/dirPagination.js') }}"></script>
</body>
</html>
