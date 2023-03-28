@extends('layouts.auth_page')

@section('content')

<header>
    <div class="container-full-width">
        <div class="crypt-header">
            <div class="row">
                <div class="col-md-5 col-xl-3">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="crypt-logo"><img src="{{url('uploads', $app_settings['logo_path']??'')}}" alt="" style="width:140px!important; height:70px!important; margin-left: 17px!important"></div>
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

                <div class="col-md-7 col-xl-3 d-none d-md-block d-lg-block ">

                    <span class="d-inline-block mt-3">
                        <span class="text-success"> Balance</span>
                        <strong> <span id="user_balance" class="text-success"></span></strong>
                    </span>

                    {{-- @if(!$verify)
                        <button class="crypt-box-menu btn btn-success mt-3 mr-3 float-right" onclick="verifyID()">Verify ID</button>
                    @endif --}}
                    <a href="{{ route('profile') }}" class="crypt-box-menu btn btn-success mt-3 mr-1 float-right">Deposit</a>

                    <div class="crypt-mega-dropdown-menu">
                        <a href="" class="crypt-mega-dropdown-toggle " style="display: flex;">
                            <div>
                                <div id="username" style="margin-left: 13px;">{{ mb_strimwidth($user_name, 0, 15, "...") }}</div>
                                <!-- <div id="user_balance"></div> -->
                            </div>
                            <span style="margin-left: 10px;"><i class="dropdown-toggle"></i></span>

                        </a>
                        <div class="crypt-mega-dropdown-menu-block">
                            <div class="crypt-market-status">
                                <div>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
                                            <div class="drop-menu-item">
                                                @if(!$verify)
                                                    <li class="list-unstyled mb-3"><button class="btn btn-sm btn-success" onclick="verifyID()">Verify ID</button></li>
                                                @endif
                                                <li><a href="{{ route('home') }}">Dashboard</a></li>
                                                <li><a href="{{ route('profile') }}">Profile</a></li>
                                                @if($is_admin)
                                                    <li><a href="{{ url('admin') }}">Admin</a></li>
                                                @endif

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <li class="crypt-box-menu"><a href="#" onclick="OnLogOut()">{{ __('Logout') }}</a></li>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <i class="menu-toggle pe-7s-menu d-xs-block d-sm-block d-md-none d-sm-none"></i>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="crypt-mobile-menu">
        <div class="crypt-gross-market-cap" style="display: block">
            <h6>Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="balance_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Profit/Loss&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="pro_loss_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Equity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="equity_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Margin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="margin_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <!-- <h6>Free Margin&nbsp;&nbsp;&nbsp;&nbsp;<div id="free_margin_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6> -->
            <h6>Margin Level&nbsp;&nbsp;&nbsp;<div id="margin_level_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
        </div>
        <ul class="crypt-heading-menu">
            @if(!$verify)
                <li class="crypt-box-menu btn btn-success"><a href="#" onclick="verifyID()">Verify ID</a></li>
            @endif
            <li><a href="{{ route('home') }}">Dashboard</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            @if($is_admin)
            <li><a href="{{ url('admin') }}">Admin</a></li>
            @endif
            <li class="crypt-box-menu btn btn-danger"><a href="#" onclick="OnLogOut()">{{ __('Logout') }}</a></li>
        </ul>

    </div>
