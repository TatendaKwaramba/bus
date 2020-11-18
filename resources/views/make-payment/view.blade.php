<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#c62828">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'GetCash') }}</title>
        <link rel="shortcut icon" href="{{ asset('img/gc/logo.jpeg') }}" type="image/x-icon"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        })
    </script>
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(img/squares.gif) 50% 50% no-repeat ;
        }
    </style>

</head>
<body>
<div class="loader">

</div>

<div class="main" ng-app="makePayment">
    <center>
        <img class="center responsive-img"  height="120" src={{ asset("img/gc/Logo_GetCash.svg") }}>
    </center>
    <div class="container" ng-controller="processCtrl">
        <div class="row">

            <div class="col m8 l8 s12 push-m2 push-l2">
                <div class="card">
                    <div class="card-content with-padding">
                        <center>


                            <h5>CONFIRM YOUR <b><u>${{$amount}}</u></b> PAYMENT</h5>
                            <br>
                        </center>
                        <div>
                            <form name="submitForm" id="submitForm" ng-submit="submitData()">
                                {{ csrf_field() }}

                                <input type="hidden" name="amount" id="amount" value={{$amount}}>
                                <input type="hidden" name="token" id="token" value="{{$token}}">
                                <input type="hidden" name="return_url" value={{$success_return_url}} ng-model="success_return_url">
                                <input type="hidden" name="return_url" value={{$failure_return_url}} ng-model="failure_return_url">
                                <input type="hidden" name="return_url" value={{$merchant_ref}} ng-model="merchant_ref">

                                <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">


                                    <div>
                                        <i class="fa fa-user-o prefix"></i>
                                        <input id="mobile" type="text" name="mobile"
                                               value="{{ old('email') }}" required autofocus autocomplete="off" ng-model="mobile">
                                        <label for="mobile">CELLPHONE NUMBER</label>
                                        @if ($errors->has('email'))
                                            <span class="red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">


                                    <div class="">
                                        <i class="fa fa-key prefix"></i>

                                        <input id="password" type="password" class="form-control" name="password"
                                               required autocomplete="off" ng-model="pin">
                                        <label for="password" class="">PIN</label>
                                        @if ($errors->has('password'))
                                            <span class="red-text">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <div class="form-group">
                                    </div>
                                    <br>

                                    <div>
                                        <center>
                                            <button ng-disabled="submitForm.$invalid" type="submit" class="btn-large red waves-effect waves-light">
                                                <span ng-show="pay">PAY</span> <span ng-show="processing">PROCESSING...</span>  <i ng-show="loader" class="fa fa-circle-o-notch fa-spin"></i>
                                            </button>
                                        </center>

                                    </div>
                                    <br><br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>

<script src="{{asset('js/angularControllers/make-payment/makePaymentCtrl.js')}}"></script>
</body>
</html>