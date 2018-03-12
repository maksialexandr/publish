@extends('layouts.profile')
@section('profile_content')
    <div class="bootstrap snippet">

        
        <a href="/group/create" class="btn btn-default" style="float: right;"> Create group </a>
        <div class="header">
            <h3 class="text-muted prj-name">
                Groups
            </h3>
        </div>
        <div class="row">
            <ul class="list-group">
                @foreach($groups as $group)
                    <div class="col-lg-4">
                        <div class="profile-usertitle">
                            <a href="/group/{!! $group->id !!}">
                                @if(!empty($group->preview))
                                    <img src="/{!! $group->preview !!}" width="75" height="75" class="img-circle">
                                @else
                                    <img src="/public/img/default.jpg" width="75" height="75" class="img-circle">
                                @endif
                                <h4>{!! $group->name !!}</h4>
                            </a>
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@stop