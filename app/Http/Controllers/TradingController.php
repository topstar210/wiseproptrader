<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Crypto_list;
use App\Forex_list;
use App\Stock_list;
use App\Order;
use App\Trade_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Binance\API as Binance_Api;
use Binance\RateLimiter as Binance_RateLimiter;

class TradingController extends Controller {

  public function makeOrder(Request $request) {

    $trade_kind = $request->trade_kind;
    $user_id = $request->user()->id;
    $trade_amount = $request->trade_amount;
    $trade_pair = explode("/", $request->trade_pair);
    $trade_price = $request->trade_price;

    $makeOrder_con = new Order;
    $makeOrder_con->user_id = $user_id;
    $makeOrder_con->trade_amount = $trade_amount;
    $makeOrder_con->base_symbol = $trade_pair[0];
    $makeOrder_con->quote_symbol = $trade_pair[1] ?? '';

    if ($trade_kind == "forex") {
      $makeOrder_con->kind = 'forex';
      $info = $this->getTradingInfo($trade_pair);
      $leverage = Forex_list::where('base_forex_instruments', $trade_pair[0])->where('quote_forex_instruments', $trade_pair[1])->value('leverage');
      $category = Forex_list::where('base_forex_instruments', $trade_pair[0])->where('quote_forex_instruments', $trade_pair[1])->value('category');
    }

    else if ($trade_kind == "stock") {
      $makeOrder_con->kind = 'stock';
      $info = $this->getStockTradingInfo($trade_pair);
      $leverage = Stock_list::where('base_stock', $trade_pair[0])->where('quote_stock', $trade_pair[1])->value('leverage');
      $category = Stock_list::where('base_stock', $trade_pair[0])->where('quote_stock', $trade_pair[1])->value('category');
    }

    else if ($trade_kind == "crypto") {
      $makeOrder_con->kind = $trade_kind;
      $info = $this->getCryptoTradingInfo($trade_pair);
      $leverage = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->value('leverage');
      $category = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->value('category');
    }

    $spread_cnsnt = $this->getSpreadSettings($category) ?: 1;
    $spread = ($info['bids'] - $info['asks']) * $spread_cnsnt * $trade_amount;
    // return $spread;
    // return ['bids' => $info['bids'], 'asks' => $info['asks'], 'spread_cnsnt' => $spread_cnsnt, 'trade_amount' => $trade_amount];
    $makeOrder_con->spread = $spread;

    if ($request->trade_profit_switch) {
      $makeOrder_con->profit = $request->trade_profit_amount;
    } else {
      $makeOrder_con->profit = 0;
    }
    if ($request->trade_loss_switch) {
      $makeOrder_con->loss = $request->trade_loss_amount;
    } else {
      $makeOrder_con->loss = 0;
    }
    $ticket = $this->generateTicket();
    $makeOrder_con->ticket = $ticket;
    $makeOrder_con->type = $request->type;
    // if ($request->type == 'sell') {
    //   $open_rate = $info['bids'];
    // } else {
    //   $open_rate = $info['asks'];
    // }

    $open_rate = $trade_price;

    if (!$open_rate) {
      return response()->json(['res' => 'open rate is 0']);
    }

    $margin = $request->required_margin;
    $balance = Balance::where('user_id', $user_id)->sum('balance');

    if ($margin > $balance) {
      $request->session()->flash('error', 'Require more Margin!');
      return response()->json(['res' => 'Require more Margin!']);
    }

    $free_margin = $request->free_margin;
    if ($margin > $free_margin) {
      $request->session()->flash('error', 'Require more Margin!');
      return response()->json(['res' => 'Margin required is larger then free margin!']);
    }
    $makeOrder_con->open_rate = $open_rate;
    $makeOrder_con->leverage = $leverage;
    $makeOrder_con->close_rate = 0;
    $makeOrder_con->pro_loss = 0;
    $makeOrder_con->status = 'open';
    $makeOrder_con->open_time = \now();
    $makeOrder_con->close_time = '';
    $makeOrder_con->profit_switch = $request->trade_profit_switch;
    $makeOrder_con->loss_switch = $request->trade_loss_switch;
    $makeOrder_con->fee = 0;
    if ($trade_kind == "stock") {
      $makeOrder_con->alias = Stock_list::where('base_stock', $trade_pair[0])->where('quote_stock', $trade_pair[1])->value('alias');
    }
    $makeOrder_con->save();

    $balance_con = new Balance;
    // $balance_con->balance = $margin * (-1);
    $balance_con->balance = 0;
    $balance_con->margin = $margin;
    $balance_con->currency = "USD";
    $balance_con->user_id = $user_id;
    $balance_con->ticket = $ticket;
    $balance_con->mode = "practice";
    $balance_con->save();

    return response()->json(['res' => 'ok']);
  }

