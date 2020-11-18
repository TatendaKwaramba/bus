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
<body>

<div class="container">
    <div class="card col s12">
            <div class="card-content">
                <div class="center">
                    <img src="img/gc/logo.jpeg" alt="Logo" width="200px">
                </div>
                <h5 class="blue-text center"><i class="fa fa-group"></i> SELECT AGENT </h5>

            </div>

    </div>
    @foreach($agents as $agent)
    <div class="card">
        <div class="card-content">
            <center>
                {{$agent->name}}
                <form action="{{url('/api/ai/agent_number')}}" method="post">
                    <input type="hidden" name="agent_number" value="{{$agent->agent_number}}">
                    <input type="hidden" name="agent_name" value="{{$agent->name}}">
                    <button class="btn btn-flat waves-effect waves-light blue white-text">
                        Select
                    </button>
                </form>
            </center>
        </div>

    </div>
    @endforeach

    <h3>

       {{-- SUPER AGENT {{$agents}}--}}
    </h3>
</div>


<script src="{{ asset('lib/angular/angular.min.js') }}"></script>
<script src="{{ asset('lib/angular-sanitize/angular-sanitize.min.js') }}"></script>
<script src="{{ asset('lib/angular-material/angular-material.min.js')}}"></script>
<script src="{{ asset('lib/angular-messages/angular-messages.js') }}"></script>
<script src="{{ asset('lib/angular-animate/angular-animate.min.js')}}"></script>
<script src="{{ asset('lib/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('lib/angular-aria/angular-aria.min.js') }}"></script>
<script src="{{ asset('lib/materialize/dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('lib/angularUtils-pagination/dirPagination.js') }}"></script>
<script src="{{ asset('lib/chart.js/dist/Chart.min.js')}}"></script>
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
