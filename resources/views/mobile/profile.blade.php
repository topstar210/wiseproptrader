@extends('layouts.auth_page')

@section('content')

<div class="dashboard-content">
	<header>
			<div class="container-full-width">
					<div class="crypt-header">
							<div class="row">
									<div class="col-12">
											<div class="row">
													<div class="col-5">
															<div class="crypt-logo"><img src="{{$data['logoPath']}}" alt="" style="width:140px!important; height:70px!important;"></div>
													</div>
													<div class="col-7">
															<div class="d-flex flex-row-reverse p-3" style="font-size: 20px;">
																	<i class="menu-toggle bi bi-chevron-compact-down"></i>
																	<div id="balance" class="pr-2"><span class="crypt-up">0.00</span></div>
															</div>
													</div>
											</div>
									</div>

									<div class="col-md-2 col-xl-6 crypt-gross-market-cap balance-header mt-3">
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Balance</p>
													<div id="balance">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Profit/Loss</p>
													<div id="pro_loss">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Equity</p>
													<div id="equity">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Margin</p>
													<div id="margin">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Free Margin</p>
													<div id="free_margin">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
											<div class="col-3 col-sm-2 col-md-3 col-lg-2">
													<p>Margin Level</p>
													<div id="margin_level">
															<p class="crypt-up">0.00</p>
													</div>
											</div>
									</div>

							</div>
					</div>
			</div>

			<div class="crypt-mobile-menu border-bottom border-danger">

					<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center">
									Balance
									<div id="balance_mobile"><p class="crypt-up">0.00</p></div>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
									Profit/Loss
									<div id="pro_loss_mobile"><p class="crypt-up">0.00</p></div>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
									Equity
									<div id="equity_mobile"><p class="crypt-up">0.00</p></div>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
									Margin
									<div id="margin_mobile"><p class="crypt-up">0.00</p></div>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
									Margin Level
									<div id="margin_level_mobile"><p class="crypt-up">0.00</p></div>
							</li>
					</ul>
					<div class="text-center mt-5">
							<button type="button" class="btn btn-sm btn-outline-danger w-50 text-white" onclick="OnLogOut()">{{ __('Logout') }}</button>
					</div>

			</div>
	</header>


	<div class="container-fluid">
		<div class="col-12">
			@include('admin.layouts.messages')
		</div>
		<div class="col-12">
			<div class="profile-left">
				<div class="user-info">
					<span class="user-avtar"><i class="fa fa-user"></i></span>
					<h5>{{$data['name']}}</h5>
				</div>
				<div class="user-account-menu">
					<ul class="nav nav-tabs flex-column" role="tablist">
						<li class="nav-item" id="deposit_show">
							<a class="nav-link active d-flex align-items-center justify-content-between" data-toggle="tab" href="#deposits">
								<span><i class="bi bi-currency-dollar pr-2"></i> Deposits / Withdraw</span>
								<i class="bi bi-chevron-right"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link  d-flex align-items-center justify-content-between" data-toggle="tab" href="#personalInfo">
								<span><i class="bi bi-person-fill pr-2"></i> Personal Information</span>
								<i class="bi bi-chevron-right"></i>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link d-flex align-items-center justify-content-between" data-toggle="tab" href="#communication">
								<span><i class="fa fa-bell pr-2"></i> Communication Center</span>
								<i class="bi bi-chevron-right"></i>
							</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link d-flex align-items-center justify-content-between" data-toggle="tab" href="#security">
								<span><i class="bi bi-shield-lock pr-2"></i> Security Settings</span>
								<i class="bi bi-chevron-right"></i>
							</a>
						</li>

						<li class="nav-item" id="tradeStatementsTab">
							<a class="nav-link d-flex align-items-center justify-content-between" data-toggle="tab" href="#tradeStatements">
								<span><i class="bi bi-receipt pr-2"></i> Trade Statements</span>
								<i class="bi bi-chevron-right"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="profile-right">
				<div class="tab-content text-white">
					<div id="deposits" class="container tab-pane active"><br>
						<div class="pending-funds crypt-dark">
							<h2 id="sectionTitle">Deposit</h2>
							<div class="">
								<div class="crypt-dash-withdraw d-block" id="bitcoin">
									<div class="crypt-withdraw-body">
										<div class="row">
											<div class="col-md-3">
												<div class="nav nav-pills nav-fill" role="tablist" id="depositWithdrayTabs">
													<a class="nav-link active" id="v-pills-zilliqua-btc-deposit-tab" data-toggle="pill" href="#v-pills-zilliqua-btc-deposit" role="tab" aria-controls="v-pills-zilliqua-btc-deposit" aria-selected="true"><i class="pe-7s-bottom-arrow"></i>Deposit</a>

													<a class="nav-link" id="v-pills-zilliqua-btc-withdrawl-tab" data-toggle="pill" href="#v-pills-zilliqua-btc-withdrawl" role="tab" aria-controls="v-pills-zilliqua-btc-withdrawl" aria-selected="false"><i class="pe-7s-up-arrow"></i>Withdraw</a>

													<a class="nav-link" id="v-pills-zilliqua-btc-history-tab" data-toggle="pill" href="#v-pills-zilliqua-btc-history" role="tab" aria-controls="v-pills-zilliqua-btc-history" aria-selected="false"><i class="pe-7s-clock"></i>History</a>

												</div>
											</div>
											<div class="col-md-9 mb-3">
												<div class="tab-content p-0" id="v-pills-zilliqua-btc-tabContent">
													<div class="tab-pane fade show active" id="v-pills-zilliqua-btc-deposit" role="tabpanel" aria-labelledby="v-pills-zilliqua-btc-deposit-tab">

														@if (isset($data['FrontPaymentButtons']) && ($data['FrontPaymentButtons']->value1 != '' || $data['FrontPaymentButtons']->value2 != ''))
															<div class="row m-0 justify-content-center text-center">
																<div class="col-md-12">
																	<div class="btn-group-vertical w-100 pb-2">
																		@if (isset($data['FrontPaymentButtons']->value1) && $data['FrontPaymentButtons']->value1 != '')
																			<a href="{{$data['FrontPaymentButtons']->value1 ?? ''}}" target="_blank" class="btn btn-outline-success"> <img src="{{asset('/landingAssets/images/logo_black.png')}}" alt=""></a>
																		@endif
																		@if (isset($data['FrontPaymentButtonsCrypt']->value1) && $data['FrontPaymentButtonsCrypt']->value1 != '')
																			<input type="text" class="d-none" id="FrontPaymentButtonsCryptV1" value="{{$data['FrontPaymentButtonsCrypt']->value1 ?? ''}}">
																			<button class="btn btn-outline-success" id="button-FrontPaymentButtonsCryptV2" onclick="copyToClipboard('FrontPaymentButtonsCryptV1')">Click To Copy</button>
																		@endif
																	</div>
																	<div class="btn-group-vertical w-100 pb-2">
																		@if (isset($data['FrontPaymentButtons']->value2) && $data['FrontPaymentButtons']->value2 != '')
																			<a href="{{$data['FrontPaymentButtons']->value2 ?? ''}}" target="_blank" class="btn btn-outline-success"> <img src="{{asset('/landingAssets/images/logo-w.png')}}" alt=""></a>
																		@endif
																		@if (isset($data['FrontPaymentButtonsCrypt']->value2) && $data['FrontPaymentButtonsCrypt']->value2 != '')
																			<input type="text" class="d-none" id="FrontPaymentButtonsCryptV2" value="{{$data['FrontPaymentButtonsCrypt']->value2 ?? ''}}">
																			<button class="btn btn-outline-success" id="button-FrontPaymentButtonsCryptV2" onclick="copyToClipboard('FrontPaymentButtonsCryptV2')">Click To Copy</button>
																		@endif
																	</div>
																	<div class="btn-group-vertical w-100 pb-2">
																		@if (isset($data['FrontPaymentButtons']->value3) && $data['FrontPaymentButtons']->value3 != '')
																			<a href="{{$data['FrontPaymentButtons']->value3 ?? ''}}" target="_blank" class="btn btn-outline-success"> <img src="{{asset('/landingAssets/images/coindeck-1.png')}}" alt=""></a>
																		@endif
																		@if (isset($data['FrontPaymentButtonsCrypt']->value3) && $data['FrontPaymentButtonsCrypt']->value3 != '')
																			<input type="text" class="d-none" id="FrontPaymentButtonsCryptV3" value="{{$data['FrontPaymentButtonsCrypt']->value3 ?? ''}}">
																			<button class="btn btn-outline-success" id="button-FrontPaymentButtonsCryptV2" onclick="copyToClipboard('FrontPaymentButtonsCryptV3')">Click To Copy</button>
																		@endif
																	</div>
																</div>
															</div>
														@endif

														@if (count($active_payment_gateways) > 0)
														<div class="row m-0 justify-content-center text-center mt-3 pt-3 border-top">
															<div class="col-md-12">
																<div class="btn-group-vertical btn-group-toggle" data-toggle="buttons">
																	@if (count($active_payment_gateways) > 0)
																		@foreach ($active_payment_gateways as $key => $payment_gateway)
																			<label class="btn btn-outline-success {{($key == 0 ? ' active' : '')}}">
																				<input type="radio" name="depositGateway" value="{{ strtolower($payment_gateway->Gateway) }}" {{($key == 0 ? ' checked' : '')}}> {{ ucwords($payment_gateway->Gateway) }} <img src="{{asset('/adminTheme/assets/payment/')}}/{{ strtolower($payment_gateway->Gateway) }}.svg">
																			</label>
																		@endforeach
																	@endif
																</div>
															</div>

															<div class="col-md-2 pt-4 text-primary">
																<input type="number" name="depositValInput" class="form-control crypt-dark" id="depositValInput" pattern="[0-9]" placeholder="10" autocomplete="off">
															</div>
															<div class="col-md-10 pt-4 text-primary" id="sliderInput">
																<input id="exDepositSlider" type="text" data-slider-ticks="[10, 250, 500, 750, 1000]" data-slider-ticks-snap-bounds="10" data-slider-ticks-labels='["$10", "$250", "$500", "$750", "$1000"]' autocomplete="Off"/>
															</div>
															<div class="col-md-12 pt-4">
																<div class="p-2 bg-primary d-inline-block">Amount $<span id="amountDepositSliderVal"></span></div>
																<div class="p-2 bg-secondary d-inline-block">Fees $0.00</div>
																<div class="p-2 bg-success d-inline-block">Total $<span id="totalDepositSliderVal"></span></div>
															</div>
															<div class="col-md-12 pt-4">
																<input type="hidden" name="depositAmount" id="depositAmount">
																<button class="btn btn-success btn-lg" onclick="depositAction()">Proceed To Payment</button>
															</div>

															{{-- <div class="input-group input-text-select mb-3">
																<div class="input-group-prepend">
																	<input placeholder="Amount" type="text" class="form-control crypt-input-lg" id="depositAmount">
																</div>
																<select class="custom-select" id="depositCurrency">
																	<option value="USD">USD</option>
																	<!-- <option value="GBP">GBP</option> -->
																	<option value="EUR">EUR</option>
																</select>
															</div> --}}

															<form method="POST" action="{!! URL::route('paypal') !!}" id="PaypalpaymentForm">
																{{ csrf_field() }}
																<input type="hidden" id="paypal_amount" type="text" class="form-control" name="paypal_amount" value="0" autofocus>
															</form>
														</div>
														@endif
													</div>
													<div class="tab-pane fade" id="v-pills-zilliqua-btc-withdrawl" role="tabpanel" aria-labelledby="v-pills-zilliqua-btc-withdrawl-tab">
														<p style="display: none" id="avaibleAmountToWithdraw"><b>Available amount to withdraw: </b> <b class="crypt-up" id="free_margin_profile"> 0.00</b></p>
														<p id="quickDepositButtons">
																	{{-- <div class="input-group pr-4">
																		<a href="https://app.cryptopayin.com/referral_form?trader[label]=tradeplus.uk" alt="Quick Deposit" target="_blank" class="btn btn-success mr-2"><i class="bi bi-currency-euro"></i> Quick Deposit</a>
																		<input type="text" class="form-control" id="btHash" value="bc1qpta8uv30vu2hv9ygvayw2pex4tl7jzkuwxzq84" aria-describedby="button-btHash">
																		<div class="input-group-append">
																			<button class="btn btn-primary" type="button" id="button-btHash" onclick="copyToClipboard('btHash')">Click To Copy</button>
																		</div>
																	</div> --}}
																</p>
														<h4 class="text-danger">Wire bank transfer</h4>
														<p><i class="pe-7s-info"></i> Standard bank transfer will be made up to 2 workdays</p>
														<form>
															<div class="input-group mb-3">
																<input type="text" placeholder="Amount" class="form-control" id="withdraw_amount">
																<div class="input-group-append">
																	<span class="input-group-text">USD</span>
																</div>
															</div>
															<div class="input-group mb-3">
																<input type="text" placeholder="Bank Account Number" class="form-control" id="withdraw_bankaccount">
																<!-- <div class="input-group-append">
																	<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">Other Address</button>
																	<div class="dropdown-menu">
																		<a class="dropdown-item" href="#">234235234</a>
																		<a class="dropdown-item" href="#">2343453453</a>
																		<a class="dropdown-item" href="#">234234234234</a>
																	</div>
																</div> -->
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Bank Account Address" id="withdraw_bankaccount_addr">
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Name" id="withdraw_name">
															</div>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Swift Code" id="withdraw_swift">
															</div>
															<div class="form-group">
																<div class="form-group">
																	<select class="form-control" id="withdraw_country">
																		<option>Select Your Country</option>
																		<option {{$data['country']=='AF'?'selected':''}} value="AF">Afghanistan</option>
																		<option {{$data['country']=='AL'?'selected':''}} value="AL">Albania</option>
																		<option {{$data['country']=='DZ'?'selected':''}} value="DZ">Algeria</option>
																		<option {{$data['country']=='AS'?'selected':''}} value="AS">American Samoa</option>
																		<option {{$data['country']=='AD'?'selected':''}} value="AD">Andorra</option>
																		<option {{$data['country']=='AO'?'selected':''}} value="AO">Angola</option>
																		<option {{$data['country']=='AI'?'selected':''}} value="AI">Anguilla</option>
																		<option {{$data['country']=='AQ'?'selected':''}} value="AQ">Antarctica</option>
																		<option {{$data['country']=='AG'?'selected':''}} value="AG">Antigua and Barbuda</option>
																		<option {{$data['country']=='AR'?'selected':''}} value="AR">Argentina</option>
																		<option {{$data['country']=='AM'?'selected':''}} value="AM">Armenia</option>
																		<option {{$data['country']=='AW'?'selected':''}} value="AW">Aruba</option>
																		<option {{$data['country']=='AU'?'selected':''}} value="AU">Australia</option>
																		<option {{$data['country']=='AT'?'selected':''}} value="AT">Austria</option>
																		<option {{$data['country']=='AZ'?'selected':''}} value="AZ">Azerbaijan</option>
																		<option {{$data['country']=='BS'?'selected':''}} value="BS">Bahamas (the)</option>
																		<option {{$data['country']=='BH'?'selected':''}} value="BH">Bahrain</option>
																		<option {{$data['country']=='BD'?'selected':''}} value="BD">Bangladesh</option>
																		<option {{$data['country']=='BB'?'selected':''}} value="BB">Barbados</option>
																		<option {{$data['country']=='BY'?'selected':''}} value="BY">Belarus</option>
																		<option {{$data['country']=='BE'?'selected':''}} value="BE">Belgium</option>
																		<option {{$data['country']=='BZ'?'selected':''}} value="BZ">Belize</option>
																		<option {{$data['country']=='BJ'?'selected':''}} value="BJ">Benin</option>
																		<option {{$data['country']=='BM'?'selected':''}} value="BM">Bermuda</option>
																		<option {{$data['country']=='BT'?'selected':''}} value="BT">Bhutan</option>
																		<option {{$data['country']=='BO'?'selected':''}} value="BO">Bolivia (Plurinational State of)</option>
																		<option {{$data['country']=='BQ'?'selected':''}} value="BQ">Bonaire, Sint Eustatius and Saba</option>
																		<option {{$data['country']=='BA'?'selected':''}} value="BA">Bosnia and Herzegovina</option>
																		<option {{$data['country']=='BW'?'selected':''}} value="BW">Botswana</option>
																		<option {{$data['country']=='BV'?'selected':''}} value="BV">Bouvet Island</option>
																		<option {{$data['country']=='BR'?'selected':''}} value="BR">Brazil</option>
																		<option {{$data['country']=='IO'?'selected':''}} value="IO">British Indian Ocean Territory (the)</option>
																		<option {{$data['country']=='BN'?'selected':''}} value="BN">Brunei Darussalam</option>
																		<option {{$data['country']=='BG'?'selected':''}} value="BG">Bulgaria</option>
																		<option {{$data['country']=='BF'?'selected':''}} value="BF">Burkina Faso</option>
																		<option {{$data['country']=='BI'?'selected':''}} value="BI">Burundi</option>
																		<option {{$data['country']=='CV'?'selected':''}} value="CV">Cabo Verde</option>
																		<option {{$data['country']=='KH'?'selected':''}} value="KH">Cambodia</option>
																		<option {{$data['country']=='CM'?'selected':''}} value="CM">Cameroon</option>
																		<option {{$data['country']=='CA'?'selected':''}} value="CA">Canada</option>
																		<option {{$data['country']=='KY'?'selected':''}} value="KY">Cayman Islands (the)</option>
																		<option {{$data['country']=='CF'?'selected':''}} value="CF">Central African Republic (the)</option>
																		<option {{$data['country']=='TD'?'selected':''}} value="TD">Chad</option>
																		<option {{$data['country']=='CL'?'selected':''}} value="CL">Chile</option>
																		<option {{$data['country']=='CN'?'selected':''}} value="CN">China</option>
																		<option {{$data['country']=='CX'?'selected':''}} value="CX">Christmas Island</option>
																		<option {{$data['country']=='CC'?'selected':''}} value="CC">Cocos (Keeling) Islands (the)</option>
																		<option {{$data['country']=='CO'?'selected':''}} value="CO">Colombia</option>
																		<option {{$data['country']=='KM'?'selected':''}} value="KM">Comoros (the)</option>
																		<option {{$data['country']=='CD'?'selected':''}} value="CD">Congo (the Democratic Republic of the)</option>
																		<option {{$data['country']=='CG'?'selected':''}} value="CG">Congo (the)</option>
																		<option {{$data['country']=='CK'?'selected':''}} value="CK">Cook Islands (the)</option>
																		<option {{$data['country']=='CR'?'selected':''}} value="CR">Costa Rica</option>
																		<option {{$data['country']=='HR'?'selected':''}} value="HR">Croatia</option>
																		<option {{$data['country']=='CU'?'selected':''}} value="CU">Cuba</option>
																		<option {{$data['country']=='CW'?'selected':''}} value="CW">Curaçao</option>
																		<option {{$data['country']=='CY'?'selected':''}} value="CY">Cyprus</option>
																		<option {{$data['country']=='CZ'?'selected':''}} value="CZ">Czechia</option>
																		<option {{$data['country']=='CI'?'selected':''}} value="CI">Côte d'Ivoire</option>
																		<option {{$data['country']=='DK'?'selected':''}} value="DK">Denmark</option>
																		<option {{$data['country']=='DJ'?'selected':''}} value="DJ">Djibouti</option>
																		<option {{$data['country']=='DM'?'selected':''}} value="DM">Dominica</option>
																		<option {{$data['country']=='DO'?'selected':''}} value="DO">Dominican Republic (the)</option>
																		<option {{$data['country']=='EC'?'selected':''}} value="EC">Ecuador</option>
																		<option {{$data['country']=='EG'?'selected':''}} value="EG">Egypt</option>
																		<option {{$data['country']=='SV'?'selected':''}} value="SV">El Salvador</option>
																		<option {{$data['country']=='GQ'?'selected':''}} value="GQ">Equatorial Guinea</option>
																		<option {{$data['country']=='ER'?'selected':''}} value="ER">Eritrea</option>
																		<option {{$data['country']=='EE'?'selected':''}} value="EE">Estonia</option>
																		<option {{$data['country']=='SZ'?'selected':''}} value="SZ">Eswatini</option>
																		<option {{$data['country']=='ET'?'selected':''}} value="ET">Ethiopia</option>
																		<option {{$data['country']=='FK'?'selected':''}} value="FK">Falkland Islands (the) [Malvinas]</option>
																		<option {{$data['country']=='FO'?'selected':''}} value="FO">Faroe Islands (the)</option>
																		<option {{$data['country']=='FJ'?'selected':''}} value="FJ">Fiji</option>
																		<option {{$data['country']=='FI'?'selected':''}} value="FI">Finland</option>
																		<option {{$data['country']=='FR'?'selected':''}} value="FR">France</option>
																		<option {{$data['country']=='GF'?'selected':''}} value="GF">French Guiana</option>
																		<option {{$data['country']=='PF'?'selected':''}} value="PF">French Polynesia</option>
																		<option {{$data['country']=='TF'?'selected':''}} value="TF">French Southern Territories (the)</option>
																		<option {{$data['country']=='GA'?'selected':''}} value="GA">Gabon</option>
																		<option {{$data['country']=='GM'?'selected':''}} value="GM">Gambia (the)</option>
																		<option {{$data['country']=='GE'?'selected':''}} value="GE">Georgia</option>
																		<option {{$data['country']=='DE'?'selected':''}} value="DE">Germany</option>
																		<option {{$data['country']=='GH'?'selected':''}} value="GH">Ghana</option>
																		<option {{$data['country']=='GI'?'selected':''}} value="GI">Gibraltar</option>
																		<option {{$data['country']=='GR'?'selected':''}} value="GR">Greece</option>
																		<option {{$data['country']=='GL'?'selected':''}} value="GL">Greenland</option>
																		<option {{$data['country']=='GD'?'selected':''}} value="GD">Grenada</option>
																		<option {{$data['country']=='GP'?'selected':''}} value="GP">Guadeloupe</option>
																		<option {{$data['country']=='GU'?'selected':''}} value="GU">Guam</option>
																		<option {{$data['country']=='GT'?'selected':''}} value="GT">Guatemala</option>
																		<option {{$data['country']=='GG'?'selected':''}} value="GG">Guernsey</option>
																		<option {{$data['country']=='GN'?'selected':''}} value="GN">Guinea</option>
																		<option {{$data['country']=='GW'?'selected':''}} value="GW">Guinea-Bissau</option>
																		<option {{$data['country']=='GY'?'selected':''}} value="GY">Guyana</option>
																		<option {{$data['country']=='HT'?'selected':''}} value="HT">Haiti</option>
																		<option {{$data['country']=='HM'?'selected':''}} value="HM">Heard Island and McDonald Islands</option>
																		<option {{$data['country']=='VA'?'selected':''}} value="VA">Holy See (the)</option>
																		<option {{$data['country']=='HN'?'selected':''}} value="HN">Honduras</option>
																		<option {{$data['country']=='HK'?'selected':''}} value="HK">Hong Kong</option>
																		<option {{$data['country']=='HU'?'selected':''}} value="HU">Hungary</option>
																		<option {{$data['country']=='IS'?'selected':''}} value="IS">Iceland</option>
																		<option {{$data['country']=='IN'?'selected':''}} value="IN">India</option>
																		<option {{$data['country']=='ID'?'selected':''}} value="ID">Indonesia</option>
																		<option {{$data['country']=='IR'?'selected':''}} value="IR">Iran (Islamic Republic of)</option>
																		<option {{$data['country']=='IQ'?'selected':''}} value="IQ">Iraq</option>
																		<option {{$data['country']=='IE'?'selected':''}} value="IE">Ireland</option>
																		<option {{$data['country']=='IM'?'selected':''}} value="IM">Isle of Man</option>
																		<option {{$data['country']=='IL'?'selected':''}} value="IL">Israel</option>
																		<option {{$data['country']=='IT'?'selected':''}} value="IT">Italy</option>
																		<option {{$data['country']=='JM'?'selected':''}} value="JM">Jamaica</option>
																		<option {{$data['country']=='JP'?'selected':''}} value="JP">Japan</option>
																		<option {{$data['country']=='JE'?'selected':''}} value="JE">Jersey</option>
																		<option {{$data['country']=='JO'?'selected':''}} value="JO">Jordan</option>
																		<option {{$data['country']=='KZ'?'selected':''}} value="KZ">Kazakhstan</option>
																		<option {{$data['country']=='KE'?'selected':''}} value="KE">Kenya</option>
																		<option {{$data['country']=='KI'?'selected':''}} value="KI">Kiribati</option>
																		<option {{$data['country']=='KP'?'selected':''}} value="KP">Korea (the Democratic People's Republic of)</option>
																		<option {{$data['country']=='KR'?'selected':''}} value="KR">Korea (the Republic of)</option>
																		<option {{$data['country']=='KW'?'selected':''}} value="KW">Kuwait</option>
																		<option {{$data['country']=='KG'?'selected':''}} value="KG">Kyrgyzstan</option>
																		<option {{$data['country']=='LA'?'selected':''}} value="LA">Lao People's Democratic Republic (the)</option>
																		<option {{$data['country']=='LV'?'selected':''}} value="LV">Latvia</option>
																		<option {{$data['country']=='LB'?'selected':''}} value="LB">Lebanon</option>
																		<option {{$data['country']=='LS'?'selected':''}} value="LS">Lesotho</option>
																		<option {{$data['country']=='LR'?'selected':''}} value="LR">Liberia</option>
																		<option {{$data['country']=='LY'?'selected':''}} value="LY">Libya</option>
																		<option {{$data['country']=='LI'?'selected':''}} value="LI">Liechtenstein</option>
																		<option {{$data['country']=='LT'?'selected':''}} value="LT">Lithuania</option>
																		<option {{$data['country']=='LU'?'selected':''}} value="LU">Luxembourg</option>
																		<option {{$data['country']=='MO'?'selected':''}} value="MO">Macao</option>
																		<option {{$data['country']=='MG'?'selected':''}} value="MG">Madagascar</option>
																		<option {{$data['country']=='MW'?'selected':''}} value="MW">Malawi</option>
																		<option {{$data['country']=='MY'?'selected':''}} value="MY">Malaysia</option>
																		<option {{$data['country']=='MV'?'selected':''}} value="MV">Maldives</option>
																		<option {{$data['country']=='ML'?'selected':''}} value="ML">Mali</option>
																		<option {{$data['country']=='MT'?'selected':''}} value="MT">Malta</option>
																		<option {{$data['country']=='MH'?'selected':''}} value="MH">Marshall Islands (the)</option>
																		<option {{$data['country']=='MQ'?'selected':''}} value="MQ">Martinique</option>
																		<option {{$data['country']=='MR'?'selected':''}} value="MR">Mauritania</option>
																		<option {{$data['country']=='MU'?'selected':''}} value="MU">Mauritius</option>
																		<option {{$data['country']=='YT'?'selected':''}} value="YT">Mayotte</option>
																		<option {{$data['country']=='MX'?'selected':''}} value="MX">Mexico</option>
																		<option {{$data['country']=='FM'?'selected':''}} value="FM">Micronesia (Federated States of)</option>
																		<option {{$data['country']=='MD'?'selected':''}} value="MD">Moldova (the Republic of)</option>
																		<option {{$data['country']=='MC'?'selected':''}} value="MC">Monaco</option>
																		<option {{$data['country']=='MN'?'selected':''}} value="MN">Mongolia</option>
																		<option {{$data['country']=='ME'?'selected':''}} value="ME">Montenegro</option>
																		<option {{$data['country']=='MS'?'selected':''}} value="MS">Montserrat</option>
																		<option {{$data['country']=='MA'?'selected':''}} value="MA">Morocco</option>
																		<option {{$data['country']=='MZ'?'selected':''}} value="MZ">Mozambique</option>
																		<option {{$data['country']=='MM'?'selected':''}} value="MM">Myanmar</option>
																		<option {{$data['country']=='NA'?'selected':''}} value="NA">Namibia</option>
																		<option {{$data['country']=='NR'?'selected':''}} value="NR">Nauru</option>
																		<option {{$data['country']=='NP'?'selected':''}} value="NP">Nepal</option>
																		<option {{$data['country']=='NL'?'selected':''}} value="NL">Netherlands (the)</option>
																		<option {{$data['country']=='NC'?'selected':''}} value="NC">New Caledonia</option>
																		<option {{$data['country']=='NZ'?'selected':''}} value="NZ">New Zealand</option>
																		<option {{$data['country']=='NI'?'selected':''}} value="NI">Nicaragua</option>
																		<option {{$data['country']=='NE'?'selected':''}} value="NE">Niger (the)</option>
																		<option {{$data['country']=='NG'?'selected':''}} value="NG">Nigeria</option>
																		<option {{$data['country']=='NU'?'selected':''}} value="NU">Niue</option>
																		<option {{$data['country']=='NF'?'selected':''}} value="NF">Norfolk Island</option>
																		<option {{$data['country']=='MP'?'selected':''}} value="MP">Northern Mariana Islands (the)</option>
																		<option {{$data['country']=='NO'?'selected':''}} value="NO">Norway</option>
																		<option {{$data['country']=='OM'?'selected':''}} value="OM">Oman</option>
																		<option {{$data['country']=='PK'?'selected':''}} value="PK">Pakistan</option>
																		<option {{$data['country']=='PW'?'selected':''}} value="PW">Palau</option>
																		<option {{$data['country']=='PS'?'selected':''}} value="PS">Palestine, State of</option>
																		<option {{$data['country']=='PA'?'selected':''}} value="PA">Panama</option>
																		<option {{$data['country']=='PG'?'selected':''}} value="PG">Papua New Guinea</option>
																		<option {{$data['country']=='PY'?'selected':''}} value="PY">Paraguay</option>
																		<option {{$data['country']=='PE'?'selected':''}} value="PE">Peru</option>
																		<option {{$data['country']=='PH'?'selected':''}} value="PH">Philippines (the)</option>
																		<option {{$data['country']=='PN'?'selected':''}} value="PN">Pitcairn</option>
																		<option {{$data['country']=='PL'?'selected':''}} value="PL">Poland</option>
																		<option {{$data['country']=='PT'?'selected':''}} value="PT">Portugal</option>
																		<option {{$data['country']=='PR'?'selected':''}} value="PR">Puerto Rico</option>
																		<option {{$data['country']=='QA'?'selected':''}} value="QA">Qatar</option>
																		<option {{$data['country']=='MK'?'selected':''}} value="MK">Republic of North Macedonia</option>
																		<option {{$data['country']=='RO'?'selected':''}} value="RO">Romania</option>
																		<option {{$data['country']=='RU'?'selected':''}} value="RU">Russian Federation (the)</option>
																		<option {{$data['country']=='RW'?'selected':''}} value="RW">Rwanda</option>
																		<option {{$data['country']=='RE'?'selected':''}} value="RE">Réunion</option>
																		<option {{$data['country']=='BL'?'selected':''}} value="BL">Saint Barthélemy</option>
																		<option {{$data['country']=='SH'?'selected':''}} value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
																		<option {{$data['country']=='KN'?'selected':''}} value="KN">Saint Kitts and Nevis</option>
																		<option {{$data['country']=='LC'?'selected':''}} value="LC">Saint Lucia</option>
																		<option {{$data['country']=='MF'?'selected':''}} value="MF">Saint Martin (French part)</option>
																		<option {{$data['country']=='PM'?'selected':''}} value="PM">Saint Pierre and Miquelon</option>
																		<option {{$data['country']=='VC'?'selected':''}} value="VC">Saint Vincent and the Grenadines</option>
																		<option {{$data['country']=='WS'?'selected':''}} value="WS">Samoa</option>
																		<option {{$data['country']=='SM'?'selected':''}} value="SM">San Marino</option>
																		<option {{$data['country']=='ST'?'selected':''}} value="ST">Sao Tome and Principe</option>
																		<option {{$data['country']=='SA'?'selected':''}} value="SA">Saudi Arabia</option>
																		<option {{$data['country']=='SN'?'selected':''}} value="SN">Senegal</option>
																		<option {{$data['country']=='RS'?'selected':''}} value="RS">Serbia</option>
																		<option {{$data['country']=='SC'?'selected':''}} value="SC">Seychelles</option>
																		<option {{$data['country']=='SL'?'selected':''}} value="SL">Sierra Leone</option>
																		<option {{$data['country']=='SG'?'selected':''}} value="SG">Singapore</option>
																		<option {{$data['country']=='SX'?'selected':''}} value="SX">Sint Maarten (Dutch part)</option>
																		<option {{$data['country']=='SK'?'selected':''}} value="SK">Slovakia</option>
																		<option {{$data['country']=='SI'?'selected':''}} value="SI">Slovenia</option>
																		<option {{$data['country']=='SB'?'selected':''}} value="SB">Solomon Islands</option>
																		<option {{$data['country']=='SO'?'selected':''}} value="SO">Somalia</option>
																		<option {{$data['country']=='ZA'?'selected':''}} value="ZA">South Africa</option>
																		<option {{$data['country']=='GS'?'selected':''}} value="GS">South Georgia and the South Sandwich Islands</option>
																		<option {{$data['country']=='SS'?'selected':''}} value="SS">South Sudan</option>
																		<option {{$data['country']=='ES'?'selected':''}} value="ES">Spain</option>
																		<option {{$data['country']=='LK'?'selected':''}} value="LK">Sri Lanka</option>
																		<option {{$data['country']=='SD'?'selected':''}} value="SD">Sudan (the)</option>
																		<option {{$data['country']=='SR'?'selected':''}} value="SR">Suriname</option>
																		<option {{$data['country']=='SJ'?'selected':''}} value="SJ">Svalbard and Jan Mayen</option>
																		<option {{$data['country']=='SE'?'selected':''}} value="SE">Sweden</option>
																		<option {{$data['country']=='CH'?'selected':''}} value="CH">Switzerland</option>
																		<option {{$data['country']=='SY'?'selected':''}} value="SY">Syrian Arab Republic</option>
																		<option {{$data['country']=='TW'?'selected':''}} value="TW">Taiwan</option>
																		<option {{$data['country']=='TJ'?'selected':''}} value="TJ">Tajikistan</option>
																		<option {{$data['country']=='TZ'?'selected':''}} value="TZ">Tanzania, United Republic of</option>
																		<option {{$data['country']=='TH'?'selected':''}} value="TH">Thailand</option>
																		<option {{$data['country']=='TL'?'selected':''}} value="TL">Timor-Leste</option>
																		<option {{$data['country']=='TG'?'selected':''}} value="TG">Togo</option>
																		<option {{$data['country']=='TK'?'selected':''}} value="TK">Tokelau</option>
																		<option {{$data['country']=='TO'?'selected':''}} value="TO">Tonga</option>
																		<option {{$data['country']=='TT'?'selected':''}} value="TT">Trinidad and Tobago</option>
																		<option {{$data['country']=='TN'?'selected':''}} value="TN">Tunisia</option>
																		<option {{$data['country']=='TR'?'selected':''}} value="TR">Turkey</option>
																		<option {{$data['country']=='TM'?'selected':''}} value="TM">Turkmenistan</option>
																		<option {{$data['country']=='TC'?'selected':''}} value="TC">Turks and Caicos Islands (the)</option>
																		<option {{$data['country']=='TV'?'selected':''}} value="TV">Tuvalu</option>
																		<option {{$data['country']=='UG'?'selected':''}} value="UG">Uganda</option>
																		<option {{$data['country']=='UA'?'selected':''}} value="UA">Ukraine</option>
																		<option {{$data['country']=='AE'?'selected':''}} value="AE">United Arab Emirates (the)</option>
																		<option {{$data['country']=='GB'?'selected':''}} value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
																		<option {{$data['country']=='UM'?'selected':''}} value="UM">United States Minor Outlying Islands (the)</option>
																		<option {{$data['country']=='US'?'selected':''}} value="US">United States of America (the)</option>
																		<option {{$data['country']=='UY'?'selected':''}} value="UY">Uruguay</option>
																		<option {{$data['country']=='UZ'?'selected':''}} value="UZ">Uzbekistan</option>
																		<option {{$data['country']=='VU'?'selected':''}} value="VU">Vanuatu</option>
																		<option {{$data['country']=='VE'?'selected':''}} value="VE">Venezuela (Bolivarian Republic of)</option>
																		<option {{$data['country']=='VN'?'selected':''}} value="VN">Viet Nam</option>
																		<option {{$data['country']=='VG'?'selected':''}} value="VG">Virgin Islands (British)</option>
																		<option {{$data['country']=='VI'?'selected':''}} value="VI">Virgin Islands (U.S.)</option>
																		<option {{$data['country']=='WF'?'selected':''}} value="WF">Wallis and Futuna</option>
																		<option {{$data['country']=='EH'?'selected':''}} value="EH">Western Sahara</option>
																		<option {{$data['country']=='YE'?'selected':''}} value="YE">Yemen</option>
																		<option {{$data['country']=='ZM'?'selected':''}} value="ZM">Zambia</option>
																		<option {{$data['country']=='ZW'?'selected':''}} value="ZW">Zimbabwe</option>
																		<option {{$data['country']=='AX'?'selected':''}} value="AX">Åland Island</option>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<div class="form-check">
																	<input class="form-check-input" type="checkbox" id="recipient-btc">
																	<label class="form-check-label" for="recipient-btc">
																		Add To recipient
																	</label>
																</div>
															</div>
															@if($withdrawcheck > 0 && $withdrawcheck !=null &&  $withdraw )
														<p class="btn btn-danger w-100"> 10% profits in 30 days You can withdraw. You may only withdraw 50% of the profits you make in 30 days. </p>
														@else
														<a href="#" class="btn btn-danger w-100" onclick="withdrawPayment()">Initiate Withdraw</a>
														@endif
															<!--<a href="#" class="btn btn-danger w-100" onclick="withdrawPayment()">Initiate Withdraw</a>-->
														</form>
													</div>
													<div class="tab-pane fade" id="v-pills-zilliqua-btc-history" role="tabpanel" aria-labelledby="v-pills-zilliqua-btc-history-tab">
														@if(isset($data['pending_transfers']) && !empty($data['pending_transfers']))
															<div class="row" style="overflow: auto; margin-bottom: 50px;">
																<h3>Pending Deposits</h3>
																<table class="table table-striped">
																	<thead>
																		<tr>
																			<th scope="col">Time</th>
																			<th scope="col">ID</th>
																			<th scope="col">Amount</th>
																			<th scope="col">Currency</th>
																			<th scope="col">Status</th>
																		</tr>
																	</thead>
																	<tbody>
																		@foreach($data['pending_transfers'] as $key => $pending_transfers)
																			<tr>
																				<th scope="row">{{$pending_transfers->created_at}}</th>
																				<td>{{$pending_transfers->orderId}}</td>
																				<td>{{$pending_transfers->amount}}</td>
																				<td>{{$pending_transfers->currency}}</td>
																				<td>{{$pending_transfers->status}}</td>
																			</tr>
																		@endforeach
																	</tbody>
																</table>
															</div>
														@endif

														<div class="row" style="overflow: auto;">
															<h3>Deposits</h3>
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th scope="col">Time</th>
																		<th scope="col">Amount</th>
																		<th scope="col">Currency</th>
																		<th scope="col">Action</th>
																	</tr>
																</thead>
																<tbody>
																	@if(!empty($data['deposits']))
																	@foreach($data['deposits'] as $deposits)
																	<tr>
																		<th scope="row">{{$deposits->created_at}}</th>
																		<td>{{$deposits->amount}}</td>
																		<td>{{$deposits->currency}}</td>
																		<td>{{$deposits->mode}}</td>
																	</tr>
																	@endforeach
																	@endif
																</tbody>
															</table>
														</div>

														<div class="row" style="overflow: auto; margin-top: 50px;">
															<h3>Withdraws</h3>
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th scope="col">Time</th>
																		<th scope="col">Amount($)</th>
																		<th scope="col">Status</th>
																	</tr>
																</thead>
																<tbody>
																	@if(!empty($data['withdraws']))
																		@foreach($data['withdraws'] as $withdraws)
																			@php
																					if ($withdraws->status == 'Approved') {
																						$withdraw_color = 'success';
																					} else if ($withdraws->status == 'Declined'){
																						$withdraw_color = 'danger';
																					} else {
																						$withdraw_color = 'info';
																					}
																			@endphp
																			<tr class="text-{{$withdraw_color}}">
																				<th scope="row">{{$withdraws->created_at}}</th>
																				<td>{{$withdraws->amount}}</td>
																				<td>
																					{{$withdraws->status}}
																					@if($withdraws->status=='Declined')
																						<button tabindex="0" class="btn btn-sm btn-danger ml-2" role="button" data-toggle="popover" data-trigger="focus" data-content="{{$withdraws->decline_reason}}">Show Reason</button>
																					@endif
																				</td>
																			</tr>
																		@endforeach
																	@endif

																</tbody>
															</table>
														</div>
													</div>
													<div class="tab-pane fade" id="v-pills-zilliqua-btc-buysell" role="tabpanel" aria-labelledby="v-pills-zilliqua-btc-buysell-tab">
														<div class="crypt-boxed-area">
															<h6 class="crypt-bg-head"><b class="crypt-up">BUY</b> / <b class="crypt-down">SELL</b></h6>
															<div class="row no-gutters">
																<div class="col-md-12 col-xxl-6">
																	<div class="crypt-buy-sell-form">
																		<p>Buy <span class="crypt-up">BTC</span> <span class="fright">Available: <b class="crypt-up">20 BTC</b></span></p>
																		<div class="crypt-buy">
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Price</span>
																				</div>
																				<input type="text" class="form-control" placeholder="0.02323476" readonly>
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Amount</span>
																				</div>
																				<input type="number" class="form-control">
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Total</span>
																				</div>
																				<input type="text" class="form-control" readonly>
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div>
																				<p>Fee: <span class="fright">100%x0.2 = 0.02</span></p>
																			</div>
																			<div class="text-center mt-5 mb-5 crypt-up">
																				<p>You will approximately pay</p>
																				<h4>0.09834 BTC</h4>
																			</div>
																			<div class="menu-green">
																				<a href="" class="crypt-button-green-full">Buy</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-12 col-xxl-6">
																	<div class="crypt-buy-sell-form">
																		<p>Sell <span class="crypt-down">BTC</span> <span class="fright">Available: <b class="crypt-down">20 BTC</b></span></p>
																		<div class="crypt-sell">
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Price</span>
																				</div>
																				<input type="text" class="form-control" placeholder="0.02323476" readonly>
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Amount</span>
																				</div>
																				<input type="number" class="form-control">
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span class="input-group-text">Total</span>
																				</div>
																				<input type="text" class="form-control" readonly>
																				<div class="input-group-append">
																					<span class="input-group-text">BTC</span>
																				</div>
																			</div>
																			<div>
																				<p>Fee: <span class="fright">100%x0.2 = 0.02</span></p>
																			</div>
																			<div class="text-center mt-5 mb-5 crypt-down">
																				<p>You will approximately pay</p>
																				<h4>0.09834 BTC</h4>
																			</div>
																			<div>
																				<a href="" class="crypt-button-red-full">Sell</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>

					</div>
					<div id="personalInfo" class="container tab-pane fade"><br>
						{{ html()->modelForm($data, 'PATCH', route('updateProfile'))->class('')->open() }}
						<div class="form-row mb-3">
							<div class="col">
								<label>Name <span class="text-danger"> *</span></label>
								<input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{$data['name']}}">
							</div>
							<div class="col">
								<label>Language</label>
								<select class="custom-select select-background-icon" id="language" style="background-color: rgb(14,22,45)">
									<option></option>
									<option {{$data['lang']=='en-uk'?'selected':''}} value="en-uk">English (United Kingdom)</option>
									<option {{$data['lang']=='en-us'?'selected':''}} value="en-us">English (United State)</option>
								</select>
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col">
								<label>Email<span class="text-danger"> *</span></label>
								<input type="email" class="form-control" id="email" placeholder="Email" value="{{$data['email']}}" name="email">
							</div>
							<div class="col">
								<label>Phone Number <span class="text-danger"> *</span></label>
								<input type="tel" class="form-control" id="tel" placeholder="Phone Number" name="tel" value="{{$data['phone']}}">
							</div>
						</div>

						<div class="form-row mb-3">
							<div class="col">
								<label>BrithDay</label>
								<input type="date" class="form-control" data-provide="datepicker" id="birth" placeholder="Birth Date" name="birth" value="{{$data['birth']}}">
							</div>
							<div class="col">
								<label>Country<span class="text-danger"> *</span></label>
								<select class="custom-select select-background-icon" id="country" style="background-color: rgb(14,22,45)">
									<option>Select Your Country</option>
									<option {{$data['country']=='AF'?'selected':''}} value="AF">Afghanistan</option>
									<option {{$data['country']=='AL'?'selected':''}} value="AL">Albania</option>
									<option {{$data['country']=='DZ'?'selected':''}} value="DZ">Algeria</option>
									<option {{$data['country']=='AS'?'selected':''}} value="AS">American Samoa</option>
									<option {{$data['country']=='AD'?'selected':''}} value="AD">Andorra</option>
									<option {{$data['country']=='AO'?'selected':''}} value="AO">Angola</option>
									<option {{$data['country']=='AI'?'selected':''}} value="AI">Anguilla</option>
									<option {{$data['country']=='AQ'?'selected':''}} value="AQ">Antarctica</option>
									<option {{$data['country']=='AG'?'selected':''}} value="AG">Antigua and Barbuda</option>
									<option {{$data['country']=='AR'?'selected':''}} value="AR">Argentina</option>
									<option {{$data['country']=='AM'?'selected':''}} value="AM">Armenia</option>
									<option {{$data['country']=='AW'?'selected':''}} value="AW">Aruba</option>
									<option {{$data['country']=='AU'?'selected':''}} value="AU">Australia</option>
									<option {{$data['country']=='AT'?'selected':''}} value="AT">Austria</option>
									<option {{$data['country']=='AZ'?'selected':''}} value="AZ">Azerbaijan</option>
									<option {{$data['country']=='BS'?'selected':''}} value="BS">Bahamas (the)</option>
									<option {{$data['country']=='BH'?'selected':''}} value="BH">Bahrain</option>
									<option {{$data['country']=='BD'?'selected':''}} value="BD">Bangladesh</option>
									<option {{$data['country']=='BB'?'selected':''}} value="BB">Barbados</option>
									<option {{$data['country']=='BY'?'selected':''}} value="BY">Belarus</option>
									<option {{$data['country']=='BE'?'selected':''}} value="BE">Belgium</option>
									<option {{$data['country']=='BZ'?'selected':''}} value="BZ">Belize</option>
									<option {{$data['country']=='BJ'?'selected':''}} value="BJ">Benin</option>
									<option {{$data['country']=='BM'?'selected':''}} value="BM">Bermuda</option>
									<option {{$data['country']=='BT'?'selected':''}} value="BT">Bhutan</option>
									<option {{$data['country']=='BO'?'selected':''}} value="BO">Bolivia (Plurinational State of)</option>
									<option {{$data['country']=='BQ'?'selected':''}} value="BQ">Bonaire, Sint Eustatius and Saba</option>
									<option {{$data['country']=='BA'?'selected':''}} value="BA">Bosnia and Herzegovina</option>
									<option {{$data['country']=='BW'?'selected':''}} value="BW">Botswana</option>
									<option {{$data['country']=='BV'?'selected':''}} value="BV">Bouvet Island</option>
									<option {{$data['country']=='BR'?'selected':''}} value="BR">Brazil</option>
									<option {{$data['country']=='IO'?'selected':''}} value="IO">British Indian Ocean Territory (the)</option>
									<option {{$data['country']=='BN'?'selected':''}} value="BN">Brunei Darussalam</option>
									<option {{$data['country']=='BG'?'selected':''}} value="BG">Bulgaria</option>
									<option {{$data['country']=='BF'?'selected':''}} value="BF">Burkina Faso</option>
									<option {{$data['country']=='BI'?'selected':''}} value="BI">Burundi</option>
									<option {{$data['country']=='CV'?'selected':''}} value="CV">Cabo Verde</option>
									<option {{$data['country']=='KH'?'selected':''}} value="KH">Cambodia</option>
									<option {{$data['country']=='CM'?'selected':''}} value="CM">Cameroon</option>
									<option {{$data['country']=='CA'?'selected':''}} value="CA">Canada</option>
									<option {{$data['country']=='KY'?'selected':''}} value="KY">Cayman Islands (the)</option>
									<option {{$data['country']=='CF'?'selected':''}} value="CF">Central African Republic (the)</option>
									<option {{$data['country']=='TD'?'selected':''}} value="TD">Chad</option>
									<option {{$data['country']=='CL'?'selected':''}} value="CL">Chile</option>
									<option {{$data['country']=='CN'?'selected':''}} value="CN">China</option>
									<option {{$data['country']=='CX'?'selected':''}} value="CX">Christmas Island</option>
									<option {{$data['country']=='CC'?'selected':''}} value="CC">Cocos (Keeling) Islands (the)</option>
									<option {{$data['country']=='CO'?'selected':''}} value="CO">Colombia</option>
									<option {{$data['country']=='KM'?'selected':''}} value="KM">Comoros (the)</option>
									<option {{$data['country']=='CD'?'selected':''}} value="CD">Congo (the Democratic Republic of the)</option>
									<option {{$data['country']=='CG'?'selected':''}} value="CG">Congo (the)</option>
									<option {{$data['country']=='CK'?'selected':''}} value="CK">Cook Islands (the)</option>
									<option {{$data['country']=='CR'?'selected':''}} value="CR">Costa Rica</option>
									<option {{$data['country']=='HR'?'selected':''}} value="HR">Croatia</option>
									<option {{$data['country']=='CU'?'selected':''}} value="CU">Cuba</option>
									<option {{$data['country']=='CW'?'selected':''}} value="CW">Curaçao</option>
									<option {{$data['country']=='CY'?'selected':''}} value="CY">Cyprus</option>
									<option {{$data['country']=='CZ'?'selected':''}} value="CZ">Czechia</option>
									<option {{$data['country']=='CI'?'selected':''}} value="CI">Côte d'Ivoire</option>
									<option {{$data['country']=='DK'?'selected':''}} value="DK">Denmark</option>
									<option {{$data['country']=='DJ'?'selected':''}} value="DJ">Djibouti</option>
									<option {{$data['country']=='DM'?'selected':''}} value="DM">Dominica</option>
									<option {{$data['country']=='DO'?'selected':''}} value="DO">Dominican Republic (the)</option>
									<option {{$data['country']=='EC'?'selected':''}} value="EC">Ecuador</option>
									<option {{$data['country']=='EG'?'selected':''}} value="EG">Egypt</option>
									<option {{$data['country']=='SV'?'selected':''}} value="SV">El Salvador</option>
									<option {{$data['country']=='GQ'?'selected':''}} value="GQ">Equatorial Guinea</option>
									<option {{$data['country']=='ER'?'selected':''}} value="ER">Eritrea</option>
									<option {{$data['country']=='EE'?'selected':''}} value="EE">Estonia</option>
									<option {{$data['country']=='SZ'?'selected':''}} value="SZ">Eswatini</option>
									<option {{$data['country']=='ET'?'selected':''}} value="ET">Ethiopia</option>
									<option {{$data['country']=='FK'?'selected':''}} value="FK">Falkland Islands (the) [Malvinas]</option>
									<option {{$data['country']=='FO'?'selected':''}} value="FO">Faroe Islands (the)</option>
									<option {{$data['country']=='FJ'?'selected':''}} value="FJ">Fiji</option>
									<option {{$data['country']=='FI'?'selected':''}} value="FI">Finland</option>
									<option {{$data['country']=='FR'?'selected':''}} value="FR">France</option>
									<option {{$data['country']=='GF'?'selected':''}} value="GF">French Guiana</option>
									<option {{$data['country']=='PF'?'selected':''}} value="PF">French Polynesia</option>
									<option {{$data['country']=='TF'?'selected':''}} value="TF">French Southern Territories (the)</option>
									<option {{$data['country']=='GA'?'selected':''}} value="GA">Gabon</option>
									<option {{$data['country']=='GM'?'selected':''}} value="GM">Gambia (the)</option>
									<option {{$data['country']=='GE'?'selected':''}} value="GE">Georgia</option>
									<option {{$data['country']=='DE'?'selected':''}} value="DE">Germany</option>
									<option {{$data['country']=='GH'?'selected':''}} value="GH">Ghana</option>
									<option {{$data['country']=='GI'?'selected':''}} value="GI">Gibraltar</option>
									<option {{$data['country']=='GR'?'selected':''}} value="GR">Greece</option>
									<option {{$data['country']=='GL'?'selected':''}} value="GL">Greenland</option>
									<option {{$data['country']=='GD'?'selected':''}} value="GD">Grenada</option>
									<option {{$data['country']=='GP'?'selected':''}} value="GP">Guadeloupe</option>
									<option {{$data['country']=='GU'?'selected':''}} value="GU">Guam</option>
									<option {{$data['country']=='GT'?'selected':''}} value="GT">Guatemala</option>
									<option {{$data['country']=='GG'?'selected':''}} value="GG">Guernsey</option>
									<option {{$data['country']=='GN'?'selected':''}} value="GN">Guinea</option>
									<option {{$data['country']=='GW'?'selected':''}} value="GW">Guinea-Bissau</option>
									<option {{$data['country']=='GY'?'selected':''}} value="GY">Guyana</option>
									<option {{$data['country']=='HT'?'selected':''}} value="HT">Haiti</option>
									<option {{$data['country']=='HM'?'selected':''}} value="HM">Heard Island and McDonald Islands</option>
									<option {{$data['country']=='VA'?'selected':''}} value="VA">Holy See (the)</option>
									<option {{$data['country']=='HN'?'selected':''}} value="HN">Honduras</option>
									<option {{$data['country']=='HK'?'selected':''}} value="HK">Hong Kong</option>
									<option {{$data['country']=='HU'?'selected':''}} value="HU">Hungary</option>
									<option {{$data['country']=='IS'?'selected':''}} value="IS">Iceland</option>
									<option {{$data['country']=='IN'?'selected':''}} value="IN">India</option>
									<option {{$data['country']=='ID'?'selected':''}} value="ID">Indonesia</option>
									<option {{$data['country']=='IR'?'selected':''}} value="IR">Iran (Islamic Republic of)</option>
									<option {{$data['country']=='IQ'?'selected':''}} value="IQ">Iraq</option>
									<option {{$data['country']=='IE'?'selected':''}} value="IE">Ireland</option>
									<option {{$data['country']=='IM'?'selected':''}} value="IM">Isle of Man</option>
									<option {{$data['country']=='IL'?'selected':''}} value="IL">Israel</option>
									<option {{$data['country']=='IT'?'selected':''}} value="IT">Italy</option>
									<option {{$data['country']=='JM'?'selected':''}} value="JM">Jamaica</option>
									<option {{$data['country']=='JP'?'selected':''}} value="JP">Japan</option>
									<option {{$data['country']=='JE'?'selected':''}} value="JE">Jersey</option>
									<option {{$data['country']=='JO'?'selected':''}} value="JO">Jordan</option>
									<option {{$data['country']=='KZ'?'selected':''}} value="KZ">Kazakhstan</option>
									<option {{$data['country']=='KE'?'selected':''}} value="KE">Kenya</option>
									<option {{$data['country']=='KI'?'selected':''}} value="KI">Kiribati</option>
									<option {{$data['country']=='KP'?'selected':''}} value="KP">Korea (the Democratic People's Republic of)</option>
									<option {{$data['country']=='KR'?'selected':''}} value="KR">Korea (the Republic of)</option>
									<option {{$data['country']=='KW'?'selected':''}} value="KW">Kuwait</option>
									<option {{$data['country']=='KG'?'selected':''}} value="KG">Kyrgyzstan</option>
									<option {{$data['country']=='LA'?'selected':''}} value="LA">Lao People's Democratic Republic (the)</option>
									<option {{$data['country']=='LV'?'selected':''}} value="LV">Latvia</option>
									<option {{$data['country']=='LB'?'selected':''}} value="LB">Lebanon</option>
									<option {{$data['country']=='LS'?'selected':''}} value="LS">Lesotho</option>
									<option {{$data['country']=='LR'?'selected':''}} value="LR">Liberia</option>
									<option {{$data['country']=='LY'?'selected':''}} value="LY">Libya</option>
									<option {{$data['country']=='LI'?'selected':''}} value="LI">Liechtenstein</option>
									<option {{$data['country']=='LT'?'selected':''}} value="LT">Lithuania</option>
									<option {{$data['country']=='LU'?'selected':''}} value="LU">Luxembourg</option>
									<option {{$data['country']=='MO'?'selected':''}} value="MO">Macao</option>
									<option {{$data['country']=='MG'?'selected':''}} value="MG">Madagascar</option>
									<option {{$data['country']=='MW'?'selected':''}} value="MW">Malawi</option>
									<option {{$data['country']=='MY'?'selected':''}} value="MY">Malaysia</option>
									<option {{$data['country']=='MV'?'selected':''}} value="MV">Maldives</option>
									<option {{$data['country']=='ML'?'selected':''}} value="ML">Mali</option>
									<option {{$data['country']=='MT'?'selected':''}} value="MT">Malta</option>
									<option {{$data['country']=='MH'?'selected':''}} value="MH">Marshall Islands (the)</option>
									<option {{$data['country']=='MQ'?'selected':''}} value="MQ">Martinique</option>
									<option {{$data['country']=='MR'?'selected':''}} value="MR">Mauritania</option>
									<option {{$data['country']=='MU'?'selected':''}} value="MU">Mauritius</option>
									<option {{$data['country']=='YT'?'selected':''}} value="YT">Mayotte</option>
									<option {{$data['country']=='MX'?'selected':''}} value="MX">Mexico</option>
									<option {{$data['country']=='FM'?'selected':''}} value="FM">Micronesia (Federated States of)</option>
									<option {{$data['country']=='MD'?'selected':''}} value="MD">Moldova (the Republic of)</option>
									<option {{$data['country']=='MC'?'selected':''}} value="MC">Monaco</option>
									<option {{$data['country']=='MN'?'selected':''}} value="MN">Mongolia</option>
									<option {{$data['country']=='ME'?'selected':''}} value="ME">Montenegro</option>
									<option {{$data['country']=='MS'?'selected':''}} value="MS">Montserrat</option>
									<option {{$data['country']=='MA'?'selected':''}} value="MA">Morocco</option>
									<option {{$data['country']=='MZ'?'selected':''}} value="MZ">Mozambique</option>
									<option {{$data['country']=='MM'?'selected':''}} value="MM">Myanmar</option>
									<option {{$data['country']=='NA'?'selected':''}} value="NA">Namibia</option>
									<option {{$data['country']=='NR'?'selected':''}} value="NR">Nauru</option>
									<option {{$data['country']=='NP'?'selected':''}} value="NP">Nepal</option>
									<option {{$data['country']=='NL'?'selected':''}} value="NL">Netherlands (the)</option>
									<option {{$data['country']=='NC'?'selected':''}} value="NC">New Caledonia</option>
									<option {{$data['country']=='NZ'?'selected':''}} value="NZ">New Zealand</option>
									<option {{$data['country']=='NI'?'selected':''}} value="NI">Nicaragua</option>
									<option {{$data['country']=='NE'?'selected':''}} value="NE">Niger (the)</option>
									<option {{$data['country']=='NG'?'selected':''}} value="NG">Nigeria</option>
									<option {{$data['country']=='NU'?'selected':''}} value="NU">Niue</option>
									<option {{$data['country']=='NF'?'selected':''}} value="NF">Norfolk Island</option>
									<option {{$data['country']=='MP'?'selected':''}} value="MP">Northern Mariana Islands (the)</option>
									<option {{$data['country']=='NO'?'selected':''}} value="NO">Norway</option>
									<option {{$data['country']=='OM'?'selected':''}} value="OM">Oman</option>
									<option {{$data['country']=='PK'?'selected':''}} value="PK">Pakistan</option>
									<option {{$data['country']=='PW'?'selected':''}} value="PW">Palau</option>
									<option {{$data['country']=='PS'?'selected':''}} value="PS">Palestine, State of</option>
									<option {{$data['country']=='PA'?'selected':''}} value="PA">Panama</option>
									<option {{$data['country']=='PG'?'selected':''}} value="PG">Papua New Guinea</option>
									<option {{$data['country']=='PY'?'selected':''}} value="PY">Paraguay</option>
									<option {{$data['country']=='PE'?'selected':''}} value="PE">Peru</option>
									<option {{$data['country']=='PH'?'selected':''}} value="PH">Philippines (the)</option>
									<option {{$data['country']=='PN'?'selected':''}} value="PN">Pitcairn</option>
									<option {{$data['country']=='PL'?'selected':''}} value="PL">Poland</option>
									<option {{$data['country']=='PT'?'selected':''}} value="PT">Portugal</option>
									<option {{$data['country']=='PR'?'selected':''}} value="PR">Puerto Rico</option>
									<option {{$data['country']=='QA'?'selected':''}} value="QA">Qatar</option>
									<option {{$data['country']=='MK'?'selected':''}} value="MK">Republic of North Macedonia</option>
									<option {{$data['country']=='RO'?'selected':''}} value="RO">Romania</option>
									<option {{$data['country']=='RU'?'selected':''}} value="RU">Russian Federation (the)</option>
									<option {{$data['country']=='RW'?'selected':''}} value="RW">Rwanda</option>
									<option {{$data['country']=='RE'?'selected':''}} value="RE">Réunion</option>
									<option {{$data['country']=='BL'?'selected':''}} value="BL">Saint Barthélemy</option>
									<option {{$data['country']=='SH'?'selected':''}} value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
									<option {{$data['country']=='KN'?'selected':''}} value="KN">Saint Kitts and Nevis</option>
									<option {{$data['country']=='LC'?'selected':''}} value="LC">Saint Lucia</option>
									<option {{$data['country']=='MF'?'selected':''}} value="MF">Saint Martin (French part)</option>
									<option {{$data['country']=='PM'?'selected':''}} value="PM">Saint Pierre and Miquelon</option>
									<option {{$data['country']=='VC'?'selected':''}} value="VC">Saint Vincent and the Grenadines</option>
									<option {{$data['country']=='WS'?'selected':''}} value="WS">Samoa</option>
									<option {{$data['country']=='SM'?'selected':''}} value="SM">San Marino</option>
									<option {{$data['country']=='ST'?'selected':''}} value="ST">Sao Tome and Principe</option>
									<option {{$data['country']=='SA'?'selected':''}} value="SA">Saudi Arabia</option>
									<option {{$data['country']=='SN'?'selected':''}} value="SN">Senegal</option>
									<option {{$data['country']=='RS'?'selected':''}} value="RS">Serbia</option>
									<option {{$data['country']=='SC'?'selected':''}} value="SC">Seychelles</option>
									<option {{$data['country']=='SL'?'selected':''}} value="SL">Sierra Leone</option>
									<option {{$data['country']=='SG'?'selected':''}} value="SG">Singapore</option>
									<option {{$data['country']=='SX'?'selected':''}} value="SX">Sint Maarten (Dutch part)</option>
									<option {{$data['country']=='SK'?'selected':''}} value="SK">Slovakia</option>
									<option {{$data['country']=='SI'?'selected':''}} value="SI">Slovenia</option>
									<option {{$data['country']=='SB'?'selected':''}} value="SB">Solomon Islands</option>
									<option {{$data['country']=='SO'?'selected':''}} value="SO">Somalia</option>
									<option {{$data['country']=='ZA'?'selected':''}} value="ZA">South Africa</option>
									<option {{$data['country']=='GS'?'selected':''}} value="GS">South Georgia and the South Sandwich Islands</option>
									<option {{$data['country']=='SS'?'selected':''}} value="SS">South Sudan</option>
									<option {{$data['country']=='ES'?'selected':''}} value="ES">Spain</option>
									<option {{$data['country']=='LK'?'selected':''}} value="LK">Sri Lanka</option>
									<option {{$data['country']=='SD'?'selected':''}} value="SD">Sudan (the)</option>
									<option {{$data['country']=='SR'?'selected':''}} value="SR">Suriname</option>
									<option {{$data['country']=='SJ'?'selected':''}} value="SJ">Svalbard and Jan Mayen</option>
									<option {{$data['country']=='SE'?'selected':''}} value="SE">Sweden</option>
									<option {{$data['country']=='CH'?'selected':''}} value="CH">Switzerland</option>
									<option {{$data['country']=='SY'?'selected':''}} value="SY">Syrian Arab Republic</option>
									<option {{$data['country']=='TW'?'selected':''}} value="TW">Taiwan</option>
									<option {{$data['country']=='TJ'?'selected':''}} value="TJ">Tajikistan</option>
									<option {{$data['country']=='TZ'?'selected':''}} value="TZ">Tanzania, United Republic of</option>
									<option {{$data['country']=='TH'?'selected':''}} value="TH">Thailand</option>
									<option {{$data['country']=='TL'?'selected':''}} value="TL">Timor-Leste</option>
									<option {{$data['country']=='TG'?'selected':''}} value="TG">Togo</option>
									<option {{$data['country']=='TK'?'selected':''}} value="TK">Tokelau</option>
									<option {{$data['country']=='TO'?'selected':''}} value="TO">Tonga</option>
									<option {{$data['country']=='TT'?'selected':''}} value="TT">Trinidad and Tobago</option>
									<option {{$data['country']=='TN'?'selected':''}} value="TN">Tunisia</option>
									<option {{$data['country']=='TR'?'selected':''}} value="TR">Turkey</option>
									<option {{$data['country']=='TM'?'selected':''}} value="TM">Turkmenistan</option>
									<option {{$data['country']=='TC'?'selected':''}} value="TC">Turks and Caicos Islands (the)</option>
									<option {{$data['country']=='TV'?'selected':''}} value="TV">Tuvalu</option>
									<option {{$data['country']=='UG'?'selected':''}} value="UG">Uganda</option>
									<option {{$data['country']=='UA'?'selected':''}} value="UA">Ukraine</option>
									<option {{$data['country']=='AE'?'selected':''}} value="AE">United Arab Emirates (the)</option>
									<option {{$data['country']=='GB'?'selected':''}} value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
									<option {{$data['country']=='UM'?'selected':''}} value="UM">United States Minor Outlying Islands (the)</option>
									<option {{$data['country']=='US'?'selected':''}} value="US">United States of America (the)</option>
									<option {{$data['country']=='UY'?'selected':''}} value="UY">Uruguay</option>
									<option {{$data['country']=='UZ'?'selected':''}} value="UZ">Uzbekistan</option>
									<option {{$data['country']=='VU'?'selected':''}} value="VU">Vanuatu</option>
									<option {{$data['country']=='VE'?'selected':''}} value="VE">Venezuela (Bolivarian Republic of)</option>
									<option {{$data['country']=='VN'?'selected':''}} value="VN">Viet Nam</option>
									<option {{$data['country']=='VG'?'selected':''}} value="VG">Virgin Islands (British)</option>
									<option {{$data['country']=='VI'?'selected':''}} value="VI">Virgin Islands (U.S.)</option>
									<option {{$data['country']=='WF'?'selected':''}} value="WF">Wallis and Futuna</option>
									<option {{$data['country']=='EH'?'selected':''}} value="EH">Western Sahara</option>
									<option {{$data['country']=='YE'?'selected':''}} value="YE">Yemen</option>
									<option {{$data['country']=='ZM'?'selected':''}} value="ZM">Zambia</option>
									<option {{$data['country']=='ZW'?'selected':''}} value="ZW">Zimbabwe</option>
									<option {{$data['country']=='AX'?'selected':''}} value="AX">Åland Island</option>
								</select>
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col">
								<label>City<span class="text-danger"> *</span></label>
								<input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{$data['city']}}">
							</div>
							<div class="col">
								<label>Street Address<span class="text-danger"> *</span></label>
								<input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{$data['address']}}">
							</div>
						</div>
						<div class="form-row mb-3">
							<div class="col">
								<label>Zip or Postal Code<span class="text-danger"> *</span></label>
								<input type="text" class="form-control" id="zipCode" placeholder="Zip Code" name="zipCode" value="{{$data['zip']}}">
							</div>
							{{-- <div class="col">
								<label>Currency<span class="text-danger"> *</span></label>
								<select class="custom-select select-background-icon" name="userCurrency" id="userCurrency" style="background-color: rgb(14,22,45)">
									<option></option>
									<option {{$data['userCurrency']=='USD'?'selected':''}} value="USD">USD</option>
									<option {{$data['userCurrency']=='GBP'?'selected':''}} value="GBP">GBP</option>
									<option {{$data['userCurrency']=='EUR'?'selected':''}} value="EUR">EUR</option>
								</select>
							</div> --}}
							@if (auth()->user()->isManager())
								<div class="col">
									<label>Referal Code<span class="text-danger"></span></label>
									@if ($data['referalCode'] != '')
										{{ html()->text('referalCode')
												->class('form-control')
												->placeholder('Referal Code')
												->attribute('maxlength', 15) }}
									@else
										<div class="input-group">
											<div class="input-group-prepend">
												<button class="btn btn-outline-secondary" type="button" id="generateRefCodeButton" onclick="generateReferalCode()">Generate</button>
											</div>
											<input type="text" name="referalCode" id="referalCode" class="form-control" placeholder="Referal Code" aria-describedby="generateRefCodeButton">
										</div>
									@endif
								</div>
							@endif
						</div>
						<div class="d-flex justify-content-end">
							<button class="btn btn-primary w-100" type="submit">Update Personal Information</button>
						</div>
						</form>
						<br>
					</div>
					<div id="communication" class="container tab-pane fade"><br>
						<div class="user-communication">
							<h2 class="mb-3">Notifications</h2>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input" id="allowEmail" name="allowEmail">
								<label class="custom-control-label" for="allowEmail">Allow Email</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input" id="allowSMS" name="allowSMS">
								<label class="custom-control-label" for="allowSMS">Allow SMS</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input" id="allowNotifications" name="allowNotifications">
								<label class="custom-control-label" for="allowNotifications">Allow Mobile/Web Push notifications</label>
							</div>
							<div class="d-flex justify-content-end update-btn">
								<button>Update My Notifications</button>
							</div>
						</div>
						<br>
					</div>
					<div id="security" class="container tab-pane fade"><br>
						<div class="user-security">
							<h2 class="mb-4">Change Password</h2>
							<div class="d-flex mb-4 password-input flex-wrap">
								<div class="col-lg-4 col-12 p-0 pr-3">
									<label class="d-block">Change Password *</label>
									<div class="user-password-field">
										<input type="Password" name="changePassword" class="w-100">
										<i class="fa fa-eye"></i>
									</div>
								</div>
								<div class="col-lg-4 col-12 p-0 pr-3">
									<label class="d-block">New Password *</label>
									<div class="user-password-field">
										<input type="Password" name="newPassword" class="w-100">
										<i class="fa fa-eye"></i>
									</div>
								</div>
								<div class="col-lg-4 col-12 p-0 pr-3">
									<label class="d-block">Confirm Password *</label>
									<div class="user-password-field">
										<input type="Password" name="confirmPassword" class="w-100">
										<i class="fa fa-eye"></i>
									</div>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button class="btn btn-primary w-100">Update My Password</button>
							</div>
						</div>
						<br>
					</div>

					<div id="tradeStatements" class="container tab-pane fade">
						<h2>Account Statements</h2>
						<p>Statement created at: {{date('Y-m-d H:i:s')}}</p>
						<div class="row">
							<div class="col-12">
								{{ html()->modelForm('', 'GET', '/' . Route::current()->uri.'#tradeStatementsTab')->class('')->open() }}

									{{-- @foreach (Request::query() as $key => $value)
											@if($value != '')
													{{ html()->hidden($key)->value($value) }}
											@endif
									@endforeach --}}

									<div class="input-daterange" id="datepicker">
											<div class="form-group w-100">
													{{ html()->label('Date From')->class('control-label')->for('date_from_filter') }}
													{{ html()->text('date_from')->id('date_from_filter')->class('form-control')->placeholder('00-00-000')->attribute('autocomplete', 'off')->value(Request::query('date_from')) }}
											</div>
											<div class="form-group w-100">
													{{ html()->label('Date To')->class('control-label')->for('date_to_filter') }}
													{{ html()->text('date_to')->id('date_to_filter')->class('form-control')->placeholder('00-00-000')->attribute('autocomplete', 'off')->value(Request::query('date_to')) }}
											</div>
											<div class="form-group">
													{{ html()->submit('Filter')->class('btn btn-primary') }}
											</div>
									</div>
								{{ html()->closeModelForm() }}
								<div class="text-right">
									<a href="{{ route('export_statement', Request::query()) }}" class="btn btn-success">Export Statements</a>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="position-info col p-0 pr-3">
								<div class="table-responsive card crypt-dark">
										<div class="pt-1">
												@if ($trade_statement->count() > 0)
													{!! $trade_statement->withQueryString()->fragment('tradeStatementsTab')->links() !!}
													<table id="basic-datatable" class="table dt-responsive nowrap table-hover t-head-float">
														<thead class="thead-dark">
																<tr>
																		<th scope="col">Nr</th>
																		<th scope="col">Ticket</th>
																		<th scope="col">Open Time</th>
																		<th scope="col">Type</th>
																		<th scope="col">Units</th>
																		<th scope="col">Instrument</th>
																		<th scope="col">Open Rate</th>
																		<th scope="col">Market Rate</th>
																		<th scope="col">Profit/Loss</th>
																		<th scope="col">Take/Profit</th>
																		<th scope="col">Stop/Loss</th>
																</tr>
														</thead>
														<tbody>
															@if(count($trade_statement) > 0)
																	@php
																			$y = $trade_statement->currentPage() * $trade_statement->perPage() - ($trade_statement->perPage() - 1);
																			$data_sot_Ymd = date('Y-m-d');
																	@endphp
																	@foreach($trade_statement as $record)
																		<tr>
																			<td>{{$y}}</td>
																			<td>{{$record->ticket}}</td>
																			<td>{{$record->open_time}}</td>
																			<td>{{$record->type}}</td>
																			<td>{{$record->trade_amount}}</td>
																			<td>{{$record->base_symbol}}/{{$record->quote_symbol}}</td>
																			<td>{{$record->open_rate}}</td>
																			<td>{{$record->close_rate}}</td>
																			<td>{{$record->pro_loss}}</td>
																			<td>{{$record->profit}}</td>
																			<td>{{$record->loss}}</td>
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
													{!! $trade_statement->withQueryString()->fragment('tradeStatementsTab')->links() !!}
												@else
													<p>No records found!</p>
												@endif
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="container fixed-bottom crypt-footer text-center">
		<ul class="nav nav-pills row" role="tablist" id="footerMenuTab">
				<li class="nav-item col" role="presentation">
					<a class="nav-link" href="/home#assetsPage">
						<span>Assets</span>
					</a>
				</li>
				<li class="nav-item col" role="presentation">
					<a class="nav-link" href="/home#chartPage">
						<span><i class="bi bi-bar-chart-fill"></i></span>
					</a>
				</li>
				<li class="nav-item col" role="presentation">
					<a class="nav-link" href="/home#ordersPage">
						<span><i class="bi bi-currency-exchange"></i></span>
					</a>
				</li>
				<li class="nav-item col" role="presentation">
					<a class="nav-link active" href="/profile">
						<span><i class="bi bi-gear-fill"></i></span>
					</a>
				</li>
		</ul>
	</footer>
