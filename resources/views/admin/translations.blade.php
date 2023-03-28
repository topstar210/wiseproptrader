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
						<a href="#">Translations</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
						<div style="display:flex; justify-content:space-between;align-items:center; margin-bottom: 10px;">
							<h3 class="page-title">Translations Manager</h3>
							<button type="button" class="btn blue" data-toggle="modal" data-target="#addModal">
								Add New
							</button>
							<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<form action="/admin/translations/addLang" method="post">
											@csrf
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add New Language</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="id" class="form-control" value="en">
											<input type="text" required name="key" class="form-control" value="" placeholder="Language Name">
											<br>
											<input type="text" required name="code" class="form-control" value="" placeholder="Language Code">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
									</form>
									</div>
								</div>
							</div>
						</div>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Language List
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
									 Name
								</th>
								<th>
									 Code
								</th>
								<th>
                                    Action
                                </th>
							</tr>
							</thead>
							<tbody>
							@if(!empty($locales))
								@foreach($locales as $key => $val)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td style="">{{$key}}</td>
									<td style="text-transform: uppercase;">{{$val}}</td>
									<td style="width: 10%;"><a href="/admin/translations/{{$val}}" role="button" class="btn blue" data-toggle="modal" onclick="">Edit</a>
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