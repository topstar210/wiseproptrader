"use strict";
let base_url = window.location.origin;
let trade_currency_id = '';
let trade_currency_kind = "";
let socketData = [];
let fav_pairs = [];
let spread = [];
let forexData = "";
let otherData = "";
let cryptoData = "";
let stockData = "";
let stopout = 20;
let interval_con = "";
let margin = 0;
let balance = 0;
let exchange_rate = 1;
let frontNavigation = {
    goToSection: function (id) {
        $('html, body').animate({
            scrollTop: $(id).offset().top
        }, 500);
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
function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}
function floatWithOutCommas(x) {
    return x.toString().replace(/,/g, "");
}
function fixDashboardHeights(zbrit = 0) {
    let sidebarSearch = document.getElementById('sidebarSearch');
    let collapseFavoritePairs = document.getElementById('collapseFavoritePairs');
    let sidebarPairs = document.getElementById('sidebarPairs');
    sidebarPairs.style.height = `${window.innerHeight - (sidebarSearch.clientHeight + collapseFavoritePairs.clientHeight + 218 + zbrit)}px`;
    sidebarPairs.style.overflow = 'auto';
}
let isMobileOrTablet = function () {
    let check = false;
    (function (a) {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
    })(navigator.userAgent || navigator.vendor || window.opera);
    return check;
};
$('body').append(`
<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: #666" class="modal-title">Market Closed!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="color: #666">Sorry, the market is closed.</h3>
            </div>
        </div>
    </div>
</div>
`);
function showCurrencyList(searchWord) {
    $.ajax({
        type: "GET",
        enctype: "multipart/form-data",
        url: base_url + "/showTradePair",
        data: {},

        success: function (data) {
            let str = "";
            let str_crypto = "";
            let str_stock = "";
            let str_forex = "";
            let str_commodities = "";
            let str_indices = "";
            let str_metals = "";
            let str_bonds = "";
            let forexpair = "";
            let otherpair = "";
            let str_favorites = "";
            let is_favorite = "";
            let crypto_api_type = "oanda";

            forexData = data.forex;
            otherData = data.other;
            cryptoData = data.crypto;
            stockData = data.stock;
            fav_pairs = data.fav_pairs;
            crypto_api_type = data.crypto_api_type;

            for (const [key, element] of Object.entries(forexData)) {
                forexpair = element.base_forex_instruments + element.quote_forex_instruments;
                is_favorite = fav_pairs.includes(forexpair);

                let searchStr = element.name_forex_instruments;
                if (searchStr.search(searchWord) != -1) {
                    str = `
                    <div class='d-flex align-items-center justify-content-between sidebar-listening-row' id='forexList_forex_${
                    key}'>
                        <div class='d-flex align-items-center'>
                            <img src='${base_url}/landingAssets/images/${element.tradeable}-circle.svg' id='star_image_${key}' style='width: 15px; height: 15px;'/>
                            <h6 class='pl-3 m-0' style='cursor: pointer;' onclick='showForexChart("${key}", "${forexpair}", "forex")'>
                                <span id='tradingPairShowForex_${key}'>${element.base_forex_instruments}/${element.quote_forex_instruments}</span>
                            </h6>
                            <span class="mx-3" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="${is_favorite ? 'Remove from' : 'Add to'} Favorites"><i class="fa fa-star text-${is_favorite ? 'success' : 'warning'} ${is_favorite ? 'remove-from' : 'add-to'}-favorite-pairs" instrument="${element.base_forex_instruments}/${element.quote_forex_instruments}"></i></span>
                        </div>
                        <div class='btn-group' role="group" style='width:58%'>
                            <button class='sell-toggle btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#sellModalForex' onclick='showSellModalForex("${key}", "Forex")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                <span id='forex_sell_${key}'>${parseFloat(element.asks.toFixed(5))}</span>
                            </button>
                            <button class='buy-toggle btn btn-sm btn-outline-success' data-toggle='modal' data-target='#buyModalForex' onclick='showBuyModalForex("${key}", "Forex")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                <span id='forex_buy_${key}'>${parseFloat(element.bids.toFixed(5))}</span>
                            </button>
                        </div>
                    </div>`;

                    if (is_favorite) {
                        str_favorites += str;
                    } else if (["commodities", "metals", "bonds"].includes(element.category)) {
                        str_commodities += str;
                    } else if (element.category == "indices") {
                        str_indices += str;
                    } else {
                        str_forex += str;
                    }
                }
            }

            for (const [key, element] of Object.entries(otherData)) {
                otherpair = element.base_forex_instruments + element.quote_forex_instruments;
                is_favorite = fav_pairs.includes(otherpair);

                let searchStr = element.name_forex_instruments;
                if (searchStr.search(searchWord) != -1) {
                    str = `
                    <div class='d-flex align-items-center justify-content-between sidebar-listening-row' id='otherList_other_${
                    key}'>
                        <div class='d-flex align-items-center'>
                            <img src='${base_url}/landingAssets/images/${element.tradeable}-circle.svg' id='star_image_${key}' style='width: 15px; height: 15px;'/>
                            <h6 class='pl-3 m-0' style='cursor: pointer;' onclick='showOtherChart("${key}", "${otherpair}", "other")'>
                                <span id='tradingPairShowOther_${key}'>${element.base_forex_instruments}/${element.quote_forex_instruments}</span>
                            </h6>
                            <span class="mx-3" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="${is_favorite ? 'Remove from' : 'Add to'} Favorites"><i class="fa fa-star text-${is_favorite ? 'success' : 'warning'} ${is_favorite ? 'remove-from' : 'add-to'}-favorite-pairs" instrument="${element.base_forex_instruments}/${element.quote_forex_instruments}"></i></span>
                        </div>
                        <div class='btn-group' role="group" style='width:58%'>
                            <button class='sell-toggle btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#sellModalOther' onclick='showSellModalOther("${key}", "Other")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                <span id='other_sell_${key}'>${parseFloat(element.asks.toFixed(5))}</span>
                            </button>
                            <button class='buy-toggle btn btn-sm btn-outline-success' data-toggle='modal' data-target='#buyModalOther' onclick='showBuyModalOther("${key}", "Other")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                <span id='other_buy_${key}'>${parseFloat(element.bids.toFixed(5))}</span>
                            </button>
                        </div>
                    </div>`;

                    if (is_favorite) {
                        str_favorites += str;
                    } else if (["commodities", "metals", "bonds"].includes(element.category)) {
                        str_commodities += str;
                    } else if (element.category == "indices") {
                        str_indices += str;
                    } else {
                        str_forex += str;
                    }
                }
            }

            let stock_str = "";
            for (const [key, element] of Object.entries(stockData)) {
                is_favorite = fav_pairs.includes(element.base_stock + element.quote_stock);
                let stockpair = element.base_stock;
                if (stockpair.search(searchWord) != -1) {
                    str_stock = `
                        <div class='d-flex align-items-center justify-content-between sidebar-listening-row' id='stockList_${key}'>
                            <div class='d-flex align-items-center'>
                                <img src='${base_url}/landingAssets/images/${element.tradeable}-circle.svg' id='star_image_${key}' style='width: 15px; height: 15px;'/>
                                <h6 class='pl-3 m-0' style='cursor: pointer;' onclick='showStockChart("${key}", "${stockpair}", "stock", "${element.type_stock}")'>
                                    <span id='tradingPairShowStock_${key}'>${element.base_stock}/${element.quote_stock}</span>
                                </h6>
                                <span class="mx-3" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="${is_favorite ? 'Remove from' : 'Add to'} Favorites"><i class="fa fa-star text-${is_favorite ? 'success' : 'warning'} ${is_favorite ? 'remove-from' : 'add-to'}-favorite-pairs" instrument="${element.base_stock}/${element.quote_stock}"></i></span>
                            </div>
                            <div class='btn-group' role="group" style='width:58%'>
                                <button class='sell-toggle btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#sellModalStock' onclick='showSellModalStock("${key}")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                    <span id='stock_sell_${key}'>${parseFloat(element.bids.toFixed(5))}</span>
                                </button>
                                <button class='buy-toggle btn btn-sm btn-outline-success' data-toggle='modal' data-target='#buyModalStock' onclick='showBuyModalStock("${key}")' ${element.tradeable == 0 ? 'disabled="disabled"' : ''}>
                                    <span id='stock_buy_${key}'>${parseFloat(element.asks.toFixed(5))}</span>
                                </button>
                            </div>
                        </div>`;
                    if (is_favorite) {
                        str_favorites += str_stock;
                    } else {
                        stock_str += str_stock;
                    }
                }
            }

            let crypto_str = "";
            for (const [key, element] of Object.entries(cryptoData)) {

                is_favorite = fav_pairs.includes(element.base + element.quote);
                let cryptopair = element.name;
                if (cryptopair.search(searchWord) != -1) {
                    str_crypto = `
                        <div class='d-flex align-items-center justify-content-between sidebar-listening-row' id='cryptoList_${key}'>
                            <div class='d-flex align-items-center'>
                                <img src='${base_url}/landingAssets/images/${element.tradeable}-circle.svg' id='star_image_crypto_${key}' style='width: 15px; height: 15px;'/>
                                <h6 class='pl-3 m-0' style='cursor: pointer;' onclick='showCryptoChart("${key}", "${cryptopair}", "crypto", "${element.type}")'>
                                    <span id='cryptoTradingPairShow_${key}'>${element.base}/${element.quote}</span>
                                </h6>
                                <span class="mx-3" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="${is_favorite ? 'Remove from' : 'Add to'} Favorites"><i class="fa fa-star text-${is_favorite ? 'success' : 'warning'} ${is_favorite ? 'remove-from' : 'add-to'}-favorite-pairs" instrument="${element.base}/${element.quote}"></i></span>
                            </div>
                            <div class='btn-group' role="group" style='width:58%'>
                                <button class='sell-toggle btn btn-sm btn-outline-danger' data-toggle='modal' data-target='#sellModalCrypto' onclick='showSellModalCrypto("${key}")'>
                                    <span id='crypto_sell_${key}'>${parseFloat(element.bids.toFixed(5))}</span>
                                </button>
                                <button class='buy-toggle btn btn-sm btn-outline-success' data-toggle='modal' data-target='#buyModalCrypto' onclick='showBuyModalCrypto("${key}")'>
                                    <span id='crypto_buy_${key}'>${parseFloat(element.asks.toFixed(5))}</span>
                                </button>
                            </div>
                        </div>`;
                    if (is_favorite) {
                        str_favorites += str_crypto;
                    } else {
                        crypto_str += str_crypto;
                    }
                }
            }

            $("#showFavorites").html(str_favorites);
            if (fav_pairs.length > 0) $('#collapseFavPairs').collapse('show');
            $("#showforex").html(str_forex);
            $("#showcommodities").html(str_commodities);
            $("#showindices").html(str_indices);
            // $("#showmetals").html(str_metals);
            // $("#showbonds").html(str_bonds);
            $("#showcrypto").html(crypto_str);
            $("#showstocks").html(stock_str);
            updateBalance();
            let secs = 1
            runWebSocketForex(forexData);
            runWebSocketStock(stockData);;
            //showForexTradingData(forexData, secs);
            showOtherTradingData(otherData, secs);
            //showStockTradingData(stockData, secs);
            if (crypto_api_type == 'oanda') {
                showCryptoTradingData(cryptoData, secs);
            }
        },
        error: function (e) {
            console.log(e);
        },
    })
    .done(function( ) {
        setTimeout(() => {fixDashboardHeights()}, 1000);
    });
}

function sellAction(trade_kind, modalType) {
    let required_margin = $("#initialMargin_sell_"+modalType+" p span").text() * 1;
    let trade_amount = $("#bid_amount_"+modalType).val() * ((modalType == 'forex') ? 1e5 : 1);
    let trade_pair = $("#bid_pair_"+modalType).text();
    let trade_loss_amount = $("#bid_loss_amount_"+modalType).val() * 1;
    let trade_profit_amount = $("#bid_profit_amount_"+modalType).val() * 1;
    let free_margin = $("#free_margin p").text() * 1;
    let trade_profit_switch = false;
    let trade_loss_switch = false;
    if ($("#bid_profit_switch_"+modalType).parent().parent().hasClass("toggle-switch-active")) {
        trade_profit_switch = 1;
    } else {
        trade_profit_switch = 0;
    }

    if ($("#bid_profit_switch_"+modalType).parent().parent().hasClass("toggle-switch-active")) {
        trade_loss_switch = 1;
    } else {
        trade_loss_switch = 0;
    }

    if (trade_amount > 0) {
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/trading/order_trade",
            data: {
                trade_kind: trade_kind,
                type: "sell",
                required_margin: required_margin,
                trade_amount: trade_amount,
                trade_pair: trade_pair,
                trade_profit_amount: trade_profit_amount,
                trade_loss_amount: trade_loss_amount,
                trade_profit_switch: trade_profit_switch,
                trade_loss_switch: trade_loss_switch,
                free_margin: free_margin,
            },

            success: function (data) {
                if (data.res == "ok") {
                    updateBalance();
                    showOrder();
                } else {
                    // window.location.reload();
                    $("#errormsg").html(data.res);
                    $("#showError").css("display", "block");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    } else {
        alert("Invalid amount!");
    }
}

function buyAction(trade_kind, modalType) {
    let required_margin = $("#initialMargin_buy_"+modalType+" p span").text() * 1;
    let trade_amount = $("#ask_amount_"+modalType).val() * ((modalType == 'forex') ? 1e5 : 1);
    let trade_pair = $("#ask_pair_"+modalType).text();
    let trade_loss_amount = $("#ask_loss_amount_"+modalType).val() * 1;
    let trade_profit_amount = $("#ask_profit_amount_"+modalType).val() * 1;
    let free_margin = $("#free_margin p").text() * 1;
    let trade_profit_switch = 0;
    let trade_loss_switch = 0;
    if ($("#ask_profit_switch_"+modalType).parent().parent().hasClass("toggle-switch-active")) {
        trade_profit_switch = 1;
    } else {
        trade_profit_switch = 0;
    }

    if ($("#ask_loss_switch_"+modalType).parent().parent().hasClass("toggle-switch-active")) {
        trade_loss_switch = 1;
    } else {
        trade_loss_switch = 0;
    }

    if (trade_amount > 0) {
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/trading/order_trade",
            data: {
                trade_kind: trade_kind,
                type: "buy",
                required_margin: required_margin,
                trade_amount: trade_amount,
                trade_pair: trade_pair,
                trade_profit_amount: trade_profit_amount,
                trade_loss_amount: trade_loss_amount,
                trade_profit_switch: trade_profit_switch,
                trade_loss_switch: trade_loss_switch,
                free_margin: free_margin,
            },

            success: function (data) {
                if (data.res == "ok") {
                    updateBalance();
                    showOrder();
                } else {
                    // window.location.reload();
                    $("#errormsg").html(data.res);
                    $("#showError").css("display", "block");
                }
            },
            error: function (e) {
                console.log(e);
            },
        });
    } else {
        alert("Invalid amount!");
    }
}

function showOrder() {
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/show_order",
        data: {},

        success: function (data) {
            let res_data = data.data;
            let str = "";
            let str_opened = "";
            let total_pro_loss = [];
            let total_index = [];
            let j = 0;
            let sum_pro_loss = 0;
            if (res_data != "no") {
                for (let i = 0; i < res_data.length; i++) {
                    // console.log(res_data[i])
                    let open_rate = parseFloat(res_data[i].open_rate);
                    let spread = parseFloat(res_data[i].spread);
                    margin += res_data[i].margin;
                    // console.log('margin', margin);
                    let units = parseFloat(res_data[i].trade_amount.toFixed(5));
                    let instrumentsAtr = ( res_data[i].base_symbol + "/" + res_data[i].quote_symbol ).toUpperCase();
                    let instruments = instrumentsAtr;
                    if (res_data[i].kind == 'forex') {
                        instruments = `<span onclick='showForexChart("${res_data[i].base_symbol + "_" + res_data[i].quote_symbol}", "${res_data[i].base_symbol + res_data[i].quote_symbol}", "forex")'>${(res_data[i].base_symbol + "/" + res_data[i].quote_symbol ).toUpperCase()}</span>`;
                    } else if (res_data[i].kind == 'forex') {
                        instruments = `<span onclick='showOtherChart("${res_data[i].base_symbol + "_" + res_data[i].quote_symbol}", "${res_data[i].base_symbol + res_data[i].quote_symbol}", "other")'>${(res_data[i].base_symbol + "/" + res_data[i].quote_symbol ).toUpperCase()}</span>`;
                    } else if (res_data[i].kind == 'stock') {
                        instruments = `<span onclick='showStockChart("${res_data[i].base_symbol + res_data[i].quote_symbol}", "${res_data[i].base_symbol + res_data[i].quote_symbol}", "stock", "STOCK")'>${(res_data[i].base_symbol + "/" + res_data[i].quote_symbol ).toUpperCase()}</span>`;
                    } else if (res_data[i].kind == 'crypto') {
                        instruments = `<span onclick='showCryptoChart("${res_data[i].base_symbol + res_data[i].quote_symbol}", "${res_data[i].base_symbol + res_data[i].quote_symbol}", "crypto", "IG")'>${(res_data[i].base_symbol + "/" + res_data[i].quote_symbol ).toUpperCase()}</span>`;
                    }
                    let status = "";
                    let close = "";
                    let setTakeProfit = "";
                    let setStopLose = "";
                    let market_rate_str = "";
                    let pro_loss_str = "";
                    let market_rate_opened_str = "";
                    let pro_loss_opened_str = "";
                    if (res_data[i].status == "open") {
                        total_index[j++] = i;
                        status = "<span class='text-success'>OPENED</span>";
                        close = `<button class="btn btn-xs btn-outline-danger" onclick="closeOrder(${res_data[i].id})">Close</button>`;
                        if (res_data[i].profit > 0) {
                            setTakeProfit = `<div class="btn-group" role="group"><button class='text-success btn btn-xs btn-outline-primary' disabled>${res_data[i].profit}</button><button class='btn btn-xs btn-outline-primary' data-id="${res_data[i].id}" data-inst="${instrumentsAtr}" data-val="${res_data[i].profit}" data-toggle="modal" data-target="#setTakeProfit">Edit</button></div>`;
                        } else {
                            setTakeProfit = `<button class='btn btn-xs btn-outline-primary' data-id="${res_data[i].id}" data-inst="${instrumentsAtr}" data-toggle="modal" data-target="#setTakeProfit">Set Take/Profit</button>`;
                        }
                        if (res_data[i].loss > 0) {
                            setStopLose = `<div class="btn-group" role="group"><button class='text-danger btn btn-xs btn-outline-primary' disabled>${res_data[i].loss}</span><button class='btn btn-xs btn-outline-primary' data-id="${res_data[i].id}" data-inst="${instrumentsAtr}" data-val="${res_data[i].loss}" data-toggle="modal" data-target="#setStopLose">Edit</button></div>`;
                        } else {
                            setStopLose = `<button class='btn btn-xs btn-outline-primary' data-id="${res_data[i].id}" data-inst="${instrumentsAtr}" data-toggle="modal" data-target="#setStopLose">Set Stop/Loss</button>`;
                        }
                        market_rate_str =
                            "<div id='market_rate_" +
                            res_data[i].id +
                            "'></div>";
                        pro_loss_str =
                            "<div id='profit_loss_" +
                            res_data[i].id +
                            "'></div>";
                        market_rate_opened_str =
                            "<div id='market_rate_opened_" +
                            res_data[i].id +
                            "'></div>";
                        pro_loss_opened_str =
                            "<div id='profit_loss_opened_" +
                            res_data[i].id +
                            "'></div>";
                        function getDataSocket() {
                            let kind = res_data[i].kind;
                            let market_rate = 0;
                            if (kind == 'forex' || kind == 'stock') {
                                let data = { data: {} };
                                if (kind == 'forex'){
                                    data.data = socketData.find((item) => item.key === `${res_data[i].base_symbol.toLowerCase()}_${res_data[i].quote_symbol.toLowerCase()}`);
                                } else if (kind == 'stock') {
                                    data.data = socketData.find((item) => item.key === `${res_data[i].base_symbol.toLowerCase()}`);
                                }
                                if (parseFloat(data.data.bids) == 0.0 || parseFloat(data.data.asks) == 0.0 ) {
                                    console.info('0 data', data.data);
                                    return;
                                }
                                console.log(data)
                                let pro_loss_val = 0;
                                let rate = data.data.asks;
                                // kur ta ndryshosh ndryshoje edhe tek closeOrder, closeAllOrder TradingController.php
                                if (res_data[i].type == "sell") {
                                    market_rate = data.data.bids * 1;
                                //   // pro_loss_val = (market_rate-res_data[i].open_rate)*(-10000);\
                                //   if (kind == 'crypto') {
                                //     pro_loss_val = units * (market_rate - open_rate);
                                //   } else {
                                //     // pro_loss_val = ((1 - market_rate) / open_rate) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                //     pro_loss_val = (market_rate / res_data[i].open_rate - 1) * -res_data[i].leverage * margin;
                                //   }
                                    if (kind == 'forex'){
                                        pro_loss_val = (units * (open_rate - market_rate) / market_rate) + spread;
                                    } else {
                                        pro_loss_val = (units * (open_rate - market_rate) * rate) + spread;
                                    }

                                } else {
                                    market_rate = data.data.asks * 1;
                                //   // pro_loss_val = (market_rate-res_data[i].open_rate)*10000;
                                //     if (kind == 'crypto') {
                                //         pro_loss_val = units * (market_rate - open_rate);
                                //     } else {
                                //         // pro_loss_val = (market_rate / (open_rate - 1)) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                //         pro_loss_val = (market_rate / res_data[i].open_rate - 1) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                //     }
                                    if (kind == 'forex'){
                                        pro_loss_val = (units * (market_rate - open_rate) / market_rate) + spread
                                    } else {
                                        pro_loss_val = (units * (market_rate - open_rate) * rate) + spread;
                                    }

                                }
                                // let pro_loss_val = (res_data[i].close_rate - res_data[i].open_rate)/res_data[i].open_rate*res_data[i].leverage*res_data[i].trade_amount-res_data[i].fee;
                                // let pro_loss_val = (market_rate-res_data[i].open_rate)*10000;

                                if (res_data[i].profit_switch && res_data[i].profit > 0) {
                                    // if (res_data[i].profit <= pro_loss_val) {
                                    if (res_data[i].profit <= market_rate) {
                                        closeOrder(res_data[i].id);
                                    }
                                }
                                if (res_data[i].loss_switch && res_data[i].loss > 0) {
                                    // if ( -1 * res_data[i].loss >= pro_loss_val ) {
                                    if ( res_data[i].loss >= market_rate ) {
                                        closeOrder(res_data[i].id);
                                    }
                                }


                                pro_loss_str = `<span class="text-${(pro_loss_val >= 0) ? 'success' : 'danger'}">${parseFloat(pro_loss_val.toFixed(5))}</span>`;
                                total_pro_loss[i] = pro_loss_val;
                                $("#market_rate_" + res_data[i].id).html(parseFloat(market_rate.toFixed(5)));
                                $("#profit_loss_" + res_data[i].id).html(pro_loss_str);
                                $("#market_rate_opened_" + res_data[i].id).html(parseFloat(market_rate.toFixed(5)));
                                $("#profit_loss_opened_" + res_data[i].id).html(pro_loss_str);
                                sum_pro_loss = 0;
                                for ( let k = 0; k < total_index.length; k++ ) {
                                    if (parseFloat(total_pro_loss[total_index[k]])) {
                                        sum_pro_loss += parseFloat(total_pro_loss[total_index[k]]);
                                    }
                                }

                                let equity = parseFloat((balance * 1 + sum_pro_loss).toFixed(2));
                                let free_margin = equity - margin;
                                free_margin = parseFloat(free_margin.toFixed(2));
                                $("#free_margin").html(
                                    "<p class='crypt-up'>" +
                                        free_margin +
                                        "</p>"
                                );
                                $("#free_margin_mobile").html(
                                    "<p class='crypt-up'>" +
                                        free_margin +
                                        "</p>"
                                );
                                if (equity == 0) {
                                    $("#equity").html(
                                        "<p class='crypt-up'>0.00</p>"
                                    );
                                    $("#equity_mobile").html(
                                        "<p class='crypt-up'>0.00</p>"
                                    );
                                    $("#margin_level").html(
                                        "<p class='crypt-up'>0.00%</p>"
                                    );
                                    $("#margin_level_mobile").html(
                                        "<p class='crypt-up'>0.00%</p>"
                                    );
                                } else if (equity > 0) {
                                    $("#equity").html(
                                        "<p class='crypt-up'>" +
                                            equity +
                                            "</p>"
                                    );
                                    $("#equity_mobile").html(
                                        "<p class='crypt-up'>" +
                                            equity +
                                            "</p>"
                                    );
                                    let margin_level = (margin > 0) ? parseFloat(((equity / margin) * 100).toFixed(2)) : 0;
                                    $("#margin_level").html(
                                        "<p class='crypt-up'>" +
                                            margin_level +
                                            "%</p>"
                                    );
                                    $("#margin_level_mobile").html(
                                        "<p class='crypt-up'>" +
                                            margin_level +
                                            "%</p>"
                                    );
                                    // if ( margin > 0 && margin_level * 1 < stopout * 1 ) {
                                    let stop_level = parseFloat(((margin * stopout) / 100).toFixed(2));
                                    // console.log('margin', margin);
                                    // console.log('equity', equity);
                                    // console.log('stopout', stopout);
                                    // console.log('stop_level', stop_level);
                                    // console.info('in order for orders to close, equity should be smaller than stop_level. stop_level is calculated: (margin * stopout) / 100')
                                    if ( margin > 0 && equity * 1 < stop_level * 1 ) {
                                        if (interval_con != "stop") {
                                            closeAllOrder();
                                        }
                                    }
                                } else {
                                    $("#equity").html(
                                        "<p class='crypt-down'>" +
                                            equity +
                                            "</p>"
                                    );
                                    $("#equity_mobile").html(
                                        "<p class='crypt-down'>" +
                                            equity +
                                            "</p>"
                                    );
                                }
                                sum_pro_loss = parseFloat(sum_pro_loss.toFixed(2));
                                if (sum_pro_loss >= 0) {
                                    $("#pro_loss").html(
                                        "<p class='crypt-up'>" +
                                            sum_pro_loss +
                                            "</p>"
                                    );
                                    $("#pro_loss_mobile").html(
                                        "<p class='crypt-up'>" +
                                            sum_pro_loss +
                                            "</p>"
                                    );
                                } else {
                                    $("#pro_loss").html(
                                        "<p class='crypt-down'>" +
                                            sum_pro_loss +
                                            "</p>"
                                    );
                                    $("#pro_loss_mobile").html(
                                        "<p class='crypt-down'>" +
                                            sum_pro_loss +
                                            "</p>"
                                    );
                                }
                            }
                        }
                        function getData() {
                            let kind = res_data[i].kind;
                            let market_rate = 0;
                            $.ajax({
                                type: "get",
                                enctype: "multipart/form-data",
                                url: base_url + "/trading/getMarketInfo",
                                data: {
                                    kind: kind,
                                    base_symbol: res_data[i].base_symbol,
                                    quote_symbol: res_data[i].quote_symbol,
                                },
                                success: function (data) {
                                    if (parseFloat(data.data.bids) == 0.0 || parseFloat(data.data.asks) == 0.0 ) {
                                        console.info('0 data', data.data);
                                        return;
                                    }
                                    let pro_loss_val = 0;
                                    let rate = data.data.rate;
                                    // kur ta ndryshosh ndryshoje edhe tek closeOrder, closeAllOrder TradingController.php
                                    if (res_data[i].type == "sell") {
                                      market_rate = data.data.bids * 1;
                                    //   // pro_loss_val = (market_rate-res_data[i].open_rate)*(-10000);\
                                    //   if (kind == 'crypto') {
                                    //     pro_loss_val = units * (market_rate - open_rate);
                                    //   } else {
                                    //     // pro_loss_val = ((1 - market_rate) / open_rate) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                    //     pro_loss_val = (market_rate / res_data[i].open_rate - 1) * -res_data[i].leverage * margin;
                                    //   }
                                        if (kind == 'forex') {
                                            pro_loss_val = (units * (open_rate - market_rate) / market_rate) + spread;
                                        } else {
                                            pro_loss_val = (units * (open_rate - market_rate) * rate) + spread;
                                        }

                                    } else {
                                      market_rate = data.data.asks * 1;
                                    //   // pro_loss_val = (market_rate-res_data[i].open_rate)*10000;
                                    //     if (kind == 'crypto') {
                                    //         pro_loss_val = units * (market_rate - open_rate);
                                    //     } else {
                                    //         // pro_loss_val = (market_rate / (open_rate - 1)) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                    //         pro_loss_val = (market_rate / res_data[i].open_rate - 1) * res_data[i].leverage * margin;//res_data[i].trade_amount;
                                    //     }
                                        if (kind == 'forex') {
                                            pro_loss_val = (units * (market_rate - open_rate) / market_rate) + spread;
                                        } else {
                                            pro_loss_val = (units * (market_rate - open_rate) * rate) + spread;
                                        }

                                    }
                                    // let pro_loss_val = (res_data[i].close_rate - res_data[i].open_rate)/res_data[i].open_rate*res_data[i].leverage*res_data[i].trade_amount-res_data[i].fee;
                                    // let pro_loss_val = (market_rate-res_data[i].open_rate)*10000;

                                    if (res_data[i].profit_switch && res_data[i].profit > 0) {
                                        // if (res_data[i].profit <= pro_loss_val) {
                                        if (res_data[i].profit <= market_rate) {
                                            closeOrder(res_data[i].id);
                                        }
                                    }
                                    if (res_data[i].loss_switch && res_data[i].loss > 0) {
                                        // if ( -1 * res_data[i].loss >= pro_loss_val ) {
                                        if ( res_data[i].loss >= market_rate ) {
                                            closeOrder(res_data[i].id);
                                        }
                                    }

                                    pro_loss_str = `<span class="text-${(pro_loss_val >= 0) ? 'success' : 'danger'}">${parseFloat(pro_loss_val.toFixed(5))}</span>`;
                                    total_pro_loss[i] = pro_loss_val;
                                    $("#market_rate_" + res_data[i].id).html(parseFloat(market_rate.toFixed(5)));
                                    $("#profit_loss_" + res_data[i].id).html(pro_loss_str);
                                    $("#market_rate_opened_" + res_data[i].id).html(parseFloat(market_rate.toFixed(5)));
                                    $("#profit_loss_opened_" + res_data[i].id).html(pro_loss_str);
                                    sum_pro_loss = 0;
                                    for ( let k = 0; k < total_index.length; k++ ) {
                                        if (parseFloat(total_pro_loss[total_index[k]])) {
                                            sum_pro_loss += parseFloat(total_pro_loss[total_index[k]]);
                                        }
                                    }

                                    let equity = parseFloat((balance * 1 + sum_pro_loss).toFixed(2));
                                    let free_margin = equity - margin;
                                    free_margin = parseFloat(free_margin.toFixed(2));
                                    $("#free_margin").html(
                                        "<p class='crypt-up'>" +
                                            free_margin +
                                            "</p>"
                                    );
                                    $("#free_margin_mobile").html(
                                        "<p class='crypt-up'>" +
                                            free_margin +
                                            "</p>"
                                    );
                                    if (equity == 0) {
                                        $("#equity").html(
                                            "<p class='crypt-up'>0.00</p>"
                                        );
                                        $("#equity_mobile").html(
                                            "<p class='crypt-up'>0.00</p>"
                                        );
                                        $("#margin_level").html(
                                            "<p class='crypt-up'>0.00%</p>"
                                        );
                                        $("#margin_level_mobile").html(
                                            "<p class='crypt-up'>0.00%</p>"
                                        );
                                    } else if (equity > 0) {
                                        $("#equity").html(
                                            "<p class='crypt-up'>" +
                                                equity +
                                                "</p>"
                                        );
                                        $("#equity_mobile").html(
                                            "<p class='crypt-up'>" +
                                                equity +
                                                "</p>"
                                        );
                                        let margin_level = (margin > 0) ? parseFloat(((equity / margin) * 100).toFixed(2)) : 0;
                                        $("#margin_level").html(
                                            "<p class='crypt-up'>" +
                                                margin_level +
                                                "%</p>"
                                        );
                                        $("#margin_level_mobile").html(
                                            "<p class='crypt-up'>" +
                                                margin_level +
                                                "%</p>"
                                        );
                                        // if ( margin > 0 && margin_level * 1 < stopout * 1 ) {
                                        let stop_level = parseFloat(((margin * stopout) / 100).toFixed(2));
                                        // console.log('margin', margin);
                                        // console.log('equity', equity);
                                        // console.log('stopout', stopout);
                                        // console.log('stop_level', stop_level);
                                        // console.info('in order for orders to close, equity should be smaller than stop_level. stop_level is calculated: (margin * stopout) / 100')
                                        if ( margin > 0 && equity * 1 < stop_level * 1 ) {
                                            if (interval_con != "stop") {
                                                closeAllOrder();
                                            }
                                        }
                                    } else {
                                        $("#equity").html(
                                            "<p class='crypt-down'>" +
                                                equity +
                                                "</p>"
                                        );
                                        $("#equity_mobile").html(
                                            "<p class='crypt-down'>" +
                                                equity +
                                                "</p>"
                                        );
                                    }
                                    sum_pro_loss = parseFloat(sum_pro_loss.toFixed(2));
                                    if (sum_pro_loss >= 0) {
                                        $("#pro_loss").html(
                                            "<p class='crypt-up'>" +
                                                sum_pro_loss +
                                                "</p>"
                                        );
                                        $("#pro_loss_mobile").html(
                                            "<p class='crypt-up'>" +
                                                sum_pro_loss +
                                                "</p>"
                                        );
                                    } else {
                                        $("#pro_loss").html(
                                            "<p class='crypt-down'>" +
                                                sum_pro_loss +
                                                "</p>"
                                        );
                                        $("#pro_loss_mobile").html(
                                            "<p class='crypt-down'>" +
                                                sum_pro_loss +
                                                "</p>"
                                        );
                                    }
                                },
                                error: function (e) {
                                    console.log(e);
                                },
                            });
                        }
                        setInterval(getDataSocket, 100);
                        setInterval(getData, 15000);
                    } else {
                        status = "<span class='text-warning'>CLOSED</span>";
                        close = "";
                        setTakeProfit = `<span class='text-success'>${res_data[i].profit}</span>`;
                        setStopLose = `<span class='text-danger'>${res_data[i].loss}</span>`;
                        market_rate_str = res_data[i].close_rate;
                        if (res_data[i].pro_loss * 1 >= 0) {
                            pro_loss_str =
                                "<font color='green'>" +
                                res_data[i].pro_loss +
                                "</font>";
                        } else {
                            pro_loss_str =
                                "<font color='red'>" +
                                res_data[i].pro_loss +
                                "</font>";
                        }
                    }
                    if (res_data[i].status == "open") {

                        str_opened += `
                        <tr>
                            <td>${res_data[i].type.toUpperCase()}</td>
                            <td>${units}</td>
                            <td>${instruments}</td>
                            <td>${pro_loss_opened_str}</td>
                            <td>${setTakeProfit}</td>
                            <td>${setStopLose}</td>
                            <td>${status}</td>
                            <td>${close}</td>
                        </tr>
                        `;
                    }

                    str += `
                    <tr>
                        <td>${res_data[i].type.toUpperCase()}</td>
                        <td>${units}</td>
                        <td>${instruments}</td>
                        <td>${pro_loss_str}</td>
                        <td>${setTakeProfit}</td>
                        <td>${setStopLose}</td>
                        <td>${status}</td>
                        <td>${close}</td>
                    </tr>
                    `;
                }
                $("#order_table tbody").html(str);
                $("#opend_order_table tbody").html(str_opened);
                scrollToEndRight('.bottomsidebarMain');
            }
        },
        error: function (e) {
            console.log(e);
        },
    });
}

