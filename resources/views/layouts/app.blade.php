<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/gc/logo.jpeg') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('lib/materialize/dist/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/sweetalert/dist/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/semantic-ui-button/button.min.css') }}">
    <link rel="stylesheet" href="{{asset('lib/semantic-ui-input/input.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/angular-material/angular-material.min.css')}}">
    <script src="{{ asset('lib/jquery/dist/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('lib/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-materialize.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GetCash | Business Wallet') }}</title>

</head>
<body ng-app="businessWalletApp" ng-cloak>


<div ng-controller="aiController">

    <div class="fixed navbar-fixed">
        <nav class="z-depth-0 akupay">
            <div class="row">
                <div class=" col s2"><a href="#!" class="brand-logo">
                    </a></div>
                <div class="col s10">
                    <div class="nav-wrapper">
                        <ul class="right hide-on-med-and-down">


                            <li><i class="fa fa-user-circle"></i> {{ Auth::user()->name }} {{": ".$name = \Illuminate\Support\Facades\Cookie::get('agent_name')}} &nbsp&nbsp</li>
                            <li class="waves-effect waves-light purple darken-1">
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col s2 section">
            <div id="sideNav" class="grey lighten-5 side-nav fixed z-depth-0  "
                 style=" position: fixed; overflow-y: auto; overflow-x: hidden; height: 100%; width: auto;">
                <div>
                    <ul>
                        <li>
                            <div class="topbar" id="">
                                <img id="logo" src="{{ asset('img/gc/logo.jpeg') }}" width="105px">
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-pie-chart"></i>
                                <a href="/">OVERVIEW</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-user-plus"></i>
                                <a href="/subscriber/add">ADD SUBSCRIBER</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-cart-plus"></i>
                                <a href="/pay-bills">BILL PAYMENTS</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect" href="">
                                <i class="fa fa-money"></i>
                                <a href="/pay-merchant">PAY MERCHANT</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-credit-card"></i>
                                <a href="/card-activation">CARDS</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect" href="">
                                <i class="fa fa-bank"></i>
                                <a href="/banking">BANKING</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-line-chart"></i>
                                <a href="/transactions">TRANSACTIONS</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-group"></i>
                                <a href="/employees">EMPLOYEES</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        @if(\Illuminate\Support\Facades\Request::hasCookie('agent_number'))
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-user"></i>
                                <a href="/agents">AGENTS</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>
                        @endif
                        <li>
                            <div class="collapsible-header waves-effect">
                                <i class="fa fa-lock"></i>
                                <a href="/change-pin">CHANGE PIN</a>
                            </div>
                        </li>
                        <li>
                            <div class="divider"></div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="col s10">
            <div>
                @yield('content')
            </div>
        </div>

    </div>
</div>


<script src="{{ asset('lib/angular/angular.min.js') }}"></script>
<script src="{{ asset('lib/angular-material/angular-material.min.js')}}"></script>
<script src="{{ asset('lib/angular-messages/angular-messages.js') }}"></script>
<script src="{{ asset('lib/angular-animate/angular-animate.min.js')}}"></script>
<script src="{{ asset('lib/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
<script src="{{ asset('lib/materialize/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('lib/angularUtils-pagination/dirPagination.js') }}"></script>
<script src="{{ asset('lib/angular-chart.js/dist/angular-chart.min.js') }}"></script>
<script src="{{ asset('lib/ng-csv/build/ng-csv.min.js') }}"></script>
<script src="{{ asset('lib/semantic/dist/semantic.min.js')}}"></script>
<script src="{{ asset('js/index.js')}}"></script>
<script src="{{asset('lib/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('lib/pdfmake/build/pdfmake.js')}}"></script>
<script src="{{asset('lib/pdfmake/build/vfs_fonts.js')}}"></script>


@yield ('script')

{{--ANGULAR FILES--}}
<script src="{{asset('js/angularModules/module.js')}}"></script>
<script src="{{asset('js/angularFactory/mainFactory.js')}}"></script>
<script src="{{asset('js/angularControllers/dateCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/overviewCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/pay_bill/pay_billCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/pay_merchant/pay_merchantCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/subscriber/addSubscriberCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/ai/aiCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/transactions/transactionsCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/change-pin/pinCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/employees/employeesCtrl.js')}}"></script>
<script src="{{asset('js/angularControllers/cardActivations/cardActivationCtrls.js')}}"></script>



</body>
</html>
