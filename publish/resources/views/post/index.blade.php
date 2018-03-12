@extends('layouts.app')
@section('content')
    <div class="container">
        <section id="blog-section" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">


                            @foreach($posts as $post)
                                <div class="col-lg-4 col-md-4">

                                    <aside>
                                        <a href="/post/{!! $post->id !!}">@if(!empty($post->picture)) <img src="/{!! $post->picture !!}"  width="350" height="350" class="">
                                            @else
                                                <img src="/public/img/default.jpg" width="350" height="350" class="">
                                            @endif</a>
                                        <!--<div class="content-title">
                                            <div class="text-center">
                                                <h4>{!! $post->name !!}</h4>
                                            </div>
                                        </div>-->
                                        <div class="content-footer" >

                                            @if(!empty($post->user->preview)) <img src="/{!! $post->user->preview !!}" width="75" height="75" class="">
                                            @else
                                                <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                                            @endif

                                            <span style="font-size: 16px;color: #fff;"><a href="/profile/{!! $post->user->id !!}">{!! $post->user->name !!}</a></span>
                                            <span class="pull-right">
				<a href="#" data-toggle="tooltip" data-placement="left" title="Comments"><i class="fa fa-comments" ></i> 30</a>
				<a href="#" data-toggle="tooltip" data-placement="right" title="Loved"><i class="fa fa-heart"></i> 20</a>
				</span>
                                            <div class="user-ditels">
                                                <div class="user-img">@if(!empty($post->user->preview)) <img src="/{!! $post->user->preview !!}" width="75" height="75" class="img-circle">
                                                    @else
                                                        <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                                                    @endif</div>
                                                <a href="/profile/{!! $post->user->id !!}"><span class="user-full-ditels">
                                                    <h3>{!! $post->user->name !!}</h3>
                                                    <!--<p>{!! $post->user->position !!}</p>-->
                                                    </span></a>
                                                <div class="social-icon">
                                                    <a href="#"><i class="fa fa-facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"></i></a>
                                                    <a href="#"><i class="fa fa-twitter" data-toggle="tooltip" data-placement="bottom" title="Twitter"></i></a>
                                                    <a href="#"><i class="fa fa-google-plus" data-toggle="tooltip" data-placement="bottom" title="Google Plus"></i></a>
                                                    <a href="#"><i class="fa fa-youtube" data-toggle="tooltip" data-placement="bottom" title="Youtube"></i></a>
                                                    <a href="#"><i class="fa fa-github" data-toggle="tooltip" data-placement="bottom" title="Github"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>

                            @endforeach


                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
