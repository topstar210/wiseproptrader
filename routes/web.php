<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'Auth\LoginController@redirectToLogin')->name('redirectToLogin');


// Route::get('/{some}', 'HomeController@redirectToHome')->name('redirectToHome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/statement/export', 'HomeController@export_statement')->name('export_statement');
Route::patch('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
Route::post('/favorite-pair', 'HomeController@favorite_pair')->name('favorite_pair');
Route::post('/get-ig-creds', 'HomeController@get_ig_creds')->name('get_ig_creds');
Route::get('/showTradePair', 'ForexController@showPair');
Route::get('/showForexTradingData', 'ForexController@showForexTradingData');
Route::get('/showStockTradingData', 'ForexController@showStockTradingData');
Route::get('/showCryptoTradingData', 'ForexController@showCryptoTradingData');
Route::post('/pay', 'RaveController@initialize')->name('pay');
Route::get('/pay', 'RaveController@initialize_Get');
Route::post('/rave/callback', 'RaveController@callback')->name('callback');
Route::get('/rave/callback', 'RaveController@callback_Get');
Route::post('coinpayment/deposit', 'CoinpaymentsController@validateIpn');
Route::post('/verifyID', 'HomeController@verifyID');
Route::get('/withdraw', 'HomeController@withdrawPayment');
Route::get('/confirm-withdraw/{confirm_id}', 'HomeController@confirmWithdrawPayment');

// dashboard router
Route::get('/dashboard/wiseprop-funding', 'Dashboard\WisepropFundingController@index')->name('dash_wiseprop_funding');
Route::get('/dashboard/client-area', 'Dashboard\ClientAreaController@index')->name('dash_client_area');
Route::get('/dashboard/profile', 'Dashboard\ProfileController@index')->name('dash_profile');
route::get('/dashboard/download', 'Dashboard\IndexController@download')->name('dash_download');
route::get('/dashboard/index', 'Dashboard\IndexController@otherpages')->name('dash_comingsoon');

Route::middleware(['auth', 'checkAdmin'])->group(function () {
    Route::get('admin/repports', 'AdminRepportsController@withdraw_deposit_repport');
    Route::get('admin/repports/export/', 'AdminRepportsController@download_withdraw_deposit_repport')->name('download_withdraw_deposit_repport');
    Route::get('/super_manager/deleteClient/', 'AdminController@deleteClient');
});
Route::prefix('admin')->middleware(['auth', 'checkRole'])->group(function () {
    Route::get('/', 'AdminController@showAdminPage');
    Route::get('/bank_trans', 'AdminController@showBanktransfer');
    Route::get('/payments', 'AdminController@showPayments');
    Route::get('/identify', 'AdminController@showIdentify');
    Route::get('/withdraw', 'AdminController@showWithdraw');
    Route::get('/traders', 'AdminController@showTraders');
    Route::get('/bankSetting', 'AdminController@showbankSetting');
    Route::get('/tradingSetting', 'AdminController@showtradingSetting');
    Route::get('/spread-settings', 'AdminController@spreadSettings');
    Route::post('/save-spread-settings', 'AdminController@saveSpreadSettings');
    Route::get('/emailSetting', 'AdminController@showemailSetting');
    Route::get('/logoSetting', 'AdminController@showlogoSetting');
    Route::get('/IDSetting', 'AdminController@showIDSetting');
    Route::get('/userManage', 'AdminController@showuserManage');
    Route::get('/mailBox', 'AdminController@showmailBox');
    Route::get('/notification', 'AdminController@shownotification');
    Route::get('/showClients', 'AdminController@showClients');
    Route::get('/savePaymentGateway', 'AdminController@savePaymentGateway');
    Route::get('/deletePaymentGateway', 'AdminController@deletePaymentGateway');
    Route::get('/updateOpenRate', 'AdminController@updateOpenRate');
    Route::get('/deleteOrder', 'AdminController@deleteOrder');
    Route::get('/LeverageSetting', 'AdminController@leverageSetting');
    Route::get('/package', 'AdminController@pacakgesettings');
    Route::get('/package/edit/{id}', 'AdminController@pacakgesettingsedit')->name('package.edit');
    Route::post('/package/submit', 'AdminController@pacakgesettingssub');
    Route::get('/rules', 'AdminController@rulessettings');
    Route::post('/rules', 'AdminController@rulessettingssub');
    Route::get('/identifyProcess', 'AdminController@identifyProcess');
    Route::get('/clients', 'AdminController@showMyClients');
    Route::get('/updatePassword', 'AdminController@updatePassword');
    Route::get('/approveWithdraw', 'AdminController@approveWithdraw');
    Route::post('/declineWithdraw', 'AdminController@declineWithdraw');
});

Route::middleware(['auth', 'checkRole'])->group(function () {
    Route::get('/super_manager/showClientDetail/{id}', 'AdminController@showClientDetail');
    Route::get('/super_manager/addFund', 'AdminController@addFund');
});

Route::prefix('super_manager')->middleware(['auth', 'checkRole', 'checkSuper'])->group(function () {
    Route::get('/showManagers', 'AdminController@showManagers');
    Route::get('/updateClient', 'AdminController@updateClient');
    Route::get('/updateManager', 'AdminController@updateManager');
    // Route::get('/showClientDetail/{id}', 'AdminController@showClientDetail');
    Route::get('/paymentsettings/{gateway}', 'AdminController@configPaymentGateways');
    Route::get('/updatePaymentGateway/{gateway}', 'AdminController@updatePaymentGateway');
    Route::get('/updateTradeSettings/{trade}', 'AdminController@updateTradeSettings');
    Route::get('/updateEmailSetting', 'AdminController@updateEmailSetting');
    Route::post('/updatePageSettings', 'AdminController@updatePageSettings');
    Route::post('/updateAppSettings', 'AdminController@updateAppSettings');
    Route::get('/updateLeverage', 'AdminController@updateLeverage');
    Route::get('/updateVerifySetting', 'AdminController@updateVerifySetting');
    Route::post('/updateTemplate', 'AdminController@updateTemplate');
    Route::post('/saveFrontPaymentButtons', 'AdminController@saveFrontPaymentButtons');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/deposit', 'ProfileController@flutterDeposit');
    Route::post('/Coinpayment', 'CoinPayController@coinPay')->name('Coinpayment');
    Route::get('/coinPay/success/{order_id}/{amount}', 'CoinPayController@coinPaySuccess');
    Route::get('/coinPay/failed/{order_id}', 'CoinPayController@coinPayFailed');
    Route::get('/bridgerPay/deposit/{country}/{firstname}/{lastname}/{email}/{phone}/{address}/{state}/{city}/{zip}/{depositAmount}/{currency}', 'bridgerPayController@Deposit');
    Route::get('/bridgerPay/success', 'bridgerPayController@depositSuccess');
    Route::get('/bridgerPay/failed', 'bridgerPayController@depositFailed');
    // Route::get('/bridgerPay/callback', 'CoinPayController@coinPayFailed');
    // https://evofx.ltd/public/bridgerPay/success?orderId=i173aa01&sessionId=68042fdc-d0a4-4381-8d2a-b1f289821087&status=approved

    Route::post('/paymentwall/pay', 'PaymentWallController@paymentwall_pay');
    Route::get('/paymentwall/pay', 'PaymentWallController@paymentwall_pay');
});

Route::get('/paymentwall/pingback', 'PaymentWallController@paymentwall_pingback');



Route::prefix('trading')->middleware(['auth'])->group(function () {
    Route::get('/order_trade', 'TradingController@makeOrder');
    Route::get('/show_order', 'TradingController@showOrder');
    Route::get('/close_order', 'TradingController@closeOrder');
    Route::get('/getMarketInfo', 'TradingController@getMarketInfo');
    Route::get('/getExchangeRate', 'TradingController@getExchangeRate');
    Route::get('/updateBalance', 'TradingController@updateBalance');
    Route::get('/getStopout', 'TradingController@getStopout');
    Route::get('/closeAllOrder', 'TradingController@closeAllOrder');
    Route::get('/show_order', 'TradingController@showOrder');
    Route::post('/setTakeProfit', 'TradingController@setTakeProfit');
    Route::post('/setStopLose', 'TradingController@setStopLose');
    Route::post('/getUserFundedAmt', 'TradingController@getUserFundedAmt');
});


Route::get('/paypal/payout', 'PaypalController@paypalPayout');
Route::get('paywithpaypal', array('as' => 'paywithpaypal', 'uses' => 'PaypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal', 'uses' => 'PaypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status', 'uses' => 'PaypalController@getPaymentStatus',));