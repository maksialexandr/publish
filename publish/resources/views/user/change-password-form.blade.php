@extends('layouts.profile')
@section('profile_content')
    @foreach($errors->all() as $msg)
        <div class="alert alert-danger">{!! $msg !!}</div>
    @endforeach
    {!! Form::open(['action' => 'UserController@changePassword', 'method' => 'PUT']) !!}
    <div class="header">
        <h4 class="text-muted prj-name">
            New password
        </h4>
    </div>
    <div class="form-group">
        {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Current password']) !!}
    </div>
    <div class="form-group">
        {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'New password']) !!}
    </div>
    <div class="form-group">
        {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'New password confirm']) !!}
    </div>
    {!! Form::submit('Change password', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@stop
