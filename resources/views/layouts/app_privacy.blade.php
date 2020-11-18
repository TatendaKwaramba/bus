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
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>
<center>
    <img class="center responsive-img" height="120" src={{ asset("img/gc/Logo_GetCash.svg") }}>
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
