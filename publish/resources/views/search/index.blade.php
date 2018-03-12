@extends('layouts.profile')
@section('profile_content')


    <!--<form action="{!! route('search') !!}" method="POST" class="form-inline">
        <input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter name user for search..." class="form-control" style="width: 300px;">
            <input type="submit" class="btn btn-default" value="Search">
        </div>
    </form>-->

    @foreach($users as $usr)
        <div class="row" style="border-top: 1px solid #DDDDDD; padding: 25px;">
            <div class="col-lg-2">
                <div >
                    <a href="/profile/{!! $usr->id !!}">
                        @if(!empty($usr->preview))
                            <img src="/{!! $usr->preview !!}" width="100" height="100" class="img-responsive img-circle">
                        @else
                            <img src="/public/img/default.jpg" width="100" height="100" class="img-responsive img-circle">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <a href="/profile/{!! $usr->id !!}">
                    <span>{!! $usr->name !!}</span>
                </a>
            </div>
        </div>
    @endforeach
@stop