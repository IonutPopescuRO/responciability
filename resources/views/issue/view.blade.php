@extends('layouts.app')

@section('title') {{$issue->title}} @endsection

@section('styles')
<style>
       #map, #map2 {
        height: 300px;
        width: 100%;
       }

       .ct-series-a .ct-slice-pie, .ct-series-a .ct-area {
          fill:#1d7d98;
       }

       .ct-series-b .ct-slice-pie, .ct-series-b .ct-area {
          fill:#fb404b;
       }

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">{{$issue->title}} 
                @auth

                
                @if(Auth::user()->id != $issue->creator->id) 
                <span class="pull-right">
                <a href="#" onclick="downvote();">
                	<i id="dislike-icon" style="color:#fb404b" class="fa @if($status=='liked' || $status=='neutral') fa-thumbs-o-down @else fa-thumbs-down @endif "></i>
                </a> <span id="downvotes-count">{{count($issue->downvotes())}}</span> &nbsp&nbsp 
                <a href="#" onclick="upvote()">
                	<i id="like-icon" style="color:#87cb16" class="fa @if($status=='disliked' || $status=='neutral') fa-thumbs-o-up @else fa-thumbs-up @endif"></i>
                </a> <span id="upvotes-count">{{count($issue->upvotes())}} </span>
                </span>
                @else
                <span class="pull-right">
                  <i id="dislike-icon" style="color:#fb404b" class="fa fa-thumbs-o-down"></i> 
                  <span id="downvotes-count">{{count($issue->downvotes())}}</span>
                  &nbsp&nbsp 
                  <i id="like-icon" style="color:#87cb16" class="fa fa-thumbs-o-up pull-right"></i>
                  <span id="upvotes-count">{{count($issue->upvotes())}}</span>
                  </span>
                @endif
                @endauth

                @guest
                	<span class="pull-right">
                	<i id="dislike-icon" style="color:#fb404b" class="fa fa-thumbs-o-down"></i> 
                	{{count($issue->downvotes())}}
                  &nbsp&nbsp 
                	<i id="like-icon" style="color:#87cb16" class="fa fa-thumbs-o-up pull-right"></i>
                	{{count($issue->upvotes())}}
                	</span>
                @endguest
                </h4>
            </div>
            <hr>
            <div class="content">

              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Status</label>
                          <p style="word-break: break-all;"> {{$issue->getStatus->name}} </p>
                      </div>
                  </div>
              </div>

            	<img class="img-responsive img-rounded" src="{{asset($issue->image)}}" />

                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <p style="word-break: break-all;"> {{$issue->description}} </p>
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

        @if(Auth::user()->isAdmin())
        <div class="card card-stats">
                  <div class="card-body ">
                    <center> Admin Actions </center> <br>
                    <center>
                      
                        <button class="btn btn-danger" onclick="archive()"> Archive </button><br><br>
                        <button class="btn btn-info" onclick="activate()"> Mark Active </button><br><br>
                        <button class="btn btn-success" onclick="mark()"> Mark Solved </button>
                      
                      </center>  
                  </div>
                  <div class="card-footer ">
                  </div>
        </div>
        @endif
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

        <div class="card card-user" id="stats">

            <center> Statistics </center>

            <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

            <center><div class="legend">
                <i class="fa fa-circle" style="color:#fb404b;"></i> Downvotes
                <i class="fa fa-circle" style="fill:#1d7d98;"></i> Upvotes
            </div></center>

        </div>

        
              <div class="card card-stats">
                  <div class="card-body ">
                      <div class="row">
                          <div class="col-md-5">
                              <div class="icon-big text-center icon-info">
                                  <i class="fa fa-comments text-info" aria-hidden="true"></i>
                              </div>
                          </div>
                          <div class="col-md-7">
                              <div class="numbers">
                                  <p class="card-category">Comments</p>
                                  <h4 class="card-title">{{count($issue->comments)}}</h4>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer ">
                      <hr>
                      <div class="stats">
                          <i class="fa fa-clock-o"></i> See what other users think about this issue.
                      </div>
                  </div>
              </div>
          
        
    </div>

</div>
<label for="exampleInputEmail1">Add comment</label>
<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            
            <input class="form-control" id="message" placeholder="Comment" type="text" name="message" required>
        </div>
    </div>
    <div class="col-md-1">
        <button class="btn btn-info" id="commentButton" > Add </button>
    </div>
</div>

<div class="row">
    <div class="col-md-8" id="comments-container">
        @foreach($issue->comments as $comment)
          <div class="btn btn-outline pull-left" style="width:100%;text-align:left;margin-bottom:3px;clear:left;white-space: normal;">
                  <div class="row"> 
                  <div class="col-md-1">
                  <img src="{{asset($comment->creator->avatar)}}" class="img-responsive img-circle" style="width:30px;height:auto;" /> 
                  </div>
                  <div class="col-md-11">
                  {{$comment->creator->name}} {{$comment->creator->lname}} : {{$comment->body}} 
                  </div>
                 </div>
                 </div><br>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('js/fancywebsocket.js')}}"> </script>

