@extends('layouts.group')
@section('group_content')
    <div class="row justify-content-md-center">
        <div class="col-lg-12">
            @if (Auth::user() == $group->user)
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                {!! Form::open(array('action' => 'TwitsController@create', 'enctype' => 'multipart/form-data', 'method' => 'POST')) !!}
                {!!  Form::hidden('user_id', null) !!}
                {!!  Form::hidden('group_id', $group->id) !!}
                <div class="form-group">
                    {!! Form::label('Twits') !!}
                    {!! Form::textarea('content', false,['class' => 'form-control',  'rows' => 5, 'placeholder' => 'Enter your twit...']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('link', false,['class' => 'form-control', 'placeholder' => 'Enter your link from YOUTUBE...']) !!}
                </div>
                <div class="fileform">
                    <div id="fileformlabel"></div>
                    <div class="selectbutton">Обзор</div>
                    <input type="file" name="picture" id="upload" onchange="getName(this.value);" />
                </div>

                {!! Form::submit('Save twit', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            @endif
            <br />
            @foreach($twits as $twit)
                @if($twit->twit_id)
                    {!! Helper::renderSimpleTwit($twit, $group) !!}
                @else
                    {!! Helper::renderSimpleTwit($twit, $group) !!}
                @endif
            @endforeach
        </div>
        <input id="signup-token" name="_token" type="hidden" value="{{ csrf_token() }}">
        {!! Helper::renderJS() !!}
        {!! Helper::renderJStwit() !!}

    </div>

    <script>
        $(document).ready(function(){

            $('#captions').lightGallery();
        });
        function handlerPopUp() {
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                preloader: false,
                closeOnBgClick: true,
                showCloseBtn: false,
                callbacks: {
                }
            });
        };

    </script>


@stop