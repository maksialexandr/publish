@extends('layouts.profile')
@section('profile_content')
    @if($twit->twit_id)
        {!! Helper::renderRepostTwit($twit, $twit->user) !!}
    @else
        {!! Helper::renderSimpleTwit($twit, $twit->user) !!}
    @endif
    <input id="signup-token" name="_token" type="hidden" value="{{ csrf_token() }}">
    {!! Helper::renderJS() !!}
    {!! Helper::renderJStwit() !!}
@stop