<script>
    var Server;

    function log( text ) {

      var arr = text.split('∆');
      
      var avatar = arr[0];
      var name = arr[1];
      var text2 = arr[2];

      var elem =  '<div class="btn btn-outline btn-wd" style="width:100%;text-align:left;margin-bottom:3px;white-space: normal;">'+
                  '<div class="row"> '+
                  '<div class="col-md-1">'+
                  '<img src="'+avatar+'" class="img-responsive img-circle" style="width:30px;height:auto;"/> '+
                  '</div><div class="col-md-11">'
                  +name+' : '+text2+
                 '</div></div>'+
                 '</div><br>';

      $('#comments-container').prepend(elem);
    }

    function saveComment(value,parsed)
    {   
        $.ajax({
        type: 'POST',
        url: "{{ route('comment',['id' => $issue->id]) }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {body:parsed},
            success: function(data)
            {   
                  log( value );
                  send( value );

                  $('#message').val('');
            },
            error: function (request, status, error) {
              alert(request.responseText);
          }

      });
    }

    function send( text ) {

      Server.send( 'message', text );
    }

    $(document).ready(function() {
      Server = new FancyWebSocket('ws://127.0.0.1:9300');

      $('#commentButton').click(function(e) {
          var value = $('#message').val();
          var parsed=value;
          value='{{asset(Auth::user()->avatar)}}∆{{Auth::user()->name}} {{Auth::user()->lname}}∆'+value;

          saveComment(value, parsed);
        
      });

      //Log any messages sent from server
      Server.bind('message', function( payload ) {
        log( payload );
      });

      Server.connect();
    });
  </script>

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
            '<img class="img-responsive" style="width: 100%;" src="{{asset($issue->image)}}" />'+
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

	function upvote()
		{	if(!$('#like-icon').hasClass('fa fa-thumbs-up '))
			$.ajax({
				type: 'POST',
				url: "{{ route('upvote',['id' => $issue->id]) }}" ,
				headers: {
	            	'X-CSRF-TOKEN': $('input[name="_token"]').val(),
	            	'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
	            	'Pragma': 'no-cache',
	            	'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
	        	},
	        	data: {a:1},
	        	processData: false,  // tell jQuery not to process the data
  				contentType: false,   // tell jQuery not to set contentType
  				cache:false,
	        	success: function(data)
	        	{

                     if(data.code == 200)
                     {	
                     	$('#like-icon').attr("class","fa fa-thumbs-up ");
                     	$('#dislike-icon').attr("class","fa fa-thumbs-o-down ");

                     	@if($status=='neutral')

                     	$current = Number($('#upvotes-count').html());
                     	$('#upvotes-count').html($current+1);

                     	@elseif($status=='disliked')

                     	$current = Number($('#upvotes-count').html());
                     	$('#upvotes-count').html($current+1);

                     	$current = Number($('#downvotes-count').html());
                     	$('#downvotes-count').html($current-1);

                     	@endif

                     }

	        	},
	        	error: function (request, status, error) {
			        alert(request.responseText);
			    }

			});

		}
	function downvote()
		{	
      if(!$('#dislike-icon').hasClass('fa fa-thumbs-down '))
			$.ajax({
				type: 'POST',
				url: "{{ route('downvote',['id' => $issue->id]) }}" ,
				headers: {
	            	'X-CSRF-TOKEN': $('input[name="_token"]').val(),
	            	'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
	            	'Pragma': 'no-cache',
	            	'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
	        	},
	        	data: {a:1},
	        	processData: false,  // tell jQuery not to process the data
  				contentType: false,   // tell jQuery not to set contentType
  				cache:false,
	        	success: function(data)
	        	{

                     if(data.code == 200)
                     {	
                     	$('#dislike-icon').attr("class","fa fa-thumbs-down ");
                     	$('#like-icon').attr("class","fa fa-thumbs-o-up ");

                     	@if($status=='neutral')

						$current = Number($('#downvotes-count').html());
						$('#downvotes-count').html($current+1);

						@elseif($status=='liked')

						$current = Number($('#downvotes-count').html());
						$('#downvotes-count').html($current+1);

						$current = Number($('#upvotes-count').html());
						$('#upvotes-count').html($current-1);

						@endif

                     }

	        	},
	        	error: function (request, status, error) {
			        alert(request.responseText);
			    }

			});

		}

    function chart()
    { 

      var likes = Number($('#upvotes-count').html());
      var dislikes = Number($('#downvotes-count').html())
      var total = likes+dislikes;
      var labels, series;

      if(dislikes == 0)
      {
        series=[likes];
        labels=['100%'];
      } else {
        series = [likes,dislikes];
        labels=[((likes/total)*100).toPrecision(2) +'%',((dislikes/total)*100).toPrecision(2)+'%'];
      }
      console.log(total);
      if(isNaN(total) || likes == 0)
      {   
          $('#chartPreferences').parent().hide();
          return;
      }
      var dataPreferences = {
            series: series
        };

        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false
            }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
          labels: labels,
          series: series
        });
    }

    $(document).ready(function(){

      chart();
    })

    function archive()
    {
        $.ajax({
        type: 'POST',
        url: "{{ route('archive',['id' => $issue->id]) }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {a:1},
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            cache:false,
            success: function(data)
            {

                     if(data.code == 200)
                     {
                        location.reload();
                     }
  
            },
            error: function (request, status, error) {
              alert(request.responseText);
          }

      });
    }

    function mark()
    {
        $.ajax({
        type: 'POST',
        url: "{{ route('mark',['id' => $issue->id]) }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {a:1},
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            cache:false,
            success: function(data)
            {

                     if(data.code == 200)
                     {
                        location.reload();
                     }
  
            },
            error: function (request, status, error) {
              alert(request.responseText);
          }

      });
    }

    function activate()
    {
        $.ajax({
        type: 'POST',
        url: "{{ route('activate',['id' => $issue->id]) }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {a:1},
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            cache:false,
            success: function(data)
            {

                     if(data.code == 200)
                     {
                        location.reload();
                     }
  
            },
            error: function (request, status, error) {
              alert(request.responseText);
          }

      });
    }

</script>

<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAApItPR-oxvnmOLsXyievDTiNuBM6jQ4s&libraries=drawing&callback=initMap" async defer>
</script>

@endsection
