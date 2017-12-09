@extends('layouts.app')

@section('title') Users Administration @endsection

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
        <div class="card">
            <div class="header">
                <h4 class="title">Users Administration</h4>
            </div>
            <div class="content">
				<div class="card-body table-full-width table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Issues count</th>
								<th>Profile</th>
							</tr>
						</thead>
						<tbody>
						
							<?php $i = ($users->currentpage()-1)* $users->perpage(); ?>
							@foreach ($users as $user)
							
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $user->name }} {{ $user->lname }} @if($user->accepted==0)(pending)@endif</td>
									<td>{{ $user->email }}</td>
									<td>{{count($user->issues)}}</td>
									<td>
										@if($user->accepted == 0)
										<a href="#" onclick="approve({{$user->id}});" class="btn btn-sm btn-success btn-outline">
											<span class="btn-label">
												<i class="fa fa-thumbs-up"></i>
											</span>
											Approve
										</button>
										@elseif($user->role != 2)
										<a href="{{ url('admin/user',['id' => $user->id]) }}" class="btn btn-sm btn-info btn-outline">
											<span class="btn-label">
												<i class="fa fa-eye"></i>
											</span>
											View profile
										</button> </a>
										<a href="#" onclick="ban({{$user->id}});" class="btn btn-sm btn-danger btn-outline">
											<span class="btn-label">
												<i class="fa fa-thumbs-down"></i>
											</span>
											Ban
										</button>
										@endif
									</td>
								</tr>
							
								
							@endforeach
						</tbody>
					</table>
				</div>
				{{ $users->links() }}
            </div>
        </div>
</div>

@endsection

@section('scripts')
<script>
function approve(uid)
    {	
        $.ajax({
        type: 'POST',
        url: "{{ route('approve') }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {uid: uid},
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

function ban(uid)
    {	
        $.ajax({
        type: 'POST',
        url: "{{ route('ban') }}" ,
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Cache-Control': ' no-store, no-cache, must-revalidate, post-check=0, pre-check=0"',
                'Pragma': 'no-cache',
                'Expires': 'Sat, 26 Jul 1997 05:00:00 GMT',
            },
            data: {uid: uid},
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
@endsection