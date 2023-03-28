@extends('layouts.auth_page')

@section('content')
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content crypt-dark">
        <div class="modal-head text-white px-3 pt-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div id=""></div>
                <a href="{{route('profile')}}" class="close text-white" data-dismiss="modal">&times;</a>
            </div>
            <div class="d-flex align-items-center mb-2" style="background-color:#061027">
                <div style="margin: auto;">
                    <font size="+2">Confirm Deposit</font>
                </div>
            </div>
        </div>
        <div class="modal-body text-white">
            <div class='form-row row'>
                <div class='col-xs-12 col-md-4 form-group required'>
                    <label class='control-label'> Deposit Amount</label> <input autocomplete='off' class='form-control' id="bridgerPay_address" type='text' disabled value="{{$data['amount']}}">
                </div>
            </div>
            <script id="" src="{{$data['apiURL']}}" 
            data-cashier-key="{{$data['cashierKey']}}" 
            data-order-id="{{$data['order_id']}}" 
            data-currency="{{$data['currency']}}" 
            data-country="{{$data['country']}}" 
            data-first-name="{{$data['firstname']}}" 
            data-last-name="{{$data['lastname']}}" 
            data-phone="{{$data['phone']}}" 
            data-email="{{$data['email']}}" 
            data-address="{{$data['address']}}"  
            data-state="{{$data['state']}}"  
            data-city="{{$data['city']}}" 
            data-zip-code="{{$data['zip']}}" 
            data-amount="{{$data['amount']}}" 
            data-affiliate-id="" data-tracking-id="" data-platform-id="CU1234" data-single-payment-method="" data-payment-provider="" data-single-payment-provider="" data-dont-skip-single-payment-box="" data-currency-lock="true" data-amount-lock="true" data-direct-payment-method="" data-language="en" data-theme="dark" data-button-mode="modal" data-button-text="Next" data-splash-screen-image-url="" data-validate-inputs-on-focus-out="true" data-save-credit-card-flag-checked-by-default="true" data-always-visible-inputs-for-providers="{ &quot;phone&quot;: [&quot;safaricom&quot;, &quot;skrill&quot;] }"></script>
        </div>
    </div>
</div>

@endsection