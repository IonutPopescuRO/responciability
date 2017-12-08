<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Social Responsibility Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		
	<link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}" />
		
		<link rel="stylesheet" href="{{ asset('css/home/animate.css/animate.min.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/home/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/home/styles/app.min.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/home/styles/font.css') }}" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/home/styles/style.css') }}" type="text/css" />
		
		<link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
		
		<style>
			.city {
			   background:url(admin-user-bg.png) no-repeat top center;
			   background: transparent url("{{ asset('images/city.jpg') }}") no-repeat top center fixed;
			   -webkit-background-size: cover;
			   -moz-background-size: cover;
			   -o-background-size: cover;
			   background-size: 100%;
			   height: 500px;
			}
		</style>
    </head>
    <body>
		<header>
			<nav class="navbar navbar-md navbar-fixed-top white">
				<div class="container">
					<a data-toggle="collapse" data-target="#navbar-1" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
						<i class="fa fa-bars"></i>
					</a>

					<a class="navbar-brand md" href="#home" ui-scroll-to="home">
						<img src="{{ asset('images/logo.png') }}">

						<span class="hidden-folded inline">Social Responsibility Portal</span>
					</a>

					<div class="collapse navbar-toggleable-sm text-center white" id="navbar-1">
						<ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">
							@if (Route::has('login'))
									@auth
										<li class="nav-item">
											<a class="nav-link" href="{{ url('/home') }}">
												<span class="nav-text">Home</span>
											</a>
										</li>
									@else
										<li class="nav-item">
											<a class="nav-link" href="{{ route('login') }}">
												<span class="nav-text">Login</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="{{ route('register') }}" ui-scroll-to="features">
												<span class="nav-text">Register</span>
											</a>
										</li>
									@endauth
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30" style="position:fixed; z-index:0; left:50%; top: 20%" class="animated fadeInDownBig">
				<path d="M 48 0 L 24 48 L 0 0 Z" fill="#035063" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="10" height="10" style="position:fixed; z-index:0; left:25%; top: 10%" class="animated fadeInDown">
				<path d="M 48 0 L 24 48 L 0 0 Z" fill="#a88add" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="5" height="5" style="position:fixed; z-index:0; left:30%; top: 0%" class="animated fadeInDown">
				<path d="M 48 0 L 24 48 L 0 0 Z" fill="#f18b00" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20" style="position:fixed; z-index:0; right:5%; top: 30%" class="animated fadeInDown">
				<path d="M 48 0 L 24 48 L 0 0 Z" fill="#067fa0" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="15" height="15" style="position:fixed; z-index:0; left:34.5%; top: 55%" class="animated fadeIn">
				<path d="M 0 48 L 24 0 L 48 48 Z" fill="#eb4b14" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="200" height="200" style="position:fixed; z-index:0; right:20%; top: 70%" class="animated fadeInUp">
				<path d="M 0 48 L 24 0 L 48 48 Z" fill="rgba(252,193,0,0.1)" />
			</svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="120" height="120" style="position:fixed; z-index:0; left:0%; top: 30%" class="animated fadeInLeftBig">
				<path d="M 0 48 L 48 24 L 0 0 Z" fill="rgba(0,0,0,0.03)" />
			</svg>
		</div>
		
		<div class="page-content" id="home">
			<div class="h-v city row-col">
				<div class="row-cell v-b">
					<div class="container p-y-lg pos-rlt">
						<h1 class="display-3 _700 l-s-n-3x m-t-lg m-b-md" style="color:white">Want to <span class="text-primary">help</span> out?</h1>
						
						<a href="#" class="btn btn-danger btn-lg">Report an issue!</a>
					</div>
				</div>
			</div>
			<div class="p-y-lg" id="login">
				<div class="container p-y-lg text-primary-hover">
					<center><h2 class=" _700 l-s-n-1x m-b-md">Here is what we achieved so far!</h2></center>
					<div class="m-y-lg">
						<div class="row top_tiles">
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-caret-square-o-right"></i>
									</div>
									<div class="count">179</div>
									<h3>New Sign ups</h3>
									<p>Lorem ipsum psdea itgum rixt.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-comments-o"></i>
									</div>
									<div class="count">179</div>
									<h3>New Sign ups</h3>
									<p>Lorem ipsum psdea itgum rixt.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-sort-amount-desc"></i>
									</div>
									<div class="count">179</div>
									<h3>New Sign ups</h3>
									<p>Lorem ipsum psdea itgum rixt.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-check-square-o"></i>
									</div>
									<div class="count">179</div>
									<h3>New Sign ups</h3>
									<p>Lorem ipsum psdea itgum rixt.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<footer class="black pos-rlt">
			<div class="footer dk">
				<div class="p-a-md">
					<div class="row footer-bottom">
						<div class="col-sm-8">
							<small class="text-muted">&copy; Copyright 2017 <a href="#" target="_blank">$team = "just code it";</a>. All rights reserved.</small>
						</div>
						<div class="col-sm-4">
							<div class="text-sm-right text-xs-left">
								<strong>My Awesome Budget</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		

		<script src="{{ asset('js/home/jquery.js') }}"></script>
		<script src="{{ asset('js/home/tether.min.js') }}"></script>
		<script src="{{ asset('js/home/bootstrap.js') }}"></script>
    </body>
</html>
