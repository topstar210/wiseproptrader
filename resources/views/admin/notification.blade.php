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
						<a href="#">Notification</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Notifications</h3>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Notifications
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
									 Received at
								</th>
								<th>
									 From
								</th>
								<th>
									 Content
                                </th>
                               <th>
                                    Action
                                </th>
							</tr>
							</thead>
							<tbody>
							
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