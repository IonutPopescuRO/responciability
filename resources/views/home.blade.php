@extends('layouts.app')

@section('title') Dashboard @endsection

@section('styles')
<style>
       #map, #map2 {
        height: 500px;
        width: 100%;
       }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="fa fa-map-marker text-warning" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Issues</p>
                            <h4 class="card-title">{{count(Auth::user()->issues)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Issues submitted by you.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-success">
                            <i class="fa fa-thumbs-o-up text-success" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Upvotes</p>
                            <h4 class="card-title">{{$upvotes}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Over all your issues.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-danger">
                            <i class="fa fa-thumbs-o-down text-danger" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Downvotes</p>
                            <h4 class="card-title">{{$downvotes}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Over all your issues.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-danger">
                            <i class="fa fa-heart text-danger" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Solved</p>
                            <h4 class="card-title">{{count($solved)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Thank you for contributing.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title"> Active issues in your area : </h4>
			</div>
			<div class="content">
				<div id="map"></div>
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

        var coords = [<?php foreach($user_area as $coordinates) print "{lat: ".$coordinates->lat.", lng: ".$coordinates->lng." },"; ?>];
        
        
        metros = new google.maps.Polygon(
        {
                paths: coords,
                fillColor: '#d9534f',
                fillOpacity: 0.5,
                strokeWeight: 2,
                clickable: false,
                editable: false,
                zIndex: 1
        });
        metros.setMap(map);
        
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


@endsection