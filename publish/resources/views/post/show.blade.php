@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container">
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">{!! $post->name !!}</h2>
                    <p class="lead">{!! $post->content !!}</p>
                </div>
                <div class="col-md-5">
                    @if(!empty($post->picture)) <img src="/{!! $post->picture !!}" width="275" height="275" class="img-responsive">
                    @else
                        <img src="/public/img/default.jpg" width="275" height="275" class="img-responsive">
                    @endif
                </div>
                @if(Auth::check() && Auth::user()->id == $post->user_id)
                    <a class="glyphicon glyphicon-pencil" href="/post/update/{!! $post->id !!}"></a>
                    <a class="glyphicon glyphicon-remove" href="/post/destroy/{!! $post->id !!}"></a>
                @endif
            </div>
        </div>
    </div>
@stop
