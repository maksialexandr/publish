@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-1" ></div>
            <div class="col-md-3" style=" top: 50px;">
                <div class="profile-sidebar" style="box-shadow: -1px -1px 19px 0px rgba(175, 174, 174, 0.5);">
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-job">
                            {!! $user->status !!}
                        </div>
                    </div>
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <div id="captions" class="fixed-size">
                            @if(!empty($user->preview))
                                <a href="/{!! $user->preview !!}" data-sub-html="#caption2">
                                    <img src="/{!! $user->preview !!}" class="img-responsive">
                                </a>
                            @else
                                <a href="/public/img/default.jpg" data-sub-html="#caption2">
                                    <img src="/public/img/default.jpg" class="img-responsive">
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        @if (Auth::user()->id == $user->id)
                            <div style="margin-top: -10px;">
                                <small><a href="{!! route('profile.photo.delete', Auth::user()) !!}">delete photo</a></small>
                            </div>
                        @endif
                        <div class="profile-usertitle-name">
                            <a href="/profile/{!! $user->id !!}">{!! $user->name !!}</a>
                            @if($user->confirmed)
                                <img src="{!! asset('icon/star.png') !!}" width="24" height="24">
                            @endif
                        </div>
                        <div class="profile-usertitle-job">
                            {!! $user->position !!}
                        </div>
                        <div class="profile-usertitle-job">
                            <li class="fa fa-at"></li>{!! $user->nickname !!}
                        </div>
                        <div class="profile-usertitle-job">
                            {!! $user->phone !!}
                        </div>
                        <div class="profile-usertitle-job">
                            {!! $user->birthday->format('j F Y') !!}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">

                        @if (Auth::user()->id == $user->id)
                            <a href="/profile/update"><button type="button" class="btn btn-success btn-sm"><i style="color: #FFFFFF; font-size:16px; margin-right: 10px;" class="fa fa-cogs"></i>Update</button></a>
                            <a href="/message"><button type="button" class="btn btn-default btn-sm" style="position:relative; outline: none;">
                                    <i style="color: #5cb85c; font-size:16px; margin-right: 3px;" class="fa fa-bell"></i>Message</button></a>
                        @elseif(!(Auth::user() == $user) )
                            <button @if (!($user::hasFriends(Auth::user()->friends, $user->id))) style="display: none" @endif id="add_{!! $user->id !!}" type="button" class="btn btn-success btn-sm">Follow</button>
                            <button @if (($user::hasFriends(Auth::user()->friends, $user->id))) style="display: none" @endif  id="delete_{!! $user->id !!}" type="button" class="btn btn-success btn-sm">Delete</button>
                        @endif
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu" style="border-top: 15px solid #dfdfdf;">
                        <ul class="nav">
                            <li class="">
                                <a href="/profile/{!! Auth::user()->id !!}">
                                    <i class="glyphicon glyphicon-home"></i>
                                    HOME </a>
                            </li>
                            <li>
                                <a href="/profile/friends/{!! $user->id !!}">
                                    <i class="glyphicon glyphicon-user"></i>
                                    FRIENDS ({!! $user->getCountFriends() !!})</a>

                            </li>
                            <li>
                                <a href="/profile/subscriber/{!! $user->id !!}">
                                    <i class="glyphicon glyphicon-user"></i>
                                    FOLLOWERS (<span id="followers">{!! $user->getCountSubscribers() !!}</span>)</a>

                            </li>
                            <li>
                                <a href="/group/list/{!! $user->id !!}" >
                                    <i class="glyphicon glyphicon-ok"></i>
                                    GROUPS</a>
                            </li>
                            <!--<li>
                                <a href="/post/create">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    ADD POSTS </a>
                            </li>-->
                        </ul>
                    </div>

                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-6" style=" top: 50px;">
                <div class="profile-content" style="box-shadow: -1px -1px 19px 0px rgba(175, 174, 174, 0.5);">
                    @yield('profile_content')
                </div>
            </div>
        </div>
    </div>
    <script>


        function deleteClickListener($element) {
            $.ajax({
                url: "/profile/friends/delete/{!! $user->id !!}",
                success: function () {
                    $($element).css('display', 'none');
                    $('#add_{!! $user->id !!}').css('display', 'inline-block');
                    $('#followers').text(function( text ) {
                        var number = Number(text) + 1;
                        return --number;
                    });
                }
            });
        };
        function addClickListener($element) {
            $.ajax({
                url: "/profile/friends/add/{!! $user->id !!}",
                success: function () {
                    $($element).css('display', 'none');
                    $('#delete_{!! $user->id !!}').css('display', 'inline-block');
                    $('#followers').text(function( text ) {
                        return ++text;
                    });
                }
            });
        };
        $(document).ready(function(){
            $('#add_{!! $user->id !!}').click(function () {
                addClickListener(this);
            });
            $('#delete_{!! $user->id !!}').click(function () {
                deleteClickListener(this);
            });
            $('#captions').lightGallery();
        });



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



