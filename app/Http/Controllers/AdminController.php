<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Payment_gateway;
use App\Manager_user_relation;
use App\Personal_info;
use App\Deposit_history;
use App\Balance;
use App\Order;
use App\WpPack;
use App\Trade_setting;
use App\Admin_setting;
use App\Crypto_list;
use App\Forex_list;
use App\Stock_list;
use App\User_verify_setting;
use App\Withdraw;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use File;
use Storage;

class AdminController extends Controller
{
    public function showAdminPage(Request $request)
    {
        $manager_id = $request->user()->id;
        $per_page = (int) $request->get('per_page', 15);

        $query = Order::leftJoin('manager_user_relations', 'orders.user_id', '=', 'manager_user_relations.user_id')
        ->leftJoin('users as client', 'orders.user_id', '=', 'client.id')
        ->where('manager_user_relations.manager_id', $manager_id);
        $query->select('orders.*', 'client.name AS client_name', 'client.email');
        $query->orderByRaw('orders.id DESC, orders.status DESC');
        $order = $query->paginate($per_page);

        // dd($order[0]);
        return view('admin.main', ['order' => $order]);
    }

    public function showMyClients(Request $request)
    {
        $id = $request->user()->id;
        $clients = User::fromQuery("SELECT * FROM `users` LEFT JOIN manager_user_relations on users.id = manager_user_relations.user_id WHERE manager_user_relations.manager_id = '$id'");
        return view('admin.manage_client', ['clients' => $clients]);
    }

    public function showBanktransfer()
    {
        return view('admin.bankTransfer');
    }

