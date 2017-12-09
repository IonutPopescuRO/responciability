@extends('layouts.app')

@section('title') Admin Stats @endsection

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
    <a href="{{ url('admin/users') }}">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="fa fa-life-ring text-warning" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Issues</p>
                            <h4 class="card-title">{{count($issues)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Issues submitted. (Total to solved ratio : {{$ttsr}})
                </div>
            </div>
        </div>
    </a>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-success">
                            <i class="fa fa-check-square-o text-success" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Solved</p>
                            <h4 class="card-title">{{count($solvedIssues)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Out of {{count($issues)}}
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
                            <i class="fa fa-archive text-danger" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Archived</p>
                            <h4 class="card-title">{{count($archivedIssues)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Out of {{count($issues)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-info">
                            <i class="fa fa-arrow-circle-up text-info" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Active</p>
                            <h4 class="card-title">{{count($issues)-count($archivedIssues)-count($solvedIssues)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Still in progress.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
    <a href="{{ url('admin/users') }}">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-warning">
                            <i class="fa fa-user text-warning" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Users</p>
                            <h4 class="card-title">{{count($users)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Registered users.
                </div>
            </div>
        </div>
    </a>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-success">
                            <i class="fa fa-minus-square text-success" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Votes</p>
                            <h4 class="card-title">{{count($votes)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Since the very first issue.
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
                            <i class="fa fa-bar-chart text-danger" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Votes/user</p>
                            <h4 class="card-title">{{$lpu}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Mean average.
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-5">
                        <div class="icon-big text-center icon-info">
                            <i class="fa fa-group text-info" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="numbers">
                            <p class="card-category">Last month	</p>
                            <h4 class="card-title">{{count($lastmonth)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Registered users.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
		<div class="card">
			<div class="header">
				<h4 class="title"> Map 

				<span class="pull-right">
				<button class="btn btn-info" onclick="viewAll()"> All </button>
				<button class="btn btn-danger" onclick="viewSolved()"> Solved </button>
                <button class="btn btn-danger" onclick="viewActive()"> Active </button>
                <button class="btn btn-danger" onclick="viewArchived()"> Archived </button>
                </span>

				</h4>
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
    var map, infoWindow, marker, archivedMarkers=[], activeMarkers=[], solvedMarkers=[];

    function initMap() {
        
        var iniLat, iniLng;
        iniLat = {{ Auth::user()->lat }};
        iniLng = {{ Auth::user()->lng }};
        
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: iniLat,
                lng: iniLng
            },
            zoom: 8
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

            @if($issue->status==1)
            	archivedMarkers.push(marker{{$loop->iteration}});
            @elseif($issue->status==2)
            	activeMarkers.push(marker{{$loop->iteration}});
            @else 
            		solvedMarkers.push(marker{{$loop->iteration}});
            @endif

            marker{{$loop->iteration}}.addListener('click', function() {
              infowindow.close(); // Close previously opened infowindow
              infowindow.setContent(contentString{{$loop->iteration}});
              infowindow.open(map, marker{{$loop->iteration}});
            });

        @endforeach

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

    // Sets the map on all markers in the array.
      function setMapOnAll(map, filters=[1,1,1]) {
      	if(filters[0]==1)
	        for (var i = 0; i < archivedMarkers.length; i++) {
	          archivedMarkers[i].setMap(map);
	        }

	    if(filters[1]==1)
	        for (var i = 0; i < activeMarkers.length; i++) {
	          activeMarkers[i].setMap(map);
	        }
	    if(filters[2]==1)
	        for (var i = 0; i < solvedMarkers.length; i++) {
	          solvedMarkers[i].setMap(map);
	        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      function viewArchived()
      {
      	clearMarkers();
      	setMapOnAll(map, [1,0,0] );
      }

      function viewSolved()
      {
      	clearMarkers();
      	setMapOnAll(map, [0,0,1] );
      }

      function viewActive()
      {
      	clearMarkers();
      	setMapOnAll(map, [0,1,0] );
      }

      function viewAll()
      {
      	clearMarkers();
      	setMapOnAll(map, [1,1,1]);
      }

</script>

<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAApItPR-oxvnmOLsXyievDTiNuBM6jQ4s&libraries=drawing&callback=initMap" async defer>
</script>


@endsection