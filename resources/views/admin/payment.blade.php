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
						<a href="#">Payments</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Payments Status</h3>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Payments
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
									 User
								</th>
								<th>
									 Created date
								</th>
								<th>
									 Status
								</th>
								<th>
									 Amount paid
								</th>
								<th>
									 Fees
                                </th>
                                <th>
                                    Wallet Received
                               </th>
                               <th>
									 Amount Received
                                </th>
                                <th>
                                    Payment Gateway
                               </th>
                               
							</tr>
							</thead>
							<tbody>
								@if(!empty($payment))
								@foreach($payment as $payment)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$payment->name}}</td>
									<td>{{$payment->created_at}}</td>
									<td>Approved</td>
									<td>{{$payment->amount}}</td>
									<td>0.00</td>
									<td>{{$payment->amount}}</td>
									<td>{{$payment->amount}}</td>
									<td>{{$payment->mode}}</td>
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