  public function updateBalance(Request $request) {
    $user_id = $request->user()->id;
    $balance = Balance::where('user_id', $user_id)->sum('balance');
    $margin = Balance::where('user_id', $user_id)->sum('margin');
    return response()->json(['balance' => $balance, 'margin' => $margin, 'userCurrency' => curr_to_symbol(auth()->user()->getUserCurrency()), 'spread' => $this->getSpreadSettings()]);
  }

  public function getSpreadSettings($cat = false) {
    if ($cat) {
      return Trade_setting::where('name', 'spread_forex_'.$cat)->value('value');
    }

    $data = [];

    foreach(Forex_list::distinct()->pluck('category') as $cat) {
      $data['forex'][$cat] = Trade_setting::where('name', 'spread_forex_'.$cat)->value('value');
    }
    foreach(Stock_list::distinct()->pluck('category') as $cat) {
      $data['stock'][$cat] = Trade_setting::where('name', 'spread_stock_'.$cat)->value('value');
    }
    foreach(Crypto_list::distinct()->pluck('category') as $cat) {
      $data['crypto'][$cat] = Trade_setting::where('name', 'spread_crypto_'.$cat)->value('value');
    }
    return $data;
  }

  public function generateTicket() {
    do {
      $ticket = random_int(10000000, 99999999);
    } while (Order::where("ticket", $ticket)->first());

    return $ticket;
  }

