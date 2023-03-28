<?php

namespace App\Http\Controllers;

use App\Crypto_list;
use App\Forex_list;
use App\Stock_list;
use App\Trade_setting;
use App\Personal_info;
use Illuminate\Http\Request;
use Cache;
use Binance\API as Binance_Api;
use Binance\RateLimiter as Binance_RateLimiter;

class ForexController extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }

  private $CallCache = [];

  public function showPair() {
    $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    $ig_switch_crypto = Trade_setting::where('name', 'ig_switch_crypto')->value('value');
    $crypto_api_type = 'oanda';
    if ($ig_switch != 'on') {

      $forexPair = Forex_list::where('type', 'oanda')
      ->whereIn('category', ['minor', 'major', 'oanda'])
      ->select('base_forex_instruments', 'name_forex_instruments', 'quote_forex_instruments', 'type_forex_instruments', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower(preg_replace('/_/', '', $item['name_forex_instruments'])); });

      $otherPair = Forex_list::where('type', 'oanda')
      ->whereIn('category', ['metals', 'indices', 'commodities', 'bonds'])
      ->select('base_forex_instruments', 'name_forex_instruments', 'quote_forex_instruments', 'type_forex_instruments', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower(preg_replace('/_/', '', $item['name_forex_instruments'])); });

      $stockPair = Stock_list::where('type', 'IG')
      ->whereIn('category', ['stock'])
      ->select('base_stock', 'name_stock', 'alias', 'quote_stock', 'type_stock', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower($item['base_stock']); });

      $cryptoPair = Crypto_list::where('type', 'binance')
      ->select('base', 'name', 'quote', 'type', 'leverage', 'tradeable', 'asks', 'bids', 'category', 'tradingview_network')
      ->get()
      ->keyBy(function ($item) { return strtolower(preg_replace('/_/', '', $item['name'])); });

      $cryptoPair = Crypto_list::where('type', 'binance')
      ->select('base', 'name', 'quote', 'type', 'leverage', 'tradeable', 'asks', 'bids', 'category', 'tradingview_network')
      ->get()
      ->keyBy(function ($item) { return strtolower(preg_replace('/_/', '', $item['name'])); });


    } else {

      $forexPair = Forex_list::where('type', 'oanda')
      ->whereIn('category', ['minor', 'major', 'oanda'])
      ->select('base_forex_instruments', 'name_forex_instruments', 'quote_forex_instruments', 'type_forex_instruments', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower($item['name_forex_instruments']); });

      $otherPair = Forex_list::where('type', 'oanda')
      ->whereIn('category', ['metals', 'indices', 'commodities', 'bonds'])
      ->select('base_forex_instruments', 'name_forex_instruments', 'quote_forex_instruments', 'type_forex_instruments', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower($item['name_forex_instruments']); });

      $stockPair = Stock_list::where('type', 'IG')
      ->whereIn('category', ['stock'])
      ->select('base_stock', 'name_stock', 'alias', 'quote_stock', 'type_stock', 'leverage', 'tradeable', 'asks', 'bids', 'type', 'category')
      ->get()
      ->keyBy(function ($item) { return strtolower($item['base_stock']); });

      if ($ig_switch_crypto == 'on') {
        $crypto_api_type = 'IG';
        $cryptoPair = Crypto_list::where('type', 'IG')
        ->select('base', 'name', 'quote', 'type', 'leverage', 'tradeable', 'asks', 'bids', 'category', 'tradingview_network')
        ->get()
        ->keyBy(function ($item) { return strtolower($item['name']); });
      } else {
        $cryptoPair = Crypto_list::where('type', 'binance')
        ->select('base', 'name', 'quote', 'type', 'leverage', 'tradeable', 'asks', 'bids', 'category', 'tradingview_network')
        ->get()
        ->keyBy(function ($item) { return strtolower(preg_replace('/_/', '', $item['name'])); });
      }

    }

    $fav_pairs = Personal_info::where('user_id', auth()->user()->id)->value('fav_pairs');
    if (!is_array($fav_pairs)) $fav_pairs = [];

    return response()->json(['forex' => $forexPair, 'other' => $otherPair, 'crypto' => $cryptoPair, 'stock' => $stockPair, 'fav_pairs' => $fav_pairs, 'crypto_api_type' => $crypto_api_type]);
  }

  public function showForexTradingData(Request $request) {
    $id = $request->id;
    $pair = preg_replace("|/|", '', $request->forexPair);
    // $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    // if (Forex_list::where('name_forex_instruments', $pair)->value('type') == 'IG' && $ig_switch == 'on') {
    //     return $this->getIgTradingInfo($pair);
    // }
    $oanda_api_key = Trade_setting::where('name', 'oanda2_api_key')->value('value');
    $oanda_account_number = Trade_setting::where('name', 'oanda2_account_number')->value('value');
    $forex_api = Trade_setting::where('name', 'forex_api')->value('value');
    $forex_account = Trade_setting::where('name', 'forex_account')->value('value');
    $forex_switch = Trade_setting::where('name', 'forex_switch')->value('value');
    if ($forex_switch == 'on') {

      if ($oanda_api_key != '' && $oanda_account_number != '') {
        if (array_key_exists('return_resp', $this->CallCache)) {
          return $this->CallCache['return_resp'];
        }

        $urlFetchData = "https://api-fxpractice.oanda.com/v3/accounts/$oanda_account_number/pricing?instruments=" . strtoupper($request->forexPair);

        $ch = curl_init($urlFetchData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Accept: application/json',
          'Content-Type: application/json',
          'Authorization: Bearer ' . $oanda_api_key,
        )
        );

        $res = curl_exec($ch);
        $http_code = 0;
        if (!curl_errno($ch)) {
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        $response = json_decode($res, true);
        curl_close($ch);

        if ($http_code != '200') {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'http_code' => $http_code]);
        }
        if (!isset($response['prices'][0]['asks'][0]['price'])) {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'no_low_response' => $response]);
        }

        $bids = $response['prices'][0]['bids'][0]['price'] * 1;
        $asks = $response['prices'][0]['asks'][0]['price'] * 1;
        $closeoutBid = $response['prices'][0]['closeoutBid'];
        $closeoutAsk = $response['prices'][0]['closeoutAsk'];
        $tradeable = $response['prices'][0]['tradeable'];

        $return_resp = ['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'id' => $id];

        $instrument = preg_replace('|/|', '_', $response['prices'][0]['instrument']);
        Forex_list::where('name_forex_instruments', $instrument)->update(['bids' => $bids, 'asks' => $asks, 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);

        $this->CallCache['return_resp'] = $return_resp;
        return response()->json($return_resp);

      } else {
        $pair = strtoupper($request->forexPair);
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $forex_api . $forex_account . "&symbol=" . $pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 53b0ba42e9b03cf529a81586d6466f62-a067660760437545c186f5ce5770fd7d",
            "cache-control: no-cache",
            "postman-token: c8849fbe-d3d0-53ab-1add-6623f43432b1",
          ),
        ));

        $response = curl_exec($curl);
        $http_code = 0;
        if (!curl_errno($curl)) {
          $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        }

        curl_close($curl);
        if ($http_code != '200') {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
        }
        if (!isset(json_decode($response)->low)) {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
        }
        // var_dump(json_decode($response)->values[0]->low);
        // if ($http_status == 500 || $http_status == 503) {
        //     return response()->json(['bids'=>0, 'asks'=>0, 'closeoutBid'=>0, 'closeoutAsk'=>0, 'tradeable'=>0]);
        // }
        // else{
        $bids = json_decode($response)->low * 1;
        $asks = json_decode($response)->high * 1;
        $closeoutBid = json_decode($response)->open * 1;
        $closeoutAsk = json_decode($response)->close * 1;
        $tradeable = 1;

        $instrument = preg_replace('|/|', '_', $pair);
        Forex_list::where('name_forex_instruments', $instrument)->update(['bids' => $bids, 'asks' => $asks, 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);

        return response()->json(['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'id' => $id]);
        // }
      }
    } else {
      return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
    }
  }

  public function showStockTradingData(Request $request) {
    $id = $request->id;
    $stockPair = $request->stockPair;

    $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    if ($ig_switch == 'on') {
      $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
      if (cache('x-security-token') != '' && cache('cst') != '') {

        $stock = Stock_list::where('base_stock', $stockPair)->first();

        $ch = curl_init();
        curl_setopt_array($ch, array(
          CURLOPT_URL => "https://demo-api.ig.com/gateway/deal/markets/".$stock->epic,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "X-IG-API-KEY: " . $ig_api_key,
            'X-SECURITY-TOKEN: ' . cache('x-security-token'),
            'CST: ' . cache('cst'),
            'Version: 3',
            'Content-Type: application/json',
          ),
        ));

        $res = curl_exec($ch);
        $http_code = 0;
        if (!curl_errno($ch)) {
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        $response = json_decode($res);
        curl_close($ch);

        if ($http_code != '200') {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'http_code' => $http_code]);
        }

        $tradeable = (($response->snapshot->marketStatus ?? 0) == 'TRADEABLE') ? 1 : 0;
        $bids = $response->snapshot->low ?? 0;
        $asks = $response->snapshot->high ?? 0;
        $closeoutBid = 0;
        $closeoutAsk = 0;

        if (!$bids && !$asks) {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'no_low_response' => $response]);
        }

        $return_resp = ['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'id' => $id];

        $stock->bids = $bids;
        $stock->asks = $asks;
        $stock->tradeable = $tradeable;
        $stock->updated_at = \now();
        $stock->save();

        return response()->json($return_resp);
      } else {
        return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'reason' => 'noCache', 'cache' => [cache('x-security-token'), Cache::get('cst')]]);
      }
    } else {
      return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'reason' => 'igOff']);
    }
  }

