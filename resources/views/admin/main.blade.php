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
						<a href="#">Orders</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Order Status</h3>
			<div class="row">
				<div class="col-md-12">
					@if ($order->count() > 0)
						{!! $order->withQueryString()->links() !!}
						<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>#</th>
								<th>
									Client
								</th>
								<th>
									Ticket
								</th>
								<th>
									Type
								</th>
								<th>
									Units
								</th>
								<th>
									Instrument
								</th>
								<th>
									Open Rate    
								</th>
								<th>
									Close Rate
								</th>
								<th>
									Profit/Loss
								</th>
								<th>Stop Profit</th>
								<th>Stop Loss</th>
								<th>Leverage</th>
								<th>Open Time</th>
								<th>Close Time</th>
								<th>
									Status
								</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
								@foreach($order as $order)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$order->client_name}}</td>
										<td>{{$order->ticket}}</td>
										<td>{{$order->type=="buy"?"BUY":"SELL"}}</td>
										<td>{{$order->trade_amount}}</td>
										<td>{{$order->base_symbol==""?$order->base_symbol:$order->base_symbol."/".$order->quote_symbol}}</td>
										<td>{{$order->open_rate}}</td>
										<td>{{$order->close_rate==0?'':$order->close_rate}}</td>
										<td>{{$order->pro_loss}}</td>
										<td>{{$order->profit}}</td>
										<td>{{$order->loss}}</td>
										<td>{{$order->leverage}}</td>
										<td>{{$order->open_time}}</td>
										<td>{{$order->close_time}}</td>
										<td>{{$order->status=="open"?"OPEN":"CLOSED"}}</td>
										<td>
											<a href="#myModal_autocomplete" role="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="showOpenRateModal('{{$order->ticket}}', '{{$order->open_rate}}', '{{$order->status}}')">Edit</a>
											<button class="btn btn-sm btn-danger" onclick="deleteOrder({{$order->ticket}})">Delete</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<p>No records found!</p>
					@endif
				</div>
			</div>
			<!-- END PAGE CONTENT -->
			
		</div>
	</div>
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
							<label class="col-sm-4 control-label">Open Rate</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon">
									<i class="fa fa-cogs"></i>
									</span>
									<input type="text" id="input_open_rate" name="" class="form-control"/>
									<input type="text" id="input_ticket" name="" class="form-control" style="display:none"/>
									<input type="text" id="order_status" name="" class="form-control" style="display:none"/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="updateOpenRate()"><i class="fa fa-check"></i> Save changes</button>
				</div>
			</div>
		</div>
	</div>
<!-- END CONTAINER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js"></script>
<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
@endsection