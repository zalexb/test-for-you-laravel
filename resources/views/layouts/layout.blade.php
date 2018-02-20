<!DOCTYPE>
<html>
<head>
    <title>My Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- jQuery library -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <!--custom-->
    <script src="{{asset('js/scripts.js')}}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!--header-->
<div style="background-color: black;width: 100%;padding: 0;margin: 0" class="header-top">
    <div class="container">
        <div class="top-right">
            @if(!session('user')['auth'])
            <ul class="login_list">
                <li class="text"><a class="login" href="javascript:;">Login</a></li>
            </ul>
            @else
            <ul class="login_list">
                <li style="border-left: none" class="text"><span style="color: white"> Hello, {{session('user')['username']}}</span></li>
                <li class="text"><a href="{{route('logout')}}">Logout</a></li>
            </ul>
            @endif
        </div>
    </div>
</div>
<div class="header">
    <div class="container">
        <nav class="nav_bar">
            <div class="nav_bar_header">
                <h1 class="nav_brand">
                    Welcome
                </h1>
            </div>
            <div class="collapse navbar-collapse">
                <ul style="margin-top: 2em" class="nav navbar-nav">
                    <li><a href="{{route('index')}}">Home</a></li>
                    @if(session('user')['auth'])
                        <li><a href="{{route('create_post')}}">Create post</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<div>
    <div style="" id="login_modal">
        <span id="login_close">X</span>
        <div style="color: red;font-size: 120%" class="login_errors"></div>
        <form id="login" method="POST" action="javascript:;">
            <div class="form-group">
                <label for="name">Username:</label>
                <input name="username" style="width: 200px" type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" style="width: 200px" type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
    </div>
    <div id="overlay"></div>
</div>
<div id="content">
    @yield('content')
</div>
</body>
</html>