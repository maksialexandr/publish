@extends('layouts.profile')
@section('profile_content')
        <!--<div class="row justify-content-md-center">
            <div class="col-lg-12">
                @foreach($twits as $twit)
                    @if($twit->twit_id)
                        {!! Helper::renderRepostTwit($twit, $twit->user) !!}
                    @else
                        {!! Helper::renderSimpleTwit($twit, $twit->user) !!}
                    @endif
                @endforeach
            </div>
            <input id="signup-token" name="_token" type="hidden" value="{{ csrf_token() }}">
            {!! Helper::renderJS() !!}
            {!! Helper::renderJStwit() !!}
        </div>-->
@stop