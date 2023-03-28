@extends('layouts.admin_layout')
@section('content')
<!-- BEGIN CONTAINER -->
<div class="page-container">
    @include('admin.layouts.sidebar')
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Users</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Clients</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Clients Status</h3>
			<div class="row">
				<div class="col-md-10">
						@include('admin.layouts.filters.users-clients-filter')
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					@if ($user->count() > 0)
						{!! $user->withQueryString()->links() !!}
						<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
								<tr>
									<th>No</th>
									<th>Email</th>
									<th>Name</th>
									<th>Plan Name</th>
									<th>Type</th>
									<th>Manager</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($user as $user)
								<?php $managerList = $manager_list; ?>
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$user->email}}</td>
									<td>{{$user->name}}</td>
									<td>{{ __($user->plan ? $user->plan->name : 'No Plan') }}</td>
									<td>
										<select class="form-control" name="" id="user_type_{{$user->id}}">
											<option {{$user->role ==3?'selected': ''}} value="3">Manager</option>
											<option {{$user->role ==5?'selected': ''}} value="5">User</option>
										</select>
									</td>
									<td>
										<select class="form-control" id="user_manager_{{$user->id}}">
											<option value=""></option>
											@foreach($managerList as $managerList)
												<option value="{{$managerList->id}}" {{$managerList->id == $user->manager_id?'selected': ''}}>{{$managerList->name}}</option>
											@endforeach
										</select>
									</td>
									<td>
										<button class="btn btn-info" onclick="saveClientchanges({{$user->id}})">Save Changes</button>
										<button class="btn btn-warning" onclick="showClientdetail({{$user->id}})">Detail</button>
										<button class="btn btn-danger" onclick="deleteClient({{$user->id}})">Delete</button>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						{{-- {!! $user->withQueryString()->links() !!} --}}
					@else
						<p>No records found!</p>
					@endif
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->
			
		</div>
	</div>
	<!-- END CONTENT -->

<!-- END CONTAINER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js"></script>
<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
@endsection