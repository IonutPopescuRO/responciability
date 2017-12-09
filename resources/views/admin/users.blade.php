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
									<td>{{ $user->name }} {{ $user->lname }}</td>
									<td>{{ $user->email }}</td>
									<td>{{count($user->issues)}}</td>
									<td>
										<a href="{{ url('admin/user',['id' => $user->id]) }}" class="btn btn-sm btn-info btn-outline">
											<span class="btn-label">
												<i class="fa fa-eye"></i>
											</span>
											View profile
										</button>
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