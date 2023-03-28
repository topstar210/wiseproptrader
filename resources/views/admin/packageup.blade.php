@extends('layouts.admin_layout')
@section('content')
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
						<a href="#">Package</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Package Edit</h3>
			<div class="row">
				<div class="col-md-8">

                      <div class="portlet box blue">
              <div class="portlet-title">
                <div class="caption">
                  <i class="fa fa-gift"></i>Package Edit
                </div>
                <div class="tools"><a href="javascript:;" class="collapse" data-original-title="" title=""></a></div>
              </div>
              <div class="portlet-body form">
                <form class="form-horizontal form-bordered" action="{{url('')}}/admin/package/submit" method="POST">
                  @csrf           
                  <input type="hidden" name="id" value="{{$pack->id }}">
                  <div class="form-group">
                      <label class="col-sm-3 control-label">Plan name</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="name" class="form-control" value="{{$pack->name }}">
                        </div>
                      </div>
                    </div>
                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">One Time Desk Fee</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="buy" class="form-control" value="{{$pack->buy }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Label Balance Amount</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="amount" class="form-control" value="{{$pack->amount }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Max Daily Loss %</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="max_loss" class="form-control" value="{{$pack->max_loss }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Min Time Days</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="min_time" class="form-control" value="{{$pack->min_time }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Max Days On Level</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="maxdayslevel" class="form-control" value="{{$pack->maxdayslevel }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Max Leverage</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="leverage" class="form-control" value="{{$pack->leverage }}">
                        </div>
                      </div>
                    </div>

                  
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Your Profit Share %</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="profitshare" class="form-control" value="{{$pack->profitshare }}">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Scaling Target %</label>
                      <div class="col-sm-4">
                        <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-cogs"></i>
                          </span>
                          <input type="text" name="terget" class="form-control" value="{{$pack->terget }}">
                        </div>
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
                </form>

              </div>
            </div>
          
            
				</div>
</div>

@endsection