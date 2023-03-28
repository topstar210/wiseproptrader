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
						<a href="#">Identify</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Identify Status</h3>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Identify
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
								<th>#</th>
								<th>
									 User Name
								</th>
								<th>
									 User Email
								</th>
								<th>
									 Submited Date
								</th>
								<th>
                                     Submited First Name
                               </th>
                               <th>
                                     Submited Last Name
                               </th>
                               <th>
									 Document Type
								</th>
								<th>
									Document
								</th>
                               <th>
                                    Action
                                </th>
							</tr>
							</thead>
							<tbody>
							@if(!empty($identify))
								@foreach($identify as $identify)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$identify->name}}</td>
									<td>{{$identify->email}}</td>
									<td>{{$identify->updated_at}}</td>
									<td>{{$identify->verify_name}}</td>
									<td>{{$identify->verify_surname}}</td>
									<td>{{$identify->verify_kind}}</td>
									<td><a class="btn green" onclick="showIdentify('{{$identify->verify_image}}')">Identify</a></td>
									<td>
										@if($identify->verify_approved == '')
										<a class="btn purple" onclick="identifyApprove('{{$identify->id}}')">Approve</a>
										<a class="btn red" onclick="identifyDecline('{{$identify->id}}')">Decline</a>
										@elseif($identify->verify_approved == 'Approved')
											Approved
										@else
											Declined
											
										@endif
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

<div id="identify_modal" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Identify Document</h4>
			</div>
			<div class="modal-body">
				<img style="width: 100%; height: 100%" alt="" src="" id="identify_image">
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection