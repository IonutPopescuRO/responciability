<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Responciability</title>

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
		       #map, #map2 {
		        height: 300px;
		        width: 100%;
		       }
		</style>
		<style>
			.city {
			   background:url({{ asset('images/city.jpg') }}) no-repeat top center;
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

					<a class="navbar-brand md" href="#">
						<img src="{{ asset('images/logo.png') }}">

						<span class="hidden-folded inline">Responciability</span>
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
		
		<div class="page-content" id="home">
			<div class="h-v city row-col">
				<div class="row-cell v-b">
					<div class="container p-y-lg pos-rlt">
						<h1 class="display-3 _700 l-s-n-3x m-t-lg m-b-md" style="color:white">Want to <span style="color:#d9534f">help</span> out?</h1>
						
						<a href="{{ url('/home') }}" class="btn btn-danger btn-lg">Report an issue!</a>
					</div>
				</div>
			</div>
			<br>
			<center><h2 class=" _700 l-s-n-1x m-b-md">What does "Responciability" mean?</h2><br>
							<div class="row"> 
								<div class="col-md-4"> </div>
								<div class="col-md-4"><p> Responciability came as a mix between "responsability" and "social" , two matters very important in a day of a fellow human. Our website aims to help social responsibility issues, having people work for people, working together for a better community. </p> </div>
							</div>
			</center>
			<br>
			<div id="map"> </div>

			<div class="p-y-lg" id="login">
				<div class="container p-y-lg text-primary-hover">
					<center><h2 class=" _700 l-s-n-1x m-b-md">Here is what we achieved so far!</h2></center>
					<div class="m-y-lg">
						<div class="row top_tiles">
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-user"></i>
									</div>
									<div class="count">{{count($users)}}</div>
									<h3>Active Users</h3>
									<p>For the people.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-comments-o"></i>
									</div>
									<div class="count">{{count($solvedIssues)}}</div>
									<h3>Solved Issues</h3>
									<p>For a better community.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-thumbs-o-up"></i>
									</div>
									<div class="count">{{$upvotes}}</div>
									<h3>Upvotes</h3>
									<p>For recognition.</p>
								</div>
							</div>
							<div class="box white box-shadow-z3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-thumbs-o-down"></i>
									</div>
									<div class="count">{{$downvotes}}</div>
									<h3>Downvotes</h3>
									<p>For social responsibility.</p>
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
							<small class="text-muted">&copy; Copyright 2017. All rights reserved.</small>
						</div>
						<div class="col-sm-4">
							<div class="text-sm-right text-xs-left">
								<strong><a href="#" target="_blank">$team = "just code it";</a></strong>
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

<script>
    var map, infoWindow, marker;

    function initMap() {
        
        var iniLat, iniLng;
        iniLat = 45.7489;
        iniLng = 21.2087;
        
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: iniLat,
                lng: iniLng
            },
            zoom: 11
        });
        
        @foreach($issues as $issue)

            var contentString{{$loop->iteration}} = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<a href="{{route("viewIssue", ["id" => $issue->id])}}"><h4 id="firstHeading" class="firstHeading">{{$issue->title}}</h4></a>'+
            '<div id="bodyContent">'+
            '<p>{{$issue->description}}</p>'+
            '<img class="img-responsive" style="width: 100%;" src="{{asset($issue->image)}}" />'+
            '</div>'+
            '</div>';

            var infowindow = new google.maps.InfoWindow({
              content: contentString{{$loop->iteration}}
            });

            var marker{{$loop->iteration}} = new google.maps.Marker({
              position: {
                    lat: {{ $issue->lat }},
                    lng: {{ $issue->lng }}
              },
              map: map,
              draggable: false,
              clickable: true,
              animation: google.maps.Animation.DROP
            });

            marker{{$loop->iteration}}.addListener('click', function() {
              infowindow.close(); // Close previously opened infowindow
              infowindow.setContent(contentString{{$loop->iteration}});
              infowindow.open(map, marker{{$loop->iteration}});
            });

        @endforeach

        infoWindow = new google.maps.InfoWindow;

        var cityCircle = new google.maps.Circle({
	      strokeColor: '#d9534f',
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: '#d9534f',
	      fillOpacity: 0.35,
	      map: map,
	      center: {lat: 45.7489, lng: 21.2087},
	      radius: 5000
	    });
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function handleEvent() {
        console.log(marker);
        $('#location').val(marker.position.lat()+';'+marker.position.lng());
    }

</script>

<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWp9GONdDBwwU7eBcaY8G7DgbDDMZX6hk&libraries=drawing&callback=initMap" async defer>
</script>