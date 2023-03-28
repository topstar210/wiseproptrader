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
						<a href="#">Manager</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">MyClients</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">My Clients</h3>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Client List
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>
									 #
								</th>
								<th>
									 Email
								</th>
								<th>
									 Name
								</th>
								<th>
									 Created Date
								</th>
								<th>
									 Updated Date
								</th>
								<th>
                                    Action
                                </th>
							</tr>
							</thead>
							<tbody>
							@if(!empty($clients))
								@foreach($clients as $clients)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$clients->email}}</td>
									<td>{{$clients->name}}</td>
									<td>{{$clients->created_at}}</td>
									<td>{{$clients->updated_at}}</td>
									<td><a href="#myModal_autocomplete" role="button" class="btn blue" data-toggle="modal" onclick="changePassword('{{$clients->user_id}}')">Change Password</a><button class="btn btn-warning" onclick="showClientdetail({{$clients->user_id}})">Detail</button>

										@canBeImpersonated($clients)
											<a class="btn btn-danger" href="{{ route('impersonate', $clients->user_id) }}" data-toggle="tooltip" tooltip-icon="false" data-placement="top" title="Login as {{$clients->name}}">Log in as {{$clients->name}} <i class="bi bi-box-arrow-in-right"></i></a>
										@endCanBeImpersonated
									</td>

								</tr>
								@endforeach
							@endif
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->
			
		</div>
	</div>

	<form method="POST" action="{{ route('login') }}" id="login_form" style="display: none;">
    @csrf
		<input id="email" name="email" style="display: none;">
		<input id="password" name="password" style="display: none;" >
	</form>


	<!-- END CONTENT -->
	<div id="myModal_autocomplete" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Change Open Rate</h4>
				</div>
				<div class="modal-body form">
					<div action="#" class="form-horizontal form-row-seperated">
						<div class="form-group">
							<label class="col-sm-4 control-label">New Password</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-cogs"></i>
									</span>
									<input type="password" id="new_pword" name="" class="form-control"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Confirm Password</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-cogs"></i>
									</span>
									<input type="password" id="confirm_pword" name="" class="form-control"/>
									<input type="text" id="user_id" name="" class="form-control" style="display:none">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="confirmPassword()"><i class="fa fa-check"></i> Save changes</button>
				</div>
			</div>
		</div>
	</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js"></script>
<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
@endsection