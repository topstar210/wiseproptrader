<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hexters\CoinPayment\CoinPayment;
use App\Balance;
use App\Deposit_history;
use Session;


class CoinPayController extends Controller
{
  public function coinPay(Request $request)
  {
    $amount = $request->coinPayAmount;
    $description = $request->coinPayDescription;
    $buyer_name = $request->coinPayName;
    $buyer_email = $request->coinPayEmail;
    $order_id = uniqid();
    $transaction['order_id'] = $order_id; // invoice number
    $transaction['amountTotal'] = (float) $amount;
    $transaction['note'] = 'Transaction note';
    $transaction['buyer_name'] = $buyer_name;
    $transaction['buyer_email'] = $buyer_email;
    $transaction['redirect_url'] = url('/coinPay/success/'.$order_id.'/'.$amount); // When Transaction was comleted
    $transaction['cancel_url'] = url('/coinPay/failed/'.$order_id); // When user click cancel link


    /*
        *   @required true
        *   @example first item
        */
    $transaction['items'][] = [
      'itemDescription' => $description,
      'itemPrice' => (float) $amount, // USD
      'itemQty' => (int) 1,
      'itemSubtotalAmount' => (float) $amount // USD
    ];


    $transaction['payload'] = [
      'foo' => [
        'bar' => 'baz'
      ]
    ];

    $redirect_url = CoinPayment::generatelink($transaction);
    return redirect($redirect_url);
  }

  public function coinPaySuccess(Request $request, $order_id, $amount)
  {
    $real_amount = $amount - $amount * 0.045;
        $balance_con = new Balance;
        $balance_con -> user_id = $request->user()->id;
        $balance_con -> currency = "USD";
        $balance_con -> balance = $real_amount;
        $balance_con -> ticket = "";
        $balance_con -> mode = "Coinpayment_deposit";
        $balance_con -> margin = 0;
        $balance_con -> save();
        $deposit_con = new Deposit_history;
        $deposit_con -> user_id = $request->user()->id;
        $deposit_con -> amount = $real_amount;
        $deposit_con -> currency = "USD";
        $deposit_con -> mode = " Coinpayment Deposit";
        $deposit_con -> save();
        Session::flash('success', 'Payment deposit $'.$real_amount.' successful!');
        return redirect('home');
  }

  public function coinPayFailed($order_id)
  {
        Session::flash('success', 'Payment deposit canceled !');
        return redirect('profile');
  }
}
