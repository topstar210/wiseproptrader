<?php

namespace App\Http\Controllers;

use App\Admin_setting;
use App\Balance;
use App\Crypto_list;
use App\Stock_list;
use App\Forex_list;
use App\Deposit_history;
use App\Deposit_transfer;
use App\Exports\ClientStatementExport;
use App\Mail\WithdrawRequested;
use App\Order;
use App\Payment_gateway;
use App\Personal_info;
use App\Trade_setting;
use App\User;
use App\User_verify_setting;
use App\Withdraw;
use Cache;
use App\WpPack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Browser;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request) {

    $order = Order::orderBy('id', 'desc')->select('base_symbol', 'quote_symbol', 'trade_amount', 'type')->get();
    $res = Admin_setting::where('name', 'LogoSetting')->get();
    if (count($res) == 0) {
      $data['logoPath'] = asset('landingAssets/images/logo.jpg');
    } else {
      $logoPath = Admin_setting::where('name', 'LogoSetting')->value('value1');
      $data['logoPath'] = asset('uploads/' . $logoPath);
    }

    $PageSettings = Admin_setting::where('name', 'PageSettings')->first();
    if ($PageSettings) {
        $data['contact_email'] = $PageSettings->value1 ?? '';
        $data['contact_phone'] = $PageSettings->value2 ?? '';
        $data['contact_address'] = $PageSettings->value3 ?? '';
        $data['contact_license'] = $PageSettings->value4 ?? '';
        $data['privacy_content'] = $PageSettings->value11 ?? '';
        $data['policy_content'] = $PageSettings->value12 ?? '';
    }
    $user_id = $request->user()->id;
    $role = $request->user()->role;
    $verify_res = User_verify_setting::where('user_id', $user_id)->get();
    if ($role < 5) {
      $verify = true;
    } else if (count($verify_res) == 0) {
      $verify = false;
    } else {
      $res = User_verify_setting::where('user_id', $user_id)->value("verify_approved");
      if ($res == "Approved") {
        $verify = true;
      } else {
        $verify = false;
      }
    }
    if ($role < 5) {
      $is_admin = true;
    } else {
      $is_admin = false;
    }

    $forexLotsList = false;
    $forexLotsSwitch = Trade_setting::where('name', 'forexLotsSwitch')->value('value');
    if ($forexLotsSwitch) {
      $forexLotsList = Trade_setting::where('name', 'forexLotsList')->value('value');
    }

    $username = $request->user()->name;

    $ret = ['order' => $order, 'data' => $data, 'verify' => $verify, 'is_admin' => $is_admin, 'user_name' => $username, 'forexLotsList' => $forexLotsList, 'forexLotsSwitch' => $forexLotsSwitch];

    if (Browser::isMobile()) {
      return view('mobile.home', $ret);
    } else if (Browser::isTablet()) {
      return view('tablet.home', $ret);
    } else {
      return view('home', $ret);
    }
  }

  public function profile(Request $request) {
    $user_id = (int) $request->user()->id;
    $user = User::find($user_id);
    $res_profile = Personal_info::where('user_id', $user_id)->first();
    $data = [
      'name' => $user->name,
      'email' => $user->email,
      'lang' => '',
      'phone' => '',
      'birth' => '',
      'country' => '',
      'city' => '',
      'address' => '',
      'zip' => '',
      'referalCode' => '',
      // 'userCurrency' => '',
    ];
    if ($res_profile) {
      $data['lang'] = $res_profile->lang;
      $data['phone'] = $res_profile->phone;
      $data['birth'] = $res_profile->birth;
      $data['country'] = $res_profile->country;
      $data['city'] = $res_profile->city;
      $data['address'] = $res_profile->address;
      $data['zip'] = $res_profile->zip;
      $data['referalCode'] = $res_profile->referalCode;
      // $data['userCurrency'] = $res_profile->userCurrency;
    }
    // var_dump($data); exit;
    $res = Admin_setting::where('name', 'LogoSetting')->get();
    if (count($res) == 0) {
      $data['logoPath'] = asset('landingAssets/images/logo.jpg');
    } else {
      $logoPath = Admin_setting::where('name', 'LogoSetting')->value('value1');
      $data['logoPath'] = asset('uploads/' . $logoPath);
    }
    $data['FrontPaymentButtons'] = Admin_setting::where('name', 'FrontPaymentButtons')->first();
    $data['FrontPaymentButtonsCrypt'] = Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->first();
    $data['rave_title'] = Payment_gateway::where('Gateway', 'flutterwave')->value('Environment');
    $data['deposits'] = Deposit_history::where('user_id', $user_id)->orderBy('id', 'desc')->get();
    $data['withdraws'] = Withdraw::where('user_id', $user_id)->orderBy('id', 'desc')->get();
    $data['pending_transfers'] = Deposit_transfer::where('user_id', $user_id)->whereIn('status', ['pending', 'cancelled'])->orderBy('id', 'desc')->get();


   // TenPercentProfitCalculation 
    $TenPercentProfitCalculation = Order::where('user_id', $user_id)->where('status', 'closed')->where('type', 'buy')->get();
    $TradeAmountSum = $TenPercentProfitCalculation->sum('trade_amount');
    $ProfitSum = $TenPercentProfitCalculation->sum('profit');
      //calculate 10% of total trade amount
    $TenPercentProfitAmount = $TradeAmountSum * 0.1;
    $TenPercentProfit = 0;
    if ($ProfitSum >= $TenPercentProfitAmount) {
      $TenPercentProfit = 1;
    } else {
      $TenPercentProfit = 0;
    }

    $role = $request->user()->role;
    $verify_res = User_verify_setting::where('user_id', $user_id)->get();
    if ($role < 5) {
      $verify = true;
    } else if (count($verify_res) == 0) {
      $verify = false;
    } else {
      $res = User_verify_setting::where('user_id', $user_id)->value("verify_approved");
      if ($res == "Approved") {
        $verify = true;
      } else {
        $verify = false;
      }
    }
    if ($role < 5) {
      $is_admin = true;
    } else {
      $is_admin = false;
    }
    $active_payment_gateways = Payment_gateway::where('real_switch', 1)->get();

    $per_page = (int) $request->get('per_page', 15);
    $filter_date_from = $request->get('date_from', '');
    $filter_date_to = $request->get('date_to', '');
    if ($filter_date_from != '' || $filter_date_to != '') {
      $validator = \Validator::make($request->all(), [
        'date_from' => 'required|date_format:d/m/Y',
        'date_to' => 'required|date_format:d/m/Y|after_or_equal:date_from',
      ]);
      if ($validator->fails()) {
        return view('profile.profile', ['data' => $data, 'verify' => $verify, 'is_admin' => $is_admin, 'active_payment_gateways' => $active_payment_gateways, 'TenPercentProfit' => $TenPercentProfit, 'trade_statement' => Order::where('orders.id', -1)])->withErrors($validator);
      }
      $filter_date_from = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_from))) . ' 00:00:01';
      $filter_date_to = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_to))) . ' 23:59:59';
    }
    $query_trade_statement = Order::where('orders.status', 'closed')
      ->where('orders.user_id', $user_id)
      ->orderBy('orders.open_time', 'desc');
    if ($filter_date_from != '' || $filter_date_to != '') {
      $query_trade_statement->whereBetween('orders.open_time', array($filter_date_from, $filter_date_to));
    }
    $trade_statement = $query_trade_statement->paginate($per_page);

    // $widget = new Paymentwall_Widget(
    //   'user40012', // id of the end-user who's making the payment
    //   'p1_1',      // widget code, e.g. p1; can be picked inside of your merchant account
    //   array(),     // array of products - leave blank for Virtual Currency API
    //   // array('email' => 'user@hostname.com') // additional parameters
    // );
    
    $isClient = User::where('id',$user_id)->where('role',5)->first();
    $all =User::where('id',$user_id)->first();
    //dd($all);
    $plan = WpPack::where('id',$all->plan_id)->first();
    $date = Carbon::now()->subdays(30);
    $withdrawcheck = User::where('id',$user_id)->where('role',5)->where('created_at', '>=', $date)->count();
    $checkprofit = Balance::where('user_id', $user_id)->sum('balance');
    $plan_amount = $plan ? $plan->amount : 0;
    $checkequity = $plan_amount+($plan_amount * 10)/100;
    $withdraw = $checkequity > $checkprofit;

    //dd($limit);
    if (Browser::isMobile()) {
      return view('mobile.profile', ['data' => $data, 'verify' => $verify, 'is_admin' => $is_admin, 'active_payment_gateways' => $active_payment_gateways, 'TenPercentProfit' => $TenPercentProfit, 'withdrawcheck' => $withdrawcheck, 'trade_statement' => $trade_statement, 'withdraw' => $withdraw]);
    } else if (Browser::isTablet()) {
      return view('profile.profile', ['data' => $data, 'verify' => $verify, 'is_admin' => $is_admin, 'active_payment_gateways' => $active_payment_gateways, 'TenPercentProfit' => $TenPercentProfit, 'withdrawcheck' => $withdrawcheck, 'trade_statement' => $trade_statement, 'withdraw' => $withdraw]);
    } else {
      return view('profile.profile', ['data' => $data, 'verify' => $verify, 'is_admin' => $is_admin, 'active_payment_gateways' => $active_payment_gateways, 'TenPercentProfit' => $TenPercentProfit, 'withdrawcheck' => $withdrawcheck, 'trade_statement' => $trade_statement, 'isClient' => $isClient, 'withdraw' => $withdraw]);
    }
  }

  public function updateProfile(Request $request) {
    // return response()->json($request->all());
    $name = $request->input('name');
    $email = $request->input('email');
    $language = $request->input('language');
    $tel = $request->input('tel');
    $birth = $request->input('birth');
    $country = $request->input('country');
    $city = $request->input('city');
    $address = $request->input('address');
    $zipCode = $request->input('zipCode');
    $referalCode = $request->input('referalCode');
    $userCurrency = $request->input('userCurrency');
    $id = $request->user()->id;
    if ($name != "" && $email != "") {
      User::where('id', $id)->update(['name' => $name, 'email' => $email]);
      $res_profile = Personal_info::where('user_id', $id)->first();
      if (!$res_profile) {
        $res_profile = new Personal_info;
        $res_profile->user_id = $id;
      }
      $res_profile->lang = $language;
      $res_profile->phone = $tel;
      $res_profile->birth = $birth;
      $res_profile->country = $country;
      $res_profile->city = $city;
      $res_profile->address = $address;
      $res_profile->zip = $zipCode;
      $res_profile->referalCode = $referalCode;
      $res_profile->userCurrency = $userCurrency;
      $res_profile->photo = "";
      $res_profile->save();
      return redirect('profile')->with('flash_success', 'Your profile is updated successfully!');
    } else {
      return redirect('profile')->with('flash_danger', 'Please fill all fields out!');
    }
  }

  public function verifyID(Request $request) {
    $user_id = $request->user()->id;
    $fileExtension = $request->document->extension();
    if ($fileExtension == 'jpg' || $fileExtension == 'png' || $fileExtension == 'jpeg') {
      $fileName = time() . '.' . $fileExtension;
      $request->document->move(public_path('document'), $fileName);
      $request->session()->flash('message', 'You have successfully upload file.!');
      $res = User_verify_setting::where('user_id', $user_id)->get();
      if (count($res) == 0) {
        $verify_con = new User_verify_setting;
        $verify_con->user_id = $user_id;
        $verify_con->verify_name = $request->firstName;
        $verify_con->verify_surname = $request->lastName;
        $verify_con->verify_kind = $request->document_kind;
        $verify_con->verify_image = $fileName;
        $verify_con->verify_approved = "";
        $verify_con->save();
      } else {
        User_verify_setting::where('user_id', $user_id)->update(['verify_name' => $request->firstName, 'verify_surname' => $request->lastName, 'verify_kind' => $request->document_kind, 'verify_image' => $fileName, 'verify_approved' => ""]);
      }
      return back()
        ->with('file', $fileName);
    } else {
      $request->session()->flash('message', 'Invalid file type. Please jpg or png file only!');
      return back();
    }
  }

  public function withdrawPayment(Request $request) {
    $user_id = $request->user()->id;
    $withdraw_amount = $request->withdraw_amount;
    $withdraw_bankaccount = $request->withdraw_bankaccount;
    $withdraw_bankaccount_addr = $request->withdraw_bankaccount_addr;
    $withdraw_name = $request->withdraw_name;
    $withdraw_swift = $request->withdraw_swift;
    $withdraw_country = $request->withdraw_country;
    $all =User::where('id',$user_id)->first();
    $plan = WpPack::where('id',$all->plan_id)->first();
    $balance = Balance::where('user_id', $user_id)->sum('balance');
    $checkwith = $plan->amount == $balance;
    $prowith = $plan->amount > $withdraw_amount;
    //dd($checkwith);
    if($checkwith){
        return response()->json(['res' => 'no']);
    }
    $limit = $balance - $plan->amount;
    $withdrawmaxlimit = ($limit*50)/100;
    if ($withdraw_amount > $withdrawmaxlimit) {
        return response()->json(['res' => 'no']);
    }
    if ($withdraw_amount > $balance) {
      return response()->json(['res' => 'no']);
    } else {

      $balance_con = new Balance;
      $balance_con->user_id = $user_id;
      $balance_con->currency = "USD";
      $balance_con->balance = $withdraw_amount * (-1);
      $balance_con->mode = "withdraw";
      $balance_con->margin = 0;
      $balance_con->save();

      $withdraw_con = new Withdraw;
      $withdraw_con->user_id = $user_id;
      $withdraw_con->balance_id = $balance_con->id;
      $withdraw_con->amount = $withdraw_amount;
      $withdraw_con->bank = $withdraw_bankaccount;
      $withdraw_con->bank_addr = $withdraw_bankaccount_addr;
      $withdraw_con->name = $withdraw_name;
      $withdraw_con->swift = $withdraw_swift;
      $withdraw_con->country = $withdraw_country;
      $withdraw_con->confirm_id = Str::random(60);
      $withdraw_con->status = "Pending";
      $withdraw_con->save();

      $email_data_object = $withdraw_con;
      $email_data_object->user_email = $request->user()->email;
      $email_data_object->user_name = $request->user()->name;
      Mail::send(new WithdrawRequested($email_data_object));

      return response()->json(['res' => 'yes']);
    }
  }

  public function confirmWithdrawPayment(Request $request) {
    
    if (strlen($request->confirm_id) != 60) {
      return redirect()->route('profile');
    }

    $confirm_id = $request->confirm_id;

    $withdraw = Withdraw::where('confirm_id', $confirm_id)->where('status', "Pending")->first();
    if ($withdraw) {
      if ($withdraw->confirm_id_status == 1) {
        return redirect('profile')->with('flash_success', 'You have already confirmed once your request!');
      }
      $withdraw->confirm_id_status = 1;
      $withdraw->save();
      return redirect('profile')->with('flash_success', 'Request Confirmed!');
    } else {
      return redirect('profile')->with('flash_danger', 'Request was NOT Confirmed!');
    }
  }

  public function redirectToHome() {
    return redirect('/');
  }

  public function favorite_pair(Request $request) {
    $validator = \Validator::make($request->all(), [
      'instrument' => 'required',
      'action' => [
        'required',
        Rule::in(['add', 'remove']),
      ],
    ]);
    if ($validator->fails()) {
      return response()->json(['status' => 'danger', 'message' => $validator]);
    }

    $action = $request->get('action');

    $instrument = trim(preg_replace('|/|', '', $request->get('instrument')));
    if ($instrument == '') {
      return response()->json(['status' => 'danger', 'message' => 'You should choose an instrument!']);
    }

    $res_profile = Personal_info::where('user_id', $request->user()->id)->first();
    if (!$res_profile) {
      $res_profile = new Personal_info;
      $res_profile->user_id = $request->user()->id;
    }
    $existing_inst = is_array($res_profile->fav_pairs) ? $res_profile->fav_pairs : [];

    if ($action == 'add') {

      $existing_inst[] = $instrument;
      $res_profile->fav_pairs = array_unique($existing_inst);
      if ($res_profile->save()) {
        return response()->json(['status' => 'success', 'message' => 'Instrument saved at your favorites!']);
      } else {
        return response()->json(['status' => 'danger', 'message' => 'Instrument could not be saved!']);
      }

    } else if ($action == 'remove') {

      if (($key = array_search($instrument, $existing_inst)) !== false) {
        unset($existing_inst[$key]);
      }
      $res_profile->fav_pairs = array_values($existing_inst);
      if ($res_profile->save()) {
        return response()->json(['status' => 'success', 'message' => 'Instrument removed from your favorites!']);
      } else {
        return response()->json(['status' => 'danger', 'message' => 'Instrument could not be removed!']);
      }

    }
  }

  public function get_ig_creds(Request $request) {
    $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
    if ($ig_switch != 'on') {
      $response_array['status'] = 'danger';
      $response_array['message'] = 'IG.COM Api is deactivated!';
      return response()->json($response_array);
    }
    $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
    $ig_username = Trade_setting::where('name', 'ig_username')->value('value');
    $ig_password = Trade_setting::where('name', 'ig_password')->value('value');
    
    // $response_array['ig_api_key'] = $ig_api_key;
    // $response_array['ig_username'] = $ig_username;
    // $response_array['ig_password'] = $ig_password;
    // return response()->json($response_array);
    $headers = [];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://demo-api.ig.com/gateway/deal/session',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HEADERFUNCTION =>
      function ($curl, $header) use (&$headers) {
        $len = strlen($header);
        $header = explode(':', $header, 2);
        if (count($header) < 2) // ignore invalid headers
        {
          return $len;
        }

        $headers[strtolower(trim($header[0]))][] = trim($header[1]);
        return $len;
      },
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '{
                "identifier": "' . $ig_username . '",
                "password": "' . $ig_password . '"
            }',
      CURLOPT_HTTPHEADER => array(
        "X-IG-API-KEY: " . $ig_api_key,
        "Version: 2",
        "Content-Type: application/json",
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      $response_array['status'] = 'danger';
      $response_array['message'] = "cURL Error #: $err";
      return response()->json($response_array);
    }

    if (!isset($headers['x-security-token']) || !isset($headers['cst'])) {
      $response_array['status'] = 'danger';
      $response_array['message'] = 'Nuk mora IG headers';
      $response_array['xSecurityToken'] = '';
      $response_array['cst'] = '';
      $response_array['currentAccountId'] = '';
      $response_array['lightstreamerEndpoint'] = '';
      $response_array['subscriptions'] = [];
      return response()->json($response_array);

    }

    Cache::add('x-security-token', $headers['x-security-token'][0], now()->addMinutes(300));
    Cache::add('cst', $headers['cst'][0], now()->addMinutes(300));

    $forexEpics = [];
    $cryptoEpics = [];

    // $fav_pairs = Personal_info::where('user_id', auth()->user()->id)->value('fav_pairs');
    // if (!is_array($fav_pairs)) $fav_pairs = [];

    // if (!empty($fav_pairs)) {
    //     $fav_pair_str = '';
    //     foreach($fav_pairs as $fav_pair) {
    //         $fav_pair_str .= "'" . $fav_pair . "',";
    //     }
    //     $fav_pair_str = trim($fav_pair_str, ',');
    //     $forexPair = Forex_list::where('type', 'IG')
    //     ->where('status', 'enabeled')
    //     ->whereRaw("CONCAT(`base_forex_instruments`, `quote_forex_instruments`) IN ($fav_pair_str)")
    //     ->pluck('epic');
    //     $cryptoPair = Crypto_list::where('type', 'IG')
    //     ->where('status', 'enabeled')
    //     ->whereRaw("CONCAT(`base`, `quote`) IN ($fav_pair_str)")
    //     ->pluck('epic');

    //     foreach ($forexPair as $epic) {
    //         $forexEpics[] = "MARKET:" . $epic;
    //     }

    //     foreach ($cryptoPair as $epic) {
    //         $cryptoEpics[] = "MARKET:" . $epic;
    //     }
    // }

    $cryptoPair = Crypto_list::where('type', 'IG')
      ->where('status', 'enabeled')
    // ->whereRaw("CONCAT(`base`, `quote`) IN ($fav_pair_str)")
      ->pluck('epic');
    foreach ($cryptoPair as $epic) {
      $cryptoEpics[] = "MARKET:" . $epic;
    }

    // $stockPair = Stock_list::where('type', 'IG')
    //   ->where('status', 'enabeled')
    //   ->pluck('epic');
    // foreach ($stockPair as $epic) {
    //   $cryptoEpics[] = "MARKET:" . $epic;
    // }

    $response_array['status'] = 'success';
    $response_array['message'] = 'Ok! i mora.';
    $response_array['xSecurityToken'] = $headers['x-security-token'][0];
    $response_array['cst'] = $headers['cst'][0];
    $response_array['currentAccountId'] = $response->currentAccountId;
    $response_array['lightstreamerEndpoint'] = $response->lightstreamerEndpoint;
    $response_array['subscriptions'] = array_merge($cryptoEpics, $forexEpics);
    $response_array['cache'] = [cache('x-security-token'), cache('cst')];
    return response()->json($response_array);

  }

  public function export_statement(Request $request) {
    return (new ClientStatementExport($request))->download('statement-export'.date('-Y_m_d_H_i_s').'.xlsx');
  }
}