</header>
<div class="container-fluid">
    <div class="row sm-gutters">
        <div class="col-md-12 col-xl-3 pb-t-2 pb-m-2 pl-3 sidebarMain" style="max-height: 89vh; overflow: hidden; ">

            <div class="crypt-market-status mt-3">
                <!-- <span class="sidebar_open"> &lt; </span>
                <span class="sidebar_close"> &gt; </span> -->
                <div class="main-sidebar crypt-dark text-white sidebarArea">
                    <div class="sidebar-head d-flex align-items-center mb-2">
                        <div class="input-group">
                          <input type="text" class="form-control form-control-sm" placeholder="Search" aria-label="Search" autocomplete="off" id="currencySearch">
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-outline-dark" type="button"><i class="bi bi-search text-light"></i></button>
                          </div>
                        </div>
                    </div>
                    <div class="accordion" id="collapseFavoritePairs">
                        <ul class="nav nav-tabs nav-justified p-1 mb-2" id="collapseFavoritePairsHeadingOne">
                            <li class="nav-item active">
                                <a class="nav-link text-white border-0 p-1 active show" role="button" data-toggle="collapse" data-target="#collapseFavPairs" aria-expanded="false" aria-controls="collapseFavPairs" style="background: transparent;cursor: pointer;">
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i> Favorite Pairs
                                </a>
                            </li>
                        </ul>
                        <div id="collapseFavPairs" class="collapse" aria-labelledby="collapseFavoritePairsHeadingOne" data-parent="#collapseFavoritePairs">
                            <div id="showFavorites"></div>

                        </div>
                    </div>
                    <div class="sidebar-body">
                        <ul class="nav nav-tabs nav-justified p-1 mb-2" role="tablist" id="sidebar-cat">

                            <li class="nav-item active">
                                <a class="nav-link active show" data-toggle="tab" href="#forex">Forex</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#commodities">Commodities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#indices">Indices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#stocks">Stocks</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#metals">Metals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#bonds">Bonds</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#crypto">Crypto</a>
                            </li>

                        </ul>
                        {{-- 67vh --}}
                        <ul class="list-inline d-flex justify-content-around mb-2">
                            <li class="list-inline-item"><span class="border-bottom border-info p-1 pl-3 pr-3">Assets</span></li>
                            <li class="list-inline-item"><span class="border-bottom border-danger ml-5 p-1 pl-3 pr-3">Sell</span></li>
                            <li class="list-inline-item"><span class="border-bottom border-success mr-3 p-1 pl-3 pr-3">Buy</span></li>
                        </ul>
                        <div class="tab-content" style="height: 70vh; overflow: auto;">

                            <div id="forex" class="tab-pane active">
                                <div class="sidebar-listening" id="showforex">

                                </div>
                            </div>
                            <div id="commodities" class="tab-pane fade">
                                <div class="sidebar-listening" id="showcommodities">

                                </div>
                            </div>
                            <div id="indices" class="tab-pane fade">
                                <div class="sidebar-listening" id="showindices">

                                </div>
                            </div>
                            <div id="stocks" class="tab-pane fade">
                                <div class="sidebar-listening" id="showstocks">

                                </div>
                            </div>
                            {{-- <div id="metals" class="tab-pane fade">
                                <div class="sidebar-listening" id="showmetals">

                                </div>
                            </div>
                            <div id="bonds" class="tab-pane fade">
                                <div class="sidebar-listening" id="showbonds">

                                </div>
                            </div> --}}
                            <div id="crypto" class="tab-pane fade">
                                <div class="sidebar-listening">
                                    @php
                                        $ig_cryptos = [
                                            // "CS.D.ETHUSD.CFD.IP",
                                            // "CS.D.ADAUSD.CFD.IP",
                                            // "CS.D.LTCUSD.CFD.IP",
                                            // "CS.D.EOSUSD.CFD.IP",
                                            // "CS.D.NEOUSD.CFD.IP",
                                            // "CS.D.XLMUSD.CFD.IP",
                                            // "CS.D.BCHXBT.CFD.IP",
                                            // "CS.D.ETHXBT.CFD.IP",
                                            // "CS.D.BITCOIN.CFD.IP",
                                            // "CS.D.CRYPTOB10.CFD.IP"
                                        ];
                                    @endphp

                                    @foreach ($ig_cryptos as $ig_crypto)
                                        @php $ig_crypto = explode('.', $ig_crypto)[2]; $ig_crypto_low = strtolower($ig_crypto); @endphp
                                        <div class='d-flex align-items-center justify-content-between sidebar-listening-row' id='cryptoList_{{$ig_crypto_low}}'>
                                            <div class='d-flex align-items-center'>
                                                <img src='/landingAssets/images/0-circle.svg' id='star_image_{{$ig_crypto_low}}' style='width: 15px; height: 15px;'/>
                                                <h6 class='pl-3 m-0' style='cursor: pointer;' onclick='showCryptoChart(1, "{{$ig_crypto}}", "crypto")'>
                                                    <span id='cryptoTradingPairShow_{{$ig_crypto_low}}'>{{$ig_crypto}}</span>
                                                </h6>
                                                <span class="ml-3" style="cursor: pointer;"><i class="fa fa-star text-warning"></i></span>
                                            </div>
                                            <div class='btn-group' role="group" style='width:50%'>
                                                <button class='sell-toggle btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#sellModalCrypto' onclick='showSellModalCrypto("{{$ig_crypto}}", "crypto")'>
                                                    <span>SELL</span>
                                                    <span id='crypto_sell_{{$ig_crypto_low}}'>0</span>
                                                </button>
                                                <button class='buy-toggle btn btn-sm btn-outline-success' data-toggle='modal' data-target='#buyModalCrypto' onclick='showBuyModalCrypto(1, "crypto")'>
                                                    <span>BUY</span>
                                                    <span id='crypto_buy_{{$ig_crypto_low}}'>0</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="sidebar-listening" id="showcrypto">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-9 pb-t-2 pb-m-2 pl-0" style="max-height: 89vh;overflow: hidden;">
            <div class="row">
                <div class="col-md-12 col-xl-12 pb-t-2 pb-m-2 pr-4 chartArea">
                    <div class="tradingview-widget-container m-3" style="height: 65vh">
                        <div id="crypt-candle-chart"></div>
                    </div>
                    <span class="right_sidebar_open rounded-pill bg-primary" style="display: none">TRENDING</span>
                    <span class="right_sidebar_close rounded-pill bg-primary" style="display: inline">TRENDING</span>
                </div>
                <div class="col-md-12 pb-t-2 pb-m-2 rightsidebarMain">
                    <div class="crypt-market-status mt-3">
                        <div class="rightsidebarArea" style="display: none">
                            <ul class="nav nav-tabs">
                                <li role="presentation"><a href="#news" class="active" data-toggle="tab">TRENDING PAIRS</a></li>
                                <!-- <li role="presentation"><a href="#calendar" data-toggle="tab">Calendar</a></li> -->
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" style="height: 63vh; overflow: auto; background-color: #131a33">
                                    <table class="table table-striped" id="tradeHistory">
                                        <thead>
                                            <tr>
                                                <th scope="col">ASSET</th>
                                                <th scope="col">QUANTITY</th>
                                                <th scope="col">POSSITION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order as $order)
                                            <tr>
                                                <td>{{$order->base_symbol}}/{{$order->quote_symbol}}</td>
                                                <td>{{$order->trade_amount}}</td>
                                                <td class="crypt-{{$order->type=='buy'?'up':'down'}}">{{$order->type=='buy'?'BUY':'SELL'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="calendar">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Time</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Volume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000564</td>
                                                <td>6.6768876</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-down">0.000056</td>
                                                <td>5.3424984</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000567</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000567</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000564</td>
                                                <td>6.6768876</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-down">0.000056</td>
                                                <td>5.3424984</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000567</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000567</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000564</td>
                                                <td>6.6768876</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-down">0.000056</td>
                                                <td>5.3424984</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td>0.0000567</td>
                                                <td>4.3456600</td>
                                            </tr>
                                            <tr>
                                                <td>22:35:59</td>
                                                <td class="crypt-up">0.0000234</td>
                                                <td>4.3456600</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-xl-12 bottomsidebarMain" style="height: 20vh; overflow: auto;">
                        <div class="">
                            <div class="crypt-market-status custom-market-status">
                                <span class="bottom_sidebar_open"></span>
                                <span class="bottom_sidebar_close"></span>
                                <div class="bottomsidebarArea">
                                    <ul class="nav nav-tabs">
                                        <li role="presentation"><a href="#trades" class="active" data-toggle="tab">All Positions <i class="bi bi-x"></i></a></li>
                                        <li role="presentation"><a href="#opened" data-toggle="tab">Opened Positions <i class="bi bi-x"></i></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="trades">
                                            <table class="table table-striped" id="order_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">TICKET</th>
                                                        <th scope="col">OPEN TIME</th>
                                                        <th scope="col">TYPES</th>
                                                        <th scope="col">UNITS</th>
                                                        <th scope="col">INSTRUMENT</th>
                                                        <th scope="col">OPEN RATE</th>
                                                        <th scope="col">MARKET RATE</th>
                                                        <th scope="col">PROFIT/LOSS</th>
                                                        <th scope="col">TAKE/PROFIT</th>
                                                        <th scope="col">STOP/LOSS</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
        
                                                </tbody>
                                            </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="opened">
                                            <table class="table table-striped" id="opend_order_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">TICKET</th>
                                                        <th scope="col">OPEN TIME</th>
                                                        <th scope="col">TYPES</th>
                                                        <th scope="col">UNITS</th>
                                                        <th scope="col">INSTRUMENT</th>
                                                        <th scope="col">OPEN RATE</th>
                                                        <th scope="col">MARKET RATE</th>
                                                        <th scope="col">PROFIT/LOSS</th>
                                                        <th scope="col">TAKE/PROFIT</th>
                                                        <th scope="col">STOP/LOSS</th>
                                                        <th scope="col">STATUS</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
        
                                                </tbody>
                                            </table>
                                            <!-- <div class="no-orders text-center"><img src="{{asset('landingAssets/images/empty.png')}}" alt="no-orders"></div> -->
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

<div class="show-toast-left-top"></div>
<div class="show-toast-left-bottom"></div>
<div class="show-toast-right-top"></div>
<div class="show-toast-right-bottom"></div>

<footer class="footer">
    <div class="footer-content">
        <div class="kr-footer">
            <div class="kr-footer-contact">
                <p class="copy-right-text">© 2022 {{$app_settings['app_title']??''}}. All Rights Reserved. </p>
            </div>
        </div>
        <div class="kr-footer">
            <div class="kr-footer-contact">
                <div class="btn-group" role="group" aria-label="Contact Footer Buttons">
                    <button type="button" class="btn btn-sm btn-link text-white" data-toggle="modal" data-target="#privacyModal">Privacy Policy</button>
                    <button type="button" class="btn btn-sm btn-link text-white" data-toggle="modal" data-target="#termsModal">Terms &amp; Conditions</button>
                    <button type="button" class="btn btn-sm btn-link text-white" data-toggle="modal" data-target="#contactModal">Contact Us</button>
                    {{-- <button type="button" class="btn btn-sm btn-link text-white" data-toggle="modal" data-target="#aboutModal">About Us</button> --}}
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="control_btn" class="control_btn">
    <div class="btn-group" role="group">
        <button type="button" class="mv-icon btn btn-sm" style="width: auto;cursor: move;color: white;">
            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-danger float-sell-button" onclick="showSellModal_()" disabled>
            <span>SELL</span>
            <span id="sell_val_drag_btn">0.00</span>
        </button>
        <button type="button" class="btn btn-sm btn-success float-buy-button" onclick="showBuyModal_()" disabled>
            <span>BUY</span>
            <span id="buy_val_drag_btn">0.00</span>
        </button>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="sellModalForex">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="bid_price_forex" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="bid_pair_forex">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="bid_trading_rate_forex">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    @if ($forexLotsSwitch == 'on')
                        <label class="w-25 mr-2" for="bid_amount_forex" style="font-size: 1.1rem;">Select Amount</label>
                        <select class="form-control w-25" id="bid_amount_forex">
                            <option value="0" selected>0</option>
                            @if ($forexLotsList)
                                @php
                                $forexLotsList = explode(';', $forexLotsList);
                                @endphp
                                @foreach ($forexLotsList as $lot)
                                    <option value="{{trim($lot)}}">{{trim($lot)}}</option>
                                @endforeach
                            @endif
                        </select>
                    @else
                        <div class="modal-quantity-input w-100">
                            <input type="number" value="0" id="bid_amount_forex" autocomplete="off" />
                            <span class="quantity-currency"></span>
                        </div>
                        <div class="bid_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                        <div class="bid_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_sell_forex">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_sell_forex" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_sell_forex">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_sell_forex">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-bid-forex">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_profit_switch_forex" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_profit_amount_forex" /></div>
                            <div class="bid_profit_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_profit_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-bid-forex">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_loss_switch_forex" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_loss_amount_forex" /></div>
                            <div class="bid_loss_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_loss_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-sell-btn" data-dismiss="modal" onclick="sellAction('forex', 'forex')">Sell</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="buyModalForex">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="ask_price_forex" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="ask_pair_forex">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="ask_trading_rate_forex">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    @if ($forexLotsSwitch == 'on')
                        <label class="w-25 mr-2" for="ask_amount" style="font-size: 1.1rem;">Select Amount</label>
                        <select class="form-control w-25" id="ask_amount_forex">
                            <option value="0" selected>0</option>
                            @if ($forexLotsList && is_array($forexLotsList))
                                @foreach ($forexLotsList as $lot)
                                    <option value="{{trim($lot)}}">{{trim($lot)}}</option>
                                @endforeach
                            @endif
                        </select>
                    @else
                        <div class="modal-quantity-input w-100">
                            <input type="number" value="0" id="ask_amount_forex" autocomplete="off"/>
                            <span class="quantity-currency"></span>
                        </div>
                        <div class="ask_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                        <div class="ask_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_buy_forex">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_buy_forex" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_buy_forex">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_buy_forex">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-asc-forex">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_profit_switch_forex" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_profit_amount_forex" /></div>
                            <div class="ask_profit_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_profit_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-asc-forex">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_loss_switch_forex" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_loss_amount_forex" /></div>
                            <div class="ask_loss_minus px-2" modalType="forex"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_loss_plus" modalType="forex"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center toggle-switch-inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-buy-btn" data-dismiss="modal" onclick="buyAction('forex', 'forex')">Buy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="sellModalOther">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="bid_price_other" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="bid_pair_other">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="bid_trading_rate_other">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="bid_amount_other" autocomplete="off" />
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="bid_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="bid_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_sell_other">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_sell_other" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_sell_other">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_sell_other">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-bid-other">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_profit_switch_other" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_profit_amount_other" /></div>
                            <div class="bid_profit_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_profit_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-bid-other">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_loss_switch_other" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_loss_amount_other" /></div>
                            <div class="bid_loss_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_loss_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-sell-btn" data-dismiss="modal" onclick="sellAction('forex', 'other')">Sell</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="buyModalOther">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="ask_price_other" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="ask_pair_other">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="ask_trading_rate_other">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="ask_amount_other" autocomplete="off" />
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="ask_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="ask_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_buy_other">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_buy_other" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_buy_other">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_buy_other">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-ask-other">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_profit_switch_other" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_profit_amount_other" /></div>
                            <div class="ask_profit_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_profit_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-ask-other">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_loss_switch_other" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_loss_amount_other" /></div>
                            <div class="ask_loss_minus px-2" modalType="other"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_loss_plus" modalType="other"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center toggle-switch-inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-buy-btn" data-dismiss="modal" onclick="buyAction('forex', 'other')">Buy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="sellModalStock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="bid_price_stock" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="bid_pair_stock">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="bid_trading_rate_stock">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="bid_amount_stock" autocomplete="off" />
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="bid_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="bid_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_sell_stock">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_sell_stock" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_sell_stock">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_sell_stock">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-bid-stock">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_profit_switch_stock" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_profit_amount_stock" /></div>
                            <div class="bid_profit_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_profit_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-bid-stock">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_loss_switch_stock" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_loss_amount_stock" /></div>
                            <div class="bid_loss_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_loss_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-sell-btn" data-dismiss="modal" onclick="sellAction('stock', 'stock')">Sell</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="buyModalStock">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="ask_price_stock" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="ask_pair_stock">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="ask_trading_rate_stock">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="ask_amount_stock" autocomplete="off" />
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="ask_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="ask_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_buy_stock">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_buy_stock" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_buy_stock">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_buy_stock">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-ask-stock">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_profit_switch_stock" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_profit_amount_stock" /></div>
                            <div class="ask_profit_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_profit_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-ask-stock">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_loss_switch_stock" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_loss_amount_stock" /></div>
                            <div class="ask_loss_minus px-2" modalType="stock"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_loss_plus" modalType="stock"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center toggle-switch-inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-buy-btn" data-dismiss="modal" onclick="buyAction('stock', 'stock')">Buy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="sellModalCrypto">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="bid_price_crypto" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="bid_pair_crypto">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="bid_trading_rate_crypto">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="bid_amount_crypto" autocomplete="off" />
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="bid_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="bid_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_sell_crypto">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_sell_crypto" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_sell_crypto">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_sell_crypto">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-bid-crypto">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_profit_switch_crypto" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_profit_amount_crypto" /></div>
                            <div class="bid_profit_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_profit_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-bid-crypto">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="bid_loss_switch_crypto" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="bid_loss_amount_crypto" /></div>
                            <div class="bid_loss_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="bid_loss_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-sell-btn" data-dismiss="modal" onclick="sellAction('crypto', 'crypto')">Sell</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="buyModalCrypto">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="ask_price_crypto" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <img src="{{asset('landingAssets/images/1-circle.svg')}}" style="width: 30px; height: 30px;" alt="">
                    <div class="px-4">
                        <h4>
                            <div id="ask_pair_crypto">EUR/USD</div>
                        </h4>
                        <div class="d-flex align-items-center" id="ask_trading_rate_crypto">
                            <i class="fa fa-arrow-up" style="font-size: 20px"></i>
                            <span class="px-2">0.00</span>
                            <i class="fa fa-star" style="font-size: 20px; color: #f7614e;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="d-flex align-items-center mb-3">
                    <div class="modal-quantity-input w-100">
                        <input type="number" value="0" id="ask_amount_crypto" autocomplete="off"/>
                        <span class="quantity-currency"></span>
                    </div>
                    <div class="ask_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                    <div class="ask_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div id="initialMargin_buy_crypto">
                        <p>Required margin <br /><span class="theme-color">0.00</span></p>
                    </div>
                    <div id="pipsValue_buy_crypto" class="d-none">
                        <p>PIP Value <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="spreadValue_buy_crypto">
                        <p>Spread <br /> <span class="theme-color">0.00</span></p>
                    </div>
                    <div id="leverageValue_buy_crypto">
                        <p>Leverage <br /> <span class="theme-color">0.00</span></p>
                    </div>
                </div>
                <div class="extra-feature-with-buy-sell">
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-profit-ask-crypto">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_profit_switch_crypto" class="toggle-switch">
                            <div>
                                <h6>Close at profit</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_profit_amount_crypto" /></div>
                            <div class="ask_profit_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_profit_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                    </div>
                    <div class="mb-2 pb-2 toggle-switch-main" id="close-loss-ask-crypto">
                        <div class="d-flex mb-2">
                            <input type="checkbox" id="ask_loss_switch_crypto" class="toggle-switch">
                            <div>
                                <h6>Close at loss</h6>
                                <p class="toggle-switch-outer mb-0">Set a rate to close position at loss</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2 toggle-switch-inner">
                            <div class="modal-quantity-input w-100"><input type="number" value="0" id="ask_loss_amount_crypto" /></div>
                            <div class="ask_loss_minus px-2" modalType="crypto"><i class="fa fa-minus quantity-plus-minus"></i></div>
                            <div class="ask_loss_plus" modalType="crypto"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center toggle-switch-inner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-buy-btn" data-dismiss="modal" onclick="buyAction('crypto', 'crypto')">Buy</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="verifyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id=""></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <div class="px-4">
                        <h4>
                            <div id="ask_pair">Please input personal information.</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="modal-body text-white">
                <form id="verifyID" method="POST" action="{{url('/verifyID')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="extra-feature-with-buy-sell">
                        <div class="mb-2 pb-2 ">
                            <div class="d-flex mb-2">
                                <div>
                                    <h6>First Name:</h6>
                                </div>
                                <input type="test" id="firstName" name="firstName" style="margin-left: 10px; width: 100px">
                                <div style="margin-left: 30px">
                                    <h6>Last Name:</h6>
                                </div>
                                <input type="test" id="lastName" name="lastName" style="margin-left: 10px; width: 100px">
                            </div>
                            <div class="d-flex mb-2">

                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <h6>Address:</h6>
                                </div>
                                <input type="test" id="address" name="address" style="margin-left: 30px; width: 250px">
                            </div>
                            <div class="d-flex mb-2">

                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <h6>Document:</h6>
                                </div>
                                <select id="document_kind" name="document_kind" style="margin-left: 10px">
                                    <option value=""></option>
                                    <option value="Passport">Passport</option>
                                    <option value="ID Card">ID Card</option>
                                    <option value="Driver License">Driver License</option>
                                </select>
                            </div>
                            <div class="d-flex mb-2">

                            </div>
                            <div class="d-flex mb-2">
                                <a class="crypt-box-menu btn btn-danger" style="margin-left: 90px; height: 30px; width:170px; text-align: center; font-size: 17px;" onclick="uploadDocument()">Upload Document</a></li>
                                <input type="file" id="document" style="margin-left: 30px; width: 250px; display: none;" name="document">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-foot px-3 pb-3">
                <button type="button" class="btn btn-secondary w-100 modal-buy-btn" onclick="verifyAction()">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="privacyModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content crypt-dark">

            <div class="modal-head px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="modal-title">Privacy policy</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                {!!$data['privacy_content']??''!!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="termsModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content crypt-dark">

            <div class="modal-head px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body text-white">
                {!!$data['policy_content']??''!!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade buy-sell-modal" id="contactModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">

            <div class="modal-head px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="modal-title">Contact Us</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-white" style="background: transparent"><b>Email: </b>{!!$data['contact_email']??''!!}</li>
                    <li class="list-group-item text-white" style="background: transparent"><b>Phone: </b>{!!$data['contact_phone']??''!!}</li>
                    <li class="list-group-item text-white" style="background: transparent"><b>Address: </b>{!!$data['contact_address']??''!!}</li>
                    <li class="list-group-item text-white" style="background: transparent"><b>License: </b>{!!$data['contact_license']??''!!}</li>
                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="setTakeProfit">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="setTakeProfitInst" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="mb-2 pb-2">
                    <div class="d-flex mb-2">
                        <div>
                            <h6>Close at profit</h6>
                            <p class="mb-0">Set a rate to close position at profit</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="modal-quantity-input w-100"><input type="number" value="1" min="1" id="setTakeProfitVal" /><input type="hidden" id="setTakeProfitId"></div>
                        <div class="set_profit_minus px-2"><i class="fa fa-minus quantity-plus-minus"></i></div>
                        <div class="set_profit_plus"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3 text-center">
                <button type="button" class="btn btn-primary w-50 setTakeProfitAction" data-dismiss="modal">Set Take/Profit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade buy-sell-modal" id="setStopLose">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content crypt-dark">
            <div class="modal-head text-white px-3 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div id="setStopLoseInst" class="h6"></div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="mb-2 pb-2">
                    <div class="d-flex mb-2">
                        <div>
                            <h6>Close at loss</h6>
                            <p class="mb-0">Set a rate to close position at loss</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="modal-quantity-input w-100"><input type="number" value="1" min="1" id="setStopLoseVal" name="setStopLoseVal" /><input type="hidden" id="setStopLoseId"></div>
                        <div class="set_loss_minus px-2"><i class="fa fa-minus quantity-plus-minus"></i></div>
                        <div class="set_loss_plus"><i class="fa fa-plus quantity-plus-minus text-success"></i></div>
                    </div>
                </div>
            </div>
            <div class="modal-foot px-3 pb-3 text-center">
                <button type="button" class="btn btn-primary w-50 setStopLoseAction" data-dismiss="modal">Set Stop/Loss</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">

    @media (max-width:1280px)  {

        .pb-m-1 {
            padding-bottom: 1em;
        }
        .pb-m-2 {
            padding-bottom: 2em;
        }
        .pb-m-3 {
            padding-bottom: 3em;
        }


        .pt-m-1 {
            padding-top: 1em;
        }
        .pt-m-2 {
            padding-top: 2em;
        }
        .pt-m-3 {
            padding-top: 3em;
        }
        #sidebar-cat {
            border: none;
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            z-index: 9999;
        }
        .footer {
            margin: 3em 0em 5em 0em;
        }
        .control_btn {
            position: fixed !important;
            display: inline-block !important;
            right: 0 !important;
            bottom: 8vh !important;
            left: auto !important;
            top: auto !important;
            width: auto !important;
            height: auto !important;
        }
        .mv-icon {
            display: none;
        }

    }
    .sidebar-listening-row .text-danger:hover,
    .sidebar-listening-row .text-success:hover {
        color: #fff !important;
    }
    #showFavorites {
        max-height: 42vh;
        overflow: auto;
    }
    #showFavorites .sidebar-listening-row{
        background-color: #1f2638;
    }
    .show-toast-left-top {
        top: 3em;
        left: 1em;
        position: fixed;
        z-index: 9999;
    }

    .show-toast-left-bottom {
        bottom: 3em;
        left: 1em;
        position: fixed;
        z-index: 9999;
    }

    .show-toast-right-top {
        top: 3em;
        right: 1em;
        position: fixed;
        z-index: 9999;
    }

    .show-toast-right-bottom {
        bottom: 5em;
        right: 1em;
        position: fixed;
        z-index: 9999;
    }
    .buy-toggle span font:hover, .sell-toggle span font:hover {
        color: #fff !important
    }
    .control_btn {
        position: absolute;
        top: 35em;
        left: 40em;
        width: 400px;
        height: 40px;
        z-index: 111;
        display: -webkit-inline-box;
        color: white;
    }
    .control_btn button {
        width: 100px;
    }
    .mv-icon {
        background-color: black;
        border: #d4c3c33d solid 1px;
        width: 25px;
        cursor: move;
    }
    .buy-sell-modal .modal-quantity-input {
        padding: 0px 10px;
        border-radius: 2px;
        background-color: rgb(55, 65, 96);
        position: relative;
    }

    .buy-sell-modal .modal-quantity-input input {
        background-color: transparent;
        border: none;
        width: 100%;
        padding: 11px 0;
        color: #fff;
    }

    .buy-sell-modal .modal-quantity-input input:focus {
        outline: none;
    }

    .buy-sell-modal .modal-quantity-input .quantity-currency {
        position: absolute;
        right: 20px;
        top: 10px;
    }

    .quantity-plus-minus {
        font-size: 20px;
        background-color: rgb(55, 65, 96);
        padding: 10px 15px;
    }

    .toggle-switch {
        display: inline-block;
        padding: 0px;
        outline: none;
        cursor: pointer;
        box-shadow: none;
        appearance: none;
        background-color: rgb(55, 65, 96);
        transition: background-color 0.3s linear 0s;
        position: relative;
        margin-right: 10px;
        font-size: 12px;
        border-radius: 100px;
        width: 27px;
        height: 10px;
        margin-top: 6px;
    }

    .toggle-switch:before {
        position: absolute;
        content: "";
        width: 16px;
        height: 16px;
        top: 50%;
        left: 0px;
        margin: 0px;
        will-change: left, background-color;
        border-radius: 100%;
        background-color: rgb(89, 98, 128);
        transform: translateY(-50%);
        transition: background-color 0.2s linear 0s, left 0.2s linear 0s;
    }

    .toggle-switch:after {
        position: absolute;
        width: 100%;
        height: 100%;
        display: inline-block;
        content: "";
        border-radius: 100px
    }

    .toggle-switch-main {
        border-bottom: 1px solid rgb(89, 98, 128);
    }

    .toggle-switch-active input:before {
        left: 11px;
        background-color: #f7614e;
        opacity: 1
    }

    .toggle-switch-active input:after {
        background-color: #f7614e;
        opacity: 0.75;
    }

    .toggle-switch-inner {
        display: none !important;
    }

    .toggle-switch-active .toggle-switch-inner {
        display: flex !important;
    }

    .toggle-switch-active .toggle-switch-outer {
        display: none;
    }

    .buy-sell-modal .modal-body {
        max-height: 405px;
        overflow: auto;
    }

    .modal-sell-btn {
        background: #f7614e;
        padding: 15px;
        text-transform: uppercase;
    }

    .modal-buy-btn {
        background: #49c279;
        padding: 15px;
        text-transform: uppercase;
    }

    #buyModal .modal-content {
        border: 1px solid #49c279;
    }

    #sellModal .modal-content {
        border: 1px solid #f7614e;
    }

    #verifyModal .modal-content {
        border: 1px solid #f7614e;
    }

    .theme-color {
        color: #f7614e;
    }

    .theme-background {
        background-color: #f7614e;
    }

    .asset-info-main {
        padding: 10px;
        border-radius: 2px;
        background-color: rgb(55, 65, 96);
        position: relative;
    }

    .asset-info-detail {
        display: none;
    }

    .asset-info-main.active+.asset-info-detail {
        display: block;
    }

    .fa-chevron-up {
        display: none;
    }

    .asset-info-main.active .fa-chevron-down {
        display: none;
    }

    .asset-info-main.active .fa-chevron-up {
        display: inline-block;
    }

    /*sidebra css start*/
    .sidebar-search-input {
        position: relative;
        background-color: rgb(65, 76, 108);
        padding: 10px;
        border-radius: 4px;
    }

    .sidebar-search-input input {
        outline: none;
        border: none;
        background-color: transparent;
        color: white;
    }

    .sidebar-search-input input:focus {
        outline: none;
    }

    .sidebar-search-input i {
        position: absolute;
        right: 20px;
        top: 15px;
    }

    .crypt-dark {
        background: #121722;
    }

    .sidebar-position {
        position: relative;
        color: white;
        border: none;
        height: calc(1.5em + .75rem + 10px);
        border-radius: 4px;
        background: url(data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xmlns%3Asvgjs%3D%22http%3A%2F%2Fsvgjs.com%2Fsvgjs%22%20version%3D%221.1%22%20width%3D%22512%22%20height%3D%22512%22%20x%3D%220%22%20y%3D%220%22%20viewBox%3D%220%200%20444.819%20444.819%22%20style%3D%22enable-background%3Anew%200%200%20512%20512%22%20xml%3Aspace%3D%22preserve%22%20class%3D%22%22%3E%3Cg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%09%3Cpath%20d%3D%22M434.252%2C114.203l-21.409-21.416c-7.419-7.04-16.084-10.561-25.975-10.561c-10.095%2C0-18.657%2C3.521-25.7%2C10.561%20%20%20L222.41%2C231.549L83.653%2C92.791c-7.042-7.04-15.606-10.561-25.697-10.561c-9.896%2C0-18.559%2C3.521-25.979%2C10.561l-21.128%2C21.416%20%20%20C3.615%2C121.436%2C0%2C130.099%2C0%2C140.188c0%2C10.277%2C3.619%2C18.842%2C10.848%2C25.693l185.864%2C185.865c6.855%2C7.23%2C15.416%2C10.848%2C25.697%2C10.848%20%20%20c10.088%2C0%2C18.75-3.617%2C25.977-10.848l185.865-185.865c7.043-7.044%2C10.567-15.608%2C10.567-25.693%20%20%20C444.819%2C130.287%2C441.295%2C121.629%2C434.252%2C114.203z%22%20fill%3D%22%23ffffff%22%20data-original%3D%22%23000000%22%20style%3D%22%22%2F%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3Cg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%3C%2Fg%3E%0A%3C%2Fg%3E%3C%2Fsvg%3E) no-repeat right 0.75rem center/14px 20px;
        background-color: rgb(65, 76, 108);
    }

    .sidebar-sort {
        background-color: rgb(65, 76, 108);
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .sidebar-sort i.down {
        display: none;
    }

    .sidebar-sort.active i.up {
        display: none;
    }

    .sidebar-sort.active i.down {
        display: inline-block;
    }

    #sidebar-cat li a {
        padding: .3rem;
        background-color: transparent;
        color: white;
        border: none;
        border-bottom: 4px solid transparent;
        font-size: 12px;
    }

    body #sidebar-cat li {
        padding: 0;
    }

    #sidebar-cat li a.active,
    #sidebar-cat li a:hover {
        border-bottom: 4px solid #f7614e;
    }

    #sidebar-cat {
        border: none;
    }

    .buy-sell-toggle {
        background-color: rgb(65, 76, 108);
        /*padding:6px 0;*/
        border-radius: 2rem;
        line-height: 1.2;
        cursor: pointer;
    }

    .buy-sell-toggle div span:last-child {
        font-size: 15px;
    }

    .buy-sell-toggle .sell-toggle:hover {
        background: #dc354542;
        border-radius: 2rem;
    }

    .buy-sell-toggle .buy-toggle:hover {
        background: #28a7454d;
        border-radius: 2rem;
    }

    .sidebar-listening-row {
        width: 100%;
        position: relative;
        overflow: hidden;
        padding: 5px 15px;
        margin-bottom: 5px;
        border-radius: 2px;
        box-shadow: rgba(18, 18, 18, 0.12) 0px 4px 4px;
        background-color: #1f2638;
    }

    .sidebar-listening-row.active:after {
        position: absolute;
        display: block;
        content: "";
        height: 100%;
        width: 8px;
        top: 0px;
        left: 0px;
        background: rgb(232, 132, 47);
    }

    .crypt-market-status.custom-market-status ul.nav-tabs li a.active {
        background-color: #1f2638;
        color: white;
    }

    .crypt-market-status.custom-market-status ul.nav-tabs li {
        padding: 0;
    }

    .crypt-market-status.custom-market-status ul.nav-tabs {
        padding: 0;
        background-color: #121722;
    }

    .crypt-market-status.custom-market-status ul.nav-tabs li a {
        background-color: #121722;
        display: inline-block;
        padding: 10px;
        color: #ffffffbf;
        text-transform: unset;
    }

    .crypt-market-status.custom-market-status ul.nav-tabs li a i {
        padding-left: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #888;
    }

    .crypt-market-status.custom-market-status .tab-content table thead tr {
        background-color: 1c222d !important;
    }

    .crypt-market-status.custom-market-status table td,
    table th {
        padding: 0.75rem .25rem !important;
    }

    .crypt-market-status.custom-market-status .tab-content table {
        background-color: #121722;
    }
    #tradeHistory td {
        padding: 0.5rem;
    }
    .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .75;
        border-radius: .2rem;
    }
