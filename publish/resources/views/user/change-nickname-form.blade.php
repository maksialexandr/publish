@extends('layouts.profile')
@section('profile_content')
    @foreach($errors->all() as $msg)
        <div class="alert alert-danger">{!! $msg !!}</div>
    @endforeach
    <div class="header">
        <h4 class="text-muted prj-name">
            New nickname
        </h4>
    </div>
<div class="form-group">
    {!! Form::open(['action' => 'UserController@changeNickname', 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::text('nickname', old('nickname'), ['class' => 'form-control']) !!}
    </div>
    {!! Form::submit('Change nickname', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@stop