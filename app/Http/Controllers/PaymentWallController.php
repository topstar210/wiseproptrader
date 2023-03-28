<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Deposit_history;
use App\Http\Requests\CardVerificationRequest;
use App\Payment_gateway;
use App\Deposit_transfer;
use Illuminate\Http\Request;
use Paymentwall_Charge;
use Paymentwall_Config;
use Paymentwall_Pingback;
use Paymentwall_OneTimeToken;
use Illuminate\Support\Facades\Log;

class PaymentWallController extends Controller {

  public function __construct() {
    $paymentWall = Payment_gateway::where('Gateway', 'paymentWall')->first();

    if ($paymentWall) {
      Paymentwall_Config::getInstance()->set(array(
        'api_type' => Paymentwall_Config::API_VC,
        'public_key' => $paymentWall->PublicKey,
        'private_key' => $paymentWall->SecretKey,
      ));
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\CardVerificationRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function paymentwall_pay(CardVerificationRequest $request) {
    $validatedCardData = $request->validated();
    $validator = \Validator::make($request->all(), [
      'p-wall-email' => 'required|email',
      'p-wall-amount' => 'required|int',
    ]);
    if ($validator->fails()) {
      return response()->json(['status' => 'danger', 'message' => $validator->errors()->all()]);
    }

    $user_id = $request->user()->id;
    $p_wall_amount = abs((int) $request->get('p-wall-amount'));
    $p_wall_email = $request->get('p-wall-email');
    $card_number = $validatedCardData['card_number'];
    $expiration_month = $validatedCardData['expiration_month'];
    $expiration_year = $validatedCardData['expiration_year'];
    $cvc = $validatedCardData['cvc'];
    $currency = "USD";

    $tokenModel = new Paymentwall_OneTimeToken();
    $token = $tokenModel->create(array(
      'public_key' => Paymentwall_Config::getInstance()->getPublicKey(),
      'card[number]' => $card_number,
      'card[exp_month]' => $expiration_month,
      'card[exp_year]' => $expiration_year,
      'card[cvv]' => $cvc,
    ));

    $charge = new Paymentwall_Charge();
    $charge->create(array(
      'token' => $token->getToken(),
      'email' => $p_wall_email,
      'currency' => $currency,
      'amount' => $p_wall_amount,
      // 'fingerprint' => $_POST['brick_fingerprint'],
      'description' => 'deposit from ' . $p_wall_email,
    ));

    $response = $charge->getPublicData();

    if ($charge->isSuccessful()) {
      if ($charge->isCaptured()) {

        $log_con = new Deposit_transfer;
        $log_con->orderId = $charge->getId();
        $log_con->amount = $p_wall_amount;
        $log_con->currency = $currency;
        $log_con->status = 'approved';
        $log_con->user_id = $user_id;
        $log_con->save();

        $deposit_con = new Deposit_history;
        $deposit_con->deposit_id = $charge->getId();
        $deposit_con->amount = $p_wall_amount;
        $deposit_con->currency = $currency;
        $deposit_con->user_id = $user_id;
        $deposit_con->mode = "Paymentwall Deposit";
        $deposit_con->save();

        $balace_con = new Balance;
        $balace_con->balance = $p_wall_amount;
        $balace_con->margin = 0;
        $balace_con->currency = $currency;
        $balace_con->ticket = "";
        $balace_con->mode = "practice";
        $balace_con->user_id = $user_id;
        $balace_con->save();

        return response()->json(['status' => 'success', 'message' => 'Payment deposit was succesfull!']);
      } elseif ($charge->isUnderReview()) {

        $log_con = new Deposit_transfer;
        $log_con->orderId = $charge->getId();
        $log_con->amount = $p_wall_amount;
        $log_con->currency = $currency;
        $log_con->status = 'pending';
        $log_con->user_id = $user_id;
        $log_con->save();
        // decide on risk charge
        return response()->json(['status' => 'warning', 'message' => 'Payment is under review!']);
      }
    } else {
      $errors = json_decode($response, true);
      return response()->json(['status' => 'danger', 'message' => $errors['error']['message']]);
    }

    return response()->json(['status' => 'success', 'message' => $response]);
  }

  public function paymentwall_pingback(Request $request) {

    $channel = Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/paymentwall-pingback.log'),
    ]);
    Log::stack(['slack', $channel])->info('paymentwall pingback request', $request->all());

    $pingback = new Paymentwall_Pingback($_GET, $_SERVER['REMOTE_ADDR']);
    if ($pingback->validate()) {

      $deposit_r = Deposit_transfer::where('orderId', $pingback->getReferenceId())->where('status', 'pending')->first();
      if ($deposit_r) {
        if ($pingback->isDeliverable()) {
          // deliver the virtual currency
          $deposit_con = new Deposit_history;
          $deposit_con->deposit_id = $charge->getReferenceId();
          $deposit_con->amount = $deposit_r->amount;
          $deposit_con->currency = $deposit_r->currency;
          $deposit_con->user_id = $deposit_r->user_id;
          $deposit_con->mode = "Paymentwall Deposit";
          $deposit_con->save();

          $balace_con = new Balance;
          $balace_con->balance = $deposit_r->amount;
          $balace_con->margin = 0;
          $balace_con->currency = $deposit_r->currency;
          $balace_con->ticket = "";
          $balace_con->mode = "practice";
          $balace_con->user_id = $deposit_r->user_id;
          $balace_con->save();

          $deposit_r->status = 'approved';
          $deposit_r->save();
        } else if ($pingback->isCancelable()) {
          // withdraw the virtual currency
          $deposit_r->status = 'cancelled';
          $deposit_r->save();
        } else if ($pingback->isUnderReview()) {
          echo 'pending';
          // set "pending" status to order
        }
      }
      echo 'OK'; // Paymentwall expects response to be OK, otherwise the pingback will be resent
    } else {
      echo $pingback->getErrorSummary();
    }
  }
}
