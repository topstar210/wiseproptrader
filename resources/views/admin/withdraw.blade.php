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
						<a href="#">Withdraw</a>
					</li>
				</ul>

			</div>

			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Withdraw Status</h3>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Withdraw
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
										<th> Date </th>
										<th> Name </th>
										<th> Email </th>
										<th> Bank Number </th>
										<th> Swift Code </th>
										<th> Amount </th>
										<th> Email Status </th>
										<th> Confirmed </th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($withdraw))
										@foreach($withdraw as $withdraw)
										@php
											if ($withdraw->status == 'Approved') {
												$withdraw_color = 'success';
											} else if ($withdraw->status == 'Declined'){
												$withdraw_color = 'danger';
											} else {
												$withdraw_color = 'info';
											}
										@endphp
										<tr>
											<td>{{$withdraw->created_at}}</td>
											<td>{{$withdraw->user_name}}</td>
											<td>{{$withdraw->email}}</td>
											<td>{{$withdraw->bank}}</td>
											<td>{{$withdraw->swift}}</td>
											<td>{{$withdraw->amount}}</td>
											<td>{{$withdraw->confirm_id_status}}</td>
											<td>
												@if($withdraw->status=='Pending')
													<span class="withdrawAction_{{$withdraw->id}}"><button class='btn btn-sm btn-success' onclick='approveWithdraw({{$withdraw->id}})'>Approve</button></span>
													<span class="withdrawActionDecline_{{$withdraw->id}}"><button class='btn btn-sm btn-danger' onclick='declineWithdraw({{$withdraw->id}})'>Decline</button></span>
												@else
													<span class="badge badge-{{$withdraw_color}}">{{$withdraw->status}}</span>
												@endif
													<span><button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#withrawDetails{{$withdraw->id}}">Details</button></span>
													<div class="modal fade" id="withrawDetails{{$withdraw->id}}" tabindex="-1" role="dialog">
														<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">{{$withdraw->user_name}} requested withdraw</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																</div>
																<div class="modal-body">
																	<div class="row form-group">
																		<div class="col-md-6">Client Name: <strong>{{$withdraw->user_name}}</strong></div>
																		<div class="col-md-6">Client Email: <strong>{{$withdraw->email}}</strong></div>
																	</div>
																	<div class="row form-group">
																		<div class="col-md-6">Bank Account Number: <strong>{{$withdraw->bank}}</strong></div>
																		<div class="col-md-6">Bank Account Address: <strong>{{$withdraw->bank_addr}}</strong></div>
																	</div>
																	<div class="row form-group">
																		<div class="col-md-6">Bank swift code: <strong>{{$withdraw->swift}}</strong></div>
																		<div class="col-md-6">Amount requested: <strong>{{$withdraw->amount}}</strong></div>
																	</div>
																	<div class="row form-group">
																		<div class="col-md-6">Country: <strong>{{$withdraw->country}}</strong></div>
																		<div class="col-md-6">Date Created: <strong>{{$withdraw->created_at}}</strong></div>
																	</div>
																	@if($withdraw->status=='Declined')
																		<div class="row form-group">
																			<div class="col-md-12">Decline Reason: <strong>{{$withdraw->decline_reason}}</strong></div>
																		</div>
																	@endif
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
																	@if($withdraw->status=='Pending')
																		<span class="withdrawAction_{{$withdraw->id}}"><button class='btn btn-sm btn-success' onclick='approveWithdraw({{$withdraw->id}})'>Approve</button></span>
																		<span class="withdrawActionDecline_{{$withdraw->id}}"><button class='btn btn-sm btn-danger' onclick='declineWithdraw({{$withdraw->id}})'>Decline</button></span>
																	@endif
																</div>
															</div>
														</div>
													</div>
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
	<!-- END CONTENT -->

	<!-- END CONTAINER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js"></script>
<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	@endsection