<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rave;
use App\Balance;
use App\Deposit_history;

class RaveController extends Controller
{
    public function initialize(){
        //This initializes payment and redirects to the payment gateway//The initialize method takes the parameter of the redirect URL
        Rave::initialize(route('callback'));
        
    }

    public function initialize_Get(){
        //This initializes payment and redirects to the payment gateway//The initialize method takes the parameter of the redirect URL
        return redirect('/profile');
        
    }
   
    public function callback(Request $request){
        $data = Rave::verifyTransaction(request()->txref);
        dd($data);  // view the data response

        if ($data->status == 'success') {
            
            $request->session()->flash('message', 'Payment deposit done successfully!');
        }
        else {
            $request->session()->flash('message', 'Invalid Payment!');
            
        }
        return redirect('/home');
    }

    public function callback_Get(Request $request){
        // $data = Rave::verifyTransaction(request()->txref);
        // dd($data);  // view the data response
        // var_dump(json_decode($request->resp)->data->transactionobject->charged_amount); exit;
        $res = json_decode($request->resp);
        var_dump($res->data);
        if ($res->success) {
        // if ($res->status == 'success') {
            $request->session()->flash('message', 'Payment deposit done successfully!');
            $charged_amount = $res->data->tx->charged_amount;
            $currency = $res->data->tx->currency;
            $balance_con = new Balance;
            $balance_con -> user_id = $request->user()->id;
            $balance_con -> currency = $currency;
            $balance_con -> balance = $charged_amount;
            $balance_con -> margin = 0;
            $balance_con -> save();
            $deposit_con = new Deposit_history;
            $deposit_con -> user_id = $request->user()->id;
            $deposit_con -> amount = $charged_amount;
            $deposit_con -> currency = $currency;
            $deposit_con -> mode = "deposit";
            $deposit_con -> save();
        }
        else {
            $request->session()->flash('message', 'Invalid Payment!');
            
        }
        return redirect('/home');
    }

    public function payTest(Request $request)
    {
        $balance_con = new Balance;
        $balance_con -> user_id = $request->user()->id;
        $balance_con -> currency = $request->currency;
        $balance_con -> balance = $request->amount;
        $balance_con -> margin = 0;
        $balance_con -> save();
    }


}
