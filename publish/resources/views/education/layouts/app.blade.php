<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Publish</title>
    <link href="/public/css/style_profile.css" rel="stylesheet">
    <link href="/public/css/style_list_news.css" rel="stylesheet">
    <link href="/public/css/magnific-popup.css" rel="stylesheet">
    <link href="/public/css/lightgallery.css" rel="stylesheet">
    <link href="/public/css/lightgallery.css.map" rel="stylesheet">
    <link href="/public/css/lightgallery.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <link rel="icon" type="image/png" href="{!! asset('icon.png') !!}">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
<!-- JavaScripts -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/public/js/jquery.min.js" type="text/javascript"></script>
    <script src="/public/js/lightgallery.js" type="text/javascript"></script>
    <script src="/public/js/jquery.magnific-popup.js" type="text/javascript"></script>
    <script src="/public/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
@if(Auth::user())
    <nav class="navbar navbar-default navbar-static-top" style="position:fixed; left:90px;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <!--<a class="navbar-brand" href="/post">
                    Publications
                </a>-->

                <a class="navbar-brand" href="/twit">
                    Twits
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!-- Right Side Of Navbar -->
                @if(Auth::user())
                    <ul class="nav navbar-nav navbar-left" style="padding-top: 6px;">
                        <form action="{!! route('search') !!}" method="POST" class="form-inline">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Enter name user for search..." class="form-control" style="width: 300px;">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </ul>
                    <ul class="nav navbar-nav navbar-left"  style="padding-top: 6px; margin-left: 10px;">
                        <form action="{!! route('search.twits') !!}" method="POST" class="form-inline">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Enter hash tag" class="form-control" style="width: 130px;">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </ul>
                    <ul class="nav navbar-nav navbar-left"  style="padding-top: 10px; margin-left: 280px;">
                        <a href="/profile/notice"><button type="button" class="btn btn-default btn-sm" style="position:relative; outline: none;"><i style="color: #5cb85c; font-size:16px; margin-right: 3px;" class="fa fa-bell"></i>
                                @if (!empty($count_notice))
                                    <span class="fa fa-circle" style="font-size: 25px; position: absolute; bottom: 15px; right: -10px; color: #C53340;"></span>
                                    <span style="font-size: 12px; position: absolute; bottom: 19px; right: -3px; color: #FFF;">
                                            {!! $count_notice !!}
                                    </span>
                                @endif
                                Notification</button>
                        </a>
                    </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ (!empty(Auth::user())) ? Auth::user()->name : '' }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/profile/{!! (!empty(Auth::user())) ? Auth::user()->id : '' !!}"><i class="fa fa-btn fa-user"></i> Profile</a></li>
                                <li><a href="/profile/friends/{!! (!empty(Auth::user())) ? Auth::user()->id : '' !!}"><i class="fa fa-users"></i> Friends</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
@yield('content')


</body>
</html>