  public function generateRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }
    return $randomString;
  }

  public function getTradingInfo($trade_pair) {
    $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    if ($ig_switch == 'on') {
      $epic = Forex_list::where('name_forex_instruments', implode("", $trade_pair))->where('type', 'IG')->value('epic');
      if ($epic) {
        return $this->getIgTradingInfo($trade_pair);
      }
    }

    $oanda_api_key = Trade_setting::where('name', 'oanda_api_key')->value('value');
    $oanda_account_number = Trade_setting::where('name', 'oanda_account_number')->value('value');
    $forex_api = Trade_setting::where('name', 'forex_api')->value('value');
    $forex_account = Trade_setting::where('name', 'forex_account')->value('value');
    $forex_switch = Trade_setting::where('name', 'forex_switch')->value('value');
    $pair = strtoupper($trade_pair[0] . '/' . $trade_pair[1]);
    $tradeable = 0;
    if ($forex_switch == 'on') {
      if ($oanda_api_key != '' && $oanda_account_number != '') {
        $urlFetchData = "https://api-fxpractice.oanda.com/v3/accounts/$oanda_account_number/pricing?instruments=$pair";
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
        $resp = curl_exec($ch);
        $http_code = 0;
        if (!curl_errno($ch)) {
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        $response = json_decode($resp, true);
        curl_close($ch);

        if ($http_code != '200' || !isset($response['prices'][0]['asks'][0]['price'])) {
          $res['bids'] = 0;
          $res['asks'] = 0;
        } else {
          $res['bids'] = $response['prices'][0]['bids'][0]['price'] * 1;
          $res['asks'] = $response['prices'][0]['asks'][0]['price'] * 1;
          $tradeable = $response['prices'][0]['tradeable'];
        }

      } else {
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
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        // var_dump(json_decode($response));
        $bids = json_decode($response)->low * 1;
        $asks = json_decode($response)->high * 1;
        $res['bids'] = $bids;
        $res['asks'] = $asks;
        $tradeable = 1;
      }
    } else {
      $res['bids'] = 0;
      $res['asks'] = 0;
    }

    $instrument = preg_replace('|/|', '_', $pair);
    $forex = Forex_list::where('name_forex_instruments', $instrument)->first();
    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $res['bids'] = $forex->bids;
      $res['asks'] = $forex->asks;
      return $res;
    } else {
      $forex->bids = $res['bids'];
      $forex->asks = $res['asks'];
      $forex->tradeable = $tradeable;
      $forex->updated_at = \now();
      $forex->save();
    }
    return $res;
  }
  
    public function getCryptoTradingInfo($trade_pair) {
    $ig_switch_crypto = Trade_setting::where('name', 'ig_switch_crypto')->value('value');
    $binance_switch = Trade_setting::where('name', 'binance_switch')->value('value');
    if ($binance_switch == 'on') {
      $name = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->where('type', 'binance')->value('name');
      if ($name) {
        return $this->getBinanceCryptoTradingInfo($name);
      }
    } else if ($ig_switch_crypto == 'on') {
      //$epic = Crypto_list::where('base', $trade_pair[0])->where('type', 'IG')->value('epic');
      $epic = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->where('type', 'IG')->value('epic');
      if ($epic) {
        return $this->getIgCryptoTradingInfo($epic);
      }
    }
    $crypto_switch = Trade_setting::where('name', 'crypto_switch')->value('value');
    $oanda_api_key = Trade_setting::where('name', 'oanda_api_key')->value('value');
    $oanda_account_number = Trade_setting::where('name', 'oanda_account_number')->value('value');
    $pair = strtoupper($trade_pair[0] . '/' . $trade_pair[1]);
    if ($crypto_switch == 'off') {
        $urlFetchData = "https://api-fxpractice.oanda.com/v3/accounts/$oanda_account_number/pricing?instruments=$pair";
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
        $resp = curl_exec($ch);
        $http_code = 0;
        if (!curl_errno($ch)) {
          $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        $response = json_decode($resp, true);
        curl_close($ch);
    
        if ($http_code != '200' || !isset($response['prices'][0]['asks'][0]['price'])) {
          $res['bids'] = 0;
          $res['asks'] = 0;
        } else {
          $res['bids'] = $response['prices'][0]['bids'][0]['price'] * 1;
          $res['asks'] = $response['prices'][0]['asks'][0]['price'] * 1;
          $tradeable = $response['prices'][0]['tradeable'];
        }
    } else {
      $res['bids'] = 0;
      $res['asks'] = 0;
      $tradeable = 0;
    }
    $instrument = preg_replace('|/|', '', $pair);
    $crypto = Crypto_list::where('name', $instrument)->first();
    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $res['bids'] = $crypto->bids;
      $res['asks'] = $crypto->asks;
      $res['api'] = 'twelve';
      return $res;
    } else {
      $crypto->bids = $res['bids'];
      $crypto->asks = $res['asks'];
      $crypto->tradeable = $tradeable;
      $crypto->updated_at = \now();
      $crypto->save();
    }
    return $res;
  }

