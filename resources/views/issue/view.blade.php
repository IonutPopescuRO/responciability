@extends('layouts.app')

@section('title') {{$issue->title}} @endsection

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
                <h4 class="title">{{$issue->title}}</h4>
            </div>
            <div class="content">

            	<img class="img-responsive img-rounded" src="{{asset($issue->image)}}" />

                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <p> {{$issue->description}} </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Location</label>
                                <div id="map2"> </div>
                            </div>
                        </div>
                    </div>
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
                        <img class="avatar border-gray" src="{{ asset($issue->creator->avatar) }}" alt="...">

                        <h4 class="title">{{ $issue->creator->name }} {{ $issue->creator->lname }}<br>
                                         <small>{{ $issue->creator->email }}</small>
                                      </h4>
                    </a>
                </div>
				
				<hr>
                <p class="description text-center">
					Account created on {{ $issue->creator->created_at }}
                </p>
                <p class="description text-center">
					User submitted {{count($issue->creator->issues)}} issues so far.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>

	function initMap()
	{	
		// map 2
        var map2 = new google.maps.Map(document.getElementById('map2'), {
            zoom: 11,
            center: {
                lat: {{ $issue->lat }},
                lng: {{ $issue->lng }}
            }
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading">{{$issue->title}}</h4>'+
            '<div id="bodyContent">'+
            '<p>{{$issue->description}}</p>'+
            '<img class="img-responsive" src="{{asset($issue->image)}}" />'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

		var marker = new google.maps.Marker({
          position: {
                lat: {{ $issue->lat }},
                lng: {{ $issue->lng }}
		  },
          map: map2,
          draggable: false,
          clickable: true,
          animation: google.maps.Animation.BOUNCE
        });

        marker.addListener('click', function() {
          infowindow.open(map2, marker);
        });
	}

</script>

<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAApItPR-oxvnmOLsXyievDTiNuBM6jQ4s&libraries=drawing&callback=initMap" async defer>
</script>

@endsection
