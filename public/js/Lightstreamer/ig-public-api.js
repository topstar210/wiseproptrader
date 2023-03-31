/*
 * Copyright (C) 2016 IG Group (webapisupport@ig.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// Change this value to override the environment
var environment = "demo";

// Default API gateway
var urlRoot = "https://" + environment + "-api.ig.com/gateway/deal";

var url = window.location.href;

// If deployed to a labs environment, override the default demo urlRoot
var env = url.match("https?:\/\/(.*)-labs.ig.com");

if (url.match(".*localhost.*") || url.match("chrome-extension://*")) {
    urlRoot = "https://" + environment + "-api.ig.com/gateway/deal";
} else if (env && env.length > 1) {
    var envOverride = env[1].toLowerCase();
    urlRoot = urlRoot.replace("demo", envOverride);
    console.log("Overriding urlRoot with: " + urlRoot);
}

// Globals variables
var accountId = null;
var account_token = null;
var client_token = null;
var lsEndpoint = null;
var lsClient;
var ticketSubscription;
var accountSubscription;

require(["LightstreamerClient", "Subscription"], function (LightstreamerClient, Subscription) {

    function getRequestParam(name) {
        if (name = (new RegExp('[?&]' + encodeURIComponent(name) + '=([^&]*)')).exec(location.search))
            return decodeURIComponent(name[1]);
    }

    /*
     * Function to connect to Lightstreamer
     */
    function connectToLightstreamer() {

        // Instantiate Lightstreamer client instance
        lsClient = new LightstreamerClient(lsEndpoint);

        // Set up login credentials: client
        lsClient.connectionDetails.setUser(accountId);

        var password = "";
        if (client_token) {
            password = "CST-" + client_token;
        }
        if (client_token && account_token) {
            password = password + "|";
        }
        if (account_token) {
            password = password + "XST-" + account_token;
        }
        lsClient.connectionDetails.setPassword(password);

        // Add connection event listener callback functions
        lsClient.addListener({
            onListenStart: function () {
                console.log('Lightstreamer client - start listening');
            },
            onStatusChange: function (status) {
                // console.log('Lightstreamer connection status:' + status);
            }
        });

        // Allowed bandwidth in kilobits/s
        //lsClient.connectionOptions.setMaxBandwidth();

        // Connect to Lightstreamer
        lsClient.connect();
    }

    function subscribeToLightstreamerTradeUpdates(subscriptions) {
        // Create a Lightstreamer subscription for the BID and OFFER prices for the relevant market
        if (!Array.isArray(subscriptions)) {
            console.log('Empty subscriptions!');
            return false;
        }

        // Set up the Lightstreamer FIDs
        accountSubscription = new Subscription(
            "MERGE",
            subscriptions,
            [
                "BID",
                "OFFER",
                "MARKET_STATE"
            ]
        );

        accountSubscription.setRequestedMaxFrequency(0.5);

        // Set up the Lightstreamer event listeners
        accountSubscription.addListener({
            onSubscription: function () {
                console.log('trade updates subscription succeeded');
            },
            onSubscriptionError: function (code, message) {
                console.log('trade updates subscription failure: ' + code + " message: " + message);
            },
            onItemUpdate: function (updateInfo) {

               //  console.log("received trade update message: " + updateInfo.getItemName());
                let epicShort = updateInfo.getItemName().split(".")[2].toLowerCase();
                // console.log(epicShort);
                let epicType = 'crypto';
                // if($("#forex_buy_" + epicShort).length > 0) {
                //     epicType = 'forex';
                // } else if($("#other_buy_" + epicShort).length > 0) {
                //     epicType = 'other';
                // }

                // updateInfo.forEachChangedField(function (fieldName, fieldPos, value) {
                updateInfo.forEachField(function (fieldName, fieldPos, value) {
                    // console.log(value)
                    if (value != 'INV') {
                        if (fieldName === "MARKET_STATE") {
                           let marketIndicator = $("#star_image_" + epicShort);
                           if (value == "TRADEABLE") {
                              $(marketIndicator).attr('src', $(marketIndicator).attr('src').replace(0, 1));
                            //   $("#"+epicType+"_buy_" + epicShort).parent().attr('disabled', false);
                            //   $("#"+epicType+"_sell_" + epicShort).parent().attr('disabled', false);
                              console.log('MARKET_STATE', value);
                           } else {
                              $(marketIndicator).attr('src', $(marketIndicator).attr('src').replace(1, 0));
                            //   $("#"+epicType+"_buy_" + epicShort).parent().attr('disabled', true);
                            //   $("#"+epicType+"_sell_" + epicShort).parent().attr('disabled', true);
                              console.log('MARKET_STATE', value);
                           }
                        } else if (fieldName === 'OFFER') {
                            value = parseFloat(value);
                           if (parseFloat($("#"+epicType+"_buy_" + epicShort).text()) > value) {
                              $("#"+epicType+"_buy_" + epicShort).addClass('text-danger').removeClass('text-success');
                              $("#"+epicType+"_buy_" + epicShort).html( "<span class='text-danger'>" + value + "<i class='fa fa-arrow-down'></i></span>" );
                           } else {
                              $("#"+epicType+"_buy_" + epicShort).addClass('text-success').removeClass('text-danger');
                              $("#"+epicType+"_buy_" + epicShort).html( "<span class='text-success'>" + value + "<i class='fa fa-arrow-up'></i></span>" );
                           }
                        } else if (fieldName === 'BID') {
                            value = parseFloat(value);
                           if (parseFloat($("#"+epicType+"_sell_" + epicShort).text()) > value) {
                              $("#"+epicType+"_sell_" + epicShort).addClass('text-danger').removeClass('text-success');
                              $("#"+epicType+"_sell_" + epicShort).html( "<span class='text-danger'>" + value + "<i class='fa fa-arrow-down'></i></span>" );
                           } else {
                              $("#"+epicType+"_sell_" + epicShort).addClass('text-success').removeClass('text-danger');
                              $("#"+epicType+"_sell_" + epicShort).html( "<span class='text-success'>" + value + "<i class='fa fa-arrow-up'></i></span>" );
                           }
                        }
                        // console.log("field: " + fieldName + " - value: " + value);
                        // if (fieldName == "CONFIRMS") {
                        //     showDealConfirmDialog(value);
                        // } else {
                        //     showAccountStatusUpdate(value);
                        // }
                    }
                });
            },
            onItemLostUpdates: function () {
                console.log("trade updates subscription - item lost");
            }

        });

        // Subscribe to Lightstreamer
        lsClient.subscribe(accountSubscription);
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

    async function loginToLightstreamer() {
        try {
            const response = await postData(window.location.origin + "/get-ig-creds", {
                _token: _csrf_token
            }, 'POST');
            if (response.status == 'success') {
                account_token = response.xSecurityToken;
                client_token = response.cst;
                accountId = response.currentAccountId;
                lsEndpoint = response.lightstreamerEndpoint;
                return response.subscriptions;
            } else {
                console.log(response.message);
                return false;
            }
        } catch (error) {
            console.log(error);
            return false;
        }
    }

    /*
     * Function to retrieve the deal confirmation for the given deal reference
     */
    function retrieveConfirm(dealReference) {

        // Set up the request as a GET request to the address /confirms
        var req = new Request();
        req.method = "GET";
        req.url = urlRoot + "/confirms/" + dealReference;

        // Set up the request headers, i.e. the api key, the account security session token, the client security token, 
        // the request content type (JSON), and the expected response content type (JSON)
        req.headers = {
            "X-IG-API-KEY": apiKey,
            "X-SECURITY-TOKEN": account_token,
            "CST": client_token,
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8"
        };

        // No body is required, as this is a GET request
        req.body = "";
        $("#request_data").text(js_beautify(req.body) || "");

        // Send the request via a Javascript AJAX call
        var message;
        try {
            $.ajax({
                type: req.method,
                url: req.url,
                data: req.body,
                headers: req.headers,
                async: false,
                mimeType: req.binary ? 'text/plain; charset=x-user-defined' : null,
                error: function (response, status, error) {
                    handleHTTPError(response);
                },
                success: function (response, status, data) {

                    // Got confirm data back
                    // Prettify response for display purposes only
                    $("#response_data").text(js_beautify(data.responseText) || "");

                    // Log and set the confirm for later display
                    console.log("confirm retrieved");
                    message = response;
                }
            });
        } catch (e) {

            // Failed to get the confirmation, possibly because the deal reference was not matched to any deal
            handleException(e);
        }

        return message;
    }

    /*
     * Function to retrieve the positions for the active account
     */
    function positions() {

        // Set up the request as a GET request to the address /positions
        var req = new Request();
        req.method = "GET";
        req.url = urlRoot + "/positions";

        // Set up the request headers, i.e. the api key, the account security session token, the client security token, 
        // the request content type (JSON), and the expected response content type (JSON)   
        req.headers = {
            "X-IG-API-KEY": apiKey,
            "X-SECURITY-TOKEN": account_token,
            "CST": client_token,
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8"
        };

        // No body is required, as this is a GET request
        req.body = "";
        $("#request_data").text(js_beautify(req.body) || "");

        // Send the request via a Javascript AJAX call
        try {
            $.ajax({
                type: req.method,
                url: req.url,
                data: req.body,
                headers: req.headers,
                async: false,
                mimeType: req.binary ? 'text/plain; charset=x-user-defined' : null,
                error: function (response, status, error) {
                    // An unexpected error occurred
                    handleHTTPError(response);
                },
                success: function (response, status, data) {

                    // Position data was returned
                    // Prettify the response for display purposes only
                    $("#response_data").text(js_beautify(data.responseText) || "");

                    // Log and display the retrieved positions, along with the Lightstreamer subscription FIDs for the BID and OFFER
                    // price of each position's market
                    $('#positions_list tbody').empty();
                    var epicsItems = [];
                    $(response.positions).each(function (index) {
                        var positionData = response.positions[index];
                        var epic = positionData.market.epic;
                        var canSubscribe = positionData.market.streamingPricesAvailable;
                        var tidyEpic = epic.replace(/\./g, "_");
                        $('#positions_list tbody:last')
                            .append($('<tr>')
                                .append($('<td>')
                                    .append($('<img>')
                                        .attr("class", tidyEpic + "_MARKET_STATE")))
                                .append($('<td>').append(positionData.market.instrumentName))
                                .append($('<td>').append(positionData.market.expiry))
                                .append($('<td>').append(positionData.position.direction + positionData.position.contractSize))
                                .append($('<td>')
                                    .attr("id", tidyEpic + "_BID")
                                    .append(positionData.market.bid))
                                .append($('<td>')
                                    .attr("id", tidyEpic + "_OFFER")
                                    .append(positionData.market.offer))
                            );

                        if (canSubscribe) {
                            var epicsItem = "L1:" + positionData.market.epic;
                            epicsItems.push(epicsItem);
                            console.log("adding subscription index / item: " + index + " / " + epicsItem);
                        }
                    });

                    // Now subscribe to the BID and OFFER prices for each position market
                    if (epicsItems.length > 0) {

                        // Set up Lightstreamer FIDs
                        var subscription = new Subscription(
                            "MERGE",
                            epicsItems,
                            [
                                "BID",
                                "OFFER",
                                "MARKET_STATE"
                            ]
                        );

                        subscription.setRequestedSnapshot("yes");

                        // Set up Lightstreamer event listener
                        subscription.addListener({
                            onSubscription: function () {
                                console.log('subscribed');
                            },
                            onSubscriptionError: function (code, message) {
                                console.log('subscription failure: ' + code + " message: " + message);
                            },
                            onItemUpdate: function (updateInfo) {

                                // Lightstreamer published some data
                                // The item name in this case will be the market EPIC for which prices were subscribed to
                                var epic = updateInfo.getItemName().split(":")[1];
                                updateInfo.forEachField(function (fieldName, fieldPos, value) {
                                    var fieldId = epic.replace(/\./g, "_") + "_" + fieldName;
                                    var cell = $("." + fieldId);

                                    if (fieldName == "MARKET_STATE") {
                                        //update status image
                                        if (value == "TRADEABLE") {
                                            cell.attr("src", "assets/img/open.png")
                                        } else if (value == "EDIT") {
                                            cell.attr("src", "assets/img/edit.png")
                                        } else {
                                            cell.attr("src", "assets/img/close.png")
                                        }
                                    } else {
                                        if (fieldName && cell) {
                                            cell.empty();
                                            cell.append($('<div>').addClass("tickCell").toggle("highlight").append(value));
                                        }
                                    }
                                });
                            }
                        });

                        // Subscribe to Lightstreamer
                        lsClient.subscribe(subscription);

                    }
                }
            });
        } catch (e) {
            handleException(e);
        }
    }

    /*
     * Function to search for markets against which to trade
     */
    function search() {

        // Set up the request as a GET request to the address /markets with a search query parameter of ?searchterm={searchterm}
        var searchTerm = $("#searchTerm").val();
        var req = new Request();
        req.method = "GET";
        req.url = urlRoot + "/markets?searchTerm=" + searchTerm;

        // Set up the request headers, i.e. the api key, the account security session token, the client security token, 
        // the request content type (JSON), and the expected response content type (JSON)      
        req.headers = {
            "X-IG-API-KEY": apiKey,
            "X-SECURITY-TOKEN": account_token,
            "CST": client_token,
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8"
        };

        // No body is required, as this is a GET request
        req.body = "";
        $("#request_data").text(js_beautify(req.body) || "");

        // Send the request via a Javascript AJAX call
        try {
            $.ajax({
                type: req.method,
                url: req.url,
                data: req.body,
                headers: req.headers,
                async: false,
                mimeType: req.binary ? 'text/plain; charset=x-user-defined' : null,
                error: function (response, status, error) {
                    // Something went wrong
                    handleHTTPError(response);
                },
                success: function (response, status, data) {

                    // A search result was returned
                    // Prettify the response for display purposes only
                    $("#response_data").text(js_beautify(data.responseText) || "");

                    // Log and display the search results, along with the Lightstreamer subscription FIDs for the BID and OFFER
                    // price of each market returned
                    $('#search_results_list tbody').empty();
                    var epicsItems = [];

                    $(response.markets).each(function (index) {
                        var marketsData = response.markets[index];
                        var epic = marketsData.epic;
                        var canSubscribe = marketsData.streamingPricesAvailable;
                        var tidyEpic = epic.replace(/\./g, "_");
                        var expiry = marketsData.expiry.replace(/ /g, "");
                        var linkId = "searchResult_" + tidyEpic;

                        $('#search_results_list tbody:last')
                            .append($('<tr>')
                                .append($('<td>')
                                    .append($('<img>')
                                        .attr("id", "search_" + tidyEpic + "_MARKET_STATE")))
                                .append(
                                    $('<td>')
                                    .append($('<a>')
                                        .attr("id", linkId)
                                        .append(marketsData.instrumentName))
                                )
                                .append($('<td>')
                                    .append(expiry))
                                .append($('<td>')
                                    .attr("id", "search_" + tidyEpic + "_BID")
                                    .append(marketsData.bid))
                                .append($('<td>')
                                    .attr("id", "search_" + tidyEpic + "_OFFER")
                                    .append(marketsData.offer))
                            );

                        $('#' + linkId).on('click', function () {
                            dealTicket(epic, expiry);
                        });

                        if (canSubscribe) {
                            var epicsItem = "L1:" + marketsData.epic;
                            epicsItems.push(epicsItem);
                        }

                        return index < 39;
                    });

                    // Now subscribe to the BID and OFFER prices for each market found
                    if (epicsItems.length > 0) {

                        // Set up Lightstreamer FIDs
                        var subscription = new Subscription(
                            "MERGE",
                            epicsItems,
                            [
                                "BID",
                                "OFFER",
                                "MARKET_STATE"
                            ]
                        );

                        subscription.setRequestedSnapshot("yes");

                        // Set up Lightstreamer event listener
                        subscription.addListener({
                            onSubscription: function () {
                                console.log('subscribed');
                            },
                            onSubscriptionError: function (code, message) {
                                console.log('subscription failure: ' + code + " message: " + message);
                            },
                            onItemUpdate: function (updateInfo) {

                                // Lightstreamer published some data
                                // The item name in this case will be the market EPIC for which prices were subscribed to
                                var epic = updateInfo.getItemName().split(":")[1];
                                var tidyEpic = epic.replace(/\./g, "_");
                                updateInfo.forEachField(function (fieldName, fieldPos, value) {
                                    var fieldId = "search_" + tidyEpic + "_" + fieldName;
                                    var cell = $("#" + fieldId);

                                    if (fieldName == "MARKET_STATE") {
                                        //update status image
                                        if (value == "TRADEABLE") {
                                            cell.attr("src", "assets/img/open.png")
                                        } else if (value == "EDIT") {
                                            cell.attr("src", "assets/img/edit.png")
                                        } else {
                                            cell.attr("src", "assets/img/close.png")
                                        }
                                    } else {
                                        if (fieldName && cell) {
                                            cell.empty();
                                            cell.append($('<div>').addClass("tickCell").append(value).toggle("highlight"));
                                        }
                                    }
                                });
                            }
                        });

                        // Subscribe to Lightstreamer
                        lsClient.subscribe(subscription);
                    }

                }
            });
        } catch (e) {
            handleException(e);
        }
    }

    /*
     * Retrieve market details
     */
    function marketDetails(epic) {

        // Set up the request as a GET request to the address /markets with a path parameter of the market EPIC
        var req = new Request();
        req.method = "GET";
        req.url = urlRoot + "/markets/" + epic;

        // Set up the request headers, i.e. the api key, the account security session token, the client security token, 
        // the request content type (JSON), and the expected response content type (JSON)         
        req.headers = {
            "X-IG-API-KEY": apiKey,
            "X-SECURITY-TOKEN": account_token,
            "CST": client_token,
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8"
        };

        // No body is required, as this is a GET request
        req.body = "";
        $("#request_data").text(js_beautify(req.body) || "");

        // Send the request via a Javascript AJAX call
        var resultData;
        try {
            $.ajax({
                type: req.method,
                url: req.url,
                data: req.body,
                headers: req.headers,
                async: false,
                mimeType: req.binary ? 'text/plain; charset=x-user-defined' : null,
                error: function (response, status, error) {
                    // Something went wrong
                    handleHTTPError(response);
                },
                success: function (response, status, data) {

                    // Market details were returned
                    // Prettify the response and store the result for later display
                    $("#response_data").text(js_beautify(data.responseText) || "");
                    console.log("market details retrieved");
                    resultData = response;
                }
            });

        } catch (e) {
            handleException(e);
        }
        return resultData;
    }

    /*
     * Function to populate the deal trading ticket
     */
    function dealTicket(epic, expiry) {

        // Unsubscribe from any previous Lightstreamer subscriptions
        if (ticketSubscription) {
            lsClient.unsubscribe(ticketSubscription);
        }

        // Get the EPIC of the market we want to trade against
        $('#trade_epic').val(epic);
        $('#trade_expiry').val(expiry);
        var market = marketDetails(epic);
        $('#dealTicket_title').text('Deal Ticket - ' + market.instrument.name);

        // Set the buy and sell
        $('#ticket_buy_price').text(market.snapshot.offer);
        $('#ticket_sell_price').text(market.snapshot.bid);

        $('#trade_offer').val(market.snapshot.offer);
        $('#trade_bid').val(market.snapshot.bid);

        // Create a Lightstreamer subscription for the BID and OFFER prices for the relevant market

        // Set up the Lightstreamer FIDs
        ticketSubscription = new Subscription(
            "MERGE",
            "L1:" + epic,
            [
                "BID",
                "OFFER"
            ]
        );

        ticketSubscription.setRequestedSnapshot("yes");

        // Set up the Lightstreamer event listeners
        ticketSubscription.addListener({
            onSubscription: function () {
                console.log('subscribed');
            },
            onSubscriptionError: function (code, message) {
                console.log('subscription failure: ' + code + " message: " + message);
            },
            onItemUpdate: function (updateInfo) {

                // Lightstreamer notification received
                // Extract the BID and OFFER prices and display these
                var epic = updateInfo.getItemName().split(":")[1];
                var tidyEpic = epic.replace(/\./g, "_");
                updateInfo.forEachField(function (fieldName, fieldPos, value) {
                    if (fieldName == "BID") {
                        $('#ticket_sell_price').text(value);
                        $('#trade_bid').text(value);
                    } else if (fieldName == "OFFER") {
                        $('#ticket_buy_price').text(value);
                        $('#trade_offer').text(value);
                    }
                });
            }
        });

        // Subscribe to Lightstreamer
        lsClient.subscribe(ticketSubscription);

        // Show deal ticket
        $('#dealTicket').modal('show');
    }

    /*
     * Function to create an OTC position
     */
    function placeTrade() {

        // Hide the deal ticket as it's no longer required
        $('#dealTicket').modal('hide');

        // Get the market, deal size, and direction from the deal ticket
        // TODO remove bid and offer from the API
        var epic = $('#trade_epic').val();
        var expiry = $('#trade_expiry').val();
        var size = $('#trade_size').val();
        var tradeBid = $('#trade_bid').val();
        var tradeOffer = $('#trade_offer').val();
        var direction = $('#trade_direction').val();

        // Create a POST request to /positions/otc
        var req = new Request();
        req.method = "POST";
        req.url = urlRoot + "/positions/otc";

        // Set up the request headers, i.e. the api key, the account security session token, the client security token, 
        // the request content type (JSON), and the expected response content type (JSON)      
        req.headers = {
            "X-IG-API-KEY": apiKey,
            "X-SECURITY-TOKEN": account_token,
            "CST": client_token,
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8",
            "Version": "1"
        };

        // Set up the request body
        var bodyParams = {};
        bodyParams["currencyCode"] = "GBP";
        bodyParams["epic"] = epic;
        bodyParams["expiry"] = expiry;
        bodyParams["direction"] = (direction == "+" ? "BUY" : "SELL");
        bodyParams["size"] = size;
        bodyParams["forceOpen"] = false;
        bodyParams["guaranteedStop"] = false;
        bodyParams["orderType"] = "MARKET";

        req.body = JSON.stringify(bodyParams);

        // Prettify the request for display purposes only
        $("#request_data").text(js_beautify(req.body) || "");

        // Send the request via a Javascript AJAX call
        var resultData;
        try {
            $.ajax({
                type: req.method,
                url: req.url,
                data: req.body,
                headers: req.headers,
                async: false,
                mimeType: req.binary ? 'text/plain; charset=x-user-defined' : null,
                error: function (response, status, error) {
                    // Something went wrong
                    handleHTTPError(response);
                },
                success: function (response, status, data) {
                    // The order was created
                    // Prettify and log the response
                    $("#response_data").text(js_beautify(data.responseText) || "");
                    console.log("order placed");
                    resultData = response;
                }
            });
        } catch (e) {
            handleException(e);
        }

        // If the deal was placed, wait for the deal confirmation
        if (resultData) {
            console.log(resultData);
            showDealInProgressDialog(resultData);
        }

        //   Note: this example relies on the Lightstreamer confirm, alternatively a client implementation might make use of the polling confirm service, illustrated below
        //   setTimeout(function () {
        //      var message = retrieveConfirm(resultData.dealReference);
        //      console.log(message);
        //      $('#dealInProgress').modal("hide");
        //      showDealConfirmDialog(message);
        //   }, 1000);

    }

    /*
     * Function to display an in progress dialog for an order while we wait for its confirmation.
     */
    function showDealInProgressDialog(resultData) {
        $('#dealReference').text(resultData.dealReference);
        $('#dealInProgress').modal('show');
    }


    /*
     * Function to display the deal confirmation message and update the user interface positions list
     */
    function showDealConfirmDialog(message) {

        if (message) {
            $('#dealInProgress').modal('hide');
            console.log('confirm message: ' + message);

            var confirm = JSON.parse(message);
            console.log('confirm - deal id: ' + confirm.dealId);
            console.log('confirm - json payload: ' + confirm);

            $('#dealId').text(confirm.dealId);
            $('#dealStatus').text(confirm.dealStatus);
            $('#dealConfirm').modal("show");

            // Refresh position list
            positions();
        }

    }

    /*
     * Function to display an account update (WOU, OPU) message and update the positions list
     */
    function showAccountStatusUpdate(message) {
        if (message) {

            var confirm = JSON.parse(message);
            console.log('Account update received: ' + confirm.dealId)
            console.log(confirm);
        }

    }

    /*
     * Request object
     */
    function Request(o) {
        this.headers = {
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json; charset=UTF-8"
        };
        this.body = "";
        this.method = "";
        this.url = "";
    }

    /*
     * Exception handler - displays details of the exception on the screen
     */
    function handleException(exception) {
        $("#response_data").text(exception);
        $("#alertStatusCode").text("unknown");
        try {
            var responseJson = jQuery.parseJSON(response.responseText);
            $("#alertErrorCode").text(responseJson.errorCode);
        } catch (e) {
            $("#alertErrorCode").text(exception);
        }
        $("#errorAlert").show();
    }

    /*
     * Handle an HTTP error
     */
    function handleHTTPError(response) {
        $("#response_data").text(js_beautify(response.responseText));
        $("#alertStatusCode").text(response.status);
        try {
            var responseJson = jQuery.parseJSON(response.responseText);
            $("#alertErrorCode").text(responseJson.errorCode);
        } catch (e) {
            $("#alertErrorCode").text(response.responseText);
        }
        $("#errorAlert").show();
    }


    $('#positionsButton').on('click', function () {
        positions();
    });

    $('#searchButton').on('click', function () {
        search();
    });

    $('#place_trade_button').on('click', function () {
        placeTrade();
    });

    $('#erroralert-dismiss').on('click', function () {
        $('#errorAlert').hide();
    });

    $('#sell_button').on('click', function () {
        $('#sell_button').addClass("glowing-border-on");
        $('#sell_button').removeClass("glowing-border-off");
        $('#buy_button').addClass("glowing-border-off");
        $('#buy_button').removeClass("glowing-border-on");

        $('#trade_direction').val("-");
    });

    $('#buy_button').on('click', function () {
        $('#buy_button').addClass("glowing-border-on");
        $('#buy_button').removeClass("glowing-border-off");
        $('#sell_button').addClass("glowing-border-off");
        $('#sell_button').removeClass("glowing-border-on");

        $('#trade_direction').val("+");
    });


    function showTradingPane() {
        $('#landing').addClass("container-hidden");
        $('#landing').removeClass("container");
        $('#container').removeClass("container-hidden");
        $('#container').addClass("container");
    }

    let beginLogin = loginToLightstreamer().then(function(subscriptions) {
       if (subscriptions) {
         connectToLightstreamer();
         subscribeToLightstreamerTradeUpdates(subscriptions);
       }
    })
});