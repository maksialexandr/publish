@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-1" ></div>
            <div class="col-md-3" style="position: fixed; top: 50px; left: 220px;">
                <div class="profile-sidebar" style="box-shadow: -1px -1px 19px 0px rgba(175, 174, 174, 0.5);">
                    <div class="profile-usertitle">
                    </div>

                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <div id="captions" class="fixed-size">

                            @if(!empty($group->preview))
                                <a href="/{!! $group->preview !!}" data-sub-html="#caption2">
                                    <img src="/{!! $group->preview !!}" class="img-responsive">
                                </a>
                            @else
                                <a href="/public/img/default.jpg" data-sub-html="#caption2">
                                    <img src="/public/img/default.jpg" class="img-responsive">
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {!! $group->name !!}
                        </div>
                    </div>

                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="">
                                <a disabled="true" href="/profile/{!! Auth::id() !!}">
                                    <i class="glyphicon glyphicon-home"></i>
                                    HOME </a>
                            </li>
                            <!--<li>
                                <a disabled="true" href="/profile/subscriber/">
                                    <i class="glyphicon glyphicon-user"></i>
                                    FOLLOWERS (<span id="followers"></span>)</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="left:360px; top: 25px;">
                <div class="profile-content" style="box-shadow: -1px -1px 19px 0px rgba(175, 174, 174, 0.5);">
                    @yield('group_content')
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){

            $('.#captions').lightGallery();
        });
        $('#captions').lightGallery();
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
    </script>

@stop