</div>

<div class="modal fade buy-sell-modal" id="raveModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content crypt-dark">
			<div class="modal-head text-white px-3 pt-3">
				<div class="d-flex justify-content-between align-items-center mb-2">
					<div id=""></div>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<div class="d-flex align-items-center mb-2" style="background-color:#061027">
					<div style="margin: auto;">
						<font size="+2">Flutterwave Payment Detail</font>
					</div>
				</div>
			</div>
			<div class="modal-body text-white">
				@php
				$array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
				array('metaname' => 'size', 'metavalue' => 'big'));
				@endphp
				<form role="form" action="{{ route('pay') }}" method="post" class="require-validation" id="ravePaymentForm">
					@csrf
					<input type="hidden" name="amount" id="amount" value="0" />
					<input type="hidden" name="payment_method" value="both" />
					<input type="hidden" name="country" value="NG" />
					<input type="hidden" name="currency" id="currency" value="" />
					<input type="hidden" name="metadata" value="{{ json_encode($array) }}">
					<input type="hidden" name="paymentplan" value="362" />
					<input type="hidden" name="ref" value="MY_NAME_5uwh2a2a7f270ac98" />
					<!-- <input type="hidden" name="logo" value="https://assets.piedpiper.com/logo.png" /> -->
					<input type="hidden" name="title" value="{{$data['rave_title']}}" />
					<div class='form-row row'>
						<div class='col-xs-12 form-group required'>
							<label class='control-label'>Email</label> <input autocomplete='off' name="email" class='form-control card-number' type='text'>
						</div>
					</div>
					<div class='form-row row'>
						<div class='col-xs-12 form-group required'>
							<label class='control-label'>Phone number</label> <input autocomplete='off' name="phonenumber" class='form-control card-number' type='text'>
						</div>
					</div>
					<div class='form-row row'>
						<div class='col-xs-12 form-group required'>
							<label class='control-label'>Description</label> <input autocomplete='off' class='form-control card-number' name="description" type='text'>
						</div>
					</div>
					<div class='form-row row'>
						<div class='col-xs-12 col-md-6 form-group expiration required'>
							<label class='control-label'>First Name</label> <input name="firstname" class='form-control' type='text'>
						</div>
						<div class='col-xs-12 col-md-6 form-group expiration required'>
							<label class='control-label'>Last Name</label> <input name="lastname" class='form-control' type='text'>
						</div>
					</div>
					<div class="modal-foot px-3 pb-3">
						<button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<div class="modal fade buy-sell-modal" id="coinModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content crypt-dark">
			<div class="modal-head text-white px-3 pt-3">
				<div class="d-flex justify-content-between align-items-center mb-2">
					<div id=""></div>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<div class="d-flex align-items-center mb-2" style="background-color:#061027">
					<div style="margin: auto;">
						<font size="+2">CoinPayment Detail</font>
					</div>
				</div>
			</div>
			<div class="modal-body text-white">
				@if (Session::has('success'))
				<div class="alert alert-success text-center">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('success') }}</p>
				</div>
				@endif
				<form role="form" action="{!! URL::route('Coinpayment') !!}" method="post" id="coinPayForm">
					@csrf
					<div class='form-row row'>
						<div class='col-xs-12 form-group required'>
							<label class='control-label'>Deposit Amount(USD)</label>
							<input id="coinPayAmount" name="coinPayAmount" class='form-control' type='text'>
						</div>
					</div>
					<div class='form-row row'>
						<div class='col-xs-12 form-group required'>
							<label class='control-label'>Description</label> <input autocomplete='off' class='form-control' id="coinPayDescription" name="coinPayDescription" type='text'>
						</div>
					</div>
					<div class='form-row row'>
						<div class='col-xs-12 col-md-6 form-group required'>
							<label class='control-label'>Holder's name</label> <input autocomplete='off' class='form-control' id="coinPayName" name="coinPayName" type='text'>
						</div>
						<div class='col-xs-12 col-md-6 form-group required'>
							<label class='control-label'>Holder's email</label> <input class='form-control' id="coinPayEmail" name="coinPayEmail" type='email'>
						</div>

					</div>
					<div class='form-row row' style="display: none;" id="coinErrorMsg">
						<div class='col-md-12 error form-group'>
							<div class='alert-danger alert' id="coinErrorText">
							</div>
						</div>
					</div>
					<div class="modal-foot px-3 pb-3">
						<button type="button" class="btn btn-primary btn-lg btn-block" onclick="confirmCoinPay()">Pay Now</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<div class="modal fade buy-sell-modal" id="paymentwallModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content crypt-dark">
			<div class="modal-head text-white px-3 pt-3">
				<div class="d-flex justify-content-between align-items-center mb-2">
					<div id=""></div>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<div class="d-flex align-items-center mb-2">
					<div style="margin: auto;">
						<font size="+2">Paymentwall Detail</font>
					</div>
				</div>
			</div>
			<div class="modal-body text-white">
				<form role="form" action="{{ url('/paymentwall/pay') }}" method="post" class="require-validation" id="paymentwallPaymentForm">
					@csrf
					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="p-wall-email">Email</span></label>
							<input type="email" class="form-control" name="p-wall-email" id="p-wall-email" value="{{auth()->user()->email}}" placeholder="you@example.com">
						</div>
						{{-- <div class="col-md-12 mb-3">
							<label for="p-wall-name">Name on card</label>
							<input type="text" class="form-control" name="p-wall-name" id="p-wall-name" placeholder="" required="">
							<small class="text-muted">Full name as displayed on card</small>
							<div class="invalid-feedback">
								Name on card is required
							</div>
						</div> --}}
						<div class="col-md-12 mb-3">
							<label for="p-wall-card_number">Card number</label>
							<input type="text" class="form-control" name="card_number" id="p-wall-card_number" pattern="[0-9]{16}" placeholder="4242424242424242" required="">
							<div class="invalid-feedback">
								Credit card number is required
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 mb-3">
							<label for="p-wall-expiration_month">Expiration</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">MM/YY</span>
								</div>
								<input type="text" class="form-control" name="expiration_month" id="p-wall-expiration_month" pattern="[1-9]{2}" placeholder="12" required="">
								<input type="text" class="form-control" name="expiration_year" id="p-wall-expiration_year" pattern="[1-9]{2}" placeholder="22" required="">
							</div>
						</div>
						<div class="col-md-4 mb-3">
							<label for="p-wall-cvc">CVC</label>
							<input type="text" class="form-control" name="cvc" id="p-wall-cvc" pattern="[0-9]{3}" placeholder="123" required="">
							<div class="invalid-feedback">
								Security code required
							</div>
						</div>
					</div>
					<input type="hidden" name="p-wall-amount" class="deposit-amount">
					<p id="paymentWallResponse" class="text-center"></p>
					<button id="paymentwallPaymentBtn" class="btn btn-success btn-lg btn-block" type="submit">Pay Deposit</button>
				</form>
			</div>

		</div>
	</div>
