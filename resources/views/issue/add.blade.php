@extends('layouts.app')

@section('title')
	Add Issue
@endsection

@section('styles')
<style>
       #map, #map2 {
        height: 300px;
        width: 100%;
       }
</style>
@endsection

@section('content')

<form method="POST" action="{{ route('createIssue') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<fieldset>
	    <div class="form-group">
	        <div class="row">
	            <label class="col-sm-2 control-label">Title</label>
	            <div class="col-sm-10">
	                <input type="text" class="form-control" name="title" value="{{old('title')}}">
	                <small class="form-text text-muted">A relevant title is important to attract people to upvote your issue.@if ($errors->has('title'))
                            <strong style="color:red">{{ $errors->first('title') }}</strong>
                    @endif</small>

	                

	            </div>
	        </div>
	    </div>
	</fieldset>

	<fieldset>
	    <div class="form-group">
	        <div class="row">
	            <label class="col-sm-2 control-label">Description</label>
	            <div class="col-sm-10">
	                <textarea cols="4" class="form-control" name="description"> {{old('description')}} </textarea>
	                <small class="form-text text-muted">Provide more details about your issue. Why is it important? What should be done?@if ($errors->has('description'))
                            <strong style="color:red">{{ $errors->first('description') }}</strong>
                    @endif</small>
	            </div>
	        </div>
	    </div>
	</fieldset>

	<fieldset>
	    <div class="form-group">
	        <div class="row">
	            <label class="col-sm-2 control-label">Location</label>
	            <div class="col-sm-10">
	                <div id="map2"></div>
	                <small class="form-text text-muted">Please drag the marker to the issue's location ( make sure to allow geofinding to center the map on your location )</small>
	            </div>
	        </div>
	    </div>
	</fieldset>

	<fieldset>
	    <div class="form-group">
	        <div class="row">
	            <label class="col-sm-2 control-label">Picture</label>
	            <div class="col-sm-10">
	                <input type="file" class="form-control" name="image">
	                <small class="form-text text-muted">Please provide a picture with strong evidence on the issue, preferably from the location you chose, regarding the issue.@if ($errors->has('image'))
                            <strong style="color:red">{{ $errors->first('image') }}</strong>
                    @endif</small>
	            </div>
	        </div>
	    </div>
	</fieldset>

	<input type="hidden" name="location" id="location" value="45.7489;21.2087" />

	<div class="row"> 
		<div class="col-md-4"> </div>
		<div class="col-md-4"><button type="submit" class="btn btn-primary" style="float:right">
        Create Issue
    </button></div>
	</div>
	

</form>
@endsection

@section('scripts')

<script>
    var map, infoWindow, marker;

    function initMap() {

        var map2 = new google.maps.Map(document.getElementById('map2'), {
            zoom: 13,
            center: {
                lat: 45.7489,
                lng: 21.2087
            }
        });

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map2.setCenter(pos);

                // place marker

                marker = new google.maps.Marker({
                    map: map2,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: pos
                });

                marker.addListener('click', toggleBounce);
                marker.addListener('dragend', handleEvent);

            }, function() {
                handleLocationError(true, infoWindow, map2.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map2.getCenter());
        }

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
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

@endsection