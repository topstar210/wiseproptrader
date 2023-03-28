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
						<a href="#">PaymentSettings</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Paypal</a>
					</li>
				</ul>

			</div>

			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Paypal Gateway Settings</h3>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-8">
					<div class="portlet box yellow-crusta">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Paypal Configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$paypal_real_switch?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="paypal_real_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Live/Test</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$paypal_switch=="live"?'checked':''}} class="make-switch" data-on-text="&nbsp;Live&nbsp;&nbsp;" data-off-text="&nbsp;Test&nbsp;" id="paypal_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">CLIENT ID</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="client_id" name="typeahead_example_3" class="form-control" placeholder="{{ substr($client_id, 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">SECRET KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="secretKey" name="typeahead_example_3" class="form-control" placeholder="{{ substr($secretKey, 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updatePaypal()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>
							<div id="myModal_autocomplete" class="modal fade" role="dialog" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Radio Switch in Modal</h4>
										</div>
										<div class="modal-body form">
											<form action="#" class="form-horizontal form-row-seperated">
												<div class="form-group">
													<label class="col-sm-4 control-label">Basic Auto Complete</label>
													<div class="col-sm-8">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
															<input type="text" id="typeahead_example_modal_1" name="typeahead_example_modal_1" class="form-control" />
														</div>
														<p class="help-block">
															E.g: metronic, keenthemes.<br>
															<span class="label label-success label-sm">
																Learn more: </span>
															<a target="_blank" href="http://twitter.github.io/typeahead.js/">
																http://twitter.github.io/typeahead.js/ </a>
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Country Auto Complete</label>
													<div class="col-sm-8">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-search"></i>
															</span>
															<input type="text" id="typeahead_example_modal_2" name="typeahead_example_modal_2" class="form-control" />
														</div>
														<p class="help-block">
															E.g: USA, Malaysia. Prefetch from JSON source</code>
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Custom Template</label>
													<div class="col-sm-8">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-cogs"></i>
															</span>
															<input type="text" id="typeahead_example_modal_3" name="typeahead_example_modal_3" class="form-control" />
														</div>
														<p class="help-block">
															Uses a precompiled template to customize look of suggestion.</code>
														</p>
													</div>
												</div>
												<div class="form-group last">
													<label class="col-sm-4 control-label">Multiple Sections with Headers</label>
													<div class="col-sm-8">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-check"></i>
															</span>
															<input type="text" id="typeahead_example_modal_4" name="typeahead_example_modal_4" class="form-control" />
														</div>
														<p class="help-block">
															Two datasets that are prefetched, stored, and searched on the client. Highlighting is enabled.
														</p>
													</div>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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