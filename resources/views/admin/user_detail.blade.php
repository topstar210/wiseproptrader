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
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Detail</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Client Detail</h3>
			<h3><div style="float:right; margin-right: 100px">Balance: 
			@foreach( $data['balance'] as $balance )
				{{ $balance->currency .':'. $balance->balance }}
			@endforeach
		</div></h3>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" action="#">
						<div class="portlet">
							<!-- <div class="portlet-title">
								<div class="caption">
									<i class="fa fa-shopping-cart"></i>Test Product
								</div>
								<div class="actions btn-set">
									<button type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> Back</button>
									<button class="btn default"><i class="fa fa-reply"></i> Reset</button>
									<button class="btn green"><i class="fa fa-check"></i> Save</button>
									<button class="btn green"><i class="fa fa-check-circle"></i> Save & Continue Edit</button>
									<div class="btn-group">
										<a class="btn yellow dropdown-toggle" href="javascript:;" data-toggle="dropdown">
										<i class="fa fa-share"></i> More <i class="fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:;">
												Duplicate </a>
											</li>
											<li>
												<a href="javascript:;">
												Delete </a>
											</li>
											<li class="divider">
											</li>
											<li>
												<a href="javascript:;">
												Print </a>
											</li>
										</ul>
									</div>
								</div>
							</div> -->
							<div class="portlet-body">
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#tab_profile" data-toggle="tab">
											Profile </a>
										</li>
										<li>
											<a href="#tab_balance" data-toggle="tab">
											Balance </a>
										</li>
										<li>
											<a href="#tab_payments" data-toggle="tab">
											Payments </a>
										</li>
										<li>
											<a href="#tab_withdraw" data-toggle="tab">
											Withdraw 
											</a>
										</li>
										<li>
											<a href="#tab_orders" data-toggle="tab">
											Orders </a>
										</li>
                                    </ul>
									<div class="tab-content no-space">
										<div class="tab-pane active" id="tab_profile">
											<div class="form-body">
												<div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Name: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['name']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Language: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <select class="table-group-action-input form-control input-medium" name="product[status]">
                                                                <option value="">Select...</option>
                                                                <option {{$data['lang']=='en-uk'?'selected':''}} value="en-uk">English (United Kingdom)</option>
                                                                <option {{$data['lang']=='en-us'?'selected':''}} value="en-us">English (United State)</option>
                                                            </select>
                                                        </div>
                                                    </div>
												</div>
												<div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Email: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['email']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Phone Number: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['phone']}}">
                                                        </div>
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Birthday: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['birth']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Country: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <select class="table-group-action-input form-control input-medium" name="product[status]">
                                                                <option >Select Your Country</option>
                                                                <option {{$data['country']=='au'?'selected':''}} value="au">Australia</option>
                                                                <option {{$data['country']=='other'?'selected':''}} value="other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">City: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['city']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Address: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['address']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="col-md-4 control-label">Zip or Postal Code: 
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" placeholder="" value="{{$data['zip']}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-edit"></i>Login History
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
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Date
                                                                    </th>
                                                                    <th>
                                                                        IP Address
                                                                    </th>
                                                                    <th>
                                                                        Device
                                                                    </th>
                                                                    <th>
                                                                        Location    
                                                                    </th>
                                                                    <th>
                                                                        Country
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                
                                                               
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>	
                                                
											</div>
										</div>
										<div class="tab-pane" id="tab_balance">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-2 control-label">Select Balance:</label>
													<div class="col-md-10" >
														<select class="table-group-action-input form-control input-medium" id="fundCurrency">
                                                            <option value="USD">USD</option>
                                                            <option value="EUR">EUR</option>
                                                        </select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Modification Type:</label>
													<div class="col-md-10" >
														<select class="table-group-action-input form-control input-medium" id="fundType">
                                                            <option value="add">Add</option>
                                                            <option value="remove">Remove</option>
                                                        </select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Modification value:</label>
													<div class="col-md-8">
														<input type="text" class="form-control" placeholder="" value="" id="fundAmount">
													</div>
                                                </div>
                                                <div class="form-group">
													<div class="col-md-8">
														
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn green" onclick="addFunds({{$data['user_id']}})">Apply Changes</button>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_payments">
											<div class="form-group">
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
																<th>
																	No
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
																	Currency    
																</th>
																<th>
																	Payment mode
																</th>
																<th>
																	Action
																</th>
															</tr>
															</thead>
															<tbody>
																@foreach($data['payments'] as $payments)
																<tr>
																	<td>{{$loop->index+1}}</td>
																	<td>{{$payments->created_at}}</td>
																	<td>Approved</td>
																	<td>{{$payments->amount}}</td>
																	<td>{{$payments->currency}}</td>
																	<td>{{$payments->mode}}</td>
																	<td><button class="btn btn-sm red"><i class="fa fa-times"></i> Cancel</button></td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_withdraw">
											<div class="form-group">
												<div class="portlet box blue">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-edit"></i>Withdraw History
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
																	No
																</th>
																<th>
																	Created date
																</th>
																<th>
																	Status
																</th>
																<th>
																	Amount 
																</th>
																<th>
																	Currency    
																</th>
																<th>
																	Payment gateway
																</th>
																
															</tr>
															</thead>
															<tbody>
																
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_orders">
											<div class="form-group">
												<div class="portlet box blue">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-edit"></i>Orders
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
																@foreach($data['orders'] as $order)
																<tr>
																	<td>{{$loop->index+1}}</td>
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
																	<td><a href="#myModal_autocomplete" role="button" class="btn blue" data-toggle="modal" onclick="showOpenRateModal('{{$order->ticket}}', '{{$order->open_rate}}')">Edit</a></td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END PAGE CONTENT -->
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