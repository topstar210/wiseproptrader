'use strict';

var base_url = window.location.origin;
var _token = $('meta[name="csrf-token"]').attr('content');

jQuery(document).ready(function() {
    // $.ajax({
    //     type: "GET",
    //     enctype: 'multipart/form-data',
    //     url: base_url+'/showForexPair',
    //     data: {},

    //     success: function (data) {

    //     },
    //     error: function (e) {
    //         console.log(e);
    //     }
    // });

    $('body').on('click', '#saveFrontPaymentsLinks', function (e) {
        e.preventDefault();
        let btn1Visa = $('#btn1Visa').val();
        let btn1MasterCard = $('#btn1MasterCard').val();
        let btn1New = $('#btn1New').val();
        let btn1VisaCrypt = $('#btn1VisaCrypt').val();
        let btn1MasterCardCrypt = $('#btn1MasterCardCrypt').val();
        let btn1NewCrypt = $('#btn1NewCrypt').val();
        let post_url = base_url +"/super_manager/saveFrontPaymentButtons";
        let form_data = {
            btn1Visa,
            btn1MasterCard,
            btn1New,
            btn1VisaCrypt,
            btn1MasterCardCrypt,
            btn1NewCrypt,
            _token: _token
        };
        $.ajax({
                url: post_url,
                type: 'POST',
                async: true,
                data: form_data
            })
            .done(function (response) {
                var content = "";
                var heading = response.result;
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            })
            .fail(function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText
                console.log(errorMessage);
            });
    });
});