function getMarketinfo(base_symbol, quote_symbol) {
    let res = [];
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/getMarketInfo",
        data: { base_symbol: base_symbol, quote_symbol: quote_symbol },
        success: function (data) {
            res["bids"] = data.data.bids;
            res["asks"] = data.data.asks;
        },
        error: function (e) {
            console.log(e);
        },
    });
    return res;
}

async function getExchangeRate(pair, kind) {
    let rate = 1;
    await $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/getExchangeRate",
        data: { pair, kind },
        success: function (data) {
            rate = data.rate;
        },
        error: function (e) {
            console.log(e);
        },
    });
    return rate;
}

function showSellModalForex(id, type) {
    let leverage = forexData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowForex_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_sell_forex").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((forexData[id].bids - forexData[id].asks) * spread.forex[forexData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_sell_forex").html(
        "<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>"
    );
    $("#bid_price_forex").html(
        "Bid Price:<strong>" + $("#forex_sell_" + id).text() + "</strong>"
    );
    $("#bid_pair_forex").html($("#tradingPairShowForex_" + id).text());
    $("#bid_trading_rate_forex").html($("#tradingStatus_forex_" + id).outerHTML());
    $("#bid_amount_forex").val(0);
}

function showSellModalOther(id, type) {
    let leverage = otherData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowOther_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_sell_other").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((otherData[id].bids - otherData[id].asks) * spread.forex[otherData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_sell_other").html(
        "<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>"
    );
    $("#bid_price_other").html(
        "Bid Price:<strong>" + $("#other_sell_" + id).text() + "</strong>"
    );
    $("#bid_pair_other").html($("#tradingPairShowOther_" + id).text());
    $("#bid_trading_rate_other").html($("#tradingStatus_other_" + id).outerHTML());
    $("#bid_amount_other").val(0);
}

