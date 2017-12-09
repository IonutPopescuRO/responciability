@extends('layouts.app')

@section('title') Issues Administration @endsection

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
                <h4 class="title">Issues Administration</h4>
            </div>
            <div class="content">
				<div class="card-body table-full-width table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Description</th>
								<th>Created at</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody>
						
							<?php $i = ($issues->currentpage()-1)* $issues->perpage(); ?>
							@foreach ($issues as $issue)
								<?php
									if(strlen($issue->description)>60)
										$issue->description = substr($issue->description, 0, 60).'...';
									
								?>
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $issue->title }}</td>
									<td>{{ $issue->description }}</td>
									<td>{{ $issue->created_at }}</td>
									<td><span data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $issue->lat .' '. $issue->lng }}">{{$issue->address}}</span></td>
									<td>
										<a href="{{route('viewIssue', ['id' => $issue->id])}}">
										<button type="button" class="btn btn-sm btn-info btn-outline">
											<span class="btn-label">
												<i class="fa fa-eye"></i>
											</span>
											View issue
										</button>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{ $issues->links() }}
            </div>
        </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>
@endsection