function saveClientchanges(user_id) {
    var user_type = $("#user_type_" + user_id).val();
    var user_manager = $("#user_manager_" + user_id).val();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateClient',
        data: { user_id: user_id, user_type: user_type, user_manager: user_manager },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "Done!";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);

            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function saveManagerchange(id) {
    var manager_type = $("#manager_type_" + id).val();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateManager',
        data: { id: id, manager_type: manager_type },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "Done!";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function showClientdetail(id) {
    location.href = base_url + '/super_manager/showClientDetail/' + id;
}

function deleteClient(user_id) {
    if(confirm("Are you sure you want to delete this user?")){
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: base_url + '/super_manager/deleteClient',
            data: { user_id: user_id },

            success: function(data) {
                $.notific8('zindex', 11500);
                if (data.res == 'ok') {
                    $.notific8(
                        $.trim(data.message),
                        {
                            theme: 'teal',
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: "Deleted successfully!",
                            life: 5000,
                        }
                    );
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $.notific8(
                        $.trim(data.message),
                        {
                            theme: 'ebony',
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: "Not Deleted!",
                            life: 5000,
                        }
                    );
                }

            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function addFunds(id) {
    var currency = $("#fundCurrency").val();
    var type = $("#fundType").val();
    var amount = $("#fundAmount").val();
    if (!isNaN(amount)) {
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: base_url + '/super_manager/addFund',
            data: { id: id, currency: currency, type: type, amount: amount },

            success: function(data) {
                if (data.res == 'ok') {
                    var content = "Done successfully!";
                    var heading = "Fund added!";
                    var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                    var settings = {
                            theme: theme[1],
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: heading,
                            life: 5000,
                        },
                        $button = $(this);
                    $.notific8('zindex', 11500);
                    $.notific8($.trim(content), settings);

                    $button.attr('disabled', 'disabled');

                    setTimeout(function() {
                        $button.removeAttr('disabled');
                    }, 1000);
                } else {
                    var content = "Invalid!";
                    var heading = "Fund required " + data.res + " !";
                    var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                    var settings = {
                            theme: theme[4],
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: heading,
                            life: 5000,
                        },
                        $button = $(this);
                    $.notific8('zindex', 11500);
                    $.notific8($.trim(content), settings);

                    $button.attr('disabled', 'disabled');

                    setTimeout(function() {
                        $button.removeAttr('disabled');
                    }, 1000);
                }

            },
            error: function(e) {
                console.log(e);
            }
        });
    } else {
        alert('Invalid amount!');
    }
}

function updateRave() {
    var publicKey = $("#rave_public").val();
    var secretKey = $("#rave_secret").val();
    var environment = $("#rave_env").val();
    var rave_real_switch = $('.bootstrap-switch-id-rave_switch').hasClass('bootstrap-switch-on');
    var rave_demo_switch = $('.bootstrap-switch-id-sandbox_switch').hasClass('bootstrap-switch-on');
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updatePaymentGateway/rave',
        data: { publicKey: publicKey, secretKey: secretKey, environment: environment, rave_real_switch: rave_real_switch, rave_demo_switch: rave_demo_switch },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Payment gateway Information Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updatePaypal() {
    var client_id = $("#client_id").val();
    var secretKey = $("#secretKey").val();
    var paypal_switch = $('.bootstrap-switch-id-paypal_switch').hasClass('bootstrap-switch-on');
    var paypal_real_switch = $('.bootstrap-switch-id-paypal_real_switch').hasClass('bootstrap-switch-on');
    if (paypal_switch) {
        paypal_switch = "live";
    } else {
        paypal_switch = 'sandbox';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updatePaymentGateway/paypal',
        data: { client_id, secretKey, paypal_switch, paypal_real_switch },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Payment gateway Information Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updatebridgerPay() {
    var cashier_key = $("#cashier_key").val();
    var api_key = $("#api_key").val();
    var bridgerPay_switch = $('.bootstrap-switch-id-bridgerPay_switch').hasClass('bootstrap-switch-on');
    if (bridgerPay_switch) {
        bridgerPay_switch = "live";
    } else {
        bridgerPay_switch = 'sandbox';
    }
    var bridgerPay_real_switch = $('.bootstrap-switch-id-bridgerPay_real_switch').hasClass('bootstrap-switch-on');
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updatePaymentGateway/bridgerPay',
        data: { cashier_key, api_key, bridgerPay_switch, bridgerPay_real_switch },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Payment gateway Information Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateStopout() {
    var stopout = $("#stopout").val();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/stopout',
        data: { stopout: stopout },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "StopOut Level Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateForexSpread() {
    var stopout = $("#stopout").val();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/stopout',
        data: { stopout: stopout },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "StopOut Level Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateForexAPI() {
    var oandaApiKey = $("#oanda_api_key").val();
    var oandaAccountNumber = $("#oanda_account_number").val();
    var oanda2_api_key = $("#oanda2_api_key").val();
    var oanda2_account_number = $("#oanda2_account_number").val();
    var apiKey = $("#forex_api").val();
    var account = $("#forex_account").val();
    var trade_switch = $('.bootstrap-switch-id-forex_switch').hasClass('bootstrap-switch-on');
    if (trade_switch) {
        trade_switch = "on";
    } else {
        trade_switch = 'off';
    }
    var forexLotsList = $("#forexLotsList").val();
    var forexLotsSwitch = $('.bootstrap-switch-id-forexLotsSwitch').hasClass('bootstrap-switch-on');
    if (forexLotsSwitch) {
        forexLotsSwitch = "on";
    } else {
        forexLotsSwitch = 'off';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/forex',
        data: { oandaApiKey, oandaAccountNumber, oanda2_api_key, oanda2_account_number, apiKey: apiKey, account: account, trade_switch: trade_switch, forexLotsList, forexLotsSwitch },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "FOREX Trading API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateCryptoAPI() {
    var apiKey = $("#crypto_api").val();
    var account = $("#crypto_account").val();
    var trade_switch = $('.bootstrap-switch-id-crypto_switch').hasClass('bootstrap-switch-on');
    if (trade_switch) {
        trade_switch = "on";
    } else {
        trade_switch = 'off';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/crypto',
        data: { apiKey: apiKey, account: account, trade_switch: trade_switch },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "Crypto API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateBinanceAPI() {
    var binance_api_key = $("#binance_api_key").val();
    var binance_secret = $("#binance_secret").val();
    var binance_switch = $('.bootstrap-switch-id-binance_switch').hasClass('bootstrap-switch-on');
    if (binance_switch) {
        binance_switch = "on";
    } else {
        binance_switch = 'off';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/binance',
        data: { binance_api_key: binance_api_key, binance_secret: binance_secret, binance_switch: binance_switch },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "Binance API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateCryptocompareAPI() {
    var cryptocompare_api_key = $("#cryptocompare_api_key").val();
    var cryptocompare_switch = $('.bootstrap-switch-id-cryptocompare_switch').hasClass('bootstrap-switch-on');
    if (cryptocompare_switch) {
        cryptocompare_switch = "on";
    } else {
        cryptocompare_switch = 'off';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/cryptocompare',
        data: { cryptocompare_api_key: cryptocompare_api_key, cryptocompare_switch: cryptocompare_switch },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "Cryptocompare API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateFixerioAPI() {
    var fixerio_api_key = $("#fixerio_api_key").val();
    var fixerio_switch = $('.bootstrap-switch-id-fixerio_switch').hasClass('bootstrap-switch-on');
    if (fixerio_switch) {
        fixerio_switch = "on";
    } else {
        fixerio_switch = 'off';
    }
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/fixerio',
        data: { fixerio_api_key: fixerio_api_key, fixerio_switch: fixerio_switch },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "fixer.io API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateIgAPI() {
    var ig_api_key = $("#ig_api_key").val();
    var ig_username = $("#ig_username").val();
    var ig_password = $("#ig_password").val();
    var ig_switch = $('.bootstrap-switch-id-ig_switch').hasClass('bootstrap-switch-on') ? "on" : ig_switch = 'off';
    var ig_switch_crypto = $('.bootstrap-switch-id-ig_switch_crypto').hasClass('bootstrap-switch-on') ? "on" : ig_switch_crypto = 'off';

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTradeSettings/ig',
        data: { ig_api_key, ig_username, ig_password, ig_switch, ig_switch_crypto },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "IG.COM API Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateEmailSetting() {
    var smtp_port = $("#smtp_port").val();
    var smtp_security = $("#smtp_security").val();
    var smtp_host = $("#smtp_host").val();
    var smtp_user = $("#smtp_user").val();
    var smtp_password = $("#smtp_password").val();
    var smtp_sender_name = $("#smtp_sender_name").val();
    var smtp_subject = $("#smtp_subject").val();
    var smtp_switch = $('.bootstrap-switch-id-smtp_switch').hasClass('bootstrap-switch-on');
    if (smtp_switch) {
        smtp_switch = "on";
    } else {
        smtp_switch = 'off';
    }

    var smtp_subject_switch = $('.bootstrap-switch-id-smtp_subject_switch').hasClass('bootstrap-switch-on');
    if (smtp_subject_switch) {
        smtp_subject_switch = "on";
    } else {
        smtp_subject_switch = 'off';
    }

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateEmailSetting',
        data: {
            smtp_port: smtp_port,
            smtp_security: smtp_security,
            smtp_host: smtp_host,
            smtp_user: smtp_user,
            smtp_password: smtp_password,
            smtp_sender_name: smtp_sender_name,
            smtp_subject: smtp_subject,
            smtp_switch: smtp_switch,
            smtp_subject_switch: smtp_subject_switch
        },

        success: function(data) {
            console.log(data.res);
            if (data.res == 'ok') {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateLogoSetting() {
}

function showOpenRateModal(ticket, old_open_rate, status) {
    $("#input_open_rate").val(old_open_rate);
    $("#input_ticket").val(ticket);
    $("#order_status").val(status);
}

function updateOpenRate() {
    var openRate = $("#input_open_rate").val();
    var ticket = $("#input_ticket").val();
    var order_status = $("#order_status").val();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/admin/updateOpenRate',
        data: { openRate: openRate, ticket: ticket, order_status: order_status },

        success: function(data) {
            if (data.res == 'ok') {

                var content = "";
                var heading = "Trading Open Rate Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);

                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateForexLeverage(id, leverage) {
    $("#input_leverage").val(leverage);
    $("#input_id").val(id);
    $("#input_kind").val("forex");
}

function updateCryptoLeverage(id, leverage) {
    $("#input_leverage").val(leverage);
    $("#input_id").val(id);
    $("#input_kind").val("crypto");
}

function updateLeverage() {
    var leverage = $("#input_leverage").val();
    var id = $("#input_id").val();
    var kind = $("#input_kind").val();
    var base_url = window.location.origin;
    if (!isNaN(leverage) && leverage > 0) {
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: base_url + '/super_manager/updateLeverage',
            data: {
                id: id,
                kind: kind,
                leverage: leverage
            },

            success: function(data) {
                if (data.res == 'ok') {
                    var content = "";
                    var heading = "Leverage Updated successfully!";
                    var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                    var settings = {
                            theme: theme[1],
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: heading,
                            life: 5000,
                        },
                        $button = $(this);
                    $.notific8('zindex', 11500);
                    $.notific8($.trim(content), settings);

                    $button.attr('disabled', 'disabled');

                    setTimeout(function() {
                        $button.removeAttr('disabled');
                    }, 1000);

                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }

            },
            error: function(e) {
                console.log(e);
            }
        });
    } else {
        alert('Invalid Leverage amount!');
    }

}

function showIdentify(image_name) {
    $("#identify_image").attr('src', base_url + '/document/' + image_name);
    $("#identify_modal").modal('show');
}

function identifyApprove(id) {
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/admin/identifyProcess',
        data: {
            id: id,
            action: "Approved"
        },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);

                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function identifyDecline(id) {
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/admin/identifyProcess',
        data: {
            id: id,
            action: "Declined"
        },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[2],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);

                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateVerifySetting() {

    var enable_verify = $('.bootstrap-switch-id-enable_verify').hasClass('bootstrap-switch-on');
    if (enable_verify) {
        enable_verify = "on";
    } else {
        enable_verify = 'off';
    }
    var enable_trading = $('.bootstrap-switch-id-enable_trading').hasClass('bootstrap-switch-on');
    if (enable_trading) {
        enable_trading = "on";
    } else {
        enable_trading = 'off';
    }
    var enable_deposit = $('.bootstrap-switch-id-enable_deposit').hasClass('bootstrap-switch-on');
    if (enable_deposit) {
        enable_deposit = "on";
    } else {
        enable_deposit = 'off';
    }
    var enable_withdraw = $('.bootstrap-switch-id-enable_withdraw').hasClass('bootstrap-switch-on');
    if (enable_withdraw) {
        enable_withdraw = "on";
    } else {
        enable_withdraw = 'off';
    }

    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateVerifySetting',
        data: {
            enable_verify: enable_verify,
            enable_trading: enable_trading,
            enable_deposit: enable_deposit,
            enable_withdraw: enable_withdraw
        },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function updateTemplate(fileName) {
    var content = $("#" + fileName + "_content").val();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updateTemplate',
        data: {
            fileName: fileName,
            content: content
        },

        success: function(data) {
            if (data.res == 'ok') {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });
}

function changePassword(id) {
    $("#user_id").val(id);
}

function confirmPassword() {
    var user_id = $("#user_id").val();
    var new_pword = $("#new_pword").val();
    var confirm_pword = $("#confirm_pword").val();
    if (new_pword != confirm_pword) {
        alert('New password does not match with Confirm Password!');
    } else {
        $.ajax({
            type: "get",
            enctype: 'multipart/form-data',
            url: base_url + '/admin/updatePassword',
            data: {
                user_id: user_id,
                new_pword: new_pword
            },

            success: function(data) {
                if (data.res) {
                    var content = "";
                    var heading = "Updated successfully!";
                    var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                    var settings = {
                            theme: theme[1],
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: heading,
                            life: 5000,
                        },
                        $button = $(this);
                    $.notific8('zindex', 11500);
                    $.notific8($.trim(content), settings);

                    $button.attr('disabled', 'disabled');

                    setTimeout(function() {
                        $button.removeAttr('disabled');
                    }, 1000);
                }

            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

function updateCoinSetting() {
    var publicKey = $("#publicKey").val();
    var secretKey = $("#secretKey").val();

    var coinpayment_real_switch = $('.bootstrap-switch-id-coinpayment_real_switch').hasClass('bootstrap-switch-on');
    $.ajax({
        type: "get",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updatePaymentGateway/coinpayment',
        data: { publicKey, secretKey, coinpayment_real_switch },

        success: function(data) {
            if (data.res) {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });

}

function updatePaymentWallSetting() {
    var publicKey = $("#publicKey").val();
    var secretKey = $("#secretKey").val();

    var paymentwall_real_switch = $('.bootstrap-switch-id-paymentwall_real_switch').hasClass('bootstrap-switch-on');
    $.ajax({
        type: "get",
        enctype: 'multipart/form-data',
        url: base_url + '/super_manager/updatePaymentGateway/paymentwall',
        data: { publicKey, secretKey, paymentwall_real_switch },

        success: function(data) {
            if (data.res) {
                var content = "";
                var heading = "Updated successfully!";
                var theme = ['teal', 'amethyst', 'ruby', 'tangerine', 'lemon', 'lime', 'ebony', 'smoke'];
                var settings = {
                        theme: theme[1],
                        sticky: false,
                        horizontalEdge: "top",
                        verticalEdge: "right",
                        heading: heading,
                        life: 5000,
                    },
                    $button = $(this);
                $.notific8('zindex', 11500);
                $.notific8($.trim(content), settings);

                $button.attr('disabled', 'disabled');

                setTimeout(function() {
                    $button.removeAttr('disabled');
                }, 1000);
            }

        },
        error: function(e) {
            console.log(e);
        }
    });

}

function approveWithdraw(id)
{
    $('#withrawDetails'+id).modal('hide');
    Swal.fire({
        title: 'Are you sure that you want to approve it??',
        showCancelButton: true,
        confirmButtonText: 'Yes',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "get",
                enctype: 'multipart/form-data',
                url: base_url + '/admin/approveWithdraw',
                data: {
                    id:id,
                },
                success: function(data) {
                    if (data.res == 'ok') {
                        $(".withdrawAction_"+id).html("Approved");
                        Swal.fire('Approved successfully!', '', 'success');
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
      })
}

function declineWithdraw(id)
{
    $('#withrawDetails'+id).modal('hide');
    Swal.fire({
        title: 'Enter below the reason for declining the request:',
        input: 'textarea',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Decline',
        showLoaderOnConfirm: true,
        preConfirm: async (reason) => {
          try {
                const response = await postData(base_url + '/admin/declineWithdraw', { id: id, reason: reason, _token: _token }, 'POST');
                return response;
            } catch (error) {
                Swal.showValidationMessage(
                    `Request failed: ${error}`
                );
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if ( result.value.res == 'ok') {
            $(".withdrawActionDecline_"+id).html("Declined");
            Swal.fire("Withdraw request declined!")
        }
      })
}

function deleteOrder(orderToken) {
    if(confirm("Are you sure you want to delete this order?")){
        $.ajax({
            type: "GET",
            enctype: 'multipart/form-data',
            url: base_url + '/admin/deleteOrder',
            data: { orderToken: orderToken },

            success: function(data) {
                $.notific8('zindex', 11500);
                if (data.res == 'ok') {
                    $.notific8(
                        $.trim(data.message),
                        {
                            theme: 'teal',
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: "Order deleted successfully!",
                            life: 5000,
                        }
                    );
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    $.notific8(
                        $.trim(data.message),
                        {
                            theme: 'ebony',
                            sticky: false,
                            horizontalEdge: "top",
                            verticalEdge: "right",
                            heading: "Order could not be Deleted!",
                            life: 5000,
                        }
                    );
                }

            },
            error: function(e) {
                console.log(e);
            }
        });
    }
}

async function postData(url = '', data = {}, method = 'GET') {
    // Default options are marked with *
    const response = await fetch(url, {
      method: method, // *GET, POST, PUT, DELETE, etc.
      mode: 'cors', // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: 'follow', // manual, *follow, error
      referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return response.json(); // parses JSON response into native JavaScript objects
}