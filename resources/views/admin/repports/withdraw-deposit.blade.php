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
                        <a href="#">Repports</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->

            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Repports</h3>

            @include('admin.layouts.messages')
            <div class="row">
              <div class="col-md-10">
                  @include('admin.layouts.filters.repports-filter')
              </div>
              <div class="col-md-2" style="text-align: end;padding-top: 1.5em;">
                <a href="{{ route('download_withdraw_deposit_repport', Request::query()) }}" class="btn btn-success">Download Repport</a>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive card">
                      <div class="pt-1">
                        @if ($records->count() > 0)
                          {!! $records->withQueryString()->links() !!}
                          <table id="basic-datatable" class="table dt-responsive nowrap table-hover t-head-float">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nr</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Manager Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Gateway</th>
                                    <th scope="col">Created date</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(count($records) > 0)
                                  @php
                                      $y = $records->currentPage() * $records->perPage() - ($records->perPage() - 1);
                                      $data_sot_Ymd = date('Y-m-d');
                                  @endphp
                                  @foreach($records as $record)
                                    <tr>
                                      <td>{{$y}}</td>
                                      <td>{{$record->user_id}}</td>
                                      <td>{{$record->client_name}}</td>
                                      <td>{{$record->manager_name}}</td>
                                      <td>{{$record->amount}}</td>
                                      <td>{{$record->mode}}</td>
                                      <td>{{$record->created_at}}</td>
                                    </tr>
                                      @php $y++; @endphp
                                  @endforeach
                              @else
                                  <tr>
                                      <td colspan="14">No results found</td>
                                  </tr>
                              @endif
                            </tbody>
                          </table>
                          {!! $records->withQueryString()->links() !!}
                        @else
                          <p>No records found!</p>
                        @endif
                      </div>
                  </div>
                  {{-- <pre>
                    @php
                        print_r($records);
                    @endphp
                  </pre> --}}
                </div>
              </div>

        </div>
      </div>
      <!-- END CONTENT -->

  <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="{{asset('adminTheme/assets/global/plugins/respond.min.js')}}"></script>
	<script src="{{asset('adminTheme/assets/global/plugins/excanvas.min.js')}}"></script> 
<![endif]-->
@endsection