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
						<a href="#">Admin</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
                        <a href="#">Identify Settings</a>
                    </li>
                   
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Client Detail</h3>
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
											<a href="#tab_forex" data-toggle="tab">
											FOREX </a>
										</li>
                                        <li>
                                            <a href="#tab_crypto" data-toggle="tab">
                                            CRYPTO </a>
                                        </li>
										<li>
											<a href="#tab_stocks" data-toggle="tab">
											STOCKS 
											</a>
										</li>
                                    </ul>
									<div class="tab-content no-space">
										<div class="tab-pane active" id="tab_forex">
											<div class="form-body">
                                                <div class="form-group">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-edit"></i>
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
                                                            <table class="table table-striped table-hover table-bordered" id="sample_1">
                                                                <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        INSTRUMENTS
                                                                    </th>
                                                                    <th>
                                                                        CATEGORY
                                                                    </th>
                                                                    <th>
                                                                        LEVERAGE
                                                                    </th>
                                                                    <th>
                                                                        ACTION    
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($forex as $forex)
                                                                <tr>
                                                                    <td>{{$loop->index+1}}</td>
                                                                    <td>{{$forex->name_forex_instruments}}</td>
                                                                    <td>{{$forex->category}}</td>
                                                                    <td>{{$forex->leverage}}</td>
                                                                    <td><a href="#myModal_autocomplete" role="button" class="btn blue" data-toggle="modal" onclick="updateForexLeverage('{{$forex->id}}', '{{$forex->leverage}}')">Edit</a></td>
                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>	
                                                
											</div>
										</div>
										<div class="tab-pane" id="tab_crypto">
											<div class="form-body">
                                                <div class="form-group">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-edit"></i>
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
                                                            <table class="table table-striped table-hover table-bordered" id="sample_2">
                                                                <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Instruments
                                                                    </th>
                                                                    <th>
                                                                        CATEGORY
                                                                    </th>
                                                                    <th>
                                                                        LEVERAGE
                                                                    </th>
                                                                    <th>
                                                                        ACTION    
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($crypto as $crypto)
                                                                <tr>
                                                                    <td>{{$loop->index+1}}</td>
                                                                    <td>{{$crypto->name}}</td>
                                                                    <td>{{$crypto->category}}</td>
                                                                    <td>{{$crypto->leverage}}</td>
                                                                    <td><a href="#myModal_autocomplete" role="button" class="btn blue" data-toggle="modal" onclick="updateCryptoLeverage('{{$crypto->id}}', '{{$crypto->leverage}}')">Edit</a></td>
                                                                </tr>
                                                                @endforeach
                                                               
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>	
                                                
											</div>
                                        </div>
                                        <div class="tab-pane" id="tab_stock">
											<div class="form-body">
                                                <div class="form-group">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="fa fa-edit"></i>
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
                                                            <table class="table table-striped table-hover table-bordered" id="sample_3">
                                                                <thead>
                                                                <tr>
                                                                    <th>
                                                                        No
                                                                    </th>
                                                                    <th>
                                                                        Instruments
                                                                    </th>
                                                                    <th>
                                                                        CATEGORY
                                                                    </th>
                                                                    <th>
                                                                        LEVERAGE
                                                                    </th>
                                                                    <th>
                                                                        ACTION    
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
									</div>
								</div>
							</div>
						</div>
					</form>
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
									<input type="text" id="input_leverage" name="" class="form-control"/>
									<input type="text" id="input_id" name="" class="form-control" style="display:none"/>
									<input type="text" id="input_kind" name="" class="form-control" style="display:none"/>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="updateLeverage()"><i class="fa fa-check"></i> Save changes</button>
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