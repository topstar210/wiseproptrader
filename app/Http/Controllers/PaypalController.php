<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

use App\Balance;
use App\Deposit_history;
use App\Payment_gateway;

class PaypalController extends Controller
{
    private $_api_context;
    
    public function __construct()
    {
        
        $paypal = Payment_gateway::where('Gateway', 'paypal')->get();
        if (count($paypal) == 0) {
            $client_id = "";
            $secretKey = "";
            $paypal_switch = "";
        }
        else {
            foreach ($paypal as $paypal) {
                $client_id = $paypal['PublicKey'];
                $secretKey = $paypal['SecretKey'];
                $paypal_switch = $paypal['Environment'];
            }
        }    
        $paypal_configuration = \Config::get('paypal');
        $paypal_configuration['settings']['mode'] = $paypal_switch;
        $this->_api_context = new ApiContext(new OAuthTokenCredential($client_id, $secretKey));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return Redirect::route('home');
    }

    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('paypal_amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('paypal_amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::flash('message','Connection timeout');
                return Redirect::route('home');                
            } else {
                \Session::flash('message','Some error occur, sorry for inconvenient');
                return Redirect::route('home');                
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::flash('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::flash('message','Unknown error occurred');
    	return Redirect::route('home');
    }

    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::flash('message','Payment failed');
            return Redirect::route('home');
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {         
            \Session::flash('message','Deposit Successfully!!');

            $trans = $result->transactions;
            $amount = $trans[0]->amount;
            // var_dump($amount->total); exit;
            $balance_con = new Balance;
            $balance_con -> user_id = $request->user()->id;
            $balance_con -> currency = "USD";
            $balance_con -> balance = $amount->total;
            $balance_con -> mode = "practice";
            $balance_con -> margin = 0;
            $balance_con -> save();
            $deposit_con = new Deposit_history;
            $deposit_con -> user_id = $request->user()->id;
            $deposit_con -> amount = $amount->total;
            $deposit_con -> currency = "USD";
            $deposit_con -> mode = "deposit";
            $deposit_con -> save();

            return Redirect::route('home');
        }

        \Session::flash('message','Payment failed !!');
		return Redirect::route('home');
    }

    public function paypalPayout() {
        return view('payment.paypal');
    }
}
