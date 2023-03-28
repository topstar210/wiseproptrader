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
                        <a href="#">IdentifySettings</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Identify Settings</h3>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-8">
                    <div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Identify Configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
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
									<label class="col-sm-3 control-label">Enable Identify System</label>
									<div class="col-sm-4">
                                        <input type="checkbox" class="make-switch" {{$data['enable_verify']=='on'?'checked':''}} data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="enable_verify">
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Block trading without identity verification</label>
									<div class="col-sm-4">
                                        <input type="checkbox" class="make-switch" {{$data['enable_trading']=='on'?'checked':''}} data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="enable_trading">
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Block deposit without identity verification</label>
									<div class="col-sm-4">
                                        <input type="checkbox" class="make-switch" {{$data['enable_deposit']=='on'?'checked':''}} data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="enable_deposit">
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Block withdraw without identity verification</label>
									<div class="col-sm-4">
                                        <input type="checkbox" class="make-switch" {{$data['enable_withdraw']=='on'?'checked':''}} data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="enable_withdraw">
									</div>
                                </div>
                                
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateVerifySetting()"><i class="fa fa-clheck"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
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