    public function showPayments(Request $request)
    {
        $id = $request->user()->id;
        $payment = Order::fromQuery("SELECT aaa.id, aaa.amount, aaa.currency, aaa.mode, users.name, aaa.created_at FROM 
        (SELECT deposit_history.id, amount, currency, mode, deposit_history.user_id, deposit_history.created_at FROM `deposit_history` 
        LEFT JOIN `manager_user_relations` ON `deposit_history`.`user_id` = `manager_user_relations`.`user_id` 
        WHERE `manager_user_relations`.`manager_id`='$id') as aaa LEFT JOIN `users` on aaa.user_id=users.id ORDER BY  aaa.`id` DESC");
        return view('admin.payment', ['payment' => $payment]);
    }
    
    //package create
    public function pacakgesettings()
    {
        $pack = WpPack::all();
        return view('admin.package',compact('pack'));
    }
    
    public function pacakgesettingsedit($id)
    {
        $pack = WpPack::find($id);
        return view('admin.packageup',compact('pack'));
    }
    
    public function pacakgesettingssub(Request $request)
    {
        $pack = WpPack::find($request->id);
        $pack->name = $request->name ;
        $pack->buy = $request->buy ;
        $pack->amount = $request->amount ;
        $pack->max_loss = $request->max_loss ;
        $pack->min_time = $request->min_time ;
        $pack->maxdayslevel = $request->maxdayslevel ;
        $pack->leverage = $request->leverage ;
        $pack->profitshare = $request->profitshare ;
        $pack->terget = $request->terget ;
        $pack->update();
        return redirect('admin/package')->withSuccess('Plan Settings saved successfully');
    }


    public function showIdentify(Request $request)
    {
        $id = $request->user()->id;
        $identify = Order::fromQuery("SELECT * From (SELECT `user_verify_settings`.`id`, `user_verify_settings`.`user_id`, `user_verify_settings`.`verify_name`, `user_verify_settings`.`verify_surname`, `user_verify_settings`.`verify_kind`, `user_verify_settings`.`verify_image`, `user_verify_settings`.`verify_approved`, `user_verify_settings`.`updated_at` FROM `user_verify_settings` LEFT JOIN `manager_user_relations` ON `user_verify_settings`.`user_id` = `manager_user_relations`.`user_id` WHERE `manager_user_relations`.`manager_id`=$id ORDER BY `user_verify_settings`.`id` DESC) as aaa LEFT JOIN `users` ON aaa.`user_id`=`users`.id");
        return view('admin.identify', ['identify' => $identify]);
    }


    public function showWithdraw(Request $request)
    {
        $id = (int) $request->user()->id;

        $withdraw = Withdraw::leftJoin('users as client', 'withdraws.user_id', '=', 'client.id')
        ->leftJoin('manager_user_relations', 'manager_user_relations.user_id', '=', 'client.id')
        ->leftJoin('users as manager', 'manager_user_relations.manager_id', '=', 'manager.id')
        ->where('manager.id', $id)
        ->select('withdraws.*', 'client.name AS user_name', 'client.email')
        ->orderBy('withdraws.id')
        ->get();

        // $withdraw = Withdraw::fromQuery("SELECT aaa.* FROM (SELECT withdraws.*, users.name AS user_name,users.`email` FROM `withdraws` LEFT JOIN users ON withdraws.`user_id` = users.`id`) AS aaa
        // LEFT JOIN `manager_user_relations` ON manager_user_relations.`user_id`= aaa.`user_id` WHERE manager_user_relations.`manager_id` = " . $id . " ORDER BY  aaa.`id` DESC");
        return view('admin.withdraw', ['withdraw' => $withdraw]);
    }

    public function showTraders()
    {
        return view('admin.traders');
    }

    public function showbankSetting()
    {
        $FrontPaymentButtons = Admin_setting::where('name', 'FrontPaymentButtons')->first();
        $FrontPaymentButtonsCrypt = Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->first();
        return view('admin.paymentSettings', ['FrontPaymentButtons' => $FrontPaymentButtons, 'FrontPaymentButtonsCrypt' => $FrontPaymentButtonsCrypt]);
    }

    public function saveFrontPaymentButtons(Request $request) {
        $btn1Visa = $request->btn1Visa;
        $btn1MasterCard = $request->btn1MasterCard;
        $btn1New = $request->btn1New;
        $btn1VisaCrypt = $request->btn1VisaCrypt;
        $btn1MasterCardCrypt = $request->btn1MasterCardCrypt;
        $btn1NewCrypt = $request->btn1NewCrypt;

        $res = Admin_setting::where('name', 'FrontPaymentButtons')->get();
        if (count($res) == 0) {
            $admin_con = new Admin_setting;
            $admin_con->name = "FrontPaymentButtons";
            $admin_con->value1 = $btn1Visa;
            $admin_con->value2 = $btn1MasterCard;
            $admin_con->value3 = $btn1New;
            $admin_con->save();
        } else {
            Admin_setting::where('name', 'FrontPaymentButtons')->update(['value1' => $btn1Visa]);
            Admin_setting::where('name', 'FrontPaymentButtons')->update(['value2' => $btn1MasterCard]);
            Admin_setting::where('name', 'FrontPaymentButtons')->update(['value3' => $btn1New]);
        }

        $res = Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->get();
        if (count($res) == 0) {
            $admin_con = new Admin_setting;
            $admin_con->name = "FrontPaymentButtonsCrypt";
            $admin_con->value1 = $btn1VisaCrypt;
            $admin_con->value2 = $btn1MasterCardCrypt;
            $admin_con->value3 = $btn1NewCrypt;
            $admin_con->save();
        } else {
            Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->update(['value1' => $btn1VisaCrypt]);
            Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->update(['value2' => $btn1MasterCardCrypt]);
            Admin_setting::where('name', 'FrontPaymentButtonsCrypt')->update(['value3' => $btn1NewCrypt]);
        }

        return response()->json(['result' => 'ok']);
    }

    public function savePaymentGateway(Request $request)
    {
        $id = $request->id;
        $Gateway = $request->gateway;
        $PublicKey = $request->PublicKey;
        $SecretKey = $request->SecretKey;
        $Environment = $request->Environment;
        if ($id == 0) {
            $paymentGateways = new Payment_gateway;
            $paymentGateways->Gateway = $Gateway;
            $paymentGateways->PublicKey = $PublicKey;
            $paymentGateways->SecretKey = $SecretKey;
            $paymentGateways->Environment = $Environment;
            $paymentGateways->save();
        } else {
            $paymentGateways = Payment_gateway::find($id);
            $paymentGateways->Gateway = $Gateway;
            $paymentGateways->PublicKey = $PublicKey;
            $paymentGateways->SecretKey = $SecretKey;
            $paymentGateways->Environment = $Environment;
            $paymentGateways->update();
        }

        return response()->json(['result' => 'ok']);
    }

    public function deletePaymentGateway(Request $request)
    {
        $id = $request->id;
        $paymentGateways = Payment_gateway::find($id);
        $paymentGateways->delete();
        return response()->json(['result' => 'ok']);
    }

    public function getSpreadSettings() {
        $data = [];

        $data['forex-categories'] = Forex_list::distinct()->pluck('category');
        foreach($data['forex-categories'] as $cat) {
            $data['settings']['forex'][$cat] = Trade_setting::where('name', 'spread_forex_'.$cat)->value('value');
        }
        $data['stock-categories'] = Stock_list::distinct()->pluck('category');
        foreach($data['stock-categories'] as $cat) {
            $data['settings']['stock'][$cat] = Trade_setting::where('name', 'spread_stock_'.$cat)->value('value');
        }
        $data['crypto-categories'] = Crypto_list::distinct()->pluck('category');
        foreach($data['crypto-categories'] as $cat) {
            $data['settings']['crypto'][$cat] = Trade_setting::where('name', 'spread_crypto_'.$cat)->value('value');
        }
        return $data;
    }

    public function spreadSettings() {
        return view('admin.spread-settings', ['data' => $this->getSpreadSettings()]);
    }

    public function saveSpreadSettings(Request $request) {
        $spread_type = $request->get('spread_type', '');

        switch ($spread_type) {
            case 'forex':
                foreach(Forex_list::distinct()->pluck('category') as $cat) {
                    Trade_setting::where('name', 'spread_forex_'.$cat)->updateOrInsert(
                        ['name' => 'spread_forex_'.$cat],
                        ['value' => $request->input("forex_".$cat."_cat", 0)??0]
                    );;
                }
                break;
            case 'stock':
                foreach(Stock_list::distinct()->pluck('category') as $cat) {
                    Trade_setting::where('name', 'spread_stock_'.$cat)->updateOrInsert(
                        ['name' => 'spread_stock_'.$cat],
                        ['value' => $request->input("stock_".$cat."_cat", 0)??0]
                    );;
                }
                break;
            case 'crypto':
                foreach(Crypto_list::distinct()->pluck('category') as $cat) {
                    Trade_setting::where('name', 'spread_crypto_'.$cat)->updateOrInsert(
                        ['name' => 'spread_crypto_'.$cat],
                        ['value' => $request->input("crypto_".$cat."_cat", 0)??0]
                    );;
                }
                break;

            default:
                return redirect('admin/spread-settings')->withErrors('The request was not valid!')->withInput();
                break;
        }

        return redirect('admin/spread-settings')->withSuccess('Settings saved successfully');
    }

    public function showtradingSetting()
    {
        $stopout = Trade_setting::where('name', 'stopout')->value('value');
        if ($stopout === null) {
            $data['stopout'] = "20";
        } else {
            $data['stopout'] = $stopout;
        }
        $oanda_api_key = Trade_setting::where('name', 'oanda_api_key')->value('value');
        if ($oanda_api_key === null) {
            $data['oanda_api_key'] = "";
        } else {
            $data['oanda_api_key'] = $oanda_api_key;
        }
        $oanda_account_number = Trade_setting::where('name', 'oanda_account_number')->value('value');
        if ($oanda_account_number === null) {
            $data['oanda_account_number'] = "";
        } else {
            $data['oanda_account_number'] = $oanda_account_number;
        }
        $oanda2_api_key = Trade_setting::where('name', 'oanda2_api_key')->value('value');
        if ($oanda_api_key === null) {
            $data['oanda2_api_key'] = "";
        } else {
            $data['oanda2_api_key'] = $oanda2_api_key;
        }
        $oanda2_account_number = Trade_setting::where('name', 'oanda2_account_number')->value('value');
        if ($oanda2_account_number === null) {
            $data['oanda2_account_number'] = "";
        } else {
            $data['oanda2_account_number'] = $oanda2_account_number;
        }
        $forex_api = Trade_setting::where('name', 'forex_api')->value('value');
        if ($forex_api === null) {
            $data['forex_api'] = "";
        } else {
            $data['forex_api'] = $forex_api;
        }
        $forex_account = Trade_setting::where('name', 'forex_account')->value('value');
        if ($forex_account === null) {
            $data['forex_account'] = "";
        } else {
            $data['forex_account'] = $forex_account;
        }
        $forex_switch = Trade_setting::where('name', 'forex_switch')->value('value');
        if ($forex_switch === null) {
            $data['forex_switch'] = "";
        } else {
            $data['forex_switch'] = $forex_switch;
        }
        $forexLotsSwitch = Trade_setting::where('name', 'forexLotsSwitch')->value('value');
        if ($forexLotsSwitch === null) {
            $data['forexLotsSwitch'] = "";
        } else {
            $data['forexLotsSwitch'] = $forexLotsSwitch;
        }
        $forexLotsList = Trade_setting::where('name', 'forexLotsList')->value('value');
        if ($forexLotsList === null) {
            $data['forexLotsList'] = "";
        } else {
            $data['forexLotsList'] = $forexLotsList;
        }

        $crypto_api = Trade_setting::where('name', 'crypto_api')->value('value');
        if ($crypto_api === null) {
            $data['crypto_api'] = "";
        } else {
            $data['crypto_api'] = $crypto_api;
        }
        $crypto_account = Trade_setting::where('name', 'crypto_account')->value('value');
        if ($crypto_account === null) {
            $data['crypto_account'] = "";
        } else {
            $data['crypto_account'] = $crypto_account;
        }
        $crypto_switch = Trade_setting::where('name', 'crypto_switch')->value('value');
        if ($crypto_switch === null) {
            $data['crypto_switch'] = "";
        } else {
            $data['crypto_switch'] = $crypto_switch;
        }

        $binance_api_key = Trade_setting::where('name', 'binance_api_key')->value('value');
        if ($binance_api_key === null) {
            $data['binance_api_key'] = "";
        } else {
            $data['binance_api_key'] = $binance_api_key;
        }
        $binance_secret = Trade_setting::where('name', 'binance_secret')->value('value');
        if ($binance_secret === null) {
            $data['binance_secret'] = "";
        } else {
            $data['binance_secret'] = $binance_secret;
        }
        $binance_switch = Trade_setting::where('name', 'binance_switch')->value('value');
        if ($binance_switch === null) {
            $data['binance_switch'] = "";
        } else {
            $data['binance_switch'] = $binance_switch;
        }

        $ig_api_key = Trade_setting::where('name', 'ig_api_key')->value('value');
        if ($ig_api_key === null) {
            $data['ig_api_key'] = "";
        } else {
            $data['ig_api_key'] = $ig_api_key;
        }
        $ig_username = Trade_setting::where('name', 'ig_username')->value('value');
        if ($ig_username === null) {
            $data['ig_username'] = "";
        } else {
            $data['ig_username'] = $ig_username;
        }
        $ig_password = Trade_setting::where('name', 'ig_password')->value('value');
        if ($ig_password === null) {
            $data['ig_password'] = "";
        } else {
            $data['ig_password'] = $ig_password;
        }
        $ig_switch_crypto = Trade_setting::where('name', 'ig_switch_crypto')->value('value');
        if ($ig_switch_crypto === null) {
            $data['ig_switch_crypto'] = "";
        } else {
            $data['ig_switch_crypto'] = $ig_switch_crypto;
        }
        $ig_switch = Trade_setting::where('name', 'ig_switch')->value('value');
        if ($ig_switch === null) {
            $data['ig_switch'] = "";
        } else {
            $data['ig_switch'] = $ig_switch;
        }

        $cryptocompare_api_key = Trade_setting::where('name', 'cryptocompare_api_key')->value('value');
        if ($cryptocompare_api_key === null) {
            $data['cryptocompare_api_key'] = "";
        } else {
            $data['cryptocompare_api_key'] = $cryptocompare_api_key;
        }
        $cryptocompare_switch = Trade_setting::where('name', 'cryptocompare_switch')->value('value');
        if ($cryptocompare_switch === null) {
            $data['cryptocompare_switch'] = "";
        } else {
            $data['cryptocompare_switch'] = $cryptocompare_switch;
        }

        $fixerio_api_key = Trade_setting::where('name', 'fixerio_api_key')->value('value');
        if ($fixerio_api_key === null) {
            $data['fixerio_api_key'] = "";
        } else {
            $data['fixerio_api_key'] = $fixerio_api_key;
        }
        $fixerio_switch = Trade_setting::where('name', 'fixerio_switch')->value('value');
        if ($fixerio_switch === null) {
            $data['fixerio_switch'] = "";
        } else {
            $data['fixerio_switch'] = $fixerio_switch;
        }

        return view('admin.tradeSettings', ['data' => $data]);
    }

    public function showemailSetting()
    {
        $EmailSetting = Admin_setting::where('name', 'EmailSetting')->first();
        if ($EmailSetting) {
            $data['smtp_switch'] = $EmailSetting->value1 ?? '';
            $data['smtp_port'] = $EmailSetting->value2 ?? '';
            $data['smtp_security'] = $EmailSetting->value3 ?? '';
            $data['smtp_user'] = $EmailSetting->value4 ?? '';
            $data['smtp_password'] = $EmailSetting->value5 ?? '';
            $data['smtp_sender_name'] = $EmailSetting->value6 ?? '';
            $data['smtp_subject_switch'] = $EmailSetting->value7 ?? '';
            $data['smtp_subject'] = $EmailSetting->value8 ?? '';
            $data['smtp_host'] = $EmailSetting->value9 ?? '';
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

        $AppSettings = Admin_setting::where('name', 'AppSettings')->first();
        if ($AppSettings) {
            $data['maintenance_switch'] = $AppSettings->value1 ?? '';
            $data['maintenance_message'] = $AppSettings->value2 ?? '';
            $data['app_title'] = $AppSettings->value3 ?? '';
            $data['app_description'] = $AppSettings->value4 ?? '';
            $data['logo_path'] = $AppSettings->value5 ?? '';
        }

        $data['welcome_content'] = File::get(public_path('emailTemplate/welcome.txt'));
        $data['activeAccount_content'] = File::get(public_path('emailTemplate/activeAccount.txt'));
        $data['adminEmail_content'] = File::get(public_path('emailTemplate/adminEmail.txt'));
        $data['confirmWidthdraw_content'] = File::get(public_path('emailTemplate/confirmWidthdraw.txt'));
        $data['processWidthdraw_content'] = File::get(public_path('emailTemplate/processWidthdraw.txt'));
        $data['resetPassword_content'] = File::get(public_path('emailTemplate/resetPassword.txt'));
        $data['resetPasswordDone_content'] = File::get(public_path('emailTemplate/resetPasswordDone.txt'));
        $data['subscribeRequest_content'] = File::get(public_path('emailTemplate/subscribeRequest.txt'));
        $data['unknownLogin_content'] = File::get(public_path('emailTemplate/unknownLogin.txt'));

        return view('admin.mailSetting', ['data' => $data]);
    }

    public function showIDSetting()
    {
        $enable_verify = Admin_setting::where('name', 'VerifySetting')->value('value1');
        if ($enable_verify === null) {
            $data['enable_verify'] = "";
        } else {
            $data['enable_verify'] = $enable_verify;
        }
        $enable_trading = Admin_setting::where('name', 'VerifySetting')->value('value2');
        if ($enable_trading === null) {
            $data['enable_trading'] = "";
        } else {
            $data['enable_trading'] = $enable_trading;
        }
        $enable_deposit = Admin_setting::where('name', 'VerifySetting')->value('value3');
        if ($enable_deposit === null) {
            $data['enable_deposit'] = "";
        } else {
            $data['enable_deposit'] = $enable_deposit;
        }
        $enable_withdraw = Admin_setting::where('name', 'VerifySetting')->value('value4');
        if ($enable_withdraw === null) {
            $data['enable_withdraw'] = "";
        } else {
            $data['enable_withdraw'] = $enable_withdraw;
        }

        return view('admin.identifySettings', ['data' => $data]);
    }

    public function showuserManage()
    {
        $res = User::all();
        return view('admin.user', ['user' => $res]);
    }



    public function showmailBox()
    {
        return view('admin.mailbox');
    }

    public function shownotification()
    {
        return view('admin.notification');
    }

    public function showManagers()
    {
        $res = User::whereIn('role', [1, 2, 3])->get();
        return view('admin.manager', ['manager' => $res]);
    }

    public function showClients(Request $request) {
        $per_page = (int) $request->get('per_page', 15);
        $filter_manager_id = (int) $request->get('manager', 0);
        $filter_client_name = $request->get('client_name', '');

        $query = User::leftJoin('manager_user_relations', 'users.id', '=', 'manager_user_relations.user_id')
            ->leftJoin('users as manager', 'manager_user_relations.manager_id', '=', 'manager.id')
            ->where('users.role', 5);
        if ($request->user()->role > 1) {
            $query->where('manager_user_relations.manager_id', $request->user()->id);
        }
        if ($filter_manager_id == -1) {
            $query->whereNull('manager.id');
        }
        if ($filter_manager_id > 0) {
            $query->where('manager.id', $filter_manager_id);
        }
        if ($filter_client_name != '') {
            $query->where('users.name', 'like', '%' . $filter_client_name . '%');
        }
        $query->select('users.id', 'users.name', 'users.email', 'users.role', 'manager_user_relations.manager_id');
        $res = $query->paginate($per_page);

        $manager_list = User::whereIn('role', [1, 2, 3])->get();

        return view('admin.user', ['user' => $res, 'manager_list' => $manager_list]);
    }

    public function updateClient(Request $request)
    {
        $user_id = $request->user_id;
        $user_type = $request->user_type;
        $user_manager = $request->user_manager;
        if ($user_type == 3) {
            User::where('id', $user_id)->update(['role' => $user_type]);
        } else {
            if ($user_manager == '') {
                Manager_user_relation::where('user_id', $user_id)->delete();
            } else {
                $user_res = Manager_user_relation::where('user_id', $user_id)->get();
                if (count($user_res) == 0) {
                    $manager_user_con = new Manager_user_relation;
                    $manager_user_con->user_id = $user_id;
                    $manager_user_con->manager_id = $user_manager;
                    $manager_user_con->save();
                } else {
                    Manager_user_relation::where('user_id', $user_id)->update(['manager_id' => $user_manager]);
                }
            }
        }
        return response()->json(['res' => 'ok']);
    }

    public function deleteClient(Request $request)
    {
        $user_id = (int) $request->user_id;
        if (User::where('id', $user_id)->where('role', '>', 3)->delete()) {
            Manager_user_relation::where('user_id', $user_id)->delete();
            return response()->json(['res' => 'ok', 'message' => 'User deleted succesfully!']);
        } else {
            return response()->json(['res' => 'ko', 'message' => 'User could not be deleted!']);
        }
    }

    public function updateManager(Request $request)
    {
        $id = $request->id;
        $role = $request->manager_type;
        User::where('id', $id)->update(['role' => $role]);
        return response()->json(['res' => 'ok']);
    }

    public function showClientDetail(Request $request, $id)
    {
        $data['name'] = User::where('id', $id)->value('name');
        $data['email'] = User::where('id', $id)->value('email');
        $res_profile = Personal_info::where('user_id', $id)->get();
        if (count($res_profile) == 0) {
            $data['lang'] = "";
            $data['phone'] = "";
            $data['birth'] = "";
            $data['country'] = "";
            $data['city'] = "";
            $data['address'] = "";
            $data['zip'] = "";
        } else {
            $data['lang'] = Personal_info::where('user_id', $id)->value('lang');
            $data['phone'] = Personal_info::where('user_id', $id)->value('phone');
            $data['birth'] = Personal_info::where('user_id', $id)->value('birth');
            $data['country'] = Personal_info::where('user_id', $id)->value('country');
            $data['city'] = Personal_info::where('user_id', $id)->value('city');
            $data['address'] = Personal_info::where('user_id', $id)->value('address');
            $data['zip'] = Personal_info::where('user_id', $id)->value('zip');
        }
        $data['user_id'] = $id;
        $data['payments'] = Deposit_history::where('user_id', $id)->get();
        $data['orders'] = Order::where('user_id', $id)->orderByDesc('id')->get();
        $data['balance'] = Balance::where('user_id', $id)->sum('balance');
        return view('admin.user_detail', ['data' => $data]);
    }

    function addFund(Request $request)
    {
        $id = $request->id;
        $amount = $request->amount;
        $type = $request->type;
        $currency = $request->currency;
        $balance = Balance::where('user_id', $id)->sum('balance');
        if ($type == "remove") {
            if ($balance < $amount) {
                $lack = $balance - $amount;
                return response()->json(['res' => $lack]);
            } else {
                $deposit_con = new Deposit_history;
                $deposit_con->amount = $amount * (-1);
                $deposit_con->currency = $currency;
                $deposit_con->user_id = $id;
                $deposit_con->mode = "Manager_updated";
                $deposit_con->save();
                $balance_con = new Balance;
                $balance_con->balance = $amount * (-1);
                $balance_con->margin = 0;
                $balance_con->currency = $currency;
                $balance_con->user_id = $id;
                $balance_con->mode = "practice";
                $balance_con->ticket = "";
                $balance_con->save();
                return response()->json(['res' => 'ok']);
            }
        } else {

            $deposit_con = new Deposit_history;
            $deposit_con->amount = $amount;
            $deposit_con->currency = $currency;
            $deposit_con->user_id = $id;
            $deposit_con->mode = "Manager_updated";
            $deposit_con->save();

            $balance_con = new Balance;
            $balance_con->balance = $amount;
            $balance_con->margin = 0;
            $balance_con->currency = $currency;
            $balance_con->user_id = $id;
            $balance_con->mode = "practice";
            $balance_con->ticket = "";
            $balance_con->save();
            return response()->json(['res' => 'ok']);
        }
    }

    public function configPaymentGateways(Request $request, $gateway)
    {
        switch ($gateway) {
            case 'rave':
                $rave = Payment_gateway::where('Gateway', 'flutterwave')->get();
                if (count($rave) != 0) {

                    foreach ($rave as $rave) {
                        $public_key = $rave['PublicKey'];
                        $secret_key = $rave['SecretKey'];
                        $environment = $rave['Environment'];
                        $rave_real_switch = $rave['real_switch'];
                        $rave_demo_switch = $rave['demo_switch'];
                    }
                } else {
                    $public_key = "";
                    $secret_key = "";
                    $environment = "";
                    $rave_real_switch = "";
                    $rave_demo_switch = "";
                }
                return view('admin.payments.rave', ['public_key' => $public_key, 'secret_key' => $secret_key, 'environment' => $environment, 'rave_real_switch' => $rave_real_switch, 'rave_demo_switch' => $rave_demo_switch]);
                break;
            case 'paypal':
                $paypal = Payment_gateway::where('Gateway', 'paypal')->get();
                if (count($paypal) == 0) {
                    $client_id = "";
                    $secretKey = "";
                    $paypal_switch = "";
                    $paypal_real_switch = "";
                } else {
                    foreach ($paypal as $paypal) {
                        $client_id = $paypal['PublicKey'];
                        $secretKey = $paypal['SecretKey'];
                        $paypal_switch = $paypal['Environment'];
                        $paypal_real_switch = $paypal['real_switch'];
                    }
                }

                return view('admin.payments.paypal', [
                    'client_id' => $client_id,
                    'secretKey' => $secretKey,
                    'paypal_switch' => $paypal_switch,
                    'paypal_real_switch' => $paypal_real_switch
                ]);
                break;
            case 'coinpayment':
                $coinpayment = Payment_gateway::where('Gateway', 'coinpayment')->get();
                if (count($coinpayment) == 0) {
                    $publicKey = "";
                    $secretKey = "";
                    $coinpayment_real_switch = "";
                } else {
                    foreach ($coinpayment as $coinpayment) {
                        $publicKey = $coinpayment['PublicKey'];
                        $secretKey = $coinpayment['SecretKey'];
                        $coinpayment_real_switch = $coinpayment['real_switch'];
                    }
                }

                return view('admin.payments.coinpayment', [
                    'publicKey' => $publicKey,
                    'secretKey' => $secretKey,
                    'coinpayment_real_switch' => $coinpayment_real_switch
                ]);
                break;
            case 'bridgerPay':
                $bridgerPay = Payment_gateway::where('Gateway', 'bridgerPay')->get();
                if (count($bridgerPay) == 0) {
                    $cashierKey = "";
                    $apiKey = "";
                    $bridgerPay_switch = "";
                    $bridgerPay_real_switch = "";
                } else {
                    foreach ($bridgerPay as $bridgerPay) {
                        $cashierKey = $bridgerPay['PublicKey'];
                        $apiKey = $bridgerPay['SecretKey'];
                        $bridgerPay_switch = $bridgerPay['Environment'];
                        $bridgerPay_real_switch = $bridgerPay['real_switch'];
                    }
                }

                return view('admin.payments.bridgerPay', [
                    'cashierKey' => $cashierKey,
                    'apiKey' => $apiKey,
                    'bridgerPay_switch' => $bridgerPay_switch,
                    'bridgerPay_real_switch' => $bridgerPay_real_switch
                ]);
                break;

            case 'paymentwall':
                $paymentWall = Payment_gateway::where('Gateway', 'paymentWall')->first();
                $publicKey = "";
                $secretKey = "";
                $paymentWall_switch = "";
                $paymentwall_real_switch = "";
                if ($paymentWall) {
                    $publicKey = $paymentWall->PublicKey;
                    $secretKey = $paymentWall->SecretKey;
                    $paymentWall_switch = $paymentWall->Environment;
                    $paymentwall_real_switch = $paymentWall->real_switch;
                }

                return view('admin.payments.paymentWall', [
                    'publicKey' => $publicKey,
                    'secretKey' => $secretKey,
                    'paymentWall_switch' => $paymentWall_switch,
                    'paymentwall_real_switch' => $paymentwall_real_switch
                ]);
                break;

            default:
                # code...
                break;
        }
    }

    public function updatePaymentGateway(Request $request, $gateway)
    {
        switch ($gateway) {
            case 'rave':
                $publicKey = $request->publicKey;
                $secretKey = $request->secretKey;
                $environment = $request->environment;
                $rave_real_switch = filter_var($request->rave_real_switch, FILTER_VALIDATE_BOOLEAN);
                $rave_demo_switch = filter_var($request->rave_demo_switch, FILTER_VALIDATE_BOOLEAN);
                $res = Payment_gateway::where('Gateway', 'flutterwave')->get();
                if (count($res) == 0) {
                    $rave_con = new Payment_gateway;
                    $rave_con->Gateway = "flutterwave";
                    $rave_con->PublicKey = $publicKey;
                    $rave_con->SecretKey = $secretKey;
                    $rave_con->Environment = $environment;
                    $rave_con->real_switch = $rave_real_switch;
                    $rave_con->demo_switch = $rave_demo_switch;
                    $rave_con->save();
                } else {
                    Payment_gateway::where('Gateway', 'flutterwave')->update([
                        'PublicKey' => $publicKey,
                        'SecretKey' => $secretKey,
                        'Environment' => $environment,
                        'real_switch' => $rave_real_switch,
                        'demo_switch' => $rave_demo_switch
                    ]);
                }
                return response()->json(['res' => 'ok', 'real' => $rave_real_switch]);
                break;

            case 'paypal':
                $client_id = $request->client_id;
                $secretKey = $request->secretKey;
                $paypal_switch = $request->paypal_switch;
                $paypal_real_switch = filter_var($request->paypal_real_switch, FILTER_VALIDATE_BOOLEAN);
                $res = Payment_gateway::where('Gateway', 'paypal')->get();
                if (count($res) == 0) {
                    $paypal_con = new Payment_gateway;
                    $paypal_con->Gateway = "paypal";
                    if ($client_id != '') {
                        $paypal_con->PublicKey = $client_id;
                    }
                    $paypal_con->SecretKey = $secretKey;
                    $paypal_con->Environment = $paypal_switch;
                    $paypal_con->real_switch = $paypal_real_switch;
                    $paypal_con->save();
                } else {
                    if ($client_id != '') {
                        $upd_Payment_gateway['PublicKey'] = $client_id;
                    }
                    $upd_Payment_gateway['SecretKey'] = $secretKey;
                    $upd_Payment_gateway['Environment'] = $paypal_switch;
                    $upd_Payment_gateway['real_switch'] = $paypal_real_switch;
                    Payment_gateway::where('Gateway', 'paypal')->update($upd_Payment_gateway);
                }
                return response()->json(['res' => 'ok']);
                break;

            case 'coinpayment':
                $publicKey = $request->publicKey;
                if ($publicKey === null) {
                    $publicKey = "";
                }
                $secretKey = $request->secretKey;
                if ($secretKey === null) {
                    $secretKey = "";
                }
                $paypal_real_switch = filter_var($request->coinpayment_real_switch, FILTER_VALIDATE_BOOLEAN);
                $res = Payment_gateway::where('Gateway', 'coinpayment')->get();
                if (count($res) == 0) {
                    $payment_con = new Payment_gateway;
                    $payment_con->Gateway = "coinpayment";
                    if ($publicKey != '') {
                        $payment_con->PublicKey = $publicKey;
                    }
                    if ($secretKey != '') {
                        $payment_con->SecretKey = $secretKey;
                    }
                    $payment_con->Environment = "";
                    $payment_con->real_switch = $coinpayment_real_switch;
                    $payment_con->save();
                } else {
                    Payment_gateway::where('Gateway', 'coinpayment')->update([
                        'PublicKey' => $publicKey,
                        'SecretKey' => $secretKey,
                        'real_switch' => $coinpayment_real_switch
                    ]);
                }
                if ($publicKey != '') {
                    $this->setEnvironmentValue(['COINPAYMENT_PUBLIC_KEY' => $publicKey]);
                }
                if ($secretKey != '') {
                    $this->setEnvironmentValue(['COINPAYMENT_PRIVATE_KEY' => $secretKey]);
                }

                return response()->json(['res' => 'ok']);
                break;

            case 'bridgerPay':
                $cashier_key = $request->cashier_key;
                $api_key = $request->api_key;
                $bridgerPay_switch = $request->bridgerPay_switch;
                $bridgerPay_real_switch = filter_var($request->bridgerPay_real_switch, FILTER_VALIDATE_BOOLEAN);
                $res = Payment_gateway::where('Gateway', 'bridgerPay')->get();
                if (count($res) == 0) {
                    $paypal_con = new Payment_gateway;
                    $paypal_con->Gateway = "bridgerPay";
                    $paypal_con->PublicKey = $cashier_key;
                    $paypal_con->SecretKey = $api_key;
                    $paypal_con->real_switch = $bridgerPay_real_switch;
                    $paypal_con->Environment = $bridgerPay_switch;
                    $paypal_con->save();
                } else {
                    if ($cashier_key != '') {
                        $upd_Payment_gateway['PublicKey'] = $cashier_key;
                    }
                    $upd_Payment_gateway['SecretKey'] = $api_key;
                    $upd_Payment_gateway['Environment'] = $bridgerPay_switch;
                    $upd_Payment_gateway['real_switch'] = $bridgerPay_real_switch;
                    Payment_gateway::where('Gateway', 'bridgerPay')->update($upd_Payment_gateway);
                }
                return response()->json(['res' => 'ok']);
                break;

            case 'paymentwall':
                $res = Payment_gateway::where('Gateway', 'paymentWall')->first();
                if (!$res) {
                    $res = new Payment_gateway;
                    $res->Gateway = "paymentWall";
                }
                if ($request->get('publicKey', '') != '') {
                    $res->PublicKey = $request->get('publicKey', '');
                }
                if ($request->get('publicKey', '') != '') {
                    $res->SecretKey = $request->get('publicKey', '');
                }
                $res->Environment = "";
                $res->real_switch = filter_var($request->paymentwall_real_switch, FILTER_VALIDATE_BOOLEAN);
                $res->save();

                return response()->json(['res' => 'ok']);
                break;
    
            default:
                return response()->json(['res' => 'error']);
                break;
        }
    }

    public function updateTradeSettings(Request $request, $trade)
    {
        switch ($trade) {
            case 'stopout':

                $stopout = $request->filled('stopout') ? $request->input('stopout') : '';
                Trade_setting::updateOrInsert(['name' => 'stopout'], ['value' => $stopout]);

                return response()->json(['res' => 'ok']);
                break;
            case 'forex':

                $oandaApiKey = $request->filled('oandaApiKey') ? $request->input('oandaApiKey') : '';
                $oanda2_api_key = $request->filled('oanda2_api_key') ? $request->input('oanda2_api_key') : '';
                $apiKey = $request->filled('apiKey') ? $request->input('apiKey') : '';
                $oandaAccountNumber = $request->filled('oandaAccountNumber') ? $request->input('oandaAccountNumber') : '';
                $oanda2_account_number = $request->filled('oanda2_account_number') ? $request->input('oanda2_account_number') : '';
                $account = $request->filled('account') ? $request->input('account') : '';
                $trade_switch = $request->filled('trade_switch') ? $request->input('trade_switch') : '';
                $forexLotsSwitch = $request->filled('forexLotsSwitch') ? $request->input('forexLotsSwitch') : '';
                $forexLotsList = $request->filled('forexLotsList') ? $request->input('forexLotsList') : '';

                $oandaApiKey ? Trade_setting::updateOrInsert(['name' => 'oandaApiKey'], ['value' => $oandaApiKey]) : '';
                $oanda2_api_key ? Trade_setting::updateOrInsert(['name' => 'oanda2_api_key'], ['value' => $oanda2_api_key]) : '';
                $apiKey ? Trade_setting::updateOrInsert(['name' => 'apiKey'], ['value' => $apiKey]) : '';
                Trade_setting::updateOrInsert(['name' => 'oandaAccountNumber'], ['value' => $oandaAccountNumber]);
                Trade_setting::updateOrInsert(['name' => 'oanda2_account_number'], ['value' => $oanda2_account_number]);
                Trade_setting::updateOrInsert(['name' => 'account'], ['value' => $account]);
                Trade_setting::updateOrInsert(['name' => 'trade_switch'], ['value' => $trade_switch]);
                Trade_setting::updateOrInsert(['name' => 'forexLotsSwitch'], ['value' => $forexLotsSwitch]);
                Trade_setting::updateOrInsert(['name' => 'forexLotsList'], ['value' => $forexLotsList]);

                return response()->json(['res' => 'ok']);
                break;
            case 'crypto':
                $crypto_api = $request->filled('apiKey') ? $request->input('apiKey') : '';
                $crypto_account = $request->filled('account') ? $request->input('account') : '';
                $crypto_switch = $request->filled('trade_switch') ? $request->input('trade_switch') : '';

                Trade_setting::updateOrInsert(['name' => 'crypto_api'], ['value' => $crypto_api]);
                $crypto_account ? Trade_setting::updateOrInsert(['name' => 'crypto_account'], ['value' => $crypto_account]) : '';
                Trade_setting::updateOrInsert(['name' => 'crypto_switch'], ['value' => $crypto_switch]);

                return response()->json(['res' => 'ok']);
                break;
            case 'ig':
                $ig_api_key = $request->filled('ig_api_key') ? $request->input('ig_api_key') : '';
                $ig_password = $request->filled('ig_password') ? $request->input('ig_password') : '';
                $ig_username = $request->filled('ig_username') ? $request->input('ig_username') : '';
                $ig_switch_crypto = $request->filled('ig_switch_crypto') ? $request->input('ig_switch_crypto') : '';
                $ig_switch = $request->filled('ig_switch') ? $request->input('ig_switch') : '';

                $ig_api_key ? Trade_setting::updateOrInsert(['name' => 'ig_api_key'], ['value' => $ig_api_key]) : '';
                $ig_password ? Trade_setting::updateOrInsert(['name' => 'ig_password'], ['value' => $ig_password]) : '';
                Trade_setting::updateOrInsert(['name' => 'ig_username'], ['value' => $ig_username]);
                Trade_setting::updateOrInsert(['name' => 'ig_switch'], ['value' => $ig_switch]);
                Trade_setting::updateOrInsert(['name' => 'ig_switch_crypto'], ['value' => $ig_switch_crypto]);

                return response()->json(['res' => 'ok']);
                break;
            case 'cryptocompare':
                $cryptocompare_api_key = $request->filled('cryptocompare_api_key') ? $request->input('cryptocompare_api_key') : '';
                $cryptocompare_switch = $request->filled('cryptocompare_switch') ? $request->input('cryptocompare_switch') : '';

                $cryptocompare_api_key ? Trade_setting::updateOrInsert(['name' => 'cryptocompare_api_key'], ['value' => $cryptocompare_api_key]) : '';
                Trade_setting::updateOrInsert(['name' => 'cryptocompare_switch'], ['value' => $cryptocompare_switch]);

                return response()->json(['res' => 'ok']);
                break;
            case 'fixerio':
                $fixerio_api_key = $request->filled('fixerio_api_key') ? $request->input('fixerio_api_key') : '';
                $fixerio_switch = $request->filled('fixerio_switch') ? $request->input('fixerio_switch') : '';

                $fixerio_api_key ? Trade_setting::updateOrInsert(['name' => 'fixerio_api_key'], ['value' => $fixerio_api_key]) : '';
                Trade_setting::updateOrInsert(['name' => 'fixerio_switch'], ['value' => $fixerio_switch]);

                return response()->json(['res' => 'ok']);
                break;
            case 'binance':

                $binance_api_key = $request->filled('binance_api_key') ? $request->input('binance_api_key') : '';
                $binance_secret = $request->filled('binance_secret') ? $request->input('binance_secret') : '';
                $binance_switch = $request->filled('binance_switch') ? $request->input('binance_switch') : '';

                $binance_api_key ? Trade_setting::updateOrInsert(['name' => 'binance_api_key'], ['value' => $binance_api_key]) : '';
                $binance_secret ? Trade_setting::updateOrInsert(['name' => 'binance_secret'], ['value' => $binance_secret]) : '';
                Trade_setting::updateOrInsert(['name' => 'binance_switch'], ['value' => $binance_switch]);

                return response()->json(['res' => 'ok']);
                break;
            default:
                return response()->json(['res' => 'error']);
                break;
        }
    }

    public function updateOpenRate(Request $request)
    {
        $openRate = $request->openRate;
        $ticket = $request->ticket;
        $order_status = $request->order_status;
        if ($order_status != "open") {
            $closeRate = Order::where('ticket', $ticket)->value('close_rate');
            $type = Order::where('ticket', $ticket)->value('type');
            if ($type == 'sell') {
                $pro_loss = ($openRate - $closeRate) * 10000;
            } else {
                $pro_loss = ($closeRate - $openRate) * 10000;
            }
            Order::where('ticket', $ticket)->update(['pro_loss' => $pro_loss]);
            Balance::where('ticket', $ticket)->update(['balance' => $pro_loss]);
            Order::where('ticket', $ticket)->update(['open_rate' => $openRate]);
        } else {
            Order::where('ticket', $ticket)->update(['open_rate' => $openRate]);
        }

        return response()->json(['res' => 'ok']);
    }

    public function deleteOrder(Request $request) {

        $orderToken = $request->input('orderToken', false);
        if ($orderToken && ( $request->user()->isAdmin() || $request->user()->isManager())) {
            Order::where('ticket', $orderToken)->delete();
            Balance::where('ticket', $orderToken)->delete();
            return response()->json(['res' => 'ok']);
        } else {
            return response()->json(['res' => 'ko']);
        }

    }

    public function updateEmailSetting(Request $request)
    {
        $smtp_switch = $request->filled('smtp_switch') ? $request->input('smtp_switch') : '';
        $smtp_port = $request->filled('smtp_port') ? $request->input('smtp_port') : '';
        $smtp_security = $request->filled('smtp_security') ? $request->input('smtp_security') : '';
        $smtp_user = $request->filled('smtp_user') ? $request->input('smtp_user') : '';
        $smtp_password = $request->filled('smtp_password') ? $request->input('smtp_password') : '';
        $smtp_sender_name = $request->filled('smtp_sender_name') ? $request->input('smtp_sender_name') : '';
        $smtp_subject_switch = $request->filled('smtp_subject_switch') ? $request->input('smtp_subject_switch') : '';
        $smtp_subject = $request->filled('smtp_subject') ? $request->input('smtp_subject') : '';
        $smtp_host = $request->filled('smtp_host') ? $request->input('smtp_host') : '';

        Admin_setting::updateOrInsert(
            ['name' => 'EmailSetting'],
            [
            'value1' => $smtp_switch,
            'value2' => $smtp_port,
            'value3' => $smtp_security,
            'value4' => $smtp_user,
            'value5' => $smtp_password,
            'value6' => $smtp_sender_name,
            'value7' => $smtp_subject_switch,
            'value8' => $smtp_subject,
            'value9' => $smtp_host
            ]
            );

        $this->setEnvironmentValue([
            'MAIL_PORT' => (int) trim($request->smtp_port),
            'MAIL_HOST' => "\"$request->smtp_host\"",
            'MAIL_ENCRYPTION' => trim($request->smtp_security),
            'MAIL_USERNAME' => trim($request->smtp_user),
            'MAIL_PASSWORD' => "\"$request->smtp_password\"",
            'MAIL_FROM_NAME' => "\"$request->smtp_sender_name\"",
        ]);
        return response()->json(['res' => 'ok']);
    }

    public function updateAppSettings(Request $request)
    {
        $maintenance_switch = $request->filled('maintenance_switch') ? $request->input('maintenance_switch') : '';
        $maintenance_message = $request->filled('maintenance_message') ? $request->input('maintenance_message') : '';
        $app_title = $request->filled('app_title') ? $request->input('app_title') : '';
        $app_description = $request->filled('app_description') ? $request->input('app_description') : '';

        if ($request->file('logo_path')) {
            $request->validate([ 'logo_path' => 'mimes:png,jpg,ico,svg|max:2048' ]);
            $logo_path = time() . '.' . $request->logo_path->extension();
            $request->logo_path->move(public_path('uploads'), $logo_path);
            Admin_setting::updateOrInsert( ['name' => 'AppSettings'], ['value5' => $logo_path] );
        }

        Admin_setting::updateOrInsert(
            ['name' => 'AppSettings'],
            [
                'value1' => $maintenance_switch,
                'value2' => $maintenance_message,
                'value3' => $app_title,
                'value4' => $app_description,
            ]
        );
        return redirect('admin/emailSetting')->withSuccess('Settings saved successfully');
    }

    public function updatePageSettings(Request $request)
    {
        $contact_email = $request->filled('contact_email') ? $request->input('contact_email') : '';
        $contact_phone = $request->filled('contact_phone') ? $request->input('contact_phone') : '';
        $contact_address = $request->filled('contact_address') ? $request->input('contact_address') : '';
        $contact_license = $request->filled('contact_license') ? $request->input('contact_license') : '';
        $privacy_content = $request->filled('privacy_content') ? $request->input('privacy_content') : '';
        $policy_content = $request->filled('policy_content') ? $request->input('policy_content') : '';

        Admin_setting::updateOrInsert(
            ['name' => 'PageSettings'],
            [
            'value1' => $contact_email,
            'value2' => $contact_phone,
            'value3' => $contact_address,
            'value4' => $contact_license,
            'value11' => $privacy_content,
            'value12' => $policy_content
            ]
        );
        return redirect('admin/emailSetting')->withSuccess('Settings saved successfully');
    }

    public function leverageSetting()
    {
        $stock = Stock_list::all();
        $forex = Forex_list::all();
        $crypto = Crypto_list::all();
        return view('admin.leverage', ['forex' => $forex, 'crypto' => $crypto, 'stock' => $stock]);
    }

    public function updateLeverage(Request $request)
    {
        $kind = $request->kind;
        $id = $request->id;
        $leverage = $request->leverage;
        switch ($kind) {
            case 'forex':
                Forex_list::where('id', $id)->update(['leverage' => $leverage]);
                break;

            case 'crypto':
                Crypto_list::where('id', $id)->update(['leverage' => $leverage]);
                break;
        }
        return response()->json(['res' => 'ok']);
    }

    public function identifyProcess(Request $request)
    {
        $id = $request->id;
        $id = $id * 1;
        $action = $request->action;
        User_verify_setting::where('user_id', $id)->update(['verify_approved' => $action]);
        return response()->json(['res' => 'ok']);
    }

    public function updateVerifySetting(Request $request)
    {
        $res = Admin_setting::where('name', 'VerifySetting')->get();
        if (count($res) == 0) {
            $admin_con = new Admin_setting;
            $admin_con->name = "VerifySetting";
            $admin_con->value1 = $request->enable_verify;
            $admin_con->value2 = $request->enable_trading;
            $admin_con->value3 = $request->enable_deposit;
            $admin_con->value4 = $request->enable_withdraw;
            $admin_con->save();
        } else {
            Admin_setting::where('name', 'VerifySetting')->update(['value1' => $request->enable_verify]);
            Admin_setting::where('name', 'VerifySetting')->update(['value2' => $request->enable_trading]);
            Admin_setting::where('name', 'VerifySetting')->update(['value3' => $request->enable_deposit]);
            Admin_setting::where('name', 'VerifySetting')->update(['value4' => $request->enable_withdraw]);
        }
        return response()->json(['res' => 'ok']);
    }

    public function updateTemplate(Request $request)
    {
        $content = $request->content;
        $fileName = $request->fileName;
        File::put(public_path('emailTemplate/') . $fileName . '.txt', $content);
        return response()->json(['res' => 'ok']);
    }

    public function updatePassword(Request $request)
    {
        $user_id = $request->user_id;
        $pword = $request->new_pword;
        $res = User::where('id', $user_id)->update(['password' => Hash::make($pword)]);
        return response()->json(['res' => $res]);
    }

    public function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

    public function approveWithdraw(Request $request)
    {
        $id = $request->id;
        Withdraw::where('id', $id)->update(['status' => "Approved"]);
        return response()->json(['res' => 'ok']);
    }

    public function declineWithdraw(Request $request)
    {
        $id = $request->id;
        $reason = $request->reason;
        $withdraw = Withdraw::where('id', $id)->first();
        $withdraw->status = "Declined";
        $withdraw->decline_reason = $reason;
        $balance_id = $withdraw->balance_id;
        $withdraw->save();

        Balance::where('id', $balance_id)->delete();

        return response()->json(['res' => 'ok']);
    }
}