function showSellModalStock(id, type) {
    let leverage = stockData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowStock_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_sell_stock").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((stockData[id].bids - stockData[id].asks) * spread.stock[stockData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_sell_stock").html(
        "<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>"
    );
    $("#bid_price_stock").html(
        "Bid Price:<strong>" + $("#stock_sell_" + id).text() + "</strong>"
    );
    $("#bid_pair_stock").html($("#tradingPairShowStock_" + id).text());
    $("#bid_trading_rate_stock").html($("#tradingStatus_stock_" + id).outerHTML());
    $("#bid_amount_stock").val(0);
}

function showSellModalCrypto(id) {
    let exchange_rate_promise = getExchangeRate($("#cryptoTradingPairShow_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_sell_crypto").html(
        "<p>Spread <br/> <span class='theme-color'>" + (($("#crypto_sell_" + id).text() - $("#crypto_buy_" + id).text()) * spread.crypto[cryptoData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_sell_crypto").html(
        "<p>Leverage <br/> <span class='theme-color'>" + cryptoData[id].leverage + "</span></p>"
    );
    $("#bid_price_crypto").html(
        "Bid Price:<strong>" + $("#crypto_sell_" + id).text() + "</strong>"
    );
    $("#bid_pair_crypto").html($("#cryptoTradingPairShow_" + id).text());
    $("#bid_trading_rate_crypto").html($("#cryptoTradingStatus_" + id).outerHTML());
    $("#bid_amount_crypto").val(0);
}

function showBuyModalForex(id, type) {
    let leverage = forexData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowForex_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_buy_forex").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((forexData[id].bids - forexData[id].asks) * spread.forex[forexData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_buy_forex").html("<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>");
    $("#ask_price_forex").html("Ask Price:<strong>" + $("#forex_buy_" + id).text() + "</strong>" );
    $("#ask_pair_forex").html($("#tradingPairShowForex_" + id).text());
    $("#ask_trading_rate_forex").html($("#tradingStatus_forex_" + id).outerHTML());
    $("#bid_amount_forex").val(0);
}

function showBuyModalOther(id, type) {
    let leverage = otherData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowOther_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_buy_other").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((otherData[id].bids - otherData[id].asks) * spread.forex[otherData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_buy_other").html("<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>");
    $("#ask_price_other").html("Ask Price:<strong>" + $("#other_buy_" + id).text() + "</strong>"
    );
    $("#ask_pair_other").html($("#tradingPairShowOther_" + id).text());
    $("#ask_trading_rate_other").html($("#tradingStatus_other_" + id).outerHTML());
    $("#bid_amount_other").val(0);
}

function showBuyModalStock(id, type) {
    let leverage = stockData[id].leverage;
    let exchange_rate_promise = getExchangeRate($("#tradingPairShowStock_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_buy_stock").html(
        "<p>Spread <br/> <span class='theme-color'>" + ((stockData[id].bids - stockData[id].asks) * spread.stock[stockData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_buy_stock").html("<p>Leverage <br/> <span class='theme-color'>" + leverage + "</span></p>");
    $("#ask_price_stock").html("Ask Price:<strong>" + $("#stock_buy_" + id).text() + "</strong>"
    );
    $("#ask_pair_stock").html($("#tradingPairShowStock_" + id).text());
    $("#ask_trading_rate_stock").html($("#tradingStatus_stock_" + id).outerHTML());
    $("#bid_amount_stock").val(0);
}

function showBuyModalCrypto(id) {
    let exchange_rate_promise = getExchangeRate($("#cryptoTradingPairShow_" + id).text(), 'forex');
    exchange_rate_promise.then(function(value){
        exchange_rate = value;
    });
    $("#spreadValue_buy_crypto").html(
        "<p>Spread <br/> <span class='theme-color'>" + (($("#crypto_sell_" + id).text() - $("#crypto_buy_" + id).text()) * spread.crypto[cryptoData[id].category]).toFixed(5) + "</span></p>"
    );
    $("#leverageValue_buy_crypto").html(
        "<p>Leverage <br/> <span class='theme-color'>" + cryptoData[id].leverage + "</span></p>"
    );
    $("#ask_price_crypto").html(
        "Ask Price:<strong>" + $("#crypto_buy_" + id).text() + "</strong>"
    );
    $("#ask_pair_crypto").html($("#cryptoTradingPairShow_" + id).text());
    $("#ask_trading_rate_crypto").html($("#cryptoTradingStatus_" + id).outerHTML());
    $("#bid_amount_crypto").val(0);
}

function showForexChart(id, forexPair, chart_type) {
    trade_currency_id = id;
    trade_currency_kind = chart_type;

    $("#sell_val_drag_btn").html($("#forex_sell_" + id).text()).parent().attr('disabled', false);
    $("#buy_val_drag_btn").html($("#forex_buy_" + id).text()).parent().attr('disabled', false);
    let symbol = "forex";
    if (chart_type == "") {
        symbol = "FX:" + forexPair;
    } else if (chart_type == "forex") {
        symbol = "OANDA:" + forexPair;
    }

    let thisLStorage = [];
    let lStorage = [];
    thisLStorage[window.AuthUser.id] = symbol;
    lStorage = localStorage.getItem('candle-chart-instrument') ? JSON.parse(localStorage.getItem('candle-chart-instrument')) : thisLStorage;
    lStorage[window.AuthUser.id] = symbol;
    localStorage.setItem('candle-chart-instrument', JSON.stringify(lStorage));
    if (document.getElementById("crypt-candle-chart")) {
        new TradingView.widget({
            autosize: true,
            symbol: symbol,
            interval: "D",
            timezone: "Etc/UTC",
            theme: "Dark",
            style: "1",
            locale: "en",
            toolbar_bg: "rgba(0, 0, 0, 1)",
            enable_publishing: false,
            allow_symbol_change: true,
            container_id: "crypt-candle-chart",
        });
        if (isMobileOrTablet()) frontNavigation.goToSection('#crypt-candle-chart');
    }
    $('#footerMenuTab a[href="#chartPage"]').tab('show');
}

function showOtherChart(id, forexPair, chart_type) {
    trade_currency_id = id;
    trade_currency_kind = chart_type;

    $("#sell_val_drag_btn").html($("#other_sell_" + id).text()).parent().attr('disabled', false);
    $("#buy_val_drag_btn").html($("#other_buy_" + id).text()).parent().attr('disabled', false);
    let symbol = "forex";
    if (chart_type == "") {
        symbol = "FX:" + forexPair;
    } else if (chart_type == "other") {
        symbol = "OANDA:" + forexPair;
    }

    let thisLStorage = [];
    let lStorage = [];
    thisLStorage[window.AuthUser.id] = symbol;
    lStorage = localStorage.getItem('candle-chart-instrument') ? JSON.parse(localStorage.getItem('candle-chart-instrument')) : thisLStorage;
    lStorage[window.AuthUser.id] = symbol;
    localStorage.setItem('candle-chart-instrument', JSON.stringify(lStorage));
    if (document.getElementById("crypt-candle-chart")) {
        new TradingView.widget({
            autosize: true,
            symbol: symbol,
            interval: "D",
            timezone: "Etc/UTC",
            theme: "Dark",
            style: "1",
            locale: "en",
            toolbar_bg: "rgba(0, 0, 0, 1)",
            enable_publishing: false,
            allow_symbol_change: true,
            container_id: "crypt-candle-chart",
        });
        if (isMobileOrTablet()) frontNavigation.goToSection('#crypt-candle-chart');
    }
    $('#footerMenuTab a[href="#chartPage"]').tab('show');
}

function showStockChart(id, stockPair, chart_type) {
    trade_currency_id = id;
    trade_currency_kind = chart_type;

    $("#sell_val_drag_btn").html($("#stock_sell_" + id).text()).parent().attr('disabled', false);
    $("#buy_val_drag_btn").html($("#stock_buy_" + id).text()).parent().attr('disabled', false);
    let symbol = "";
    if (chart_type == "") {
        symbol = "FX:" + stockPair;
    } else if (chart_type == "stock") {
        symbol = stockPair.replace(/US$/, '');
    }

    let thisLStorage = [];
    let lStorage = [];
    thisLStorage[window.AuthUser.id] = symbol;
    lStorage = localStorage.getItem('candle-chart-instrument') ? JSON.parse(localStorage.getItem('candle-chart-instrument')) : thisLStorage;
    lStorage[window.AuthUser.id] = symbol;
    localStorage.setItem('candle-chart-instrument', JSON.stringify(lStorage));
    if (document.getElementById("crypt-candle-chart")) {
        new TradingView.widget({
            autosize: true,
            symbol: symbol,
            interval: "D",
            timezone: "Etc/UTC",
            theme: "Dark",
            style: "1",
            locale: "en",
            toolbar_bg: "rgba(0, 0, 0, 1)",
            enable_publishing: false,
            allow_symbol_change: true,
            container_id: "crypt-candle-chart",
        });
        if (isMobileOrTablet()) frontNavigation.goToSection('#crypt-candle-chart');
    }
    $('#footerMenuTab a[href="#chartPage"]').tab('show');
}

function showCryptoChart(id, cryptoPair, chart_type, cryptoType) {
    trade_currency_id = id;
    trade_currency_kind = chart_type;
    if (cryptoType == 'ig') id = cryptoPair.toLocaleLowerCase();
    $("#sell_val_drag_btn").html($("#crypto_sell_" + id).text()).parent().attr('disabled', false);
    $("#buy_val_drag_btn").html($("#crypto_buy_" + id).text()).parent().attr('disabled', false);
    let symbol = "FX:";
    if (chart_type == "crypto") {
        if (cryptoPair.match('XBT')) {
            symbol = "KRAKEN:" + cryptoPair;
        } else if (cryptoPair == 'BITCOINUSD') {
            symbol = "OANDA:BTCUSD";
        } else {
            symbol = "OANDA:" + cryptoPair;
        }
    }

    let thisLStorage = [];
    let lStorage = [];
    thisLStorage[window.AuthUser.id] = symbol;
    lStorage = localStorage.getItem('candle-chart-instrument') ? JSON.parse(localStorage.getItem('candle-chart-instrument')) : thisLStorage;
    lStorage[window.AuthUser.id] = symbol;
    localStorage.setItem('candle-chart-instrument', JSON.stringify(lStorage));
    if (document.getElementById("crypt-candle-chart")) {
        new TradingView.widget({
            autosize: true,
            symbol: symbol,
            interval: "D",
            timezone: "Etc/UTC",
            theme: "Dark",
            style: "1",
            locale: "en",
            toolbar_bg: "rgba(0, 0, 0, 1)",
            enable_publishing: false,
            allow_symbol_change: true,
            container_id: "crypt-candle-chart",
        });
        if (isMobileOrTablet()) frontNavigation.goToSection('#crypt-candle-chart');
    }
    $('#footerMenuTab a[href="#chartPage"]').tab('show');
}

function showForexTradingData(forexData, secs) {
    let smplForexData = [];

    for (const [key, element] of Object.entries(forexData)) {
        smplForexData.push({key, element});
    }
    let i = 0;
    setInterval(function () {
        let forexPair = smplForexData[i].element.base_forex_instruments + "/" + smplForexData[i].element.quote_forex_instruments;
        let key = smplForexData[i].key;
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/showForexTradingData",
            data: { forexPair: forexPair, id: key },

            success: function (data) {
                if (!data.hasOwnProperty('id'))  return;
                let id = data.id;
                let bids = data.bids;
                let old_bids = $("#forex_sell_" + key).text();
                let asks = data.asks;
                let old_asks = $("#forex_buy_" + key).text();
                let closeoutBid = data.closeoutBid;
                let closeoutAsk = data.closeoutAsk;

                let bid_change_rate =
                    ((bids - closeoutBid) / closeoutBid) * 10000;
                let ask_change_rate =
                    ((asks - closeoutAsk) / closeoutAsk) * 10000;
                let total_change_rate = ((asks - bids) / bids) * 100;
                total_change_rate = parseFloat(total_change_rate.toFixed(5));
                if ((total_change_rate * 1000) % 2 < 1) {
                    total_change_rate = total_change_rate * -1;
                }
                // console.log(total_change_rate * 1000 % 2);
                let forex_change_rate = "";
                if (isNaN(total_change_rate)) {
                    forex_change_rate = "0.00%";
                }
                // console.log("change_rate=>", total_change_rate);

                let tradeable = data.tradeable;
                if (tradeable) {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/1-circle.svg"
                    );
                    $("#forex_sell_" + key).parent().attr('disabled', false);
                    $("#forex_buy_" + key).parent().attr('disabled', false);
                } else {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/0-circle.svg"
                    );
                    $("#forex_sell_" + key).parent().attr('disabled', true);
                    $("#forex_buy_" + key).parent().attr('disabled', true);
                }

                if (bids > old_bids) {
                    $("#forex_sell_" + key).html(
                        "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (bids == old_bids) {
                    $("#forex_sell_" + key).html(
                        "<font color='white'>" + parseFloat(bids.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#forex_sell_" + key).html(
                        "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                if (asks > old_asks) {
                    $("#forex_buy_" + key).html(
                        "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (asks == old_asks) {
                    $("#forex_buy_" + key).html(
                        "<font color='white'>" + parseFloat(asks.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#forex_buy_" + key).html(
                        "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                let diff = (asks - bids) * 1000;
                if (diff > 0) {
                    $("#forex_rate_" + key).html(
                        "<font color='green'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else if (diff == 0) {
                    $("#forex_rate_" + key).html(
                        "<font color=''>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#forex_rate_" + key).html(
                        "<font color='red'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                }
            },
        });

        i++;
        i = i % smplForexData.length;
    }, secs * 1000); // every secs secconds
}

function showOtherTradingData(otherData, secs) {
    let smplOtherData = [];

    for (const [key, element] of Object.entries(otherData)) {
        smplOtherData.push({key, element});
    }
    let i = 0;
    setInterval(function () {
        let forexPair = '';
        if (smplOtherData[i].element.type == 'IG') {
            forexPair = smplOtherData[i].element.base_forex_instruments;
        } else {
            forexPair = smplOtherData[i].element.base_forex_instruments + "/" + smplOtherData[i].element.quote_forex_instruments;
        }
        let key = smplOtherData[i].key;
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/showForexTradingData",
            data: { forexPair: forexPair, id: key },

            success: function (data) {
                if (!data.hasOwnProperty('id'))  return;
                let id = data.id;
                let bids = data.bids;
                let old_bids = $("#other_sell_" + key).text();
                let asks = data.asks;
                let old_asks = $("#other_buy_" + key).text();
                let closeoutBid = data.closeoutBid;
                let closeoutAsk = data.closeoutAsk;

                let bid_change_rate =
                    ((bids - closeoutBid) / closeoutBid) * 10000;
                let ask_change_rate =
                    ((asks - closeoutAsk) / closeoutAsk) * 10000;
                let total_change_rate = ((asks - bids) / bids) * 100;
                total_change_rate = parseFloat(total_change_rate.toFixed(5));
                if ((total_change_rate * 1000) % 2 < 1) {
                    total_change_rate = total_change_rate * -1;
                }
                // console.log(total_change_rate * 1000 % 2);
                let forex_change_rate = "";
                if (isNaN(total_change_rate)) {
                    forex_change_rate = "0.00%";
                }
                // console.log("change_rate=>", total_change_rate);

                let tradeable = data.tradeable;
                if (tradeable) {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/1-circle.svg"
                    );
                    $("#other_sell_" + key).parent().attr('disabled', false);
                    $("#other_buy_" + key).parent().attr('disabled', false);
                } else {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/0-circle.svg"
                    );
                    $("#other_sell_" + key).parent().attr('disabled', true);
                    $("#other_buy_" + key).parent().attr('disabled', true);
                }

                if (bids > old_bids) {
                    $("#other_sell_" + key).html(
                        "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (bids == old_bids) {
                    $("#other_sell_" + key).html(
                        "<font color='white'>" + parseFloat(bids.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#other_sell_" + key).html(
                        "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                if (asks > old_asks) {
                    $("#other_buy_" + key).html(
                        "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (asks == old_asks) {
                    $("#other_buy_" + key).html(
                        "<font color='white'>" + parseFloat(asks.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#other_buy_" + key).html(
                        "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                let diff = (asks - bids) * 1000;
                if (diff > 0) {
                    $("#other_rate_" + key).html(
                        "<font color='green'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else if (diff == 0) {
                    $("#other_rate_" + key).html(
                        "<font color=''>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#other_rate_" + key).html(
                        "<font color='red'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                }
            },
        });

        i++;
        i = i % smplOtherData.length;
    }, secs * 1000); // every secs secconds
}

function showStockTradingData(stockData, secs) {
    let smplStockData = [];

    for (const [key, element] of Object.entries(stockData)) {
        smplStockData.push({key, element});
    }
    let i = 0;
    setInterval(function () {
        let stockPair = smplStockData[i].element.base_stock;
        let key = smplStockData[i].key;
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/showStockTradingData",
            data: { stockPair: stockPair, id: key },

            success: function (data) {
                if (!data.hasOwnProperty('id'))  return;
                let id = data.id;
                let bids = data.bids;
                let old_bids = $("#stock_sell_" + key).text();
                let asks = data.asks;
                let old_asks = $("#stock_buy_" + key).text();
                let closeoutBid = data.closeoutBid;
                let closeoutAsk = data.closeoutAsk;

                let bid_change_rate =
                    ((bids - closeoutBid) / closeoutBid) * 10000;
                let ask_change_rate =
                    ((asks - closeoutAsk) / closeoutAsk) * 10000;
                let total_change_rate = ((asks - bids) / bids) * 100;
                total_change_rate = parseFloat(total_change_rate.toFixed(5));
                if ((total_change_rate * 1000) % 2 < 1) {
                    total_change_rate = total_change_rate * -1;
                }
                // console.log(total_change_rate * 1000 % 2);
                let forex_change_rate = "";
                if (isNaN(total_change_rate)) {
                    forex_change_rate = "0.00%";
                }
                // console.log("change_rate=>", total_change_rate);

                let tradeable = data.tradeable;
                if (tradeable) {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/1-circle.svg"
                    );
                    $("#stock_sell_" + key).parent().attr('disabled', false);
                    $("#stock_buy_" + key).parent().attr('disabled', false);
                } else {
                    $("#star_image_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/0-circle.svg"
                    );
                    $("#stock_sell_" + key).parent().attr('disabled', true);
                    $("#stock_buy_" + key).parent().attr('disabled', true);
                }

                if (bids > old_bids) {
                    $("#stock_sell_" + key).html(
                        "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (bids == old_bids) {
                    $("#stock_sell_" + key).html(
                        "<font color='white'>" + parseFloat(bids.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#stock_sell_" + key).html(
                        "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                if (asks > old_asks) {
                    $("#stock_buy_" + key).html(
                        "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else if (asks == old_asks) {
                    $("#stock_buy_" + key).html(
                        "<font color='white'>" + parseFloat(asks.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#stock_buy_" + key).html(
                        "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                let diff = (asks - bids) * 1000;
                if (diff > 0) {
                    $("#stock_rate_" + key).html(
                        "<font color='green'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else if (diff == 0) {
                    $("#stock_rate_" + key).html(
                        "<font color=''>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                } else {
                    $("#stock_rate_" + key).html(
                        "<font color='red'>" + parseFloat(diff.toFixed(5)) + "</font>"
                    );
                }
            },
        });

        i++;
        i = i % smplStockData.length;
    }, secs * 1000); // every secs secconds
}

function showCryptoTradingData(cryptoData, secs) {
    let smplCryptoData = [];

    for (const [key, element] of Object.entries(cryptoData)) {
        smplCryptoData.push({key, element});
    }

    let i = 0;
    setInterval(function () {
        let cryptoPair = smplCryptoData[i].element.base + "/" + smplCryptoData[i].element.quote;
        let key = smplCryptoData[i].key;
        $.ajax({
            type: "get",
            enctype: "multipart/form-data",
            url: base_url + "/showCryptoTradingData",
            data: { cryptoPair: cryptoPair, id: key },

            success: function (data) {
                let id = data.id;
                let bids = data.bids * 1;
                let asks = data.asks * 1;
                let old_bids = $("#crypto_sell_" + key).text();
                let old_asks = $("#crypto_buy_" + key).text();

                let total_change_rate = ((asks - bids) / bids) * 100;
                total_change_rate = parseFloat(total_change_rate.toFixed(5));
                if ((total_change_rate * 1000) % 2 < 1) {
                    total_change_rate = total_change_rate * -1;
                }
                let crypto_change_rate = "";
                if (isNaN(total_change_rate)) {
                    crypto_change_rate = "0.00%";
                }

                let closeoutBid = data.closeoutBid;
                let closeoutAsk = data.closeoutAsk;
                let tradeable = data.tradeable;
                if (tradeable) {
                    $("#star_image_crypto_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/1-circle.svg"
                    );
                    $("#crypto_sell_" + key).parent().attr('disabled', false);
                    $("#crypto_buy_" + key).parent().attr('disabled', false);
                } else {
                    $("#star_image_crypto_" + key).attr(
                        "src",
                        base_url + "/landingAssets/images/0-circle.svg"
                    );
                    $("#crypto_sell_" + key).parent().attr('disabled', true);
                    $("#crypto_buy_" + key).parent().attr('disabled', true);
                }

                if (total_change_rate > 0) {
                    crypto_change_rate = "<font color='#0f0'>+" + total_change_rate + "%</font>";

                    $("#crypto_sell_" + key).html(
                        "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                }

                if (total_change_rate < 0) {
                    crypto_change_rate = "<font color='#f00'>" + total_change_rate + "%</font>";
                }

                if (total_change_rate == 0) {
                    crypto_change_rate = "<font color='#0f0'>0.00%</font>";
                }

                $("#crypto_change_" + key).html(
                    crypto_change_rate
                );

                if (asks >= old_asks) {
                    $("#crypto_buy_" + key).html(
                        "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else {
                    $("#crypto_buy_" + key).html(
                        "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }

                if (bids >= old_bids) {
                    $("#crypto_sell_" + key).html(
                        "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                    );
                } else {
                    $("#crypto_sell_" + key).html(
                        "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                    );
                }
            },
            error: function (e) {
                // console.log(e.status);
            },
        });
        i++;
        i = i % smplCryptoData.length;
    }, secs * 1000); // every secs secconds
}

function updateBalance() {
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/updateBalance",
        data: {},

        success: function (data) {
            margin = parseFloat(data.margin.toFixed(2));
            balance = parseFloat(data.balance.toFixed(2));
            spread = data.spread;
            let str = `<p class='crypt-up'>${numberWithCommas(parseFloat(data.balance.toFixed(2)))} ${data.userCurrency}</p>`;
            $("#balance").html(str);
            $("#user_balance").html(str);
            $("#balance_mobile").html(str);
            str = "<p class='crypt-up'>" + parseFloat(data.margin.toFixed(2)) + "</p>";
            $("#margin").html(str);
            let equity_str =`<p class='crypt-up'>${parseFloat(data.balance.toFixed(2))}</p>`;
            $("#equity").html(equity_str);
            $("#margin_mobile").html(str);
            let free_margin = data.balance - data.margin;
            $("#free_margin").html(`<p class='crypt-up'>${parseFloat(free_margin.toFixed(2))}</p>`);
            $("#free_margin_profile").html(`${data.userCurrency} ${parseFloat(free_margin.toFixed(2))}`);
        },
        error: function (e) {
            console.log(e);
        },
    });
}

function showSellModal_() {
    if (trade_currency_id != '') {
        switch (trade_currency_kind) {
            case "forex":
                if(!forexData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showSellModalForex(trade_currency_id);
                $("#sellModalForex").modal("show");
                break;
            case "other":
                if(!otherData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showSellModalOther(trade_currency_id);
                $("#sellModalOther").modal("show");
                break;
            case "stock":
                if(!stockData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showSellModalStock(trade_currency_id);
                $("#sellModalStock").modal("show");
                break;
            case "crypto":
                if(!cryptoData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showSellModalCrypto(trade_currency_id);
                $("#sellModalCrypto").modal("show");
                break;

            default:
                break;
        }
    }
}

function showBuyModal_() {
    if (trade_currency_id != '') {
        switch (trade_currency_kind) {
            case "forex":
                if(!forexData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showBuyModalForex(trade_currency_id);
                $("#buyModalForex").modal("show");
                break;
            case "other":
                if(!otherData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showBuyModalOther(trade_currency_id);
                $("#buyModalOther").modal("show");
                break;
            case "stock":
                if(!stockData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showBuyModalStock(trade_currency_id);
                $("#buyModalStock").modal("show");
                break;
            case "crypto":
                if(!cryptoData[trade_currency_id].tradeable) {
                    $('#simpleModal').modal('show');
                    return null;
                }
                showBuyModalCrypto(trade_currency_id);
                $("#buyModalCrypto").modal("show");
                break;

            default:
                break;
        }
    }
}

function getStopout() {
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/getStopout",
        data: {},

        success: function (data) {
            stopout = parseInt(data.stopout);
        },
        error: function (e) {
            console.log(e);
        },
    });
}

function closeOrder(id) {
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/close_order",
        data: { id: id },

        success: function (data) {
            if (data.data === 'ok') {
                // window.location.reload();
                $("#successmsg").html(data.message);
                $("#showSuccess").css("display", "block");
            } else {
                console.log(data.data);
            }
            updateBalance();
            showOrder();
        },
        error: function (e) {
            console.log(e);
        },
    });
}

function closeAllOrder() {
    interval_con = "stop";
    console.log("interval=", interval_con);
    $.ajax({
        type: "get",
        enctype: "multipart/form-data",
        url: base_url + "/trading/closeAllOrder",
        data: {},

        success: function (data) {
            // showOrder();
            // updateBalance();
            window.location.reload();
        },
        error: function (e) {
            console.log(e);
        },
    });
}

function scrollToEndRight(id) {
    if (isMobileOrTablet) {
        let elementWidth = $('html, body ' + id).width();
        let toPosition = $('html, body ' + id).scrollLeft() + elementWidth;
        $('html, body ' + id).animate( { scrollLeft: toPosition }, 300);
    }
};


jQuery(function () {

    function pushToast(type = "info", message = "", x = "right", y = "bottom") {
        let theme;
        let icon;
        let rand = "toast_" + Math.floor(Math.random() * 10000 + 1);
        if (type == "danger") {
            theme = "danger";
            icon = '<i class="uil uil-exclamation-octagon mr-2"></i>';
        } else if (type == "warning") {
            theme = "warning";
            icon = '<i class="uil uil-exclamation-triangle mr-2"></i>';
        } else if (type == "success") {
            theme = "success";
            icon = '<i class="uil uil-thumbs-up mr-2"></i>';
        } else {
            theme = "info";
            icon = '<i class="uil uil-info-circle mr-2"></i>';
        }

        $(`<div id="${rand}" class="toast bg-${theme}" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000" data-animation="true">
                <div class="toast-header">
                    <span class="mr-auto">${icon} ${message}</span>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        `).appendTo(".show-toast-" + x + "-" + y);
        $(`#${rand}`).toast("show");
        // setTimeout(function () {
        //     $(`#${rand}`).remove();
        // }, 10000);
    }
    getStopout();
    showOrder();
    jQuery.fn.outerHTML = function () {
        return jQuery("<div />").append(this.eq(0).clone()).html();
    };
    let searchWord = "";
    let shoPairs = showCurrencyList(searchWord);

    $("#sidebar-cat li>a").on('click', function () {
        if (isMobileOrTablet()) frontNavigation.goToSection($(this).attr('href'));
    });

    $( 'input[class="toggle-switch"]' ).on('click', function() {
        $( this ).parent().parent().toggleClass("toggle-switch-active");
    });

    $("span.sidebar_open").on('click', function () {
        $(".sidebarArea").hide();
        $(this).hide();
        $("span.sidebar_close").show();
        $(".sidebarMain").addClass("expand ");
        $(".chartArea").addClass("expand ");
    });

    $("span.sidebar_close").on('click', function () {
        $(".sidebarArea").show();
        $(this).hide();
        $("span.sidebar_open").show();
        $(".sidebarMain").removeClass("expand ");
        $(".chartArea").removeClass("expand ");
    });

    $("span.right_sidebar_open").on('click', function () {
        $(".rightsidebarArea").hide();
        $(this).hide();
        $("span.right_sidebar_close").show();
        $(".rightsidebarMain").toggleClass('col-xl-3');
        $(".chartArea").addClass("col-xl-12").removeClass('col-xl-9');
    });

    $("span.right_sidebar_close").on('click', function () {
        $(".rightsidebarArea").show();
        $(this).hide();
        $("span.right_sidebar_open").show();
        $(".rightsidebarMain").toggleClass('col-xl-3');
        $(".chartArea").addClass("col-xl-9").removeClass('col-xl-12');
    });

    $("span.bottom_sidebar_open").on('click', function () {
        $(".bottomsidebarArea").hide();
        $(this).hide();
        $("span.bottom_sidebar_close").show();
        $(".bottomsidebarMain").addClass("expand ");
        $(".chartArea").addClass("longer");
        $(".tradingview-widget-container").addClass("expand").height('80vh');
        $("#crypt-candle-chartr").addClass("expand");
    });

    $("span.bottom_sidebar_close").on('click', function () {
        $(".bottomsidebarArea").show();
        $(this).hide();
        $("span.bottom_sidebar_open").show();
        $(".bottomsidebarMain").removeClass("expand ");
        $(".chartArea").removeClass("longer");
        $(".tradingview-widget-container").removeClass("expand").height('65vh');
        $("#crypt-candle-chartr").removeClass("expand");
    });

    $("#bid_amount_forex").on('keyup change', function () {
        let bid_amount_forex = $("#bid_amount_forex").val() * 1e5;
        let bid_open_rate_forex = $("#bid_price_forex strong").text();
        let leverage_sell_forex = $("#leverageValue_sell_forex p span").text() * 1;
        let required_margin_forex = ((bid_open_rate_forex * bid_amount_forex) / leverage_sell_forex) / exchange_rate;
        required_margin_forex = parseFloat(required_margin_forex.toFixed(5));

        let pair_id = $("#bid_pair_forex").text().replace(/\//, "_").toLowerCase();
        $("#spreadValue_sell_forex").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * bid_amount_forex).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_sell_forex").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount_forex + "</span></p>"
        );

        if (required_margin_forex > balance) {
            $("#initialMargin_sell_forex").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_forex} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_forex").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_forex}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#bid_amount_other").on('keyup change', function () {
        let bid_amount = $("#bid_amount_other").val() * 1;
        let bid_open_rate = $("#bid_price_other strong").text();
        let leverage_sell = $("#leverageValue_sell_other p span").text() * 1;
        let required_margin_other = ((bid_open_rate * bid_amount) / leverage_sell) / exchange_rate;
        required_margin_other = parseFloat(required_margin_other.toFixed(5));

        let pair_id = $("#bid_pair_other").text().replace(/\//, "_").toLowerCase();
        $("#spreadValue_sell_other").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_sell_other").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount + "</span></p>"
        );

        if (required_margin_other > balance) {
            $("#initialMargin_sell_other").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_other} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_other").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_other}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#bid_amount_stock").on('keyup change', function () {
        let bid_amount = $("#bid_amount_stock").val() * 1;
        let bid_open_rate = $("#bid_price_stock strong").text();
        let leverage_sell = $("#leverageValue_sell_stock p span").text() * 1;
        let required_margin_stock = ((bid_open_rate * bid_amount) / leverage_sell) / exchange_rate;
        required_margin_stock = parseFloat(required_margin_stock.toFixed(5));

        let pair_id = $("#bid_pair_stock").text().split('/')[0].toLowerCase();
        $("#spreadValue_sell_stock").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_sell_stock").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount + "</span></p>"
        );

        if (required_margin_stock > balance) {
            $("#initialMargin_sell_stock").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_stock} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_stock").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_stock}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#bid_amount_crypto").on('keyup change', function () {
        let bid_amount_crypto = $("#bid_amount_crypto").val() * 1;
        let bid_open_rate_crypto = $("#bid_price_crypto strong").text();
        let leverage_sell_crypto = $("#leverageValue_sell_crypto p span").text() * 1;
        let required_margin_crypto = ((bid_open_rate_crypto * bid_amount_crypto) / leverage_sell_crypto) / exchange_rate;
        required_margin_crypto = parseFloat(required_margin_crypto.toFixed(5));

        let pair_id = $("#bid_pair_crypto").text().replace(/\//, "").toLowerCase();
        let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
        let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
        $("#spreadValue_sell_crypto").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * bid_amount_crypto).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_sell_crypto").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount_crypto + "</span></p>"
        );

        if (required_margin_crypto > balance) {
            $("#initialMargin_sell_crypto").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_crypto} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_crypto").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_crypto}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#ask_amount_forex").on('keyup change', function () {
        let ask_open_rate_forex = $("#ask_price_forex strong").text();
        let leverage_buy_forex = $("#leverageValue_buy_forex p span").text() * 1;
        let ask_amount_forex = $("#ask_amount_forex").val() * 1e5;
        let required_margin_forex = ((ask_open_rate_forex * ask_amount_forex) / leverage_buy_forex) / exchange_rate;
        required_margin_forex = parseFloat(required_margin_forex.toFixed(5));

        let pair_id = $("#ask_pair_forex").text().replace(/\//, "_").toLowerCase();
        $("#spreadValue_buy_forex").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * ask_amount_forex).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_buy_forex").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount_forex + "</span></p>"
        );

        if (required_margin_forex > balance) {
            $("#initialMargin_buy_forex").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_forex} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_forex").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_forex}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#ask_amount_other").on('keyup change', function () {
        let ask_open_rate = $("#ask_price_other strong").text();
        let leverage_buy = $("#leverageValue_buy_other p span").text() * 1;
        let ask_amount = $("#ask_amount_other").val() * 1;
        let required_margin_other = ((ask_open_rate * ask_amount) / leverage_buy) / exchange_rate;
        required_margin_other = parseFloat(required_margin_other.toFixed(5));

        let pair_id = $("#ask_pair_other").text().replace(/\//, "_").toLowerCase();
        $("#spreadValue_buy_other").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_buy_other").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount + "</span></p>"
        );

        if (required_margin_other > balance) {
            $("#initialMargin_buy_other").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_other} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_other").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_other}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#ask_amount_stock").on('keyup change', function () {
        let ask_open_rate = $("#ask_price_stock strong").text();
        let leverage_buy = $("#leverageValue_buy_stock p span").text() * 1;
        let ask_amount = $("#ask_amount_stock").val() * 1;
        let required_margin_stock = ((ask_open_rate * ask_amount) / leverage_buy) / exchange_rate;
        required_margin_stock = parseFloat(required_margin_stock.toFixed(5));

        let pair_id = $("#ask_pair_stock").text().split('/')[0].toLowerCase();
        $("#spreadValue_buy_stock").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_buy_stock").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount + "</span></p>"
        );

        if (required_margin_stock > balance) {
            $("#initialMargin_buy_stock").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_stock} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_stock").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_stock}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $("#ask_amount_crypto").on('keyup change', function () {
        let ask_open_rate_crypto = $("#ask_price_crypto strong").text();
        let ask_amount_crypto = $("#ask_amount_crypto").val() * 1;
        let leverage_buy_crypto = $("#leverageValue_buy_crypto p span").text() * 1;
        let required_margin_crypto = ((ask_open_rate_crypto * ask_amount_crypto) / leverage_buy_crypto) / exchange_rate;
        required_margin_crypto = parseFloat(required_margin_crypto.toFixed(5));

        let pair_id = $("#ask_pair_crypto").text().replace(/\//, "").toLowerCase();
        let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
        let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
        $("#spreadValue_buy_crypto").html(
            "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * ask_amount_crypto).toFixed(5) + "</span></p>"
        );

        $("#pipsValue_buy_crypto").html(
            "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount_crypto + "</span></p>"
        );

        if (required_margin_crypto > balance) {
            $("#initialMargin_buy_crypto").html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin_crypto} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_crypto").html(
                `<p>Required Margin <br/><span class="text-success">${required_margin_crypto}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $(".bid_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_open_rate = $("#bid_price_"+modalType+" strong").text();
        let bid_amount = $("#bid_amount_"+modalType).val() * 1;
        let leverage_sell = $("#leverageValue_sell_"+modalType+" p span").text() * 1;
        if (bid_amount <= 0) {
            bid_amount = 0;
        } else {
            bid_amount--;
        }

        if (modalType == 'forex') {
            let pair_id = $("#bid_pair_forex").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_sell_forex").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'other') {
            let pair_id = $("#bid_pair_other").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_sell_other").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'stock') {
            let pair_id = $("#bid_pair_stock").text().split('/')[0].toLowerCase();
            $("#spreadValue_sell_stock").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'crypto') {
            let pair_id = $("#bid_pair_crypto").text().replace(/\//, "").toLowerCase();
            let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
            let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
            $("#spreadValue_sell_crypto").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        }

        $("#pipsValue_sell_"+modalType).html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount + "</span></p>"
        );
        let required_margin = ((bid_open_rate * bid_amount) / leverage_sell) / exchange_rate;
        required_margin = parseFloat(required_margin.toFixed(5));
        $("#bid_amount_"+modalType).val(bid_amount);

        if (required_margin > balance) {
            $("#initialMargin_sell_"+modalType).html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_"+modalType).html(
                `<p>Required Margin <br/><span class="text-success">${required_margin}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $(".bid_plus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_open_rate = $("#bid_price_"+modalType+" strong").text();
        let bid_amount = $("#bid_amount_"+modalType).val() * 1 + 1;
        let leverage_sell = $("#leverageValue_sell_"+modalType+" p span").text() * 1;

        if (modalType == 'forex') {
            let pair_id = $("#bid_pair_forex").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_sell_forex").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'other') {
            let pair_id = $("#bid_pair_other").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_sell_other").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'stock') {
            let pair_id = $("#bid_pair_stock").text().split('/')[0].toLowerCase();
            $("#spreadValue_sell_stock").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'crypto') {
            let pair_id = $("#bid_pair_crypto").text().replace(/\//, "").toLowerCase();
            let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
            let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
            $("#spreadValue_sell_crypto").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * bid_amount).toFixed(5) + "</span></p>"
            );
        }

        $("#pipsValue_sell_"+modalType).html(
            "<p>PIP Value <br/> <span class='theme-color'>" + bid_amount + "</span></p>"
        );
        let required_margin = ((bid_open_rate * bid_amount) / leverage_sell) / exchange_rate;
        required_margin = parseFloat(required_margin.toFixed(5));
        $("#bid_amount_"+modalType).val(bid_amount);

        if (required_margin > balance) {
            $("#initialMargin_sell_"+modalType).html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_sell_"+modalType).html(
                `<p>Required Margin <br/><span class="text-success">${required_margin}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $(".ask_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let ask_amount = $("#ask_amount_"+modalType).val() * 1;
        if (ask_amount <= 0) {
            ask_amount = 0;
        } else {
            $("#pipsValue_buy_"+modalType).html(
                "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount + "</span></p>"
            );
            ask_amount--;
        }

        if (modalType == 'forex') {
            let pair_id = $("#ask_pair_forex").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_buy_forex").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'other') {
            let pair_id = $("#ask_pair_other").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_buy_other").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'stock') {
            let pair_id = $("#ask_pair_stock").text().split('/')[0].toLowerCase();
            $("#spreadValue_buy_stock").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'crypto') {
            let pair_id = $("#ask_pair_crypto").text().replace(/\//, "").toLowerCase();
            let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
            let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
            $("#spreadValue_buy_crypto").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        }

        let ask_open_rate = $("#ask_price_"+modalType+" strong").text();
        let leverage_buy = $("#leverageValue_buy_"+modalType+" p span").text() * 1;
        let required_margin = ((ask_open_rate * ask_amount) / leverage_buy) / exchange_rate;
        required_margin = parseFloat(required_margin.toFixed(5));
        $("#ask_amount_"+modalType).val(ask_amount);

        if (required_margin > balance) {
            $("#initialMargin_buy_"+modalType).html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_"+modalType).html(
                `<p>Required Margin <br/><span class="text-success">${required_margin}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $(".ask_plus").on("click", function () {
        let modalType = $(this).attr('modalType');
        let ask_amount = $("#ask_amount_"+modalType).val() * 1 + 1;
        let ask_open_rate = $("#ask_price_"+modalType+" strong").text();
        let leverage_buy = $("#leverageValue_buy_"+modalType+" p span").text() * 1;
        let required_margin = ((ask_open_rate * ask_amount) / leverage_buy) / exchange_rate;
        required_margin = parseFloat(required_margin.toFixed(5));

        if (modalType == 'forex') {
            let pair_id = $("#ask_pair_forex").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_buy_forex").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((forexData[pair_id].bids - forexData[pair_id].asks) * spread.forex[forexData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'other') {
            let pair_id = $("#ask_pair_other").text().replace(/\//, "_").toLowerCase();
            $("#spreadValue_buy_other").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((otherData[pair_id].bids - otherData[pair_id].asks) * spread.forex[otherData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'stock') {
            let pair_id = $("#ask_pair_stock").text().split('/')[0].toLowerCase();
            $("#spreadValue_buy_stock").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((stockData[pair_id].bids - stockData[pair_id].asks) * spread.stock[stockData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        } else if (modalType == 'crypto') {
            let pair_id = $("#ask_pair_crypto").text().replace(/\//, "").toLowerCase();
            let crypto_sell_price = $("#crypto_sell_"+pair_id).text();
            let crypto_buy_price = $("#crypto_buy_"+pair_id).text();
            $("#spreadValue_buy_crypto").html(
                "<p>Spread <br/> <span class='theme-color'>" + (((crypto_sell_price - crypto_buy_price) * spread.crypto[cryptoData[pair_id].category] ) * ask_amount).toFixed(5) + "</span></p>"
            );
        }

        $("#pipsValue_buy_"+modalType).html(
            "<p>PIP Value <br/> <span class='theme-color'>" + ask_amount + "</span></p>"
        );
        $("#ask_amount_"+modalType).val(ask_amount);

        if (required_margin > balance) {
            $("#initialMargin_buy_"+modalType).html(
                `<p>Required Margin <br/><span class="text-danger">${required_margin} Require more Balance!</span></p>`
            );
        } else {
            $("#initialMargin_buy_"+modalType).html(
                `<p>Required Margin <br/><span class="text-success">${required_margin}  <i class="fa fa-check"></i></span></p>`
            );
        }
    });

    $(".bid_profit_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_profit_amount = $("#bid_profit_amount_"+modalType).val() * 1;
        if (bid_profit_amount <= 0) {
            bid_profit_amount = 0;
        } else {
            bid_profit_amount--;
        }
        $("#bid_profit_amount_"+modalType).val(bid_profit_amount);
    });

    $(".bid_profit_plus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_profit_amount = $("#bid_profit_amount_"+modalType).val() * 1 + 1;
        $("#bid_profit_amount_"+modalType).val(bid_profit_amount);
    });

    $(".bid_loss_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_loss_amount = $("#bid_loss_amount_"+modalType).val() * 1;
        if (bid_loss_amount <= 0) {
            bid_loss_amount = 0;
        } else {
            bid_loss_amount--;
        }
        $("#bid_loss_amount_"+modalType).val(bid_loss_amount);
    });

    $(".bid_loss_plus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let bid_loss_amount = $("#bid_loss_amount_"+modalType).val() * 1 + 1;
        $("#bid_loss_amount_"+modalType).val(bid_loss_amount);
    });

    $(".ask_profit_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let ask_profit_amount = $("#ask_profit_amount_"+modalType).val() * 1;
        if (ask_profit_amount <= 0) {
            ask_profit_amount = 0;
        } else {
            ask_profit_amount--;
        }
        $("#ask_profit_amount_"+modalType).val(ask_profit_amount);
    });

    $(".ask_profit_plus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let ask_profit_amount = $("#ask_profit_amount_"+modalType).val() * 1 + 1;
        $("#ask_profit_amount_"+modalType).val(ask_profit_amount);
    });

    $(".ask_loss_minus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let ask_loss_amount = $("#ask_loss_amount_"+modalType).val() * 1;
        if (ask_loss_amount <= 0) {
            ask_loss_amount = 0;
        } else {
            ask_loss_amount--;
        }
        $("#ask_loss_amount_"+modalType).val(ask_loss_amount);
    });

    $(".ask_loss_plus").on('click', function () {
        let modalType = $(this).attr('modalType');
        let ask_loss_amount = $("#ask_loss_amount_"+modalType).val() * 1 + 1;
        $("#ask_loss_amount_"+modalType).val(ask_loss_amount);
    });

    $("#currencySearch").on('change', function () {
        let searchWord = $("#currencySearch").val().toUpperCase();
        showCurrencyList(searchWord);
        // for (let i = 0; i < forexData.length; i++) {
        //     let str = forexData[i].name_forex_instruments;
        //     if (str.search(searchWord) == -1) {
        //         console.log(forexData[i].id);
        //         $("#forexList_"+forexData[i].id).hide();
        //     }
        //     else
        //     {
        //         $("#forexList_"+forexData[i].id).show();
        //     }

        // }
    });

    $('body').on('click', '.add-to-favorite-pairs', function () {
        let instrument = $(this).attr('instrument');
        let temp_element = $(this)
                            .removeClass('add-to-favorite-pairs').removeClass('text-warning')
                            .addClass('remove-from-favorite-pairs').addClass('text-success')
                            .parent().attr('title', 'Remove from Favorites')
                            .closest('.sidebar-listening-row');
        let action = 'add';
        let post_url = base_url +"/favorite-pair";
        let form_data = {
            instrument,
            action,
            _token: _csrf_token
        };
        $.ajax({
                url: post_url,
                type: 'POST',
                async: true,
                data: form_data
            })
            .done(function (response) {
                if (response.status == 'success') {
                    $('#showFavorites').append(temp_element);
                    if ($("#showFavorites").html() != '') $('#collapseFavPairs').collapse('show');
                    pushToast('success', response.message);
                } else {
                    pushToast('danger', response.message);
                }
            })
            .fail(function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText
                pushToast('danger', errorMessage);
            });

        location.href = base_url;
    });

    $('body').on('click', '.remove-from-favorite-pairs', function () {
        let instrument = $(this).attr('instrument');
        let temp_element = $(this).closest('.sidebar-listening-row');
        let action = 'remove';
        let post_url = base_url +"/favorite-pair";
        let form_data = {
            instrument,
            action,
            _token: _csrf_token
        };
        $.ajax({
                url: post_url,
                type: 'POST',
                async: true,
                data: form_data
            })
            .done(function (response) {
                if (response.status == 'success') {
                    temp_element.remove();
                    pushToast('success', response.message);
                } else {
                    pushToast('danger', response.message);
                }
            })
            .fail(function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText
                pushToast('danger', errorMessage);
            });

        location.href = base_url;
    });

    $('#setTakeProfit').on('show.bs.modal', function (e) {
        $('#setTakeProfitInst').text($(e.relatedTarget).data('inst'));
        $('#setTakeProfitId').val($(e.relatedTarget).data('id'));
        $('#setTakeProfitVal').val($(e.relatedTarget).data('val'));
    });

    $('#setStopLose').on('show.bs.modal', function (e) {
        $('#setStopLoseInst').text($(e.relatedTarget).data('inst'));
        $('#setStopLoseId').val($(e.relatedTarget).data('id'));
        $('#setStopLoseVal').val($(e.relatedTarget).data('val'));
    });

    $(".set_profit_minus").on('click', function () {
        let val = $("#setTakeProfitVal").val()*1;
        if (val > 1) $("#setTakeProfitVal").val(val-1);
    });

    $(".set_profit_plus").on('click', function () {
        let val = $("#setTakeProfitVal").val()*1;
        $("#setTakeProfitVal").val(val+1);
    });

    $(".set_loss_minus").on('click', function () {
        let val = $("#setStopLoseVal").val()*1;
        if (val > 1) $("#setStopLoseVal").val(val-1);
    });

    $(".set_loss_plus").on('click', function () {
        let val = $("#setStopLoseVal").val()*1;
        $("#setStopLoseVal").val(val+1);
    });

    $('body').on('click', '.setTakeProfitAction', function () {
        let id = $('#setTakeProfitId').val();
        let val = $('#setTakeProfitVal').val();
        let post_url = base_url +"/trading/setTakeProfit";
        let form_data = {
            id,
            val,
            _token: _csrf_token
        };
        $.ajax({
                url: post_url,
                type: 'POST',
                async: true,
                data: form_data
            })
            .done(function (response) {
                if (response.status == 'success') {
                    pushToast('success', response.message);
                } else {
                    pushToast('danger', response.message);
                }
                showOrder();
            })
            .fail(function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText
                pushToast('danger', errorMessage);
            });
    });

    $('body').on('click', '.setStopLoseAction', function () {
        let id = $('#setStopLoseId').val();
        let val = $('#setStopLoseVal').val();
        let post_url = base_url +"/trading/setStopLose";
        let form_data = {
            id,
            val,
            _token: _csrf_token
        };
        $.ajax({
                url: post_url,
                type: 'POST',
                async: true,
                data: form_data
            })
            .done(function (response) {
                if (response.status == 'success') {
                    pushToast('success', response.message);
                } else {
                    pushToast('danger', response.message);
                }
                showOrder();
            })
            .fail(function (xhr, status, error) {
                let errorMessage = xhr.status + ': ' + xhr.statusText
                pushToast('danger', errorMessage);
            });
    });

    $('#collapseFavPairs').on('hidden.bs.collapse shown.bs.collapse', function () {
        fixDashboardHeights();
    })

});
function runWebSocketForex(forexData) {
    let smplForexData = [];

    for (const [key, element] of Object.entries(forexData)) {
        smplForexData.push({key, element});
    }

    let dataPairs = smplForexData.map((item) => item.element.base_forex_instruments + item.element.quote_forex_instruments);

    const ws = new WebSocket("wss://ws.eodhistoricaldata.com/ws/forex?api_token=63c802ccc7b595.70854189");

    ws.onopen = () => {
        const msg = { action: 'subscribe', symbols: dataPairs.join(',') };
        ws.send(JSON.stringify(msg));
    };

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if(data.s) {
            const findIndex = socketData.findIndex((item) => item.s === data.s);
            if(findIndex === -1) {
                socketData.push({ key: data.s.match(/.{1,3}/g).join('_').toLowerCase(), s: data.s, bids: data.b, asks: data.a, closeoutBid: data.b, closeoutAsk: data.a, kind: 'forex' });
            } else {
                socketData[findIndex] = { key: data.s.match(/.{1,3}/g).join('_').toLowerCase(), s: data.s, bids: data.b, asks: data.a, closeoutBid: data.b, closeoutAsk: data.a, kind: 'forex' };
            }
            let key = data.s.match(/.{1,3}/g).join('_').toLowerCase();
            forexData[key].bids = data.b;
            forexData[key].asks = data.a;
            forexData[key].tradeable = 1;
            let bids = data.b;
            let old_bids = $("#forex_sell_" + key).text();
            let asks = data.a;
            let old_asks = $("#forex_buy_" + key).text();
            let closeoutBid = data.b;
            let closeoutAsk = data.a;

            let bid_change_rate =
                ((bids - closeoutBid) / closeoutBid) * 10000;
            let ask_change_rate =
                ((asks - closeoutAsk) / closeoutAsk) * 10000;
            let total_change_rate = ((asks - bids) / bids) * 100;
            total_change_rate = parseFloat(total_change_rate.toFixed(5));
            if ((total_change_rate * 1000) % 2 < 1) {
                total_change_rate = total_change_rate * -1;
            }
            // console.log(total_change_rate * 1000 % 2);
            let forex_change_rate = "";
            if (isNaN(total_change_rate)) {
                forex_change_rate = "0.00%";
            }
            // console.log("change_rate=>", total_change_rate);

            let tradeable = true;
            if (tradeable) {
                $("#star_image_" + key).attr(
                    "src",
                    base_url + "/landingAssets/images/1-circle.svg"
                );
                $("#forex_sell_" + key).parent().attr('disabled', false);
                $("#forex_buy_" + key).parent().attr('disabled', false);
            } else {
                $("#star_image_" + key).attr(
                    "src",
                    base_url + "/landingAssets/images/0-circle.svg"
                );
                $("#forex_sell_" + key).parent().attr('disabled', true);
                $("#forex_buy_" + key).parent().attr('disabled', true);
            }

            if (bids > old_bids) {
                $("#forex_sell_" + key).html(
                    "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                );
            } else if (bids == old_bids) {
                $("#forex_sell_" + key).html(
                    "<font color='white'>" + parseFloat(bids.toFixed(5)) + "</font>"
                );
            } else {
                $("#forex_sell_" + key).html(
                    "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                );
            }

            if (asks > old_asks) {
                $("#forex_buy_" + key).html(
                    "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                );
            } else if (asks == old_asks) {
                $("#forex_buy_" + key).html(
                    "<font color='white'>" + parseFloat(asks.toFixed(5)) + "</font>"
                );
            } else {
                $("#forex_buy_" + key).html(
                    "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                );
            }

            let diff = (asks - bids) * 1000;
            if (diff > 0) {
                $("#forex_rate_" + key).html(
                    "<font color='green'>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            } else if (diff == 0) {
                $("#forex_rate_" + key).html(
                    "<font color=''>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            } else {
                $("#forex_rate_" + key).html(
                    "<font color='red'>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            }
        }
    }
}
function runWebSocketStock(stockData) {
    let smplStockData = [];

    for (const [key, element] of Object.entries(stockData)) {
        smplStockData.push({key, element});
    }

    let dataPairs = smplStockData.map((item) => item.element.base_stock);

    const ws = new WebSocket("wss://ws.eodhistoricaldata.com/ws/us-quote?api_token=63c802ccc7b595.70854189");

    ws.onopen = () => {
        const msg = { action: 'subscribe', symbols: dataPairs.join(',') };
        ws.send(JSON.stringify(msg));
    };

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if(data.s) {
            const findIndex = socketData.findIndex((item) => item.s === data.s);
            if(findIndex === -1) {
                socketData.push({ key: data.s.toLowerCase(), s: data.s, bids: data.bp, asks: data.ap, closeoutBid: data.bp, closeoutAsk: data.ap, kind: 'stock' });
            } else {
                socketData[findIndex] = { key: data.s.toLowerCase(), s: data.s, bids: data.bp, asks: data.ap, closeoutBid: data.bp, closeoutAsk: data.ap, kind: 'stock' };
            }
            let key = data.s.toLowerCase();
            let bids = data.bp;
            let old_bids = $("#stock_sell_" + key).text();
            let asks = data.ap;
            let old_asks = $("#stock_buy_" + key).text();
            let closeoutBid = data.bp;
            let closeoutAsk = data.ap;

            let bid_change_rate =
                ((bids - closeoutBid) / closeoutBid) * 10000;
            let ask_change_rate =
                ((asks - closeoutAsk) / closeoutAsk) * 10000;
            let total_change_rate = ((asks - bids) / bids) * 100;
            total_change_rate = parseFloat(total_change_rate.toFixed(5));
            if ((total_change_rate * 1000) % 2 < 1) {
                total_change_rate = total_change_rate * -1;
            }
            // console.log(total_change_rate * 1000 % 2);
            let forex_change_rate = "";
            if (isNaN(total_change_rate)) {
                forex_change_rate = "0.00%";
            }
            // console.log("change_rate=>", total_change_rate);

            let tradeable = data.tradeable;
            if (tradeable) {
                $("#star_image_" + key).attr(
                    "src",
                    base_url + "/landingAssets/images/1-circle.svg"
                );
                $("#stock_sell_" + key).parent().attr('disabled', false);
                $("#stock_buy_" + key).parent().attr('disabled', false);
            } else {
                $("#star_image_" + key).attr(
                    "src",
                    base_url + "/landingAssets/images/0-circle.svg"
                );
                $("#stock_sell_" + key).parent().attr('disabled', true);
                $("#stock_buy_" + key).parent().attr('disabled', true);
            }

            if (bids > old_bids) {
                $("#stock_sell_" + key).html(
                    "<font color='green'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                );
            } else if (bids == old_bids) {
                $("#stock_sell_" + key).html(
                    "<font color='white'>" + parseFloat(bids.toFixed(5)) + "</font>"
                );
            } else {
                $("#stock_sell_" + key).html(
                    "<font color='red'>" + parseFloat(bids.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                );
            }

            if (asks > old_asks) {
                $("#stock_buy_" + key).html(
                    "<font color='green'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-up'></i></font>"
                );
            } else if (asks == old_asks) {
                $("#stock_buy_" + key).html(
                    "<font color='white'>" + parseFloat(asks.toFixed(5)) + "</font>"
                );
            } else {
                $("#stock_buy_" + key).html(
                    "<font color='red'>" + parseFloat(asks.toFixed(5)) + "<i class='fa fa-arrow-down'></i></font>"
                );
            }

            let diff = (asks - bids) * 1000;
            if (diff > 0) {
                $("#stock_rate_" + key).html(
                    "<font color='green'>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            } else if (diff == 0) {
                $("#stock_rate_" + key).html(
                    "<font color=''>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            } else {
                $("#stock_rate_" + key).html(
                    "<font color='red'>" + parseFloat(diff.toFixed(5)) + "</font>"
                );
            }
        }
    }
}