</style>
<script>
    //Make the DIV element draggagle:
    dragElement(document.getElementById("control_btn"));

    function dragElement(elmnt) {
        var pos1 = 0,
            pos2 = 0,
            pos3 = 0,
            pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            var p = document.querySelector(".tradingview-widget-container");
            if (p) {
                var left = p.getBoundingClientRect().left;
                var top = p.getBoundingClientRect().top;
                var width = p.clientWidth;
                var height = p.clientHeight;
            }
            // set the element's new position:
            if (elmnt.offsetTop - pos2 < top) {
                elmnt.style.top = top + "px";
            } else if (elmnt.offsetTop - pos2 > (top + height - 40)) {
                elmnt.style.top = (top + height - 40) + "px";
            } else {
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            }
            if (elmnt.offsetLeft - pos1 < left) {
                elmnt.style.left = left + "px";
            } else if (elmnt.offsetLeft - pos1 > (left + width - 300)) {
                elmnt.style.left = (left + width - 300) + "px";
            } else {
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    function Focus_input() {
        document.getElementById("trading_amount").focus();
    }

    function scrollTo(element) {
        window.scroll({
            behavior: 'smooth',
            left: 0,
            top: element.offsetTop
        });
    }

    function OnLogOut() {
        document.getElementById('logout-form').submit();
    }

    function onSidebar(e) {
        // document.querySelectorAll('#sidebarListening > div.active').forEach(function(item) {
        //     item.classList.remove('active');
        //   })
        //     // mark as active selected menu item
        //     this.classList.add("active");
    }
    var onSidebarr = document.querySelectorAll(".sidebar-listening-row");
    for (var i = 0; i < onSidebarr.length; i++) {
        onSidebarr[i].addEventListener('click', function(e) {
            onSidebarr.forEach(node => {
                node.classList.remove('active');
            });
            this.classList.add("active");
        });
    }
    // document.querySelector(".buy-sell-toggle").addEventListener('click', function(event){
    //     event.stopPropagation();
    // });
</script>



@endsection