//   public function showCryptoTradingData(Request $request) {
//     $id = $request->id;
//     $cryptoPair = strtoupper($request->cryptoPair);

//     $crypto_switch = Trade_setting::where('name', 'crypto_switch')->value('value');
//     $binance_switch = Trade_setting::where('name', 'binance_switch')->value('value');
//     if ($binance_switch == 'on') {
//       $instrument = preg_replace('|/|', '', $cryptoPair);
//       $binance_api_key = Trade_setting::where('name', 'binance_api_key')->value('value');
//       $binance_secret = Trade_setting::where('name', 'binance_secret')->value('value');
//       if ($binance_api_key != '' && $binance_secret != '') {
//         $api = new Binance_RateLimiter(new Binance_Api($binance_api_key, $binance_secret));
//         try {
//           $bookPrice = $api->bookPrice(strtoupper($instrument));
//           $res['bids'] = $bookPrice['bidPrice'] ?? 0;
//           $res['asks'] = $bookPrice['askPrice'] ?? 0;
//           $res['tradeable'] = (!$res['bids'] || !$res['asks']) ? 0 : 1;
//         } catch(Exception $e) {
//           $res['bids'] = 0;
//           $res['asks'] = 0;
//           $res['tradeable'] = 0;
//         }
//       } else {
//         $res['bids'] = 0;
//         $res['asks'] = 0;
//         $res['tradeable'] = 0;
//       }
//       $res['closeoutBid'] = 0;
//       $res['closeoutAsk'] = 0;

