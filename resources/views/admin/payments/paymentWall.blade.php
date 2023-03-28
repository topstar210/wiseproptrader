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
                        <a href="#">Paymentwall</a>
                    </li>
                </ul>

            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Paymentwall Gateway Settings</h3>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-8">
                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Paymentwall Configuration
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
										<input type="checkbox" {{$paymentwall_real_switch?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="paymentwall_real_switch">
									</div>
								</div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">PUBLIC KEY</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-cogs"></i>
                                            </span>
                                            <input type="text" id="publicKey" name="typeahead_example_3" class="form-control" placeholder="{{ substr($publicKey, 0, 5) . '*****'}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">PRIVATE KEY</label>
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
                                            <button type="submit" class="btn purple" onclick="updatePaymentWallSetting()"><i class="fa fa-check"></i>Save</button>
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