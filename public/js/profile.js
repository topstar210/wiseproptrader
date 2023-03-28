'use strict';

$(function() {
    $('#depositWithdrayTabs a').on('click', function (event) {
        let  activeTitle = $(event.target).text();
        $('#sectionTitle').text(activeTitle);
        if (activeTitle == 'Withdraw'){
            $('#avaibleAmountToWithdraw').show();
        } else {
            $('#avaibleAmountToWithdraw').hide();}
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    if (window.location.hash != '') {
        $(window.location.hash + ' a').tab('show');
    }

    $("#paymentwallPaymentForm").on('submit', function (e) {
        e.preventDefault();
        $("#paymentwallPaymentBtn").attr('disabled', true);
        var post_url = "/paymentwall/pay";
        var form_data = new FormData(this);
        $.ajax({
                url: post_url,
                type: 'POST',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false
            })
            .done(function (response) {
                $("#paymentwallPaymentBtn").attr('disabled', false);
                if (response.status == 'success') {
                    $('#paymentWallResponse').html(`<span class="text-success">${response.message} Reloading ...</span>`);
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else if (response.status == 'warning') {
                    $('#paymentWallResponse').html(`<span class="text-warning">${response.message} Redirecting to pending deposits ...</span>`);
                    setTimeout(function() {
                        window.location.href = base_url + "/profile#v-pills-zilliqua-btc-history"
                    }, 5000);
                } else {
                    $('#paymentWallResponse').html(`<span class="text-danger">${response.message}</span>`);
                }
            });
    });
});

function generateReferalCode(length = 5) {
    let referalCode = '';
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
        referalCode += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    $("#referalCode").val(referalCode);
}

function depositAction() {
    let  depositGateway = $('input[name="depositGateway"]:checked').val();
    let  depositAmount = $("#depositAmount").val();
    let  depositCurrency = $("#depositCurrency").val();
    if (depositAmount <= 0 || isNaN(depositAmount)) {
        alert('Invalid amount!');
    } else if (depositGateway == 0) {
        alert('Please choose the payment');
    } else if (depositGateway == 'flutterwave') {
        $("#currency").val(depositCurrency);
        $("#country").val('NG');
        $("#amount").val(depositAmount);
        $("#raveModal").modal('show');

        // $("#paymentForm").submit();
    } else if (depositGateway == 'coinpayment') {
        $("#coinPayAmount").val(depositAmount);
        $("#coinModal").modal('show');
        // $("#CoinpaymentForm").submit();
    } else if (depositGateway == 'paypal') {
        $("#paypal_amount").val(depositAmount);
        $("#PaypalpaymentForm").submit();
    } else if (depositGateway == 'paymentwall') {
        $("#coinPayAmount").val(depositAmount);
        $("#paymentwallModal").modal('show');
        // $("#CoinpaymentForm").submit();
    } else {

        $("#bridgerModal").modal('show');
    }
}

function nextBridgerPay() {
    let  depositAmount = $("#depositAmount").val();
    let  depositCurrency = $("#depositCurrency").val();
    let  country = $("#bridgerPay_country").val();
    let  firstname = $("#bridgerPay_firstname").val();
    let  lastname = $("#bridgerPay_lastname").val();
    let  email = $("#bridgerPay_email").val();
    let  phone = $("#bridgerPay_phone").val();
    let  address = $("#bridgerPay_address").val();
    let  state = $("#bridgerPay_state").val();
    let  city = $("#bridgerPay_city").val();
    let  zip = $("#bridgerPay_zip").val();
    if (country == "") {
        alert('Please select the country!');
    } else if (firstname == "") {
        alert('Please input First Name!');
    } else if (lastname == "") {
        alert('Please input Last Name!');
    } else if (email == "") {
        alert('Please input Email address!');
    } else if (phone == "") {
        alert('Please input Phone Number!');
    } else if (address == "") {
        alert('Please input your Address!');
    } else if (city == "") {
        alert('Please input your City!');
    } else if (zip == "") {
        alert('Please input your Zip code!');
    } else {

        window.location.href = base_url + "/bridgerPay/deposit/" + country + '/' + firstname +
            '/' + lastname +
            '/' + email +
            '/' + phone +
            '/' + address +
            '/' + state +
            '/' + city +
            '/' + zip +
            '/' + depositAmount +
            '/' + depositCurrency;
    }
    // let  cashier_key = $("#cashier_key").val();
    // $("#bridgerModal").modal('hide');

}

function updateProfile() {
    let  name = $("#name").val();
    let  language = $("#language").val();
    let  email = $("#email").val();
    let  tel = $("#tel").val();
    let  birth = $("#birth").val();
    let  country = $("#country").val();
    let  city = $("#city").val();
    let  address = $("#address").val();
    let  zipCode = $("#zipCode").val();
    let  referalCode = $("#referalCode").val();

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/updateProfile',
        data: { name: name, language: language, email: email, tel: tel, birth: birth, country: country, city: city, address: address, zipCode: zipCode, referalCode: referalCode },

        success: function (data) {
            // location.href = base_url + '/profile';
            console.log("ok");
        },
        error: function (e) {
            console.log(e);
            console.log('error');
        }
    });
}

function confirmCoinPay() {
    if ($("#coinPayName").val() == "") {

        $("#coinErrorText").html("Please input Owner's name !!");
        $("#coinErrorMsg").show();
        return false;
    } else if ($("#coinPayEmail").val() == "") {

        $("#coinErrorText").html("Please input Owner's email !!");
        $("#coinErrorMsg").show();
        return false;
    } else {

        $("#coinPayForm").submit();
    }
}

function withdrawPayment() {
    let withdraw_amount = $("#withdraw_amount").val();
    let withdraw_bankaccount = $("#withdraw_bankaccount").val();
    let withdraw_bankaccount_addr = $("#withdraw_bankaccount_addr").val();
    let withdraw_name = $("#withdraw_name").val();
    let withdraw_swift = $("#withdraw_swift").val();
    let withdraw_country = $("#withdraw_country").val();
    if (isNaN(withdraw_amount) || withdraw_amount <= 0) {
        alert("Invalid amount!!!");
    }
    else{
        $('body').append(`
        <div id="withdrawLoadingModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="color: #666" class="modal-title">Loading...</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 style="color: #666">Please wait.</h4>
                    </div>
                </div>
            </div>
        </div>
        `);
        $('#withdrawLoadingModal').modal({backdrop: 'static', keyboard: false}, 'show');
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: base_url + '/withdraw',
            data: { 
                withdraw_amount: withdraw_amount, 
                withdraw_bankaccount: withdraw_bankaccount, 
                withdraw_bankaccount_addr: withdraw_bankaccount_addr, 
                withdraw_name: withdraw_name, 
                withdraw_swift: withdraw_swift, 
                withdraw_country: withdraw_country, 
            },
    
            success: function (data) {
                if (data.back == 'false') {
                    alert('10% profits in 30 days You can withdraw. You may only withdraw 50% of the profits you make in 30 days!!!');
                }
                if (data.res == 'no') {
                    alert('Not enough Balance!!!');
                }
                else{
                    $('#withdrawLoadingModal').modal('hide');
                    alert('Withdraw Requested! Please check yor email to confirm the request!');
                    $('body').append(`
                    <div id="withdrawModal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color: #666" class="modal-title">Withdraw Requested!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h3 style="color: #666">Please check yor email to confirm the request.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                    $('#withdrawModal').modal('show');
                    setTimeout(function() {
                        $('#withdrawModal').modal('hide');
                        $('.nav-pills a[href="#v-pills-zilliqua-btc-history"]').tab('show');
                    }, 3000);
                }
            },
            error: function (e) {
                $('#withdrawLoadingModal').modal('hide');
                $('body').append(`
                <div id="withdrawModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="color: #666" class="modal-title">Server Error!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 style="color: #666">Please report the issue by contacting support.</h3>
                            </div>
                        </div>
                    </div>
                </div>
                `);
                $('#withdrawModal').modal('show');
                console.log(e);
                console.log('error');
            }
        });
    }
}

function copyToClipboard(inputID) {
    let  copyText = document.getElementById(inputID);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    alert("Copied On clipboard");
}


function verifyID() {
    $("#verifyModal").modal("show");
}

function uploadDocument() {
    $("#document").click();
}

function verifyAction() {
    let  firstName = $("#firstName").val();
    let  lastName = $("#lastName").val();
    let  address = $("#address").val();
    let  document_kind = $("#document_kind").val();
    let  document = $("#document")[0].files;
    if (
        firstName == "" ||
        lastName == "" ||
        address == "" ||
        document_kind == "" ||
        document == ""
    ) {
        alert("Please fill all fields out!");
    } else {
        $("#verifyID").submit();
    }
}