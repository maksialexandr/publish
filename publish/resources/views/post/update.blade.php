@extends('layouts.profile')
@section('profile_content')

        {!! Form::model($post, [route('update', $post->id), 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
        {!!  Form::hidden('id', $post->id) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $post->name ,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('content', 'Content') !!}
            {!! Form::textarea('content', $post->content,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Picture') !!}
            {!! Form::file('picture') !!}
        </div>
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
@stop