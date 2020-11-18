@extends('layouts.app_auth')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col s8 push-s2">
                <div class="card">
                    <div class="card-content with-padding">
                        <center>

                            <h3><i class="fa fa-user-circle"></i>

                            </h3>
                            <h5>SIGN IN</h5>
                        </center>
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">


                                    <div>
                                        <i class="fa fa-user-o prefix"></i>
                                        <label for="email">CELLPHONE NUMBER</label>
                                        <input id="email" type="text" name="email"
                                               value="{{ old('email') }}" required autofocus>
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
                                        <label for="password" class="">PIN</label>
                                        <input id="password" type="password" class="form-control" name="password"
                                               required>
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
                                            <button type="submit" class="btn-large akupay waves-effect waves-light">
                                                Login
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
@endsection
