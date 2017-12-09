@extends('layouts.app')

@section('title') User Administration @endsection

@section('styles')
<style>
       #map, #map2 {
        height: 300px;
        width: 100%;
       }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">User Administration</h4>
            </div>
            <div class="content">
							<form method="POST" action="{{ route('admin/user',['id' => $user_id]) }}" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-9">
										{{ csrf_field() }}
										<div class="form-group">
											<select class="form-control" name="role">
												<option value="1"<?php if($user->role==1) print ' selected'; ?>>User</option>
												<option value="2"<?php if($user->role==2) print ' selected'; ?>>Admin</option>
											</select> 
										</div>
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-wd btn-warning btn-outline">
											<span class="btn-label"><i class="fa fa-exclamation"></i></span> Update
										</button>
									</div>
								</div>
							</form>
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" placeholder="Email" type="email" value="{{ $user->email }}" disabled="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" placeholder="Company" value="{{ $user->name }}" type="text" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" value="{{ $user->lname }}" type="text" disabled="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <input class="form-control" placeholder="City" value="{{ $user->age }}" type="number" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
								<select class="form-control" name="gender" disabled="">
									<option value="Male"<?php if($user->gender=="Male") print ' selected'; ?>>Male</option>
									<option value="Female"<?php if($user->gender=="Female") print ' selected'; ?>>Female</option>
									<option value="Other"<?php if($user->gender=="Other") print ' selected'; ?>>Other</option>
								</select> 
                            </div>
                        </div>
                    </div>
					
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label>Area of interest</label>
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label>Geolocation</label>
								<div id="map2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400" alt="...">
            </div>
            <div class="content">
                <div class="author">
                    <a href="#">
                        <img class="avatar border-gray" src="{{ asset($user->avatar) }}" alt="...">

                        <h4 class="title">{{ $user->name }} {{ $user->lname }}<br>
                                         <small>{{ $user->email }}</small>
                                      </h4>
                    </a>
                </div>
				</br></br></br>
				<hr>
                <p class="description text-center">
					Account created on {{ $user->created_at }}
                </p>
                <p class="description text-center">
                    {{ $user->name }}  submitted {{count($user->issues)}} issues so far.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    var map, infoWindow, marker;

    function initMap() {
		
		var iniLat, iniLng;
		iniLat = {{ $user->lat }};
		iniLng = {{ $user->lng }};
		
		<?php if(isset($user_area[0])) print 'iniLat = '.$user_area[0]->lat.'; iniLng = '.$user_area[0]->lng.';'; ?>
		
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: iniLat,
                lng: iniLng
            },
            zoom: 11
        });
		
        infoWindow = new google.maps.InfoWindow;

        // map 2
        var map2 = new google.maps.Map(document.getElementById('map2'), {
            zoom: 13,
            center: {
                lat: {{ $user->lat }},
                lng: {{ $user->lng }}
            }
        });

		var coords = [<?php foreach($user_area as $coordinates) print "{lat: ".$coordinates->lat.", lng: ".$coordinates->lng." },"; ?>];
        //initialize area draw
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon']
            },
            polygonOptions: {
				paths: coords,
                fillColor: '#d9534f',
                fillOpacity: 0.5,
                strokeWeight: 5,
                clickable: false,
                editable: true,
                zIndex: 1
            }
        });
        drawingManager.setMap(map);
		
		metros = new google.maps.Polygon(
		{
				paths: coords,
                fillColor: '#d9534f',
                fillOpacity: 0.5,
                strokeWeight: 5,
                clickable: false,
                editable: true,
                zIndex: 1
		});
		metros.setMap(map);

        var marker = new google.maps.Marker({
          position: {
                lat: {{ $user->lat }},
                lng: {{ $user->lng }}
		  },
          map: map2,
          draggable: true,
          animation: google.maps.Animation.DROP
        });
		
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
            
            drawingManager.setOptions({
              drawingControl: false
            });

            var vertices = polygon.getPath();
            
            $(vertices.b).each(function(){
                var lat = this.lat();
                var lng = this.lng();

                $('#vertices').append('<input name="area[]" type="hidden" value="'+lat+';'+lng+'">');
            })

            console.log(vertices);

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
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAApItPR-oxvnmOLsXyievDTiNuBM6jQ4s&libraries=drawing&callback=initMap" async defer>
</script>

<script src="{{ asset('js/home/jquery.js') }}"></script>
@endsection
