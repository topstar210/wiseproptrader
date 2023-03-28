<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;
use App\Deposit_history;
use App\Deposit_transfer;
use App\Payment_gateway;


class bridgerPayController extends Controller
{
    public function Deposit($country, $firstname, $lastname, $email, $phone, $address, $state, $city, $zip, $amount, $currency)
    {
        $cashierKey = Payment_gateway::where('Gateway', 'bridgerPay')->value('PublicKey');
        $apiURL = Payment_gateway::where('Gateway', 'bridgerPay')->value('SecretKey');
        $orderId = $this->generateRandomString(8);
        $data['cashierKey'] = $cashierKey;
        $data['apiURL'] = $apiURL;
        $data['country'] = $country;
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email;
        $data['phone'] = $phone;
        $data['address'] = $address;
        $data['state'] = $state;
        $data['city'] = $city;
        $data['zip'] = $zip;
        $data['amount'] = $amount;
        $data['currency'] = $currency;
        $data['order_id'] = $orderId;
        $log_con = new Deposit_transfer;
        $log_con->orderId = $orderId;
        $log_con->amount = $amount;
        $log_con->currency = $currency;
        $log_con->save();
        return view('payment.bridgerPay', ['data' => $data]);
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function depositSuccess(Request $request)
    {
        $user_id = $request->user()->id;
        $orderId = $request->orderId;
        $amount = Deposit_transfer::where('orderId', $orderId)->value('amount');
        $currency = Deposit_transfer::where('orderId', $orderId)->value('currency');

        if ($amount == null) {
            $amount = 0;
        } else {
            $amount = $amount - $amount * 0.045;
            $user_id = $request->user()->id;
            $deposit_con = new Deposit_history;
            $deposit_con->amount = $amount;
            $deposit_con->currency = $currency;
            $deposit_con->user_id = $user_id;
            $deposit_con->mode = "BirdgerPay Deposit";
            $deposit_con->save();

            if ($currency == "EUR") {
                $amount = $amount * 1.1;
            }

            $balace_con = new  Balance;
            $balace_con->balance = $amount;
            $balace_con->margin = 0;
            $balace_con->currency = "USD";
            $balace_con->ticket = "";
            $balace_con->mode = "practice";
            $balace_con->user_id = $user_id;
            $balace_con->save();
            Deposit_transfer::whereNotNull('id')->delete();
            $request->session()->flash('message', 'Payment deposit done successfully!');
        }

        return redirect('/home');
    }

    public function depositFailed(Request $request)
    {
        Deposit_transfer::whereNotNull('id')->delete();
        $request->session()->flash('message', 'Payment deposit Failed. Please try again later!');
        return redirect('/profile');
    }
}
