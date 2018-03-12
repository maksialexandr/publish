@extends('layouts.profile')
@section('profile_content')
    <div class="row justify-content-md-center">
        <div  class="col-lg-12">
            <div class="header">
                <h4 class="text-muted prj-name">
                    Create group
                </h4>
            </div>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                {!! Form::open(array('action' => 'GroupController@store', 'enctype' => 'multipart/form-data', 'method' => 'POST')) !!}
                {!!  Form::hidden('user_id', Auth::user()->id) !!}
                <div class="form-group">
                    {!! Form::text('name', false,['class' => 'form-control',  'placeholder' => 'Enter name group...']) !!}
                </div>
                <div class="fileform">
                    <div id="fileformlabel"></div>
                    <div class="selectbutton">Обзор</div>
                    <input type="file" name="preview" id="upload" onchange="getName(this.value);" />
                </div>
                {!! Form::submit('Create group', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
        </div>


@stop