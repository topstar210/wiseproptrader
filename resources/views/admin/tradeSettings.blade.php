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
			            <a href="#">TradingSettings</a>
			            <i class="fa fa-angle-right"></i>
			        </li>
			    </ul>

			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Trading Settings</h3>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-8">

					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>StopOut Setting
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">StopOut Level(%)</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="stopout" name="typeahead_example_3" class="form-control" value="{{$data['stopout']}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateStopout()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
              </div>

						</div>
					</div>

					<div class="portlet box yellow-crusta">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Forex Configuration
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
									<label class="col-sm-3 control-label">FOREX TRADING</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['forex_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="forex_switch">
									</div>
								</div>

								<hr>
								<h4 style="padding-left: 25%;">Primary Forex Api</h4>
								<div class="form-group">
									<label class="col-sm-3 control-label">Oanda Api Key</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-key"></i>
											</span>
											<input type="text" id="oanda_api_key" class="form-control" placeholder="{{ substr($data['oanda_api_key'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Oanda Account Number</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-user-secret"></i>
											</span>
											<input type="text" id="oanda_account_number" class="form-control" value="{{$data['oanda_account_number'] ?? ''}}"/>
										</div>
									</div>
								</div>
								<hr>
								<h4 style="padding-left: 25%;">Sidebar Forex Api</h4>
								<div class="form-group">
									<label class="col-sm-3 control-label">Oanda Api Key</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-key"></i>
											</span>
											<input type="text" id="oanda2_api_key" class="form-control" placeholder="{{ substr($data['oanda2_api_key'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Oanda Account Number</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-user-secret"></i>
											</span>
											<input type="text" id="oanda2_account_number" class="form-control" value="{{$data['oanda2_account_number'] ?? ''}}"/>
										</div>
									</div>
								</div>

								<hr>
								<h4 style="padding-left: 25%;">Secondary Forex Api</h4>
								<div class="form-group">
									<label class="col-sm-3 control-label">FOREX API URL</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-link"></i>
											</span>
											<input type="text" id="forex_api" name="typeahead_example_3" class="form-control" value="{{$data['forex_api']}}"/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">FOREX API KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-key"></i>
											</span>
											<input type="text" id="forex_account" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['forex_account'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>

								<hr>
								<h4 style="padding-left: 25%;">Forex Lots</h4>
								<div class="form-group">
									<label class="col-sm-3 control-label">Forex Lots</label>
									<div class="col-sm-4">
										<input type="checkbox" {{(isset($data['forexLotsSwitch']) && $data['forexLotsSwitch']=='on')?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="forexLotsSwitch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Lots List</label>
									<div class="col-md-8">
										<div class="input-group">
											<input type="text" id="forexLotsList" class="form-control" value="{{$data['forexLotsList'] ?? ''}}" placeholder="5;50;150;500;1000;5000"/>
											<p class="help-block">Enter Lots separated by semicolon ; For exemple : 5;50;150;500;1000;5000</p>
										</div>
									</div>
								</div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateForexAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="portlet box red-sunglo">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>IG.COM Configuration
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
							<div id="form-ig-config" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable IG.com Api</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['ig_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="ig_switch">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable Crypto on IG.com</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['ig_switch_crypto']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="ig_switch_crypto">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">IG.COM API KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="ig_api_key" class="form-control" placeholder="{{ substr($data['ig_api_key'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">IG.COM USERNAME</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="ig_username" class="form-control" value="{{$data['ig_username']}}"/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">IG.COM PASSWORD</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="ig_password" class="form-control" placeholder="{{ substr($data['ig_password'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateIgAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Crypto Configuration
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
									<label class="col-sm-3 control-label">CRYPTO TRADING</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['crypto_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="crypto_switch">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">CRYPTO API KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="crypto_api" name="typeahead_example_3" class="form-control" value="{{$data['crypto_api']}}"/>
										</div>
									</div>
                                </div>
                                <div class="form-group">
									<label class="col-sm-3 control-label">CRYPTO ACCOUNT</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="crypto_account" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['crypto_account'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateCryptoAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
              </div>

						</div>
					</div>

					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Stock Configuration
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
									<label class="col-sm-3 control-label">STOCK TRADING</label>
									<div class="col-sm-4">
										<input type="checkbox" class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="rave_switch">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">STCOK API KEY</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="rave_public" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['rave_public'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>
                <div class="form-group">
									<label class="col-sm-3 control-label">STOCK API ACCOUNT</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="rave_secret" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['rave_secret'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateStockAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
              </div>

						</div>
					</div>

					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Cryptocompare Configuration
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
							<div id="form-cryptocompare" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable Conversion</label>
									<div class="col-sm-4">
										<input type="checkbox" {{$data['cryptocompare_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="cryptocompare_switch">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Cryptocompare Api Key</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input type="text" id="cryptocompare_api_key" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['cryptocompare_api_key'], 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateCryptocompareAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
              </div>

						</div>
					</div>

					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>fixer.io Configuration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div id="form-fixerio" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable Conversion</label>
									<div class="col-sm-4">
										<input type="checkbox" {{isset($data['fixerio_switch']) && $data['fixerio_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="fixerio_switch">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">fixer.io Api Key</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input type="text" id="fixerio_api_key" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['fixerio_api_key']??'', 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateFixerioAPI()"><i class="fa fa-check"></i>Save</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
              </div>

						</div>
					</div>

					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Binance Configuration
							</div>
							<div class="tools"><a href="javascript:;" class="collapse"></a></div>
						</div>
						<div class="portlet-body form">
							<div id="form-username" class="form-horizontal form-bordered">
								<div class="form-group">
									<label class="col-sm-3 control-label">Enable Binance</label>
									<div class="col-sm-4">
										<input type="checkbox" {{isset($data['binance_switch']) && $data['binance_switch']=='on'?'checked':''}} class="make-switch" data-on-text="&nbsp;Enabled&nbsp;&nbsp;" data-off-text="&nbsp;Disabled&nbsp;" id="binance_switch">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Binance Api Key</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="binance_api_key" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['binance_api_key'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Binance Secret</label>
									<div class="col-sm-4">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-cogs"></i>
											</span>
											<input type="text" id="binance_secret" name="typeahead_example_3" class="form-control" placeholder="{{ substr($data['binance_secret'] ?? '', 0, 5) . '*****'}}"/>
										</div>
									</div>
                </div>

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn purple" onclick="updateBinanceAPI()"><i class="fa fa-check"></i>Save</button>
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