@extends('layouts.profile')
@section('profile_content')

        {!! Form::open(array('route' => 'create', 'enctype' => 'multipart/form-data', 'method' => 'post')) !!}
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', false,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('content') !!}
            {!! Form::textarea('content', false,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Picture') !!}
            {!! Form::file('picture') !!}
        </div>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


@stop

