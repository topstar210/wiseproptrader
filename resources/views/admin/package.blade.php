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
						<a href="#">Package Edit</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">My Package</h3>
			<div class="row">
				<div class="col-md-12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-edit"></i>Package List
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
							 #
						</th>
						<th>
							 Plan Name
						</th>
						<th>
							 One Time Desk Fee
						</th>
						<th>
							 Label Balance Amount
						</th>
						<th>
							 Max Daily Loss
						</th>
						<th>
							 Min Time Days
						</th>
						<th>
							 Max Days On Level
						</th>
						<th>
							 Max Leverage
						</th>
						<th>
							 Your Profit Share
						</th>
						<th>
							 Scaling Target
						</th>
						<th>
                            Action
                        </th>
					</tr>
					</thead>
					<tbody>
					@if(!empty($pack))
						@foreach($pack as $clients)
						<tr>
							<td>{{$loop->index+1}}</td>
							<td>{{$clients->name}}</td>
							<td>{{$clients->buy}}</td>
							<td>{{$clients->amount}}</td>
							<td>{{$clients->max_loss}}</td>
							<td>{{$clients->min_time}}</td>
							<td>{{$clients->maxdayslevel}}</td>
							<td>{{$clients->leverage}}</td>
							<td>{{$clients->profitshare}}</td>
							<td>{{$clients->terget}}</td>
							<td>
							    <!--<button class="btn btn-success editBtn" data-id="{{ $clients->id }}" data-amount="{{ $clients->amount }}" data-max_loss="{{ $clients->max_loss }}" data-min_time="{{ $clients->min_time }}" data-maxdayslevel="{{ $clients->maxdayslevel }}" data-leverage="{{ $clients->leverage }}" data-profitshare="{{ $clients->profitshare }}" data-terget="{{ $clients->terget }}" data-act="Edit">-->
           <!--                         Edit-->
           <!--                     </button>-->
                             <a href="{{ route('package.edit',$clients->id) }}" class="btn btn-success">Edit</a>
							</td>

						</tr>
						@endforeach
					@endif
					</tbody>
					</table>
					</div>
		</div>
		</div>
	</div>
	</div>
	</div>
</div>




{{-- EDIT/ADD MODAL --}}
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="act"></span> @lang('Package')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name"><strong>@lang('Name') :</strong> </label>
                        <input type="text" class="form-control" name="name" placeholder="@lang('Plan Name')" required>
                    </div>
                    <div class="form-group">
                        <label for="price"><strong>@lang('Price') :</strong> </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control has-append" name="price" placeholder="@lang('Price of Plan')" required>
                            <div class="input-group-append">
                                <div class="input-group-text"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function($){
        "use strict";
        $('.editBtn').on('click', function() {
            var modal = $('#editModal');
            modal.find('.act').text($(this).data('act'));
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=price]').val($(this).data('price'));
            modal.find('input[name=daily_limit]').val($(this).data('daily_limit'));
            modal.find('select[name=ref_level]').val($(this).data('ref_level'));
            modal.modal('show');
        });
    })(jQuery);
</script>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js"></script>
<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
@endsection