</div>

<div class="modal fade buy-sell-modal" id="bridgerModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content crypt-dark">
			<div class="modal-head text-white px-3 pt-3">
				<div class="d-flex justify-content-between align-items-center mb-2">
					<div id=""></div>
					<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				</div>
				<div class="d-flex align-items-center mb-2" style="background-color:#061027">
					<div style="margin: auto;">
						<font size="+2">BridgerPay Detail</font>
					</div>
				</div>
			</div>
			<div class="modal-body text-white">
				<div class='form-row row'>
					<div class='col-xs-12 form-group required'>
						<label class='control-label'>Country</label>
						<select class="custom-select select-background-icon form-control" id="bridgerPay_country" style="background-color: rgb(14,22,45)">
							<option value="">Select Your Country</option>
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AS">American Samoa</option>
							<option value="AD">Andorra</option>
							<option value="AO">Angola</option>
							<option value="AI">Anguilla</option>
							<option value="AQ">Antarctica</option>
							<option value="AG">Antigua and Barbuda</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas (the)</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>
							<option value="BB">Barbados</option>
							<option value="BY">Belarus</option>
							<option value="BE">Belgium</option>
							<option value="BZ">Belize</option>
							<option value="BJ">Benin</option>
							<option value="BM">Bermuda</option>
							<option value="BT">Bhutan</option>
							<option value="BO">Bolivia (Plurinational State of)</option>
							<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
							<option value="BA">Bosnia and Herzegovina</option>
							<option value="BW">Botswana</option>
							<option value="BV">Bouvet Island</option>
							<option value="BR">Brazil</option>
							<option value="IO">British Indian Ocean Territory (the)</option>
							<option value="BN">Brunei Darussalam</option>
							<option value="BG">Bulgaria</option>
							<option value="BF">Burkina Faso</option>
							<option value="BI">Burundi</option>
							<option value="CV">Cabo Verde</option>
							<option value="KH">Cambodia</option>
							<option value="CM">Cameroon</option>
							<option value="CA">Canada</option>
							<option value="KY">Cayman Islands (the)</option>
							<option value="CF">Central African Republic (the)</option>
							<option value="TD">Chad</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>
							<option value="CX">Christmas Island</option>
							<option value="CC">Cocos (Keeling) Islands (the)</option>
							<option value="CO">Colombia</option>
							<option value="KM">Comoros (the)</option>
							<option value="CD">Congo (the Democratic Republic of the)</option>
							<option value="CG">Congo (the)</option>
							<option value="CK">Cook Islands (the)</option>
							<option value="CR">Costa Rica</option>
							<option value="HR">Croatia</option>
							<option value="CU">Cuba</option>
							<option value="CW">Curaçao</option>
							<option value="CY">Cyprus</option>
							<option value="CZ">Czechia</option>
							<option value="CI">Côte d'Ivoire</option>
							<option value="DK">Denmark</option>
							<option value="DJ">Djibouti</option>
							<option value="DM">Dominica</option>
							<option value="DO">Dominican Republic (the)</option>
							<option value="EC">Ecuador</option>
							<option value="EG">Egypt</option>
							<option value="SV">El Salvador</option>
							<option value="GQ">Equatorial Guinea</option>
							<option value="ER">Eritrea</option>
							<option value="EE">Estonia</option>
							<option value="SZ">Eswatini</option>
							<option value="ET">Ethiopia</option>
							<option value="FK">Falkland Islands (the) [Malvinas]</option>
							<option value="FO">Faroe Islands (the)</option>
							<option value="FJ">Fiji</option>
							<option value="FI">Finland</option>
							<option value="FR">France</option>
							<option value="GF">French Guiana</option>
							<option value="PF">French Polynesia</option>
							<option value="TF">French Southern Territories (the)</option>
							<option value="GA">Gabon</option>
							<option value="GM">Gambia (the)</option>
							<option value="GE">Georgia</option>
							<option value="DE">Germany</option>
							<option value="GH">Ghana</option>
							<option value="GI">Gibraltar</option>
							<option value="GR">Greece</option>
							<option value="GL">Greenland</option>
							<option value="GD">Grenada</option>
							<option value="GP">Guadeloupe</option>
							<option value="GU">Guam</option>
							<option value="GT">Guatemala</option>
							<option value="GG">Guernsey</option>
							<option value="GN">Guinea</option>
							<option value="GW">Guinea-Bissau</option>
							<option value="GY">Guyana</option>
							<option value="HT">Haiti</option>
							<option value="HM">Heard Island and McDonald Islands</option>
							<option value="VA">Holy See (the)</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungary</option>
							<option value="IS">Iceland</option>
							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IR">Iran (Islamic Republic of)</option>
							<option value="IQ">Iraq</option>
							<option value="IE">Ireland</option>
							<option value="IM">Isle of Man</option>
							<option value="IL">Israel</option>
							<option value="IT">Italy</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japan</option>
							<option value="JE">Jersey</option>
							<option value="JO">Jordan</option>
							<option value="KZ">Kazakhstan</option>
							<option value="KE">Kenya</option>
							<option value="KI">Kiribati</option>
							<option value="KP">Korea (the Democratic People's Republic of)</option>
							<option value="KR">Korea (the Republic of)</option>
							<option value="KW">Kuwait</option>
							<option value="KG">Kyrgyzstan</option>
							<option value="LA">Lao People's Democratic Republic (the)</option>
							<option value="LV">Latvia</option>
							<option value="LB">Lebanon</option>
							<option value="LS">Lesotho</option>
							<option value="LR">Liberia</option>
							<option value="LY">Libya</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MO">Macao</option>
							<option value="MG">Madagascar</option>
							<option value="MW">Malawi</option>
							<option value="MY">Malaysia</option>
							<option value="MV">Maldives</option>
							<option value="ML">Mali</option>
							<option value="MT">Malta</option>
							<option value="MH">Marshall Islands (the)</option>
							<option value="MQ">Martinique</option>
							<option value="MR">Mauritania</option>
							<option value="MU">Mauritius</option>
							<option value="YT">Mayotte</option>
							<option value="MX">Mexico</option>
							<option value="FM">Micronesia (Federated States of)</option>
							<option value="MD">Moldova (the Republic of)</option>
							<option value="MC">Monaco</option>
							<option value="MN">Mongolia</option>
							<option value="ME">Montenegro</option>
							<option value="MS">Montserrat</option>
							<option value="MA">Morocco</option>
							<option value="MZ">Mozambique</option>
							<option value="MM">Myanmar</option>
							<option value="NA">Namibia</option>
							<option value="NR">Nauru</option>
							<option value="NP">Nepal</option>
							<option value="NL">Netherlands (the)</option>
							<option value="NC">New Caledonia</option>
							<option value="NZ">New Zealand</option>
							<option value="NI">Nicaragua</option>
							<option value="NE">Niger (the)</option>
							<option value="NG">Nigeria</option>
							<option value="NU">Niue</option>
							<option value="NF">Norfolk Island</option>
							<option value="MP">Northern Mariana Islands (the)</option>
							<option value="NO">Norway</option>
							<option value="OM">Oman</option>
							<option value="PK">Pakistan</option>
							<option value="PW">Palau</option>
							<option value="PS">Palestine, State of</option>
							<option value="PA">Panama</option>
							<option value="PG">Papua New Guinea</option>
							<option value="PY">Paraguay</option>
							<option value="PE">Peru</option>
							<option value="PH">Philippines (the)</option>
							<option value="PN">Pitcairn</option>
							<option value="PL">Poland</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="QA">Qatar</option>
							<option value="MK">Republic of North Macedonia</option>
							<option value="RO">Romania</option>
							<option value="RU">Russian Federation (the)</option>
							<option value="RW">Rwanda</option>
							<option value="RE">Réunion</option>
							<option value="BL">Saint Barthélemy</option>
							<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
							<option value="KN">Saint Kitts and Nevis</option>
							<option value="LC">Saint Lucia</option>
							<option value="MF">Saint Martin (French part)</option>
							<option value="PM">Saint Pierre and Miquelon</option>
							<option value="VC">Saint Vincent and the Grenadines</option>
							<option value="WS">Samoa</option>
							<option value="SM">San Marino</option>
							<option value="ST">Sao Tome and Principe</option>
							<option value="SA">Saudi Arabia</option>
							<option value="SN">Senegal</option>
							<option value="RS">Serbia</option>
							<option value="SC">Seychelles</option>
							<option value="SL">Sierra Leone</option>
							<option value="SG">Singapore</option>
							<option value="SX">Sint Maarten (Dutch part)</option>
							<option value="SK">Slovakia</option>
							<option value="SI">Slovenia</option>
							<option value="SB">Solomon Islands</option>
							<option value="SO">Somalia</option>
							<option value="ZA">South Africa</option>
							<option value="GS">South Georgia and the South Sandwich Islands</option>
							<option value="SS">South Sudan</option>
							<option value="ES">Spain</option>
							<option value="LK">Sri Lanka</option>
							<option value="SD">Sudan (the)</option>
							<option value="SR">Suriname</option>
							<option value="SJ">Svalbard and Jan Mayen</option>
							<option value="SE">Sweden</option>
							<option value="CH">Switzerland</option>
							<option value="SY">Syrian Arab Republic</option>
							<option value="TW">Taiwan</option>
							<option value="TJ">Tajikistan</option>
							<option value="TZ">Tanzania, United Republic of</option>
							<option value="TH">Thailand</option>
							<option value="TL">Timor-Leste</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad and Tobago</option>
							<option value="TN">Tunisia</option>
							<option value="TR">Turkey</option>
							<option value="TM">Turkmenistan</option>
							<option value="TC">Turks and Caicos Islands (the)</option>
							<option value="TV">Tuvalu</option>
							<option value="UG">Uganda</option>
							<option value="UA">Ukraine</option>
							<option value="AE">United Arab Emirates (the)</option>
							<option value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
							<option value="UM">United States Minor Outlying Islands (the)</option>
							<option value="US">United States of America (the)</option>
							<option value="UY">Uruguay</option>
							<option value="UZ">Uzbekistan</option>
							<option value="VU">Vanuatu</option>
							<option value="VE">Venezuela (Bolivarian Republic of)</option>
							<option value="VN">Viet Nam</option>
							<option value="VG">Virgin Islands (British)</option>
							<option value="VI">Virgin Islands (U.S.)</option>
							<option value="WF">Wallis and Futuna</option>
							<option value="EH">Western Sahara</option>
							<option value="YE">Yemen</option>
							<option value="ZM">Zambia</option>
							<option value="ZW">Zimbabwe</option>
							<option value="AX">Åland Island</option>
						</select>
					</div>
				</div>
				<div class='form-row row'>
					<div class='col-xs-12 col-md-6 form-group required'>
						<label class='control-label'> First Name</label> <input autocomplete='off' class='form-control' id="bridgerPay_firstname" type='text'>
					</div>
					<div class='col-xs-12 col-md-6 form-group required'>
						<label class='control-label'>Last Name</label> <input class='form-control' id="bridgerPay_lastname" type='text'>
					</div>
				</div>
				<div class='form-row row'>
					<div class='col-xs-12 col-md-6 form-group required'>
						<label class='control-label'> Email</label> <input autocomplete='off' class='form-control' id="bridgerPay_email" type='email'>
					</div>
					<div class='col-xs-12 col-md-6 form-group required'>
						<label class='control-label'>Phone Number</label> <input class='form-control' id="bridgerPay_phone" type='text'>
					</div>
				</div>
				<div class='form-row row'>
					<div class='col-xs-12 col-md-12 form-group required'>
						<label class='control-label'> Address</label> <input autocomplete='off' class='form-control' id="bridgerPay_address" type='text'>
					</div>
				</div>
				<div class='form-row row'>
					<div class='col-xs-12 col-md-4 form-group required'>
						<label class='control-label'> State</label> <input autocomplete='off' class='form-control' id="bridgerPay_state" type='text'>
					</div>
					<div class='col-xs-12 col-md-4 form-group required'>
						<label class='control-label'>City</label> <input class='form-control' id="bridgerPay_city" type='text'>
					</div>
					<div class='col-xs-12 col-md-4 form-group required'>
						<label class='control-label'>Zip Code</label> <input class='form-control' id="bridgerPay_zip" type='text'>
					</div>
				</div>
				<div class="modal-foot px-3 pb-3">
					<button type="button" class="btn btn-primary btn-lg btn-block" onclick="nextBridgerPay()">Continue</button>
				</div>
				<input class='form-control' id="bridgerPay_cashier_key" type='text' style="display: none;">
			</div>
		</div>
	</div>
</div>



<style type="text/css">
	.profile-left {
		padding: 10px 0;
	}

	.user-info {
		text-align: center;
	}

	.user-avtar {
		justify-content: center;
		color: #f7614e;
		background-color: rgb(55, 65, 96);
		border-radius: 50%;
		height: 100px;
		display: flex;
		width: 100px;
		margin: 0 auto;
		align-items: center;
	}

	.user-avtar i {
		font-size: 50px;
	}

	.profile-left .user-account-menu ul.nav-tabs li a {
		border-top: 1px solid rgb(89, 98, 128);
		border-bottom: 1px solid rgb(89, 98, 128);
		border-radius: 0;
		padding: 15px 20px;
		font-size: 15px;
		text-transform: unset;
	}

	.profile-left .user-account-menu ul.nav-tabs li a i {
		font-size: 20px;
	}

	.profile-left .user-account-menu ul.nav-tabs li a.active {
		background-color: rgb(55, 65, 96);
		border-bottom: none;
		color: #fff;
	}

	.profile-left .user-account-menu ul.nav-tabs {
		padding: 0;
		background-color: transparent;
	}

	.profile-left .user-account-menu ul.nav-tabs li {
		padding: 0;
	}

	.user-info-form select {
		background-color: #121722;
		border-color: #06162d;
		color: white;
	}

	.user-communication .custom-control-input:checked~.custom-control-label::before {
		border-color: #f7614e;
		background-color: #f7614e;
	}

	.user-communication .custom-control-input:not(:disabled):active~.custom-control-label::before,
	.user-communication .custom-checkbox .custom-control-label::before {
		border-color: #f7614e;
		background-color: transparent;
	}

	.user-password-field {
		position: relative;
		width: 100%;
		background-color: rgb(55, 65, 96);
	}

	.user-password-field input {
		background-color: transparent;
		border: 1px solid transparent;
		padding: 10px 20px;
		color: white;
	}

	.user-password-field i {
		position: absolute;
		right: 20px;
		top: 14px;
	}

	.user-password-field input:focus,
	.user-password-field input:hover {
		outline: none;
		border: 1px solid #f7614e;
	}

	.withdraw-btn {
		background-color: rgb(55, 65, 96);
		padding: 10px 1rem;
		border: 1px solid transparent;
		font-size: 20px;
		font-weight: 500;
		border-radius: 4px;
		color: rgb(152, 157, 173);
		text-transform: uppercase;
		width: 100%;
		margin-bottom: 5px;
	}

	.deposit-btn {
		padding: 10px 1rem;
		border: 1px solid transparent;
		background-color: rgb(86, 222, 158);
		color: 1c222d;
		font-size: 20px;
		font-weight: 500;
		border-radius: 4px;
		text-transform: uppercase;
		width: 100%;
	}

	.sidebar-sort {
		background-color: rgb(65, 76, 108);
		padding: 11px;
		border-radius: 4px;
		cursor: pointer;
		margin-left: 5px;
	}

	.sidebar-sort.active i.up {
		display: none;
	}

	.sidebar-sort.active i.down {
		display: inline-block;
	}

	.sidebar-sort i.down {
		display: none;
	}

	.custom-select.sort-select {
		width: calc(100% - 90px);
	}

	#open-positions {
		width: 100%;
		padding: 0 6.8vw;
	}

	.crypt-dark .page-link, .crypt-dark .dropdown>.dropdown-menu {
		background-color: rgb(65, 76, 108);
    border-color: rgb(65, 76, 108);
	}

	.select-background-icon {
		background: url(data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xmlns%3Asvgjs%3D%22http%3A%2F%2Fsvgjs.com%2Fsvgjs%22%20version%3D%221.1%22%20width%3D%22512%22%20height%3D%22512%22%20x%3D%220%22%20y%3D%220%22%20viewBox%3D%220%200%20444.819%20444.819%22%20style%3D%22enable-background%3Anew%200%200%20512%20512%22%20xml%3Aspace%3D%22preserve%22%20class%3D%22%22%3E%3Cg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%09%3Cpath%20d%3D%22M434.252%2C114.203l-21.409-21.416c-7.419-7.04-16.084-10.561-25.975-10.561c-10.095%2C0-18.657%2C3.521-25.7%2C10.561%20%20%20L222.41%2C231.549L83.653%2C92.791c-7.042-7.04-15.606-10.561-25.697-10.561c-9.896%2C0-18.559%2C3.521-25.979%2C10.561l-21.128%2C21.416%20%20%20C3.615%2C121.436%2C0%2C130.099%2C0%2C140.188c0%2C10.277%2C3.619%2C18.842%2C10.848%2C25.693l185.864%2C185.865c6.855%2C7.23%2C15.416%2C10.848%2C25.697%2C10.848%20%20%20c10.088%2C0%2C18.75-3.617%2C25.977-10.848l185.865-185.865c7.043-7.044%2C10.567-15.608%2C10.567-25.693%20%20%20C444.819%2C130.287%2C441.295%2C121.629%2C434.252%2C114.203z%22%20fill%3D%22%23ffffff%22%20data-original%3D%22%23000000%22%20style%3D%22%22%2F%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3C%2Fg%3E%3C%2Fsvg%3E) no-repeat right 0.75rem center/14px 20px;
	}

	.funds-select {
		width: calc(100% - 110px);
		position: relative;
		color: white;
		border: none;
		height: calc(1.5em + .75rem + 10px);
		border-radius: 4px;
		background-color: rgb(65, 76, 108);
	}

	.statement-common {
		max-height: calc(100vh - 209px);
		overflow: auto;
		min-height: calc(100vh - 209px);
	}

	.password-input {
		margin-right: -1.5rem;
	}

	.statement-row {
		margin-right: -1rem;
	}

	/*.balance-info, position-info{
        max-width: 400px;
    }*/
	::-webkit-calendar-picker-indicator {
		display: none;
	}

	@media (min-width: 991px) {
		.profile-right>div>div.container {
			padding-left: 0;
			padding-right: 0;
		}
	}

	@media (max-width: 1600px) {
		#open-positions {
			padding: 0 7.86vw;
		}
	}

	@media (max-width: 1460px) {
		#open-positions {
			padding: 0 8.6vw;
		}
	}

	@media (max-width: 1300px) {
		#open-positions {
			padding: 0 8vw;
		}
	}

	@media (max-width: 991px) {
		.user-info-form .form-row>.col {
			flex-basis: auto;
		}

		.user-info-form .form-row>.col {
			flex-basis: auto;
		}

		.user-info-form .form-row>.col:first-child {
			margin-bottom: 1rem;
		}

		.funds-history-menus>div {
			margin-bottom: 1rem;
			flex-wrap: wrap;
		}

		.funds-history-menus>div>span {
			display: block;
			margin-bottom: .5rem;
			width: 100%;
		}

		.funds-history-menus>div>select {
			width: 100%;
		}

		.password-input>div {
			margin-bottom: 10px;
		}

		.statement-row>div:first-child {
			margin-bottom: 20px;
		}
	}

	@media (max-width: 767px) {
		.profile-main-row>div {
			padding: 15px !important;
		}

		.profile-left {
			min-height: auto;
		}

		.profile-left .user-account-menu {
			display: flex;
			white-space: nowrap;
			overflow: auto;
			padding-bottom: 15px;
		}

		.profile-left .user-account-menu ul.nav-tabs {
			display: inline-block;
		}

		.profile-left .user-account-menu ul.nav-tabs li {
			display: inline-block;
		}

		.profile-left .user-account-menu ul.nav-tabs li a span {
			padding-right: 10px;
		}

		.user-info-form input {
			font-size: 12px;
		}

		.profile-right>div>div.container {
			padding: 0;
		}

		.deposit-btn {
			margin-bottom: 10px;
		}

		.statement-common {
			max-height: 100%;
		}
	}
</style>

<script src="{{ URL::asset('landingAssets/amc/bootstrap-slider.js') }}"></script>
<script type="text/javascript">
	var slider = new Slider("#exDepositSlider", {
		formatter: function(value) {
			return value + ' $';
		},
		focus: true
	});

	updateSliderDependents(slider._state.value[0]);

	slider.on('slideStop', function(sliderValue) {
		updateSliderDependents(sliderValue);
		document.getElementById("depositValInput").value = sliderValue;
	});
	slider.on('slide', function(sliderValue) {
		updateSliderDependents(sliderValue);
		document.getElementById("depositValInput").value = sliderValue;
	});

	document.getElementById('depositValInput').addEventListener('input', function updateValue(e) {
		updateSliderDependents(e.target.value);
		slider.setValue(e.target.value);
	});

	function updateSliderDependents(value) {
		document.getElementById("amountDepositSliderVal").textContent = value;
		document.getElementById("totalDepositSliderVal").textContent = value;
		document.getElementById("depositAmount").value = value;
		for ( let input of document.getElementsByClassName("deposit-amount")) {
			input.value = value;
		};
	}

	function OnLogOut() {
		document.getElementById('logout-form').submit();
	}
</script>

@endsection