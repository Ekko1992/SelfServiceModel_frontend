<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>Vmaxx</title>
    <!-- Styles -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/goalProgress.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body id="app-layout">
<header>
    <div class="header-left">
        <a href="{{ url('/home') }}"><img src="{{ asset('image/vmaxx_newlogo.png') }}" alt=""></a>
    </div>
    <div class="header-right">
        @if (Auth::guest())
            <div>
                <a class="header-register" id="header-register">Register</a>&numsp;|&numsp;
                <a class="header-login" id="header-login">Login</a>
            </div>
        @else
            <p>Welcome, {{ Auth::user()->name }} !</p>
            <span><a class="headerRegister">My Profile</a></span><span>&numsp;|&numsp;</span>
            <span><a class="insidePageHeaderLogin" href="{{ url('/logout') }}">Logout</a></span>
            <div class="insideHeaderHamburgerMenu">
                <i class="material-icons">more_vert</i>
            </div>
            <ul class="mini-navigation">
              <li class="headerRegister"><a>My Profile</a></li>
              <li><a class="insidePageHeaderLogin"  href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        @endif
    </div>
</header>
<div class="index-header">
    <img src="{{ asset('image/People_edited_crop.jpg') }}" alt="">
    <div class="index-header-middle">
        <h1>Demographics in 3 simple steps</h1>
        <div class="index-header-middle-link">
            <a>Start Here</a>
        </div>
    </div>
</div>
<div class="index-center">
    <div>
        <img src="{{ asset('image/step_upload.png') }}" alt="">
        <h4>Step&nbsp;1:</h4>
        <p>Upload images</p>
    </div>
    <div>
        <img src="{{ asset('image/step_select.png') }}" alt="">
        <h4>Step&nbsp;2:</h4>
        <p> Select metrices</p>
    </div>
    <div>
        <img src="{{ asset('image/step_download.png') }}" alt="">
        <h4>Step&nbsp;3:</h4>
        <p>View and download results</p>
    </div>
</div>
<div id="LoginText">
    <div class="Background-shadow"></div>
    <div id="login-style">
        @include('auth.login')
    </div>
    <div id="register-style">
        @include('auth.register')
    </div>
    <div id="Agreement-style">
        @include('auth.agreement')
    </div>
    <div id="forgetPassword">
        @include('auth.passwords.email')
    </div>
</div>
@include('auth.setting')
<input type="hidden" value="{{csrf_token()}}" id="token">
<footer>
    <div></div>
    Property of VMaxx inc.
</footer>
</body>
</html>
<!-- JavaScripts -->
<script type="text/javascript" src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.cookie.js') }}"></script>

@section('content')
