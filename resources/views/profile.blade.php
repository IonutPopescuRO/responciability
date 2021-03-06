@extends('layouts.app')

@section('title') Profile @endsection

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
                <h4 class="title">Edit Profile</h4>
            </div>
            <div class="content">
                <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input class="form-control" placeholder="Email" type="email" value="{{ Auth::user()->email }}" disabled="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" placeholder="Company" value="{{ Auth::user()->name }}" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" placeholder="Last Name" value="{{ Auth::user()->lname }}" type="text" name="lname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Age</label>
                                <input class="form-control" placeholder="Age" value="{{ Auth::user()->age }}" type="number" name="age">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender</label>
								<select class="form-control" name="gender">
									<option value="Male"<?php if(Auth::user()->gender=="Male") print ' selected'; ?>>Male</option>
									<option value="Female"<?php if(Auth::user()->gender=="Female") print ' selected'; ?>>Female</option>
									<option value="Other"<?php if(Auth::user()->gender=="Other") print ' selected'; ?>>Other</option>
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
					
                    <div id="vertices">
						<input type="hidden" name="location" id="location" value="{{ Auth::user()->lat }};{{ Auth::user()->lng }}" />
						<?php foreach($user_area as $coordinates) 
								print '<input id="area" name="area[]" value="'.$coordinates->lat.';'.$coordinates->lng.'" type="hidden">
								'; ?>
                    </div>
					
                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
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
                        <img class="avatar border-gray" src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">

                        <h4 class="title">{{ Auth::user()->name }} {{ Auth::user()->lname }}<br>
                                         <small>{{ Auth::user()->email }}</small>
                                      </h4>
                    </a>
                </div>
				</br></br></br>
				<hr>
                <p class="description text-center">
					Account created on {{ Auth::user()->created_at }}
                </p>
                <p class="description text-center">
                    You submitted {{count(Auth::user()->issues)}} issues so far.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    var map, infoWindow, marker, metros, drawingManager;

      function CenterControl(controlDiv, map) {

        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to recenter the map';
        controlDiv.appendChild(controlUI);

        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Reset Map';
        controlUI.appendChild(controlText);

        controlUI.addEventListener('click', function() {
          initMap();
		  metros.setMap(null);
		  
			var elms = document.querySelectorAll("[id='area']");

			for(var i = 0; i < elms.length; i++) 
			  elms[i].remove(); // <-- whatever you need to do here.
        });

      }
	
    function initMap() {
		
		var iniLat, iniLng;
		iniLat = {{ Auth::user()->lat }};
		iniLng = {{ Auth::user()->lng }};
		
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
                lat: {{ Auth::user()->lat }},
                lng: {{ Auth::user()->lng }}
            }
        });

		var coords = [<?php foreach($user_area as $coordinates) print "{lat: ".$coordinates->lat.", lng: ".$coordinates->lng." },"; ?>];
        //initialize area draw
        drawingManager = new google.maps.drawing.DrawingManager({
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

        marker = new google.maps.Marker({
          position: {
                lat: {{ Auth::user()->lat }},
                lng: {{ Auth::user()->lng }}
		  },
          map: map2,
          draggable: true,
          animation: google.maps.Animation.DROP
        });
		marker.addListener('click', toggleBounce);
		marker.addListener('dragend', handleEvent);
				
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
            
            drawingManager.setOptions({
              drawingControl: false
            });

            var vertices = polygon.getPath();
            
            $(vertices.b).each(function(){
                var lat = this.lat();
                var lng = this.lng();

                $('#vertices').append('<input id="area" name="area[]" type="hidden" value="'+lat+';'+lng+'">');
            })

            console.log(vertices);

        });
		
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(centerControlDiv);

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
