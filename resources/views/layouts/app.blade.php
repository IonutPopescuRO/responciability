<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />

    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title') - Responciability</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="{{asset('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

	@yield('styles')
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    <img src="{{asset('images/icon.png')}}" width="32px" style="margin-bottom: 10px;"> Responciability
                </a>
            </div>

            <ul class="nav">
				@auth
					<li {{{ (Request::is('home') ? 'class=active' : '') }}}>
						<a href="{{ route('home') }}">
							<i class="pe-7s-graph"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li {{{ (Request::is('profile') ? 'class=active' : '') }}}>
						<a href="{{ route('profile') }}">
							<i class="pe-7s-user"></i>
							<p>User Profile</p>
						</a>
					</li>
					<li>
						<a href="table.html">
							<i class="pe-7s-note2"></i>
							<p>Table List</p>
						</a>
					</li>
					<li>
						<a href="typography.html">
							<i class="pe-7s-news-paper"></i>
							<p>Typography</p>
						</a>
					</li>
					<li>
						<a href="icons.html">
							<i class="pe-7s-science"></i>
							<p>Icons</p>
						</a>
					</li>
					<li>
						<a href="maps.html">
							<i class="pe-7s-map-marker"></i>
							<p>Maps</p>
						</a>
					</li>
					<li>
						<a href="notifications.html">
							<i class="pe-7s-bell"></i>
							<p>Notifications</p>
						</a>
					</li>
					<li class="active-pro">
						<a href="upgrade.html">
							<i class="pe-7s-rocket"></i>
							<p>Upgrade to PRO</p>
						</a>
					</li>
				@else
					<li {{{ (Request::is('login') ? 'class=active' : '') }}}>
						<a href="{{ route('login') }}">
							<i class="pe-7s-user"></i>
							<p>Login</p>
						</a>
					</li>
					<li {{{ (Request::is('register') ? 'class=active' : '') }}}>
						<a href="{{ route('register') }}">
							<i class="pe-7s-add-user"></i>
							<p>Register</p>
						</a>
					</li>
				@endauth
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">@yield('title')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
						@auth
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        {{ Auth::user()->name }} 
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ route('profile') }}">User Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="#">nu</a></li>
                              </ul>
                        </li>
                        <li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
                        </li>
						@else
                        <li>
                           <a href="{{ route('login') }}">
                               <p>Login</p>
                            </a>
						</li>
						<li>
                           <a href="{{ route('register') }}">
                               <p>Register</p>
                            </a>
                        </li>
						@endauth
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
				@yield('content')
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
						@auth
							<li>
								<a href="{{ route('home') }}">
									Dashboard
								</a>
							</li>
							<li>
								<a href="{{ route('profile') }}">
									User Profile
								</a>
							</li>
						@else
							<li>
							   <a href="{{ route('login') }}">
								   Login
								</a>
							</li>
							<li>
							   <a href="{{ route('register') }}">
								   Register
								</a>
							</li>
						@endauth
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Responciability</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>
	<script src="{{ asset('js/home/jquery.js') }}"></script>
    <!--   Core JS Files   -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="{{asset('assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="{{asset('assets/js/demo.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();
/*
            $.notify({
                icon: 'pe-7s-gift',
                message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });
*/
        });
    </script>
	@yield('scripts')
</html>
