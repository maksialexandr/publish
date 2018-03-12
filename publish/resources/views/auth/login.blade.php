@extends('layouts.app')
@section('content')
<div class="container" style="user-select: none;">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" style="box-shadow: 0px 0px 20px 0px rgba(134, 134, 134, 0.5);">
                <div class="panel-body" style="padding: 35px; margin-top: 30px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="width: 49%;">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                                <a href="#" disabled="true" class="btn btn-success" style="width: 49%;">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </a>
                                <a disabled="true" class="btn btn-link" href="{{  url('/password/reset') }}" style="padding: 10px;">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
