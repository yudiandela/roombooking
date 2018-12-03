
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>Booking Ruangan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="{{asset('css/admin_css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{asset('css/admin_css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/admin_css/font-awesome.css')}}" rel="stylesheet">
    <script src="{{asset('js/admin_js/jquery.min.js')}}"> </script>
    <!-- Mainly scripts -->
    <script src="{{asset('js/admin_js/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/admin_js/jquery.slimscroll.min.js')}}"></script>
    <!-- Custom and plugin javascript -->
    <link href="{{asset('css/admin_css/custom.css')}}" rel="stylesheet">
    <script src="{{asset('js/admin_js/custom.js')}}"></script>
    <script src="{{asset('js/admin_js/custom1.js')}}"></script>
    <script src="{{asset('js/admin_js/screenfull.js')}}"></script>
    <link href="{{asset('css/admin_css/owl.carousel.css')}}" rel="stylesheet">
    <script src="{{asset('js/admin_js/owl.carousel.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
<div class="login">
    <h1><a href="{{url('login')}}">Meeting Room <br> Booking System </a>
    </h1>
    <form class="form-horizontal" method="POST" action="{{ route('password.resetok', ['token'=>request()->token]) }}">
        {{ csrf_field() }}
        <div class="login-bottom">
            <h2>Reset Password</h2>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </div>
    </form>
</div>
<!---->
<div class="copy-right">
    <p> &copy; 2018 Barkah. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>      </div>
<!---->
<!--scrolling js-->
<script src={{asset('js/jquery.nicescroll.js')}}></script>
<script src={{asset('js/admin_js/scripts.js')}}></script>
<!--//scrolling js-->
</body>
</html>

