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
			            <a href="#">Spread Settings</a>
			            <i class="fa fa-angle-right"></i>
			        </li>
			    </ul>

			</div>
			<!-- END PAGE HEADER-->
{{-- <pre>
  {{print_r($data)}}
</pre> --}}
			<!-- BEGIN PAGE CONTENT-->
			<h3 class="page-title">Spread Settings</h3>
      <div class="row">
        <div class="col-12 px-1 pl-3">
          @include('admin.layouts.messages')
        </div>
      </div>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-8">

          @isset($data['forex-categories'])
            <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Forex Spread Settings
                </div>
                <div class="tools"><a href="javascript:;" class="collapse"></a></div>
              </div>
              <div class="portlet-body form">
                <form class="form-horizontal form-bordered" action="{{url('/admin/save-spread-settings')}}" method="POST">
                  @csrf
                  @foreach ($data['forex-categories'] as $forex_category)

                    <div class="form-group">
                      <label class="col-sm-3 control-label"><b>{{ ucfirst($forex_category) }}</b> Spread Value</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="number" id="forex_{{$forex_category}}_cat" name="forex_{{$forex_category}}_cat" class="form-control" value="{{$data['settings']['forex'][$forex_category]??''}}"/>
                        </div>
                      </div>
                    </div>

                  @endforeach

                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <input type="hidden" name="spread_type" value="forex">
                        <button type="submit" class="btn blue"><i class="fa fa-check"></i>Save</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          @endisset

          @isset($data['stock-categories'])
            <div class="portlet box purple">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Stock Spread Settings
                </div>
                <div class="tools"><a href="javascript:;" class="collapse"></a></div>
              </div>
              <div class="portlet-body form">
                <form class="form-horizontal form-bordered" action="{{url('/admin/save-spread-settings')}}" method="POST">
                  @csrf

                  @foreach ($data['stock-categories'] as $stock_category)

                    <div class="form-group">
                      <label class="col-sm-3 control-label"><b>{{ ucfirst($stock_category) }}</b> Spread Value</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="number" id="stock_{{$stock_category}}_cat" name="stock_{{$stock_category}}_cat" class="form-control" value="{{$data['settings']['stock'][$stock_category]??''}}"/>
                        </div>
                      </div>
                    </div>

                  @endforeach

                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <input type="hidden" name="spread_type" value="stock">
                        <button type="submit" class="btn purple"><i class="fa fa-check"></i>Save</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          @endisset

          @isset($data['crypto-categories'])
            <div class="portlet box green">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Crypto Spread Settings
                </div>
                <div class="tools"><a href="javascript:;" class="collapse"></a></div>
              </div>
              <div class="portlet-body form">
                <form class="form-horizontal form-bordered" action="{{url('/admin/save-spread-settings')}}" method="POST">
                  @csrf

                  @foreach ($data['crypto-categories'] as $crypto_category)

                    <div class="form-group">
                      <label class="col-sm-3 control-label"><b>{{ ucfirst($crypto_category) }}</b> Spread Value</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="number" id="crypto_{{$crypto_category}}_cat" name="crypto_{{$crypto_category}}_cat" class="form-control" value="{{$data['settings']['crypto'][$crypto_category]??''}}"/>
                        </div>
                      </div>
                    </div>

                  @endforeach

                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <input type="hidden" name="spread_type" value="crypto">
                        <button type="submit" class="btn green"><i class="fa fa-check"></i>Save</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          @endisset

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