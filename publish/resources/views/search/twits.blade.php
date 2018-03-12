@extends('layouts.profile')
@section('profile_content')

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
@stop