//   public function getCryptoTradingInfo($trade_pair) {
//     $ig_switch_crypto = Trade_setting::where('name', 'ig_switch_crypto')->value('value');
//     $binance_switch = Trade_setting::where('name', 'binance_switch')->value('value');
//     if ($binance_switch == 'on') {
//       $name = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->where('type', 'binance')->value('name');
//       if ($name) {
//         return $this->getBinanceCryptoTradingInfo($name);
//       }
//     } else if ($ig_switch_crypto == 'on') {
//       //$epic = Crypto_list::where('base', $trade_pair[0])->where('type', 'IG')->value('epic');
//       $epic = Crypto_list::where('base', $trade_pair[0])->where('quote', $trade_pair[1])->where('type', 'IG')->value('epic');
//       if ($epic) {
//         return $this->getIgCryptoTradingInfo($epic);
//       }
//     }
//     $crypto_api = Trade_setting::where('name', 'crypto_api')->value('value');
//     $crypto_account = Trade_setting::where('name', 'crypto_account')->value('value');
//     $crypto_switch = Trade_setting::where('name', 'crypto_switch')->value('value');
//     $pair = strtoupper($trade_pair[0] . '/' . $trade_pair[1]);
//     if ($crypto_switch == 'on') {
//       $curl = curl_init();
//       curl_setopt_array($curl, array(
//         CURLOPT_URL => $crypto_api . $crypto_account . "&symbol=" . $pair . "&interval=1min",
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
//       curl_close($curl);
//       // var_dump(json_decode($response));
//       $bids = json_decode($response)->low * 1;
//       $asks = json_decode($response)->high * 1;
//       $res['bids'] = $bids;
//       $res['asks'] = $asks;
//       $tradeable = 1;
//     } else {
//       $res['bids'] = 0;
//       $res['asks'] = 0;
//       $tradeable = 0;
//     }
//     $instrument = preg_replace('|/|', '', $pair);
//     $crypto = Crypto_list::where('name', $instrument)->first();
//     if ($res['bids'] == 0 || $res['asks'] == 0) {
//       $res['bids'] = $crypto->bids;
//       $res['asks'] = $crypto->asks;
//       $res['api'] = 'twelve';
//       return $res;
//     } else {
//       $crypto->bids = $res['bids'];
//       $crypto->asks = $res['asks'];
//       $crypto->tradeable = $tradeable;
//       $crypto->updated_at = \now();
//       $crypto->save();
//     }
//     return $res;
//   }

  public function getIgCryptoTradingInfo($epic) {
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
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      $res['bids'] = 0;
      $res['asks'] = 0;
      $res['tradeable'] = 0;
      $res['err'] = $err;
      $tradeable = 0;
    } else {
      if (isset($response->errorCode) && preg_match('/(client-token-invalid|account-token-missing)/', $response->errorCode)) {
        cache()->forget('x-security-token');
        cache()->forget('cst');
      }
      $tradeable = (($response->snapshot->marketStatus ?? 0) == 'TRADEABLE') ? 1 : 0;
      $res['bids'] = $response->snapshot->bid ?? 0;
      $res['asks'] = $response->snapshot->offer ?? 0;
      $res['tradeable'] = $tradeable;
    }

    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $epic = Crypto_list::where('epic', $epic)->where('type', 'IG')->select('bids', 'asks')->first();
      if ($epic) {
        $res['bids'] = $epic->bids;
        $res['asks'] = $epic->asks;
      }
      $res['api'] = 'ig';
      $res['snapshot'] = isset($response->errorCode) ? $response->errorCode : $response;
      return $res;
    } else {
      Crypto_list::where('epic', $epic)->update(['bids' => $res['bids'], 'asks' => $res['asks'], 'tradeable' => (int) $tradeable, 'updated_at' => \now()]);
    }

    return $res;
  }

  public function getBinanceCryptoTradingInfo($name) {
    $binance_api_key = Trade_setting::where('name', 'binance_api_key')->value('value');
    $binance_secret = Trade_setting::where('name', 'binance_secret')->value('value');
    if ($binance_api_key != '' && $binance_secret != '') {
      $api = new Binance_RateLimiter(new Binance_Api($binance_api_key, $binance_secret));
      try {
        $bookPrice = $api->bookPrice(strtoupper($name));
        $res['bids'] = $bookPrice['bidPrice'] ?? 0;
        $res['asks'] = $bookPrice['askPrice'] ?? 0;
        $res['tradeable'] = (!$res['bids'] || !$res['asks']) ? 0 : 1;
      } catch(Exception $e) {
        $res['bids'] = 0;
        $res['asks'] = 0;
        $res['tradeable'] = 0;
      }
    } else {
      $res['bids'] = 0;
      $res['asks'] = 0;
      $res['tradeable'] = 0;
    }

    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $db_value = Crypto_list::where('name', $name)->where('type', 'binance')->select('bids', 'asks')->first();
      if ($db_value) {
        $res['bids'] = $db_value->bids;
        $res['asks'] = $db_value->asks;
      }
      return $res;
    } else {
      Crypto_list::where('name', $name)->where('type', 'binance')->update(['bids' => $res['bids'], 'asks' => $res['asks'], 'tradeable' => (int) $res['tradeable'], 'updated_at' => \now()]);
    }

    return $res;
  }

  public function getStockTradingInfo($trade_pair) {
    $stock = Stock_list::where('base_stock', $trade_pair)->first();
    $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
    $curl = curl_init();
    curl_setopt_array($curl, array(
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

    $response = curl_exec($curl);
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        $res['bids'] = 0;
        $res['asks'] = 0;
        $res['tradeable'] = 0;
        $res['err'] = $err;
        $tradeable = 0;
    } else {
        $tradeable = (($response->snapshot->marketStatus ?? 0) == 'TRADEABLE') ? 1 : 0;
        $res['bids'] = $response->snapshot->high ?? 0;
        $res['asks'] = $response->snapshot->low ?? 0;
        $res['tradeable'] = $tradeable;
    }

    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $res['bids'] = $stock->bids;
      $res['asks'] = $stock->asks;
      return $res;
    } else {
      $stock->bids = $res['bids'];
      $stock->asks = $res['asks'];
      $stock->tradeable = $res['tradeable'];
      $stock->updated_at = \now();
      $stock->save();
    }

    return $res;
  }

  public function getIgTradingInfo($pair) {
    $pair = implode("", $pair);
    $forex = Forex_list::where('name_forex_instruments', $pair)->first();
    $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://demo-api.ig.com/gateway/deal/markets/".$forex->epic,
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
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        $res['bids'] = 0;
        $res['asks'] = 0;
        $tradeable = 0;
    } else {
        $tradeable = (($response->snapshot->marketStatus ?? 0) == 'TRADEABLE') ? 1 : 0;
        $res['bids'] = $response->snapshot->bid ?? 0;
        $res['asks'] = $response->snapshot->offer ?? 0;
    }

    if ($res['bids'] == 0 || $res['asks'] == 0) {
      $res['bids'] = $forex->bids;
      $res['asks'] = $forex->asks;
      return $res;
    } else {
      $forex->bids = $res['bids'];
      $forex->asks = $res['asks'];
      $forex->tradeable = $tradeable;
      $forex->updated_at = \now();
      $forex->save();
    }

    return $res;
  }

  public function showOrder(Request $request) {
    $user_id = $request->user()->id;
    $data = Order::leftJoin('balances', 'balances.ticket', '=', 'orders.ticket')
      ->where('orders.user_id', $user_id)
      ->orderBy('orders.open_time', 'desc')
      ->select('orders.*', 'balances.margin')
      ->get();
    if (count($data)) {
      return response()->json(['data' => $data]);
    }
    return response()->json(['data' => 'no']);
  }

  // Kujdes nga mer id e orderit per ta mbyllur.
  public function closeOrder(Request $request) {
    $user_id = $request->user()->id;
    $id = (int) $request->id;
    $mrtk_rate = $request->market_rate;

    $getOrder = Order::where('user_id', $user_id)->where('id', $id)->first();
    if (!$getOrder) {
      return response()->json(['data' => 'error', 'message' => 'Order id not found!']);
    }

    $trade_pair[0] = $getOrder->base_symbol;
    $trade_pair[1] = $getOrder->quote_symbol;
    $kind = $getOrder->kind;
    $types = $getOrder->type;
    $open_rate = $getOrder->open_rate;
    $trade_amount = $getOrder->trade_amount;
    $fees = $getOrder->fee;
    $leverage = $getOrder->leverage;
    $ticket = $getOrder->ticket;

    $margin = Balance::where('user_id', $user_id)->sum('margin');
    if ($kind == "forex") {
      $trade_info = $this->getTradingInfo($trade_pair);
      // $margin = ($open_rate*$trade_amount)/$leverage;
    } elseif ($kind == "stock") {
      $trade_info = $this->getStockTradingInfo($trade_pair[0]);
    } elseif ($kind == "crypto") {
      $trade_info = $this->getCryptoTradingInfo($trade_pair);
      // $margin = ($open_rate*$trade_amount)/$leverage;
    }

    $rate = 1;
    $close_rate = $mrtk_rate;
    $logged_user_currency = auth()->user()->getUserCurrency() || 'EUR';

    if ($logged_user_currency != $trade_pair[1]) {
      if ($kind == "crypto") {
        $rate_resp = get_exchange_rate_cryptocompare($trade_pair[1], $logged_user_currency);
        if ($rate_resp['status'] == 'success') {
          Cache::put('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addMinutes(5));
          $rate = $rate_resp['rate'];
        } else {
          return response()->json(['data' => $rate_resp['message']]);
        }
      } else {
        $rate_resp = get_exchange_rate_fixerio($trade_pair[1], $logged_user_currency);
        if ($rate_resp['status'] == 'success') {
          Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addHours(1));
          $rate = $rate_resp['rate'];
        } else {
          return response()->json(['data' => $rate_resp['message']]);
        }
      }
    }
    if ($types == 'sell') {
      $close_rate = $trade_info['bids'];
      // $pro_loss = ($close_rate / $open_rate - 1) * -$leverage * $margin;
      $pro_loss = (($trade_amount * ($open_rate - $close_rate)) + $getOrder->spread) / $close_rate;
    } else {
      $close_rate = $trade_info['asks'];
      // $pro_loss = ($close_rate / $open_rate - 1) * $leverage * $margin;
      $pro_loss = (($trade_amount * ($close_rate - $open_rate)) + $getOrder->spread) / $close_rate;
    }


    // $pro_loss = ($close_rate-$open_rate)/$open_rate*$leverage*$trade_amount-$fees;
    // $pro_loss = ($close_rate-$open_rate)*10000;
    $getOrder->close_rate = $close_rate;
    $getOrder->close_time = \now();
    $getOrder->status = 'closed';
    $getOrder->pro_loss = $pro_loss;
    $getOrder->save();

    Balance::where('ticket', $ticket)->update(['balance' => $pro_loss, 'margin' => 0]);
    // $balance_con->balance = $margin+$pro_loss;
    // $balance_con->margin = $margin*(-1);
    // $balance_con->user_id = $request->user()->id;
    // $balance_con->currency = 'USD';
    // $balance_con->ticket = $ticket;
    // $balance_con->mode = 'practice';
    // $balance_con->save();
    return response()->json(['data' => 'ok', 'message' => 'Order closed!']);
  }

  public function closeAllOrder(Request $request) {
    $user_id = $request->user()->id;
    $orders = Order::where('user_id', $user_id)->where('status', 'open')->get();
    foreach ($orders as $order) {
      $trade_pair[0] = $order->base_symbol;
      $trade_pair[1] = $order->quote_symbol;
      $kind = $order->kind;
      $types = $order->type;
      $open_rate = $order->open_rate;
      $trade_amount = $order->trade_amount;
      $fees = $order->fee;
      $leverage = $order->leverage;
      $ticket = $order->ticket;

      $margin = Balance::where('user_id', $user_id)->sum('margin');
      if ($kind == "forex") {
        $trade_info = $this->getTradingInfo($trade_pair);
        // $margin = ($open_rate*$trade_amount)/$leverage;
      } elseif ($kind == "stock") {
        $trade_info = $this->getStockTradingInfo($trade_pair[0]);
      } elseif ($kind == "crypto") {
        $trade_info = $this->getCryptoTradingInfo($trade_pair);
        // $margin = ($open_rate*$trade_amount)/$leverage;
      }

      $rate = 1;
      $close_rate = 0;
      $logged_user_currency = auth()->user()->getUserCurrency();

      if ($logged_user_currency != $trade_pair[1]) {
        if ($kind == "crypto") {
          $rate_resp = get_exchange_rate_cryptocompare($trade_pair[1], $logged_user_currency);
          if ($rate_resp['status'] == 'success') {
            Cache::put('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addMinutes(5));
            $rate = $rate_resp['rate'];
          } else {
            return response()->json(['data' => $rate_resp['message']]);
          }
        } else {
          $rate_resp = get_exchange_rate_fixerio($trade_pair[1], $logged_user_currency);
          if ($rate_resp['status'] == 'success') {
            Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addHours(1));
            $rate = $rate_resp['rate'];
          } else {
            return response()->json(['data' => $rate_resp['message']]);
          }
        }
      }
      if ($types == 'sell') {
        $close_rate = $trade_info['bids'];
        // $pro_loss = ($close_rate / $open_rate - 1) * -$leverage * $margin;
        $pro_loss = (($trade_amount * ($open_rate - $close_rate)) + $order->spread) / $close_rate;
      } else {
        $close_rate = $trade_info['asks'];
        // $pro_loss = ($close_rate / $open_rate - 1) * $leverage * $margin;
        $pro_loss = (($trade_amount * ($open_rate - $close_rate)) + $order->spread) / $close_rate;
      }

      // $pro_loss = ($close_rate-$open_rate)/$open_rate*$leverage*$trade_amount-$fees;
      // $pro_loss = ($close_rate-$open_rate)*10000;
      $order->close_rate = $close_rate;
      $order->close_time = \now();
      $order->status = 'closed';
      $order->pro_loss = $pro_loss;
      $order->update();

      Balance::where('ticket', $ticket)->update(['balance' => $pro_loss, 'margin' => 0]);
      // $balance_con = new Balance;
      // $balance_con->balance = $margin+$pro_loss;
      // $balance_con->margin = $margin*(-1);
      // $balance_con->user_id = $request->user()->id;
      // $balance_con->currency = 'USD';
      // $balance_con->ticket = $ticket;
      // $balance_con->mode = 'practice';
      // $balance_con->save();
    }
    return response()->json(['data' => 'ok']);
  }

  public function setTakeProfit(Request $request) {
    $validator = \Validator::make($request->all(), [
      'id' => 'required',
      'val' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json(['status' => 'danger', 'message' => $validator]);
    }

    $id = (int) $request->input('id');
    $val = (float) $request->input('val');
    $user_id = $request->user()->id;

    $order_con = Order::where('user_id', $user_id)->where('id', $id)->first();
    if ($order_con) {
      $order_con->profit = abs($val);
      $order_con->profit_switch = 1;
      $order_con->update();
      return response()->json(['status' => 'success', 'message' => 'Order updated!']);
    } else {
      return response()->json(['status' => 'danger', 'message' => 'Order id not found!']);
    }
  }

  public function setStopLose(Request $request) {
    $validator = \Validator::make($request->all(), [
      'id' => 'required',
      'val' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json(['status' => 'danger', 'message' => $validator]);
    }

    $id = (int) $request->input('id');
    $val = (float) $request->input('val');
    $user_id = $request->user()->id;

    $order_con = Order::where('user_id', $user_id)->where('id', $id)->first();
    if ($order_con) {
      $order_con->loss = abs($val);
      $order_con->loss_switch = 1;
      $order_con->update();
      return response()->json(['status' => 'success', 'message' => 'Order updated!']);
    } else {
      return response()->json(['status' => 'danger', 'message' => 'Order id not found!']);
    }
  }

  public function getExchangeRate(Request $request) {
    $kind = $request->get('kind', '');
    $pair = $request->get('pair', '');
    $trade_pair = explode('/', $pair);
    $resp['rate'] = 1;
    $logged_user_currency = auth()->user()->getUserCurrency() ?? 'USD';

    if (is_array($trade_pair) && isset($trade_pair[1])) {
      if ($logged_user_currency != $trade_pair[1]) {
        if ($kind == "crypto") {
          if (Cache::has('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency)) {
            $resp['rate'] = Cache::get('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency);
          } else {
            $rate_resp = get_exchange_rate_cryptocompare($trade_pair[1], $logged_user_currency);
            if ($rate_resp['status'] == 'success') {
              Cache::put('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addMinutes(5));
              $resp['rate'] = $rate_resp['rate'];
            }
          }
        } else {
          if (Cache::has('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency)) {
            $resp['rate'] = Cache::get('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency);
          } else {
            $rate_resp = get_exchange_rate_fixerio($trade_pair[1], $logged_user_currency);
            $cus_req_pair;
            if($trade_pair[1] == "CNH") {
                $cus_req_pair = "CNY";
            } else {
                $cus_req_pair = $trade_pair[1];
            }
            $url = "https://api.currencyapi.com/v3/latest?apikey=9MSvxcH2br22PDoYbknJ2rWrPXQd7LHxJktUisJX&base_currency=" . $logged_user_currency . "&currencies=" . $cus_req_pair;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            $response = curl_exec($curl);
            curl_close($curl);
            
            $data = json_decode($response, true);
            
            $resp['rate'] = $data['data'][$cus_req_pair]['value'];
            Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $data['data'][$cus_req_pair]['value'], now()->addHours(1));

            if ($rate_resp['status'] == 'success') {
              //Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addHours(1));
              //$resp['rate'] = $rate_resp['rate'];
              //$resp['rate'] = 5;
            }
          }
        }
      }
    }

    return response()->json($resp);
  }

  public function getMarketInfo(Request $request) {
    $kind = $request->kind;
    $trade_pair[0] = $request->base_symbol;
    $trade_pair[1] = $request->quote_symbol;
    $rate = 1;
    $logged_user_currency = auth()->user()->getUserCurrency() ?? 'USD';
    if ($kind == "forex") {
      $res = $this->getTradingInfo($trade_pair);
    } elseif ($kind == "stock") {
      $res = $this->getStockTradingInfo($trade_pair[0]);
    } elseif ($kind == "crypto") {
      $res = $this->getCryptoTradingInfo($trade_pair);
    }
    if ($logged_user_currency != $trade_pair[1]) {
      if ($kind == "crypto") {
        if (Cache::has('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency)) {
          $rate = Cache::get('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency);
        } else {
          $rate_resp = get_exchange_rate_cryptocompare($trade_pair[1], $logged_user_currency);
          if ($rate_resp['status'] == 'success') {
            Cache::put('cryptocompare_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addMinutes(5));
            $rate = $rate_resp['rate'];
          }
        }
      } else {
        if (Cache::has('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency)) {
          $rate = Cache::get('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency);
        } else {
            $rate_resp = get_exchange_rate_fixerio($trade_pair[1], $logged_user_currency);
            $cus_req_pair;
            if($trade_pair[1] == "CNH") {
                $cus_req_pair = "CNY";
            } else {
                $cus_req_pair = $trade_pair[1];
            }
            $url = "https://api.currencyapi.com/v3/latest?apikey=9MSvxcH2br22PDoYbknJ2rWrPXQd7LHxJktUisJX&base_currency=" . $logged_user_currency . "&currencies=" . $cus_req_pair;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            $response = curl_exec($curl);
            curl_close($curl);
            
            $data = json_decode($response, true);
            
            $resp['rate'] = $data['data'][$cus_req_pair]['value'];
            $rate = $data['data'][$cus_req_pair]['value'];
            Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $data['data'][$cus_req_pair]['value'], now()->addHours(1));

            if ($rate_resp['status'] == 'success') {
              //Cache::put('fixerio_rate_'.$trade_pair[1].'_to_'.$logged_user_currency, $rate_resp['rate'], now()->addHours(1));
              //$resp['rate'] = $rate_resp['rate'];
              //$resp['rate'] = 5;
            }
        }
      }
    }
    $res['rate'] = $rate;
    return response()->json(['data' => $res]);
  }

  public function getCryptoPrice($pair) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.alternative.me/v1/ticker/?convert=USD",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: 43e69508-dcb5-365e-310c-7a5198081d42",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return 0;
    } else {
      $res = json_decode($response);
      $coin_price = 0;
      foreach ($res as $res) {
        $temp = $res->symbol;
        if ($res->symbol == $pair) {
          $coin_price = $res->price_usd;
          break;
        }
      }

      return $coin_price;
    }
  }

  public function getIgCryptoPrice($pair) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://demo-api.ig.com/gateway/deal/markets/CS.D.$pair.CFD.IP",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "X-IG-API-KEY: " . config('app.ig_api_key'),
        'X-SECURITY-TOKEN: ' . cache('x-security-token'),
        'CST: ' . cache('cst'),
        'Version: 2',
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      return 0;
    }

    return $response->snapshot->bid;
  }

  public function getStopout() {
    $stopout = Trade_setting::where('name', 'stopout')->value('value');
    if ($stopout === null) {
      $data = "20";
    } else {
      $data = $stopout;
    }
    return response()->json(['stopout' => $data]);
  }
}
