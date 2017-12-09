@extends ('layouts.app')

@section('title') View Issues @endsection

@section('content')

@if(count($issues)==0)
	<h3> Sorry, you don't have any issues submitted yet... Why not <a href="{{route('issueForm')}}"> create </a> one?</h3>
@else
<div class="row">
	<div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Your issues</h4>
                <p class="category">These are all the issues submitted by you, click on one's title to view more details!</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                    	<th>Title</th>
                    	<th>Description</th>
                    	<th>Location</th>
                    </thead>
                    <tbody>
                        @foreach($issues as $issue)
                        	
                        	<tr>
                        		<td> {{$loop->iteration}} </td>
                        		<td> <a href="{{ route('viewIssue', ['id' => $issue->id]) }}">{{$issue->title}}</a> </td>
                        		<td> {{ str_limit($issue->description,30, '...') }}</td>
                        		<td> Timisoara, Romania </td>
                        	</tr>
                        	
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endif

@endsection