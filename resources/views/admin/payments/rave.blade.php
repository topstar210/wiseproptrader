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
                        <a href="#">Flutterwave</a>
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Flutterwave Gateway Settings</h3>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-8">
                    <div class="portlet box yellow-crusta">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Flutterwave Configuration
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
									<label class="col-sm-3 control-label">Real Payment Mode</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$rave_real_switch?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="rave_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Sandbox Payment mode</label>
									<div class="col-sm-4">
                                        <input type="checkbox" {{$rave_demo_switch?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="sandbox_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">RAVE PUBLIC KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="rave_public" name="typeahead_example_3" class="form-control" placeholder="{{ substr($public_key, 0, 5) . '*****'}}"/>
										</div>
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">RAVE SECRET KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="rave_secret" name="typeahead_example_3" class="form-control" placeholder="{{ substr($secret_key, 0, 5) . '*****'}}"/>
										</div>
									</div>
                                </div>
								
                                <div class="form-group">
									<label class="col-sm-3 control-label">Rave Flutterwave Payment Title</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="rave_env" name="typeahead_example_3" class="form-control" value="{{$environment}}"/>
										</div>
									</div>
								</div>
								
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateRave()"><i class="fa fa-check"></i>Save</button>
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
															<input type="text" id="typeahead_example_modal_1" name="typeahead_example_modal_1" class="form-control"/>
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
															<input type="text" id="typeahead_example_modal_2" name="typeahead_example_modal_2" class="form-control"/>
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
															<input type="text" id="typeahead_example_modal_3" name="typeahead_example_modal_3" class="form-control"/>
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
															<input type="text" id="typeahead_example_modal_4" name="typeahead_example_modal_4" class="form-control"/>
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