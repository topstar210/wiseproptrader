@extends('layouts.auth_page')

@section('content')
    @include('dashboard.layouts.topbar')

    @include('dashboard.layouts.sidebar', ['pagename' => 'wiseprop-funding'])

    <link rel="stylesheet" href="/css/dashboard/index.css">
    {{-- main --}}
    <div class="container-fluid">
        <div class="container p-5 client-area">
            <div class="pb-5 text-white">Trader / Wiseprop Funding</div>

            <div class="portlet rounded p-3">
                <div class="headder">
                    <h5>Configure Your Wiseprop Funding</h5>
                    <hr>
                </div>
                <div class="text-left py-3">
                    Choose the Initial Capital and the type of your FTMO Challenge.
                </div>
            </div>


            <div class="row">
                <div class="col-12 mt-5">
                    <h4>Start Wiseprop Funding</h4>
                    <div class="portlet rounded p-3">
                        <h4 class="mb-3 mt-5">Trading Account Currnecy</h4>
                        <div class="row">
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/united-states.png" width="25px" alt="">
                                    <div class="px-2">USD</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/european-union.png" width="25px" alt="">
                                    <div class="px-2">EUR</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/switzerland.png" width="25px" alt="">
                                    <div class="px-2">CHF</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/czech-republic.png" width="25px" alt="">
                                    <div class="px-2">CZK</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/united-kingdom.png" width="25px" alt="">
                                    <div class="px-2">GBP</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <img src="/images/flags/canada.png" width="25px" alt="">
                                    <div class="px-2">CAD</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="mb-3 mt-5">Risk Mode</h4>
                        <div class="row">
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">Normal</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">Aggressive</div>
                                </div>
                            </div>
                        </div>
                        {{-- Account Balance --}}
                        <h4 class="mb-3 mt-5">Account Balance</h4>
                        <div class="row">
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">2500 USD</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">5000 USD</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">10,000 USD</div>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-3 mb-3">
                                <div class="v-card py-2 d-flex justify-content-center align-items-center">
                                    <div class="px-2">25,000 USD</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 class="mb-2 mt-5">Billing Info</h4>
                        <div class="des">Before you start trading for us, we need to know some basic information about
                            you.</div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="person-tab" data-toggle="tab" href="#person" role="tab"
                                    aria-controls="person" aria-selected="true">Person</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="company-tab" data-toggle="tab" href="#company" role="tab"
                                    aria-controls="company" aria-selected="false">Company</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="person" role="tabpanel"
                                aria-labelledby="person-tab">
                                @include('dashboard.components.funding-user', ['flag'=>'0'])
                            </div>
                            <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                                @include('dashboard.components.funding-user', ['flag'=>'1'])
                            </div>
                        </div>
                        <div class="term-period">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms_condition">
                                <label class="form-check-label" for="terms_condition">I declare taht I have read and agree with Terms & Conditions</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="cancellation">
                                <label class="form-check-label" for="cancellation">I declare that I have read and agree with Cancellation & Refund Policy</label>
                            </div>
                        </div>
                        <div class="w-100 text-center py-5">
                            <h2>50 USD</h2>
                            <button class="btn btn-outline-primary mx-auto px-3">Confirm & Proceed to payment</button>
                        </div>
                    </div>
                    {{-- Start Wiseprop Funding --}}
                </div>
            </div>

            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection
