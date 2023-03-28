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
                        <a href="#">{{ __('admin') }}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">PaymentSettings</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Bank Transfer</a>
                    </li>
                </ul>

            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Manual Gateway Settings</h3>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-8">
                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>{{$name}} Configuration
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
										<input type="checkbox" {{$real_switch?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="real_switch">
									</div>
								</div>
                                <input type="hidden" id="name" name="typeahead_example_3" class="form-control" value="{{$name}}"/>
                                <input type="hidden" id="par2" name="typeahead_example_3" class="form-control" value="crypto"/>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Hash Address</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-cogs"></i>
                                            </span>
                                            <input type="text" id="par1" name="typeahead_example_3" class="form-control" value="{{$par1}}"/>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn purple" onclick="updateBankTransferSetting()"><i class="fa fa-check"></i>Save</button>
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
    @endsection