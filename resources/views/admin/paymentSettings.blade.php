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
					</li>
				</ul>
				
			</div>
			
			<!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <h3 class="page-title">Payment Settings</h3>
			<div class="row" style="display: flex; justify-content: center;">
				<div class="col-md-7" >

					<div class="row portfolio-block">
						<div class="form-inline">
							<div class="form-group col-md-4">
								<label for="btn1Visa">Button WISENEX</label>
								<input type="text" class="form-control" id="btn1Visa" value="{{ $FrontPaymentButtons->value1 ?? '' }}" placeholder="https://google.com/">
								<input type="text" class="form-control" id="btn1VisaCrypt" value="{{ $FrontPaymentButtonsCrypt->value1 ?? '' }}" placeholder="***">
							</div>
							<div class="form-group col-md-3">
								<label for="btn1MasterCard">Button WALLBITEX</label>
								<input type="text" class="form-control" id="btn1MasterCard" value="{{ $FrontPaymentButtons->value2 ?? '' }}" placeholder="https://google.com/">
								<input type="text" class="form-control" id="btn1MasterCardCrypt" value="{{ $FrontPaymentButtonsCrypt->value2 ?? '' }}" placeholder="***">
							</div>
							<div class="form-group col-md-3">
								<label for="btn1New">Button CoinDeck</label>
								<input type="text" class="form-control" id="btn1New" value="{{ $FrontPaymentButtons->value3 ?? '' }}" placeholder="https://google.com/">
								<input type="text" class="form-control" id="btn1NewCrypt" value="{{ $FrontPaymentButtonsCrypt->value3 ?? '' }}" placeholder="***">
							</div>
							<div class="col-md-2">
								<button type="button" id="saveFrontPaymentsLinks" class="btn btn-primary">Save Buttons</button>
							</div>
						</div>
					</div>
<hr>
					<!--end row-->
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/paypal.svg')}}" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="{{url('/super_manager/paymentsettings/paypal')}}" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/paymentwall.svg')}}" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="{{url('/super_manager/paymentsettings/paymentwall')}}" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/flutterwave.svg')}}" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="{{url('/super_manager/paymentsettings/rave')}}" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/coinpayments.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="{{url('/super_manager/paymentsettings/coinpayment')}}" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/bridgerPay.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="{{url('/super_manager/paymentsettings/bridgerPay')}}" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/stripe.svg')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/fortumo.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/coingate.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/coinbasecommerce.svg')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/mollie.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/payeer.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/polipayments.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/paystack.svg')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/banktransfer.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>

					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/paysera.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/gourl.png')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="row portfolio-block">
						<div class="col-md-10 col-sm-12 portfolio-text">
							<img src="{{asset('/adminTheme/assets/payment/bitpay.svg')}}" style="width: 101px; height: 28px;" alt=""/>
						</div>
						
						<div class="col-md-2 col-sm-12">
							<a href="javascript:;" class="btn green">
							<span> Configure </span>
							<i class="m-icon-swapright m-icon-white"></i>
							</a>
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