//       if ($res['bids'] == 0 || $res['asks'] == 0) {
//         $db_value = Crypto_list::where('name', $instrument)->where('type', 'binance')->select('bids', 'asks')->first();
//         if ($db_value) {
//           $res['bids'] = $db_value->bids;
//           $res['asks'] = $db_value->asks;
//         }
//         return $res;
//       } else {
//         Crypto_list::where('name', $instrument)->where('type', 'binance')->update(['bids' => $res['bids'], 'asks' => $res['asks'], 'tradeable' => (int) $res['tradeable'], 'updated_at' => \now()]);
//       }
//       return response()->json($res);

//     } else if ($crypto_switch == 'on') {
//       $crypto_api = Trade_setting::where('name', 'crypto_api')->value('value');
//       $crypto_account = Trade_setting::where('name', 'crypto_account')->value('value');
//       // $crypto_api = "https://api.hitbtc.com/api/2/public/ticker/";
//       $curl = curl_init();
//       curl_setopt_array($curl, array(
//         CURLOPT_URL => $crypto_api . $crypto_account . "&symbol=" . $cryptoPair,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "GET",
//         CURLOPT_HTTPHEADER => array(
//           "authorization: Bearer 53b0ba42e9b03cf529a81586d6466f62-a067660760437545c186f5ce5770fd7d",
//           "cache-control: no-cache",
//           "postman-token: c8849fbe-d3d0-53ab-1add-6623f43432b1",
//         ),
//       ));
//       $response = curl_exec($curl);
//       $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//       $err = curl_error($curl);
//       curl_close($curl);
//       if ($http_status == 500) {
//         $bids = 0;
//         $asks = 0;
//         $tradeable = false;
//       } else {
//         $response = json_decode($response);
//         $bids = $response->low ?? 0 ;//json_decode($response)->low * 1;
//         $asks = $response->high ?? 0 ;//json_decode($response)->high * 1;
//         $closeoutBid = $response->open ?? 0 ;//json_decode($response)->open * 1;
//         $closeoutAsk = $response->close ?? 0 ;//json_decode($response)->close * 1;
//         $tradeable = 1;
//       }
//       $instrument = preg_replace('|/|', '', $cryptoPair);
//       Crypto_list::where('name', $instrument)->update(['bids' => $bids, 'asks' => $asks, 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);
//       return response()->json(['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'res' => $http_status, 'id' => $id]);
//     } else {
//       return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
//     }
//   }

  public function showCryptoTradingData(Request $request) {
    $id = $request->id;
    $pair = preg_replace("|/|", '', $request->cryptoPair);
    // $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    // if (Forex_list::where('name_forex_instruments', $pair)->value('type') == 'IG' && $ig_switch == 'on') {
    //     return $this->getIgTradingInfo($pair);
    // }
    $oanda_api_key = Trade_setting::where('name', 'oanda2_api_key')->value('value');
    $oanda_account_number = Trade_setting::where('name', 'oanda2_account_number')->value('value');
    $forex_api = Trade_setting::where('name', 'forex_api')->value('value');
    $forex_account = Trade_setting::where('name', 'forex_account')->value('value');
    $forex_switch = Trade_setting::where('name', 'forex_switch')->value('value');
    if ($forex_switch == 'on') {

      if ($oanda_api_key != '' && $oanda_account_number != '') {
        if (array_key_exists('return_resp', $this->CallCache)) {
          return $this->CallCache['return_resp'];
        }

        $urlFetchData = "https://api-fxpractice.oanda.com/v3/accounts/$oanda_account_number/pricing?instruments=" . strtoupper($request->cryptoPair);

        $ch = curl_init($urlFetchData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Accept: application/json',
          'Content-Type: application/json',
          'Authorization: Bearer ' . $oanda_api_key,
        )
        );

        $res = curl_exec($ch);
        $http_code = 0;
        if (!curl_errno($ch)) {
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        $response = json_decode($res, true);
        curl_close($ch);

        if ($http_code != '200') {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'http_code' => $http_code]);
        }
        if (!isset($response['prices'][0]['asks'][0]['price'])) {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false, 'no_low_response' => $response]);
        }

        $bids = $response['prices'][0]['bids'][0]['price'] * 1;
        $asks = $response['prices'][0]['asks'][0]['price'] * 1;
        $closeoutBid = $response['prices'][0]['closeoutBid'];
        $closeoutAsk = $response['prices'][0]['closeoutAsk'];
        $tradeable = $response['prices'][0]['tradeable'];

        $return_resp = ['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'id' => $id];

        $instrument = preg_replace('|/|', '_', $response['prices'][0]['instrument']);
        Forex_list::where('name_forex_instruments', $instrument)->update(['bids' => $bids, 'asks' => $asks, 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);

        $this->CallCache['return_resp'] = $return_resp;
        return response()->json($return_resp);

      } else {
        $pair = strtoupper($request->forexPair);
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $forex_api . $forex_account . "&symbol=" . $pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 53b0ba42e9b03cf529a81586d6466f62-a067660760437545c186f5ce5770fd7d",
            "cache-control: no-cache",
            "postman-token: c8849fbe-d3d0-53ab-1add-6623f43432b1",
          ),
        ));

        $response = curl_exec($curl);
        $http_code = 0;
        if (!curl_errno($curl)) {
          $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        }

        curl_close($curl);
        if ($http_code != '200') {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
        }
        if (!isset(json_decode($response)->low)) {
          return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
        }
        // var_dump(json_decode($response)->values[0]->low);
        // if ($http_status == 500 || $http_status == 503) {
        //     return response()->json(['bids'=>0, 'asks'=>0, 'closeoutBid'=>0, 'closeoutAsk'=>0, 'tradeable'=>0]);
        // }
        // else{
        $bids = json_decode($response)->low * 1;
        $asks = json_decode($response)->high * 1;
        $closeoutBid = json_decode($response)->open * 1;
        $closeoutAsk = json_decode($response)->close * 1;
        $tradeable = 1;

        $instrument = preg_replace('|/|', '_', $pair);
        Forex_list::where('name_forex_instruments', $instrument)->update(['bids' => $bids, 'asks' => $asks, 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);

        return response()->json(['bids' => $bids, 'asks' => $asks, 'closeoutBid' => $closeoutBid, 'closeoutAsk' => $closeoutAsk, 'tradeable' => $tradeable, 'id' => $id]);
        // }
      }
    } else {
      return response()->json(['bids' => 0, 'asks' => 0, 'closeoutBid' => 0, 'closeoutAsk' => 0, 'tradeable' => false]);
    }
  }

  public function getIgTradingInfo($pair) {
    $epic = Forex_list::where('name_forex_instruments', $pair)->value('epic');
    $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://demo-api.ig.com/gateway/deal/markets/$epic",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "X-IG-API-KEY: " . $ig_api_key,
        'X-SECURITY-TOKEN: ' . cache('x-security-token'),
        'CST: ' . cache('cst'),
        'Version: 3',
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    // return $response;
    $response = json_decode($response);
    // return response()->json($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        $res['bids'] = 0;
        $res['asks'] = 0;
        $res['tradeable'] = 0;
        $res['closeoutBid'] = 0;
        $res['closeoutAsk'] = 0;
        $res['id'] = $pair;
    } else {
        $res['tradeable'] = (($response->snapshot->marketStatus ?? 0) == 'TRADEABLE') ? 1 : 0;
        $res['bids'] = $response->snapshot->low ?? 0;
        $res['asks'] = $response->snapshot->high ?? 0;
        $res['closeoutBid'] = 0;
        $res['closeoutAsk'] = 0;
        $res['id'] = $pair;
    }

    Forex_list::where('epic', $epic)->update(['bids' => $res['bids'], 'asks' => $res['asks'], 'tradeable' => (int) $res['tradeable'], 'updated_at' => \now()]);

    return $res;
  }
}
