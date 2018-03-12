@extends('layouts.profile')
@section('profile_content')
    <div class="header">
        <h4 class="text-muted prj-name">
            Update profile
        </h4>
    </div>
    <br />
    <div style="margin-bottom: 20px;">
        <a href="{!! route('profile.change-password-form') !!}" class="btn btn-default">Change password</a>
        <a href="{!! route('profile.change-nickname-form') !!}" class="btn btn-default">Change nickname</a>
    </div>
        {!! Form::model($user, ['enctype' => 'multipart/form-data','action' => 'UserController@update', 'method' => 'PUT']) !!}
        {!!  Form::hidden('id', $user->id) !!}
        <div class="form-group">
            <div class="fileform">
                <div id="fileformlabel"></div>
                <div class="selectbutton">Обзор</div>
                <input type="file" name="preview" id="upload" onchange="getName(this.value);" />
            </div>
        </div>
        <div class="form-group">

            {!! Form::label('status', 'Status') !!}
            {!! Form::text('status', $user->status, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('position', 'Position') !!}
            {!! Form::text('position', $user->position, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $user->name ,['class' => 'form-control', 'readonly' => 'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', $user->email,['class' => 'form-control', 'readonly' => 'true']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('gender', 'Gender') !!}
            {!! Form::select('gender', ['1' => 'man', '0' => 'woman'], $user->gender, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('birthday', 'Birthday') !!}
            <input type="date" name="birthday" value="{!! $user->getBirthday() !!}" />
        </div>
        {!! Form::submit('Update profile', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}



<script>
        function getName (str){
            if (str.lastIndexOf('\\')){
                var i = str.lastIndexOf('\\')+1;
            }
            else{
                var i = str.lastIndexOf('/')+1;
            }
            var filename = str.slice(i);
            var uploaded = document.getElementById("fileformlabel");
            uploaded.innerHTML = filename;
        }
    </script>
@stop
