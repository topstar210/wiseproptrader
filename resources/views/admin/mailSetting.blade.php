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
						<a href="#">App Settings</a>
						<i class="fa fa-angle-right"></i>
				</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">App Settings</h3>
      <div class="row">
        <div class="col-12 px-1 pl-3">
          @include('admin.layouts.messages')
        </div>
      </div>

			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-12">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>General Settings
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal form-bordered" action="{{url('/super_manager/updateAppSettings')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-horizontal form-bordered">
									<div class="form-group">
										<label class="col-sm-2 control-label">Enable Maintenance Mode</label>
										<div class="col-sm-2">
											<input type="checkbox" {{isset($data['maintenance_switch']) && $data['maintenance_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="maintenance_switch" name="maintenance_switch">
										</div>
										<label class="col-sm-1 control-label">Message</label>
										<div class="col-sm-7">
											<input type="text" id="maintenance_message" name="maintenance_message" class="form-control" value="{{$data['maintenance_message']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">App Title</label>
										<div class="col-sm-6">
											<input type="text" id="app_title" name="app_title" class="form-control" value="{{$data['app_title']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">App Description</label>
										<div class="col-sm-6">
											<input type="text" id="app_description" name="app_description" class="form-control" value="{{$data['app_description']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><strong>Your Logo</strong><br>It's recommended to use a SVG logo </label>
										<div class="col-sm-6">
											@if(isset($app_settings['logo_path']) && $app_settings['logo_path'] != '')
												<img src="{{url('uploads', $app_settings['logo_path']??'')}}" style="height:70px!important;" class="img-thumbnail" alt="logo">
											@endif
											<span class="btn green fileinput-button"><i class="fa fa-plus"></i><span>Add files... </span>
												<input type="file" name="logo_path" multiple="" class="form-control">
											</span>
										</div>
									</div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i>Save</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Page Configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal form-bordered" action="{{url('/super_manager/updatePageSettings')}}" method="POST">
								@csrf
								<div class="form-horizontal form-bordered">
									<div class="form-group">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-6">
											<input type="text" id="contact_email" name="contact_email" class="form-control" value="{{$data['contact_email']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Phone</label>
										<div class="col-sm-6">
											<input type="text" id="contact_phone" name="contact_phone" class="form-control" value="{{$data['contact_phone']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Address</label>
										<div class="col-sm-6">
											<input type="text" id="contact_address" name="contact_address" class="form-control" value="{{$data['contact_address']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">License</label>
										<div class="col-sm-6">
											<input type="text" id="contact_license" name="contact_license" class="form-control" value="{{$data['contact_license']??''}}"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Privacy policy</label>
										<div class="col-sm-10">
											<textarea type="text" id="privacy_content" name="privacy_content" class="form-control" style="width:100%; height: 200px" value="">{{$data['privacy_content']??''}}</textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Terms of service</label>
										<div class="col-sm-10">
											<textarea type="text" id="policy_content" name="policy_content" class="form-control" style="width:100%; height: 200px" value="">{{$data['policy_content']??''}}</textarea>
										</div>
									</div>
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i>Save</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-12">
                    <div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Email Configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable SMTP</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['smtp_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="smtp_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">SMTP Port</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="smtp_port" name="typeahead_example_3" class="form-control" value="{{$data['smtp_port']}}"/>
										</div>
									</div>
									</div>
									<div class="form-group">
									<label class="col-sm-3 control-label">SMTP Security</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<select id="smtp_security" class="form-control" value="">
                                                <option value=""></option>
                                                <option {{$data['smtp_security']=='ssl'?'selected':''}} value="ssl">SSL</option>
                                                <option {{$data['smtp_security']=='tls'?'selected':''}} value="tls">TLS</option>
                                            </select>
										</div>
									</div>
                                </div>
																<div class="form-group">
																	<label class="col-sm-3 control-label">SMTP Host</label>
																	<div class="col-sm-4">
																		<div class="input-group">
																			<span class="input-group-addon">
																			<i class="fa fa-cogs"></i>
																			</span>
																			<input type="text" id="smtp_host" name="typeahead_example_3" class="form-control" value="{{$data['smtp_host']}}"/>
																		</div>
																	</div>
																								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">SMTP User</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="smtp_user" name="typeahead_example_3" class="form-control" value="{{$data['smtp_user']}}"/>
										</div>
									</div>
								</div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">SMTP Password</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="password" id="smtp_password" name="typeahead_example_3" class="form-control" value="{{$data['smtp_password']}}"/>
										</div>
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Email sender name</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="smtp_sender_name" name="typeahead_example_3" class="form-control" value="{{$data['smtp_sender_name']}}"/>
										</div>
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Send welcome mail</label>
									<div class="col-sm-4">
                                        <input type="checkbox" {{$data['smtp_subject_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="smtp_subject_switch">
									</div>
								</div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">Welcome mail subject</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="smtp_subject" name="typeahead_example_3" class="form-control" value="{{$data['smtp_subject']}}"/>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateEmailSetting()"><i class="fa fa-clheck"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
                            </div>
							
						</div>
                    </div>
				</div>
			</div>

			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-12">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Tamplates configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">New user account, welcome email</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="welcome_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['welcome_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('welcome')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
                            </div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Active user account</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="activeAccount_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px" >{{$data['activeAccount_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('activeAccount')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Admin withdraw request</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="adminEmail_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['adminEmail_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('adminEmail')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Confirm withdraw request</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="confirmWidthdraw_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['confirmWidthdraw_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('confirmWidthdraw')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Withdraw request processed</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="processWidthdraw_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['processWidthdraw_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('processWidthdraw')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">User reset password</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="resetPassword_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['resetPassword_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('resetPassword')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">User reset password done</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="resetPasswordDone_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['resetPasswordDone_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('resetPasswordDone')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Subscription expiration user</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="subscribeRequest_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px" >{{$data['subscribeRequest_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('subscribeRequest')"><i class="fa fa-clheck"></i>Save</button>
										</div>
									</div>
								</div>
							</div>
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">New login IP detected for a user</label>
									<div class="col-sm-9">
										<div class="input-group">
											<span class="input-group-addon">
											</span>
											<textarea type="text" id="unknownLogin_content" name="typeahead_example_3" class="form-control" style="width:100%; height: 200px">{{$data['unknownLogin_content']}}</textarea>
										</div>
									</div>
                                </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-11 col-md-1">
											<button type="submit" class="btn purple" onclick="updateTemplate('unknownLogin')"><i class="fa fa-clheck"></i>Save</button>
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