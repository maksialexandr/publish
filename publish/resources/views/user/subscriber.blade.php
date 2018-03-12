@extends('layouts.profile')
@section('profile_content')
    <div class="bootstrap snippet">

        <div class="header">
            <h3 class="text-muted prj-name">

                Subscriber zone
            </h3>
        </div>
        <div class="row">
            <ul class="list-group">
                @foreach($user->subscribers as $u)
                    <div class="col-lg-4">
                        <div class="profile-usertitle">
                            <a href="/profile/{!! $u->id !!}">
                                @if(!empty($u->preview))
                                    <img src="/{!! $u->preview !!}" width="75" height="75" class="img-circle">
                                @else
                                    <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                                @endif
                                <h4>{!! $u->name !!}</h4>
                            </a>
                            @if($u->getStatus() == 'Online')
                                <span style="margin: auto 25%; color: #119E3E;">{!! $u->getStatus() !!}</span>
                            @else
                                <span style="margin: auto 25%; color: #9e9e9e;">{!! $u->getStatus() !!}</span>
                            @endif

                        </div>
                    </div><!-- /.col-lg-4 -->
                @endforeach
            </ul>
        </div>
    </div>

@stop
