@extends('layouts.profile')
@section('profile_content')
    <div class="status-online text-right">
        {!! $status !!}
    </div>
    @if(session('msg'))
        <div class="alert alert-success">{!! session('msg') !!}</div>
    @endif
    <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
    <section id="blog-section" >
        <div class="row justify-content-md-center">
            <div  class="col-lg-12">
                @if (Auth::user() == $user)
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    {!! Form::open(array('action' => 'TwitsController@create', 'enctype' => 'multipart/form-data', 'method' => 'POST')) !!}
                    {!!  Form::hidden('user_id', Auth::user()->id) !!}
                    {!!  Form::hidden('group_id', null) !!}
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
                <br>
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12">
                            @foreach($twits as $twit)
                                @if($twit->twit_id)
                                    @if($twit->group_id)
                                        {!! Helper::renderRepostTwit($twit, $twit->group) !!}
                                    @else
                                        {!! Helper::renderRepostTwit($twit, $twit->user) !!}
                                    @endif
                                @else
                                    @if($twit->group_id)
                                        {!! Helper::renderSimpleTwit($twit, $twit->group) !!}
                                    @else
                                        {!! Helper::renderSimpleTwit($twit, $twit->user) !!}
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <input id="signup-token" name="_token" type="hidden" value="{{ csrf_token() }}">
                        {!! Helper::renderJS() !!}
                        {!! Helper::renderJStwit() !!}
                    </div>
                    <button class="btn-load-more" id="download" data-parameter="{!! $user->id !!}">LOAD MORE</button>
    </section>
    </div>
    <div class="col-lg-2">
        </section>
    </div>
    <script>


        function removeClickListener(twit_id) {
            $.ajax({
                url: "/twit/delete/" + twit_id,
                success: function () {
                    $('#twit_' + twit_id).hide('slow', function(){
                        $(this).remove();
                    });
                }
            });
        };


        $(document).ready(function(){
            var start = 6;
            $('#download').click(function () {
                $.ajax({
                    type: 'POST',
                    data: { '_token': $('#signup-token').val(), start : start },
                    url: "/twit/paginate/" + this.getAttribute("data-parameter"),
                    dataType: 'json',
                    success: function (date) {
                        $('#download').before(date.html);
                        start += 5;
                        if (!date.load)
                            $('#download').remove();
                    }
                });
            });

            $('.twit_remove').click(function () {
                var twit_id = this.getAttribute("data-parameter");
                if(twit_id)
                    removeClickListener(twit_id);
            });
            $('.captions').lightGallery();
            $('.fixed-size').lightGallery({
                width: '1000px',
                height: '670px',
                mode: 'lg-fade',
                addClass: 'fixed-size',
                counter: false,
                download: false,
                startClass: '',
                enableSwipe: false,
                enableDrag: false,
                speed: 500
            });

            handlerPopUp();

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



